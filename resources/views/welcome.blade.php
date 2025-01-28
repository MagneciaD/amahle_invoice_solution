<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('img/b.png') }}');
            background-size: cover;
            background-position: center;
            overflow: hidden;
            position: relative;
        }

        body:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dim overlay */
            z-index: 0;
            backdrop-filter: blur(4px); /* Adds blur to the background */
        }

        .hero {
            text-align: center;
            position: relative;
            z-index: 1; /* Ensures content is above the overlay */
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #ffffff;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7); /* Pop-out effect */
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent box for better visibility */
            padding: 10px 20px;
            border-radius: 10px;
        }

        .hero p {
            font-size: 1rem;
            color: #e0e0e0;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
            background: rgba(0, 0, 0, 0.4); /* Semi-transparent box */
            padding: 10px 20px;
            border-radius: 10px;
            line-height: 1.5;
        }

        .hero-img {
            max-width: 240px;
            height: auto;
            margin-bottom: 1rem;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.3)); /* Shadow for depth */
        }

        .btn-custom {
            margin: 1rem;
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            font-weight: bold;
            color: #fff;
            background-color: #00a859; /* Vibrant green */
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Depth effect */
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-custom:hover {
            transform: scale(1.05); /* Slight enlargement */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
        }

        .floating-ball {
            width: 80px;
            height: 80px;
            background-color: #00a859;
            position: absolute;
            border-radius: 50%;
            animation: float 6s infinite ease-in-out;
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="hero">
        <img src="{{ asset('img/amahle1.png') }}" alt="Invoicing Illustration" class="img-fluid hero-img">
        <h1>Welcome to Amahle Invoice Solution</h1>
        <p>Your smart, fast, and hassle-free way to manage invoices. We're here to make your billing experience simple, <br> Let’s get started! 👋</p>

        @if (Route::has('login'))
        <nav class="d-flex justify-content-center gap-3">
            @auth
            <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-custom">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-custom">Log In</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-custom">Sign Up</a>
            @endif
            @endauth
        </nav>
        @endif
    <script src="https://cdn.jsdelivr.net/npm/@lottiefiles/lottie-player"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
   
</body>

</html>
