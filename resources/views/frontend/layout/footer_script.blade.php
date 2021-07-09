<script src="https://kit.fontawesome.com/8ba63b2a58.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="{{asset('public/frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('public/frontend/assets/js/main.js')}}"></script>

<script>
    $(document).ready(function(){
        $('.customer-logos').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 1500,
            arrows: false,
            dots: false,
            pauseOnHover:false,
            responsive: [{
                breakpoint: 768,
                setting: {
                    slidesToShow:3
                }
            }, {
                breakpoint: 900,
                setting: {
                    slidesToShow: 3
                }
            }]
        });
    });
    $('.how-it-cards').slick({
        arrows: false,
        dots: false
    });

</script>




