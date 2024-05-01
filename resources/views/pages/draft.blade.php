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
        background-color: rgba(241, 180, 76, .18);
    }

    .badge-success {
        background-color: #2dce89;
        color: #fff;
    }

    .badge-soft-success {
        color: #34c38f;
        background-color: rgba(52, 195, 143, .18);
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
@include('layouts.topnav', ['title' => 'Draft Project'])

{{-- Di sini baru ngoding, buatla apa gitu --}}
<div class="container">
    <div class="card overflow-hidden">
        <div class="bg-soft">
            <div class="row">
                <div class="col m-4">
                    <CENTER>
                        <h2 class="mt-2" style="color: #1d275f;"> Draft Project </h2>
                        <a href="{{ route('projectlist') }}" class="btn btn-secondary rubik-font ml-2"> Project List </a>
                    </CENTER>
                </div>
            </div>

            <div class="card-body px-3 pt-0 pb-3">

                <div class="mt-4" style="text-align: right;">
                    <span>Choose designer :</span>
                    <select id="designerFilter">
                        <option value="">All Designers</option>
                        @foreach($designers as $designer)
                        <option value="{{ $designer }}">{{ $designer }}</option>
                        @endforeach
                    </select>
                    <label for="filterStatus">Filter by Status:</label>
                    <select id="filterStatus">
                        <option value="">All</option>
                        <option value="On going">On going</option>
                        <option value="Finished">Finished</option>
                    </select>

                    <!-- TABLES -->
                    <table id="taskTable" class="table" style="margin-top:25px;">
                        <!-- Your table content here -->
                        <thead>
                            <tr>
                                <th scope="col">Tracking ID</th>
                                <th scope="col">Product</th>
                                <th scope="col">Staff Name</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">Progress</th>
                                <th scope="col">Category</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="projectTableBody">
                            @foreach($data as $project)
                            <tr data-designer="{{ $project->designer }}">
                                <td class="text-center">{{ $project->projectID }}</td>
                                <td class="text-center">{{ $project->productID }}</td>
                                <td class="text-center">{{ $project->designer }}</td>
                                <td class="text-center">{{ $project->start_date }}</td>
                                <td class="text-center">
                                    <div class="progress-bar">
                                        <!-- Calculate percentage -->
                                        @php
                                        // Parse adherence value to get the percentage
                                        $adherence = str_replace('%', '', $project->adherence); // Remove '%' sign
                                        $percentage = intval($adherence);
                                        @endphp
                                        <!-- Set width based on percentage -->
                                        <div class="progress" style="width: {{ $percentage }}%; height:150px;">
                                            {{ $project->adherence }}
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $project->category }}</td>
                                <td class="text-center">{{ $project->status }}</td>
                                <td class="text-center">
                                    <button class="btn btn-danger">delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
    <script>
    $(document).ready(function() {
        // Function to filter table rows based on selected designer
        $('#designerFilter').change(function() {
            var selectedDesigner = $('#designerFilter').val();

            $('#projectTableBody tr').each(function() {
                var designer = $(this).data('designer');

                var designerFilter = selectedDesigner === '' || designer === selectedDesigner;

                if (designerFilter) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

    @endsection