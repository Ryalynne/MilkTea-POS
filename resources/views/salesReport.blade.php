<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports') }}
        </h2>
        @vite('resources/css/app.css')
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">

                <div class="flex mt-3 mb-5">
                </div>
                <form action="/Sales_Report" method="get" class="mb-4">
                    <div class="date-picker flex items-center gap-4">
                        <label for="start-date" class="text-gray-700">START DATE:</label>
                        <input type="date" id="start-date" name="start_date"
                            value="{{ request()->input('start_date') }}"
                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-2">

                        <label for="end-date" class="text-gray-700">END DATE:</label>
                        <input type="date" id="end-date" name="end_date" value="{{ request()->input('end_date') }}"
                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-2">

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Generate
                            Report</button>

                        <button type="button" id="print-pdf"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">PRINT</button>
                    </div>
                </form>




                <script>
                    document.getElementById('print-pdf').addEventListener('click', function() {
                        window.open('/sales_pdf?start_date=' + document.getElementById('start-date').value + '&end_date=' +
                            document.getElementById('end-date').value, '_blank');
                    });
                </script>



                <h1 class="text-3xl font-bold text-center text-gray-800 mt-8 mb-4">SALES INCOME SUMMARY</h1>
                <div class="relative overflow-x-auto">
                    @php
                        $summary = [];
                    @endphp

                    @foreach ($sales as $items)
                        @php
                            $orderNo = $items->saleproduct->OrNumber;
                            $total = is_numeric(str_replace(',', '', $items->Total))
                                ? floatval(str_replace(',', '', $items->Total))
                                : 0;
                            $costPrice = is_numeric(str_replace(',', '', $items->Cost_Price))
                                ? floatval(str_replace(',', '', $items->Cost_Price))
                                : 0;
                            $profit = $total - $costPrice;

                            // Initialize summary for this order number if not exist
                            if (!isset($summary[$orderNo])) {
                                $summary[$orderNo] = [
                                    'total_qty' => 0,
                                    'total_sales' => 0,
                                    'total_cost' => 0,
                                    'total_profit' => 0,
                                ];
                            }

                            // Update summary values
                            $summary[$orderNo]['total_qty'] += $items->Qty;
                            $summary[$orderNo]['total_sales'] = $total;
                            $summary[$orderNo]['total_cost'] += $costPrice;
                            $summary[$orderNo]['total_profit'] = $total - $costPrice;
                        @endphp
                    @endforeach

                    <!-- Display the summary -->
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-4">Order No.</th>
                                <th class="px-6 py-4">Total Quantity</th>
                                <th class="px-6 py-4">Total Sales</th>
                                <th class="px-6 py-4">Total Cost</th>
                                <th class="px-6 py-4">Total Profit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($summary as $orderNo => $data)
                                <tr class=" bg-white border-b">
                                    <td class="border px-6 py-4">{{ $orderNo }}</td>
                                    <td class="border px-6 py-4">{{ $data['total_qty'] }}</td>
                                    <td class="border px-6 py-4 text-right">
                                        {{ number_format($data['total_sales'], 2) }}</td>
                                    <td class="border px-6 py-4 text-right">
                                        {{ number_format($data['total_cost'], 2) }}</td>
                                    <td class="border px-6 py-4 text-right">
                                        {{ number_format($data['total_profit'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h1 class="text-3xl font-bold text-center text-gray-800 mt-8 mb-4">SALES INCOME PER PRODUCT</h1>
                    <!-- Table -->
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Order No.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Customer Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        QTY
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Unit Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-3">
                                    Total
                                </th> --}}
                                    <th scope="col" class="px-6 py-3">
                                        Cost Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Profit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date of Transaction
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $items)
                                    <tr class=" bg-white border-b">
                                        <th scope="row" class="border px-6 py-4 font-medium whitespace-nowrap">
                                            {{ $items->saleproduct->OrNumber }}
                                        </th>
                                        <td class="border px-6 py-4">
                                            {{ $items->Customer_Name }}
                                        </td>
                                        <td class="border px-6 py-4">
                                            {{ $items->Product_Name }}
                                        </td>
                                        <td class="border px-6 py-4">
                                            {{ $items->Qty }}
                                        </td>
                                        <td class="border px-6 py-4 text-right">
                                            {{ $items->Unit_Price }}
                                        </td>
                                        <td class="border px-6 py-4 text-right">
                                            {{ $items->Sub_Total }}
                                        </td>
                                        <td class="border px-6 py-4 text-right">
                                            {{ number_format(floatval($items->Cost_Price), 2) }}
                                        </td>
                                        <td class="border px-6 py-4 text-right">
                                            @php
                                                $total = is_numeric(str_replace(',', '', $items->Sub_Total))
                                                    ? floatval(str_replace(',', '', $items->Sub_Total))
                                                    : 0;
                                                $costPrice = is_numeric($items->Cost_Price)
                                                    ? floatval($items->Cost_Price)
                                                    : 0;
                                                $profit = $total - $costPrice;
                                                echo number_format(abs($profit), 2); // Using abs() to ensure positive value
                                            @endphp
                                        </td>
                                        <td class="border px-6 py-4 ">
                                            {{ $items->created_at }}
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
