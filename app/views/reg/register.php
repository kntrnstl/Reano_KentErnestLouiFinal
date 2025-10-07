<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-[#0f172a] via-[#1e3a8a] to-[#1e40af] min-h-screen flex items-center justify-center font-sans text-gray-200">

  <div class="bg-slate-900/90 p-8 rounded-2xl shadow-2xl w-full max-w-md animate-fadeIn border border-slate-700">
    <h2 class="text-2xl font-semibold text-center text-blue-400 mb-6">Register</h2>

    <form method="POST" action="<?= site_url('reg/register'); ?>" class="space-y-4">
      
      <!-- Username -->
      <div>
        <input type="text" name="username" placeholder="Username" required
               class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl 
                      focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-200 placeholder-gray-400">
      </div>

      <!-- Email -->
      <div>
        <input type="email" name="email" placeholder="Email" required
               class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl 
                      focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-200 placeholder-gray-400">
      </div>

      <!-- Password -->
      <div class="relative">
        <input type="password" id="password" name="password" placeholder="Password" required
               class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl 
                      focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-200 placeholder-gray-400">
        <i class="fa-solid fa-eye absolute right-4 top-1/2 -translate-y-1/2 
                  cursor-pointer text-blue-400" id="togglePassword"></i>
      </div>

      <!-- Confirm Password -->
      <div class="relative">
        <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" required
               class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl 
                      focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-200 placeholder-gray-400">
        <i class="fa-solid fa-eye absolute right-4 top-1/2 -translate-y-1/2 
                  cursor-pointer text-blue-400" id="toggleConfirmPassword"></i>
      </div>

      <!-- Hidden role input -->
      <input type="hidden" name="role" value="user">

      <!-- Submit Button -->
      <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 
                     rounded-xl shadow-md transition duration-200">
        Register
      </button>
    </form>

    <div class="text-center mt-4">
      <p class="text-gray-400 text-sm">
        Already have an account?
        <a href="<?= site_url('reg/login'); ?>" class="text-blue-400 hover:underline font-medium">
          Login here
        </a>
      </p>
    </div>
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

  <script>
    function toggleVisibility(toggleId, inputId) {
      const toggle = document.getElementById(toggleId);
      const input = document.getElementById(inputId);

      toggle.addEventListener('click', function () {
        const type = input.type === 'password' ? 'text' : 'password';
        input.type = type;
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });
    }

    document.addEventListener("DOMContentLoaded", () => {
      toggleVisibility('togglePassword', 'password');
      toggleVisibility('toggleConfirmPassword', 'confirmPassword');
    });
  </script>
</body>
</html>
