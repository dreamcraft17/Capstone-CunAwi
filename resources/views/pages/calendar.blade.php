@extends('layouts.sidenav')

@section('head')
    {{-- style, script, manggil library script cdn --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.0/fullcalendar.min.js"></script>



    <style>
        .calendar {
            width: 300px;
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
                <div class="col-3">
                    <select id="CategoryFilter" name="CategoryFilter" class="selectpicker" multiple>
                    </select><br />
                    <h9>SELECT ATTRIBUTES TO FILTER</h9>
                </div>
                <div id='calendar'></div>
            </div>
        </div>



        @include('layouts.footer')
    </div>
    {{-- Nambahin footer dari layout || footer di akhir --}}


    {{-- Modal harus di luar div --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let CategoryFilter = document.querySelector("#CategoryFilter");

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: '',
                    center: 'title',
                    right: 'prev,next today'
                },
                navLinks: true,
                selectable: true,
                selectMirror: true,
                select: function(arg) {
                    var title = prompt('Event Title:');
                    if (title) {
                        calendar.addEvent({
                            title: title,
                            start: arg.start,
                            end: arg.end,
                            allDay: arg.allDay
                        })
                    }
                    calendar.unselect();
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    var projNum = info.event.url;
                    window.open(`@Url.Action("DetailCalendar", "Calendar")?projNum=${projNum}`,
                        '_self');
                },
                editable: true,
                dayMaxEvents: true,
                events: {
                    url: '/events' // Change this to your events endpoint URL
                }
            });
            calendar.render();

            CategoryFilter.addEventListener('change', function(e) {
                calendar.refetchEvents(); // Fetch events again
            });
        });
    </script>


    {{-- Masukin script di sini --}}
@endsection
