<x-app-layout>
    <div class="p-16">
        <div class="p-8 bg-white shadow mt-15">
            <div class="mt-20 text-center border-b pb-12">
                <div class="p-8 rounded border border-gray-200">
                    <h1 class="font-medium text-3xl">Deposit Money</h1>
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
                    <form action="{{ route('user-deposit-money') }}" method="POST">
                        @csrf
                        <div class="mt-8 grid lg:grid-cols-2 gap-4">
                            <div> <label for="tel" class="text-sm text-gray-700 block mb-1 font-medium">Enter Phone
                                    Number</label>
                                <input type="text" name="phone" id="acc"
                                    class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                                    placeholder="Enter ecocash/onemoney number" required />
                            </div>
                            <div> <label for="amount" class="text-sm text-gray-700 block mb-1 font-medium">Enter amount
                                </label> <input type="number" name="amount" id="amount"
                                    class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                                    placeholder="Enter amount" required /> </div>

                        </div>
                        <div class="space-x-4 mt-8"> <button type="submit"
                                class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 active:bg-blue-700 disabled:opacity-50">Deposit</button>
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
