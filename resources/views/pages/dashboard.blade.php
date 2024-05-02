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
@include('layouts.topnav', ['title' => 'Dashboard'])

{{-- Di sini baru ngoding, buatla apa gitu --}}
<div class="container">
    <div class="card overflow-hidden">
        <div class="bg-soft">
            <div class="row">
                <div class="col m-4">
                    <h2 style="color: black;"> Hello, {{ $name }}! </h1>
                        <h6 class="card-title">Always make sure to update your project progress.</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row-lg-10">
        <div class="card mt-4" style="background-color: #4b5a90;">
            <div class="card-body">
                <h5 class="card-title mb-4" style="color: white;">Project Preview</h5>
                <div class="row">
                    <div class="col">
                        <div class="card" style="background-color: #fbe4ef;">
                            <a href="{{ route('taskmanager') }}" class="card-body">
                                <h5 class="card-title">Project</h5>
                                <h1 class="card-text text-center p-5">{{ $projectCount }} <span style="font-size: 13px;" class="text-dark">Project(s)</span></h1>
                            </a>
                        </div>

                    </div>

                    <div class="col">
                        <div class="card" style="background-color: #fbe4ef;">
                            <a href="{{ route('draft') }}" class="card-body">
                                <h5 class="card-title">Draft </h5>
                                <h1 class="card-text text-center p-5">12 <span style="font-size: 13px;" class="text-dark">Project(s)</span></h1>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-5">Summary</h5>
                                <div class="mb-5">

                                    <div class="progress mb-3" style="height: 20px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </div>
                                    <div class="progress mb-3" style="height: 20px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                    </div>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                    </div>

                                </div>

                                <div class="mt-5 ml-5 mb-2">
                                    <p class="badge rounded-pill bg-success d-inline-block">Completed</p>
                                    <p class="badge rounded-pill bg-warning d-inline-block">On Going</p>
                                    <p class="badge rounded-pill bg-danger text-dark d-inline-block">Drop</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Project Count by Month</h6>
                    <!-- Add other designer options as needed -->
                    <canvas id="myChart" width="700px" height="200px"></canvas>
                    {{-- <p class="text-sm mb-0">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% more</span> in 2021
                        </p> --}}
                </div>
                <div class="card-body p-3">
                    {{-- ISI BAR CHART --}}
                    {{-- <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-5">

        </div>
    </div>

    @include('layouts.footer')
</div>
{{-- Nambahin footer dari layout || footer di akhir --}}

<script>
    var productionData = <?php echo json_encode($productionByMonth);?>;
    var months = [];
    var productions =[];

    productionData.forEach(function(item) {
    months.push(item.month);
    productions.push({x: item.month, y: item.total, total: item.total});
});


    var data = {
        labels:months,
        datasets: [{
            label: 'Product Sample',
            data: productions,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Chart configuration
    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };


    var ctx = document.getElementById('myChart').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });
</script>







{{-- Masukin script di sini --}}
@endsection