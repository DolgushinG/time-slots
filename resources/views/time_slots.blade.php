<div class="form-row pt-2">
    <h2>
        <label for="inputState">Свободное время</label>

    </h2>
</div>
<div class="btn-group btn-group-toggle pt-2"  id="time_slot" data-toggle="buttons">
    @if(count($free_time_slots) == 0)
        <label for="inputState" class="text-danger">На эту дату нет свободного времени для записи</label>
    @endif
        <div class="container">
    @foreach($free_time_slots as $time_slot)

                <label class="btn btn-warning time_slot">
                    <input type="radio"  id="{{$time_slot->id}}" hidden> {{date("H:i", strtotime($time_slot->time_slot))}}
                </label>
    @endforeach
        </div>
</div>
<script>
    var wrapper_time_slot = document.getElementById('time_slot');

    wrapper_time_slot.addEventListener('click', (event) => {
        const isInput = event.target.nodeName === 'INPUT';
        if (!isInput) {
            return;
        }
        const button_book = document.querySelector('#book-submit')
        const button_book_2 = document.querySelector('#modal-btn-next')
        const c = document.getElementById('current_month')
        if(button_book || button_book_2 || c) {
            button_book.style.background = 'green';
            button_book_2.style.background = 'green';
            button_book.removeAttribute('disabled', 'disabled');
            button_book_2.removeAttribute('disabled', 'disabled');
        }
    })
</script>
