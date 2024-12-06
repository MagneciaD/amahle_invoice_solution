<div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px; width: 100%; max-height: 600px;">
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <div class="modal-content border-0" 
                style="
                    border-radius: 20px; 
                    overflow: hidden; 
                    background: linear-gradient(145deg, #e2f1eb, #c8dfd7); 
                    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
                ">
                <!-- Modal Header -->
                <div class="modal-header bg-gradient-to-r from-green-200 to-white p-4 rounded-t-lg">
                    <h5 class="modal-title text-xl font-bold" id="clientModalLabel" 
                        style="margin: 0; font-size: 1.8rem; color: #495057;">
                        Add New Client
                    </h5>
                    <button type="button" 
                        class="btn-close position-absolute end-0 top-0 m-3" 
                        data-bs-dismiss="modal" aria-label="Close" 
                        style="background-color: white; opacity: 0.8; border-radius: 50%;"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="padding: 2rem;">
                    <!-- Name and Details Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label" style="font-weight: 500;">Client Name</label>
                            <input type="text" class="form-control shadow-sm" id="name" name="name" required 
                                style="
                                    border-radius: 10px; 
                                    padding: 0.75rem; 
                                    border: none; 
                                    box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);
                                ">
                        </div>
                        <div class="col-md-6">
                            <label for="client_details" class="form-label" style="font-weight: 500;">Client Details</label>
                            <textarea class="form-control shadow-sm" id="client_details" name="client_details" required 
                                style="
                                    border-radius: 10px; 
                                    padding: 0.75rem; 
                                    border: none; 
                                    box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);
                                    height: 3.5rem;
                                "></textarea>
                        </div>
                    </div>

                    <!-- Email and Phone Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label" style="font-weight: 500;">Email (optional)</label>
                            <input type="email" class="form-control shadow-sm" id="email" name="email" 
                                style="
                                    border-radius: 10px; 
                                    padding: 0.75rem; 
                                    border: none; 
                                    box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);
                                ">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label" style="font-weight: 500;">Phone (optional)</label>
                            <input type="text" class="form-control shadow-sm" id="phone" name="phone" 
                                style="
                                    border-radius: 10px; 
                                    padding: 0.75rem; 
                                    border: none; 
                                    box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);
                                ">
                        </div>
                    </div>

                    <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-0" style="padding: 1.5rem; display: flex; justify-content: flex-end;">
                    <button type="submit" 
                        class="btn btn-primary shadow-sm" 
                        style="
                            border-radius: 8px; 
                            background-color: #5cb85c; 
                            border: none; 
                            font-weight: 500; 
                            padding: 0.5rem 1rem; 
                            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
                        ">
                        Save Client
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
