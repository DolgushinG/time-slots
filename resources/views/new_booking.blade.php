@extends('layouts.main')
@section('content')
    <!-- contact form start -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <div class="container">

        <div class="row">
            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body">
                        <ol class="activity-checkout mb-0 px-4 mt-3">
                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-alarm text-white font-size-20"></i>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
                                        <h5 class="font-size-20 mb-1">Выбор Даты и времени </h5>
                                        <p class="text-muted text-truncate mb-4"></p>
                                    </div>
                                    <div>
                                        <h5 class="font-size-14 mb-3"></h5>

                                        @foreach($months as $month)
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-6">
                                                    <div data-bs-toggle="collapse">
                                                        <label class="card-radio-label">
                                                            <input type="radio" data-id="month" data-ru="{{$month->ru_month}}" name="{{$month->format}}" id="{{$month->name}}" class="card-radio-input">
                                                            <span class="card-radio py-3 text-center text-truncate">
                                                       {{$month->ru_month}}
                                                    </span>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                        <div id="contentDays">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-receipt text-white font-size-20"></i>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
                                        <h5 class="font-size-20 mb-1"></h5>
                                        <div class="mb-3">
                                            <form>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="billing-name">Имя Фамилия</label>
                                                                <input type="text" class="form-control" id="first_last_name" placeholder="Введите имя">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="billing-phone">Телефон</label>
                                                                <input type="text" class="form-control" id="phone" placeholder="Введите Телефон">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle bg-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M11.42 21.815a1.004 1.004 0 0 0 1.16 0C12.884 21.598 20.029 16.44 20 10c0-4.411-3.589-8-8-8S4 5.589 4 9.996c-.029 6.444 7.116 11.602 7.42 11.819zM12 4c3.309 0 6 2.691 6 6.004c.021 4.438-4.388 8.423-6 9.731c-1.611-1.308-6.021-5.293-6-9.735c0-3.309 2.691-6 6-6z"/><path fill="currentColor" d="M11 14h2v-3h3V9h-3V6h-2v3H8v2h3z"/></svg>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
{{--                                        <h5 class="font-size-16 mb-1">Адрес</h5>--}}
{{--                                        <p class="text-muted text-truncate mb-4">Neque porro quisquam est</p>--}}
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6">
                                                    <div data-bs-toggle="collapse">
                                                        <label class="card-radio-label mb-0">
                                                            <input type="radio" name="address" id="info-address1" class="card-radio-input" checked="">
                                                            <div class="card-radio text-truncate p-3">
                                                                <span class="fs-14 mb-4 d-block">Адрес</span>
                                                                <span class="fs-14 mb-2 d-block">Салон красоты Ника</span>
                                                                <span class="text-muted fw-normal text-wrap mb-1 d-block">Санкт-Петербург ул. Седова 126</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-sm-6">
                                                    <div>
                                                        <label class="card-radio-label mb-0">
                                                            <input type="radio" name="address" id="info-address2" class="card-radio-input">
                                                            <div class="card-radio text-truncate p-3">
                                                                <iframe src="{{$google_iframe}}" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>;
                                                            </div>
                                                        </label>
                                                        <div class="edit-btn bg-light  rounded">
                                                            <a href="#" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit">
                                                                <i class="bx bx-pencil font-size-16"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-wallet-alt text-white font-size-20"></i>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
                                        <h5 class="font-size-20 mb-1">Выбор услуги </h5>
                                        <p class="text-muted text-truncate mb-4"></p>
                                    </div>
                                    <div>
                                        <h5 class="font-size-14 mb-3"></h5>
                                        @foreach($services as $service)
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-6">
                                                    <div data-bs-toggle="collapse">
                                                        <label class="card-radio-label">
                                                            <input type="radio" id="service_id" name="service_id" value="{{$service->id}}" class="card-radio-input">
                                                            <span class="card-radio py-3 text-center text-truncate" id="service_id_{{$service->id}}">
                                                        {{$service->name_service}} примерная цена <br> ({{$service->price}} руб)
                                                    </span>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Подтверждение оформление записи</h5>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                                    Назад
                                </button>
                            </div>
                            <div class="modal-body">

                                <div id="modal-text" class="form-group">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="book-submit" type="button" class="btn btn-save-change buttonload">
                                    Записаться</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="error-message" class="error-message text-danger"></div>
                <div class="row my-4">
                    <div class="col">
                        <div class="text-end mt-2 mt-sm-0">
                            <button type="button" id="modal-btn-next" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenteredScrollable">
                                Дальше
                            </button>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </div>

        </div>
        <!-- end row -->
    </div>
    <style>
        .card {
            margin-bottom: 24px;
            -webkit-box-shadow: 0 2px 3px #e4e8f0;
            box-shadow: 0 2px 3px #e4e8f0;
        }
        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #eff0f2;
            border-radius: 1rem;
        }
        .activity-checkout {
            list-style: none
        }

        .activity-checkout .checkout-icon {
            position: absolute;
            top: -4px;
            left: -24px
        }

        .activity-checkout .checkout-item {
            position: relative;
            padding-bottom: 24px;
            padding-left: 35px;
            border-left: 2px solid #3b76e1
        }

        .activity-checkout .checkout-item:first-child {
            border-color: #3b76e1
        }

        .activity-checkout .checkout-item:first-child:after {
            background-color: #3b76e1
        }

        .activity-checkout .checkout-item:last-child {
            border-color: transparent
        }

        .activity-checkout .checkout-item.crypto-activity {
            margin-left: 50px
        }

        .activity-checkout .checkout-item .crypto-date {
            position: absolute;
            top: 3px;
            left: -65px
        }



        .avatar-xs {
            height: 1rem;
            width: 1rem
        }

        .avatar-sm {
            height: 2rem;
            width: 2rem
        }

        .avatar {
            height: 3rem;
            width: 3rem
        }

        .avatar-md {
            height: 4rem;
            width: 4rem
        }

        .avatar-lg {
            height: 5rem;
            width: 5rem
        }

        .avatar-xl {
            height: 6rem;
            width: 6rem
        }

        .avatar-title {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            background-color: #3b76e1;
            color: #fff;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            font-weight: 500;
            height: 100%;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            width: 100%
        }

        .avatar-group {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding-left: 8px
        }

        .avatar-group .avatar-group-item {
            margin-left: -8px;
            border: 2px solid #fff;
            border-radius: 50%;
            -webkit-transition: all .2s;
            transition: all .2s
        }

        .avatar-group .avatar-group-item:hover {
            position: relative;
            -webkit-transform: translateY(-2px);
            transform: translateY(-2px)
        }

        .card-radio {
            background-color: #fff;
            border: 2px solid #eff0f2;
            border-radius: .75rem;
            padding: .5rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: block
        }

        .card-radio:hover {
            cursor: pointer
        }

        .card-radio-label {
            display: block
        }

        .edit-btn {
            width: 35px;
            height: 35px;
            line-height: 40px;
            text-align: center;
            position: absolute;
            right: 25px;
            margin-top: -50px
        }

        .card-radio-input {
            display: none
        }

        .card-radio-input:checked+.card-radio {
            border-color: #3b76e1!important
        }


        .font-size-16 {
            font-size: 16px!important;
        }
        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        a {
            text-decoration: none!important;
        }


        .form-control {
            display: block;
            width: 100%;
            padding: 0.47rem 0.75rem;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #545965;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #e2e5e8;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.75rem;
            -webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
        }

        .edit-btn {
            width: 35px;
            height: 35px;
            line-height: 40px;
            text-align: center;
            position: absolute;
            right: 25px;
            margin-top: -50px;
        }

        .ribbon {
            position: absolute;
            right: -26px;
            top: 20px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            padding: 1px 22px;
            font-size: 13px;
            font-weight: 500
        }

    </style>
<script type="text/javascript" src="{{ asset('js/booking.js') }}"></script>
@endsection('content')
