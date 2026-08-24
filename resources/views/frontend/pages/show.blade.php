@extends('layouts.app')

@section('title', $page->seo_title ?? $page->title . ' | SiangExplorer')

@section('content')
<div class="bg-slate-900 text-white py-16 border-b border-slate-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-2 text-center">
        <h1 class="text-3xl sm:text-5xl font-extrabold font-serif tracking-tight">{{ $page->title }}</h1>
        <p class="text-slate-400 text-xs">Official Document • Updated {{ $page->updated_at->format('F d, Y') }}</p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-white p-8 sm:p-12 rounded-3xl border border-slate-200/80 shadow-sm prose max-w-none text-slate-700 text-xs sm:text-sm leading-relaxed space-y-4">
        {!! $page->content !!}
    </div>
</div>
@endsection
