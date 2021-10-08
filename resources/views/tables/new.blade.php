<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Create new {{ $table }}
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

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="bg-gray-100 shadow overflow-hidden sm:rounded-lg">
          <div class="flex justify-between ">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Create new {{ $table }}
              </h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Fill the details.
              </p>
            </div>
          </div>
          <div class="border-t">

            <div class="sm:mt-0">
              <div class="">
                <div class="mt-5 md:mt-0 md:col-span-2">
                  <form action="/dashboard/{{ $table }}/create" method="POST">
                    @csrf

                    <div class="shadow overflow-hidden sm:rounded-md">
                      <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                          @foreach($columns as $column)
                            @php
                              $value = $column->name;
                            @endphp
                            <div class="col-span-6">
                              @unless($column->name == 'id')
                                @unless($column->name == 'created_at' || $column->name == 'updated_at')
                                  <label for="{{ $column->name }}"
                                         class="block text-sm font-medium text-gray-700">{{ $column->name }}</label>
                                @endunless

                                @if ($column->type == 'integer' || $column->type == 'bigint')
                                  <input type="number"
                                         name="{{ $column->name }}"
                                         id="{{ $column->name }}"
                                         value=""
                                         class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                @elseif($column->type == 'text')
                                  <textarea
                                    id="{{ $column->name }}"
                                    name="{{ $column->name }}"
                                    rows="3"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                  ></textarea>
                                @elseif($column->name == 'created_at' || $column->name == 'updated_at')
                                  <input type="hidden" name="{{ $column->name }}"/>
                                @else
                                  <input type="text"
                                         name="{{ $column->name }}"
                                         id="{{ $column->name }}"
                                         value=""
                                         class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                @endif
                              @endunless
                            </div>
                          @endforeach

                        </div>
                      </div>
                      <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          Save
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
