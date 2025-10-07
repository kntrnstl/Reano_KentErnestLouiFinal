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

    /* Eye icon */
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
    <h1 class="text-2xl font-semibold text-center text-blue-400 mb-6">Create User</h1>

    <form id="user-form" action="<?=site_url('users/create/')?>" method="POST" class="space-y-4">

      <!-- Username -->
      <div>
        <input type="text" name="username" placeholder="Username" required
               value="<?= isset($username) ? html_escape($username) : '' ?>"
               class="w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
      </div>

      <!-- Email -->
      <div>
        <input type="email" name="email" placeholder="Email" required
               value="<?= isset($email) ? html_escape($email) : '' ?>"
               class="w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
      </div>

      <!-- Password with toggle -->
      <div class="relative">
        <input type="password" name="password" id="password" placeholder="Password" required
               class="w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
        <i class="fa-solid fa-eye toggle-eye" id="togglePassword"></i>
      </div>

      <!-- Role -->
      <?php if($logged_in_user['role'] === 'admin'): ?>
        <div>
          <select name="role" required
                  class="w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
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
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-xl shadow-md">
        Create User
      </button>
    </form>

    <!-- Return Button -->
    <a href="<?=site_url('/users');?>" class="mt-4 block text-center bg-slate-800 hover:bg-slate-700 text-blue-400 py-2 rounded-xl shadow border border-slate-700">
      Return to Home
    </a>
  </div>

  <!-- Password Toggle Script -->
  <script>
    const togglePassword = document.getElementById("togglePassword");
    const passwordField = document.getElementById("password");

    togglePassword.addEventListener("click", () => {
      const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
      passwordField.setAttribute("type", type);
      togglePassword.classList.toggle("fa-eye");
      togglePassword.classList.toggle("fa-eye-slash");
    });
  </script>

</body>
</html>
