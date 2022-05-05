<x-app-layout>
    <div class="p-16">
        <div class="p-8 bg-white shadow mt-15">
            <div class="mt-20 text-center border-b pb-12">
                <div class="p-8 rounded border border-gray-200">
                    <h1 class="font-medium text-3xl">Confirm Receiver</h1>
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
                        <div class="relative py-3 pl-4 pr-10 leading-normal text-red-700 bg-red-100 rounded-lg mb-2"
                            role="alert">
                            <p>{{ session('error') }}</p>
                            <span class="absolute inset-y-0 right-0 flex items-center mr-4">
                                <i class="fa fa-close"></i>
                            </span>
                        </div>
                    @endif
                    <form action="{{ route('user-confirm-sendmoney') }}" method="POST">
                        @csrf
                        <input type="hidden" name="accnum" value="{{ $receiver->accnum }}">
                        <input type="hidden" name="amount" value="{{ $amount }}">
                        <div class="flex justify-center">
                            <div class="rounded-lg bg-white shadow-lg p-16">
                                <div class="text-center mt-2">
                                    <h1 class="text-purple-900 font-bold text-2xl">{{ $receiver->lastname }}
                                        {{ $receiver->firstname }}</h1>
                                    <p class="text-gray-500 mt-3">Are you sure you want to send ${{ $amount }} to
                                        this
                                        account?
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="space-x-4 mt-8"> <button type="submit"
                                class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 active:bg-blue-700 disabled:opacity-50">Proceed</button>
                            <!-- Secondary --> <a href="{{ route('dashboard') }}"
                                class="py-2 px-4 bg-white border border-gray-200 text-gray-600 rounded hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-12 flex flex-col justify-center">
                <button class="text-indigo-500 py-2 px-4  font-medium mt-4">
                    Account Statement
                </button>
            </div>

        </div>
    </div>
</x-app-layout>
