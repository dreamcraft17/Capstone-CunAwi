@extends('layouts.sidenav')

@section('head')
{{-- style, script, manggil library script cdn --}}
<link rel="stylesheet" href="argon/assets/css/argon-dashboard.css">
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
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Filter</option>
                            <option>New Added</option>
                            <option>Due Date</option>
                            <option>Priority</option>
                        </select>
                    </div>
                </div>

                @foreach($projects as $project)
                <div class="row mt-4">
                    <div class="col">
                        <div class="list-group">
                            <a href="{{ route('projectlist', ['project_id' => $project->projectID]) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $project->productID }}</h6>
                                    <small>{{ $project->finish_cmt }}</small>
                                </div>
                                <p class="mb-1">{{ $project->date_commit }}</p>
                            </a>
                            <!-- Add more tasks here if needed -->
                        </div>
                    </div>
                </div>
                @endforeach








            </div>
        </div>
    </div>

    @include('layouts.footer')
</div>
{{-- Nambahin footer dari layout || footer di akhir --}}
@endsection