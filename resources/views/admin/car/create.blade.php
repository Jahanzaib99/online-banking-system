@extends('admin.layouts.main')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Cars</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('model.index')}}">Cars</a>
                                </li>
                                <li class="breadcrumb-item active">Create Car
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
                                    <h4 class="card-title">Car Form</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <form class="form-horizontal" action="{{route('car.store')}}" method="post" enctype="multipart/form-data"  novalidate>
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <h5>Ttile
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="title" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Model
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <select name="model" id="select" required class="form-control">
                                                                <option value="">Select Status</option>
                                                                @foreach($model as $mod)
                                                                    <option value="{{$mod->id}}">{{$mod->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Mileage
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="number" name="mileage" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Registration
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="registration" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Fuel
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="fuel" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Engine
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="engine" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Trim
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="trim" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <h5>Make
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <select name="make" id="select" required class="form-control">
                                                                <option value="">Select Status</option>
                                                                @foreach($make as $row)
                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Year
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="number" name="year" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Transmission
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="transmission" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Description
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="description" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Body
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="body" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>GearBox
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="gearbox" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Icon
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="file" name="image" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-success">Submit <i class="la la-thumbs-o-up position-right"></i></button>
                                                        <button type="reset" class="btn btn-danger">Reset <i class="la la-refresh position-right"></i></button>
                                                    </div>
                                                </div>
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
