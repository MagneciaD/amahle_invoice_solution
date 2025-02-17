<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="container-fluid" style="padding: 40px; margin-top: 0;">
        <div class="row">
            <!-- Main Content -->
            <div class="d-flex justify-content-center align-items-center mb-4">
                <div class="d-flex align-items-center" style="position: relative; width: 300px;">
                    <!-- Search Icon -->
                    <i class="fas fa-search"
                        style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); 
                  color: #888;"></i>
                   <!-- Search Bar -->
                   <input type="text" class="form-control me-3" id="search-bar" placeholder="Search"
                        style="border-radius: 25px; padding: 10px 20px 10px 40px; width: 100%; 
               box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border: 1px solid #ccc; 
               transition: box-shadow 0.3s ease; outline: none;"
                        onfocus="this.style.boxShadow='0 4px 12px rgba(0, 123, 255, 0.4)';"
                        onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)';">
                    <!-- Dropdown Container -->
                    <div id="search-results" style="position: absolute; top: 100%; left: 0; width: 100%; background: white; 
                border: 1px solid #ccc; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); z-index: 1000; max-height: 200px; 
                overflow-y: auto; border-radius: 8px; display: none;"></div>
                </div>
            
            </div>
            <!-- Overview Cards and Invoice Status Chart -->
            <div class="row">
                <!-- Cards -->
                <div class="col-md-8">
                    <div class="row justify-content-start"> <!-- Total Invoices Card -->
                        <div class="col-md-5 mb-4 offset-md-1">
                            <div class="card p-4" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #f0f4f8, #dfe8ec); min-height: 150px;"> <!-- Increased padding and added min-height -->
                                <h5 style="font-family: Arial, sans-serif; color: #333;">Total</h5>
                                <p style="font-size: 18px; font-weight: bold; color: #007bff;">{{ $totalInvoices }} Invoices</p>
                            </div>
                        </div>
                        <!-- Paid Invoices Card -->
                        <div class="col-md-5 mb-4 ">
                            <div class="card p-4" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #f0f4f8, #dfe8ec); min-height: 150px;"> <!-- Increased padding and added min-height -->
                                <h5 style="font-family: Arial, sans-serif; color: #333;">Paid</h5>
                                <p style="font-size: 18px; font-weight: bold; color: #28a745;">{{ $paidInvoices }} Invoices</p>
                            </div>
                        </div>
                        <!-- Unpaid Invoices Card -->
                        <div class="col-md-5 mb-4 offset-md-1">
                            <div class="card p-4" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #f0f4f8, #dfe8ec); min-height: 150px;"> <!-- Increased padding and added min-height -->
                                <h5 style="font-family: Arial, sans-serif; color: #333;">Unpaid</h5>
                                <p style="font-size: 18px; font-weight: bold; color: #dc3545;">{{ $unpaidInvoices }} Invoices</p>
                            </div>
                        </div>

                        <!-- overdue Invoices Card -->
                        <div class="col-md-5 mb-4 ">
                            <div class="card p-4" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #f0f4f8, #dfe8ec); min-height: 150px;"> <!-- Increased padding and added min-height -->
                                <h5 style="font-family: Arial, sans-serif; color: #333;">Overdue</h5>
                                <p style="font-size: 18px; font-weight: bold; color: #ffc107;"> {{ $overdueInvoices }} Invoices</p>
                            </div>
                        </div>
                    </div>
                </div>

                  <!-- Pie Chart -->
                <div class="col-md-4">
                    <div class="card p-4" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #f0f4f8, #dfe8ec);">
                        <h5 style="font-family: Arial, sans-serif; color: #333;">Invoice Status</h5>
                        <div class="chart-container">
                            <canvas id="invoiceChart" style="height: 450px;"></canvas>
                        </div>
                    </div>
                </div>


              <!-- Filter Buttons -->
