<div class="form-group">
    <h2>Результаты поиска: </h2>
</div>
@if($event)
<div class="form-group">
    <label for="recipient-name" class="col-form-label">Дата и Время последней записи</label>
    <input type="text" class="form-control" value="{{date("d-m-Y H:i", strtotime($event->start_time))}}" disabled>
    <label for="recipient-name" class="col-form-label">Телефон</label>
    <input type="tel" data-js="input" class="form-control" id="phone" placeholder="+7(000)000-00-00" value="{{$event->phone}}" disabled>
    <label for="recipient-name" class="col-form-label">Услуга</label>
    <input type="text" class="form-control" value="{{$service->name_service}} {{$service->price}} руб." disabled>
</div>
@endif
