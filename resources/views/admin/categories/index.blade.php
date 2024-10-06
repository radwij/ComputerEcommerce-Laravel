<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Manage Categories') }}
    </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">

            @forelse ($categories as $category)
              <div class="item-card flex flex-row items-center justify-between">
                <div class="flex flex-row gap-x-5 items-center">
                  <img src="{{ Storage::url($category->icon) }}" alt="" class="w-[50px] h-[50px]">
                  <h3 class="text-2xl font-bold text-black">
                    {{ $category->name }}
                  </h3>
                </div>
                <div class="flex flex0row items-center gap-x-5">
                  <a href="{{ route('admin.categories.edit', $category) }}" class="bg-yellow-400 py-2 px-5 rounded-xl font-bold text-white">Edit</a>

                  @if ($errors->any())
                    @foreach ($errors->all() as $error)
                      <div class="mb-4 py-3 px-3 w-full rounded-xl bg-red-500 text-white">
                        {{ $error }}
                      </div> 
                    @endforeach  
                  @endif

                  <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 py-2 px-5 rounded-xl font-bold text-white">Delete</button>
                  </form>
                </div>
              </div>
              
            @empty
              
            @endforelse
            
            <a href="{{ route('admin.categories.create') }}" class="bg-green-500 py-2 px-5 rounded-xl font-bold text-white">Add new</a>
          </div>
      </div>
  </div>
</x-app-layout>
