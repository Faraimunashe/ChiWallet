<x-guest-layout>
    <div class="">
        <div class="p-8 lg:w-1/2 mx-auto">
            <div class="bg-white rounded-t-lg p-8">
                <div>
                    <div class="flex items-center justify-center space-x-4 mt-3">
                        <button
                            class="flex items-center py-2 px-4 text-sm uppercase rounded bg-white hover:bg-gray-100 text-indigo-500 border border-transparent hover:border-transparent hover:text-gray-700 shadow-md hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
                            <svg class="w-8 text-blue-400" viewBox="0 0 24 24" stroke-linejoin="round" stroke-width="2"
                                stroke-linecap="round" stroke-miterlimit="10" stroke="currentColor" fill="none">
                                <rect x="3" y="1" width="7" height="12"></rect>
                                <rect x="3" y="17" width="7" height="6"></rect>
                                <rect x="14" y="1" width="7" height="6"></rect>
                                <rect x="14" y="11" width="7" height="12"></rect>
                            </svg>
                            Chi-Wallet
                        </button>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 rounded-b-lg py-12 px-4 lg:px-24">
                <p class="text-center text-sm text-gray-500 font-light">
                    Sign up for an account!
                </p>
                <form class="mt-6" method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <x-auth-validation-errors
                        class="bg-red-50 border-b border-red-400 text-red-800 text-sm p-4justify-between mb-3"
                        :errors="$errors">

                    </x-auth-validation-errors>
                    <div class="relative mb-3">
                        <input type="text" name="name" required
                            class="appearance-none border pl-12 border-gray-100 shadow-sm focus:shadow-md focus:placeholder-gray-600  transition  rounded-md w-full py-3 text-gray-600 leading-tight focus:outline-none focus:ring-gray-600 focus:shadow-outline"
                            id="name" placeholder="Enter username" />
                        <div class="absolute left-0 inset-y-0 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 ml-3 text-gray-400 p-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="relative">

                        <input type="email" name="email" required
                            class="appearance-none border pl-12 border-gray-100 shadow-sm focus:shadow-md focus:placeholder-gray-600  transition  rounded-md w-full py-3 text-gray-600 leading-tight focus:outline-none focus:ring-gray-600 focus:shadow-outline"
                            id="email" placeholder="Enter your email" />
                        <div class="absolute left-0 inset-y-0 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 ml-3 text-gray-400 p-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                    </div>
                    <div class="relative mt-3">
                        <input type="password" name="password" required
                            class="appearance-none border pl-12 border-gray-100 shadow-sm focus:shadow-md focus:placeholder-gray-600  transition  rounded-md w-full py-3 text-gray-600 leading-tight focus:outline-none focus:ring-gray-600 focus:shadow-outline"
                            id="password" placeholder="Password" />
                        <div class="absolute left-0 inset-y-0 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 ml-3 text-gray-400 p-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="relative mt-3">
                        <input type="password" name="password_confirmation" required
                            class="appearance-none border pl-12 border-gray-100 shadow-sm focus:shadow-md focus:placeholder-gray-600  transition  rounded-md w-full py-3 text-gray-600 leading-tight focus:outline-none focus:ring-gray-600 focus:shadow-outline"
                            id="password" placeholder="Password confirmation" />
                        <div class="absolute left-0 inset-y-0 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 ml-3 text-gray-400 p-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-gray-500">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="/login">
                            Already have an account?
                        </a>
                    </div>
                    <div class="flex items-center justify-center mt-8">
                        <button
                            class="text-white py-2 px-4 uppercase rounded bg-blue-500 hover:bg-blue-800 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
                            Sign up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
