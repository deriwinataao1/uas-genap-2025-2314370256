<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Akses Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center px-4">
    <div id="toast" class="fixed top-5 right-5 z-50 hidden px-4 py-3 rounded-xl shadow-lg text-white transition-all duration-300"></div>
    
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden max-w-4xl w-full grid md:grid-cols-2">
        <!-- Sidebar (Kiri) -->
        <div class="hidden md:flex flex-col items-center justify-center bg-blue-600 text-white p-10">
            <h2 class="text-3xl font-bold mb-4">Selamat Datang Kembali!</h2>
            <p class="text-sm text-center">Masukkan kredensial Anda untuk mengakses akun Anda dan mulai menjelajahi dashboard.</p>
            <img src="{{ asset('login-app/img/login.png') }}" alt="Login Illustration" class="mt-8">
        </div>

        <!-- Form Login -->
        <div class="p-8 md:p-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Masuk ke Akun Anda</h2>

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded-xl">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <div class="relative mt-1">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="contoh@gmail.com" class="w-full pl-10 pr-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i data-feather="mail"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-600">Kata Sandi</label>
                    <div class="relative mt-1">
                        <input type="password" id="password" name="password" required placeholder="********" class="w-full pl-10 pr-10 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i data-feather="lock"></i>
                        </div>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 cursor-pointer" onclick="togglePassword()">
                            <i id="eyeIcon" data-feather="eye"></i>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300" />
                        Ingat Saya
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Lupa Kata Sandi?</a>
                    @endif
                </div>

                <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all">
                    Masuk
                </button>

                <p class="text-center text-sm text-gray-500">Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar Sekarang</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        feather.replace();

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('data-feather', 'eye-off');
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('data-feather', 'eye');
            }
            feather.replace();
        }

        function showToast(pesan, warna = 'green') {
            const toast = document.getElementById('toast');
            toast.textContent = pesan;
            toast.className = `fixed top-5 right-5 z-50 px-4 py-3 rounded-xl shadow-lg text-white bg-${warna}-500 opacity-0`;

            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('opacity-100'), 10);

            setTimeout(() => {
                toast.classList.remove('opacity-100');
                setTimeout(() => toast.classList.add('hidden'), 300);
            }, 3000);
        }

        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('sukses')) {
            const pesan = {
                'login_berhasil': 'Login berhasil! Selamat datang kembali.'
            }[urlParams.get('sukses')] || 'Berhasil!';
            showToast(pesan, 'green');
        } else if (urlParams.has('error')) {
            const pesan = {
                'password_salah': 'Password salah!',
                'akun_tidak_ditemukan': 'Akun tidak ditemukan!',
            }[urlParams.get('error')] || 'Terjadi kesalahan.';
            showToast(pesan, 'red');
        }
    </script>
</body>

</html>
