<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $table }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        {{ $items->links() }}
                    </div>
                    <div class="flex flex-col mt-4">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
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
                                            <tr>
                                                @foreach($keys as $key)
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if ($columnsAndTypes[$key] == 'integer')
                                                            <div class="flex items-center text-blue-600">
                                                                {{ $item->$key }}
                                                            </div>
                                                        @elseif ($columnsAndTypes[$key] == 'bigint')
                                                            <div class="flex items-center text-green-600">
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
                                                    <a href="/dashboard/{{ $table }}/{{ $item->id }}"
                                                       class="text-green-600 hover:text-green-900">Show</a>
                                                    <a href="/dashboard/{{ $table }}/{{ $item->id }}/edit"
                                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                    <a href="/dashboard/{{ $table }}/{{ $item->id }}/delete"
                                                       class="text-red-600 hover:text-red-900">Delete</a>
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
            </div>
        </div>
    </div>
</x-app-layout>
