<x-layout>
    <div class="mx-4 relative overflow-x-auto rounded-lg shadow-md">

        @unless (count($payments) == 0)
        <table class="table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3">Sender</th>
                <th scope="col" class="px-6 py-3">Amount</th>
                <th scope="col" class="px-6 py-3">Date</th>
                <th scope="col" class="px-6 py-3">Mpesa Receipt Number</th>
              </tr>
            </thead>

            <tbody>
                @foreach ($payments as $payment)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $payment['sender'] }}</td>
                    <td class="px-6 py-4">{{ $payment['amount'] }}</td>
                    <td class="px-6 py-4">{{ $payment['date'] }}</td>
                    <td class="px-6 py-4">{{ $payment['receipt_number'] }}</td>
                </tr>
                @endforeach

                @else
                <p class=" text-center m-5">No payments found.</p>
                    
                @endunless
              
            </tbody>
          </table>

    </div>
</x-layout>