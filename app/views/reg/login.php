<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-600 to-cyan-400 min-h-screen flex items-center justify-center font-sans">

  <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md animate-fadeIn">
    <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Login</h2>

    <?php if (!empty($error)): ?>
      <div class="bg-red-100 text-red-600 border border-red-300 rounded-xl p-3 text-center mb-4">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('reg/login') ?>" class="space-y-4">
      <!-- Username -->
      <div>
        <input type="text" name="username" placeholder="Username" required
               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
      </div>

      <!-- Password with toggle -->
      <div class="relative">
        <input type="password" name="password" id="password" placeholder="Password" required
               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
        <i class="fa-solid fa-eye absolute right-4 top-1/2 -translate-y-1/2 cursor-pointer text-blue-600" id="togglePassword"></i>
      </div>

      <!-- Login Button -->
      <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-xl shadow-md transition duration-200">
        Login
      </button>
    </form>

    <div class="text-center mt-4">
      <p class="text-gray-600 text-sm">
        Don’t have an account?
        <a href="<?= site_url('reg/register'); ?>" class="text-blue-600 hover:underline font-medium">Register here</a>
      </p>
    </div>
  </div>

  <!-- Fade-in animation -->
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
      animation: fadeIn 0.8s ease;
    }
  </style>

  <!-- Password Toggle Script -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const togglePassword = document.getElementById('togglePassword');
      const password = document.getElementById('password');

      togglePassword.addEventListener('click', function () {
        const type = password.type === 'password' ? 'text' : 'password';
        password.type = type;
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });
    });
  </script>
</body>
</html>
