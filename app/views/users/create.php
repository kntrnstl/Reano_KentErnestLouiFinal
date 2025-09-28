<?php
// Ensure $logged_in_user is defined to avoid undefined variable error
if (!isset($logged_in_user)) {
    $logged_in_user = ['role' => 'user']; // default to normal user if not set
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create User</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-600 to-cyan-400 min-h-screen flex items-center justify-center font-sans">

  <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md animate-fadeIn">
    <h1 class="text-2xl font-semibold text-center text-blue-600 mb-6">Create User</h1>

    <form id="user-form" action="<?=site_url('users/create/')?>" method="POST" class="space-y-4">

      <!-- Username -->
      <div>
        <input type="text" name="username" placeholder="Username" required
               value="<?= isset($username) ? html_escape($username) : '' ?>"
               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
      </div>

      <!-- Email -->
      <div>
        <input type="email" name="email" placeholder="Email" required
               value="<?= isset($email) ? html_escape($email) : '' ?>"
               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
      </div>

      <!-- Password with toggle -->
      <div class="relative">
        <input type="password" name="password" id="password" placeholder="Password" required
               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
        <button type="button" id="togglePassword"
                class="absolute right-4 top-1/2 -translate-y-1/2 text-blue-600 focus:outline-none">
          <i class="fa-solid fa-eye"></i>
        </button>
      </div>

      <!-- Role -->
      <?php if($logged_in_user['role'] === 'admin'): ?>
        <div>
          <select name="role" required
                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
            <option value="" disabled selected>Select Role</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
        </div>
      <?php else: ?>
        <input type="hidden" name="role" value="user">
      <?php endif; ?>

      <!-- Submit -->
      <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-xl shadow-md transition duration-200">
        Create User
      </button>
    </form>

    <!-- Return Button -->
     <a href="<?=site_url('/users');?>" class="mt-4 block text-center bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 rounded-xl shadow transition">
      Return to Home
    </a>
  </div>

  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
      animation: fadeIn 0.8s ease;
    }
  </style>

  <!-- FontAwesome for password icon -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>

  <!-- Password Toggle -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const togglePassword = document.getElementById('togglePassword');
      const password = document.getElementById('password');

      if (togglePassword && password) {
        togglePassword.addEventListener('click', function () {
          const type = password.type === 'password' ? 'text' : 'password';
          password.type = type;

          const icon = this.querySelector("i");
          icon.classList.toggle("fa-eye");
          icon.classList.toggle("fa-eye-slash");
        });
      }
    });
  </script>

</body>
</html>
