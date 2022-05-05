<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ChiWallet') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <div class="bg-gray-900">
            <div class="px-4 py-5 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="/" aria-label="Company" title="Company" class="inline-flex items-center mr-8">
                            <svg class="w-8 text-blue-400" viewBox="0 0 24 24" stroke-linejoin="round" stroke-width="2"
                                stroke-linecap="round" stroke-miterlimit="10" stroke="currentColor" fill="none">
                                <rect x="3" y="1" width="7" height="12"></rect>
                                <rect x="3" y="17" width="7" height="6"></rect>
                                <rect x="14" y="1" width="7" height="6"></rect>
                                <rect x="14" y="11" width="7" height="12"></rect>
                            </svg>
                            <span class="ml-2 text-xl font-bold tracking-wide text-gray-100 uppercase">Chi-Wallet</span>
                        </a>
                        <ul class="flex items-center hidden space-x-8 lg:flex">
                            <li><a href="/" aria-label="Bills" title="Bills"
                                    class="font-medium tracking-wide text-gray-100 transition-colors duration-200 hover:text-blue-400">Bills</a>
                            </li>
                            <li><a href="/" aria-label="Rates" title="Rates"
                                    class="font-medium tracking-wide text-gray-100 transition-colors duration-200 hover:text-blue-400">Rates</a>
                            </li>
                            <li><a href="{{ route('user-deposit') }}" aria-label="Deposit" title="Deposit"
                                    class="font-medium tracking-wide text-gray-100 transition-colors duration-200 hover:text-blue-400">Deposit</a>
                            </li>
                            <li><a href="{{ route('user-statement') }}" aria-label="Statement" title="Statement"
                                    class="font-medium tracking-wide text-gray-100 transition-colors duration-200 hover:text-blue-400">Statement</a>
                            </li>
                            <li><a href="{{ route('user-disp-sendmoney') }}" aria-label="Transfer Money"
                                    title="Transfer Money"
                                    class="font-medium tracking-wide text-gray-100 transition-colors duration-200 hover:text-blue-400">Transfer
                                    money</a></li>
                        </ul>
                    </div>
                    <ul class="flex items-center hidden space-x-8 lg:flex">
                        <li><a href="#" aria-label="Sign in" title="Sign in"
                                class="font-medium tracking-wide text-gray-100 transition-colors duration-200 hover:text-blue-400">{{ Auth::user()->name }}</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-blue-400 hover:bg-blue-700 focus:shadow-outline focus:outline-none"
                                    aria-label="logout" title="logout">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                    <!-- Mobile menu -->
                    <div class="lg:hidden">
                        <button aria-label="Open Menu" title="Open Menu"
                            class="p-2 -mr-1 transition duration-200 rounded focus:outline-none focus:shadow-outline">
                            <svg class="w-5 text-gray-600" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M23,13H1c-0.6,0-1-0.4-1-1s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,13,23,13z"></path>
                                <path fill="currentColor"
                                    d="M23,6H1C0.4,6,0,5.6,0,5s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,6,23,6z"></path>
                                <path fill="currentColor"
                                    d="M23,20H1c-0.6,0-1-0.4-1-1s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,20,23,20z"></path>
                            </svg>
                        </button>
                        <!-- Mobile menu dropdown -->
                        <div class="absolute top-0 left-0 w-full">
                            <div class="p-5 bg-white border rounded shadow-sm">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <a href="/" aria-label="Company" title="Company"
                                            class="inline-flex items-center">
                                            <svg class="w-8 text-blue-400" viewBox="0 0 24 24" stroke-linejoin="round"
                                                stroke-width="2" stroke-linecap="round" stroke-miterlimit="10"
                                                stroke="currentColor" fill="none">
                                                <rect x="3" y="1" width="7" height="12"></rect>
                                                <rect x="3" y="17" width="7" height="6"></rect>
                                                <rect x="14" y="1" width="7" height="6"></rect>
                                                <rect x="14" y="11" width="7" height="12"></rect>
                                            </svg>
                                            <span
                                                class="ml-2 text-xl font-bold tracking-wide text-gray-800 uppercase">Company</span>
                                        </a>
                                    </div>
                                    <div>
                                        <button aria-label="Close Menu" title="Close Menu"
                                            class="p-2 -mt-2 -mr-2 transition duration-200 rounded hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                            <svg class="w-5 text-gray-600" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M19.7,4.3c-0.4-0.4-1-0.4-1.4,0L12,10.6L5.7,4.3c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4l6.3,6.3l-6.3,6.3 c-0.4,0.4-0.4,1,0,1.4C4.5,19.9,4.7,20,5,20s0.5-0.1,0.7-0.3l6.3-6.3l6.3,6.3c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3 c0.4-0.4,0.4-1,0-1.4L13.4,12l6.3-6.3C20.1,5.3,20.1,4.7,19.7,4.3z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <nav>
                                    <ul class="space-y-4">
                                        <li><a href="/" aria-label="Our product" title="Our product"
                                                class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-blue-400">Product</a>
                                        </li>
                                        <li><a href="/" aria-label="Our product" title="Our product"
                                                class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-blue-400">Features</a>
                                        </li>
                                        <li><a href="/" aria-label="Product pricing" title="Product pricing"
                                                class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-blue-400">Pricing</a>
                                        </li>
                                        <li><a href="/" aria-label="About us" title="About us"
                                                class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-blue-400">About
                                                us</a></li>
                                        <li><a href="/" aria-label="Sign in" title="Sign in"
                                                class="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-blue-400">Sign
                                                in</a></li>
                                        <li>
                                            <a href="/"
                                                class="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-blue-400 hover:bg-blue-700 focus:shadow-outline focus:outline-none"
                                                aria-label="Sign up" title="Sign up">
                                                Logout
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!---->
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <div class="bg-gray-900">
            <div class="px-4 pt-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
                <div class="grid row-gap-10 mb-8 lg:grid-cols-6">
                    <div class="grid grid-cols-2 gap-5 row-gap-8 lg:col-span-4 md:grid-cols-4">
                        <div>
                            <p class="font-medium tracking-wide text-gray-300">Category</p>
                            <ul class="mt-2 space-y-2">
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">News</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">World</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Games</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">References</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p class="font-medium tracking-wide text-gray-300">Apples</p>
                            <ul class="mt-2 space-y-2">
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Web</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">eCommerce</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Business</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Entertainment</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Portfolio</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p class="font-medium tracking-wide text-gray-300">Cherry</p>
                            <ul class="mt-2 space-y-2">
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Media</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Brochure</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Nonprofit</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Educational</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Projects</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p class="font-medium tracking-wide text-gray-300">Business</p>
                            <ul class="mt-2 space-y-2">
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Infopreneur</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Personal</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Wiki</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-blue-200">Forum</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:max-w-md lg:col-span-2">
                        <span class="text-base font-medium tracking-wide text-gray-300">Subscribe for updates</span>
                        <form class="flex flex-col mt-4 md:flex-row">
                            <input placeholder="Email" required="" type="text"
                                class="flex-grow w-full h-12 px-4 mb-3 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none md:mr-2 md:mb-0 focus:border-blue-400 focus:outline-none focus:shadow-outline" />
                            <button type="submit"
                                class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-blue-400 hover:bg-blue-700 focus:shadow-outline focus:outline-none">
                                Subscribe
                            </button>
                        </form>
                        <p class="mt-4 text-sm text-gray-500">
                            Bacon ipsum dolor amet short ribs pig sausage prosciuto chicken spare ribs salami.
                        </p>
                    </div>
                </div>
                <div class="flex flex-col justify-between pt-5 pb-10 border-t border-gray-800 sm:flex-row">
                    <p class="text-sm text-gray-500">
                        © Copyright 2020 Faraimunashe. All rights reserved.
                    </p>
                    <div class="flex items-center mt-4 space-x-4 sm:mt-0">
                        <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-blue-400">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">
                                <path
                                    d="M24,4.6c-0.9,0.4-1.8,0.7-2.8,0.8c1-0.6,1.8-1.6,2.2-2.7c-1,0.6-2,1-3.1,1.2c-0.9-1-2.2-1.6-3.6-1.6 c-2.7,0-4.9,2.2-4.9,4.9c0,0.4,0,0.8,0.1,1.1C7.7,8.1,4.1,6.1,1.7,3.1C1.2,3.9,1,4.7,1,5.6c0,1.7,0.9,3.2,2.2,4.1 C2.4,9.7,1.6,9.5,1,9.1c0,0,0,0,0,0.1c0,2.4,1.7,4.4,3.9,4.8c-0.4,0.1-0.8,0.2-1.3,0.2c-0.3,0-0.6,0-0.9-0.1c0.6,2,2.4,3.4,4.6,3.4 c-1.7,1.3-3.8,2.1-6.1,2.1c-0.4,0-0.8,0-1.2-0.1c2.2,1.4,4.8,2.2,7.5,2.2c9.1,0,14-7.5,14-14c0-0.2,0-0.4,0-0.6 C22.5,6.4,23.3,5.5,24,4.6z">
                                </path>
                            </svg>
                        </a>
                        <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-blue-400">
                            <svg viewBox="0 0 30 30" fill="currentColor" class="h-6">
                                <circle cx="15" cy="15" r="4"></circle>
                                <path
                                    d="M19.999,3h-10C6.14,3,3,6.141,3,10.001v10C3,23.86,6.141,27,10.001,27h10C23.86,27,27,23.859,27,19.999v-10   C27,6.14,23.859,3,19.999,3z M15,21c-3.309,0-6-2.691-6-6s2.691-6,6-6s6,2.691,6,6S18.309,21,15,21z M22,9c-0.552,0-1-0.448-1-1   c0-0.552,0.448-1,1-1s1,0.448,1,1C23,8.552,22.552,9,22,9z">
                                </path>
                            </svg>
                        </a>
                        <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-blue-400">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">
                                <path
                                    d="M22,0H2C0.895,0,0,0.895,0,2v20c0,1.105,0.895,2,2,2h11v-9h-3v-4h3V8.413c0-3.1,1.893-4.788,4.659-4.788 c1.325,0,2.463,0.099,2.795,0.143v3.24l-1.918,0.001c-1.504,0-1.795,0.715-1.795,1.763V11h4.44l-1,4h-3.44v9H22c1.105,0,2-0.895,2-2 V2C24,0.895,23.105,0,22,0z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
