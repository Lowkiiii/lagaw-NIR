<!-- resources/views/layouts/public.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom Styles -->
    <style>
        .btn-glow {
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        }
        
        .btn-glow:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.8);
        }
        
        .btn-signup-glow {
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
        }
        
        .btn-signup-glow:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.8);
        }
        
        .swiper {
            width: 100%;
            height: 80vh;
        }
        
        .spot-image {
            width: 100%;
            height: 60vh;
            object-fit: cover;
            border-radius: 15px;
        }
        
        .spot-info {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        
        .spot-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .search-bar {
            transition: all 0.3s ease;
        }
        
        .search-bar:focus {
            transform: scale(1.02);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>