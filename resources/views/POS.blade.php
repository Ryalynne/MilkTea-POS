<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Point Of Sale') }}
        </h2>
        @vite('resources/css/app.css')
    </x-slot>
    <div class="flex flex-row justify-between mt-10 mr-5 ml-3">
        <div class="container">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($product as $productlist)
                    <div class="modalButton">
                        <figure
                            class="relative max-w-sm h-45 transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
                            <a href="#">
                                <img class="h-auto max-w-full rounded-lg" src="{{ asset($productlist->Image) }}"
                                    alt="Product Image">
                            </a>
                            <figcaption class="absolute px-4 text-lg text-white bottom-6 bg-black">
                                <p>₱{{ $productlist->Selling_Price }}</p>
                                <p>{{ $productlist->Product_Name }} (x1)</p>
                            </figcaption>
                        </figure>
                    </div>
                @endforeach
                <div class="modalButton">
                    <figure
                        class="relative max-w-sm h-45 transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
                        <a href="#">
                            <img class="h-auto max-w-full rounded-lg"
                                src="https://thumbs.dreamstime.com/b/pearl-milk-tea-white-background-125973018.jpg"
                                alt="">
                        </a>
                        <figcaption class="absolute px-4 text-lg text-white bottom-6 bg-black">
                            <p>₱50.00</p>
                            <p>MILK SHAKE SM (x1)</p>
                        </figcaption>
                    </figure>
                </div>
                <div>
                    <figure class="relative max-w-sm h-45 filter grayscale ">
                        <img class="h-auto max-w-full rounded-lg"
                            src="https://thumbs.dreamstime.com/b/pearl-milk-tea-white-background-125973018.jpg"
                            alt="">
                        <figcaption class="absolute px-4 text-lg text-white bottom-6 bg-black">
                            <p>₱50.00</p>
                            <p>MILK SHAKE (NOT AVAILABLE)</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>

        <div class="container w-1/2 bg-white p-5 rounded-lg shadow-md ml-3">
            <h3 class="text-lg font-semibold mb-4">Customer Details</h3>
            <div class="flex flex-col">
                @if ($sale->count() > 0)
                    <div class="mb-4">
                        @foreach ($sale as $sales)
                            <label for="first_name" class="text-gray-700 mb-2">Customer name:</label>
                            <input type="text" id="first_name"
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="{{ $sales->saleproduct->Customer_Name }}" readonly>
                    </div>
                    <hr class="my-4">
                    <div class="mb-4">
                        <span class="font-semibold">Order List</span>
                        <div class="flex flex-col mt-2">
                            <div class="flex justify-between mb-2">
                                <span>{{ $sales->saleproduct->Qty }}</span>
                                {{-- <span>{{ $sales->saleproduct->productlist->Product_Name }}</span> --}}
                                <span>Sugar:{{ $sales->saleproduct->Sugar }}</span>
                                {{-- <span>Price: {{ $sales->saleproduct->productlist->price }}</span> --}}
                                <span>Add on: {{ $sales->saleproduct->Add_on }}</span>
                                <span>Sum: ₱50.00</span>
                @endforeach
            </div>
        </div>
    </div>
    <hr class="my-4">
    <div class="flex justify-between mb-2">
        <span>Total:</span>
        <span>₱49.00</span>
    </div>
@else
    <div class="mb-4">
        <label for="first_name" class="text-gray-700 mb-2">Customer name:</label>
        <input type="text" id="first_name"
            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="Name" required>
    </div>
    <hr class="my-4">
    <div class="mb-4">
        <span class="font-semibold">Order List</span>
        <div class="flex flex-col mt-2">
            <div class="flex justify-between mb-2">

            </div>
        </div>
    </div>
    <hr class="my-4">
    <div class="flex justify-between mb-2">
        <span>Total:</span>
        <span>₱0.00</span>
    </div>
    @endif
    </div>
    <div class="flex justify-end mt-4">
        <button type="button"
            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2">Cancel</button>
        <button type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Sell</button>
    </div>
    </div>


    <!-- Modal HTML -->
    <div id="myModal" class="hidden fixed inset-0 z-10 bg-gray-500 bg-opacity-75 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <!-- Modal content goes here -->
            <div class="flex flex-col items-start">
                <div class="flex items-center justify-between w-full">
                    <h3 class="text-lg font-semibold leading-6 text-gray-900">----------- Order This Product
                        -----------</h3>
                    <button id="closeModal" type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-4">
                    <p>MILK SHAKE XL- (Price: ₱50.00) </p>
                    <span><input type="text" id="first_name"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="Qty Order" required></span>
                    <p>Toppings</p>
                    <fieldset>
                        <ul class="w-48 text-sm font-medium text-black border border-gray-300 rounded-lg bg-white">
                            <li class="w-full border-b border-gray-200 rounded-t-lg">
                                <div class="flex items-center ps-3">
                                    <input id="country-option-1" type="radio" name="countries" value="USA"
                                        class="w-4 h-4 border border-gray-300 focus:ring-2 focus:ring-blue-300">
                                    <label for=""
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Pearls</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 rounded-t-lg">
                                <div class="flex items-center ps-3">
                                    <input id="country-option-2" type="radio" name="countries" value="Germany"
                                        class="w-4 h-4 border border-gray-300 focus:ring-2 focus:ring-blue-300">
                                    <label for=""
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Cream
                                        Cheese</label>
                                </div>
                            </li>
                        </ul>
                    </fieldset>
                    <p>Add On</p>
                    <fieldset>
                        <ul class="w-48 text-sm font-medium text-black border border-gray-300 rounded-lg bg-white">
                            <li class="w-full border-b border-gray-200 rounded-t-lg">
                                <div class="flex items-center ps-3">
                                    <input id="country-option-1" type="radio" name="countries" value="USA"
                                        class="w-4 h-4 border border-gray-300 focus:ring-2 focus:ring-blue-300">
                                    <label for=""
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Pearls
                                        (50.00)</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 rounded-t-lg">
                                <div class="flex items-center ps-3">
                                    <input id="country-option-2" type="radio" name="countries" value="Germany"
                                        class="w-4 h-4 border border-gray-300 focus:ring-2 focus:ring-blue-300">
                                    <label for=""
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Cream Cheese
                                        (50.00)</label>
                                </div>
                            </li>
                        </ul>
                    </fieldset>
                    <!-- <ul class="w-48 text-sm font-medium text-black border border-gray-300 rounded-lg bg-white">
                            <li class="w-full border-b border-gray-200 rounded-t-lg">
                                <div class="flex items-center ps-3">
                                    <input id="react-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="react-checkbox" class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Pearls (₱50.00)</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 rounded-t-lg">
                                <div class="flex items-center ps-3">
                                    <input id="react-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="react-checkbox" class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Cream Cheese (₱50.00)</label>
                                </div>
                            </li>
                        </ul> -->
                </div>
                <p>Sugar Level</p>
                <select id="countries"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-white">
                    <option selected>-- Choose Sugar Level --</option>
                    <option value="100">100%</option>
                    <option value="75">75%</option>
                    <option value="50">50%</option>
                    <option value="25">25%</option>
                    <option value="0">0%</option>
                </select>
                <div class="flex justify-between mt-3">
                    <span>STotal:</span>
                    <span>₱49.00</span>
                </div>
                <div class="mt-6 flex justify-end space-x-4">
                    <button type="button"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Enter Order
                    </button>
                    <button id="cancelButton" type="button"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-transparent rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="{{ asset('./javascript/pos_java.js') }}"></script>
    <script src="{{ asset('./javascript/display_java.js') }}"></script>
</x-app-layout>