<div class="row mt-4">
    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
        <!-- Clients List and Create Invoice Button (Right-aligned) -->
        <div class="d-flex ms-auto align-items-center">
            <div class="dropdown me-3">
                <button class="btn" style="color: black; background: transparent; border: none;" type="button" id="clientsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Clients List
                </button>
                <ul class="dropdown-menu" aria-labelledby="clientsDropdown" style="border: none;">
                    @foreach($clients as $client)
                        <li>
                            <a class="dropdown-item client-option" href="#" data-id="{{ $client->id }}" data-name="{{ $client->name }}" data-details="{{ $client->client_details }}" data-email="{{ $client->email }}" data-phone="{{ $client->phone }}" style="color: black; background: transparent; border: none;">
                                {{ $client->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                @include('partials.modals.update_client') <!-- Include the invoice modal -->

            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createInvoiceModal" 
                    style="background-color: #43BA7F; color: white; font-size: 0.875rem; padding: 8px 16px; border: none; border-radius: 5px;">
                Create Invoice
            </button>
            @include('partials.modals.create_invoice') <!-- Include the invoice modal -->

        </div>
    </div>

    <!-- Invoice Filter Buttons (Below Clients List and Create Invoice Button) -->
    <div class="col-12 d-flex flex-wrap justify-content-start align-items-center mt-3">
        <button class="btn me-2" id="allInvoicesBtn" style="background-color: transparent; border: none; color: #007bff; padding: 8px 16px; font-size: 14px;">
            All Invoices
        </button>
        <button class="btn me-2" id="paidInvoicesBtn" style="background-color: transparent; border: none; color: #28a745; padding: 8px 16px; font-size: 14px;">
            Paid
        </button>
        <button class="btn" id="unpaidInvoicesBtn" style="background-color: transparent; border: none; color: #dc3545; padding: 8px 16px; font-size: 14px;">
            Unpaid
        </button>
    </div>
</div>


<div class="table-container">
    <div class="table-responsive">
        <table id="invoiceTable" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
            <thead style="background: #43BA7F; color: #fff;">
                <tr>
                    <th style="padding: 12px; text-align: left; font-size: 16px;">Invoice</th>
                    <th style="padding: 12px; text-align: left; font-size: 16px;">Client Name</th>
                    <th style="padding: 12px; text-align: left; font-size: 16px;">Due Date</th>
                    <th style="padding: 8px; border: none; text-align: left; font-size: 14px;">Status</th>
                    <th style="padding: 12px; text-align: left; font-size: 16px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr class="invoice-row" data-status="{{ $invoice->status }}" style="background-color: #f8f9fa; transition: background-color 0.3s; cursor: pointer;">
                    <td style="padding: 12px; border-bottom: 1px solid #dee2e6; font-size: 16px;">{{ $invoice->invoice_number }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #dee2e6; font-size: 16px;">{{ $invoice->client->name }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #dee2e6; font-size: 16px;">{{ \Carbon\Carbon::parse($invoice->date)->format('d M, Y') }}</td>
                    <td style="padding: 8px; border-bottom: 1px solid #dee2e6; font-size: 14px;">
                                                <span class="badge {{ $invoice->status == 'paid' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ ucfirst($invoice->status) }}
                                                </span>
                                                <a href="javascript:void(0);" onclick="updateStatus({{ $invoice->id }})" title="Change Status" style="color: #007bff; text-decoration: none; margin-left: 8px;">
                                                    <i class="fas fa-sync-alt" style="font-size: 16px;"></i>
                                                </a>
                                            </td>
                    <td style="padding: 12px; border-bottom: 1px solid #dee2e6; font-size: 16px;">
                        <a href="#" title="Edit" class="me-2" style="color: #007bff; text-decoration: none;">
                            <i class="fas fa-edit" style="font-size: 18px;"></i>
                        </a>
                        <a href="{{ route('invoices.preview', $invoice->id) }}" title="Preview" class="me-2">
                            <i class="fas fa-eye" style="font-size: 18px;"></i>
                        </a>
                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link p-0" title="Delete" onclick="return confirm('Are you sure you want to delete this invoice?');" style="color: #dc3545; padding: 0; border: none; background: none;">
                                <i class="fas fa-trash-alt" style="font-size: 18px;"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<style>
    /* Ensure table is responsive */
    @media (max-width: 768px) {
        table {
            font-size: 12px; /* Adjust font size for smaller screens */
        }
        th, td {
            padding: 4px; /* Reduce padding for smaller screens */
        }
    }

    /* Make table even more responsive for very small screens */
    @media (max-width: 480px) {
        table {
            font-size: 10px; /* Even smaller font size */
        }
        th, td {
            padding: 2px; /* Further reduce padding */
        }
    }
</style>

      

                    <style>
                        /* CSS for the active button underline */
                        .active {
                            text-decoration: underline;
                            font-weight: bold;
                            /* Optional: Make it bold */
                        }

                        #invoiceTable tbody tr:hover {
                            background-color: #e2e6ea;
                            /* Light gray on hover */
                        }
                    </style>

                    <!-- JavaScript for Filtering Invoices -->
                    <script>
                        // Function to handle button clicks
                        function setActiveButton(buttonId) {
                            const buttons = ['allInvoicesBtn', 'paidInvoicesBtn', 'unpaidInvoicesBtn'];
                            buttons.forEach(id => {
                                const button = document.getElementById(id);
                                if (id === buttonId) {
                                    button.classList.add('active'); // Add active class to the clicked button
                                } else {
                                    button.classList.remove('active'); // Remove active class from other buttons
                                }
                            });
                        }

                        document.getElementById('allInvoicesBtn').addEventListener('click', function() {
                            setActiveButton('allInvoicesBtn'); // Set the clicked button as active
                            filterInvoices('all');
                        });

                        document.getElementById('paidInvoicesBtn').addEventListener('click', function() {
                            setActiveButton('paidInvoicesBtn'); // Set the clicked button as active
                            filterInvoices('paid');
                        });

                        document.getElementById('unpaidInvoicesBtn').addEventListener('click', function() {
                            setActiveButton('unpaidInvoicesBtn'); // Set the clicked button as active
                            filterInvoices('unpaid');
                        });

                        function filterInvoices(status) {
                            let rows = document.querySelectorAll('.invoice-row');

                            rows.forEach(function(row) {
                                if (status === 'all') {
                                    row.style.display = '';
                                } else if (row.getAttribute('data-status') === status) {
                                    row.style.display = '';
                                } else {
                                    row.style.display = 'none';
                                }
                            });
                        }
                    </script>

    
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
    function updateStatus(invoiceId) {
        const icon = $('tr[data-id="' + invoiceId + '"] .fa-sync-alt'); // Get the recycle icon

        // Add the spinning class
        icon.addClass('spinning');

        $.ajax({
            url: '/invoices/update-status', // This should match the route
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: invoiceId
            },
            success: function(response) {
                if (response.status) {
                    const badge = $('tr[data-id="' + invoiceId + '"] .badge');
                    badge.text(response.status)
                         .removeClass('bg-danger bg-success')
                         .addClass(response.status === 'paid' ? 'bg-success' : 'bg-danger');

                    Swal.fire({
                        title: 'Success!',
                        text: 'Status changed to ' + response.status + '.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000 
                    }).then(() => {
                        window.location.href = '/invoices'; 
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Status update failed.',
                    icon: 'error',
                    showConfirmButton: true
                });
            },
            complete: function() {
                // Remove the spinning class after the request is complete
                icon.removeClass('spinning');
            }
        });
    }
</script>


                <script>
                    function redirectToTemplate(invoiceId) {
                        // Redirects to the choose template page for the specified invoice ID
                        window.location.href = `/invoices/choose-template/${invoiceId}`;
                    }
                </script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const invoiceData = {
            labels: ["Paid", "Unpaid", "Overdue"],
            datasets: [{
                label: "Invoice Status",
                data: [{{ $paidInvoices }}, {{ $unpaidInvoices }}, {{ $overdueInvoices }}], // Updated to include overdue
                backgroundColor: ["#28a745", "#dc3545", "#ffc107"],
            }]
        };

        const ctx = document.getElementById("invoiceChart").getContext("2d");
        new Chart(ctx, {
            type: "pie",
            data: invoiceData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: "top",
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ": " + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });

        // Filter invoices based on status
        document.getElementById("paidInvoicesBtn").addEventListener("click", function () {
            filterInvoices("paid");
        });

        document.getElementById("unpaidInvoicesBtn").addEventListener("click", function () {
            filterInvoices("unpaid");
        });

        document.getElementById("allInvoicesBtn").addEventListener("click", function () {
            filterInvoices("all");
        });

        function filterInvoices(status) {
            const rows = document.querySelectorAll(".invoice-row");
            rows.forEach(row => {
                if (status === "all" || row.getAttribute("data-status") === status) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    document.querySelectorAll('.client-option').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();
            const clientId = this.getAttribute('data-id');
            const clientName = this.getAttribute('data-name');
            const clientDetails = this.getAttribute('data-details');
            const clientEmail = this.getAttribute('data-email');
            const clientPhone = this.getAttribute('data-phone');

            // Populate modal fields
            document.getElementById('client-id').value = clientId;
            document.getElementById('client-name').value = clientName;
            document.getElementById('client-details').value = clientDetails;
            document.getElementById('client-email').value = clientEmail;
            document.getElementById('client-phone').value = clientPhone;

            // Show the modal
            var updateClientModal = new bootstrap.Modal(document.getElementById('updateClientModal'));
            updateClientModal.show();
        });
    });
</script>


<script>
document.getElementById('search-bar').addEventListener('input', function () {
    const query = this.value.trim();
    const resultsContainer = document.getElementById('search-results');

    if (query.length > 2) {  // Only search if query is longer than 2 characters
        fetch(`/search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                resultsContainer.innerHTML = '';  // Clear previous results
                resultsContainer.style.display = 'block';  // Show the dropdown

                if (data.length > 0) {
                    data.forEach(invoice => {
                        const resultItem = document.createElement('div');
                        resultItem.style.padding = '10px';
                        resultItem.style.cursor = 'pointer';
                        resultItem.style.borderBottom = '1px solid #eee';

                        // Add event listener to redirect to invoice details
                        resultItem.addEventListener('click', () => {
                            window.location.href = `/invoices/${invoice.id}`;
                        });

                        // Format the display for each result (client name and invoice type)
                        resultItem.innerHTML = `
                            <p style="margin: 0;"><strong>${invoice.client.name}</strong> - ${invoice.invoice_type}</p>
                            <small>Status: ${invoice.status}</small>
                        `;
                        resultsContainer.appendChild(resultItem);
                    });
                } else {
                    resultsContainer.innerHTML = '<div style="padding: 10px;">No results found</div>';
                }
            })
            .catch(error => {
                console.error('Error fetching search results:', error);
                resultsContainer.innerHTML = '<div style="padding: 10px;">Error loading results</div>';
            });
    } else {
        resultsContainer.style.display = 'none';  // Hide dropdown if query is too short
    }
});

document.addEventListener('click', function (event) {
    const resultsContainer = document.getElementById('search-results');
    if (!resultsContainer.contains(event.target) && event.target.id !== 'search-bar') {
        resultsContainer.style.display = 'none';  // Close dropdown if clicked outside
    }
});

</script>

</x-app-layout>
