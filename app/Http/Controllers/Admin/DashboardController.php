<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total Pendapatan (Hanya status Success)
        $totalRevenue = Transaction::where('status', 'Success')->sum('total_price');

        // 2. Tiket Terjual (Jumlah transaksi sukses)
        $ticketsSold = Transaction::where('status', 'Success')->count();

        // 3. Event Aktif
        $activeEventsCount = Event::count();

        // 4. Pesanan Pending
        $pendingOrdersCount = Transaction::where('status', 'Pending')->count();

        // 5. Transaksi Terakhir (5 transaksi terbaru)
        $latestTransactions = Transaction::with('event')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'ticketsSold',
            'activeEventsCount',
            'pendingOrdersCount',
            'latestTransactions'
        ));
    }
}
