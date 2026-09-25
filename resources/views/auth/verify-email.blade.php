<x-guest-layout>
    <!-- Background Langit Malam & Bintang -->
    <div class="fixed inset-0 bg-gradient-to-b from-slate-950 via-slate-900 to-blue-950 z-0 overflow-hidden pointer-events-none">
        <!-- Efek Bintang Jatuh (Dari Kanan Atas ke Kiri Bawah) -->
        <div class="absolute top-10 right-1/4 h-[2px] bg-gradient-to-l from-white to-transparent animate-shooting-star opacity-70"></div>
        <div class="absolute top-32 right-10 h-[2px] bg-gradient-to-l from-white to-transparent animate-shooting-star opacity-50 [animation-delay:2s]"></div>

        <!-- Bintang-bintang kecil statis -->
        <div class="absolute top-12 left-10 w-1 h-1 bg-white rounded-full opacity-60"></div>
        <div class="absolute top-32 right-20 w-1 h-1 bg-white rounded-full opacity-40"></div>
        <div class="absolute bottom-40 left-1/3 w-0.5 h-0.5 bg-white rounded-full opacity-50"></div>
    </div>

    <!-- Container Card Verifikasi Email QuasarTopUp -->
    <div class="relative z-10 max-w-md w-full mx-auto bg-slate-900/80 backdrop-blur-md p-8 rounded-2xl border border-blue-500/20 shadow-2xl shadow-blue-500/10 my-10">
        
        <!-- Judul / Branding Game Store -->
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-white tracking-widest uppercase bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">QuasarTopUp</h2>
            <p class="text-slate-400 text-xs mt-1">Satu Langkah Lagi!</p>
        </div>

        <div class="mb-6 text-sm text-slate-300 leading-relaxed text-center">
            Terima kasih telah mendaftar di <span class="text-blue-400 font-semibold">QuasarTopUp</span>! Sebelum memulai top-up game, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan ke inbox Anda.
        </div>

        <!-- Notifikasi jika user meminta kirim ulang email -->
        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-sm font-medium text-emerald-400 text-center animate-pulse">
                🚀 Tautan verifikasi baru telah berhasil dikirim ke alamat email Anda. Silakan cek folder Inbox atau Spam.
            </div>
        @endif

        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <!-- Form Kirim Ulang Tautan -->
            <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                @csrf
                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 focus:outline-none transition duration-150">
                    Kirim Ulang Email
                </button>
            </form>

            <!-- Form Keluar / Log Out -->
            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                @csrf
                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-slate-700 rounded-xl text-sm font-medium text-slate-400 bg-slate-950/40 hover:bg-slate-800 hover:text-white transition duration-150">
                    Keluar Sesi
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
