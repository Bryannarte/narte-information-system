<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Library Management System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%) !important;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .book-icon {
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }
        /* Ensure colors show up */
        .text-indigo-500 { color: #6366f1 !important; }
        .text-indigo-600 { color: #4f46e5 !important; }
        .text-purple-500 { color: #a855f7 !important; }
        .text-purple-600 { color: #9333ea !important; }
        .text-slate-600 { color: #475569 !important; }
        .text-slate-700 { color: #334155 !important; }
        .text-slate-800 { color: #1e293b !important; }
        .bg-indigo-500 { background-color: #6366f1 !important; }
        .bg-purple-500 { background-color: #a855f7 !important; }
        .bg-white { background-color: #ffffff !important; }
        .bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-stops)) !important; }
        .from-indigo-500 { --tw-gradient-from: #6366f1 !important; }
        .to-purple-500 { --tw-gradient-to: #a855f7 !important; }
        .from-indigo-600 { --tw-gradient-from: #4f46e5 !important; }
        .to-purple-600 { --tw-gradient-to: #9333ea !important; }
        .text-white { color: #ffffff !important; }
        .rounded-lg { border-radius: 0.5rem !important; }
        .rounded-xl { border-radius: 0.75rem !important; }
        .rounded-2xl { border-radius: 1rem !important; }
        .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important; }
        .shadow-xl { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important; }
        
        /* Smooth animations */
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        nav {
            animation: slideInDown 0.5s ease-out;
        }
        
        main {
            animation: fadeIn 0.6s ease-out;
        }
        
        /* Smooth transitions for all interactive elements */
        a, button {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Hover effects */
        .hover-lift:hover {
            transform: translateY(-4px);
        }
        
        /* Loading animation */
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        /* Ensure all text is visible with proper colors */
        input[type="text"],
        input[type="number"],
        input[type="url"],
        input[type="email"],
        input[type="password"],
        textarea,
        select {
            color: #1e293b !important;
            background-color: #ffffff !important;
        }
        
        input::placeholder,
        textarea::placeholder {
            color: #94a3b8 !important;
        }
        
        /* Ensure all labels and text are visible */
        label, .text-slate-700 {
            color: #334155 !important;
        }
        
        /* Ensure buttons have visible text - using varied colors */
        button[type="submit"] {
            color: inherit !important;
        }
        
        /* Don't force white on all gradient buttons */
        .bg-gradient-to-r {
            color: inherit !important;
        }
        
        /* Fix button text visibility */
        button, .btn-view, .btn-edit, .btn-delete {
            color: inherit !important;
        }
        
        /* Ensure select options are visible */
        select option {
            color: #1e293b !important;
            background-color: #ffffff !important;
        }
        
        /* Ensure all headings are visible */
        h1, h2, h3, h4, h5, h6 {
            color: #1e293b !important;
        }
        
        /* Ensure paragraph text is visible */
        p {
            color: #475569 !important;
        }
        
        /* Ensure links are visible */
        a {
            color: inherit;
        }
    </style>
</head>
<body>
    <nav class="bg-white/80 backdrop-blur-md shadow-lg border-b border-slate-200/50 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center space-x-3">
                    <svg class="w-10 h-10 text-indigo-500 book-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                    </svg>
                    <a href="{{ route('books.index') }}" class="text-2xl font-bold" style="background: linear-gradient(135deg, #4f46e5 0%, #9333ea 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        Library Hub
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('books.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200" style="color: #475569 !important; text-decoration: none !important;" onmouseover="this.style.color='#6366f1'; this.style.backgroundColor='#eef2ff'" onmouseout="this.style.color='#475569'; this.style.backgroundColor='transparent'">
                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: inherit;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Books
                    </a>
                    <a href="{{ route('books.create') }}" class="px-6 py-2.5 rounded-lg text-sm font-semibold shadow-lg flex items-center" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important; color: #ecfdf5 !important; text-decoration: none !important; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 20px 25px -5px rgba(0,0,0,0.1)'; this.style.color='#ecfdf5';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)'; this.style.color='#ecfdf5';">
                        <svg class="w-5 h-5 inline mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ecfdf5 !important;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span style="color: #ecfdf5 !important;">Add Book</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-8 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 border-l-4 px-6 py-4 rounded-lg shadow-md flex items-center" style="background: linear-gradient(135deg, #d1fae5 0%, #ccfbf1 100%) !important; border-color: #10b981 !important; color: #065f46 !important;" role="alert">
                <svg class="w-6 h-6 mr-3" style="color: #10b981 !important;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium" style="color: #065f46 !important;">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 border-l-4 px-6 py-4 rounded-lg shadow-md" style="background: linear-gradient(135deg, #ffe4e6 0%, #fce7f3 100%) !important; border-color: #f43f5e !important; color: #991b1b !important;" role="alert">
                <div class="flex items-center mb-2">
                    <svg class="w-6 h-6 mr-3" style="color: #f43f5e !important;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold" style="color: #991b1b !important;">Please fix the following errors:</span>
                </div>
                <ul class="list-disc list-inside mt-2 space-y-1" style="color: #991b1b !important;">
                    @foreach($errors->all() as $error)
                        <li style="color: #991b1b !important;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>

