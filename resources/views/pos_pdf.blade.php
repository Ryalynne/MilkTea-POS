<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
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
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <center><h1>MILKEZE</h1></center>
    OR: {{ $sales[0]->saleproduct->OrNumber }} Date Printed: {{ now() }}
    <br>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Sugar Level</th>
                <th>Toppings</th>
                <th>Add On</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->Product_Name }}</td>
                    <td>{{ $sale->Qty }}</td>
                    <td>{{ $sale->Unit_Price }}</td>
                    <td>{{ $sale->Sugar }}%</td>
                    <td>{{ $sale->Topping }}</td>
                    <td>{{ $sale->Add_on }}</td>
                    <td>{{ $sale->Qty * $sale->Unit_Price }}</td>
                </tr>
            @endforeach
            <tr class="total">
                <td colspan="6">Total</td>
                <td>{{ $sales->sum(function ($sale) {return $sale->Qty * $sale->Unit_Price;}) }}</td>
            </tr>
        </tbody>
    </table>
    <div class="mb-6">
        <label for="discount" class="block mb-2 text-sm font-medium text-gray-900">Discount:</label>
    </div>

    <div class="mb-6">
        <label for="cash" class="block mb-2 text-sm font-medium text-gray-900">Cash: {{ $cash }}</label>
    </div>

    <div class="mb-6">
        <label for="exchange" class="block mb-2 text-sm font-medium text-gray-900">Exchange:
            {{ $exchange }}</label>
    </div>
</body>

</html>
