@extends('layouts.sidenav')

@section('head')
{{-- style, script, manggil library script cdn --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.0/fullcalendar.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.0/main.min.css" rel="stylesheet">
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: {!! json_encode($events) !!},
        eventRender: function(info) {
            var title = info.event.title;
            var date = info.event.start;
            var dayCell = calendar.getDateCell(date);
            if (dayCell) {
                var dayNumberEl = dayCell.querySelector('.fc-daygrid-day-number');
                if (dayNumberEl) {
                    var titleEl = document.createElement('div');
                    titleEl.textContent = title;
                    dayNumberEl.appendChild(titleEl);
                }
            }
        }
    });
    calendar.render();
});

</script>
<style>
    .calendar {
        width: 100%;
        border: 1px solid #ccc;
        padding: 10px;
    }

    .calendar-header {
        text-align: center;
        margin-bottom: 10px;
    }

    .calendar-body {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
    }

    .calendar-day {
        padding: 5px;
        text-align: center;
        border: 1px solid #ccc;
    }
</style>
@endsection

@section('content')
@include('layouts.topnav', ['title' => 'Calendar'])

{{-- Di sini baru ngoding, buatla apa gitu --}}
<div class="container">
    <div class="card p-2">
        <div class="table-responsive">
            <div class="calendar-header">
                <h2>My Calendar</h2>
            </div>
            <!-- Tempatkan div kalender di sini -->
            <div id='calendar'></div>
        </div>
    </div>
    @include('layouts.footer')
</div>


@endsection