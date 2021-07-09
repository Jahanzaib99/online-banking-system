<script src="{{asset('public/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/timeline/horizontal-timeline.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/core/app.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/validations.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/custome.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"  type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"  type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/image-uploader.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/extensions/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/extensions/sweet-alerts.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/select/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/forms/validation/form-validation.js')}}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">

    $(function () {
        var table = $('#requestorder').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('request.order') }}",

            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'sparePartType.title'},
                {data: 'colour', name: 'sparePartType.colour'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });

        var table = $('#offer_list').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('supplier.offer.list') }}",

            columns: [

                {data: 'id', name: 'id'},
                {data: 'title', name: 'sparePartType.title'},
                {data: 'name', name: 'reciever.name'},
                {data: 'colour', name: 'colour'},
                {data: 'size', name: 'size'},
                {data: 'price', name: 'price'},
                {data: 'description', name: 'description'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });

        var table = $('#purchased_item').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('purchase.item.list') }}",

            columns: [

                {data: 'id', name: 'id'},
                {data: 'title', name: 'sparePartType.title'},
                {data: 'name', name: 'reciever.name'},
                {data: 'colour', name: 'colour'},
                {data: 'size', name: 'size'},
                {data: 'price', name: 'price'},
                {data: 'description', name: 'description'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });
        setInterval(function(){
            $('.getProductData').click(function (ev) {
                ev.preventDefault();
                let image = $(this).data('img');
                let id = $(this).data('id');
                let size = $(this).data('size');
                let price = $(this).data('price');
                let description = $(this).data('description');
                let colour = $(this).data('colour');
                let supplier_id = $(this).data('supplier_id');
                $('#item_img').attr('src', image);
                $('#size').val(size);
                $('#price').val(price);
                $('#description').val(description);
                $('#colour').val(colour);
                $('#supplier_id').val(supplier_id);
                $('#id').val(id);
                $('#getData').modal('show');
            });
        }, 3000);

        $("#purchase").click(function(e){

            e.preventDefault();
            let id = $('#id').val();
            let quantity = $('#quantity').val();
            let colour = $('#colour').val();
            let size = $('#size').val();
            let description = $('#description').val();
            let price = $('#price').val();
            let supplier_id = $('#supplier_id').val();

            $.ajax({
                type:'POST',
                url:"{{ route('purchase') }}",
                data:{
                    id: id,
                    quantity: quantity,
                    supplier_id: supplier_id,
                    _token: $('meta[name="csrf-token"]').attr('content')},
                success:function(data){
                    toastr.success(data.message);
                    $('#getData').modal('hide');
                }
            });

        });


        // $(document).ready(function() {
        //     $('#getProductData').on('click', function (ev) {
        //         console.log('herer');
        //         $('#getData').modal('show');
        //     });
        // });
    });

</script>



