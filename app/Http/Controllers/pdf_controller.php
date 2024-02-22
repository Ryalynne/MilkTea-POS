<?php

namespace App\Http\Controllers;

use App\Models\sales_records;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pdf_controller extends Controller
{
    public function print_sales(Request $request)
    {
        // Retrieve start and end dates from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Query sales records between the specified dates
        $sales = sales_records::whereBetween('created_at', [$startDate, $endDate])->get();
    
        // Pass the sales data to the view
        $data = [
            'sales' => $sales,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];
    
        // Load the view and generate PDF
        $pdf = PDF::loadView('sales_pdf', $data);
    
        // Return the PDF as a stream
        return $pdf->download('invoice.pdf');
    }
    
}
