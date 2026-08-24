<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | SiangExplorer</title>
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
        <!-- Logo & Branding -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-brand-600 to-teal-400 mx-auto flex items-center justify-center text-white text-2xl font-black shadow-xl shadow-brand-500/30 mb-3">
                S
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Siang<span class="text-brand-600">Explorer</span></h1>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mt-1">Admin Management Portal</p>
        </div>

        @if(session('error'))
            <div class="mb-4 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-medium flex items-center space-x-2">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if(session('info'))
            <div class="mb-4 p-3.5 rounded-xl bg-sky-50 border border-sky-200 text-sky-700 text-xs font-medium flex items-center space-x-2">
                <i class="fa-solid fa-circle-info"></i>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Email Address</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', 'admin@siangexplorer.com') }}" 
                           required 
                           autofocus
                           class="w-full pl-10 pr-4 py-3 text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                </div>
                @error('email')
                    <p class="text-rose-600 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Password</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           value="password123"
                           required 
                           class="w-full pl-10 pr-4 py-3 text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                </div>
                @error('password')
                    <p class="text-rose-600 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded text-brand-600 focus:ring-brand-500 w-4 h-4 border-slate-300">
                    <span class="text-slate-600 font-medium">Remember me</span>
                </label>
            </div>

            <button type="submit" 
                    class="w-full py-3.5 px-4 bg-gradient-to-r from-brand-600 to-teal-600 hover:from-brand-700 hover:to-teal-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-brand-600/30 transition-all transform active:scale-[0.98]">
                Sign In to Admin Portal
            </button>
        </form>

        <div class="mt-6 text-center border-t border-slate-200 pt-4">
            <p class="text-[11px] text-slate-400">Default Credentials: <code class="bg-slate-100 px-1.5 py-0.5 rounded text-slate-600 font-mono">admin@siangexplorer.com</code> / <code class="bg-slate-100 px-1.5 py-0.5 rounded text-slate-600 font-mono">password123</code></p>
        </div>
    </div>
</body>
</html>
