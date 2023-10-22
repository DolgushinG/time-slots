$(document).ready(function() {
    const button_book = document.querySelector('#book-submit')
    const button_book_2 = document.querySelector('#modal-btn-next')

    if(button_book || button_book_2 || c) {
        button_book.style.background = 'gray';
        button_book_2.style.background = 'gray';
        button_book.setAttribute('disabled', 'disabled');
        button_book_2.setAttribute('disabled', 'disabled');
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const wrapper_current_month = document.getElementById('current_month');
    const wrapper_next_month = document.getElementById('next_month');
    if (wrapper_current_month) {
        wrapper_current_month.addEventListener('click', (event) => {
            const isButton = event.target.nodeName === 'INPUT';
            if (!isButton) {
                return;
            }
            $(wrapper_next_month).removeClass('active-month');
            $(document.getElementById(event.target.id)).addClass('active-month');
            let month = document.querySelector('input[data-id="month"]').getAttribute('name')
            event.preventDefault();
            let state_month = "current"
            getDays(event.target.name, state_month)
        })
    }
    if(wrapper_next_month) {
        wrapper_next_month.addEventListener('click', (event) => {
            const isButton = event.target.nodeName === 'INPUT';
            if (!isButton) {
                return;
            }
            $(document.getElementById(event.target.id)).addClass('active-month');
            $(wrapper_current_month).removeClass('active-month');
            let month = document.querySelector('input[data-id="month"]').getAttribute('name')
            event.preventDefault();
            let state_month = "next"
            getDays(event.target.name, state_month)
        })
    }

    function getDays(date, state_month)
    {
        $.ajax({
            type: 'GET',
            url: 'getDays',
            data: {
                date: date,
            },
            success: function(data) {
                $('#contentDays').html(data);
                if(state_month === "current") {
                    $(document.getElementById('next_month')).prop('checked', false)
                    $(document.getElementById('current_month')).prop('checked', true)
                } else {
                    $(document.getElementById('current_month')).prop('checked', false)
                    $(document.getElementById('next_month')).prop('checked', true)
                }
            },
            error: function(data) {
                console.log("error");
            }
        });
    }

    function get_current_date(){
        const date = new Date();
        let currentDay= String(date.getDate()).padStart(2, '0');
        let currentMonth = String(date.getMonth()+1).padStart(2,"0");
        let currentYear = date.getFullYear();
        console.log(`${currentDay}-${currentMonth}-${currentYear}`)
        return `${currentYear}-${currentMonth}-${currentDay}`;
    }

});

$(document).on('click','#modal-btn-next', function(e) {
    var service_id = $('#service_id:checked').val();
    let service_name = document.querySelector('#service_id_'+service_id).textContent
    let month = document.querySelector('.active-month').getAttribute('data-ru')
    let day = document.querySelector('.btn.btn-warning.days.active input').getAttribute('name')
    let time_slot = document.querySelector('.btn.btn-warning.time_slot.active').textContent
    let first_last_name = document.querySelector('#first_last_name').value
    let phone = document.querySelector('#phone').value
    let form = $('#modal-text')
    form.text('').append('' +
        '<h5> Дата: </h5>' +
        '<p>'+day+'</p>' +
        '<h5> Время: </h5>' +
        '<p>'+time_slot+'</p>' +
        '<h5> Имя и Фамилия: </label>' +
        '<p>'+first_last_name+'</label>' +
        '<h5 class="col-form-label"> Телефон: </h5>' +
        '<p>'+phone+'</label>' +  '<br>' +
        '<h5 class="col-form-label"> Услуга: </h5>' +
        '<p>'+service_name+'</label>' +
        '')
});

$(document).on('click','#book-submit', function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var service_id = $('#service_id:checked').val();
    let month = document.querySelector('.active-month').getAttribute('data-ru')
    let day = document.querySelector('.btn.btn-warning.days.active input').getAttribute('name')
    let time_slot = document.querySelector('.btn.btn-warning.time_slot.active input').getAttribute('id')
    let name = document.querySelector('#first_last_name').value
    let phone = document.querySelector('#phone').value
    let button = $('#book-submit')
    let msg = $('#error-message');
    let data = $("#contact-form").serialize();
    data += '&month='+month + '&day='+day+'&time_slot='+time_slot +'&service_id=' + service_id;
    data += '&name='+name + '&phone='+phone;
    e.preventDefault()
    $.ajax({
        type: 'POST',
        url: '/booked',
        data: data,
        success: function(xhr, status, error) {
            button.removeClass('btn-save-change')
            button.addClass('btn-edit-change')
            button.text('').append('<i id="spinner" style="margin-left: -12px;\n' +
                '    margin-right: 8px;" class="fa fa-spinner fa-spin"></i> Обработка...')
            setTimeout(function () {
                button.text(xhr.responseJSON.message[0])
            }, 3000);
            setTimeout(function () {
                window.location.href = "booking_after/"+xhr.id;
            }, 4000);
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
                button.text('Cохранить')
            }, 6000);

        },

    });
});



