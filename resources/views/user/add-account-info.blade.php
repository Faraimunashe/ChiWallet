<x-app-layout>
    <div class="p-16">
        <div class="p-8 bg-white shadow mt-15">
            <div class="mt-5 text-center border-b pb-12">
                <div class="p-8 rounded border border-gray-200">
                    <h1 class="font-medium text-3xl">Save Personal Information</h1>
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
                    <form action="{{ route('user-add-info') }}" method="POST">
                        @csrf
                        <div class="mt-8 grid lg:grid-cols-2 gap-4">
                            <div>
                                <label for="firstname"
                                    class="text-sm text-gray-700 block mb-1 font-medium">Firstname</label>
                                <input type="text" name="firstname" id="firstname"
                                    class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                                    placeholder="Enter your firstname" required />
                            </div>
                            <div>
                                <label for="lastname"
                                    class="text-sm text-gray-700 block mb-1 font-medium">Lastname</label>
                                <input type="text" name="lastname" id="lastname"
                                    class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                                    placeholder="Enter your surname" required />
                            </div>
                            <div>
                                <label for="natid" class="text-sm text-gray-700 block mb-1 font-medium">National
                                    ID</label>
                                <input type="text" name="natid" id="natid"
                                    class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                                    placeholder="Enter your national ID" required />
                            </div>
                            <div>
                                <label for="gender" class="text-sm text-gray-700 block mb-1 font-medium">Gender</label>
                                <select name="gender" id="gender"
                                    class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label for="dob" class="text-sm text-gray-700 block mb-1 font-medium">Date Of
                                    Birth</label>
                                <input type="date" name="dob" id="dob"
                                    class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                                    placeholder="Enter your date of birth" required />
                            </div>
                            <div>
                                <label for="address"
                                    class="text-sm text-gray-700 block mb-1 font-medium">Address</label>
                                <input type="text" name="address" id="address"
                                    class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                                    placeholder="Enter your address" required />
                            </div>
                        </div>
                        <div class="space-x-4 mt-8"> <button type="submit"
                                class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 active:bg-blue-700 disabled:opacity-50">Save
                                Information</button>
                            <!-- Secondary --> <button
                                class="py-2 px-4 bg-white border border-gray-200 text-gray-600 rounded hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
