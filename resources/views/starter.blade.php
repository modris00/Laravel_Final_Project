@extends('dashboard.parent')
@section('title', 'Home')
@section('content')
    <div class="content">
        <div class="container-fluid">
            {{-- <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>

                            <p class="card-text">
                                Some quick example text to build on the card title and make up the bulk of the
                                card's
                                content.
                                YYYYou have {{ $feedbacks_count }} and {{ $admins_count }}
                            </p>

                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>

                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>

                            <p class="card-text">
                                Some quick example text to build on the card title and make up the bulk of the
                                card's
                                content.
                            </p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div><!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Featured</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">Special title treatment</h6>

                            <p class="card-text">With supporting text below as a natural lead-in to additional
                                content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Featured</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">Special title treatment</h6>

                            <p class="card-text">With supporting text below as a natural lead-in to additional
                                content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div> --}}
            <!-- /.row -->
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Welcome <span
                                    class="text-primary">{{ auth('supervisor')->user()->name }}</span>, Here's an Overview
                            </h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                {{-- <thead>

                                </thead> --}}
                                <tbody>
                                    <tr>
                                        <th>Quick Actions</th>
                                        <td>
                                            <a href="{{ route('feedbacks.index') }}" type="button"
                                                class="btn btn-outline-primary btn-sm">All Feedbacks</a>
                                            <a href="{{ route('feedbacks.search') }}" type="button"
                                                class="btn btn-outline-primary btn-sm">Search</a>
                                            <a href="{{ route('admins.index') }}" type="button"
                                                class="btn btn-outline-success btn-sm">All Supervisors</a>
                                            <a href="{{ route('admins.create') }}" type="button"
                                                class="btn btn-outline-success btn-sm">New Supervisor</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total Feedbacks</th>
                                        <td class="text-primary font-weight-bolder">{{ $feedbacks_count }}</td>
                                    </tr>
                                    <tr>
                                        <th>Latest Feedback By</th>
                                        <td class="text-primary font-weight-bolder">{{ $latest_name }}</td>
                                    </tr>

                                    <tr>
                                        <th>Closed Feedbacks Count</th>
                                        <td class="text-primary font-weight-bolder">{{ $closed_feedbacks }}</td>
                                    </tr>

                                    <tr>
                                        <th>Total Supervisors</th>
                                        <td class="text-primary font-weight-bolder">{{ $admins_count }}</td>
                                    </tr>
                                    <tr>
                                        <th>Latest Supervisor Name</th>
                                        <td class="text-primary font-weight-bolder">{{$latest_admin_name}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-4">
                    @if ($urgent_with_no_response > 0)
                        <div class="card card-warning card-outline">
                            <div class="card-body">
                                <h5 class="card-title">Urgent Actions</h5>

                                <p class="card-text">
                                    {{-- There is/are <span class="text-danger"
                                        style="font-weight: bold">{{ $urgent_with_no_response }}</span> Urgent
                                    feedback(s) that hasn't/haven't been
                                    responded to by any of the supervisors --}}
                                    <span class="text-danger"
                                        style="font-weight: bold">{{ $urgent_with_no_response }}</span> Urgent feedback(s)
                                    need(s) to be checked by a supervisor
                                </p>
                                {{-- <a href="#" class="card-link">Latest Urgent Feedback</a> --}}
                                <a href="{{ route('feedbacks.index') }}" class="card-link" target="_blank">Go To
                                    Feedbacks</a>
                            </div>
                        </div><!-- /.card -->
                    @else
                        <div class="card card-success card-outline">
                            <div class="card-body">
                                <h5 class="card-title">Urgent Actions</h5>

                                <p class="card-text">
                                    No urgent actions right now :D
                                </p>
                                {{-- <a href="#" class="card-link">Latest Urgent Feedback</a> --}}
                                <a href="{{ route('feedbacks.index') }}" class="card-link">Go To
                                    Feedbacks</a>
                            </div>
                        </div><!-- /.card -->
                    @endif
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
