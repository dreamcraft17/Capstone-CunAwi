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
                        {{-- Pilihan kategori bisa ditambahkan secara dinamis jika diperlukan --}}
                        <option value="kategori1">Kategori 1</option>
                        <option value="kategori2">Kategori 2</option>
                        <option value="kategori3">Kategori 3</option>
                    </select><br />
                    <h9>SELECT ATTRIBUTES TO FILTER</h9>
                </div>
                <div class="calendar-header">
                    <h2>{{ $monthName[$month] }} {{ $year }}</h2>
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
                initialDate: '{{ $year }}-{{ $month }}-01', // Mengatur tanggal awal kalender
                dayHeaderFormat: { weekday: 'short' }, // Format header hari (singkat)
                events: [ // Tidak ada acara, hanya menampilkan tanggal dan hari
                    @for ($i = 1; $i <= $daysInMonth; $i++)
                        { title: '{{ $i }}', start: '{{ $year }}-{{ $month }}-{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}' },
                    @endfor
                ]
            });
            calendar.render();

            // Menambahkan event listener untuk filter kategori
            CategoryFilter.addEventListener('change', function(e) {
                calendar.refetchEvents(); // Fetch events again
            });
        });
    </script>

    {{-- Masukin script di sini --}}
@endsection
