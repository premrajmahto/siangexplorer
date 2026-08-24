<header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 z-30 sticky top-0 shadow-sm">
    <!-- Left: Sidebar Toggle & Search Bar -->
    <div class="flex items-center space-x-4">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>

        <div class="relative hidden sm:block w-64 md:w-80">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input type="text" 
                   placeholder="Search tours, bookings, leads..." 
                   class="w-full pl-9 pr-4 py-2 text-xs rounded-xl bg-slate-100 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:bg-white transition-all">
        </div>
    </div>

    <!-- Right: Quick Action Buttons & Profile Dropdown -->
    <div class="flex items-center space-x-3 sm:space-x-4">
        <!-- View Live Site -->
        <a href="{{ url('/') }}" target="_blank" 
           class="hidden sm:inline-flex items-center space-x-2 text-xs font-semibold text-slate-600 hover:text-brand-600 px-3 py-2 rounded-xl bg-slate-100 hover:bg-brand-50 transition-colors">
            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
            <span>View Public Site</span>
        </a>

        <!-- Notifications Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="relative p-2 text-slate-500 hover:text-slate-700 rounded-xl hover:bg-slate-100 transition-colors">
                <i class="fa-regular fa-bell text-lg"></i>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-rose-500"></span>
            </button>

            <div x-show="open" 
                 @click.away="open = false" 
                 x-transition 
                 class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50">
                <div class="px-4 py-2 border-b border-slate-100 flex items-center justify-between">
                    <h4 class="font-bold text-xs text-slate-800">Notifications</h4>
                    <span class="text-[10px] font-semibold text-brand-600 bg-brand-50 px-2 py-0.5 rounded-full">New Updates</span>
                </div>
                <div class="divide-y divide-slate-100 max-h-64 overflow-y-auto text-xs">
                    <a href="{{ route('admin.bookings.index') }}" class="p-3 hover:bg-slate-50 block transition-colors">
                        <p class="font-semibold text-slate-800">New Booking Request</p>
                        <p class="text-[11px] text-slate-500 mt-0.5">Booking reference TRV-2026-000001 requires confirmation.</p>
                        <span class="text-[9px] text-slate-400 mt-1 block">Just now</span>
                    </a>
                    <a href="{{ route('admin.enquiries.index') }}" class="p-3 hover:bg-slate-50 block transition-colors">
                        <p class="font-semibold text-slate-800">New Customer Enquiry</p>
                        <p class="text-[11px] text-slate-500 mt-0.5">Leads submitted for Ladakh Adventure Package.</p>
                        <span class="text-[9px] text-slate-400 mt-1 block">10 mins ago</span>
                    </a>
                </div>
                <div class="px-4 py-2 border-t border-slate-100 text-center">
                    <a href="{{ route('admin.bookings.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700">View All Notifications</a>
                </div>
            </div>
        </div>

        <div class="h-6 w-px bg-slate-200"></div>

        <!-- Profile Menu -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex items-center space-x-3 p-1.5 rounded-xl hover:bg-slate-100 transition-colors">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-brand-600 to-teal-500 text-white font-bold text-xs flex items-center justify-center shadow-sm">
                    {{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="text-left hidden md:block">
                    <p class="text-xs font-bold text-slate-800 leading-tight">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-slate-500 font-medium">Administrator</p>
                </div>
                <i class="fa-solid fa-chevron-down text-slate-400 text-[10px]"></i>
            </button>

            <div x-show="open" 
                 @click.away="open = false" 
                 x-transition 
                 class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 py-1 z-50 text-xs">
                <div class="px-4 py-2 border-b border-slate-100">
                    <p class="font-bold text-slate-800 truncate">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-slate-500 truncate">{{ Auth::guard('admin')->user()->email ?? '' }}</p>
                </div>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center space-x-2 px-4 py-2 text-slate-700 hover:bg-slate-50 font-medium">
                    <i class="fa-solid fa-gear text-slate-400"></i>
                    <span>Account Settings</span>
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-2 px-4 py-2 text-rose-600 hover:bg-rose-50 font-medium text-left">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
