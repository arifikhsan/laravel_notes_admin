<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Delete item in {{ $table }} at #{{ $id }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="bg-gray-100 shadow overflow-hidden sm:rounded-lg">
          <div class="flex justify-between ">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Delete item in {{ $table }} at #{{ $id }}
              </h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Confirmation.
              </p>
            </div>
            <div class="flex items-center space-x-2 px-4 py-5 sm:px-">
              <a href="/dashboard/{{ $table }}/{{ $item->id }}/edit"
                 class="text-indigo-600 hover:text-indigo-900">Edit</a>
              <a href="/dashboard/{{ $table }}/{{ $item->id }}/show"
                 class="ml-2 text-blue-600 hover:text-blue-900">Show</a>
            </div>
          </div>
          <div class="p-4 border-t border-gray-200">
            <p>Are you sure?</p>
            <form action="/dashboard/{{ $table }}/{{ $item->id }}/destroy" method="POST">
              @method('DELETE')
              @csrf

              <button type="submit"
                      class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Yes
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
