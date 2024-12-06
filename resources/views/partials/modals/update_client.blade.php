<div class="modal fade" id="updateClientModal" tabindex="-1" aria-labelledby="updateClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px; width: 100%; max-height: 600px;">
        <div class="modal-content border-0" 
            style="
                border-radius: 20px; 
                overflow: hidden; 
                background: linear-gradient(145deg, #e2f1eb, #c8dfd7); 
                color: #495057; 
                box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            ">
            <!-- Modal Header (Updated) -->
            <div class="modal-header bg-gradient-to-r from-green-200 to-white p-4 rounded-t-lg" style="display: flex; justify-content: space-between; align-items: center;">
                <h5 class="modal-title text-xl font-bold" id="updateClientModalLabel" style="margin: 0; font-size: 1.6rem;">
                    Update Client Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: gray;"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" style="padding: 2rem; background: linear-gradient(145deg, #f1f8f6, #e3f1ee); border-radius: 0 0 20px 20px; box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.1);">
                <form id="updateClientForm" action="{{ route('client.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="client-id">
                    
                    <div class="mb-3">
                        <label for="client-name" class="form-label" style="font-weight: 500;">Name</label>
                        <input type="text" class="form-control shadow-sm" name="name" id="client-name" required style="border-radius: 10px; padding: 0.75rem; border: none; box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);">
                    </div>
                    
                    <div class="mb-3">
                        <label for="client-details" class="form-label" style="font-weight: 500;">Client Details</label>
                        <textarea class="form-control shadow-sm" name="client_details" id="client-details" required style="border-radius: 10px; padding: 0.75rem; border: none; box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="client-email" class="form-label" style="font-weight: 500;">Email</label>
                        <input type="email" class="form-control shadow-sm" name="email" id="client-email" style="border-radius: 10px; padding: 0.75rem; border: none; box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);">
                    </div>
                    
                    <div class="mb-3">
                        <label for="client-phone" class="form-label" style="font-weight: 500;">Phone</label>
                        <input type="text" class="form-control shadow-sm" name="phone" id="client-phone" style="border-radius: 10px; padding: 0.75rem; border: none; box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);">
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100" 
                        style="
                            border-radius: 8px; 
                            background: linear-gradient(145deg, #4caf50, #2e7d32); 
                            color: #fff; 
                            font-size: 1.2rem; 
                            font-weight: bold; 
                            padding: 0.75rem; 
                            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); 
                            border: none; 
                            transition: transform 0.2s ease, box-shadow 0.2s ease;">
                        Update Client
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
