<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            height: 100vh;
            padding-top: 80px;
            position: fixed;
            top: 0;
            left: -250px;
            /* Initially hidden */
            transition: left 0.3s;
            z-index: 1000;
        }

        .sidebar.active {
            left: 0;
            /* Show sidebar */
        }

        .sidebar h3 {
            color: #ffff;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: #adb5bd;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: white;
        }

        .main-content {
            margin-left: 0;
            /* Adjusted when sidebar is toggled */
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .main-content.shifted {
            margin-left: 250px;
            /* Shift content when sidebar is visible */
        }

        .card-title,
        .table th {
            color: #343a40;
        }

        .status-paid {
            color: green;
            font-weight: bold;
        }

        .status-unpaid {
            color: red;
            font-weight: bold;
        }

        .table td,
        .table th {
            font-size: 0.9em;
            padding: 0.5em;
        }

        .table-responsive {
            position: relative;
        }

        .table-responsive::after {
            content: '→ Scroll for more';
            position: absolute;
            right: 10px;
            bottom: 10px;
            font-size: 0.8rem;
            color: #6c757d;
            display: none;
        }

        .table-responsive:hover::after {
            display: block;
        }
    </style>
</head>
<body>
   <!-- Sidebar Navigation -->
   <div class="sidebar" id="sidebar">
     <h3>amahle invoicing</h3>
      <a href="#dashboard">Dashboard</a>
      <a href="{{ route('admin.businesses') }}" id="businesses">Businesses</a>
      <a href="{{ route('admin.payments') }}" id="payments">Payments</a>
        <div class="mt-3 space-y-1">
          <form method="POST" action="{{ route('logout') }}">
             @csrf
              <x-responsive-nav-link :href="('logout')"
                 onclick="event.preventDefault();
                  this.closest('form').submit();">
                    {{ __('Sign Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
    <!-- Toggle Button for Sidebar -->
    <button class="btn btn-dark" id="sidebarToggle" style="position: absolute; top: 20px; left: 20px; z-index: 1001;">☰</button>
    <!-- Main Content -->
    <main class="col-md-10 ms-sm-auto col-lg-10 content">
        <!-- Adjusted H1 with margin for spacing -->
        <h1 style="margin-top: 20px; font-size: 2.5rem; text-align: center; color: #343a40;">Admin Dashboard</h1>
        @if(session('new_payment'))
        <div class="alert alert-success" role="alert" style="margin-top: 20px;">
            <strong>New Payment Received!</strong> Company: {{ session('new_payment')->company->company_name }} has made a payment of ${{ session('new_payment')->amount }}.
        </div>
        @endif
        <!-- Stats Cards -->
        <div class="row g-4" style="margin-top: 30px;">
            <div class="col-md-4 col-sm-6">
                <div class="card text-center" style="
                background-color: #ffffff; 
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.06);
                border-radius: 15px; 
                border: none; 
                padding: 20px; 
                transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div class="card-body" style="color: #343a40;">
                  <h5 class="card-title" style="font-size: 1.6rem; font-weight: bold;">$32,500</h5>
                    <p class="card-text" style="font-size: 1rem; margin-top: 10px;">Total Sales</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card text-center" style="
                background-color: #ffffff; 
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.06);
                border-radius: 15px; 
                border: none; 
                padding: 20px; 
                transition: transform 0.2s ease, box-shadow 0.2s ease;">
                    <div class="card-body" style="color: #343a40;">
                        <h5 class="card-title" style="font-size: 1.6rem; font-weight: bold;">200</h5>
                        <p class="card-text" style="font-size: 1rem; margin-top: 10px;">Total Companies</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card text-center" style="
                background-color: #ffffff; 
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.06);
                border-radius: 15px; 
                border: none; 
                padding: 20px; 
                transition: transform 0.2s ease, box-shadow 0.2s ease;">
                    <div class="card-body" style="color: #343a40;">
                        <h5 class="card-title" style="font-size: 1.6rem; font-weight: bold;">8</h5>
                        <p class="card-text" style="font-size: 1rem; margin-top: 10px;">Recently Paid</p>
                    </div>
                </div>
            </div>
            <!-- Charts Section -->
            <div class="row mt-4">
                <!-- Sales Chart -->
                <div class="col-md-8 col-sm-12">
                    <div class="card" style="
            background-color: #ffffff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.06);
            border-radius: 15px; 
            border: none; 
            transition: transform 0.2s ease, box-shadow 0.2s ease;">
                        <div class="card-body" style="padding: 20px;">
                            <h5 class="card-title" style="
                    font-size: 1.6rem; 
                    font-weight: bold; 
                    margin-bottom: 20px; 
                    color: #343a40;">Sales Performance</h5>
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recently Paid Table -->
                <div class="col-md-4 col-sm-12">
                    <div class="card" style="
        background-color: #ffffff;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.06);
        border-radius: 15px; 
        border: none; 
        transition: transform 0.2s ease, box-shadow 0.2s ease;">
                        <div class="card-body" style="padding: 20px;">
                            <h5 class="card-title" style="
                font-size: 1.6rem; 
                font-weight: bold; 
                margin-bottom: 20px; 
                color: #343a40; 
                display: flex; 
                align-items: center; 
                justify-content: space-between;">
                                <span>Recently Paid</span>
                                <!-- Notification Icon -->
                                <span style="position: relative; cursor: pointer;">
                                    <i class="fas fa-bell" style="font-size: 1.5rem; color: #ffc107;"></i>
                                    @if(session('new_payment'))
                                    <span style="
                        position: absolute;
                        top: -5px;
                        right: -5px;
                        background: red;
                        color: white;
                        font-size: 0.8rem;
                        border-radius: 50%;
                        padding: 2px 6px;
                        font-weight: bold;">1</span>
                                    @endif
                                </span>
                            </h5>
                            <table class="table table-striped" style="font-size: 0.9rem;">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Payment Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentPayments as $payment)
                                    <tr>
                                        <td>{{ $payment->company->company_name }}</td>
                                        <td>{{ $payment->payment_date }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Recent Purchases -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card" style="
            background-color: #ffffff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.06);
            border-radius: 15px; 
            border: none; 
            transition: transform 0.2s ease, box-shadow 0.2s ease;">
                            <div class="card-body" style="padding: 20px;">
                                <h5 class="card-title" style="
                    font-size: 1.6rem; 
                    font-weight: bold; 
                    margin-bottom: 20px; 
                    color: #343a40;">Registered Companies</h5>
                                <!-- Responsive Table -->
                                <div class="table-responsive">
                                    <table class="table table-striped" style="font-size: 0.9rem;">
                                        <thead>
                                            <tr>
                                                <th>Business Name</th>
                                                <th>Owner</th>
                                                <th>Email</th>
                                                <th>Next Payment Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($companies as $company)
                                            <tr>
                                                <td>{{ $company->company_name }}</td>
                                                <td>{{ $company->user->name }}</td>
                                                <td>{{ $company->email }}</td>
                                                <td>
                                                    @if($company->payments->isNotEmpty() && $company->payments->first()->status === 'completed')
                                                    {{ $company->payments->first()->next_payment_date }}
                                                    @else
                                                    <span class="status-unpaid">No payment made yet</span>
                                                    @endif
                                                </td>
                                                <td>
    <div class="d-flex justify-content-start">
        <!-- Details Button -->
        <a href="" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#companyDetailsModal-{{ $company->id }}">
            Details
        </a>
        
    </div>
</td>

                                </div>

                                </tr>
                                @include('partials.modals.company_details', ['company' => $company])
                                @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

    </main>
    </div>
    </div>

    <!-- Bootstrap and Chart.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Example chart setup
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Sales',
                    data: [1200, 1500, 1300, 1700, 1600, 1800],
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)'
                }]
            }
        });
    </script>
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            var mainContent = document.getElementById('mainContent');

            // Toggle sidebar visibility
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('shifted');
        });
    </script>
</body>

</html>