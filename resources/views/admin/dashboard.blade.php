<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - QuasarTopUp</title>
    <!-- Hubungkan Aset CSS Vite secara benar -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen">

    <div class="flex">
        <!-- SIDEBAR KIRI -->
        <aside class="w-64 min-h-screen border-r border-slate-900 bg-slate-950 p-6 space-y-6">
            <div class="text-center pb-4 border-b border-slate-900">
                <span class="text-lg font-extrabold tracking-widest text-blue-400 uppercase">QUASAR ADMIN</span>
                <p class="text-[10px] text-slate-500 uppercase mt-0.5">Toko Mandiri Control</p>
            </div>
            <nav class="space-y-1">
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 bg-blue-600/10 border border-blue-500/20 text-blue-400 rounded-xl text-xs font-bold">
                    📊 Ringkasan Finansial
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-900 hover:text-white rounded-xl text-xs transition">
                    📦 Kelola Produk & Stok
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-900 hover:text-white rounded-xl text-xs transition">
                    💸 Pengaturan Pembayaran
                </a>
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-slate-300 rounded-xl text-xs transition pt-10">
                    ← Lihat Web Utama
                </a>
            </nav>
        </aside>

        <!-- KONTEN UTAMA KANAN -->
        <main class="flex-1 p-8 space-y-8">
            <header class="flex items-center justify-between border-b border-slate-900 pb-4">
                <div>
                    <h1 class="text-2xl font-bold text-white tracking-wide">Monitor Bisnis QuasarTopUp</h1>
                    <p class="text-slate-500 text-xs mt-1">Data arus kas, penjualan otomatis, dan evaluasi keuntungan bersih</p>
                </div>
                <span class="px-3 py-1 text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-full">
                    🟢 Koneksi Sistem Aman
                </span>
            </header>

            <!-- KARTU STATISTIK FINANSIAL DAERAH -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="rounded-2xl border border-slate-900 bg-slate-900/20 p-6">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Omset Kotor</p>
                    <h3 class="text-2xl font-extrabold text-white mt-2">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</h3>
                    <p class="text-[10px] text-blue-400 mt-1">Arus kas masuk dari pembeli</p>
                </div>
                <div class="rounded-2xl border border-blue-500/10 bg-gradient-to-br from-slate-900 via-slate-900 to-blue-950/30 p-6 shadow-xl shadow-blue-500/[0.02]">
                    <p class="text-xs font-semibold text-blue-400 uppercase tracking-wider">Keuntungan Bersih (Profit)</p>
                    <h3 class="text-2xl font-extrabold text-emerald-400 mt-2">Rp {{ number_format($totalProfit, 0, ',', '.') }}</h3>
                    <p class="text-[10px] text-slate-400 mt-1">Target menuju Rp 1.000.000</p>
                </div>
                <div class="rounded-2xl border border-slate-900 bg-slate-900/20 p-6">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Transaksi Sukses</p>
                    <h3 class="text-2xl font-extrabold text-white mt-2">{{ $transaksiSukses }} <span class="text-xs text-slate-500 font-normal">Pesanan</span></h3>
                    <p class="text-[10px] text-emerald-400 mt-1">SLA Voucher terkirim tepat waktu</p>
                </div>
                <div class="rounded-2xl border border-slate-900 bg-slate-900/20 p-6">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Menunggu Diproses</p>
                    <h3 class="text-2xl font-extrabold text-amber-400 mt-2">{{ $transaksiPending }} <span class="text-xs text-slate-500 font-normal">Order</span></h3>
                    <p class="text-[10px] text-amber-500 mt-1">Perlu pengecekan manual stok Anda</p>
                </div>
            </section>

            <!-- TABEL REAL DATABASE -->
            <section class="rounded-2xl border border-slate-900 bg-slate-900/20 overflow-hidden">
                <div class="p-6 border-b border-slate-900 bg-slate-900/40">
                    <h2 class="text-base font-bold text-white">Log Aktivitas Arus Transaksi Terbaru</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-slate-900 bg-slate-950 text-slate-400 font-semibold uppercase tracking-wider">
                                <th class="p-4">No. Invoice</th>
                                <th class="p-4">Game / Voucher</th>
                                <th class="p-4">Target Player ID</th>
                                <th class="p-4">Harga Jual</th>
                                <th class="p-4">Profit Bersih</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-900 text-slate-300">
                            @forelse($latestTransactions as $tx)
                                <tr class="hover:bg-slate-900/40 transition">
                                    <td class="p-4 font-mono font-bold text-blue-400">{{ $tx->invoice_id }}</td>
                                    <td class="p-4">
                                        <p class="font-bold text-white">{{ $tx->game_name }}</p>
                                        <p class="text-[10px] text-slate-500">{{ $tx->product_name }}</p>
                                    </td>
                                    <td class="p-4 font-mono text-slate-400">
                                        {{ $tx->zone_id ? $tx->user_id . ' (' . $tx->zone_id . ')' : $tx->user_id }}
                                    </td>
                                    <td class="p-4 font-semibold">Rp {{ number_format($tx->price, 0, ',', '.') }}</td>
                                    <td class="p-4 font-bold text-emerald-400">+Rp {{ number_format($tx->profit, 0, ',', '.') }}</td>
                                    <td class="p-4">
                                        @if($tx->status == 'SUCCESS')
                                            <span class="px-2 py-0.5 text-[10px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-md">SUCCESS</span>
                                        @elseif($tx->status == 'FAILED')
                                            <span class="px-2 py-0.5 text-[10px] font-bold bg-rose-500/10 text-rose-400 border border-rose-500/20 rounded-md">FAILED</span>
                                        @else
                                            <span class="px-2 py-0.5 text-[10px] font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20 rounded-md animate-pulse">PENDING</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-slate-500">{{ $tx->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-8 text-center text-slate-600 font-medium">
                                        🌌 Belum ada arus transaksi masuk. Siap menerima orderan perdana bulan depan!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

</body>
</html>
