<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Buat Akun</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen flex items-center justify-center px-4">
  <div id="toast" class="fixed top-5 right-5 z-50 hidden px-4 py-3 rounded-xl shadow-lg text-white transition-all duration-300"></div>
  
  <div class="bg-white shadow-2xl rounded-2xl overflow-hidden max-w-4xl w-full grid md:grid-cols-2">
    <div class="hidden md:flex flex-col items-center justify-center bg-green-600 text-white p-10">
      <h2 class="text-3xl font-bold mb-4">Daftar Sekarang</h2>
      <p class="text-sm text-center">Buat akun baru Anda dan mulai menjelajahi semua fitur hebat kami.</p>
      <img src="{{ asset('login-app/img/register.png') }}" alt="Register Illustration" class="mt-8">
    </div>

    <!-- Register Form -->
    <div class="p-8 md:p-12">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Buat Akun Baru</h2>
      <form id="registerForm" onsubmit="return validateForm()" action="{{ route('register') }}" method="POST" class="space-y-5">
        @csrf
        <div>
          <label for="name" class="block text-sm font-medium text-gray-600">Nama Lengkap</label>
          <div class="relative mt-1">
            <input type="text" id="name" name="name" required placeholder="Nama lengkap Anda" class="w-full pl-10 pr-4 py-2 border rounded-xl focus:ring-2 focus:ring-green-500 focus:outline-none" />
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
              <i data-feather="user"></i>
            </div>
          </div>
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
          <div class="relative mt-1">
            <input type="email" id="email" name="email" required placeholder="contoh@gmail.com" class="w-full pl-10 pr-4 py-2 border rounded-xl focus:ring-2 focus:ring-green-500 focus:outline-none" />
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
              <i data-feather="mail"></i>
            </div>
          </div>
          <small id="email-error" class="text-red-500 text-sm hidden">Email sudah terdaftar</small>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-600">Kata Sandi</label>
          <div class="relative mt-1">
            <input type="password" id="password" name="password" required placeholder="********" class="w-full pl-10 pr-10 py-2 border rounded-xl focus:ring-2 focus:ring-green-500 focus:outline-none" />
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
              <i data-feather="lock"></i>
            </div>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 cursor-pointer" onclick="togglePassword('password', 'eyeIcon1')">
              <i id="eyeIcon1" data-feather="eye"></i>
            </div>
          </div>
        </div>

        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Konfirmasi Kata Sandi</label>
          <div class="relative mt-1">
            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="********" class="w-full pl-10 pr-10 py-2 border rounded-xl focus:ring-2 focus:ring-green-500 focus:outline-none" />
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
              <i data-feather="lock"></i>
            </div>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 cursor-pointer" onclick="togglePassword('password_confirmation', 'eyeIcon2')">
              <i id="eyeIcon2" data-feather="eye"></i>
            </div>
          </div>
        </div>

        <div class="flex items-start">
          <input type="checkbox" id="terms" required class="mt-1 mr-2 rounded border-gray-300" />
          <label for="terms" class="text-sm text-gray-600">Saya setuju dengan <a href="#" class="text-green-600 hover:underline">Syarat & Ketentuan</a></label>
        </div>

        <button type="submit" class="w-full py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all">Daftar</button>

        <p class="text-center text-sm text-gray-500">Sudah punya akun?
          <a href="{{ route('login') }}" class="text-green-600 hover:underline">Masuk di sini</a>
        </p>
      </form>
    </div>
  </div>

  <script>
    feather.replace();

    function togglePassword(fieldId, iconId) {
      const input = document.getElementById(fieldId);
      const icon = document.getElementById(iconId);
      if (input.type === 'password') {
        input.type = 'text';
        icon.setAttribute('data-feather', 'eye-off');
      } else {
        input.type = 'password';
        icon.setAttribute('data-feather', 'eye');
      }
      feather.replace();
    }

    function validateForm() {
      const password = document.getElementById("password").value;
      const confirm = document.getElementById("password_confirmation").value;
      if (password !== confirm) {
        showToast("Kata sandi tidak cocok!", "red");
        return false;
      }
      return true;
    }

    function showToast(message, color = 'green') {
      const toast = document.getElementById('toast');
      toast.textContent = message;
      toast.className = `fixed top-5 right-5 z-50 px-4 py-3 rounded-xl shadow-lg text-white bg-${color}-500 opacity-0 transition-all`;
      toast.classList.remove('hidden');
      setTimeout(() => toast.classList.add('opacity-100'), 10);
      setTimeout(() => {
        toast.classList.remove('opacity-100');
        setTimeout(() => toast.classList.add('hidden'), 300);
      }, 3000);
    }

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('sukses')) {
      const pesan = urlParams.get('sukses') === 'daftar_berhasil' ? 'Pendaftaran berhasil! Silakan login.' : 'Berhasil!';
      showToast(pesan, 'green');
    } else if (urlParams.has('error')) {
      const pesan = {
        'email_terdaftar': 'Email sudah terdaftar!',
        'gagal_mendaftar': 'Terjadi kesalahan saat mendaftar.',
        'login_gagal': 'Email atau password salah!'
      }[urlParams.get('error')] || 'Terjadi kesalahan.';
      showToast(pesan, 'red');
    }
  </script>
</body>
</html>
