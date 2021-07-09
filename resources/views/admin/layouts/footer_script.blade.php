<script src="{{asset('public/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/timeline/horizontal-timeline.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/core/app.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/validations.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/custome.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"
        type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"
        type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/image-uploader.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/extensions/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/extensions/sweet-alerts.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/select/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"
        type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"
        type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('public/app-assets/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/app-assets/js/scripts/forms/validation/form-validation.js')}}"
        type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
@if(auth()->user()->user_type == "Admin")
    @php
        $route =   route('admin.sales');
    @endphp
@else
    @php
        $route =   route('supplier.order');
    @endphp
@endif
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">

    $(function () {
        // jQuery('#loading').fadeOut(3000);
        setInterval(function () {
            $('.editUser').on('click', function (e) {
                e.preventDefault();
                $('#userId').val($(this).attr('data-id'));
                $('#first_name').val($(this).attr('data-first_name'));
                $('#last_name').val($(this).attr('data-last_name'));
                $('#phone').val($(this).attr('data-phone'));
                $('#city').val($(this).attr('data-city'));
                $('#country').val($(this).attr('data-country'));
                $('#email').val($(this).attr('data-email'));
                $('#avatar').attr("src", ($(this).attr('data-avatar')) ? $(this).attr('data-avatar') : "https://lh3.googleusercontent.com/LfmMVU71g-HKXTCP_QWlDOemmWg4Dn1rJjxeEsZKMNaQprgunDTtEuzmcwUBgupKQVTuP0vczT9bH32ywaF7h68mF-osUSBAeM6MxyhvJhG6HKZMTYjgEv3WkWCfLB7czfODidNQPdja99HMb4qhCY1uFS8X0OQOVGeuhdHy8ln7eyr-6MnkCcy64wl6S_S6ep9j7aJIIopZ9wxk7Iqm-gFjmBtg6KJVkBD0IA6BnS-XlIVpbqL5LYi62elCrbDgiaD6Oe8uluucbYeL1i9kgr4c1b_NBSNe6zFwj7vrju4Zdbax-GPHmiuirf2h86eKdRl7A5h8PXGrCDNIYMID-J7_KuHKqaM-I7W5yI00QDpG9x5q5xOQMgCy1bbu3St1paqt9KHrvNS_SCx-QJgBTOIWW6T0DHVlvV_9YF5UZpN7aV5a79xvN1Gdrc7spvSs82v6gta8AJHCgzNSWQw5QUR8EN_-cTPF6S-vifLa2KtRdRAV7q-CQvhMrbBCaEYY73bQcPZFd9XE7HIbHXwXYA=s200-no")
                $('#editUserModal').modal('show');
            });
            $('.editBeneficiary').on('click', function (e) {
                e.preventDefault();
                $('#beneficiaryId').val($(this).attr('data-id'));
                $('#user_name').val($(this).attr('data-user_name'));
                $('#IBAN').val($(this).attr('data-IBAN'));
                $('#acc_number').val($(this).attr('data-acc_number'));
                $('#editBeneficiary').modal('show');
            });
            $('.transfer').on('click', function (e) {
                e.preventDefault();
                $('#user_id').val($(this).attr('data-id'));
                $('#transferUserModal').modal('show');
            });
        }, 3000)


        $("#wizard-picture").change(function () {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


        var table = $('#adminsupplier').DataTable({

            processing: true,

            serverSide: true,

            "scrollX": true,

            ajax: "{{ route('admin.user') }}",

            columns: [

                {data: 'avatar', name: 'avatar'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'city', name: 'city'},
                {data: 'country', name: 'country'},
                {data: 'balance', name: 'balance'},
                {data: 'acc_number', name: 'acc_number'},
                {data: 'IBAN', name: 'IBAN'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });

        var table = $('#beneficiaryTable').DataTable({

            processing: true,

            serverSide: true,

            // "scrollX": true,

            ajax: "{{ route('beneficiary.index') }}",

            columns: [
                {data: 'user_name', name: 'user_name'},
                {data: 'IBAN', name: 'IBAN'},
                {data: 'acc_number', name: 'acc_number'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]

        });

        var table = $('#offer_list').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('offer.list') }}",

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
    });

    document.onreadystatechange = function () {
        var state = document.readyState
        if (state == 'complete') {
            setTimeout(function() {
                document.getElementById('interactive');
                document.getElementById('loading').style.visibility="hidden";
            },1000);
        }
    }

    {{--$('#post-user').submit(function(e) {--}}
    {{--    e.preventDefault();--}}
    {{--    let formData = new FormData(this);--}}
    {{--    $('#image-input-error').text('');--}}

    {{--    $.ajax({--}}
    {{--        type:'POST',--}}
    {{--        url: `{{route('user.register')}}`,--}}
    {{--        data: formData,--}}
    {{--        contentType: false,--}}
    {{--        processData: false,--}}
    {{--        success: (response) => {--}}
    {{--            if (response) {--}}
    {{--                this.reset();--}}
    {{--                toastr.success('User created successfully')--}}
    {{--            }--}}
    {{--        },--}}
    {{--        error: function(response){--}}
    {{--            console.log(response);--}}
    {{--            $('#image-input-error').text(response.responseJSON.error);--}}
    {{--        }--}}
    {{--    });--}}
    {{--});--}}


</script>



