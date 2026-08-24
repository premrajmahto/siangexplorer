@props([
    'title' => '',
    'value' => '0',
    'icon' => 'fa-chart-line',
    'bg' => 'bg-brand-500',
    'textColor' => 'text-brand-600',
    'subtitle' => null
])

<div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">{{ $title }}</p>
            <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ $value }}</h3>
            @if($subtitle)
                <p class="text-[11px] font-medium text-slate-400 mt-0.5">{{ $subtitle }}</p>
            @endif
        </div>
        <div class="w-12 h-12 rounded-2xl {{ $bg }} text-white flex items-center justify-center text-xl shadow-lg shadow-slate-200">
            <i class="fa-solid {{ $icon }}"></i>
        </div>
    </div>
</div>
