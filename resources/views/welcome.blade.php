<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amahle Invoice Solution</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #ffffff, #d4f8e8); /* White to light green gradient */
            overflow: auto;
            font-family: 'Poppins', sans-serif;
        }

        .hero {
            text-align: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start; /* Changed from center to flex-start */
            position: relative;
            color: black;
            padding-top: 50px; /* Adds some space at the top */
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
            text-shadow: 2px 4px 10px rgba(0, 0, 0, 0.5);
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            opacity: 0.9;
        }

        .hero-img {
            width: 250px;
            animation: float 3s ease-in-out infinite;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.3));
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .btn-custom {
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-gray {
            background-color: #343a40; 
            border: none;
        }

        .btn-outline-gray {
            border: 2px solid #343a40; 
            color: #343a40;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
        }

        .floating-ball {
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, #00e676, #00a859);
            position: absolute;
            border-radius: 50%;
            opacity: 0.3;
            animation: float 5s infinite alternate;
        }

        .ball1 { top: 10%; left: 15%; animation-delay: 0.5s; }
        .ball2 { bottom: 15%; right: 20%; animation-delay: 1s; }
    </style>
</head>
<body>
    <div class="floating-ball ball1"></div>
    <div class="floating-ball ball2"></div>

    <div class="hero">
        <img src="{{ asset('img/amahle1.png') }}" alt="Invoicing Illustration" class="hero-img">
        <h1>Welcome to Amahle Invoice Solution</h1>
        <p>Your smart, fast, and hassle-free way to manage invoices. Let’s get started! 👋</p>

        @if (Route::has('login'))
        <nav class="d-flex justify-content-center gap-3">
            @auth
            <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-custom btn-gray">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-custom btn-gray">Log In</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-custom btn-outline-gray">Sign Up</a>
            @endif
            @endauth
        </nav>
        @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        gsap.from('.hero h1', { duration: 1, opacity: 0, y: -50, ease: 'power2.out' });
        gsap.from('.hero p', { duration: 1, opacity: 0, y: 50, ease: 'power2.out', delay: 0.3 });
    </script>
</body>
</html>
