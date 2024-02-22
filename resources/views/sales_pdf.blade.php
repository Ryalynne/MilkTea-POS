<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Income</title>
    <h1>Date Range: {{ $startDate }} - {{ $endDate }}</h1>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            color: #333333;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .border-b {
            border-bottom: 1px solid #dddddd;
        }
    </style>
</head>

<body>

    <h1>Sales Income</h1>

    <div class="relative overflow-x-auto">
        @php
            $summary = [];
            $totalQuantity = 0;
            $totalSales = 0;
            $totalCost = 0;
            $totalProfit = 0;
        @endphp

        @foreach ($sales as $items)
            @php
                $orderNo = $items->saleproduct->OrNumber;
                $total = is_numeric(str_replace(',', '', $items->Total)) ? floatval(str_replace(',', '', $items->Total)) : 0;
                $costPrice = is_numeric(str_replace(',', '', $items->Cost_Price)) ? floatval(str_replace(',', '', $items->Cost_Price)) : 0;
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

                // Update totals
                $totalQuantity += $items->Qty;
                $totalSales += $total;
                $totalCost += $costPrice;
                $totalProfit += $profit;
            @endphp
        @endforeach

        <!-- Display the summary -->
        <table>
            <thead>
                <tr>
                    <th>Order No.</th>
                    <th>Total Quantity</th>
                    <th>Total Sales</th>
                    <th>Total Cost</th>
                    <th>Total Profit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($summary as $orderNo => $data)
                    <tr class="bg-white border-b">
                        <td>{{ $orderNo }}</td>
                        <td>{{ $data['total_qty'] }}</td>
                        <td class="text-right">
                            {{ number_format($data['total_sales'], 2) }}</td>
                        <td class="text-right">
                            {{ number_format($data['total_cost'], 2) }}</td>
                        <td class="text-right">
                            {{ number_format($data['total_profit'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="1"><strong>Total:</strong></td>
                    <td class="text-right"><strong>{{ number_format($totalQuantity) }}</strong></td>
                    <td class="text-right"><strong>{{ number_format($totalSales, 2) }}</strong></td>
                    <td class="text-right"><strong>{{ number_format($totalCost, 2) }}</strong></td>
                    <td class="text-right"><strong>{{ number_format($totalProfit, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>


        <div class="relative overflow-x-auto">
            @php
                $summary = [];
                $totalUnit = 0;
                $totalQtyProduct = 0;
                $totalSalesProduct = 0;
                $totalCostProduct = 0;
                $totalProfitProduct = 0;
            @endphp

            <h1 class="text-3xl font-bold text-center text-gray-800 mt-8 mb-4">Sales Income Per Product</h1>
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
                            <th scope="col" class="px-6 py-3">
                                Cost Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Profit
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
                                        $total = is_numeric(str_replace(',', '', $items->Sub_Total)) ? floatval(str_replace(',', '', $items->Sub_Total)) : 0;
                                        $costPrice = is_numeric($items->Cost_Price) ? floatval($items->Cost_Price) : 0;
                                        $unit = is_numeric($items->Unit_Price) ? floatval($items->Unit_Price) : 0;
                                        $profit = $total - $costPrice;
                                        echo number_format(abs($profit), 2); // Using abs() to ensure positive value
                                    @endphp
                                </td>
                            </tr>
                            @php
                                $totalQtyProduct += $items->Qty;
                                $totalUnit += $unit;
                                $totalSalesProduct += $total;
                                $totalCostProduct += $costPrice;
                                $totalProfitProduct += $profit;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Total:</strong></td>
                            <td><strong>{{ $totalQtyProduct }}</strong></td>
                            <!-- Omitting total calculation for "Unit Price" column -->
                            <td><strong>{{ number_format($totalUnit, 2) }}</strong></td>
                            <td><strong>{{ number_format($totalSalesProduct, 2) }}</strong></td>
                            <td><strong>{{ number_format($totalCostProduct, 2) }}</strong></td>
                            <td><strong>{{ number_format($totalProfitProduct, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</body>

</html>
