@extends('layouts.master')
@section('content')

    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit {{$task->text}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Errors</h4>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="form form-horizontal" action="{{route('tasks.update',$task->id)}}"
                                  method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <div class="form-body">
                                    <div class="col-12">
                                        @can('create tasks')
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Name</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input required type="text" class="form-control" name="text"
                                                           value="{{$task->text}}">
                                                </div>
                                            </div>
                                        @endcan
                                        @can('update tasks')
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Status</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input required type="text" class="form-control" name="status"
                                                           value="{{$task->status}}">
                                                </div>
                                            </div>
                                        @endcan
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
{{--                        <div class="d-flex justify-content-start align-items-center mb-1">--}}
{{--                            <div class="avatar mr-1">--}}
{{--                                <img src="../../../app-assets/images/profile/user-uploads/user-01.jpg" alt="avtar img holder" height="45" width="45">--}}
{{--                            </div>--}}
{{--                            <div class="user-page-info">--}}
{{--                                <p class="mb-0">Leeanna Alvord</p>--}}
{{--                                <span class="font-small-2">12 Dec 2018 at 1:16 AM</span>--}}
{{--                            </div>--}}
{{--                            <div class="ml-auto user-like text-danger"><i class="fa fa-heart"></i></div>--}}
{{--                        </div>--}}
{{--                        <p>I love jujubes wafer pie ice cream tiramisu. Chocolate I love pastry pastry sesame snaps wafer. Pastry topping biscuit lollipop topping I love lemon drops sweet roll bonbon. Brownie donut icing.</p>--}}
{{--                        <img class="img-fluid card-img-top rounded-sm mb-2" src="../../../app-assets/images/profile/post-media/2.jpg" alt="avtar img holder">--}}
{{--                        <div class="d-flex justify-content-start align-items-center mb-1">--}}
{{--                            <div class="d-flex align-items-center">--}}
{{--                                <i class="feather icon-heart font-medium-2 mr-50"></i>--}}
{{--                                <span>145</span>--}}
{{--                            </div>--}}
{{--                            <div class="ml-2">--}}
{{--                                <ul class="list-unstyled users-list m-0  d-flex align-items-center">--}}
{{--                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Trina Lynes" class="avatar pull-up">--}}
{{--                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-1.jpg" alt="Avatar" height="30" width="30">--}}
{{--                                    </li>--}}
{{--                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Lilian Nenez" class="avatar pull-up">--}}
{{--                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-2.jpg" alt="Avatar" height="30" width="30">--}}
{{--                                    </li>--}}
{{--                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Alberto Glotzbach" class="avatar pull-up">--}}
{{--                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-3.jpg" alt="Avatar" height="30" width="30">--}}
{{--                                    </li>--}}
{{--                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="George Nordic" class="avatar pull-up">--}}
{{--                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-5.jpg" alt="Avatar" height="30" width="30">--}}
{{--                                    </li>--}}
{{--                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Vinnie Mostowy" class="avatar pull-up">--}}
{{--                                        <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-4.jpg" alt="Avatar" height="30" width="30">--}}
{{--                                    </li>--}}
{{--                                    <li class="d-inline-block pl-50">--}}
{{--                                        <span>+140 more</span>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <p class="ml-auto d-flex align-items-center">--}}
{{--                                <i class="feather icon-message-square font-medium-2 mr-50"></i>77--}}
{{--                            </p>--}}
{{--                        </div>--}}
                        @foreach(\App\Models\Comment::where('task_id',$task->id)->get() as $comment)
                        <div class="d-flex justify-content-start align-items-center mb-1">
                            <div class="avatar mr-50">
                                <img src="{{asset(\App\Models\User::find($comment->user_id)->image)??''}}" alt="Avatar" height="30" width="30">
                            </div>
                            <div class="user-page-info">
                                <h6 class="mb-0">{{\App\Models\User::find($comment->user_id)->name??''}}</h6>
                                <span class="font-small-2">{{$comment->comment}}</span>
                            </div>
                        </div>
                        @endforeach
                        <form action="{{route('tasks.comment',$task->id)}}" method="post">
                            @csrf
                            <fieldset class="form-label-group mb-50">
                                <textarea name="comment" class="form-control" id="label-textarea" rows="3" placeholder="Add Comment"></textarea>
                                <label for="label-textarea">Add Comment</label>
                            </fieldset>
                            <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">Post Comment</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')

@endsection
