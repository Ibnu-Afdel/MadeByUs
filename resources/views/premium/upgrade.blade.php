<x-layouts.guest title="Upgrade to Premium">
    <div class="py-12 px-4">
        <div class="max-w-4xl mx-auto">

            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Upgrade to <span class="text-green-600 dark:text-green-400">Premium</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Unlock all premium features and take your experience to the next level!
                </p>
            </div>

            @if(session('error'))
                <div class="mb-8 max-w-2xl mx-auto">
                    <div class="bg-red-50 dark:bg-red-900/50 border border-red-200 dark:border-red-800 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-400 dark:text-red-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm text-red-800 dark:text-red-200">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @role('Premium')

                <div class="max-w-2xl mx-auto">
                    <div class="bg-green-50 dark:bg-green-900/50 border border-green-200 dark:border-green-800 rounded-xl p-8 text-center">
                        <div class="text-6xl mb-4">🎉</div>
                        <h2 class="text-2xl font-bold text-green-800 dark:text-green-200 mb-2">
                            You're Already Premium!
                        </h2>
                        <p class="text-green-700 dark:text-green-300 mb-6">
                            Enjoy all the premium features and take full advantage of your subscription.
                        </p>
                        <a href="{{ route('dashboard') }}" 
                           class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            @else

                <div class="max-w-4xl mx-auto">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                        <div class="bg-gradient-to-r from-green-600 to-green-700 dark:from-green-500 dark:to-green-600 px-8 py-6">
                            <div class="text-center">
                                <h2 class="text-3xl font-bold text-white mb-2">Premium Plan</h2>
                                <div class="flex items-center justify-center">
                                    <span class="text-5xl font-bold text-white">500</span>
                                    <span class="text-xl text-green-100 ml-2">ETB</span>
                                </div>
                                <p class="text-green-100 mt-2">One-time payment • Lifetime access</p>
                            </div>
                        </div>

                        <div class="p-8">

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6 text-center">
                                    What's included:
                                </h3>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div class="flex items-start">
                                        <svg class="w-6 h-6 text-green-500 dark:text-green-400 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Access to premium projects</span>
                                    </div>
                                    <div class="flex items-start">
                                        <svg class="w-6 h-6 text-green-500 dark:text-green-400 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Advanced customization options</span>
                                    </div>
                                    <div class="flex items-start">
                                        <svg class="w-6 h-6 text-green-500 dark:text-green-400 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Priority support</span>
                                    </div>
                                    <div class="flex items-start">
                                        <svg class="w-6 h-6 text-green-500 dark:text-green-400 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Exclusive templates & resources</span>
                                    </div>
                                    <div class="flex items-start">
                                        <svg class="w-6 h-6 text-green-500 dark:text-green-400 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Remove all limitations</span>
                                    </div>
                                    <div class="flex items-start">
                                        <svg class="w-6 h-6 text-green-500 dark:text-green-400 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Lifetime updates</span>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-700 pt-8">
                                <form method="POST" action="{{ route('premium.initiate') }}" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="amount" value="{{ config('chapa.premium_price') }}">
                                    
                                    <button type="submit" 
                                            class="w-full bg-green-600 hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 text-white font-semibold py-4 px-8 rounded-xl text-lg transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                        Upgrade Now - Pay 500 ETB
                                    </button>
                                    
                                    <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
                                        Secure payment powered by Chapa • Money-back guarantee
                                    </p>
                                </form>

                                <div class="text-center mt-6">
                                    <a href="{{ route('dashboard') }}" 
                                       class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                                        </svg>
                                        Back to Dashboard
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
        </div>
    </div>
</x-layouts.guest>
