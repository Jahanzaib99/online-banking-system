@extends('admin.layouts.main')
@section('content')
    <div class="app-content content list_custom_setting5">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Supplier Detail</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a> </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.supplier')}}">Suppliers</a> </li>
                                <li class="breadcrumb-item active">Supplier Detail</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success">
                    @if(is_array(session('success')))
                        <ul>
                            @foreach (session('success') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ session('success') }}
                    @endif
                </div>
            @endif
            <div class="content-body">
                <section id="user-profile-cards" class="row">
                    <div class="col-xl-3 col-md-3 col-12">
                        <div class="card border-amber border-lighten-2">
                            <div class="text-center">
                                <div class="card-body"> <img  class="img-fluid rounded-circle imgheight" height="220px" src="{{Storage::disk('public')->exists($data->profile_photo_path) ? Storage::disk('public')->url($data->profile_photo_path) : url(Storage::disk('public')->url('default.png'))}}" class="rounded-circle  height-150"
                                                              alt="Card image">
                                    <h4 class="card-title mt-1">{{$data->name}}</h4>
                                    <h6 class="card-subtitle text-muted">{{date('d M,Y',strtotime($data->created_at))}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-md-9 col-12">
                        <div class="content-body">
                            <section id="card-heading-color-options">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header card-head-inverse bg-dark">
                                                <h4 class="card-title text-white">Current Supplier Status: {{$data->supplier->account_status}}</h4>
                                            </div>
                                            <div class="card mb-0">
                                                <div class="card-header">
                                                    <div class="form-group row mb-1">
                                                        <div class="col-md-6 label-control" for="eventRegInput1"> <b>Trade Name: </b>{{$data->supplier->trade_name}}</div>
                                                        <div class="col-md-6 label-control" for="eventRegInput1"> <b>Contact Name: </b>{{$data->supplier->contact_name}}</div>
                                                        <div class="col-md-6 label-control pt-1" for="eventRegInput1"> <b>Country: </b>{{$data->supplier->country}}</div>
                                                        <div class="col-md-6 label-control pt-1" for="eventRegInput1"> <b>Business Type: </b>{{$data->supplier->business_type}}</div>
                                                        <div class="col-md-6 label-control pt-1" for="eventRegInput1"> <b>Company Registration Number: </b>{{$data->supplier->company_registration_number}}</div>
                                                        <div class="col-md-6 label-control pt-1" for="eventRegInput1"> <b>VehicleParts Deal: </b>{{$data->supplier->vehicle_parts_deal}}</div>

                                                        <div class="col-md-12 label-control pt-1" for="eventRegInput1"> <b>about: </b>{{$data->supplier->about}}</div>
                                                        <div class="col-md-12 mt-2">
                                                            <div class="row d-flex">

                                                                <div class="col-md-3"></div>


                                                                @if($data->supplier->account_status == "pending" || $data->supplier->account_status == "cancelled")
                                                                    <div class="col-md-3">
                                                                        <form class="d-inline-block float-right" method="post" action="{{route('admin.supplier.update',$data->supplier->id)}}" name="statusform" id="statusform">
                                                                            @csrf
                                                                            <input name="status" type="hidden" value="aproved">

                                                                            <button type="submit" class="btn pr-1 btn-warning d-block white btn-social text-center pr-1">
                                                                                <span class="ft-stop-circle font-medium-3"></span> Approved </button>

                                                                        </form>
                                                                    </div>
                                                                @endif
                                                                @if($data->supplier->account_status == "pending" || $data->supplier->account_status == "aproved")
                                                                    <div class="col-md-3">
                                                                        <form class="d-inline-block float-right" method="post" action="{{route('admin.supplier.update',$data->supplier->id)}}" name="statusform" id="statusform">
                                                                            @csrf
                                                                            <input name="status" type="hidden" value="cancelled">

                                                                            <button type="submit" class="btn pr-1 btn-warning d-block white btn-social text-center">
                                                                                <span class="ft-stop-circle font-medium-3"></span> Cancelled </button>

                                                                        </form>
                                                                    </div>
                                                                @endif

                                                                @if($data->supplier->account_status == "cancelled" || $data->supplier->account_status == "aproved")
                                                                    <div class="col-md-3 marginicon">
                                                                        <form class="d-inline-block float-right" method="post" action="{{route('admin.supplier.update',$data->supplier->id)}}" name="statusform" id="statusform">
                                                                            @csrf
                                                                            <input name="status" type="hidden" value="pending">

                                                                            <button type="submit" class="btn btn-danger d-block white btn-social text-center pr-1">
                                                                                <span class="la la-times font-medium-3"></span> Pending </button>

                                                                        </form>
                                                                    </div>
                                                                @endif
                                                                <div class="col-md-3 marginicon">
                                                                    <div class="form-actions"> <a href="#" class="btn btn-social btn-dark btn-dark text-center pr-1 float-right"> <span class="ft-arrow-left font-medium-3"></span> Go Back</a> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
