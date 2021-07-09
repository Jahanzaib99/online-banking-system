@extends('admin.layouts.main')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Profile</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Profile
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success"> @if(is_array(session('success')))
                        <ul>
                            @foreach (session('success') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ session('success') }}
                    @endif </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="content-body">
                <!-- Input Validation start -->
                <section class="input-validation">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Profile settings</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form-horizontal" action="{{route('profile.update', auth()->user()->id)}}" method="post" enctype="multipart/form-data"  novalidate>
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <h5>Name
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="first_name" value="{{$data->first_name}}" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Last name
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="last_name" value="{{$data->last_name}}" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Email
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="email" value="{{$data->email}}" name="email" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Phone
                                                            <span class="Phone">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="phone" value="{{$data->phone}}" class="form-control" data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Password</h5>
                                                        <div class="controls">
                                                            <input type="password" name="password" value="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-success">Update <i class="la la-thumbs-o-up position-right"></i></button>
                                                        <button type="reset" class="btn btn-danger">Reset <i class="la la-refresh position-right"></i></button>
                                                    </div>
                                                </div>
{{--                                                <div class="">--}}
{{--                                                    <div class="text-right">--}}
{{--                                                        <button type="submit" class="btn btn-success">Submit <i class="la la-thumbs-o-up position-right"></i></button>--}}
{{--                                                        <button type="reset" class="btn btn-danger">Reset <i class="la la-refresh position-right"></i></button>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Switch Validation end -->
            </div>
        </div>
    </div>
@endsection
