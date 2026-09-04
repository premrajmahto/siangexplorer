<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | SiangExplorer Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="h-full flex items-center justify-center p-4 bg-gradient-to-br from-slate-950 via-slate-900 to-teal-950">
    <div class="w-full max-w-md bg-white/95 backdrop-blur-xl p-8 rounded-3xl shadow-2xl border border-white/20">
        <!-- Logo & Header -->
        <div class="text-center mb-6">
            @if($logo = \App\Models\Setting::get('site_logo', '/images/logo.png'))
                <div class="bg-white p-3.5 rounded-2xl shadow-xl border border-slate-200 inline-block mx-auto mb-3">
                    <img src="{{ asset($logo) }}" alt="SiangExplorer Admin" class="h-12 w-auto object-contain">
                </div>
            @else
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-brand-600 to-teal-400 mx-auto flex items-center justify-center text-white text-2xl font-black shadow-xl shadow-brand-500/30 mb-3">
                    S
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Siang<span class="text-brand-600">Explorer</span></h1>
            @endif
            <h2 class="text-xl font-bold text-slate-900 mt-2">Reset Admin Password</h2>
            <p class="text-xs text-slate-500 mt-1">Enter your registered admin email address and we'll send you instructions to reset your password.</p>
        </div>

        @if(session('status'))
            <div class="mb-4 p-3.5 rounded-xl bg-teal-50 border border-teal-200 text-teal-800 text-xs font-medium flex items-center space-x-2">
                <i class="fa-solid fa-circle-check text-teal-600"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-medium flex items-center space-x-2">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.password.email') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Registered Email Address</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', 'booking.siangholidays@gmail.com') }}" 
                           placeholder="booking.siangholidays@gmail.com"
                           required 
                           autofocus
                           class="w-full pl-10 pr-4 py-3 text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                </div>
                @error('email')
                    <p class="text-rose-600 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full py-3.5 px-4 bg-gradient-to-r from-brand-600 to-teal-600 hover:from-brand-700 hover:to-teal-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-brand-600/30 transition-all transform active:scale-[0.98] flex items-center justify-center space-x-2">
                <i class="fa-solid fa-paper-plane text-xs"></i>
                <span>Send Password Reset Link</span>
            </button>
        </form>

        <div class="mt-6 text-center border-t border-slate-200 pt-4">
            <a href="{{ route('admin.login') }}" class="text-xs font-bold text-slate-600 hover:text-brand-600 inline-flex items-center space-x-1.5 transition-colors">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Back to Admin Login</span>
            </a>
        </div>
    </div>
</body>
</html>
