<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <a href="{{ route('home') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                MadeByUs
            </a>
            <flux:spacer />

            <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0! max-lg:hidden">
                @if (Route::has('login'))
                    @auth
                        <flux:navbar.item
                            href="{{ url('/dashboard') }}"
                            class="inline-flex px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            {{ __('Dashboard') }}
                        </flux:navbar.item>
                    @else
                        <flux:navbar.item
                            href="{{ route('login') }}"
                            class="inline-flex px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            {{ __('Log in') }}
                        </flux:navbar.item>

                        @if (Route::has('register'))
                            <flux:navbar.item
                                href="{{ route('register') }}"
                                class="inline-flex px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                            >
                                {{ __('Register') }}
                            </flux:navbar.item>
                        @endif
                    @endauth
                @endif
            </flux:navbar>

            <!-- Desktop User Menu -->
            
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar stashable sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('home') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                MadeByUs
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Authentication')">
                    @if (Route::has('login'))
                        @auth
                            <flux:navlist.item 
                                icon="home" 
                                href="{{ url('/dashboard') }}" 
                                wire:navigate
                            >
                                {{ __('Dashboard') }}
                            </flux:navlist.item>
                        @else
                            <flux:navlist.item 
                                icon="arrow-right-end-on-rectangle" 
                                href="{{ route('login') }}" 
                                wire:navigate
                            >
                                {{ __('Log in') }}
                            </flux:navlist.item>

                            @if (Route::has('register'))
                                <flux:navlist.item 
                                    icon="user-plus" 
                                    href="{{ route('register') }}" 
                                    wire:navigate
                                >
                                    {{ __('Register') }}
                                </flux:navlist.item>
                            @endif
                        @endauth
                    @endif
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                    {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                    {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>
        </flux:sidebar>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
