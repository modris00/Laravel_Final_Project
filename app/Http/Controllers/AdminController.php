<?php

namespace App\Http\Controllers;

use App\Mail\SupervisorWelcomeEmail;
use App\Models\Admin;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = Admin::all();
        return response()->view('dashboard.list_admins', ["admins" => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('dashboard.create_admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:30',
            'email' => 'required|email|unique:admins,email',
            'mobile' => 'required|numeric|digits:12',
            'address' => 'nullable|string|min:3|max:50',
            'image' => 'nullable|image|mimes:jpg,png|max:1024',
            'password' => [
                'required', 'string',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->mixedCase()
                    ->uncompromised()
            ]
        ]);

        if (!$validator->fails()) {
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->mobile = $request->input('mobile');
            $admin->address = $request->input('address');
            $admin->password = Hash::make($request->input('password'));
            if ($request->hasFile('image')) {
                $adminImage = $request->file('image');
                $imageName = time() . '_image_' . $admin->name . '.' . $adminImage->getClientOriginalExtension();
                $adminImage->storePubliclyAs('admins', $imageName, ['disk' => 'public']);
                $admin->image = 'admins/' . $imageName;
            }
            $saved = $admin->save();
            $decoded_password = $request->input('password');
            if ($saved) {
                // Mail::to($request->user())
                Mail::to($admin->email)->send(new SupervisorWelcomeEmail($admin, $decoded_password));
                return response()->json(["message" => "Supervisor created successfully"], Response::HTTP_CREATED);
            } else {
                return response()->json(["message" => "Failed to create a supervisor"], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $admin = Admin::findOrFail($id);
        return response()->view('dashboard.show_admin', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $admin = Admin::findOrFail($id);
        return response()->view('dashboard.edit_admin', ["admin" => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:30',
            'email' => 'required|email|unique:admins,email, ' . $id,
            'mobile' => 'required|numeric|digits:12',
            'address' => 'nullable|string|min:3|max:50',
            'image' => 'nullable|image|mimes:jpg,png|max:1024',
        ]);

        if (!$validator->fails()) {
            $admin = Admin::findOrFail($id);
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->mobile = $request->input('mobile');
            $admin->address = $request->input('address');

            $oldImagePath = $admin->image;
            $newImagePath = $this->uploadFile($request);

            if ($newImagePath) {
                $admin->image = $newImagePath;
            }

            if ($newImagePath && $oldImagePath) {
                Storage::disk("public")->delete($oldImagePath);
            }

            $saved = $admin->save();

            if ($saved) {
                return response()->json(["message" => "Supervisor data updated."], Response::HTTP_CREATED);
            } else {
                return response()->json(["message" => "Failed to update supervisor data"], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $admin = Admin::findOrFail($id);
        $deleted = $admin->delete();
        if ($deleted && $admin->image) {
            // Storage::delete($admin->image);
            Storage::disk("public")->delete($admin->image);
            // dd($admin->image);
        }
        // return redirect()->back();
        return response()->json(
            ['message' => $deleted ? "Supervisor deleted successfully" : "Failed to delete supervisor"],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    protected function uploadFile(Request $request)
    {
        if ($request->hasFile('image')) {
            $adminImage = $request->file('image');
            $imageName = time() . '_image_' . $request->input('name') . '.' . $adminImage->getClientOriginalExtension();
            $path = $adminImage->storePubliclyAs('admins', $imageName, ['disk' => 'public']);
            // $admin->image = 'admins/' . $imageName;
            return $path;
        } else {
            return;
        }
    }

    public function homepage()
    {
        $feedbacks_count = Feedback::all()->count();

        $latest_feedback = Feedback::orderBy('id', 'desc')->first();
        $latest_name = '-';
        if ($latest_feedback) $latest_name = $latest_feedback->student_name;

        $closed_feedbacks = Feedback::where('status', '=', 'Closed')->count();

        $admins_count = Admin::all()->count();

        $latest_admin = Admin::orderBy('id', 'desc')->first();
        $latest_admin_name = '';
        if ($latest_admin) $latest_admin_name = $latest_admin->name;

        $urgent_with_no_response = Feedback::where([['urgent', '=', 1], ['response', '=', null]])->count();
        return response()->view('starter', compact('feedbacks_count', 'admins_count', 'urgent_with_no_response', 'latest_name', 'closed_feedbacks', 'latest_admin_name'));
    }
}
