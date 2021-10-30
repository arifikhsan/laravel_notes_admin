<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Show detail of {{ $table }} at #{{ $id }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="bg-gray-100 shadow overflow-hidden sm:rounded-lg">
          <div class="flex justify-between ">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Show detail of {{ $table }} at #{{ $id }}
              </h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Showing {{ count($columns) }} columns.
              </p>
            </div>
            <div class="flex items-center space-x-2 px-4 py-5 sm:px-">
              <a href="/secretroom/{{ $table }}/{{ $item->id }}/edit"
                 class="text-indigo-600 hover:text-indigo-900">Edit</a>
              <a href="/secretroom/{{ $table }}/{{ $item->id }}/delete"
                 class="ml-2 text-red-600 hover:text-red-900">Delete</a>
            </div>
          </div>
          <div class="border-t border-gray-200">
            <dl>
              @foreach($columns as $column)
                @php
                  $key = $column->name;
                @endphp

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 even:bg-gray-50">
                  <dt class="text-sm font-medium text-gray-500">
                    {{ $key }}
                  </dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $item->$key }}
                  </dd>
                </div>
              @endforeach
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
