@extends('layouts.sidenav')

@section('head')
{{-- Add any necessary styles/scripts here --}}
@endsection

@section('content')
@include('layouts.topnav', ['title' => 'Profile'])

<div class="container">
    <!-- Profile section -->
    <div class="card shadow-lg mx-4">
        <!-- Card body -->
        <div class="card-body p-3">
            <!-- Profile details -->
            <div class="row gx-4">
                <div class="col-auto">
                    <!-- Avatar -->
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ $user->profile_image_url }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <!-- User name -->
                        <h5 class="mb-1">
                            {{ $user->name }}
                        </h5>
                        <!-- User role -->
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ $user->role }}
                        </p>
                    </div>
                </div>
                <!-- Navigation links -->
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <!-- Nav tabs -->
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <!-- Tabs -->
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                    data-bs-toggle="tab" href="#product-development" role="tab" aria-selected="false">
                                    <i class="ni ni-email-83"></i>
                                    <span class="ms-2">Product Development</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                    data-bs-toggle="tab" href="#setting" role="tab" aria-selected="false">
                                    <i class="ni ni-email-83"></i>
                                    <span class="ms-2">Setting</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Profile section -->

    <!-- Edit Profile section -->
    <div class="container-fluid py-4">
        <!-- Edit profile form -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Profile</p>
                            <button id="editButton" class="btn btn-primary btn-sm ms-auto">Edit</button>
                        </div>
                    </div>
                    <!-- Form -->
                    <div class="card-body">
                        <p class="text-uppercase text-sm">User Information</p>
                        <div class="row">
                            <!-- User information fields -->
                            <div class="col-md-6">
                                <!-- Username -->
                                <div class="form-group">
                                    <label for="username" class="form-control-label">Username</label>
                                    <input id="username" class="form-control" type="text" value="{{ $user->name }}" readonly>
                                </div>
                            </div>
                            <!-- Add more fields here if needed -->
                        </div>
                        <!-- Save and Cancel buttons -->
                        <div style="text-align: right;" class="mt-4">
                            <button id="cancelButton" class="btn btn-secondary btn-sm ms-2" style="display: none;">Cancel</button>
                            <input type="button" id="saveChangesButton" class="btn btn-primary btn-sm ms-auto" value="Save" disabled />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Profile section -->

    <!-- Users table section -->
    <div class="row mt-4 mx-2">
        <div class="col-12">
            <!-- Users table -->
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Users</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <!-- Table -->
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <!-- Table headers -->
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Create Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody>
                                <!-- Sample data (replace with actual data) -->
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div>
                                                <img src="./img/team-1.jpg" class="avatar me-3" alt="image">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Admin</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Admin</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-sm font-weight-bold mb-0">22/03/2022</p>
                                    </td>
                                    <td class="align-middle text-end">
                                        <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                            <p class="text-sm font-weight-bold mb-0">Edit</p>
                                            <p class="text-sm font-weight-bold mb-0 ps-2">Delete</p>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Add more rows here if needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Users table section -->

    @include('layouts.footer')
</div>
@endsection
