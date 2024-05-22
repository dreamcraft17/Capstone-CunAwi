@extends('layouts.sidenav')

@section('head')
    {{-- style, script, manggil library script cdn --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="argon/assets/css/argon-dashboard.css">

    <style>


    </style>
@endsection

@section('content')
    @include('layouts.topnav', ['title' => 'Profile'])

    {{-- Di sini baru ngoding, buatla apa gitu --}}
    <div class="container">
        <div class="card shadow-lg mx-4">
            <div class="card-body p-3">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="https://en.meming.world/images/en/7/7f/Polish_Jerry.jpg" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ Auth::user()->name }}
                            </h5>

                            <p class="mb-0 font-weight-bold text-sm">
                                {{ Auth::user()->role }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <div class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                        data-bs-toggle="tab" role="tab" aria-selected="false">
                                        <i class="ni ni-email-83"></i>
                                        <span class="ms-2">
                                            {{ Auth::user()->division }}
                                        </span>
                                    </div>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                        <i class="ni ni-email-83"></i>
                                        <span class="ms-2">Setting</span>
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">{{ $title }}</p>
                                <button id="editButton" class="btn btn-primary btn-sm ms-auto">Edit</button>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="card-body">
                            <p class="text-uppercase text-sm">User Information</p>
                            <form id="updateProfileForm" action="{{ route('update_profile') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <!-- Tambahkan input hidden untuk mengirim user_id -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Name</label>
                                            <input id="name" name="name" class="form-control" type="text"
                                                value="{{ $user->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username" class="form-control-label">Username</label>
                                            <input id="username" name="username" class="form-control" type="text"
                                                value="{{ $user->username }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Email address</label>
                                            <input id="email" name="email" class="form-control" type="email"
                                                value="{{ $user->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role" class="form-control-label">Role</label>
                                            <input id="role" name="role" class="form-control" type="text"
                                                value="{{ $user->role }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: right;" class="mt-4">
                                    <button id="cancelButton" class="btn btn-secondary btn-sm ms-2"
                                        style="display: none;">Cancel</button>
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

            @if (session('role') == 'Admin')
                <div class="row mt-4 mx-2">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h6>Users</h6>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Name
                                                </th>
                                                <th class="text-center">
                                                    Role
                                                </th>
                                                <th class="text-center">
                                                    Create Date</th>
                                                <th class="text-center">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td class="text-center">{{ $user->name }}</td>
                                                    <td class="text-center">{{ $user->role }}</td>
                                                    <td class="text-center">{{ $user->created_at }}</td>
                                                    <td class="text-center">
                                                        <form action="{{ route('delete_user', ['id' => $user->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                                        </form>
                                                    </td>


                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        {{-- Nambahin footer dari layout || footer di akhir --}}
        @include('layouts.footer')
    </div>
    {{-- Nambahin footer dari layout || footer di akhir --}}


    {{-- Modal harus di luar div --}}
    {{-- Modal harus di luar div --}}



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButton = document.getElementById("editButton");
            const cancelButton = document.getElementById("cancelButton");
            const saveButton = document.getElementById("saveChangesButton");
            const inputs = document.querySelectorAll("input[readonly]");

            // Toggle antara mode baca-saja dan mode edit untuk input
            function toggleInputs(readonly) {
                inputs.forEach(input => {
                    input.readOnly = readonly;
                });
                saveButton.disabled = readonly;
                cancelButton.style.display = readonly ? "none" : "inline-block";
            }

            // Event listener untuk klik tombol Edit
            editButton.addEventListener("click", function() {
                toggleInputs(false); // Aktifkan mode edit
            });

            // Event listener untuk klik tombol Simpan
            saveButton.addEventListener("click", function() {
                // Kirim form untuk menyimpan perubahan
                document.getElementById("updateProfileForm").submit();
            });

            // Event listener untuk klik tombol Batal
            cancelButton.addEventListener("click", function() {
                // Batalkan mode edit dan kembalikan nilai input
                toggleInputs(true);
            });

            // Event listener untuk perubahan input
            inputs.forEach(input => {
                input.addEventListener("input", function() {
                    saveButton.disabled = false; // Aktifkan tombol Simpan saat ada perubahan input
                });
            });
        });
    </script>


    {{-- Masukin script di sini --}}
@endsection
