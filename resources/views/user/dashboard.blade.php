<x-app-layout>
    <div class="p-16">
        <x-auth-validation-errors
            class="mb-4 bg-red-50 border border-red-400 rounded text-red-800 text-sm p-4 justify-between"
            :errors="$errors" />
        @if (session('success'))
            <div class="relative py-3 pl-4 pr-10 leading-normal text-green-700 bg-green-100 rounded-lg mb-2"
                role="alert">
                <p>{{ session('success') }}</p>
                <span class="absolute inset-y-0 right-0 flex items-center mr-4">
                    <i class="fa fa-close"></i>
                </span>
            </div>
        @endif
        @if (session('error'))
            <div class="relative py-3 pl-4 pr-10 leading-normal text-red-700 bg-red-100 rounded-lg mb-2" role="alert">
                <p>{{ session('error') }}</p>
                <span class="absolute inset-y-0 right-0 flex items-center mr-4">
                    <i class="fa fa-close"></i>
                </span>
            </div>
        @endif
        @if (session('warning'))
            <div class="relative py-3 pl-4 pr-10 leading-normal text-blue-700 bg-blue-100 rounded-lg mb-2" role="alert">
                <p>{{ session('warning') }}</p>
                <span class="absolute inset-y-0 right-0 flex items-center mr-4">
                    <i class="fa fa-close"></i>
                </span>
            </div>
        @endif
        <div class="p-8 bg-white shadow mt-20">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="grid grid-cols-3 text-center order-last md:order-first mt-20 md:mt-0">
                    <div>
                        <p class="font-bold text-gray-700 text-xl">-</p>
                        <p class="text-gray-400">Contacts</p>
                    </div>
                    <div>
                        <p class="font-bold text-gray-700 text-xl">
                            @php
                                $trans = \App\Models\Transaction::where('user_id', Auth::user()->id)->count();
                                echo $trans;
                            @endphp
                        </p>
                        <p class="text-gray-400">Transactions</p>
                    </div>
                    <div>
                        <p class="font-bold text-gray-700 text-xl">${{ $acc->balance }}</p>
                        <p class="text-gray-400">Balance</p>
                    </div>
                </div>
                <div class="relative">
                    <div
                        class="w-48 h-48 bg-indigo-100 mx-auto rounded-full shadow-2xl absolute inset-x-0 top-0 -mt-24 flex items-center justify-center text-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <div class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-center">
                    <a href="{{ route('user-disp-sendmoney') }}"
                        class="text-white py-2 px-4 uppercase rounded bg-blue-400 hover:bg-blue-500 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
                        Send Money
                    </a>
                    <a href="{{ route('user-deposit') }}"
                        class="text-white py-2 px-4 uppercase rounded bg-gray-700 hover:bg-gray-800 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
                        Deposit Money
                    </a>
                </div>
            </div>

            <div class="mt-20 text-center border-b pb-12">
                <h1 class="text-4xl font-medium text-gray-700">{{ $acc->firstname }} {{ $acc->lastname }}</h1>
                <p class="font-light text-gray-600 mt-3">{{ Auth::user()->email }}</p>
                <p class="font-light text-gray-500 mt-3">{{ $acc->accnum }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
