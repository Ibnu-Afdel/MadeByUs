<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>{{ $title ?? 'Welcome - MadeByUs' }}</title>
    </head>
    <body class="min-h-screen bg-gradient-to-br from-green-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 antialiased">
        <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">

                <div class="flex justify-center mb-8">
                    <a href="{{ route('home') }}" wire:navigate class="flex items-center space-x-3 group">
                        <div class="p-3 bg-gradient-to-br from-green-400 to-green-600 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-200">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">
                            MadeByUs
                        </span>
                    </a>
                </div>
            </div>

            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white dark:bg-gray-800 py-8 px-6 shadow-2xl rounded-2xl border border-gray-100 dark:border-gray-700 backdrop-blur-sm">
                    {{ $slot }}
                </div>
                
                <div class="mt-6">
                    <div class="text-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            © {{ date('Y') }} MadeByUs. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
