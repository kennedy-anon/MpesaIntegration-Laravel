<x-layout>
    <div class="mx-4">

        <table class="table-auto">
            <thead>
              <tr>
                <th>Sender</th>
                <th>Amount</th>
                <th>Date</th>
                <th>MpesaReceiptNumber</th>
              </tr>
            </thead>

            <tbody>
                @unless (count($payments) == 0)
                @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment['sender'] }}</td>
                    <td>{{ $payment['amount'] }}</td>
                    <td>{{ $payment['date'] }}</td>
                    <td>{{ $payment['receipt_number'] }}</td>
                </tr>
                @endforeach

                @else
                <p>No payments found.</p>
                    
                @endunless
              
            </tbody>
          </table>

    </div>
</x-layout>