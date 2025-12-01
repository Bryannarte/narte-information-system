@extends('layouts.app')

@section('title', 'Delete Book')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4 shadow-lg animate-pulse" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-slate-800 mb-2">Delete Book</h1>
            <p class="text-slate-600">Are you sure you want to delete this book? This action cannot be undone.</p>
        </div>

        <!-- Book Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/50 overflow-hidden mb-6 transform transition-all duration-300 hover:scale-[1.02]">
            <!-- Book Cover -->
            <div class="h-48 relative overflow-hidden">
                @if($book->image_path)
                    <img src="{{ str_starts_with($book->image_path, 'http') ? $book->image_path : asset('storage/' . $book->image_path) }}" 
                         alt="{{ $book->title }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="h-full w-full" style="background: linear-gradient(135deg, #818cf8 0%, #a78bfa 50%, #f472b6 100%);">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-24 h-24 text-white/30" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                        </div>
                    </div>
                @endif
                <div class="absolute top-4 right-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-md
                        @if($book->status === 'available') bg-emerald-100 text-emerald-800
                        @elseif($book->status === 'borrowed') bg-amber-100 text-amber-800
                        @else bg-rose-100 text-rose-800
                        @endif">
                        {{ ucfirst($book->status) }}
                    </span>
                </div>
            </div>
            
            <!-- Book Info -->
            <div class="p-6">
                <h3 class="text-2xl font-bold text-slate-800 mb-2">{{ $book->title }}</h3>
                <p class="text-lg text-slate-600 mb-4">by {{ $book->author }}</p>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-slate-500">ISBN:</span>
                        <span class="text-slate-800 font-medium ml-2">{{ $book->isbn }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500">Category:</span>
                        <span class="text-slate-800 font-medium ml-2">{{ $book->category }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500">Publisher:</span>
                        <span class="text-slate-800 font-medium ml-2">{{ $book->publisher }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500">Year:</span>
                        <span class="text-slate-800 font-medium ml-2">{{ $book->publication_year }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation Form -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/50 p-8">
            <form action="{{ route('books.destroy', $book) }}" method="POST" class="space-y-6">
                @csrf
                @method('DELETE')

                <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-rose-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h4 class="text-rose-800 font-semibold mb-1">Warning</h4>
                            <p class="text-rose-700 text-sm">This action will permanently delete the book and all associated data. This cannot be undone.</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-slate-200">
                    <a href="{{ route('books.index') }}" class="px-6 py-3 rounded-xl border-2 border-slate-300 bg-white text-slate-700 font-semibold hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow" style="color: #334155 !important; text-decoration: none !important;">
                        Cancel
                    </a>
                    <button type="submit" class="px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important; color: #fef2f2 !important; border: none;">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #fef2f2 !important;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <span style="color: #fef2f2 !important;">Delete Book</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

