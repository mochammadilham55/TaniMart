<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\BuildsSalesReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    use BuildsSalesReport;

    public function index(Request $request)
    {
        $report = $this->salesReport($request, null);

        if ($request->query('export') === 'csv') {
            return $this->salesCsv($report, 'laporan-penjualan-semua-'.now()->format('Ymd').'.csv');
        }

        return view('admin.reports.index', $report);
    }
}
