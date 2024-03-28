<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Point Of Sale') }}
        </h2>
    </x-slot>

    <div class="flex flex-row justify-between mt-10 mr-5 ml-3">
        <div class="container">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($products as $product)
                    <div>
                        <figure class="relative max-w-sm h-45">
                            <a href="#"
                                class="modalButton {{ $product->num_products_can_be_made > 0 ? 'modalButton' : '' }}"
                                data-product-id="{{ $product->id }}" data-product-name="{{ $product->Product_Name }}"
                                data-selling-price="{{ $product->Selling_Price }}"
                                data-num-products="{{ $product->num_products_can_be_made }}"
                                data-num-cost="{{ $product->Cost }}"
                                data-available="{{ $product->num_products_can_be_made > 0 ? 'Yes' : 'No' }}">
                                <img class="h-auto max-w-full rounded-lg{{ $product->num_products_can_be_made <= 0 ? ' grayscale' : '' }}"
                                src="{{ $product->Image ? asset($product->Image) : asset('uploads/category/1708225090.jpg') }}"
                                alt="Product Image"
                                style="height: 250px; width: 300px;">
                           
                            </a>
                            <figcaption class="absolute px-1 text-sm text-white bottom-6 bg-black">
                                <p>₱{{ $product->Selling_Price }}</p>
                                <p>{{ $product->Product_Name }} (x{{ $product->num_products_can_be_made }})</p>
                                @if ($product->num_products_can_be_made <= 0)
                                    <p>NOT AVAILABLE</p>
                                @endif
                            </figcaption>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container w-1/2 bg-white p-5 rounded-lg shadow-md ml-3">
            <h3 class="text-lg font-semibold mb-4">Customer Details</h3>
            <div class="flex flex-col">
                @if ($sale->count() > 0)
                    <div class="mb-4">
                        <label for="first_name" class="text-gray-700 mb-2 font-bold">OR # :
                            {{ $sale->first()->OrNumber }}</label><br>
                        <label for="first_name" class="text-gray-700 mb-2">Customer name:</label>
                        <input type="text" id="first_name" name="Customer_Name"
                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $sale->first()->Customer_Name }}">
                    </div>
                    <hr class="my-4">
                    <div class="mb-4">
                        <h2 class="font-semibold text-lg mb-2">Order List</h2>
                        <div class="grid grid-cols-1 gap-4">
                            @foreach ($sale as $sales)
                                <div class="border border-gray-300 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div>
                                            <h3 class="text-lg font-semibold">{{ $sales->Product_Name }}</h3>
                                            <span class="text-gray-600">Quantity: {{ $sales->Qty }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-600">Price: ₱{{ $sales->Unit_Price }}</span>
                                        </div>
                                    </div>
                                    <div class="text-gray-600">
                                        <p>Sugar: {{ $sales->Sugar }}%</p>
                                        <p>Topping: {{ $sales->Topping }}</p>
                                        <p>Add on: {{ $sales->Add_on }}</p>
                                    </div>
                                    <div class="mt-2">
                                        <span class="font-semibold">Total: ₱{{ $sales->Sub_Total }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex justify-between mb-2">
                        <span>Total:</span>
                        <span id="total">₱{{ number_format($sale->sum('Sub_Total'), 2) }}</span>
                    </div>

                    <input type="number" id="discount" name="discount"
                        class="mb-5 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Discount" required>
                    <input type="number" id="cash" name="cash"
                        class="mb-5 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Cash" required>
                    <input type="text" id="exchange" name="exchange"
                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Exchange" required disabled>
                @else
                    <div class="mb-4">
                        <label for="first_name" class="text-gray-700 mb-2">Customer name:</label>
                        <input type="text" name="Customer_Name" id="first_name"
                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Name" required>
                    </div>
                    <hr class="my-4">
                    <div class="mb-4">
                        <span class="font-semibold">Order List</span>
                        <div class="flex flex-col mt-2">
                            <div class="flex justify-between mb-2">
                                <!-- Your order list details here -->
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex justify-between mb-2">
                        <span>Total:</span>
                        <span id="total">₱0.00</span>
                    </div>
                @endif
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" id="refreshBTN"
                    class="inline-flex   mr-2 justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    onclick="location.reload()">Refresh
                </button>
                @if ($sale->isNotEmpty())
                    <form method="post"
                        action="{{ route('cancelOrder.order', ['OR' => $sale->first()->OrNumber ?: '']) }}">
                        @csrf
                        <button type="submit"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2">Cancel</button>
                    </form>

                    <form id="sellForm" method="POST"
                        action="{{ route('register.sell', ['OR' => $sale->first()->OrNumber ?: '']) }}">
                        @csrf
                        <input type="hidden" name="Customer_Name" id="Customer_Name">
                        <input type="hidden" name="total" value="{{ number_format($sale->sum('Sub_Total'), 2) }}">

                        <input type="number" id="discount1" name="discount" placeholder="Discount" hidden>
                        <input type="number" id="cash1" name="cash" placeholder="Cash" hidden>
                        <input type="text" id="exchange1" name="exchange" placeholder="Exchange" hidden>

                        <button id="sellButton" type="submit" onclick="clickButton()"
                            class="text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                            disabled>Sell</button>
                    </form>
                @else
                @endif
            </div>
        </div>
        <!-- Modal -->
        <div id="myModal"
            class="hidden fixed inset-0 z-10 bg-gray-500 bg-opacity-75 flex justify-center items-center">
            <div class="bg-white p-6 rounded-md shadow-md w-100">
                <div class="flex flex-col items-start">
                    <div class="flex items-center justify-between w-full">
                        <h3 id="productName" class="text-lg font-semibold leading-6 text-gray-900">----------- Order
                            This
                            Product</h3>
                    </div>
                    <form method="POST" action="{{ route('Insert-Order') }}">
                        @csrf
                        <div class="mt-4">
                            <input type="text" id="product_id" name="product_id"
                                class="hidden bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                                placeholder="product_id">

                            <!-- Product details -->
                            <input type="text" id="cost" name="Cost_Price"
                                class="hidden bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                                placeholder="Qty Order">

                            <input type="text" id="name" name="Product_Name"
                                class="hidden bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                                placeholder="NAME">

                            <input type="text" id="available"
                                class="hidden bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                                placeholder="Qty Available">

                            <p id="productDetails" class="mb-2">Product details will appear here.</p>
                            <input type="text" name="Unit_Price" id="price"
                                class="hidden bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                                placeholder="Pricee">

                            <span>
                                <input type="text" id="order_quantity" name="Qty"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                                    placeholder="Qty Order" onblur="checkOrder()" required>
                                <span id="order_message"></span>
                            </span>
                            <div class="mb-6 mt-5">
                                <p>Toppings</p>
                                <select name="toppings1" id="toppings"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-white">
                                    <option selected>-- Choose What Type of Categories --</option>
                                    @foreach ($toppings1 as $item)
                                        <option value="{{ $item->recipe->recipe_name }}">
                                            {{ $item->recipe->recipe_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-6">
                                <p>Add On</p>
                                <select name="Add_on" id="addOns"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-white">
                                    <option selected>-- Choose What Type of Categories --</option>
                                    @foreach ($toppings2 as $item)
                                        <option value="{{ $item->recipe->recipe_name }}">
                                            {{ $item->recipe->recipe_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-6">
                                <p>Sugar Level</p>
                                <select id="sugarLevel" name="Sugar"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-white">
                                    <option selected>-- Choose Sugar Level --</option>
                                    <option value="100">100%</option>
                                    <option value="75">75%</option>
                                    <option value="50">50%</option>
                                    <option value="25">25%</option>
                                    <option value="0">0%</option>
                                </select>
                            </div>
                            <div class="flex justify-between mt-3">
                                <span>Total:</span>
                                <span id="Total" name="Sub_Total">₱0.00</span>
                                <input type="text" id="Sub_Total" name="Sub_Total"
                                    class="hidden bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                                    placeholder="Sub_Total">
                            </div>
                            <div class="mt-6 flex justify-end space-x-4">
                                <button type="submit" id="submitBtn"
                                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Enter
                                    Order</button>
                                <button id="cancelButton" type="button"
                                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-transparent rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="{{ asset('./javascript/pos_java.js') }}"></script>
        <script src="{{ asset('./javascript/display_java.js') }}"></script>
        <script>
            // Function to compute the exchange and manage the Sell button
            function computeExchange() {
                // Get the total, discount, and cash values
                var total = parseFloat(document.getElementById('total').textContent.replace('₱', '')) || 0;
                var discount = parseFloat(document.getElementById('discount').value) || 0;
                var cash = parseFloat(document.getElementById('cash').value) || 0;

                var discount1 = document.getElementById('discount1');
                var cash1 = document.getElementById('cash1');
                var exchange1 = document.getElementById('exchange1');

                // Compute the exchange
                var exchange = cash - (total - discount);
                document.getElementById('exchange').value = '₱' + exchange.toFixed(2);

                // Enable/disable the Sell button based on cash and discount amounts
                var sellButton = document.getElementById('sellButton');
                sellButton.disabled = (cash < total) || (discount > cash) || (discount > total);
                discount1.value = discount;
                cash1.value = cash;
                exchange1.value = exchange.toFixed(2);
            }

            // Add event listeners to the discount and cash input fields
            document.getElementById('discount').addEventListener('input', computeExchange);
            document.getElementById('cash').addEventListener('input', computeExchange);

            function clickButton() {
                // Simulate a click on the button with id "targetButton"
                console.log('clicked');

                // Replace 'targetButton' with the actual id of your button
                var button = document.getElementById('targetButton');
                if (button) {
                    button.click();
                }

                // Reload the page after a delay of 3 seconds
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        </script>



</x-app-layout>
