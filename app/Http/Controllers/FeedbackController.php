<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackCreatedEmail;
use App\Mail\ResponseAddedEmail;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $feedbacks = Feedback::all();
        $feedbacks = Feedback::orderBy('created_at')->get();
        // $feedbacks = Feedback::paginate(5);

        // return response()->view('dashboard.test', ["feedbacks" => $feedbacks]);
        return response()->view('dashboard.list_feedbacks', ["feedbacks" => $feedbacks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('create_feedback');
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
        // dd($request->all());
        $validator = Validator($request->all(), [
            'std_name' => 'required|string|min:3|max:30',
            'std_email' => 'required|email',
            'std_id' => 'required|numeric|digits:10',
            'std_image' => 'nullable|image|mimes:jpg,png|max:1024',
            'feedback_title' => 'required|string|min:3|max:30',
            'feedback_type' => 'required|string|in:Complaint,Suggestion',
            'feedback_message' =>  'required|string|min:3|max:100',
            'urgent' => 'required|boolean',
        ]);
        if (!$validator->fails()) {
            $feedback = new Feedback();
            $feedback->student_name = $request->input('std_name');
            $feedback->student_email = $request->input('std_email');
            $feedback->student_university_id = $request->input('std_id');
            $feedback->title = $request->input('feedback_title');
            $feedback->type = $request->input('feedback_type');
            $feedback->message = $request->input('feedback_message');
            $feedback->urgent = $request->input('urgent');
            if ($request->hasFile('std_image')) {
                $stdImage = $request->file('std_image');
                $imageName = time() . '_image_' . $feedback->student_name . '.' . $stdImage->getClientOriginalExtension();
                $stdImage->storePubliclyAs('students', $imageName, ['disk' => 'public']);
                $feedback->image = 'students/' . $imageName;
            }
            $saved = $feedback->save();
            // if ($saved) {
            //     Mail::to($request->user())->send(new UserWelcomeEmail($user));
            // }
            if ($saved) {
                Mail::to($feedback->student_email)->send(new FeedbackCreatedEmail($feedback));
                return response()->json(["message" => "Your feedback has been sent successfully"], Response::HTTP_CREATED);
            } else {
                return response()->json(["message" => "Failed to send feedback"], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

        // return response()->json(['message'=> 'success bro'], 400);
    }

    public function single(Request $request)
    {
        $request->validate([
            "feedback_id" => "required|numeric|exists:feedbacks,id"
        ]);
        // $feedback = Feedback::findOrFail($id);
        $id = $request->input('feedback_id');
        $feedback = Feedback::findOrFail($id);

        return response()->view('single_feedback', compact('feedback'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $request->validate([
        //     "feedback_id" => "required|numeric|exists:feedbacks,id"
        // ]);
        // // $feedback = Feedback::findOrFail($id);
        // // $id = $request->input('feedback_id');
        // if ($request->has('feedback_id')) {
        //     $feedback = Feedback::findOrFail($id);
        //     return response()->view('single_feedback', compact('feedback'));
        // } else {
        //     $feedback = null;
        //     return response()->view('single_feedback', compact('feedback'));
        // }


        $feedback = Feedback::findOrFail($id);
        return response()->view('single_feedback', compact('feedback'));


        // return response()->route('single_feedback', ['id' => $id, 'feedback' => $feedback]);
        // return response()->route('single_feedback');
        // return response()->json(['msg' => 'success'], 200)->redirect(view('single_feedback', ['id' => $id, 'feedback' => $feedback]));
        // return response()->json(['msg'=> "success"],200);

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
        $feedback = Feedback::findOrFail($id);
        return response()->view('dashboard.edit_feedback', ["feedback" => $feedback]);
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
        // 'status' => 'required|boolean',
        // 'status' => 'nullable|string|in:Open,Closed',
        $validator = Validator($request->all(), [
            'feedback_response' => 'required|string|max:200',
            'urgent' => 'required|boolean',
        ]);

        if (!$validator->fails()) {
            // if (!$request->has('response')) {
            // } else {
            // }
            $feedback = Feedback::findOrFail($id);
            $feedback->response = $request->input('feedback_response');
            $feedback->urgent = $request->input('urgent');
            $saved = $feedback->save();
            if ($saved) {
                Mail::to($feedback->student_email)->send(new ResponseAddedEmail($feedback));
                return response()->json(["message" => "Feedback Updated."], Response::HTTP_OK);
            } else {
                return response()->json(["message" => "Failed to update feedback."], Response::HTTP_UNPROCESSABLE_ENTITY);
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
        $feedback = Feedback::findOrFail($id);
        $deleted = $feedback->delete();
        // if ($deleted) {
        //     Storage::delete($feedback->image);
        // }

        // return redirect()->back();
        return response()->json(
            ['message' => $deleted ? "Moved To Trash Successfully" : "Failed to move to trash"],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    public function updateStatusClose(Request $request, $id)
    {
        $the_feedback = Feedback::findOrfail($id);
        $response = $the_feedback->response;
        $date = $the_feedback->closed_date;
        if (!is_null($response)) {
            if (is_null($date)) {
                $the_feedback->status = "Closed";
                $the_feedback->closed_date = now();
                $saved = $the_feedback->save();
                if ($saved) {
                    return  response()->json(["message" => "Status Updated, Feedback is now Closed"], Response::HTTP_OK);
                } else {
                    return response()->json(["message" => "Couldn't update feedback status"], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
            } else {
                return response()->json(["message" => "Already closed!"], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        } else {
            return response()->json(["message" => "Can't set to closed before adding a response"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function updateStatusOpen(Request $request, $id)
    {
        $f = Feedback::findOrfail($id);

        $date = $f->closed_date;
        $status = $f->status;
        if ($status == 'Closed' && !is_null($date)) {
            $f->closed_date = null;
            $f->status = 'Open';
            $saved = $f->save();
            if ($saved) {
                return response()->json(['message' => 'Status updated'], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Failed to update status'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => 'Error! Either status already closed'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function trash()
    {
        $feedbacks = Feedback::onlyTrashed()->orderBy('created_at')->get();
        return view('dashboard.trash', compact('feedbacks'));
    }
    public function restore(Request $request, $id)
    {
        $feedback = Feedback::onlyTrashed()->findOrFail($id);
        $restored = $feedback->restore();

        return response()->json(
            ['message' => $restored ? "Restored Successfully" : "Failed to Restore"],
            $restored ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
    public function forceDelete($id)
    {
        $feedback = Feedback::onlyTrashed()->findOrFail($id);
        $DELETED = $feedback->forceDelete();
        if ($DELETED && $feedback->image) {
            Storage::disk("public")->delete($feedback->image);
        }
        return response()->json(
            ['message' => $DELETED ? "DELETED Successfully" : "Failed to DELETE"],
            $DELETED ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
