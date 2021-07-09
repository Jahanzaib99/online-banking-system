@extends('customer.layouts.main')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Spare parts</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('breaker.home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active"> All Supplier Offer
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <button class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2"
                                id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><i class="ft-settings icon-left"></i> Settings</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="card-bootstrap.html">Cards</a><a class="dropdown-item"
                                                                                                                                                   href="component-buttons-extended.html">Buttons</a></div>
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
                                    <h4 class="card-title">Supplier Offer</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                                        <table class="table table-bordered data-table" id="offer_list">

                                            <thead>

                                            <tr>

                                                <th>No</th>

                                                <th>Titile</th>

                                                <th>Supplier Name</th>

                                                <th>Colour</th>

                                                <th>Size</th>

                                                <th>Price</th>

                                                <th>Desciption</th>

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

    <div class="modal" id="getData" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Image</h4>
                    <img id="item_img" width="200px">
                    <br><br>
                    <input type="hidden" id="id">
                    <input type="hidden" id="supplier_id">
                    <h4>Quantity</h4>
                    <input type="number" class="form-control" name="quantity" id="quantity">
                    <br>
                    <h4>Price</h4>
                    <input type="text" class="form-control" name="price" id="price" readonly>
                    <br>
                    <h4>Colour</h4>
                    <input type="text" class="form-control" name="colour" id="colour" readonly>
                    <br>
                    <h4>Size</h4>
                    <input type="text" class="form-control" name="size" id="size" readonly>
                    <br>
                    <h4>Description</h4>
                    <input type="text" class="form-control" name="description" id="description" readonly>
                </div>
                <div class="modal-footer">
                    <a id="purchase" class="btn btn-primary">Purchase</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script  type="text/javascript">
        // $(document).ready(function() {
        //     $('#getProductData').on('click', function (ev) {
        //         console.log('herer');
        //         $('#getData').modal('show');
        //     });
        // });
    </script>
@endsection

