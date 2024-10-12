<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ Auth::user()->hasRole('owner') ?__('Apotek Orders') :__('My Transaction') }}
    </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white flex flex-col gap-y-5 ovessrflow-hidden p-10 shadow-sm sm:rounded-lg">

            @forelse ( $product_transactions as $transaction )
              <div class="item-card flex flex-row items-center justify-between">
                <div class="flex flex-col gap-x-3 justify-start">
                  <p class="text-base text-slate-500">Total Transaksi</p>
                  <h3 class="text-xl font-bold text-black">
                    Rp.{{ $transaction->total_amount }}
                  </h3>
                </div>

                <div class="flex flex-col gap-x-3 justify-start">
                  <p class="text-base text-slate-500">Date</p>
                  <h3 class="text-xl font-bold text-black">
                    {{ $transaction->created_at }}
                  </h3>
                </div>
                
                @if ($transaction->is_paid)
                  <div class="bg-green-500 py-1 px-5 rounded-full font-bold text-white">
                    <p class="text-white font-bold text-sm">SUCCESS</p>
                  </div>
                @else
                  <div class="bg-red-500 py-1 px-5 rounded-full font-bold text-white">
                    <p class="text-white font-bold text-sm">PENDING</p>
                  </div>
                @endif

                <div class="flex flex-row items-center gap-x-5">
                  <a href="{{ route('product_transactions.show', $transaction) }}" class="bg-blue-600 py-2 px-5 rounded-xl font-bold text-white">View Details</a>
                </div>
              </div>

              <hr class="my-3"></hr>
            @empty
              <p>No new transaction</p>
            @endforelse

          </div>
      </div>
  </div>
</x-app-layout>
