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
                    <h4>Overview of Client Activities</h4>
                </div>
                <div class="card-body">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Upcoming Billing Dates Message Board -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Upcoming Billing Dates</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($upcomingBillingClients as $client)
                            <li class="list-group-item">
                                {{ $client->name }} - Billing Date: {{ $client->payment_due_date->format('d M Y') }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Clients in Arrears Section -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Clients in Arrears</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Contact</th>
                                <th>Payment Status</th>
                                <th>Days Overdue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($arrearsClients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->location }}</td>
                                    <td>{{ $client->contact_person_phone }}</td>
                                    <td>{{ $client->payment_status }}</td>
                                    <td>{{ $client->days_overdue }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Clients with Upcoming Billing Dates Section -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Clients with Upcoming Billing Dates</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Billing Date</th>
                                <th>Invoice Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($upcomingBillingClients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->location }}</td>
                                    <td>{{ $client->payment_due_date->format('d M Y') }}</td>
                                    <td>{{ $client->billing_cycle_amount }}</td>
                                    <td>{{ $client->payment_status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            labels: ['Paid', 'Arrears', 'Upcoming'],
            datasets: [{
                label: 'Number of Clients',
                data: [{{ $paidCount }}, {{ $arrearsCount }}, {{ $upcomingCount }}],
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
</script>
@endsection
