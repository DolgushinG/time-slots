<div class="form-row pt-2">
    <h2>
        <label for="inputState">Число</label>
    </h2>
</div>
<div class="btn-group btn-group-toggle" id="days" data-toggle="buttons">
    <div class="container">
    @foreach($remaining_days as $day)
        <label class="btn btn-group-sm btn-warning days">
            <input type="radio" id="{{$day->format}}" name={{$day->format}} hidden> {{$day->day}} {{ trans('days.'.$day->day_of_week) }}
        </label>
    @endforeach
    </div>
</div>

<div id="contentTimeSlot">
</div>
<script>
    var wrapper_days = document.getElementById('days');

    wrapper_days.addEventListener('click', (event) => {
        const isInput = event.target.nodeName === 'INPUT';
        if (!isInput) {
            return;
        }
        event.preventDefault();
        getTimeSlots(event.target.id)
    })
    function getTimeSlots(date)
    {
        $.ajax({
            type: 'GET',
            url: 'getTimeSlots',
            data: {
                date: date,
            },
            success: function(data) {
                let contentTimeSlot = $('#contentTimeSlot')
                contentTimeSlot.text('').append('<div class="d-flex align-items-center"><strong>Поиск свободного времени...</strong>' +
                    '<div class="spinner-border ml-auto" role="status" aria-hidden="true"></div></div>')
                setTimeout(function () {
                    contentTimeSlot.html(data);
                }, 2000);

            },
            error: function(data) {
            }
        });
    }
</script>
