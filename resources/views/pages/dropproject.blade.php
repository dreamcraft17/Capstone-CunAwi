@extends('layouts.sidenav')

@section('head')
    {{-- style, script, manggil library script cdn --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <link href="
https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <link href="
https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/argon/assets/css/argon-dashboard.css">


    <style>
        /* Styles for the container to display progress bar */
        .progress-bar {
            width: 200px;
            /* Adjust width as needed */
            height: 20px;
            /* Adjust height as needed */
            background-color: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
        }

        /* Styles for the progress bar */
        .progress {
            height: 100%;
            background-color: #4caf50;
            /* Green color for progress */
            text-align: center;
            line-height: 20px;
            /* Same as height for vertical centering */
            color: white;
        }

        /* Styles for the container to display percentage */
        .percentage-container {
            margin-top: 10px;
            text-align: center;
        }

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

        .progress-bar {
            width: 200px;
            /* Adjust width as needed */
            height: 20px;
            /* Adjust height as needed */
            background-color: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background-color: #4caf50;
            /* Green color for progress */
            text-align: center;
            line-height: 20px;
            /* Same as height for vertical centering */
            color: white;
        }

        /* Styles for the container to display percentage */
        .percentage-container {
            margin-top: 10px;
            text-align: center;
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

        .dropdown-menu {
            min-width: auto;
            right: 0;
            left: auto;
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
                            <h2 class="mt-2" style="color: #1d275f;"> Dropped Project </h2>
                            <a href="{{ route('projectlist') }}" class="btn btn-primary rubik-font ml-2"> Project List </a>
                            <a href="{{ route('draft') }}" class="btn btn-secondary rubik-font ml-2"> Draft</a>
                        </CENTER>
                    </div>
                </div>

                <div class="card-body px-3 pt-0 pb-3">
                    <p>
                    <div class="row rubik-font">
                        <div class="col-3">
                            <div>
                                <span id="statusFilterPlaceholder"></span>
                            </div>
                        </div>
                    </div>
                    </p>
                    <br />

                    <div class="table-responsive p-0 rubik-font">
                        <table id="projectTable" class="display table table-bordered">
                            {{-- <thead class="text-white" style="background-color: #F684AF;"></thead> --}}
                            <tbody id="projectTableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- Include jQuery before your script -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.min.js"></script>

    <script>
        $(document).ready(function() {
            var dataTable;

            function filterProjectsByStatus(projects, selectedStatus) {
                if (selectedStatus === 'All') {
                    return projects;
                } else {
                    return projects.filter(function(item) {
                        return item.status === selectedStatus;
                    });
                }
            }

            $.ajax({
                url: '{{ route('display.project') }}', // Update the route name here
                type: 'GET',
                dataType: 'json',
                success: function(result) {
                    var filteredProjects = filterProjectsByStatus(result,
                        'All'); // Filter by default status 'All'
                    var tableBody = $('#projectTableBody');
                    tableBody.empty();

                    filteredProjects.forEach(function(item) {
                        var row = '<tr>' +
                            '<td></td>' +
                            '<td class="project-number-cell">' + +'</td>' +
                            '<td>' + +'</td>' +
                            '<td>' + +'</td>' +
                            '<td>' + +'</td>' +
                            '<td>' + +'</td>' +
                            '<td>' + +'</td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '</tr>';
                        tableBody.append(row);
                    });

                    if (dataTable) {
                        dataTable.row.add().draw();
                    } else {
                        dataTable = $('#projectTable').DataTable({
                            paging: true,
                            searching: true,
                            language: {
                                paginate: {
                                    previous: '<i class="fa fa-angle-left" style="padding-top: 8px;"></i>',
                                    next: '<i class="fa fa-angle-right fuckek" style="padding-top: 8px;"></i>'
                                },
                                search: "",
                                searchPlaceholder: "Search"
                            },
                            ordering: true,
                            info: true,
                            responsive: true,
                            columns: [{
                                    data: null,
                                    title: 'A'
                                },

                                {
                                    data: null,
                                    title: 'Project ID'
                                },

                                {
                                    data: null,
                                    title: 'Product ID'
                                },
                                {
                                    data: null,
                                    title: 'Toy Name'
                                },
                                {
                                    data: null,
                                    title: 'PE'
                                },
                                {
                                    data: null,
                                    title: 'Designer'
                                },
                                {
                                    data: null,
                                    title: 'Meeting'
                                },
                                {
                                    data: null,
                                    title: 'Start Date'
                                },
                                {
                                    data: null,
                                    title: 'Finish CMT'
                                },
                                {
                                    data: null,
                                    title: 'Finish ACT'
                                },
                                {
                                    data: null,
                                    title: 'Status',
                                    render: function(data, type, row) {
                                        if (data === 'Finished') {
                                            return '<span class="badge badge-soft-success rounded-pill d-inline">' +
                                                data + '</span>';
                                        } else if (data === 'On going' || data ===
                                            'on going') {
                                            return '<span class="badge badge-soft-warning rounded-pill d-inline">' +
                                                data + '</span>';
                                        } else if (data === 'Drop') {
                                            return '<span class="badge badge-danger-subtle rounded-pill d-inline">' +
                                                data + '</span>';
                                        } else {
                                            return data;
                                        }
                                    }
                                },
                            ],
                            order: [
                                [10, 'desc']
                            ], // Assuming 'status' is the last column
                            initComplete: function() {
                                this.api().columns("10").every(function() {
                                    var column = this;
                                    var select = $(
                                            '<select class="form-select form-select-lg"><option value="">All Status</option></select>'
                                        )
                                        .appendTo($('#statusFilterPlaceholder'))
                                        .on('change', function() {
                                            var val = $.fn.dataTable.util
                                                .escapeRegex($(this).val());
                                            column.search(val ? '^' + val +
                                                    '$' : '', true, false)
                                                .draw();
                                        });

                                    column.data().unique().sort().each(function(d) {
                                        select.append($('<option></option>')
                                            .attr('value', d).text(d));
                                    });
                                });
                            },
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    alert('Error loading project table. See console for details.');
                }
            });
        });
    </script>
@endsection
