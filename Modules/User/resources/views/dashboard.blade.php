@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <!-- Welcome Message -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="card-title">Welcome to your Dashboard</h1>
                    <p class="card-text">This is where you can see an overview of your activities and access various sections of the system.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Graph Section -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Overview of Activities</h4>
                </div>
                <div class="card-body">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Message Board -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Message Board</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">Remember to update your profile.</li>
                        <li class="list-group-item">New user roles have been added.</li>
                        <li class="list-group-item">The system will undergo maintenance on Saturday.</li>
                        <!-- Add more messages as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- More Graphs or Cards Section -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>System Usage</h4>
                </div>
                <div class="card-body">
                    <canvas id="usageChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Recent Activities</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">User John Doe updated his profile.</li>
                        <li class="list-group-item">New role "Lab Technician" was created.</li>
                        <li class="list-group-item">A new patient record was added by Dr. Smith.</li>
                        <!-- Add more activities as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Activity Chart
    const ctxActivity = document.getElementById('activityChart').getContext('2d');
    const activityChart = new Chart(ctxActivity, {
        type: 'bar',
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            datasets: [{
                label: 'Number of Activities',
                data: [12, 19, 3, 5, 2, 3, 7],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Usage Chart
    const ctxUsage = document.getElementById('usageChart').getContext('2d');
    const usageChart = new Chart(ctxUsage, {
        type: 'pie',
        data: {
            labels: ['Doctors', 'Nurses', 'Pharmacists', 'Admins'],
            datasets: [{
                label: 'System Usage',
                data: [45, 25, 20, 10],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@endsection
