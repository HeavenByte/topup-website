<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - QuasarTopUp</title>
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
        
        <!-- Main Card Container -->
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
                        <a href="{{ route('login') }}" class="hover:text-white transition">Back to Login</a>
                    </div>
                </div>

                <!-- Header Text -->
                <div class="mb-10">
                    <p class="text-slate-400 text-[10px] font-bold tracking-widest uppercase mb-4">ACCOUNT RECOVERY</p>
                    <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4 tracking-tight">
                        Forgot password<span class="text-blue-500">?</span>
                    </h1>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">
                        No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                    </p>
                </div>

                <!-- Session Status / Flash Message (Penting untuk notifikasi sukses pengiriman email) -->
                <x-auth-session-status class="mb-4 text-green-400 text-sm font-bold" :status="session('status')" />

                <!-- Form Pengisian Email -->
                <form method="POST" action="{{ route('password.email') }}" class="mt-2 space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div class="relative group">
                        <label class="block text-[10px] uppercase tracking-wider text-slate-500 font-bold mb-2 ml-1">Email Address</label>
                        <input type="email" name="email" :value="old('email')" class="w-full bg-[#1b1c21]/80 border border-white/5 rounded-xl px-4 py-3.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" placeholder="name@quasar.com" required autofocus>
                        <div class="absolute right-4 top-[38px] text-slate-600 group-focus-within:text-blue-500 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        @if($errors->has('email'))
                            <p class="mt-1 text-xs text-rose-500">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" class="w-full mt-8 px-8 py-3.5 rounded-xl bg-blue-500 hover:bg-blue-600 text-sm font-bold text-white transition-colors shadow-lg shadow-blue-500/20 text-center">
                        Email Password Reset Link
                    </button>
                </form>

                <!-- Spacer untuk menyeimbangkan layout -->
                <div class="mt-10"></div>
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