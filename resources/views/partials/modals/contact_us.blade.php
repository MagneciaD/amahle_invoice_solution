<div class="modal fade" id="contactUsModal" tabindex="-1" aria-labelledby="contactUsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px; width: 90%; max-height: 700px;">
        <div class="modal-content border-0" 
            style="
                border-radius: 20px; 
                overflow: hidden; 
                background: linear-gradient(145deg, #e2f1eb, #c8dfd7); 
                box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
            ">
            <!-- Modal Header -->
            <div class="modal-header bg-gradient-to-r from-green-200 to-white p-4 rounded-t-lg">
                <h5 class="modal-title text-xl font-bold" id="contactUsModalLabel">Contact Us</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" 
                style="
                    padding: 2.5rem; 
                    background: linear-gradient(145deg, #d4f4dd, #e9f7eb); 
                    border-radius: 0 0 20px 20px; 
                    box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.1);
                ">
                <form method="POST" action="">
                    @csrf
                    <!-- Email Field -->
                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold" style="color: #495057;">Email</label>
                        <input type="email" class="form-control shadow-sm" id="email" name="email" placeholder="Enter your email" required 
                               style="
                                    border-radius: 10px; 
                                    padding: 0.9rem; 
                                    border: none; 
                                    background-color: #f1f3f5; 
                                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.1);
                                ">
                    </div>
                    <!-- Message Field -->
                    <div class="mb-4">
                        <label for="message" class="form-label fw-bold" style="color: #495057;">Message</label>
                        <textarea class="form-control shadow-sm" id="message" name="message" rows="4" placeholder="Write your message..." required 
                                  style="
                                    border-radius: 10px; 
                                    padding: 0.9rem; 
                                    border: none; 
                                    background-color: #f1f3f5; 
                                    box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.1);
                                  "></textarea>
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary shadow-sm w-100" 
                            style="
                                border-radius: 12px; 
                                background: linear-gradient(145deg, #4caf50, #2e7d32); 
                                color: #fff; 
                                font-size: 1.2rem; 
                                font-weight: bold; 
                                padding: 0.75rem; 
                                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2); 
                                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                            ">
                            Send Message
                        </button>
                    </div>
                </form>
                <!-- Encouraging Text Below -->
                <div class="mt-3 text-center" style="font-size: 1rem; color: #495057;">
                    <p>We’re here to assist you! Feel free to share your thoughts, and we’ll get back to you as soon as possible.</p>
                </div>
            </div>
        </div>
    </div>
</div>
