<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Edit Category') }}
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

            <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
      
              <!-- Category Title -->
              <div>
                <x-input-label for="name" :value="__('Edit Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $category->name }}" required autofocus autocomplete="name" />
                <!-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> -->
              </div>
      
              <!-- Category Icon -->
              <div class="mt-4">
                <x-input-label for="icon" :value="__('Choose New Icon')"/>
                <img src="{{ Storage::url($category->icon) }}" alt="" class="m-4 w-[50px] h-[50px]">
                <x-text-input id="icon" class="block mt-1 w-full" type="file" name="icon" autofocus autocomplete="icon" />
                <!-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> -->
              </div>
      
              <div class="flex items-center justify-end mt-4">
                  <x-primary-button class="ms-3">
                      {{ __('Update Category') }}
                  </x-primary-button>
              </div>
            </form>
          </div>
      </div>
  </div>
</x-app-layout>
