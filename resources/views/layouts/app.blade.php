<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', \App\Models\Setting::get('site_name', 'SiangExplorer | Premium Tour & Travel Agency'))</title>
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('seo_default_description', 'Luxury tour packages and travel experiences.'))">

    <!-- Favicon / Brand Logo -->
    <link rel="icon" type="image/png" href="{{ asset(\App\Models\Setting::get('site_logo', '/images/logo.png')) }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        },
                        gold: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                        }
                    }
                }
            }
        }
    </script>
    <!-- FontAwesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body class="h-full bg-slate-50 font-sans text-slate-800 antialiased flex flex-col justify-between" x-data="{ mobileMenuOpen: false }">
    <div>
        <!-- Responsive Header -->
        <x-header />

        <!-- Flash Messages & Validation Alerts -->
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-lg">
                    <div class="flex items-center space-x-3">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-xl"></i>
                        <span class="font-extrabold text-xs sm:text-sm text-emerald-900">{{ session('success') }}</span>
                    </div>
                    <button type="button" @click="$el.parentElement.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between shadow-lg">
                    <div class="flex items-center space-x-3">
                        <i class="fa-solid fa-circle-exclamation text-rose-600 text-xl"></i>
                        <span class="font-extrabold text-xs sm:text-sm text-rose-900">{{ session('error') }}</span>
                    </div>
                    <button type="button" @click="$el.parentElement.parentElement.remove()" class="text-rose-500 hover:text-rose-700">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 shadow-md space-y-1">
                    <div class="flex items-center space-x-2 font-extrabold text-xs">
                        <i class="fa-solid fa-triangle-exclamation text-rose-600 text-base"></i>
                        <span>Please fix the following validation errors:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs pl-6 space-y-0.5 font-medium text-rose-900">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Main Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Responsive Footer -->
    <x-footer />

    @stack('scripts')
</body>
</html>
