<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recipe Volume') }}
        </h2>
        @vite('resources/css/app.css')
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">

                <div class="flex mt-3">
                    <button type="button"
                        class="modalButtonRegister text-white bg-blue-500 border border-gray-300 focus:outline-none hover:bg-blue-600 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Register</button>
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400  mb-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="table-search-users"
                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search for users">
                    </div>
                </div>

                <!-- Table -->
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Recipe Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Brand
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Unit Measurement
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Volume Reorder Level
                                </th>
                                <!-- <th scope="col" class="px-6 py-3">
                    Volume Deduct
                </th> -->
                                <th scope="col" class="px-6 py-3">
                                    Volume Remaining
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Supplier
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item as $items)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                        {{ $items->recipe_id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $items->brand_id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $items->unit_id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $items->reorder_lvl }}
                                    </td>
                                    <td class="px-6 py-4">
                                        volume
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$items->supplier_id}}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a> |
                                        <a href="#" class="font-medium text-blue-600 hover:underline">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
