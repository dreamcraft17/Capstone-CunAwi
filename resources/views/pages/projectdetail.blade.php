@extends('layouts.sidenav')

@section('head')
    {{-- style, script, manggil library script cdn --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/argon/assets/css/argon-dashboard.css">

    <style>

    </style>
@endsection

@section('content')
    @include('layouts.topnav', ['title' => 'Project Detail'])

    {{-- Di sini baru ngoding, buatla apa gitu --}}
    <div class="container">
        <div class="card overflow-hidden">
            <div class="bg-soft">
                <div class="text-center mt-4">
                    <span class="text-bold ml-2 mr-2" style="font-size: 24px;">Project Name</span>
                    <h4 class="p-2 m-0 rubik-font" style="color: #5e72e4; opacity: 0.6;" id="toyName">
                        {{ $project->toyName }}</h4>
                </div>
                <div class="row p-4">
                    <div class="col-7">
                        <div class="card border-1 mb-3" id="toy-card-container">
                            <h3 class="mt-3 text-center"><b style="color: #5e72e4;">Product Photo</b></h3>
                            <hr class="bg-dark" />
                            <div style="padding:10px; position: relative;">
                                <!-- Left arrow -->
                                <button class="slider-arrow left-arrow" onclick="showPrevImage()">&#8249;</button>
                                <div class="slide-content" style="max-width: 850px; text-align: center;">
                                    <CENTER>
                                        <div id="slideshow-container fade">
                                            <div class="image-container" data-photo-name="">
                                                <a class="image-link" data-mfp-src="" data-effect="mfp-zoom-in">
                                                    <img class="mySlides img-fluid border-radius-md shadow-lg product-photo"
                                                        height="300" src="" style="display:block;" />
                                                </a>
                                                <!-- Overlay div for icons -->

                                                <div class="image-overlay">
                                                    <ul class="icon-left">
                                                        <!-- Use the "data-mfp-src" attribute instead of "href" -->
                                                        <li><a class="magnific-popup text-white" data-mfp-src=""><i
                                                                    class="fa fa-search"></i></a></li>
                                                    </ul>
                                                    <ul class="icon-right">
                                                        <li><a class="text-white" onclick=""><i
                                                                    class="fa fa-trash"></i></a></li>
                                                    </ul>
                                                </div>

                                            </div>

                                            <div class="image-container">
                                                <img id="uploadedImage" class="mySlides img-fluid border-radius-md"
                                                    width="300"
                                                    src="https://cdn3d.iconscout.com/3d/premium/thumb/no-photo-5590994-4652997.png"
                                                    style="display:block;" />
                                            </div>
                                        </div>
                                    </CENTER>
                                </div>
                                <!-- Right arrow -->
                                <button class="slider-arrow right-arrow" onclick="showNextImage()">&#8250;</button>
                            </div>
                            <hr class="bg-dark" />
                            <CENTER>
                                <button class="btn btn-rounded btnPurple rubik-font" data-bs-toggle="modal"
                                    data-bs-target="#upfoto"> Add Photo </button>
                            </CENTER>
                        </div>

                        <div class="card border-1 mt-4">
                            <div class="container">
                                <div class="card-body p-3 rubik-font toy-note">
                                    <h3><b style="color: #5e72e4;">Remarks</b></h3>
                                    <p class="rubik-font mt-2" style="white-space: pre-line;" id=""></p>
                                    <p class="rubik-font mt-2"><i>{{ $project->remarks }}</i></p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col">
                        <div class="card border-1">
                            <div class="container">
                                <div class="card-body px-3 pt-2 pb-3 rubik-font">
                                    <h3 class="mt-3">
                                        <b style="color: #5e72e4;">Project Information</b>
                                    </h3>
                                    <p>
                                    </p>
                                    <div class="text-center rubik-font mb-2">
                                        <h4 style="color: #5e72e4; opacity: 0.6;"><b>Project ID</b></h4>
                                        <h5 id="project_id">{{ $project->projectID }}</h5>
                                        <br />
                                        <h4 style="color: #5e72e4; opacity: 0.6;"><b>Product ID</b></h4>
                                        <h5>{{ $project->productID }}</h5>
                                    </div>
                                    <hr class="bg-dark mb-3" />
                                    <div class="list-group list-group-flush mt-4">
                                        <div class="row">
                                            <div class="col rubik-font">
                                                <h6>Toy Description</h6>
                                                <p>{{ $project->description }}</p>
                                                <h6 class="mt-4">Category Material</h6>
                                                <p>{{ $project->category }}</p>
                                                <h6 class="mt-4">Product Engineer</h6>
                                                <p>{{ $project->pe }}</p>
                                                <h6 class="mt-4">Product Design</h6>
                                                <p>{{ $project->designer }}</p>
                                            </div>
                                            <div class="col rubik-font">
                                                <h6>Launch Quantity</h6>
                                                @if ($project->qty)
                                                    {{ $project->qty }}
                                                @else
                                                    N/A
                                                @endif
                                                <h6 class="mt-4">Cost Budget</h6>
                                                @if ($project->costbudget)
                                                    {{ $project->costbudget }}
                                                @else
                                                    N/A
                                                @endif
                                                <h6 class="mt-4">Launch Avail</h6>
                                                @if ($project->launchdate)
                                                    {{ $project->launchdate }}
                                                @else
                                                    N/A
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-1 mt-4">
                            <div class="container">
                                <div class="card-body p-3 rubik-font toy-note">
                                    <h4 class="mt-1" style="color: #5e72e4;">Adherence</h4>
                                    <p class="rubik-font mt-1">
                                        @if ($project->adherence)
                                            {{ $project->adherence }}
                                        @else
                                            0
                                        @endif
                                    </p>
                                    <h4 class="mt-2" style="color: #5e72e4;">Lead Time</h4>
                                    <p class="rubik-font mt-1 mb-2">
                                        @if ($project->lead_time)
                                            {{ $project->lead_time }}
                                        @else
                                            N/A
                                        @endif
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="px-3 pt-2 pb-3">
                            <table id="activitiesTable" class="table table-bordered mt-3 table-responsive"
                                style="vertical-align: middle;">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="pl-2 rubik-font text-center" style="color: #5e72e4;">Start Date</th>
                                        <th class="pl-2 rubik-font text-center" style="color: #5e72e4;">Finish Date CMT
                                        </th>
                                        <th class="pl-2 rubik-font text-center" style="color: #5e72e4;">Finish Date ACT
                                        </th>
                                        <th class="pl-2 rubik-font text-center" style="color: #5e72e4;">Delay Reason</th>
                                        <th class="pl-2 rubik-font text-center" style="color: #5e72e4;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-dark activity-row">
                                        <td class="rubik-font activity-name">{{ $project->start_date }}</td>
                                        <td class="rubik-font">{{ $project->finish_cmt }}</td>
                                        <td class="rubik-font">
                                            @if ($project->finishact)
                                                {{ $project->finishact }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="rubik-font">
                                            @if ($project->delayreason)
                                                {{ $project->delayreason }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="rubik-font">{{ $project->status }}</td>
                                    </tr>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div style="text-align: left;" class="mt-5 mb-0">
                        <div class="row">
                            <div class="col-1">
                                <a href="{{ route('editproject', ['id' => $project->id]) }}"
                                    class="btn btn-warning rubik-font">Edit</a>
                            </div>
                            <div class="col-1" style="margin-right: 6px;">
                                <form action="{{ route('project.drop', ['id' => $project->id]) }}" method="post">
                                    @csrf
                                    <input type="submit" class="btn btn-danger rubik-font" value="Drop" />
                                </form>
                            </div>
                            <div class="col-1">
                                <form action="/projects/{{ $project->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger rubik-font" value="Delete" />
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>



        @include('layouts.footer')
    </div>
    {{-- Nambahin footer dari layout || footer di akhir --}}


    {{-- Modal harus di luar div --}}


    <script>
        $(document).ready(function() {
            // Function to populate edit form fields with project detail data
            function populateEditForm() {
                // Extract data from project detail section
                var productID = $('#projectDetail #project_id').text();
                var toyName = $('#projectDetail #toy_name').text();
                var productEngineering = $('#projectDetail #product_engineering').text();
                var productDesign = $('#projectDetail #product_design').text();
                // Repeat this process for other fields

                // Log extracted data to console for debugging
                console.log("Product ID: ", productID);
                console.log("status: ", status);
                console.log("Toy Name: ", toyName);
                console.log("Product Engineering: ", productEngineering);
                console.log("Product Design: ", productDesign);
                // Repeat this process for other fields

                // Populate edit form fields
                $('#editProjectForm #productID').val(productID);
                $('#editProjectForm #toyName').val(toyName);
                $('#editProjectForm #pe').val(productEngineering);
                $('#editProjectForm #designer').val(productDesign);
                // Repeat this process for other fields
            }

            // Call the function to populate edit form when the page loads
            populateEditForm();
        });
    </script>




    // {{-- Masukin script di sini --}}
@endsection
