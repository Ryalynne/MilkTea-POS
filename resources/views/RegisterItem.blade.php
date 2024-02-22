<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register Item') }}
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
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 bg-white border border-gray">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Product Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Categories
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Recipe
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Cost Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Selling Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Profit
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                @php
                                    $ingredientCount = $product->ingredients->count();
                                    $recipeNames = [];
                                    $recipeNames2 = [];
                                    $recipeNames1 = [];
                                @endphp
                                @foreach ($product->ingredients as $index => $ingredient)
                                    @php
                                        $recipeNames[] = $ingredient->recipeCategory->recipe_name;
                                        // $recipeNames1[] = $ingredient->recipeUnit->unit_id;
                                        // $recipeNames2[] = $ingredient->ing->Volume;
                                    @endphp
                                @endforeach
                                <tr class="border border-gray">
                                    <th class="border px-6 py-4">{{ $product->Product_Name }}</th>
                                    <td class="border px-6 py-4">
                                        @if (!empty($product->Image))
                                            <img src="{{ asset($product->Image) }}" alt="Product Image"
                                                style="max-width: 100px; max-height: 100px">
                                        @else
                                            <img src="{{ asset('uploads/category/1708225090.jpg') }}" alt="No Image"
                                                style="max-width: 100px; max-height: 100px">
                                        @endif
                                    </td>
                                    <td class="border px-6 py-4">{{ $product->Product_Cetegories }}</td>
                                    <td class="border px-6 py-4">{{ implode(',', array_unique($recipeNames)) }}</td>
                                    {{-- <td class="border px-6 py-4">{{ implode(',', array_unique($recipeNames)) }} unit: {{ implode(',', array_unique($recipeNames1)) }} volume: {{ implode(',', array_unique($recipeNames2  )) }}</td> --}}
                                    <td class="border px-6 py-4 text-right">{{ $product->ingredients->first()->Cost }}
                                    </td>
                                    <td class="border px-6 py-4 text-right">{{ $product->Selling_Price }}</td>
                                    <td class="border px-6 py-4 text-right">
                                        {{ $product->Selling_Price - $product->ingredients->first()->Cost }}</td>
                                    <td class="border px-6 py-4 text-right">
                                        <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal HTML -->
        <div id="myModal"
            class="hidden fixed inset-0 z-10 bg-gray-500 bg-opacity-75 flex justify-center items-center">
            <div class="bg-white rounded-lg shadow-lg p-8"> <!-- Increased padding -->
                <form method="POST" action="{{ route('Insert-Product') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center justify-between w-full">
                        <h3 class="text-lg font-bold leading-6 text-gray-900 mb-2">--------- REGISTER PRODUCT
                            ------------</h3>
                        <button id="closeModal" type="button"
                            class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <!-- Heroicon name: outline/x -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900">PRODUCT NAME</label>
                        <input name="Product_Name" type="text" id="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Name of the Product" required />
                    </div>
                    <!-- <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900">DESCRIPTION</label>
                        <textarea id="message" rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Type your Description Here..."></textarea>
                    </div> -->
                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900">UPLOAD
                            IMAGE</label>
                        <input name="Image"
                            class="block w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none placeholder-gray-400"
                            id="small_size" type="file">
                    </div>
                    <div class="mb-6">
                        <label for="Product_Categories"
                            class="block mb-2 text-sm font-medium text-gray-900">Categories</label>
                        <select name="Product_Cetegories" id="Product_Categories"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-white">
                            <option value="" selected>-- Choose a Category --</option>
                            <option value="Cream Cheese Series Milk Tea">Cream Cheese Series Milk Tea</option>
                            <option value="Frappe">Frappe</option>
                            <option value="Fruit Tea">Fruit Tea</option>
                            <option value="Traditional Milk Tea">Traditional Milk Tea</option>
                            <option value="Specialty Milk Tea">Specialty Milk Tea</option>
                            <option value="Bubble Tea">Bubble Tea</option>
                            <option value="Smoothie">Smoothie</option>
                            <option value="Iced Tea">Iced Tea</option>
                            <option value="Hot Tea">Hot Tea</option>
                            <option value="Sugar-Free Options">Sugar-Free Options</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="tagsInput" class="block mb-2 text-sm font-medium text-gray-900">RECIPE</label>
                        <select name="Product_Categories" id="tagsInput"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full max-w-lg p-2.5 bg-white">
                            <option selected>-- What Ingredients --</option>
                            @foreach ($supplier as $item)
                                <option
                                    value="{{ $item->recipe->recipe_name }} {{ $item->unit->unit_name }} ₱{{ $item->price }} ₱{{ $item->volume }} ₱{{ $item->recipe_id }}">
                                    {{ $item->recipe->recipe_name }} ({{ $item->unit->unit_name }})</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" id="newTagsInput"
                        class="bg-gray-50 border border-gray-300
                        text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Add Volume">
                    <div id="tagsContainer" class="flex flex-wrap mt-2 max-w-[400px]"></div>
                    <div class="mb-6">
                        <input name="recipo[]" type="text" id="recipeID"
                            class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="ID" multiple />
                    </div>
                    <div class="mb-6">
                        <input name="unitvolume[]" type="text" id="unitvolume"
                            class="hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="ID" multiple />
                    </div>
                    {{-- <input id="tagsInput" type="text"
                            class="border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 text-gray-900 text-sm"
                            placeholder="Ex.(Sugar - 100G) Add tags separated by commas"
                            style="text-transform: capitalize;"> --}}
                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900">COST PRICE</label>
                        <input name="itemCost" type="text" id="disabled-input-2" aria-label="disabled input 2"
                            class="readonly bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed"
                            value="0.00">
                    </div>

                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900">SELLING
                            PRICE</label>
                        <input name="Selling_Price" type="number" id="priceInput"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter selling price (must be greater than cost price)" required />
                    </div>
                    <button type="submit" onclick="sendArrayToLaravel()"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('./javascript/register_java.js') }}"></script>
    <script src="{{ asset('./javascript/numberonly_java.js') }}"></script>
    <script src="{{ asset('./javascript/text_area.js') }}"></script>
</x-app-layout>
