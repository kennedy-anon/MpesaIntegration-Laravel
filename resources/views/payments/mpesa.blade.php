<x-layout>
    <div class="flex justify-center">
        <form method="POST" action="/payments/mpesa" class="rounded-lg shadow w-1/3 p-3">
            @csrf
            <h3 class="font-semibold text-center text-xl">Mpesa</h3>

            <div class="form-group">
                <label for="phone_no">Phone No.</label>
                <input type="number" class="form-control" name="phone_no" id="" aria-describedby="helpId" placeholder="Example: 254708374149">
                <small id="helpId" class="form-text text-muted">Phone No. to be billed.</small>
                @error('phone_no')
                    <p class="text-red-500 text-xs mt-1" >{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
              <label for="amount">Amount</label>
              <input type="number" class="form-control" name="amount" id="" aria-describedby="helpId" placeholder="">
              <small id="helpId" class="form-text text-muted">Amount to be billed.</small>
              @error('amount')
                <p class="text-red-500 text-xs mt-1" >{{ $message }}</p>
              @enderror
            </div>
            
            <div class="flex justify-center my-4">
                <button type="submit" class="bg-indigo-600 text-white text-sm leading-6 font-medium py-2 px-6 rounded-lg w-1/3">Send</button>
            </div>
        </form>
    </div>
</x-layout>