// $(document).ready(function() {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $(document).on('click','#cityTable', function(e) {
//         e.preventDefault();
//         let city_name = $(this).val();
//         Cookies.remove('searchEvent', '1');
//         Cookies.remove('eventTable', '1');
//         $.ajax({
//             type: 'GET',
//             url: 'getresultsearch',
//             data: {
//                 city_name:city_name,
//             },
//             success: function(data) {
//                 $('#resultList').html(data);
//             },
//             error: function(data) {
//                 console.log("error");
//             }
//         });
//     });
// });
// $(document).ready(function() {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $(document).on('click','#eventTable', function(e) {
//         e.preventDefault();
//
//         let city_name = $(this).val();
//         let search_event = '1';
//         Cookies.set('eventTable', '1');
//         $.ajax({
//             type: 'GET',
//             url: 'getresultsearch',
//             data: {
//                 city_name:city_name,
//                 search_event: search_event
//             },
//             success: function(data) {
//                 $('#resultList').html(data);
//             },
//             error: function(data) {
//                 console.log("error");
//             }
//         });
//     });
// });
//
//
// $(document).ready(function(){
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $(document).on('click', '[role=\'navigation\'] a', function(event){
//
//         event.preventDefault();
//         var page = $(this).attr('href').split('page=')[1];
//         let city_name = $('#city_search').val();
//         if(Cookies.get("eventTable") === '1'|| Cookies.get("searchEvent") === '1') {
//             getEvent(page, city_name, '1')
//         } else {
//             getUsers(page, city_name);
//         }
//
//     });
//
//     function getEvent(page, city_name, search_event)
//     {
//         var _token = $("input[name=_token]").val();
//         $.ajax({
//             url: '/getresultsearch?page=' + page,
//             method:"GET",
//             data:{_token:_token, page:page, city_name:city_name, search_event: search_event},
//             success:function(data)
//             {
//                 $('#resultList').html(data);
//             }
//         });
//     }
//     function getUsers(page, city_name)
//     {
//         var _token = $("input[name=_token]").val();
//         $.ajax({
//             url: '/getresultsearch?page=' + page,
//             method:"GET",
//             data:{_token:_token, page:page, city_name:city_name},
//             success:function(data)
//             {
//                 $('#resultList').html(data);
//             }
//         });
//     }
//
// });
// $(document).ready(function(){
//     $("#search").on("click", function (event) {
//         //отменяем стандартную обработку нажатия по ссылке
//         event.preventDefault();
//         //забираем идентификатор бока с атрибута href
//         var id  = $(this).attr('href'),
//             //узнаем высоту от начала страницы до блока на который ссылается якорь
//             top = $(id).offset().top;
//         //анимируем переход на расстояние - top за 1500 мс
//         $('body,html').animate({scrollTop: top}, 50);
//     });
// });
// $("button").click(function() {
//     $('html,body').animate({
//             scrollTop: $("#resultList").offset().top},
//         'slow');
// });
//
// $(document).ready(function () {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//
//     $(document).on('click', '#subscribeBtn', function (e) {
//         document.querySelector("#subscribeBtn").innerHTML = 'Подписка оформлена';
//         $('#subscribeBtn').removeClass('subscribedefault');
//         $('#subscribeBtn').addClass('subscribeDone');
//         disableScrolling()
//         setTimeout(function () {
//             document.querySelector("#subscribeBtn").innerHTML = 'Подписаться';
//             $('#subscribeBtn').removeClass('subscribeDone');
//             $('#subscribeBtn').addClass('subscribedefault');
//             enableScrolling()
//         }, 1000);
//         let data = $('#subscribeUser').serialize();
//         e.preventDefault();
//         $(".php-email-form-subscribe")[0].reset();
//         $.ajax({
//             type: 'POST',
//             url: 'subscriptionUser',
//             data: data,
//             success: function (data) {
//             },
//         });
//     });
// });
// function enableScrolling(){
//     window.onscroll=function(){};
// }
// function disableScrolling(){
//     var x=window.scrollX;
//     var y=window.scrollY;
//     window.onscroll=function(){window.scrollTo(x, y);};
// }
