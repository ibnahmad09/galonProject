<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Delivery;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Halaman utama laporan
    public function index(Request $request)
    {
        $type = $request->get('type');
        $period = $request->get('period', 'daily');
        $date = $request->get('date', now()->toDateString());
        $resultView = null;
        $data = compact('type', 'period', 'date');

        if ($type === 'sales') {
            $orders = $this->getOrdersByPeriod($period, $date);
            $resultView = view('admin.reports.partials.sales', compact('orders', 'period', 'date'))->render();
        } elseif ($type === 'income') {
            $orders = $this->getOrdersByPeriod($period, $date);
            $totalIncome = $orders->sum('total_price');
            $resultView = view('admin.reports.partials.income', compact('orders', 'totalIncome', 'period', 'date'))->render();
        } elseif ($type === 'deliveries') {
            $deliveries = $this->getDeliveriesByPeriod($period, $date);
            $resultView = view('admin.reports.partials.deliveries', compact('deliveries', 'period', 'date'))->render();
        }

        return view('admin.reports.index', array_merge($data, ['resultView' => $resultView]));
    }

    // Laporan Penjualan
    public function sales(Request $request)
    {
        $period = $request->get('period', 'daily');
        $date = $request->get('date', now()->toDateString());
        $orders = $this->getOrdersByPeriod($period, $date);
        return view('admin.reports.sales', compact('orders', 'period', 'date'));
    }

    // Laporan Pendapatan
    public function income(Request $request)
    {
        $period = $request->get('period', 'daily');
        $date = $request->get('date', now()->toDateString());
        $orders = $this->getOrdersByPeriod($period, $date);
        $totalIncome = $orders->sum('total_price');
        return view('admin.reports.income', compact('orders', 'totalIncome', 'period', 'date'));
    }

    // Laporan Pengiriman
    public function deliveries(Request $request)
    {
        $period = $request->get('period', 'daily');
        $date = $request->get('date', now()->toDateString());
        $deliveries = $this->getDeliveriesByPeriod($period, $date);
        return view('admin.reports.deliveries', compact('deliveries', 'period', 'date'));
    }

    // Export PDF
    public function exportPdf(Request $request)
    {
        $type = $request->get('type'); // sales, income, deliveries
        $period = $request->get('period', 'daily');
        $date = $request->get('date', now()->toDateString());
        if ($type === 'sales') {
            $orders = $this->getOrdersByPeriod($period, $date);
            $pdf = Pdf::loadView('admin.reports.pdf.sales', compact('orders', 'period', 'date'));
            $filename = 'laporan_penjualan_' . $period . '_' . $date . '.pdf';
        } elseif ($type === 'income') {
            $orders = $this->getOrdersByPeriod($period, $date);
            $totalIncome = $orders->sum('total_price');
            $pdf = Pdf::loadView('admin.reports.pdf.income', compact('orders', 'totalIncome', 'period', 'date'));
            $filename = 'laporan_pendapatan_' . $period . '_' . $date . '.pdf';
        } elseif ($type === 'deliveries') {
            $deliveries = $this->getDeliveriesByPeriod($period, $date);
            $pdf = Pdf::loadView('admin.reports.pdf.deliveries', compact('deliveries', 'period', 'date'));
            $filename = 'laporan_pengiriman_' . $period . '_' . $date . '.pdf';
        } else {
            abort(404);
        }
        return $pdf->download($filename);
    }

    // Helper: Ambil orders berdasarkan periode
    private function getOrdersByPeriod($period, $date)
    {
        if ($period === 'daily') {
            return Order::whereDate('created_at', $date)->get();
        } elseif ($period === 'monthly') {
            $carbon = Carbon::parse($date);
            return Order::whereYear('created_at', $carbon->year)
                ->whereMonth('created_at', $carbon->month)
                ->get();
        } elseif ($period === 'yearly') {
            $carbon = Carbon::parse($date);
            return Order::whereYear('created_at', $carbon->year)->get();
        }
        return collect();
    }

    // Helper: Ambil deliveries berdasarkan periode
    private function getDeliveriesByPeriod($period, $date)
    {
        if ($period === 'daily') {
            return Delivery::whereDate('created_at', $date)->get();
        } elseif ($period === 'monthly') {
            $carbon = Carbon::parse($date);
            return Delivery::whereYear('created_at', $carbon->year)
                ->whereMonth('created_at', $carbon->month)
                ->get();
        } elseif ($period === 'yearly') {
            $carbon = Carbon::parse($date);
            return Delivery::whereYear('created_at', $carbon->year)->get();
        }
        return collect();
    }
}
