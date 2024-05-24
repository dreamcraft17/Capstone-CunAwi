@extends('layouts.sidenav')

@section('head')
    {{-- style, script, manggil library script cdn --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="argon/assets/css/argon-dashboard.css">
    <link rel="stylesheet" href="argon/assets/css/font-awesome.min.css">
@endsection

@section('content')
    @include('layouts.topnav', ['title' => 'Task Manager'])

    <div class="container">
        <div class="card overflow-hidden">
            <div class="bg-soft">
                <div class="row">
                    <div class="col m-4">
                        <h2> Task Manager </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3 mb-3">
                        <div class="col-lg-2 col-md-6 col-sm-12 mx-3 p-0">
                            <label for="startDate">Start Date</label>
                            <input type="date" class="form-control" id="startDate">
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12 mx-3 p-0">
                            <label for="endDate">End Date</label>
                            <input type="date" class="form-control" id="endDate">
                        </div>
                        <div class="col-lg-2 mt-4 col-md-6 col-sm-12 mx-3 p-0 align-self-end">
                            <button class="btn btn-primary fa fa-search" onclick="filterByDateRange()"></button>
                        </div>

                        <div id="projects">
                            @foreach ($projects as $project)
                                <div class="row mt-4 project" data-finishcmt="{{ $project->finish_cmt }}">
                                    <div class="col">
                                        <div class="list-group">
                                            <a data-toggle="modal" data-target="#taskmodal"
                                                class="list-group-item list-group-item-action" data-id="{{ $project->id }}"
                                                data-productid="{{ $project->productID }}"
                                                data-finishcmt="{{ $project->finish_cmt }}"
                                                data-datecommit="{{ $project->date_commit }}">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1">{{ $project->productID }}</h6>
                                                    <small>{{ $project->finish_cmt }}</small>
                                                </div>
                                                <p class="mb-1">{{ $project->date_commit }}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="modal" id="taskmodal" tabindex="-1" role="dialog" aria-labelledby="taskmodalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="taskmodalLabel">UPDATE TASK</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container mt-2">
                                            <a href="#" class="btn btn-dark">See Details</a>
                                            <a href="#" class="btn btn-primary">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            @include('layouts.footer')
        </div>


        <!-- Include jQuery and Bootstrap JS if not already included -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#taskmodal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var projectId = button.data('id'); // Extract info from data-* attributes
                    var productID = button.data('productid');
                    var finishCmt = button.data('finishcmt');
                    var dateCommit = button.data('datecommit');

                    // Update the modal's content.
                    var modal = $(this);
                    modal.find('.modal-title').text('UPDATE TASK: ' + productID);
                    modal.find('.modal-body .btn-dark').attr('href', '/projectdetail/' + projectId);
                    modal.find('.modal-body .btn-primary').attr('href', '/editproject/' + projectId);
                });
            });
        </script>

        <script>
            function filterByDateRange() {
                var startDate = document.getElementById('startDate').value;
                var endDate = document.getElementById('endDate').value;

                if (!startDate || !endDate) {
                    alert('Please select both start and end dates.');
                    return;
                }

                var start = new Date(startDate);
                var end = new Date(endDate);
                // Adjust end date to include the whole day
                end.setHours(23, 59, 59, 999);

                var projects = document.querySelectorAll('.project');

                // Create an array to store projects within the date range
                var filteredProjects = [];

                projects.forEach(function(project) {
                    var finishcmt = new Date(project.getAttribute('data-finishcmt'));

                    if (finishcmt >= start && finishcmt <= end) {
                        filteredProjects.push(project);
                    }
                });

                // Sort filtered projects by finish commit date
                filteredProjects.sort(function(a, b) {
                    var dateA = new Date(a.getAttribute('data-finishcmt'));
                    var dateB = new Date(b.getAttribute('data-finishcmt'));
                    return dateA - dateB;
                });

                // Clear current projects
                var projectContainer = document.getElementById('projects');
                projectContainer.innerHTML = '';

                // Append sorted projects to the container
                filteredProjects.forEach(function(project) {
                    projectContainer.appendChild(project);
                });
            }
        </script>
    @endsection
