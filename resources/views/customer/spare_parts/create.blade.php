@extends('admin.layouts.main')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Spare parts</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('sparepart.index')}}">Spare parts</a>
                                </li>
                                <li class="breadcrumb-item active">Create spare part
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
                                    <h4 class="card-title">Spare parts Form</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <form class="form-horizontal" action="{{route('sparepart.store')}}" method="post" enctype="multipart/form-data"  novalidate>
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <h5>Title
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="title" class="form-control" required data-validation-required-message="This field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Car
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <select name="car_id" id="select" required class="form-control">
                                                                <option value="">Select Car</option>
                                                                @foreach($cars as $car)
                                                                    <option value="{{$car->id}}">{{$car->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <h5>Price
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="number" name="price" class="form-control" required data-validation-required-message="This field is required">
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
                                                        <h5>Image
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
