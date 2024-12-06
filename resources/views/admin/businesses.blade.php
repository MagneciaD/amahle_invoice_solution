<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="min-vh-100 bg-light py-5">
    <div class="container px-4">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="display-4 text-success">
                🏢 Business Management
            </h1>
            <p class="text-muted">Manage and review all registered businesses</p>
        </div>

        <!-- Card Container -->
        <div class="bg-white rounded-4 shadow-lg p-5">
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="bg-success text-white">
                        <tr>
                            <th>Company owner</th>
                            <th>Company name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                    <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->company_name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->number }}</td>
                    <td class="text-center">
                      <form action="{{ route('admin.companies.delete', $company->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>