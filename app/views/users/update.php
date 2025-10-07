<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      background: linear-gradient(135deg, #0f172a, #1e3a8a, #1e40af);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Inter', sans-serif;
      color: #e2e8f0;
      animation: fadeIn 1s ease;
    }
    .form-card {
      background: rgba(15, 23, 42, 0.9);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
      animation: fadeInUp 0.8s ease;
      color: #e2e8f0;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    input, select {
      background-color: #0f172a;
      border: 1px solid #334155;
      color: #e2e8f0;
    }
    input::placeholder {
      color: #94a3b8;
    }
    select option {
      background-color: #0f172a;
      color: #e2e8f0;
    }
    button {
      transition: all 0.3s ease;
    }
    button:hover {
      transform: scale(1.02);
    }

    /* Eye icon styling */
    .toggle-eye {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #60a5fa;
      font-size: 1.1rem;
      transition: color 0.3s ease;
    }
    .toggle-eye:hover {
      color: #93c5fd;
    }
  </style>
</head>

<body>

  <div class="form-card p-8 rounded-2xl w-full max-w-md">
    <h2 class="text-2xl font-semibold text-center text-blue-400 mb-6">Update User</h2>

    <form action="<?=site_url('users/update/'.$user['id'])?>" method="POST" class="space-y-4">
      
      <!-- Username -->
      <div>
        <input type="text" name="username" value="<?= html_escape($user['username'])?>" required
               placeholder="Username"
               class="w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
      </div>

      <!-- Email -->
      <div>
        <input type="email" name="email" value="<?= html_escape($user['email'])?>" required
               placeholder="Email Address"
               class="w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
      </div>

      <?php if(!empty($logged_in_user) && $logged_in_user['role'] === 'admin'): ?>
        <!-- Role Dropdown for Admins -->
        <div>
          <select name="role" required
                  class="w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <option value="user" <?= $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
          </select>
        </div>

        <!-- Password Field for Admins -->
        <div class="relative">
          <input type="password" name="password" id="password"
                 placeholder="Leave blank to keep current password"
                 class="w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
          <i class="fa-solid fa-eye toggle-eye" id="togglePassword"></i>
        </div>
      <?php endif; ?>

      <!-- Submit Button -->
      <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-xl shadow-md transition duration-200">
        Update User
      </button>
    </form>

    <!-- Return Button -->
    <a href="<?=site_url('/users');?>" class="mt-4 block text-center bg-slate-800 hover:bg-slate-700 text-blue-400 py-2 rounded-xl shadow border border-slate-700">
      Return to Home
    </a>
  </div>

  <!-- Password Toggle Script -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const togglePassword = document.getElementById('togglePassword');
      const password = document.getElementById('password');

      if (togglePassword && password) {
        togglePassword.addEventListener('click', function() {
          const type = password.type === 'password' ? 'text' : 'password';
          password.type = type;
          togglePassword.classList.toggle('fa-eye');
          togglePassword.classList.toggle('fa-eye-slash');
        });
      }
    });
  </script>

</body>
</html>
