@extends('layouts.sidenav')

@section('head')
    {{-- style, script, manggil library script cdn --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="argon/assets/css/argon-dashboard.css">

    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response.decision) {
                            displayDecisionModal(response
                            .decision); // Pass the decision message to the modal
                        } else {
                            console.error('Invalid response:',
                            response); // Log error if response is invalid
                        } // Display decision message
                    }
                });
            });
        });

        function displayDecisionModal(message) {
            $('#decisionMessage').text(message); // Set the decision message
            $('#decisionModal').modal('show'); // Show the modal
        }
    </script>
@endsection

@section('content')
    @include('layouts.topnav', ['title' => 'Decision Support System'])

    {{-- Di sini baru ngoding, buatla apa gitu --}}
    <div class="container-fluid py-4">

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Production Decision</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('production.decision') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col form-group">
                                    <label for="totalToys">Total Toys to Produce:</label>
                                    <input type="number" class="form-control" id="totalToys" name="totalToys" required>
                                    <small id="toyLimitError" class="text-danger" style="display: none;">The maximum number
                                        of toys to produce is 5000 per month.</small>
                                </div>
                                <div class="col form-group">
                                    <label for="months">Production Duration (Months):</label>
                                    <input type="number" class="form-control" id="months" name="months" required>
                                </div>
                            </div>
                            <center class="mt-4 mb-1">
                                <button type="submit" id="submitButton" class="btn btn-primary">Evaluate Production
                                    Decision</button>
                            </center>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Production</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $qty }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Adherence</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($averageAdherence, 2) }}%
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mt-4 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Lead Time</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($averageLead, 2) }} Weeks
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mt-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Cost</p>
                                    <h5 class="font-weight-bolder">
                                        Rp {{ number_format($averageCost, 2, ',', '.') }}
                                    </h5>
                                </div>

                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
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
                        <h6 class="text-capitalize">Production Overview by Months</h6>
                    </div>
                    <div class="card-body p-3">
                        {{-- Bar Chart --}}
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">

            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Summary of Adherence & Lead Time</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <canvas id="adherenceChart" width="400" height="200"></canvas>
                        <canvas id="leadTimeChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Project Summary</h6>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            <canvas id="myPieChart" width="200" height="200"></canvas>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="decisionModal" tabindex="-1" aria-labelledby="decisionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="decisionModalLabel">Production Decision</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Decision message will be displayed here -->
                        <p id="decisionMessage"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
        function displayDecisionModal(message) {
            $('#decisionMessage').text(message); // Set the decision message
            $('#decisionModal').modal('show'); // Show the modal
        }
    </script>
    {{-- Nambahin footer dari layout || footer di akhir --}}
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var productionData = <?php echo json_encode($productionByMonth); ?>;

        // Inisialisasi label bulan dan jumlah produksi
        var months = [];
        var productions = [];

        // Loop untuk mengisi data bulan dan produksi
        productionData.forEach(function(item) {
            months.push(item.month);
            productions.push({
                x: item.month,
                y: item.total,
                total: item.total
            });
        });

        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(0, 119, 182, 0.2)'); // Matching border color
        gradientStroke1.addColorStop(0.6, 'rgba(0, 119, 182, 0.0)'); // Adjusted stop
        gradientStroke1.addColorStop(0, 'rgba(0, 119, 182, 0)'); // Matching border color
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: months,
                datasets: [{
                    label: "Product",
                    tension: 0, // Set tension to 0
                    borderWidth: 3,
                    borderColor: "#0077b6",
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: productions,
                    maxBarThickness: 6
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Total: ' + context.parsed.y;
                            }
                        }
                    }
                },
            },
        });
    </script>

    <script>
        document.getElementById('totalToys').addEventListener('input', validateInput);
        document.getElementById('months').addEventListener('input', validateInput);

        function validateInput() {
            const totalToysInput = document.getElementById('totalToys');
            const monthsInput = document.getElementById('months');
            const totalToys = parseInt(totalToysInput.value) || 0;
            const months = parseInt(monthsInput.value) || 0;
            const maxToysPerMonth = 5000;
            const maxToysPerYear = 60000;
            const errorElement = document.getElementById('toyLimitError');
            const submitButton = document.getElementById('submitButton');

            if (months === 0) {
                // Prevent division by zero and invalid input
                errorElement.style.display = 'block';
                errorElement.textContent = 'Production duration must be at least 1 month.';
                submitButton.disabled = true;
                return;
            }

            if (totalToys > maxToysPerMonth * months || totalToys > maxToysPerYear) {
                errorElement.style.display = 'block';
                errorElement.textContent = `The maximum number of toys to produce is ${maxToysPerMonth} per month.`;
                submitButton.disabled = true;
            } else {
                errorElement.style.display = 'none';
                submitButton.disabled = false;
            }
        }
    </script>


    {{-- Modal harus di luar div --}}
    <script>
        var statusLabels = <?php echo json_encode($statusLabels); ?>;
        var statusData = <?php echo json_encode($statusData); ?>;
        var statusColors = <?php echo json_encode($statusColors); ?>;

        // JavaScript code to create the pie chart
        document.addEventListener('DOMContentLoaded', function() {
            // Get the canvas element
            var ctx = document.getElementById('myPieChart').getContext('2d');

            // Define the data for the pie chart
            var data = {
                labels: statusLabels,
                datasets: [{
                    data: statusData,
                    backgroundColor: statusColors
                }]
            };

            // Create the pie chart
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: data
            });
        });
    </script>

    <script>
        var averageAdherence = parseFloat("{{ number_format($averageAdherence, 2) }}");
        var averageLead = parseFloat("{{ number_format($averageLead, 2) }}");

        // Data for adherence chart
        var adherenceData = {
            labels: ['{{ number_format($averageAdherence, 2) }}%'],
            datasets: [{
                label: 'Adherence',
                data: [averageAdherence],
                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Blue color with adjusted opacity
                borderColor: 'rgba(54, 162, 235, 1)', // Border color if needed
                borderWidth: 1
            }]
        };

        // Data for lead time chart
        var leadTimeData = {
            labels: ['{{ number_format($averageLead, 2) }} Weeks'],
            datasets: [{
                label: 'Lead Time',
                data: [averageLead],
                backgroundColor: 'rgba(75, 192, 192, 0.5)', // Green color with adjusted opacity
                borderColor: 'rgba(75, 192, 192, 1)', // Border color if needed
                borderWidth: 1
            }]
        };

        // Chart configuration
        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Adherence chart
        var ctxAdherence = document.getElementById('adherenceChart').getContext('2d');
        var adherenceChart = new Chart(ctxAdherence, {
            type: 'bar',
            data: adherenceData,
            options: options
        });

        // Lead time chart
        var ctxLeadTime = document.getElementById('leadTimeChart').getContext('2d');
        var leadTimeChart = new Chart(ctxLeadTime, {
            type: 'bar',
            data: leadTimeData,
            options: options
        });
    </script>

    {{-- Masukin script di sini --}}
@endsection
