@extends('layouts.app')

@section('title', 'Books List')

@section('content')
<style>
    /* Ensure all text is visible */
    body, h1, h2, h3, h4, h5, h6, p, span, div, a, button {
        color: #1e293b !important;
    }
    .text-slate-800, h1, h2, h3 {
        color: #1e293b !important;
    }
    .text-slate-600, p, span {
        color: #475569 !important;
    }
    .text-slate-700 {
        color: #334155 !important;
    }
    .book-card {
        background-color: rgba(255,255,255,0.95) !important;
        border: 1px solid rgba(226,232,240,0.5) !important;
    }
    .book-cover {
        background: linear-gradient(135deg, #818cf8 0%, #a78bfa 50%, #f472b6 100%) !important;
    }
    .btn-view {
        background-color: #eef2ff !important;
        color: #4f46e5 !important;
        text-decoration: none !important;
    }
    .btn-view:hover {
        background-color: #e0e7ff !important;
        color: #4f46e5 !important;
    }
    .btn-edit {
        background-color: #faf5ff !important;
        color: #9333ea !important;
        text-decoration: none !important;
    }
    .btn-edit:hover {
        background-color: #f3e8ff !important;
        color: #9333ea !important;
    }
    .btn-delete {
        background-color: #fff1f2 !important;
        color: #e11d48 !important;
        text-decoration: none !important;
        border: none !important;
        cursor: pointer !important;
    }
    .btn-delete:hover {
        background-color: #ffe4e6 !important;
        color: #e11d48 !important;
    }
    .status-available {
        background-color: #d1fae5 !important;
        color: #065f46 !important;
    }
    .status-borrowed {
        background-color: #fef3c7 !important;
        color: #92400e !important;
    }
    .status-reserved {
        background-color: #ffe4e6 !important;
        color: #991b1b !important;
    }
    .gradient-btn {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%) !important;
        color: white !important;
        text-decoration: none !important;
    }
    /* Book info text */
    .book-title {
        color: #1e293b !important;
        font-weight: bold !important;
    }
    .book-info-text {
        color: #475569 !important;
    }
    .book-icon-color {
        color: #6366f1 !important;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .book-card-animate {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }
    
    /* Pagination Styles */
    .pagination-container nav {
        background: rgba(255,255,255,0.9) !important;
        border-radius: 12px !important;
        padding: 1rem !important;
        box-shadow: 0 10px 25px rgba(16,24,40,0.08) !important;
    }
    
    .pagination-container a, 
    .pagination-container span {
        color: #6366f1 !important;
        background: rgba(255,255,255,0.8) !important;
        border: 1px solid rgba(99,102,241,0.2) !important;
        padding: 0.5rem 1rem !important;
        margin: 0 0.25rem !important;
        border-radius: 8px !important;
        font-weight: 500 !important;
        transition: all 0.2s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 2.5rem !important;
        text-decoration: none !important;
    }
    
    .pagination-container a:hover {
        background: #6366f1 !important;
        color: white !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 12px rgba(99,102,241,0.3) !important;
    }
    
    .pagination-container [aria-current="page"] span {
        background: #6366f1 !important;
        color: white !important;
        font-weight: 600 !important;
    }
    
    .pagination-container [aria-disabled="true"] {
        opacity: 0.5 !important;
        cursor: not-allowed !important;
    }
</style>
<div class="px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-4xl font-bold mb-2 flex items-center" style="color: #1e293b !important;">
                    <svg class="w-10 h-10 mr-3" style="color: #6366f1 !important;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                    </svg>
                    Our Collection
                </h1>
                <p class="text-lg" style="color: #475569 !important;">Discover and manage your library books</p>
            </div>
            <a href="{{ route('books.create') }}" class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold shadow-lg gradient-btn transition-all duration-200 hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Book
            </a>
        </div>

        <!-- Search Bar -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg p-6 mb-6">
            <form method="GET" action="{{ route('books.index') }}" class="flex gap-4">
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium mb-2" style="color: #374151;">Search Books</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5" style="color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                               placeholder="Search by title, author, category, publisher, or ISBN..." 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200"
                               style="background-color: #ffffff; color: #374151;">
                    </div>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200 font-medium">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('books.index') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200 font-medium">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
            @if(request('search'))
                <div class="mt-4 text-sm" style="color: #6b7280;">
                    Showing results for: <strong>"{{ request('search') }}"</strong>
                    @if($books->total() > 0)
                        ({{ $books->total() }} book{{ $books->total() > 1 ? 's' : '' }} found)
                    @else
                        (No books found)
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Books Grid -->
    @if($books->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($books as $index => $book)
                <div class="rounded-2xl shadow-lg transition-all duration-500 overflow-hidden book-card-animate" 
                     style="background-color: rgba(255,255,255,0.9); border: 1px solid rgba(226,232,240,0.5); animation-delay: {{ $index * 0.1 }}s;"
                     onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 25px 50px -12px rgba(0,0,0,0.25)'" 
                     onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)'">
                    <!-- Book Cover -->
                    <div class="h-48 relative overflow-hidden group">
                        @if($book->image_path)
                            <img src="{{ str_starts_with($book->image_path, 'http') ? $book->image_path : asset('storage/' . $book->image_path) }}" 
                                 alt="{{ $book->title }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="h-full w-full" style="background: linear-gradient(135deg, #818cf8 0%, #a78bfa 50%, #f472b6 100%);">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-24 h-24 text-white/30 transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                    </svg>
                                </div>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-md transform transition-all duration-300 hover:scale-110
                                @if($book->status === 'available') status-available
                                @elseif($book->status === 'borrowed') status-borrowed
                                @else status-reserved
                                @endif">
                                {{ ucfirst($book->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Book Info -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 line-clamp-2" style="color: #1e293b !important;">{{ $book->title }}</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" style="color: #6366f1 !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="text-sm" style="color: #475569 !important;">{{ $book->author }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" style="color: #6366f1 !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <span class="text-sm" style="color: #475569 !important;">{{ $book->category }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" style="color: #6366f1 !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm" style="color: #475569 !important;">{{ $book->publication_year }}</span>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex space-x-2 pt-4 border-t" style="border-color: #e2e8f0;">
                            <a href="{{ route('books.show', $book) }}" class="flex-1 px-4 py-2 rounded-lg text-sm font-medium text-center btn-view transition-all duration-200 hover:scale-105" style="color: #4f46e5 !important;">
                                View
                            </a>
                            <a href="{{ route('books.edit', $book) }}" class="flex-1 px-4 py-2 rounded-lg text-sm font-medium text-center btn-edit transition-all duration-200 hover:scale-105" style="color: #9333ea !important;">
                                Edit
                            </a>
                            <a href="{{ route('books.delete', $book) }}" class="px-4 py-2 rounded-lg text-sm font-medium btn-delete transition-all duration-200 hover:scale-105" style="color: #e11d48 !important;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #e11d48 !important;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($books->hasPages())
            <div class="mt-8 flex justify-center pagination-container">
                <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg p-4">
                    <!-- Custom Pagination with Page Numbers -->
                    <div class="flex items-center justify-center space-x-2">
                        {{-- Previous Page Link --}}
                        @if ($books->onFirstPage())
                            <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                                Previous
                            </span>
                        @else
                            <a href="{{ $books->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-indigo-600 bg-white border border-indigo-300 rounded-lg hover:bg-indigo-50 hover:text-indigo-700 transition-colors duration-200">
                                Previous
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach(range(1, $books->lastPage()) as $page)
                            @if($page == $books->currentPage())
                                <span class="px-3 py-2 text-sm font-bold text-white bg-indigo-600 border border-indigo-600 rounded-lg">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $books->url($page) }}" class="px-3 py-2 text-sm font-medium text-indigo-600 bg-white border border-indigo-300 rounded-lg hover:bg-indigo-50 hover:text-indigo-700 transition-colors duration-200">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($books->hasMorePages())
                            <a href="{{ $books->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-indigo-600 bg-white border border-indigo-300 rounded-lg hover:bg-indigo-50 hover:text-indigo-700 transition-colors duration-200">
                                Next
                            </a>
                        @else
                            <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                                Next
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-12 text-center">
            <svg class="w-24 h-24 mx-auto text-slate-300 mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
            </svg>
            <h3 class="text-2xl font-bold mb-2" style="color: #1e293b !important;">No books yet</h3>
            <p class="mb-6" style="color: #475569 !important;">Get started by adding your first book to the library.</p>
            <a href="{{ route('books.create') }}" class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold shadow-lg" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%) !important; color: #ecfeff !important; text-decoration: none; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 20px 25px -5px rgba(0,0,0,0.1)'; this.style.color='#ecfeff';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)'; this.style.color='#ecfeff';">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ecfeff !important;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span style="color: #ecfeff !important;">Add Your First Book</span>
            </a>
        </div>
    @endif
</div>
@endsection

