<!DOCTYPE html>

<html lang="en">
<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>Запись на маникюр</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Nail master">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Dolgushin G.V">
  <meta name="theme-name" content="space_nail">
{{--  <meta name="generator" content="Themefisher Airspace Template v1.0">--}}
  <!-- Favicon -->
  <link rel="shortcut icon" type="{{asset('storage/image/x-icon')}}" href="images/favicon.png" />
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/maskedinput.min.js')}}" ></script>

  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap/bootstrap.min.css')}}">
  <!-- Ionic Icon Css -->
  <link rel="stylesheet" href="{{asset('plugins/Ionicons/css/ionicons.min.css')}}">
  <!-- animate.css -->
  <link rel="stylesheet" href="{{asset('plugins/animate-css/animate.css')}}">
  <!-- Magnify Popup -->
  <link rel="stylesheet" href="{{asset('plugins/magnific-popup/magnific-popup.css')}}">
  <!-- Slick CSS -->
  <link rel="stylesheet" href="{{asset('plugins/slick/slick.css')}}">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
<body id="body">
<!-- Header Start -->
<header class="navigation">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<nav class="navbar navbar-expand-lg p-0">
					<a class="navbar-brand" href="{{route('welcome')}}">
                        Запись на маникюр Space Nail
					</a>
					<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
						<span class="ion-android-menu"></span>
					</button>
					<div class="collapse navbar-collapse ml-auto" id="navbarsExample09">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item active">
								<a class="nav-link" href="{{route('booking')}}">Запись</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header><!-- header close -->

@yield('content')


  <!-- footer Start -->
<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
                <div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Поиск записи по телефону</h5>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                                    Назад
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    @csrf
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Введите телефон</label>
                                        <input type="tel" data-js="input" class="form-control" id="phone" placeholder="+7(000)000-00-00" required>
                                    </div>
                                </form>
                                <div id="modal-text-find" class="form-group">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="book-find" type="button" class="btn btn-save-change buttonload">
                                    Найти</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-md mb-5">
                    <div id="error-message" class="error-message text-danger"></div>
                    <button type="button" id="modal-btn-find" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenteredScrollable">
                        Найти свою запись
                    </button>
                </div>
				<div class="footer-manu">
                    <ul class="social-icons">
                        <li>
                            <a href="https://instagram.com/space_nailspb?igshid=MzRlODBiNWFlZA=="><i class="ion-social-instagram"></i></a>
                        </li>
                        <li>
                            <a href="https://wa.me/79992003361"><i class="ion-social-whatsapp"></i></a>
                        </li>
                        <li>
                            <a  href="http://t.me/79992003361"><svg style="margin-bottom: 11px;!important;" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"/>
                                </svg></a>
                        </li>
                    </ul>
				</div>
				<p class="copyright mb-0">Copyright <script>document.write(new Date().getFullYear())</script> &copy; Designed & Developed by <a
						href="">Dolgushin Georgii</a>. All rights reserved.
				</p>
			</div>
		</div>
	</div>
</footer>
<script>
    $("input[id=phone]").mask("+7 (999) 999-99-99");
    $(document).on('click','#book-find', function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let phone = document.querySelector('#phone').value
        let form = $('#modal-text-find')
        let button = $('#book-find')
        e.preventDefault()
        $.ajax({
            type: 'GET',
            url: '/getBooked',
            data: {'phone': phone},
            success: function(data) {
                button.removeClass('btn-save-change')
                button.addClass('btn-edit-change')
                button.text('').append('<i id="spinner" style="margin-left: -12px;\n' +
                    '    margin-right: 8px;" class="fa fa-spinner fa-spin"></i> Обработка...')
                setTimeout(function () {
                    form.html(data);
                    button.text('Найти новую запись')
                }, 3000);

            },
            error: function(xhr, status, error) {
                button.text('').append('<i id="spinner" style="margin-left: -12px;\n' +
                    '    margin-right: 8px;" class="fa fa-spinner fa-spin"></i> Обработка...')
                setTimeout(function () {
                    button.removeClass('btn-save-change')
                    button.addClass('btn-failed-change')
                    button.text(xhr.responseJSON.message)
                }, 3000);
                setTimeout(function () {
                    button.removeClass('btn-failed-change')
                    button.addClass('btn-save-change')
                    button.text('Найти')
                }, 6000);

            }
        });
    });
</script>
<!--Scroll to top-->
<div id="scroll-to-top" class="scroll-to-top">
	<span class="icon ion-ios-arrow-up"></span>
</div>

</head>

    <!--
    Essential Scripts
    =====================================-->


{{--    <!-- Main jQuery -->--}}

    <!-- Bootstrap 3.1 -->
    <script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>
    <!-- slick Carousel -->
    <script src="{{asset('plugins/slick/slick.min.js')}}"></script>
    <script src="{{asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <!-- filter -->
    <script src="{{asset('plugins/shuffle/shuffle.min.js')}}"></script>
    <script src="{{asset('plugins/SyoTimer/jquery.syotimer.min.js')}}"></script>
    <!-- Google Map -->
    <script src="{{asset('plugins/google-map/map.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>

    </body>

    </html>
