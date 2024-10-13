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
                <a href="{{ route('carts.index') }}" class="bg-green-500 py-2 px-5 rounded-xl font-bold text-white">View Cart</a>
              </div>
            </div>
          </div>

          <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

              <h3 class="text-xl font-bold text-black">
                All Categories
              </h3>
                <div class="bg-white flex flex-wrap gap-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">
      
                  @forelse ($categories as $category)
                    <div class="item-card flex flex-col items-center justify-between w-full sm:w-[45%] md:w-[30%] lg:w-[22%]">
                      <div class="flex flex-col gap-y-3 items-center text-center">
                        <img src="{{ Storage::url($category->icon) }}" alt="" class="w-[50px] h-[50px]">
                        <h3 class="text-2xl font-bold text-black">
                          {{ $category->name }}
                        </h3>
                      </div>

                    </div>
                    
                  @empty
                    
                  @endforelse
                </div>
            </div>
        </div>


          <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
              <h3 class="text-xl font-bold text-black">
                All Products
              </h3>
                <div class="bg-white flex flex-col gap-y-5 ovessrflow-hidden p-10 shadow-sm sm:rounded-lg">
      
                  @forelse ($products as $product)
                    <div class="item-card flex flex-row items-center justify-between">
                      <div class="flex flex-row gap-x-5 items-center">
                        <img src="{{ Storage::url($product->photo) }}" alt="" class="w-[90px] h-[90px]">
                        <div class="flex flex-col gap-x-3 justify-start">
                          <h3 class="text-2xl font-bold text-black">
                            {{ $product->name }}
                          </h3>
                          <p class="text-base text-slate-500">Category: {{ $product->category->name }}</p>
                          <p class="text-base text-slate-500">Price: Rp.{{ $product->price }}</p>
                          <p class="text-base text-slate-500">In stock: {{ $product->stock }}</p>
                        </div>
                      </div>
                      <div class="flex flex-row items-center gap-x-5">
                        <a href="{{ route('front.product.details', $product->slug) }}" class="bg-blue-600 py-2 px-5 rounded-xl font-bold text-white">View Details</a>
                      </div>
                    </div>
                    
                  @empty
                    <p>Belum ada Produk.</p>
                  @endforelse
                </div>
            </div>
          </div>
        </main>

        <footer class="py-16 text-center text-sm text-black">
            Group 1 Computer Shop Alpha v0.1
        </footer>

    </body>
</html>
