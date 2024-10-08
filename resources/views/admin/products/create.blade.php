<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('New Product') }}
      </h2>
  </x-slot>

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

            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
              @csrf

              <!-- Product Name -->
              <div>
                <x-input-label for="name" :value="__('Product Name')" />
                <x-text-input id='name' class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="product-name" />
              </div>

              <!-- Category Selection -->
              <div class="mt-4">
                <x-input-label for="category_id" :value="__('Category')" />
                <select id=category_id name="category_id" class="mt-1 border border-slate-300 rounded-lg w-full">
                  <option value="" disabled selected>{{ __('Select a Category') }}</option>
                  @forelse ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @empty
                  @endforelse
                </select>
              </div>

              <!-- Product Price -->
              <div class="mt-4">
                <x-input-label for="price" :value="__('Price')" />
                <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required autofocus autocomplete="price" />
              </div>

              <!-- Product Stock -->
              <div class="mt-4">
                <x-input-label for="stock" :value="__('Stock')" />
                <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" :value="old('stock')" required autofocus autocomplete="stock" />
              </div>

              <!-- Product Description -->
               <div class="mt-4">
                <x-input-label for="about" :value="__('Product Description')" />
                <textarea id="about" name="about" rows="5" class="mt-1 border border-slate-300 rounded-lg w-full" required autofocus autocomplete="about">{{ old('about') }}</textarea>
               </div>

              <!-- Product Photo -->
              <div class="mt-4">
                <x-input-label for="photo" :value="__('Photo')" />
                <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" required autofocus autocomplete="photo" />
              </div>

              <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Add') }}
                </x-primary-button>
              </div>
            </form>
          </div>
      </div>
  </div>
</x-app-layout>
