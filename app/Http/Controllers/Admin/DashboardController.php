<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction; 
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 📊 PERBAIKAN: Pastikan kata 'SUCCESS' dan 'PENDING' dibungkus tanda petik
        $totalPenjualan = Transaction::where('status', 'SUCCESS')->sum('price');
        $totalProfit = Transaction::where('status', 'SUCCESS')->sum('profit');
        
        $transaksiSukses = Transaction::where('status', 'SUCCESS')->count();
        $transaksiPending = Transaction::where('status', 'PENDING')->count();

        // 📋 Mengambil 10 data riwayat transaksi terbaru dari database
        $latestTransactions = Transaction::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalPenjualan', 
            'totalProfit', 
            'transaksiSukses', 
            'transaksiPending', 
            'latestTransactions'
        ));
    }
}
