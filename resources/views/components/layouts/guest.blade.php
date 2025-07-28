{{-- <x-layouts.app.guest :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.guest> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head') 
        <title>{{ $title ?? 'MadeByUs' }}</title>
    </head>
    <body class="min-h-screen bg-white font-sans text-zinc-900 antialiased dark:bg-zinc-900 dark:text-zinc-50">

        <header class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <nav class="container mx-auto flex items-center justify-between p-4">
                <a href="{{ route('home') }}" wire:navigate>MadeByUs</a>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" wire:navigate>Log in</a>
                    <a href="{{ route('register') }}" wire:navigate>Register</a>
                </div>
            </nav>
        </header>

        <main>
            {{ $slot }}
        </main>

        @fluxScripts
    </body>
</html>