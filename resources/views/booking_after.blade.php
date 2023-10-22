@extends('layouts.main')
@section('content')
<section class="coming-soon text-center overly">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="block">
					<h1>Ваша запись - №{{ $booking->id }} успешна создана </h1>
                    <br>
                    <h2>Имя и Фамилия - {{ $booking->name }}</h2>
                    <br>
                    <h2>Номер телефона - {{ $booking->phone }}</h2>
                    <br>
					<h2>Дата и время  - {{ $booking->start_time }}</h2>
                    <br>
					<h2>Услуга и цена  - {{ $service->name_service }} - {{$service->price}}</h2>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection('content')
