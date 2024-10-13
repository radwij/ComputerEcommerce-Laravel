<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <header class="relative w-full max-w-7xl mx-auto px-6 py-4 flex justify-between bg-white shadow">
            <div class="flex justify-center lg:col-start-2">
                <img src="" alt="Logo Here" class="h-12 lg:h-16 w-auto">
            </div>
            @if (Route::has('login'))
                <nav class="flex space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black transition hover:text-black/70">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black transition hover:text-black/70">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black transition hover:text-black/70">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main>
          <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
              <h3 class="text-xl font-bold text-black">
                My Carts
              </h3>
                <div class="bg-white flex flex-col gap-y-5 ovessrflow-hidden p-10 shadow-sm sm:rounded-lg">
      
                  @forelse ($my_carts as $cart)
                    <div class="item-card flex flex-row items-center justify-between">
                      <div class="flex flex-row gap-x-5 items-center">
                        <img src="{{ Storage::url($cart->product->photo) }}" alt="" class="w-[90px] h-[90px]">
                        <div class="flex flex-col gap-x-3 justify-start">
                          <h3 class="text-2xl font-bold text-black">
                            {{ $cart->product->name }}
                          </h3>
                          <p class="text-base text-slate-500">Category: {{ $cart->product->category->name }}</p>
                          <p class="text-base text-slate-500 product-price" data-price="{{ $cart->product->price }}">Price: Rp.{{ $cart->product->price }}</p>
                          <p class="text-base text-slate-500">In stock: {{ $cart->product->stock }}</p>
                        </div>
                      </div>
                      <form method="POST" action="{{ route('carts.destroy', $cart) }}">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 py-2 px-5 rounded-xl font-bold text-white">Delete</button>
                      </form>
                    </div>
                  @empty
                    <p>Belum ada Produk.</p>
                  @endforelse
                </div>
            </div>
          </div>

          <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
              <h3 class="text-xl font-bold text-black">
                Details
              </h3>
              <div class="bg-white flex flex-col gap-y-5 ovessrflow-hidden p-10 shadow-sm sm:rounded-lg">
                <ul class="flex flex-col gap-5">
                  <li class="flex items-center justify-between">
                    <p class="text-base font-semibold">SubTotal</p>
                    <p class="text-base font-semibold" id="checkout-sub-total"></p>
                  </li>
                  <li class="flex items-center justify-between">
                    <p class="text-base font-semibold">PPN 11%</p>
                    <p class="text-base font-semibold" id="checkout-ppn"></p>
                  </li>
                  <li class="flex items-center justify-between">
                    <p class="text-base font-semibold">Insurance 23%</p>
                    <p class="text-base font-semibold" id="checkout-insurance"></p>
                  </li>
                  <li class="flex items-center justify-between">
                    <p class="text-base font-semibold">Delivery Fee</p>
                    <p class="text-base font-semibold" id="checkout-delivery-fee"></p>
                  </li>
                  <li class="flex items-center justify-between">
                    <p class="text-base font-semibold">Grand Total</p>
                    <p class="text-base font-extrabold text-blue-600" id="checkout-grand-total"></p>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
              <h3 class="text-xl font-bold text-black">
                Send Payment To
              </h3>
              <div class="bg-white flex flex-col gap-y-5 ovessrflow-hidden p-10 shadow-sm sm:rounded-lg">
                <div class="flex flex-col gap-5">
                  <div class="flex items-center justify-between">
                    <p class="text-base font-semibold">BCA</p>
                    <p class="text-base font-semibold">66123456</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">
      
                  @if ($errors->any())
                    @foreach ($errors->all() as $error)
                      <div class="mb-4 py-3 px-3 w-full rounded-xl bg-red-500 text-white">
                        {{ $error }}
                      </div> 
                    @endforeach  
                  @endif
      
                  <form method="POST" action="{{ route('product_transactions.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Address -->
                    <div class="mt-4">
                      <x-input-label for="address" :value="__('Address')" />
                      <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
                    </div>
      
                    <!-- City -->
                    <div class="mt-4">
                      <x-input-label for="city" :value="__('City')" />
                      <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autofocus autocomplete="city" />
                    </div>
      
                    <!-- Post Code -->
                    <div class="mt-4">
                      <x-input-label for="post_code" :value="__('Post Code')" />
                      <x-text-input id="post_code" class="block mt-1 w-full" type="text" name="post_code" :value="old('post_code')" required autofocus autocomplete="post_code" />
                    </div>

                    <!-- Phone Number -->
                    <div class="mt-4">
                      <x-input-label for="phone_number" :value="__('Phone Number')" />
                      <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone_number" />
                    </div>
      
                    <!-- Notes -->
                     <div class="mt-4">
                      <x-input-label for="notes" :value="__('Deliery Notes')" />
                      <textarea id="notes" name="notes" rows="5" class="mt-1 border border-slate-300 rounded-lg w-full" required autofocus autocomplete="notes">{{ old('notes') }}</textarea>
                     </div>
      
                    <!-- Proof -->
                    <div class="mt-4">
                      <x-input-label for="proof" :value="__('Proof of Payment')" />
                      <x-text-input id="proof" class="block mt-1 w-full" type="file" name="proof" required autofocus autocomplete="proof" />
                    </div>
      
                    <div class="flex items-center justify-end mt-4">
                      <button type="submit" class="bg-blue-600 py-2 px-5 rounded-xl font-bold text-white">Confirm</button>
                    </div>
                  </form>
                </div>
            </div>
          </div>
          
        </main>

        <footer class="py-16 text-center text-sm text-black">
            Group 1 Computer Shop Alpha v0.1
        </footer>

        <script>
          function calculatePrice(){
            let subTotal = 0;
            let deliveryFee = 30000;

            document.querySelectorAll('.product-price').forEach(item => {
              subTotal += parseFloat(item.getAttribute('data-price'));
            });

            document.getElementById('checkout-sub-total').textContent = 'Rp ' + subTotal.toLocaleString('id', {minimumFractionDigits: 2, maximumFractionDigits: 2});

            document.getElementById('checkout-delivery-fee').textContent = 'Rp ' + deliveryFee.toLocaleString('id', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            
            const ppn = 11 * subTotal / 100;
            
            document.getElementById('checkout-ppn').textContent = 'Rp ' + ppn.toLocaleString('id', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            
            const insurance = 23 * subTotal / 100;
            
            document.getElementById('checkout-insurance').textContent = 'Rp ' + insurance.toLocaleString('id', {minimumFractionDigits: 2, maximumFractionDigits: 2});

            const grandTotal = subTotal + ppn + insurance + deliveryFee;
            
            document.getElementById('checkout-grand-total').textContent = 'Rp ' + grandTotal.toLocaleString('id', {minimumFractionDigits: 2, maximumFractionDigits: 2});

          }

          document.addEventListener('DOMContentLoaded', function() {
            calculatePrice();
          });

        </script>

    </body>
</html>
