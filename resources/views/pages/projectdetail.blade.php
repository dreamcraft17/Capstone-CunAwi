@extends('layouts.sidenav')

@section('head')
    {{-- style, script, manggil library script cdn --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="argon/assets/css/argon-dashboard.css">

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
                    <h4 class="p-2 m-0 rubik-font" style="color: #5e72e4; opacity: 0.6;">{{ $project->toyName }}</h4>
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

                        <div class="card border-1 mb-3">
                            <div class="container">
                                <div class="card-body p-3 rubik-font toy-note">
                                    <h3><b style="color: #5e72e4;">Remarks</b></h3>
                                    <p class="rubik-font mt-2" style="white-space: pre-line;" id=""></p>
                                    <p class="rubik-font mt-2"><i>No remarks...</i></p>
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
                                        <h5>{{ $project->projectID }}</h5>
                                        <br />
                                        <h4 style="color: #5e72e4; opacity: 0.6;"><b>Toy Name</b></h4>
                                        <h5>{{ $project->toyName }}</h5>
                                    </div>
                                    <hr class="bg-dark mb-3" />
                                    <div class="list-group list-group-flush mt-4">
                                        <div class="row">
                                            <div class="col rubik-font">
                                                <h6>Toy Description</h6>
                                                <p></p>
                                                <h6 class="mt-4">Age Grade</h6>
                                                <p></p>
                                                <h6 class="mt-4">Licensed</h6>
                                                <p></p>
                                                <h6>Run Rate/Week</h6>
                                                <p></p>
                                                <h6>Cost Iteration</h6>
                                                <p></p>
                                                <h6>Product Engineer</h6>
                                                <p></p>
                                            </div>
                                            <div class="col rubik-font">
                                                <h6>Launch Quantity</h6>
                                                <p></p>
                                                <h6 class="mt-4">Launch Avail</h6>
                                                <p></p>
                                                <h6 class="mt-4">Suggested Retail Price</h6>
                                                <p></p>
                                                <h6 class="mt-4">Tool Cost Budget</h6>
                                                <p></p>
                                                <h6 class="mt-4">Product Design</h6>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
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
                                        <th class="pl-2 rubik-font" style="color: #5e72e4;">Start Date</th>
                                        <th class="pl-2 rubik-font" style="color: #5e72e4;">Finish Date CMT</th>
                                        <th class="pl-2 rubik-font" style="color: #5e72e4;">Finish Date ACT</th>
                                        <th class="pl-2 rubik-font" style="color: #5e72e4;">Delay Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-dark activity-row">
                                        <td class="rubik-font activity-name"></td>
                                        <td class="rubik-font"></td>
                                        <td class="rubik-font"></td>
                                        <td class="rubik-font"></td>
                                    </tr>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div style="text-align: left;" class="mt-5 mb-0">
                        <a type="button" href="{{ route('newproject') }}" class="btn btn-warning rubik-font"
                            value="Edit">Edit</a>
                        <input type="button" id="" class=" btn btn-danger rubik-font" value="Drop" />
                        <input type="button" id="" class=" btn btn-secondary rubik-font" value="Delete" />
                    </div>

                </div>
            </div>
        </div>



        @include('layouts.footer')
    </div>
    {{-- Nambahin footer dari layout || footer di akhir --}}


    {{-- Modal harus di luar div --}}






    {{-- Masukin script di sini --}}
@endsection
