@extends('admin.layouts.main')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">User</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href=""{{route('admin.user')}}>User</a>
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
                            <i class="ft-plus icon-left"></i>Add user
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
                                    <h4 class="card-title">User</h4>
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
                                        <table class="table table-bordered data-table" id="adminsupplier">
                                            <thead>
                                            <tr>
                                                <th>Profile Image</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>Country</th>
                                                <th>Balance</th>
                                                <th>Account number</th>
                                                <th>IBAN</th>
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
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('user.register')}}" method="post" id="post-user" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="picture-container">
                            <div class="picture">
                                <img
                                    src="https://lh3.googleusercontent.com/LfmMVU71g-HKXTCP_QWlDOemmWg4Dn1rJjxeEsZKMNaQprgunDTtEuzmcwUBgupKQVTuP0vczT9bH32ywaF7h68mF-osUSBAeM6MxyhvJhG6HKZMTYjgEv3WkWCfLB7czfODidNQPdja99HMb4qhCY1uFS8X0OQOVGeuhdHy8ln7eyr-6MnkCcy64wl6S_S6ep9j7aJIIopZ9wxk7Iqm-gFjmBtg6KJVkBD0IA6BnS-XlIVpbqL5LYi62elCrbDgiaD6Oe8uluucbYeL1i9kgr4c1b_NBSNe6zFwj7vrju4Zdbax-GPHmiuirf2h86eKdRl7A5h8PXGrCDNIYMID-J7_KuHKqaM-I7W5yI00QDpG9x5q5xOQMgCy1bbu3St1paqt9KHrvNS_SCx-QJgBTOIWW6T0DHVlvV_9YF5UZpN7aV5a79xvN1Gdrc7spvSs82v6gta8AJHCgzNSWQw5QUR8EN_-cTPF6S-vifLa2KtRdRAV7q-CQvhMrbBCaEYY73bQcPZFd9XE7HIbHXwXYA=s200-no"
                                    class="picture-src" id="wizardPicturePreview" title="">
                                <input type="file" id="wizard-picture" class="" name="avatar">
                            </div>
                            <h6 class="">Upload Image</h6>
                        </div>
                        <div class="form-group">
                            <h5>First name
                                <span class="required">*</span>
                            </h5>
                            <div class="controls">
                                <input type="text" name="first_name" value="" class="form-control" required
                                       data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Last Name
                                <span class="required">*</span>
                            </h5>
                            <div class="controls">
                                <input type="text" name="last_name" value="" class="form-control" required
                                       data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Email
                                <span class="required">*</span>
                            </h5>
                            <div class="controls">
                                <input type="email" name="email" value="" class="form-control" required
                                       data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Phone
                            </h5>
                            <div class="controls">
                                <input type="number" name="phone" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>City</h5>
                            <div class="controls">
                                <input type="text" name="city" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Country</h5>
                            <div class="controls">
                                <input type="text" name="country" value="" class="form-control">
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
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.user.update')}}" method="post" id="post-user" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="userId" value="">
                    <div class="modal-body">
                        <div class="picture-container">
                            <div class="picture">
                                <img
                                    src="https://lh3.googleusercontent.com/LfmMVU71g-HKXTCP_QWlDOemmWg4Dn1rJjxeEsZKMNaQprgunDTtEuzmcwUBgupKQVTuP0vczT9bH32ywaF7h68mF-osUSBAeM6MxyhvJhG6HKZMTYjgEv3WkWCfLB7czfODidNQPdja99HMb4qhCY1uFS8X0OQOVGeuhdHy8ln7eyr-6MnkCcy64wl6S_S6ep9j7aJIIopZ9wxk7Iqm-gFjmBtg6KJVkBD0IA6BnS-XlIVpbqL5LYi62elCrbDgiaD6Oe8uluucbYeL1i9kgr4c1b_NBSNe6zFwj7vrju4Zdbax-GPHmiuirf2h86eKdRl7A5h8PXGrCDNIYMID-J7_KuHKqaM-I7W5yI00QDpG9x5q5xOQMgCy1bbu3St1paqt9KHrvNS_SCx-QJgBTOIWW6T0DHVlvV_9YF5UZpN7aV5a79xvN1Gdrc7spvSs82v6gta8AJHCgzNSWQw5QUR8EN_-cTPF6S-vifLa2KtRdRAV7q-CQvhMrbBCaEYY73bQcPZFd9XE7HIbHXwXYA=s200-no"
                                    class="picture-src" id="wizardPicturePreview" id="avatar" title="">
                                <input type="file" id="wizard-picture" class="" name="avatar">
                            </div>
                            <h6 class="">Upload Image</h6>
                        </div>
                        <div class="form-group">
                            <h5>First name
                                <span class="required">*</span>
                            </h5>
                            <div class="controls">
                                <input type="text" name="first_name" id="first_name" value="" class="form-control" required
                                       data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Last Name
                                <span class="required">*</span>
                            </h5>
                            <div class="controls">
                                <input type="text" name="last_name" id="last_name" value="" class="form-control" required
                                       data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Email
                                <span class="required">*</span>
                            </h5>
                            <div class="controls">
                                <input type="email" name="email" id="email" value="" class="form-control" required
                                       data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Phone
                            </h5>
                            <div class="controls">
                                <input type="number" name="phone" id="phone" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>City</h5>
                            <div class="controls">
                                <input type="text" name="city" id="city" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Country</h5>
                            <div class="controls">
                                <input type="text" name="country" id="country" value="" class="form-control">
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
                <form action="{{route('admin.user.transaction')}}" method="post" id="post-user" enctype="multipart/form-data">
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
