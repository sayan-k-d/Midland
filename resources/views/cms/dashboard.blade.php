@extends('cms.layout.admin')
@section('title', 'Dashboard')
@section('content')

    <div class="py-4 main-container">
        <h1 class="mb-4">Admin Dashboard</h1>

        <!-- Cards Section -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary position-relative">
                    <div class="icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="card-body">
                        <h5 class="card-title">Appointments</h5>
                        <p class="card-text display-4">{{ $appointmentsCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success position-relative">
                    <div class="icon"><i class="fas fa-user-md"></i></div>
                    <div class="card-body">
                        <h5 class="card-title">Doctors</h5>
                        <p class="card-text display-4">{{ $doctorsCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info position-relative">
                    <div class="icon"><i class="fas fa-stethoscope"></i></div>
                    <div class="card-body">
                        <h5 class="card-title">Services</h5>
                        <p class="card-text display-4">{{ $servicesCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger position-relative">
                    <div class="icon"><i class="fas fa-building"></i></div>
                    <div class="card-body">
                        <h5 class="card-title">Departments</h5>
                        <p class="card-text display-4">{{ $departmentsCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row justify-content-around">
            <div class="col-md-7 chart-container d-flex flex-column justify-content-between">
                <h5 class="mb-3">Appointments by Month</h5>
                <canvas id="lineChart"></canvas>
            </div>
            <div class="col-md-4 chart-container">
                <h5 class="mb-3">Appointments by Department</h5>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
        <div class="row justify-content-around" style="min-height: 500px">
            <div class="col-md-5 table-section">
                <h5>Upcoming Appointments</h5>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Patient Name</th>
                            <th>Doctor</th>
                            <th>Department</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($upcomingAppointments as $appointment)
                            <tr>
                                <td>{{ $appointment->name }}</td>
                                <td>{{ $appointment->doctor_name }}</td>
                                <td>{{ $appointment->department }}</td>
                                <td>{{ $appointment->booking_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Calendar Section -->
            <div class="col-md-6 calendar-section">
                <h5>Calendar View</h5>
                <div id="calendar" style="height:90% !important;"></div>
            </div>
        </div>


    </div>

    <!-- Scripts -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"
        integrity="sha256-ZztCtsADLKbUFK/X6nOYnJr0eelmV2X3dhLDB/JK6fM=" crossorigin="anonymous"></script>
    <script src='fullcalendar/dist/index.global.js'></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Line Chart
            const lineChartCtx = document.getElementById("lineChart").getContext("2d");
            const lineChart = new Chart(lineChartCtx, {
                type: "line",
                data: {
                    labels: @json(array_keys($appointmentsByMonth->toArray())),
                    datasets: [{
                        label: "Appointments",
                        data: @json(array_values($appointmentsByMonth->toArray())),
                        borderColor: "#007bff",
                        backgroundColor: "rgba(0, 123, 255, 0.1)",
                        borderWidth: 2,
                    }, ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        x: {
                            title: {
                                display: true, // Show X-axis title
                                text: "Months",
                                font: {
                                    size: 16,
                                    weight: "bold",
                                },
                            },
                        },
                        y: {
                            title: {
                                display: true, // Show Y-axis title
                                text: "Number of Appointments",
                                font: {
                                    size: 16,
                                    weight: "bold",
                                },
                            },
                        },
                    },
                },
            });

            // Pie Chart
            const generateRandomColors = (count) => {
                const colors = ["#007bff",
                    "#28a745",
                    "#dc3545",
                    "#ffc107",
                    "#17a2b8",
                ];
                if (colors.length < count) {
                    for (let i = colors.length; i < count; i++) {
                        const randomColor = `rgba(${Math.floor(Math.random() * 255)},
                                          ${Math.floor(Math.random() * 255)},
                                          ${Math.floor(Math.random() * 255)}, 0.7)`;
                        colors.push(randomColor);
                    }
                }
                return colors;
            }

            const departmentLabels = @json(array_keys($departmentsDistribution->toArray()));
            const departmentCounts = @json(array_values($departmentsDistribution->toArray()));
            const pieChartColors = generateRandomColors(departmentLabels.length);

            const pieChartCtx = document.getElementById("pieChart").getContext("2d");
            const pieChart = new Chart(pieChartCtx, {
                type: "pie",
                data: {
                    labels: departmentLabels,
                    datasets: [{
                        data: departmentCounts,
                        backgroundColor: pieChartColors
                    }, ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "bottom",
                        },
                    },
                },
            });

            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'Asia/Kolkata',
                height: '90%',
                contentHeight: '90%',
                initialView: 'listDay',
                events: @json($appointmentsCalendar), // JSON of appointments
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                }
            });

            calendar.render();
        });
    </script>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ session('alertTitle') ?? 'Error' }}',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

@endsection
