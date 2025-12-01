@extends('layouts.app')

@section('title', 'Book Details')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <a href="{{ route('books.index') }}" class="inline-flex items-center text-slate-600 hover:text-indigo-600 mb-6 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Books
        </a>

        <!-- Book Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/50 overflow-hidden">
            <!-- Book Cover Header -->
            <div class="h-96 relative overflow-hidden group">
                @if($book->image_path)
                    <img src="{{ str_starts_with($book->image_path, 'http') ? $book->image_path : asset('storage/' . $book->image_path) }}" 
                         alt="{{ $book->title }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                @else
                    <div class="h-full w-full" style="background: linear-gradient(135deg, #818cf8 0%, #a78bfa 50%, #f472b6 100%);">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-32 h-32 text-white/30 transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                        </div>
                    </div>
                @endif
                <div class="absolute top-6 right-6">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold shadow-lg transform transition-all duration-300 hover:scale-110
                        @if($book->status === 'available') bg-emerald-100 text-emerald-800
                        @elseif($book->status === 'borrowed') bg-amber-100 text-amber-800
                        @else bg-rose-100 text-rose-800
                        @endif">
                        {{ ucfirst($book->status) }}
                    </span>
                </div>
            </div>

            <!-- Book Details -->
            <div class="p-8 animate-fade-in">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-4xl font-bold text-slate-800 mb-2" style="color: #1e293b !important;">{{ $book->title }}</h1>
                        <p class="text-xl text-slate-600" style="color: #475569 !important;">by {{ $book->author }}</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center px-5 py-2.5 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200" style="background: linear-gradient(135deg, #8b5cf6 0%, #d946ef 100%) !important; color: #faf5ff !important; text-decoration: none !important; border: none;">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #faf5ff !important;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <span style="color: #faf5ff !important;">Edit</span>
                        </a>
                        <a href="{{ route('books.delete', $book) }}" class="inline-flex items-center px-5 py-2.5 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200" style="background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%) !important; color: #fff1f2 !important; text-decoration: none !important; border: none;">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #fff1f2 !important;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            <span style="color: #fff1f2 !important;">Delete</span>
                        </a>
                    </div>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl p-6 border border-indigo-100">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-indigo-500 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600 font-medium" style="color: #475569 !important;">ISBN</p>
                                <p class="text-lg font-bold text-slate-800" style="color: #1e293b !important;">{{ $book->isbn }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-100">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-purple-500 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600 font-medium">Category</p>
                                <p class="text-lg font-bold text-slate-800">{{ $book->category }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-xl p-6 border border-pink-100">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-pink-500 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600 font-medium">Publisher</p>
                                <p class="text-lg font-bold text-slate-800">{{ $book->publisher }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-amber-50 to-yellow-50 rounded-xl p-6 border border-amber-100">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 rounded-lg bg-amber-500 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600 font-medium">Publication Year</p>
                                <p class="text-lg font-bold text-slate-800">{{ $book->publication_year }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metadata -->
                <div class="mt-8 pt-6 border-t border-slate-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-600">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Created: {{ $book->created_at->format('F d, Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            <span>Updated: {{ $book->updated_at->format('F d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}
</style>
@endsection
