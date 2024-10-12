<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ Auth::user()->hasRole('owner') ?__('Apotek Orders') :__('My Transaction') }}
    </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white flex flex-col gap-y-5 ovessrflow-hidden p-10 shadow-sm sm:rounded-lg">

            <div class="item-card flex flex-row items-center justify-between">
              <div class="flex flex-col gap-x-3 justify-start">
                <p class="text-base text-slate-500">Total Transaksi</p>
                <h3 class="text-xl font-bold text-black">
                  Rp. 50000000
                </h3>
              </div>

              <div class="flex flex-col gap-x-3 justify-start">
                <p class="text-base text-slate-500">Date</p>
                <h3 class="text-xl font-bold text-black">
                  10 Oktober 2024
                </h3>
              </div>

              <div class="bg-orange-600 py-1 px-5 rounded-full font-bold text-white">
                <p class="text-white font-bold text-sm">PENDING</p>
              </div>

              <div class="flex flex-row items-center gap-x-5">
                <a href="{{ route('product_transactions.update', 1) }}" class="bg-blue-600 py-2 px-5 rounded-xl font-bold text-white">View Details</a>
              </div>
            </div>

            <hr class="my-3"></hr>

          </div>
      </div>
  </div>
</x-app-layout>
