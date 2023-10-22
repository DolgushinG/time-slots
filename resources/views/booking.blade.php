@extends('layouts.main')
@section('content')
<!-- contact form start -->
    <section class="contact-form">
    <div class="container">
        <form id="contact-form">
            @csrf
            <driv class="form-row">
                <h1><label for="inputState">Место</label></h1>
            </driv>
            <iframe src="{{$google_iframe}}" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>;
            <div class="form-row">
{{--                <iframe src="https://www.google.com/maps/embed/v1/place?q=Saint-Petersurg+Studiya+Krasoty+%22Nika%22&amp;key=AIzaSyBSFRN6WWGYwmFi498qXXsD2UwkbmD74v4&hl=ru" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width: 100%; height: 360px;"></iframe>--}}
                <h1><label for="inputState">Выберите Дату</label></h1>
            </div>
            <div class="form-row">
                <h2><label for="inputState">Месяц</label></h2>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    @foreach($months as $month)
                        <button type="button" class="btn btn-warning" data-id="month" id="{{$month->name}}" name="{{$month->format}}" >{{$month->ru_month}}</button>
                    @endforeach
                    <div id="contentDays">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Имя и Фамилия</label>
                <input id="first_last_name" name="name" type="text" class="form-control" placeholder="Ваше Имя и Фамилия" required>
            </div>
            <div class="form-group">
                <label for="inputAddress2">Телефон</label>
                <input id="phone" name="phone" type="tel" class="form-control" placeholder="Телефон +7 ХХХ ХХХ ХХ ХХ" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputState">Услуга</label>
                    <select id="service_id" class="form-control" required>
                    @foreach($services as $service)
                        <option value="{{$service->id}}" >{{$service->name_service}} примерная цена ({{$service->price}} руб)</option>
                    @endforeach
                    </select>
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
            <button type="button" id="modal-btn-next" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenteredScrollable">
                Дальше
            </button>
        </form>
        </div>
    </section>
    <script type="text/javascript" src="{{ asset('js/booking.js') }}"></script>
@endsection('content')
