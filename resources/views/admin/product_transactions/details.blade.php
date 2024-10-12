<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Details') }}
    </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white flex flex-col gap-y-5 ovessrflow-hidden p-10 shadow-sm sm:rounded-lg">

            <div class="item-card flex flex-row items-center justify-between">

              <div class="flex flex-col gap-x-3 justify-start">
                <p class="text-base text-slate-500">Total Transaksi</p>
                <h3 class="text-xl font-bold text-black">
                  Rp. {{ $productTransaction->total_amount }}
                </h3>
              </div>

              <div class="flex flex-col gap-x-3 justify-start">
                <p class="text-base text-slate-500">Date</p>
                <h3 class="text-xl font-bold text-black">
                  10 Oktober 2024
                </h3>
              </div>

              @if ($productTransaction->is_paid)
                <div class="bg-green-500 py-1 px-5 rounded-full font-bold text-white">
                  <p class="text-white font-bold text-sm">SUCCESS</p>
                </div>
              @else
                <div class="bg-red-500 py-1 px-5 rounded-full font-bold text-white">
                  <p class="text-white font-bold text-sm">PENDING</p>
                </div>
              @endif

            </div>

            <hr class="my-3"></hr>



            <h3 class="text-xl font-bold text-black">
              List of Items
            </h3>

            <div class="grid grid-cols-4 gap-x-10">

              <div class="flex flex-col gap-y-5 col-span-2">
                
                @forelse ( $productTransaction->transactionDetails as $detail)
                  <div class="item-card flex flex-row items-center justify-between">
                    <div class="flex flex-row gap-x-5 items-center">
                      <img src="{{ Storage::url($detail->product->photo) }}" alt="" class="w-[90px] h-[90px]">
                      <div class="flex flex-col gap-x-3 justify-start">
                        <h3 class="text-2xl font-bold text-black">
                          {{ $detail->product->name }}
                        </h3>
                        <p class="text-base text-slate-500">Rp.{{ $detail->price }}</p>
                        <p class="text-base text-slate-500">{{ $detail->product->category->name }}</p>
                      </div>
                    </div>
                    <div class="flex flex-row gap-x-5 items-center">
                      <p class="text-base text-slate-500">Quantity: N/A</p>
                    </div>
                  </div>
                @empty
                  
                @endforelse
                
                <h3 class="text-xl font-bold text-black">
                  Details of Delivery
                </h3>
    
                <div class="item-card flex flex-row items-center justify-between">  
                    <p class="text-base text-slate-500">Address</p>
                    <h3 class="text-xl font-bold text-black">{{ $productTransaction->address }}</h3>
                </div>
                <div class="item-card flex flex-row items-center justify-between">  
                    <p class="text-base text-slate-500">City</p>
                    <h3 class="text-xl font-bold text-black">{{ $productTransaction->city }}</h3>
                </div>
                <div class="item-card flex flex-row items-center justify-between">  
                    <p class="text-base text-slate-500">Post Code</p>
                    <h3 class="text-xl font-bold text-black">{{ $productTransaction->post_code }}</h3>
                </div>
                <div class="item-card flex flex-row items-center justify-between">  
                    <p class="text-base text-slate-500">Phone Number</p>
                    <h3 class="text-xl font-bold text-black">{{ $productTransaction->phone_number }}</h3>
                </div>
                <div class="item-card flex flex-col items-start justify-between">  
                    <p class="text-base text-slate-500">Notes</p>
                    <h3 class="text-lg font-bold text-black">{{ $productTransaction->notes }}</h3>
                </div>

              </div>

              <div class="flex flex-col gap-y-5 items-end col-span-2">
                <h3 class="text-xl font-bold text-black">
                  Proof of Payment
                </h3>
                <img src="{{ Storage::url($productTransaction->proof) }}" alt="{{ Storage::url($productTransaction->proof) }}" class="w-[300px] h-[400px]">
              </div>

            </div>

            
            @role('owner')
            @if ($productTransaction->is_paid)
            
            @else
            <hr class="my-3"></hr>
                <form method="POST" action="{{ route('product_transactions.update', $productTransaction) }}">
                  @csrf
                  @method('PUT')
                  <button class="bg-blue-600 py-2 px-5 rounded-xl font-bold text-white">Approve Order</button>
                </form>
              @endif

            @endrole

            @role('buyer')
            <a href="" class="w-fit bg-blue-600 py-2 px-5 rounded-xl font-bold text-white">Contact Admin</a>
            @endrole
          </div>
      </div>
  </div>
</x-app-layout>
