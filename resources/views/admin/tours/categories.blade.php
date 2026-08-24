@extends('layouts.admin')

@section('title', 'Tour Categories')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Tour Categories</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Manage travel themes (e.g., Honeymoon, Family, Adventure, Luxury).</p>
    </div>
    <a href="{{ route('admin.tours.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-600 hover:text-slate-900 px-3.5 py-2 rounded-xl bg-white border border-slate-200">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Back to Tours</span>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm h-fit">
        <h3 class="font-extrabold text-slate-900 text-sm mb-4">Add New Category</h3>
        <form action="{{ route('admin.tours.categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Category Name</label>
                <input type="text" name="name" required placeholder="e.g. Honeymoon Special" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Description</label>
                <textarea name="description" rows="3" placeholder="Brief description..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500"></textarea>
            </div>
            <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md">
                Add Category
            </button>
        </form>
    </div>

    <div class="md:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <table class="w-full text-left text-xs text-slate-700">
            <thead class="bg-slate-100/80 text-[10px] font-bold text-slate-500 uppercase">
                <tr>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Slug</th>
                    <th class="px-4 py-3">Packages Count</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($categories as $cat)
                    <tr>
                        <td class="px-4 py-3 font-bold text-slate-900">{{ $cat->name }}</td>
                        <td class="px-4 py-3 text-slate-500 font-mono">{{ $cat->slug }}</td>
                        <td class="px-4 py-3 font-bold text-brand-600">{{ $cat->tour_packages_count }} tours</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-6 text-slate-400">No categories created yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
