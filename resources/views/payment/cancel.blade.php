<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <!-- Include SweetAlert CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.js"></script>

    <script>
        Swal.fire({
            title: 'Payment Cancelled!',
            text: 'There was an issue with your payment. Please try again later.',
            icon: 'warning',
            confirmButtonText: 'OK',
            confirmButtonColor: '#f39c12'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/invoices';  
            }
        });
    </script>
</body>
</html>
