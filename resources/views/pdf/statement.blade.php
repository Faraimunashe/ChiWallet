<h1 style="color: blue">ChiWallet Transaction Statement</h1>
<h3><b>Account Number: </b>
    @php
        $acc = \App\Models\Account::where('user_id', Auth::user()->id)->first();
        echo $acc->accnum;
    @endphp
    <h3>
        <strong>Fullname: </strong>{{ $acc->firstname }} {{ $acc->lastname }}
    </h3>
    <h3>
        <strong>Current Balance: </strong>${{ $acc->balance }}
    </h3>
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
            @foreach ($statement as $item)
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
