<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - QuasarTopUp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-950 antialiased relative overflow-hidden">

    <!-- Efek Pendaran Nebula Ruang Angkasa -->
    <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[120px] pointer-events-none z-0"></div>
    <div class="absolute top-[30%] right-[-10%] w-[600px] h-[600px] bg-purple-600/20 rounded-full blur-[150px] pointer-events-none z-0"></div>

    <!-- CANVAS EFEK PARTIKEL BINTANG -->
    <canvas id="starParticles" class="fixed inset-0 z-0 pointer-events-none opacity-80"></canvas>

    <!-- WRAPPER KONTEN (z-10 agar berada di atas bintang) -->
    <div class="min-h-screen flex items-center justify-center p-4 sm:p-8 relative z-10">
        
        <!-- Main Card Container (Dibuat sedikit transparan dengan backdrop-blur) -->
        <div class="flex w-full max-w-6xl bg-[#141519]/90 backdrop-blur-xl rounded-[2rem] overflow-hidden shadow-2xl border border-white/10">
            
            <!-- Sisi Kiri: Form Section -->
            <div class="w-full lg:w-[55%] p-8 sm:p-12 lg:p-16 flex flex-col justify-between relative z-10">
                
                <!-- Navbar Kecil di dalam Card -->
                <div class="flex items-center justify-between mb-12">
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 rounded-full bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,0.6)]"></div>
                        <span class="text-white font-bold text-sm tracking-wide font-space-title">QuasarTopUp</span>
                    </div>
                    <div class="hidden sm:flex gap-8 text-xs text-slate-400 font-medium">
                        <a href="{{ route('dashboard') }}" class="hover:text-white transition">Home</a>
                        <a href="{{ route('login') }}" class="hover:text-white transition">Log in</a>
                    </div>
                </div>

                <!-- Header Text -->
                <div class="mb-10">
                    <p class="text-slate-400 text-[10px] font-bold tracking-widest uppercase mb-4">START FOR FREE</p>
                    <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4 tracking-tight">
                        Create new account<span class="text-blue-500">.</span>
                    </h1>
                    <p class="text-slate-400 text-sm font-medium">
                        Already A Member? <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-400 transition">Log in</a>
                    </p>
                </div>

                <!-- Form Pendaftaran -->
                <form method="POST" action="{{ route('register') }}" class="mt-2">
                    @csrf
                    
                    <div class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <!-- Full Name -->
                            <div class="relative group">
                                <label class="block text-[10px] uppercase tracking-wider text-slate-500 font-bold mb-2 ml-1">Full Name</label>
                                <input type="text" name="name" class="w-full bg-[#1b1c21]/80 border border-white/5 rounded-xl px-4 py-3.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" placeholder="Michal Masiak" required autofocus>
                                <div class="absolute right-4 top-[38px] text-slate-600 group-focus-within:text-blue-500 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                </div>
                                @if($errors->has('name'))
                                    <p class="mt-1 text-xs text-rose-500">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <!-- Email Address -->
                            <div class="relative group">
                                <label class="block text-[10px] uppercase tracking-wider text-slate-500 font-bold mb-2 ml-1">Email Address</label>
                                <input type="email" name="email" class="w-full bg-[#1b1c21]/80 border border-white/5 rounded-xl px-4 py-3.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" placeholder="name@quasar.com" required>
                                <div class="absolute right-4 top-[38px] text-slate-600 group-focus-within:text-blue-500 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                @if($errors->has('email'))
                                    <p class="mt-1 text-xs text-rose-500">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Password Box -->
                        <div class="relative group">
                            <label class="block text-[10px] uppercase tracking-wider text-slate-500 font-bold mb-2 ml-1">Password</label>
                            <input type="password" name="password" class="w-full bg-[#1b1c21]/80 border border-blue-500/40 rounded-xl px-4 py-3.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors shadow-[0_0_15px_rgba(59,130,246,0.1)]" placeholder="••••••••" required>
                            <div class="absolute right-4 top-[38px] text-blue-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                            @if($errors->has('password'))
                                <p class="mt-1 text-xs text-rose-500">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <!-- Confirm Password -->
                        <div class="relative group">
                            <label class="block text-[10px] uppercase tracking-wider text-slate-500 font-bold mb-2 ml-1">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="w-full bg-[#1b1c21]/80 border border-white/5 rounded-xl px-4 py-3.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" placeholder="••••••••" required>
                        </div>
                    </div>

                    <!-- Tombol Buat Akun Biasa -->
                    <button type="submit" class="w-full mt-8 px-8 py-3.5 rounded-xl bg-blue-500 hover:bg-blue-600 text-sm font-bold text-white transition-colors shadow-lg shadow-blue-500/20 text-center">
                        Create account
                    </button>
                </form>

                <!-- Separator untuk Social Login -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/5"></div>
                    </div>
                    <div class="relative flex justify-center text-[9px] uppercase font-bold tracking-widest">
                        <span class="px-4 bg-transparent text-slate-500 backdrop-blur-md">Or register with</span>
                    </div>
                </div>

                <!-- Tombol Social Login (Google & FB) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Google -->
                    <a href="{{ route('social.login', 'google') }}" class="flex items-center justify-center gap-3 px-4 py-3 rounded-xl bg-[#1b1c21]/80 border border-white/5 hover:bg-[#25272e] hover:border-white/10 transition-all group">
                        <svg class="w-4 h-4" viewBox="0 0 24 24">
                            <path fill="#EA4335" d="M12 5.04c1.66 0 3.2.57 4.38 1.69l3.27-3.27C17.68 1.54 14.98 1 12 1 7.35 1 3.37 3.65 1.41 7.51l3.79 2.94C6.15 7.4 8.87 5.04 12 5.04z"/>
                            <path fill="#4285F4" d="M23.49 12.27c0-.81-.07-1.59-.2-2.36H12v4.51h6.43c-.28 1.44-1.09 2.67-2.32 3.51l3.6 2.79c2.1-1.94 3.31-4.79 3.31-8.45z"/>
                            <path fill="#FBBC05" d="M5.2 14.51c-.24-.72-.38-1.49-.38-2.29s.14-1.57.38-2.29L1.41 6.99C.51 8.79 0 10.82 0 13s.51 4.21 1.41 6.01l3.79-2.5z"/>
                            <path fill="#34A853" d="M12 23c3.24 0 5.97-1.07 7.96-2.92l-3.6-2.79c-1 .67-2.28 1.07-3.6 1.07-3.13 0-5.85-2.36-6.8-5.41L1.41 15.9C3.37 19.76 7.35 22.31 12 23z"/>
                        </svg>
                        <span class="text-xs font-bold text-slate-300 group-hover:text-white transition">Google</span>
                    </a>

                    <!-- Facebook -->
                    <a href="{{ route('social.login', 'facebook') }}" class="flex items-center justify-center gap-3 px-4 py-3 rounded-xl bg-[#1b1c21]/80 border border-white/5 hover:bg-[#25272e] hover:border-white/10 transition-all group">
                        <svg class="w-4 h-4" fill="#1877F2" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span class="text-xs font-bold text-slate-300 group-hover:text-white transition">Facebook</span>
                    </a>
                </div>
            </div>

            <!-- Sisi Kanan: Gambar Estetik -->
            <div class="hidden lg:block w-[45%] relative bg-slate-900 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1614730321146-b6fa6a46bcb4?q=80&w=1000&auto=format&fit=crop" alt="Universe" class="w-full h-full object-cover object-center grayscale-[20%]">
                
                <div class="absolute inset-0 bg-gradient-to-r from-[#141519] via-[#141519]/80 to-transparent w-32"></div>
                <div class="absolute inset-0 bg-[#141519]/40 mix-blend-multiply"></div>
                
                <div class="absolute bottom-12 right-12 select-none">
                    <span class="text-white/10 font-black text-6xl font-space-title tracking-tighter">.QTU</span>
                </div>
            </div>

        </div>
    </div>

    <!-- SCRIPT EFEK PARTIKEL BINTANG -->
    <script>
        const canvas = document.getElementById('starParticles');
        const ctx = canvas.getContext('2d');
        
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        let particlesArray = [];
        const numberOfParticles = 150; 

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 1.5 + 0.5; 
                this.speedX = Math.random() * 0.4 - 0.2; 
                this.speedY = Math.random() * 0.4 - 0.2; 
                this.opacity = Math.random(); 
                this.fadeDirection = Math.random() < 0.5 ? 1 : -1; 
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;

                this.opacity += 0.01 * this.fadeDirection;
                if(this.opacity >= 1 || this.opacity <= 0.1) {
                    this.fadeDirection *= -1;
                }

                if (this.x < 0) this.x = canvas.width;
                if (this.x > canvas.width) this.x = 0;
                if (this.y < 0) this.y = canvas.height;
                if (this.y > canvas.height) this.y = 0;
            }
            draw() {
                ctx.fillStyle = `rgba(147, 197, 253, ${this.opacity})`;
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

        window.addEventListener('resize', function() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            init();
        });
    </script>
</body>
</html>