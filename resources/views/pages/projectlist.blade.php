@extends('layouts.sidenav')

@section('head')
{{-- style, script, manggil library script cdn --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

<style>
    .badge {
    display: inline-block;
    padding: 0.25em 0.5em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #fff;
    }

    .badge-soft-warning {
        color: #f1b44c;
        background-color: rgba(241,180,76,.18);
    }

    .badge-success {
        background-color: #2dce89;
        color: #fff;
    }

    .badge-soft-success {
        color: #34c38f;
        background-color: rgba(52,195,143,.18);
    }

    .badge-warn-subtle {
        color: #e9bc18;
        background-color: #fcf5dc;
    }

    .badge-info-subtle {
        color: #179faa;
        background-color: #dcf1f2;
    }

    .badge-secondary-subtle {
        color: #438eff;
        background-color: #e3eeff;
    }

    .badge-primary-subtle {
        color: #5a58eb;
        background-color: #e6e6fc;
    }

    .badge-danger-subtle {
        color: #f9554c;
        background-color: #fee6e4;
    }

    .rounded-pill {
        border-radius: 50rem;
    }

    .d-inline {
        display: inline;
    }

</style>
@endsection

@section('content')
@include('layouts.topnav', ['title' => 'Project List'])

{{-- Di sini baru ngoding, buatla apa gitu --}}
<div class="container">
    <div class="card overflow-hidden">
        <div class="bg-soft">
            <div class="row">
                <div class="col m-4">
                    <CENTER>
                      <h2 class="mt-2" style="color: #1d275f;"> Project List </h2>
                      <a href="{{ route('newproject') }}" class="btn btn-primary rubik-font ml-2"> + Add New </a>
                      <a href="{{ route('draft') }}" class="btn btn-secondary rubik-font ml-2"> Draft Project </a>
                    </CENTER>
                </div>
            </div>

            <div class="card-body px-3 pt-0 pb-3">

                <!-- Filter -->
                <div class="mt-4" style="text-align: right;">
                    <select id=" ">
                        <option>Staff</option>
                        <option> A </option>
                        <option> B </option>
                        <option> C </option>
                        <!-- Add other designer options as needed -->
                    </select>

                    <select id="statusFilter">
                        <option value="all">Status</option>
                        <option value="On Going">On Going</option>
                        <option value="Completed">Completed</option>
                        <option value="Drop">Drop</option>
                        <!-- Add other status options as needed -->
                    </select>
                </div>

                <!-- TABLES -->
                <table id="taskTable" class="table" style="margin-top:25px;">
                    <!-- Your table content here -->
                    <thead>
                        <tr>
                            <th scope="col">Task Name</th>
                            <th scope="col">Staff</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">DSP Finish HWT28</td>
                            <td>A</td>
                            <td>10/07/23</td>
                            <td>Completed</td>
                            <td>
                                100%
                                <div style="width: 100px; height: 10px; margin-top: 5px; position: relative;">
                                    <div style="background-color: #4CAF50; height: 100%; width: 100%; border-radius: 3px;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">RG FR Submit HWP46</td>
                            <td>A</td>
                            <td>10/07/23</td>
                            <td>On Going</td>
                            <td>
                                75%
                                <div style="width: 100px; height: 10px; margin-top: 5px; position: relative;">
                                    <div style="background-color: #4CAF50; height: 100%; width: 75%; border-radius: 3px;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">PL 2222 HRM78</td>
                            <td>A</td>
                            <td>10/07/23</td>
                            <td>On Going</td>
                            <td>
                                52%
                                <div style="width: 100px; height: 10px; margin-top: 5px; position: relative;">
                                    <div style="background-color: #4CAF50; height: 100%; width: 52%; border-radius: 3px;"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">CR Send Out HRG85</td>
                            <td>A</td>
                            <td>10/07/23</td>
                            <td>Drop</td>
                            <td>
                                -%
                                <div style="width: 100px; height: 10px; margin-top: 5px; position: relative;">
                                    <div style="background-color: #4CAF50; height: 100%; width: 0%; border-radius: 3px;"></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</div>
{{-- Nambahin footer dari layout || footer di akhir --}}


{{-- Modal harus di luar div --}}




{{-- Masukin script di sini --}}
@endsection
