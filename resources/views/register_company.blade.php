<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container py-5">
    <h2 class="mb-4 text-center custom-heading">Register Your Company</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card for the form -->
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Owner Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                    </div>
                </div>

                <!-- Updated Address field as textarea -->
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" >{{ old('address') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="company_logo" class="form-label">Company Logo</label>
                    <input type="file" class="form-control" id="company_logo" name="company_logo">
                </div>

                <div class="mb-3">
                    <label for="company_details" class="form-label">Company Details</label>
                    <textarea class="form-control" id="company_details" name="company_details" placeholder="Vat No:&#10;CSD:&#10;add needed" rows="3" required></textarea>
                    </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="signature" class="form-label">Signature</label>
                        <input type="file" class="form-control" id="signature" name="signature" required>
                    </div>
                    <div class="col-md-6">
                        <label for="banking_details" class="form-label">Banking Details</label>
                        <textarea class="form-control" id="banking_details" name="banking_details" rows="3" required></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="number" name="number" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Register Company</button>
                </div>
            </form>
        </div>
    </div>
</div>
