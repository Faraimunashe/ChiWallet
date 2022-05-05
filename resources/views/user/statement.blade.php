<x-app-layout>
    <div class="p-16">
        <div class="p-8 bg-white shadow mt-15">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
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
                        <a href="{{ route('user-download-statement') }}"
                            class="focus:outline-none text-white text-sm py-2.5 px-5 mt-5 mx-5  rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg mb-5">
                            Download
                        </a>
                        <table class="min-w-full text-sm divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            #
                                        </div>
                                    </th>
                                    <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            Activity
                                        </div>
                                    </th>
                                    <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            Receiver
                                        </div>
                                    </th>
                                    <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            Sender
                                        </div>
                                    </th>
                                    <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            Status
                                        </div>
                                    </th>
                                    <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            Amount
                                        </div>
                                    </th>
                                    <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            End_Balance
                                        </div>
                                    </th>
                                    <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            Date
                                        </div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($transactions as $item)
                                    <tr>
                                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                                            @php
                                                $count++;
                                                echo $count;
                                            @endphp
                                        </td>
                                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $item->action }}
                                        </td>
                                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                                            @php
                                                $receiver = \App\Models\Account::where('user_id', $item->receiver_user_id)->first();

                                                if ($item->action == 'DEPOSIT') {
                                                    $sender = \App\Models\Account::where('user_id', $item->sender_user_id)->first();
                                                    echo $sender->accnum;
                                                } else {
                                                    echo $receiver->accnum;
                                                }

                                            @endphp
                                        </td>
                                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                                            @php
                                                $sender = \App\Models\Account::where('user_id', $item->sender_user_id)->first();
                                                echo $sender->accnum;
                                            @endphp
                                        </td>
                                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $item->status }}
                                        </td>
                                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $item->amount }}
                                        </td>
                                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $item->end_balance }}
                                        </td>
                                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $item->created_at }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
