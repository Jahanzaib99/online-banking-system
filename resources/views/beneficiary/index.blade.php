@extends('admin.layouts.main')
@section('content')
    <div id="loading"></div>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Beneficiary</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href=""{{route('beneficiary.index')}}>Beneficiary</a>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>

                <div class="content-header-right col-md-6 col-12">
                    <div class="float-md-right">
                        {{--                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
                        {{--                            Launch demo modal--}}
                        {{--                        </button>--}}
                        <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                            <i class="ft-plus icon-left"></i>Add Beneficiary
                        </button>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- HTML (DOM) sourced data -->
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
                <section id="html">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Beneficiary</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body card-dashboard">
                                        <table class="table table-bordered data-table"  id="beneficiaryTable" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>IBAN</th>
                                                <th>Account number</th>
                                                <th>Created At</th>
                                                <th width="100px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!--/ Javascript sourced data -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Beneficiary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('beneficiary.store')}}" method="post" id="post-user" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>Username
                                <span class="required">*</span>
                            </h5>
                            <div class="controls">
                                <input type="text" name="user_name" value="" class="form-control" required
                                       data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>IBAN
                                <span class="required">*</span>
                            </h5>
                            <div class="controls">
                                <input type="text" name="IBAN" value="" class="form-control" required
                                       data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Account number
                                <span class="required">*</span>
                            </h5>
                            <div class="controls">
                                <input type="number" name="acc_number" value="" class="form-control" required
                                       data-validation-required-message="This field is required">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editBeneficiary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Beneficiary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('beneficiary.update')}}" method="post" id="post-beneficiary" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="beneficiaryId" value="">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>User name
                                <span class="required">*</span>
                            </h5>
                            <div class="controls">
                                <input type="text" name="user_name" id="user_name" value="" class="form-control" required
                                       data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>IBAN
                                <span class="required">*</span>
                            </h5>
                            <div class="controls">
                                <input type="text" name="IBAN" id="IBAN" value="" class="form-control" required
                                       data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Account number
                                <span class="required">*</span>
                            </h5>
                            <div class="controls">
                                <input type="text" name="acc_number" id="acc_number" class="form-control" required
                                       data-validation-required-message="This field is required">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="transferUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Credit Amount</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('beneficiary.transaction')}}" method="post" id="post-user" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="user_id" value="">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>Amount
                                <span class="required">*</span>
                            </h5>
                            <div class="controls">
                                <input type="text" name="amount" id="amount" value="" class="form-control" required
                                       data-validation-required-message="Amount field is required">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

