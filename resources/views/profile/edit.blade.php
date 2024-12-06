<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Main Content Wrapper -->
        <div class="container-lg px-4">
            <!-- Profile Section Title -->
            <div class="row mb-4">
            <div class="col">
    <h3 class="text-center text-dark fw-bold display-5">Your Profile Settings</h3> <!-- Slightly smaller title -->
    <p class="text-center text-muted fs-5">Manage your account information, password, and more.</p> <!-- Slightly smaller description -->
</div>


            </div>

            <!-- Profile Update Form -->
            <div class="row g-4">
                <!-- Update Profile Information -->
                <div class="col-12 col-md-6">
                    <div class="card shadow-lg rounded-4 hover-shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">Update Profile Information</h5>
                            <p class="card-text text-muted">Change your profile details and keep your information up to date.</p>
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <!-- Update Password -->
                <div class="col-12 col-md-6">
                    <div class="card shadow-lg rounded-4 hover-shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">Update Password</h5>
                            <p class="card-text text-muted">Secure your account by changing your password.</p>
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!-- Company Section -->
            <div class="row g-4 mt-4">
                <div class="col-6">
                <div class="card shadow-lg rounded-4 hover-shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">Update Company</h5>
                            <p class="card-text text-muted">Update your Company Details</p>
                            @include('profile.partials.update-company')
                        </div>
                    </div>
                </div>
            <!-- Delete Account Section -->
            <div class="col-12 col-md-6">
            <div class="card shadow-lg rounded-4 hover-shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title text-danger">Delete Account</h5>
                            <p class="card-text text-muted">If you wish to delete your account, please proceed carefully.</p>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
