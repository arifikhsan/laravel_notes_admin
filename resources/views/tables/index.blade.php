<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $table }}
    </h2>
  </x-slot>

  @if (session('notice'))
    <div class="bg-indigo-600">
      <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
          <div class="w-0 flex-1 flex items-center">
        <span class="flex p-2 rounded-lg bg-indigo-800">
          <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
               stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
          </svg>
        </span>
            <p class="ml-3 font-medium text-white truncate">
              <span>{{ session('notice') }}</span>
            </p>
          </div>
          <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
            <button type="button"
                    class="-mr-1 flex p-2 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2">
              <span class="sr-only">Dismiss</span>
              <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                   stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  @endif

  <div class="max-w-7xl px-4 mx-auto mt-3 sm:px-6 lg:px-8 py-3">
    <a href="/secretroom/{{ $table }}/new" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-indigo-500 hover:bg-indigo-700 activate:bg-indigo-900 focus:ring focus:border-indigo-900 ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
      {{ __('Add New') }}
    </a>
  </div>

  <div class="pb-12 pt-6">
    <div class="max-w-7xl px-4 mx-auto sm:px-6 lg:px-8">
      <div class="flex flex-col">
        {{ $items->links() }}
      </div>
      <div class="mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex flex-col">
          <div class="-mt-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-100">
                  <tr>
                    @foreach($keys as $key)
                      <th scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ $key }}
                      </th>
                    @endforeach
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Action
                    </th>
                  </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                  @foreach ($items as $item)
                    <tr class="even:bg-gray-50">
                      @foreach($keys as $key)
                        <td class="px-6 py-4 whitespace-nowrap">
                          @if ($columnsAndTypes[$key] == 'bigint')
                            <div class="flex items-center text-blue-600">
                              {{ $item->$key }}
                            </div>
                          @elseif ($columnsAndTypes[$key] == 'string')
                            <div class="flex items-center">
                              {{ Illuminate\Support\Str::limit($item->$key, 15) }}
                            </div>
                          @elseif ($columnsAndTypes[$key] == 'text')
                            <div class="flex items-center">
                              {{ Illuminate\Support\Str::limit($item->$key, 20) }}
                            </div>
                          @else
                            <div class="flex items-center">
                              {{ $item->$key }}
                            </div>
                          @endif
                        </td>
                      @endforeach

                      <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                        <a href="/secretroom/{{ $table }}/{{ $item->id }}">
                          <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Show</span>
                        </a>
                        <a href="/secretroom/{{ $table }}/{{ $item->id }}/edit">
                          <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">Edit</span>
                        </a>
                        <a href="/secretroom/{{ $table }}/{{ $item->id }}/delete">
                          <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Delete</span>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-4 px-4 flex flex-col">
        {{ $items->links() }}
      </div>
    </div>
  </div>
</x-app-layout>
