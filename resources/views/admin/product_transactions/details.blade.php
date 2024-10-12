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

            </div>

            <hr class="my-3"></hr>



            <h3 class="text-xl font-bold text-black">
              List of Items
            </h3>

            <div class="grid grid-cols-4 gap-x-10">

              <div class="flex flex-col gap-y-5 col-span-2">

                <div class="item-card flex flex-row items-center justify-between">
                  <div class="flex flex-row gap-x-5 items-center">
                    <img src="#" alt="" class="w-[90px] h-[90px]">
                    <div class="flex flex-col gap-x-3 justify-start">
                      <h3 class="text-2xl font-bold text-black">
                        Zephyrus
                      </h3>
                      <p class="text-base text-slate-500">Rp.500000</p>
                      <p class="text-base text-slate-500">Laptop</p>
                    </div>
                  </div>
                  <div class="flex flex-row gap-x-5 items-center">
                    <p class="text-base text-slate-500">Quantity: 31</p>
                  </div>
                </div>

                <div class="item-card flex flex-row items-center justify-between">
                  <div class="flex flex-row gap-x-5 items-center">
                    <img src="#" alt="" class="w-[90px] h-[90px]">
                    <div class="flex flex-col gap-x-3 justify-start">
                      <h3 class="text-2xl font-bold text-black">
                        Zephyrus
                      </h3>
                      <p class="text-base text-slate-500">Rp.500000</p>
                      <p class="text-base text-slate-500">Laptop</p>
                    </div>
                  </div>
                  <div class="flex flex-row gap-x-5 items-center">
                    <p class="text-base text-slate-500">Quantity: 31</p>
                  </div>
                </div>

                <div class="item-card flex flex-row items-center justify-between">
                  <div class="flex flex-row gap-x-5 items-center">
                    <img src="#" alt="" class="w-[90px] h-[90px]">
                    <div class="flex flex-col gap-x-3 justify-start">
                      <h3 class="text-2xl font-bold text-black">
                        Zephyrus
                      </h3>
                      <p class="text-base text-slate-500">Rp.500000</p>
                      <p class="text-base text-slate-500">Laptop</p>
                    </div>
                  </div>
                  <div class="flex flex-row gap-x-5 items-center">
                    <p class="text-base text-slate-500">Quantity: 31</p>
                  </div>
                </div>
                
                <h3 class="text-xl font-bold text-black">
                  Details of Delivery
                </h3>
    
                <div class="item-card flex flex-row items-center justify-between">  
                    <p class="text-base text-slate-500">Address</p>
                    <h3 class="text-xl font-bold text-black">Jl.Mulyosari</h3>
                </div>
                <div class="item-card flex flex-row items-center justify-between">  
                    <p class="text-base text-slate-500">City</p>
                    <h3 class="text-xl font-bold text-black">Surabaya</h3>
                </div>
                <div class="item-card flex flex-row items-center justify-between">  
                    <p class="text-base text-slate-500">Post Code</p>
                    <h3 class="text-xl font-bold text-black">30111</h3>
                </div>
                <div class="item-card flex flex-row items-center justify-between">  
                    <p class="text-base text-slate-500">Phone Number</p>
                    <h3 class="text-xl font-bold text-black">0812345</h3>
                </div>
                <div class="item-card flex flex-col items-start justify-between">  
                    <p class="text-base text-slate-500">Notes</p>
                    <h3 class="text-lg font-bold text-black">apa ini</h3>
                </div>

              </div>

              <div class="flex flex-col gap-y-5 items-end col-span-2">
                <h3 class="text-xl font-bold text-black">
                  Proof of Payment
                </h3>
                <img src="#" alt="" class="w-[300px] h-[400px] bg-red-300">
              </div>

            </div>

            <hr class="my-3"></hr>

            @role('owner')
            <form method="POST" action="{{ route('product_transactions.update', 1) }}">
              @csrf
              @method('PUT')
              <button class="bg-green-500 py-2 px-5 rounded-xl font-bold text-white">Approve Order</button>
            </form>
            @endrole

            @role('buyer')
            <a href="" class="w-fit bg-blue-500 py-2 px-5 rounded-xl font-bold text-white">Contact Admin</a>
            @endrole
          </div>
      </div>
  </div>
</x-app-layout>
