<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuasarTopUp - Premium Gaming Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Space Grotesk', sans-serif; }
        .font-quasar-title { font-family: 'Orbitron', sans-serif; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen relative overflow-x-hidden">

    <!-- Efek Pendaran Nebula Ruang Angkasa -->
    <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute top-[30%] right-[-10%] w-[600px] h-[600px] bg-purple-600/10 rounded-full blur-[150px] pointer-events-none"></div>

    <!-- CANVAS EFEK PARTIKEL BINTANG KEREN -->
    <canvas id="starParticles" class="fixed inset-0 z-0 pointer-events-none opacity-80"></canvas>

    <!-- WRAPPER KONTEN (Perlu relative dan z-10 agar berada di atas partikel) -->
    <div class="relative z-10">
        
        <!-- NAVIGATION HEADER -->
        <nav class="border-b border-slate-900 bg-slate-950/80 backdrop-blur-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
                <div class="flex items-center gap-12">
                    <a href="#" class="text-xl font-black tracking-widest bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 bg-clip-text text-transparent uppercase font-quasar-title">
                        QuasarTopUp
                    </a>
                    <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-400">
                        <a href="#" class="text-blue-400 font-semibold border-b-2 border-blue-400 pb-1">Home</a>
                        <a href="#" class="hover:text-white transition">Top Up</a>
                        <a href="#" class="hover:text-white transition">Games</a>
                        <a href="#" class="hover:text-white transition">Esports</a>
                        <a href="#" class="hover:text-white transition">Support</a>
                    </div>
                </div>

                <!-- Profile & Notification Icons -->
                <div class="flex items-center gap-4">
                    @auth
                        <div class="flex items-center gap-3">
                            <button class="p-2 text-slate-400 hover:text-white bg-slate-900 rounded-xl border border-slate-800 relative">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                <span class="absolute top-1 right-1 w-2 h-2 bg-purple-500 rounded-full"></span>
                            </button>
                            <div class="flex items-center gap-2 bg-slate-900 border border-slate-800 px-3 py-1.5 rounded-xl">
                                <div class="w-7 h-7 rounded-full bg-slate-800 overflow-hidden border border-slate-700">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" alt="Avatar" class="w-full h-full object-cover">
                                </div>
                                <span class="text-xs font-semibold text-slate-200">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition">Masuk</a>
                        <a href="{{ route('register') }}" class="text-sm font-semibold px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white rounded-xl shadow-lg transition">Daftar</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- WRAPPER LAYOUT UTAMA (GRID 4 KOLOM KANAN-KIRI) -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- KOLOM KIRI (3 KOLOM): BANNER PROMO & GAMES -->
            <div class="lg:col-span-3 space-y-10">
                
                <!-- SECTION 1: HERO PROMO BANNER -->
                <div class="relative rounded-3xl overflow-hidden border border-blue-500/10 bg-gradient-to-r from-slate-900 via-slate-900 to-indigo-950 p-8 sm:p-12 shadow-2xl flex items-center justify-between min-h-[260px]">
                    <div class="max-w-md relative z-10 space-y-4">
                        <h2 class="text-3xl font-black text-white font-quasar-title tracking-wide">GENSHIN IMPACT</h2>
                        <h3 class="text-xl font-bold text-slate-200">TOP-UP GENESIS CRYSTALS!</h3>
                        <p class="text-sm text-slate-400">Instant Delivery. Bonus Untung 10% Spesial Bulan Ini.</p>
                        <a href="/game/genshin-impact" class="inline-block px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-xl uppercase tracking-wider shadow-lg shadow-blue-500/20 transition">Top-Up Now</a>
                    </div>
                    <div class="text-8xl opacity-5 font-black font-quasar-title select-none hidden sm:block">QUASAR</div>
                </div>

                <!-- SECTION 2: POPULAR GAMES GRID -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-bold tracking-wide uppercase font-quasar-title text-slate-300">Popular Games</h3>
                        <a href="#" class="text-xs text-blue-400 hover:underline">View All</a>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                        @forelse($games ?? [] as $g)
                            <a href="/game/{{ $g['slug'] ?? '#' }}" class="group relative rounded-2xl border border-slate-900 bg-slate-900/30 p-3 text-center hover:border-blue-500/40 transition-all duration-300 flex flex-col items-center justify-between min-h-[180px] overflow-hidden">
                                <div class="w-full h-24 rounded-xl overflow-hidden border border-slate-800 relative group-hover:scale-105 transition duration-300">
                                    <img src="{{ $g['image'] }}" alt="{{ $g['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="w-full mt-2">
                                    <p class="text-xs font-bold text-white truncate">{{ $g['name'] }}</p>
                                    <span class="inline-block text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-2 border border-slate-800 px-3 py-1 rounded-md group-hover:bg-blue-600 group-hover:text-white transition">Top Up</span>
                                </div>
                            </a>
                        @empty
                            <!-- Placeholder untuk Games -->
                            <div class="group rounded-2xl border border-slate-900 bg-slate-900/30 p-3 text-center hover:border-blue-500/40 transition flex flex-col items-center justify-between min-h-[180px]">
                                <div class="w-full h-24 rounded-xl overflow-hidden bg-slate-950 border border-slate-800">
                                    <img src="https://via.placeholder.com/150?text=Genshin" alt="Genshin Impact" class="w-full h-full object-cover">
                                </div>
                                <div class="w-full mt-2">
                                    <p class="text-xs font-bold text-white truncate">Genshin Impact</p>
                                    <a href="#" class="mt-2 block w-full py-1 bg-blue-600 hover:bg-blue-500 text-[10px] font-bold text-white rounded-md transition">TOP UP</a>
                                </div>
                            </div>
                            <div class="group rounded-2xl border border-slate-900 bg-slate-900/30 p-3 text-center hover:border-blue-500/40 transition flex flex-col items-center justify-between min-h-[180px]">
                                <div class="w-full h-24 rounded-xl overflow-hidden bg-slate-950 border border-slate-800">
                                    <img src="https://via.placeholder.com/150?text=MLBB" alt="Mobile Legends" class="w-full h-full object-cover">
                                </div>
                                <div class="w-full mt-2">
                                    <p class="text-xs font-bold text-white truncate">Mobile Legends</p>
                                    <a href="#" class="mt-2 block w-full py-1 bg-blue-600 hover:bg-blue-500 text-[10px] font-bold text-white rounded-md transition">TOP UP</a>
                                </div>
                            </div>
                            <div class="group rounded-2xl border border-slate-900 bg-slate-900/30 p-3 text-center hover:border-blue-500/40 transition flex flex-col items-center justify-between min-h-[180px]">
                                <div class="w-full h-24 rounded-xl overflow-hidden bg-slate-950 border border-slate-800">
                                    <img src="https://via.placeholder.com/150?text=Valorant" alt="Valorant" class="w-full h-full object-cover">
                                </div>
                                <div class="w-full mt-2">
                                    <p class="text-xs font-bold text-white truncate">Valorant</p>
                                    <a href="#" class="mt-2 block w-full py-1 bg-blue-600 hover:bg-blue-500 text-[10px] font-bold text-white rounded-md transition">TOP UP</a>
                                </div>
                            </div>
                            <div class="group rounded-2xl border border-slate-900 bg-slate-900/30 p-3 text-center hover:border-blue-500/40 transition flex flex-col items-center justify-between min-h-[180px]">
                                <div class="w-full h-24 rounded-xl overflow-hidden bg-slate-950 border border-slate-800">
                                    <img src="https://via.placeholder.com/150?text=PUBGM" alt="PUBG Mobile" class="w-full h-full object-cover">
                                </div>
                                <div class="w-full mt-2">
                                    <p class="text-xs font-bold text-white truncate">PUBG Mobile</p>
                                    <a href="#" class="mt-2 block w-full py-1 bg-blue-600 hover:bg-blue-500 text-[10px] font-bold text-white rounded-md transition">TOP UP</a>
                                </div>
                            </div>
                            <div class="group rounded-2xl border border-slate-900 bg-slate-900/30 p-3 text-center hover:border-blue-500/40 transition flex flex-col items-center justify-between min-h-[180px]">
                                <div class="w-full h-24 rounded-xl overflow-hidden bg-slate-950 border border-slate-800">
                                    <img src="https://via.placeholder.com/150?text=FreeFire" alt="Free Fire" class="w-full h-full object-cover">
                                </div>
                                <div class="w-full mt-2">
                                    <p class="text-xs font-bold text-white truncate">Free Fire</p>
                                    <a href="#" class="mt-2 block w-full py-1 bg-blue-600 hover:bg-blue-500 text-[10px] font-bold text-white rounded-md transition">TOP UP</a>
                                </div>
                            </div>
                            <div class="group rounded-2xl border border-slate-900 bg-slate-900/30 p-3 text-center hover:border-blue-500/40 transition flex flex-col items-center justify-between min-h-[180px]">
                                <div class="w-full h-24 rounded-xl overflow-hidden bg-slate-950 border border-slate-800">
                                    <img src="https://via.placeholder.com/150?text=CODM" alt="Call of Duty" class="w-full h-full object-cover">
                                </div>
                                <div class="w-full mt-2">
                                    <p class="text-xs font-bold text-white truncate">Call of Duty</p>
                                    <a href="#" class="mt-2 block w-full py-1 bg-blue-600 hover:bg-blue-500 text-[10px] font-bold text-white rounded-md transition">TOP UP</a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- SECTION 3: FEATURED PRODUCTS -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold tracking-wide uppercase font-quasar-title text-slate-300">Featured Products</h3>
                            <p class="text-[10px] text-slate-500 font-medium">GEMS & CURRENCY</p>
                        </div>
                        <a href="#" class="text-xs text-blue-400 hover:underline">View All</a>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="rounded-2xl border border-slate-900 bg-slate-900/20 p-4 flex flex-col items-center text-center space-y-3 hover:border-blue-500/20 transition">
                            <div class="text-3xl">💎</div>
                            <div>
                                <h4 class="text-xs font-bold text-white truncate max-w-[130px]">Genshin Crystals</h4>
                                <p class="text-[10px] text-slate-500 mt-0.5">960 Crystals</p>
                                <p class="text-xs font-extrabold text-blue-400 mt-1">Rp 149.000</p>
                            </div>
                            <button class="w-full py-1.5 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold rounded-xl transition">SELECT</button>
                        </div>
                        <!-- ... (Produk lainnya bisa dicopy dari kode sebelumnya) ... -->
                    </div>
                </div>

            </div>

            <!-- KOLOM KANAN (1 KOLOM): SIDEBAR FEED & FLASH SALE -->
            <div class="space-y-6">
                
                <!-- LIVE TOP-UP FEED -->
                <div class="rounded-2xl border border-slate-900 bg-slate-900/30 p-4 space-y-3">
                    <h3 class="text-xs font-bold tracking-wider text-slate-300 font-quasar-title">Live Top-Up Feed</h3>
                    <div class="bg-slate-950/80 rounded-xl p-3 border border-slate-900 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-900 flex-shrink-0 border border-slate-800">
                            <img src="https://via.placeholder.com/50?text=Live" alt="Feed" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[11px] font-bold text-white truncate">Genshin Pack: 300+30</p>
                            <span class="inline-block px-2 py-0.5 bg-blue-600/20 text-blue-400 text-[9px] font-bold rounded mt-1 border border-blue-500/30">TOP-UP</span>
                        </div>
                    </div>
                </div>

                <!-- FLASH SALE -->
                <div class="rounded-2xl border border-slate-900 bg-slate-900/30 p-4 space-y-3">
                    <h3 class="text-xs font-bold tracking-wider text-slate-300 font-quasar-title">Flash Sale</h3>
                    <div class="bg-slate-950/80 rounded-xl p-3 border border-slate-900 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-900 flex-shrink-0 border border-slate-800">
                                <img src="https://via.placeholder.com/50?text=Sale" alt="Sale" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-white truncate">Genshin Pack</p>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs font-extrabold text-pink-500">Rp 62.000</span>
                                    <span class="text-[10px] text-slate-500 line-through">Rp 65.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] text-slate-400 font-medium">08:45 min left</span>
                    </div>
                </div>

            </div>

        </main>
    </div> <!-- END WRAPPER KONTEN -->

    <!-- SCRIPT EFEK PARTIKEL BINTANG -->
    <script>
        const canvas = document.getElementById('starParticles');
        const ctx = canvas.getContext('2d');
        
        // Atur ukuran canvas sebesar layar
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        let particlesArray = [];
        const numberOfParticles = 150; // Jumlah bintang, bisa ditambah/dikurangi

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 1.5 + 0.5; // Ukuran bintang acak
                this.speedX = Math.random() * 0.4 - 0.2; // Kecepatan gerak X
                this.speedY = Math.random() * 0.4 - 0.2; // Kecepatan gerak Y
                this.opacity = Math.random(); // Opasitas awal
                this.fadeDirection = Math.random() < 0.5 ? 1 : -1; // Arah pudar (terang/gelap)
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;

                // Efek kelap-kelip (twinkling)
                this.opacity += 0.01 * this.fadeDirection;
                if(this.opacity >= 1 || this.opacity <= 0.1) {
                    this.fadeDirection *= -1;
                }

                // Jika bintang keluar layar, munculkan dari sisi berlawanan
                if (this.x < 0) this.x = canvas.width;
                if (this.x > canvas.width) this.x = 0;
                if (this.y < 0) this.y = canvas.height;
                if (this.y > canvas.height) this.y = 0;
            }
            draw() {
                ctx.fillStyle = `rgba(147, 197, 253, ${this.opacity})`; // Warna biru muda khas tata surya/nebula
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function init() {
            particlesArray = [];
            for (let i = 0; i < numberOfParticles; i++) {
                particlesArray.push(new Particle());
            }
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (let i = 0; i < particlesArray.length; i++) {
                particlesArray[i].update();
                particlesArray[i].draw();
            }
            requestAnimationFrame(animate);
        }

        init();
        animate();

        // Sesuaikan ukuran partikel jika layar di-resize (responsif)
        window.addEventListener('resize', function() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            init();
        });
    </script>
</body>
</html>