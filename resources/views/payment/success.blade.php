<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <!-- Include SweetAlert CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.js"></script>

    <script>
        Swal.fire({
            title: 'Payment Successful!',
            text: 'Thank you for your payment. happy Invoicing',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/invoices';  // Redirect to home page or dashboard
            }
        });
    </script>

   
</body>
</html>
