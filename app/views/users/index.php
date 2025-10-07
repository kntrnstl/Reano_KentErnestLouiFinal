<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Directory</title>
  <link rel="stylesheet" href="<?=base_url();?>/public/style.css">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    /* Rotating dark blue gradient background */
    body {
      background: linear-gradient(-45deg, #03091e, #00124b, #001a70, #0a0f24);
      background-size: 300% 300%;
      animation: rotateGradient 10s ease infinite;
      color: #e5e7eb;
      min-height: 100vh;
      font-family: 'Inter', sans-serif;
    }

    @keyframes rotateGradient {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Pagination */
    .pagination {
      display: flex;
      gap: 0.6rem;
      flex-wrap: wrap;
      justify-content: center;
    }

    .pagination a {
      display: inline-block;
      padding: 0.5rem 1.1rem;
      background: #1e293b;
      border: 1px solid #334155;
      color: #e5e7eb;
      border-radius: 9999px;
      font-weight: 500;
      text-decoration: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      transition: all 0.25s ease-in-out;
    }

    .pagination a:hover {
      background: #2563eb;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
    }

    .pagination strong {
      display: inline-block;
      padding: 0.5rem 1.1rem;
      background: linear-gradient(to right, #2563eb, #1e40af);
      color: white;
      border-radius: 9999px;
      font-weight: 600;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.4);
    }

    /* Fade-in animation */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
      animation: fadeIn 0.8s ease;
    }
  </style>
</head>

<body class="text-gray-100 min-h-screen">

  <!-- Navbar -->
  <nav class="bg-gradient-to-r from-blue-950 to-blue-700 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <a href="#" class="text-white font-bold text-xl tracking-wide">
        Account Management Portal
      </a>
      <a href="<?=site_url('reg/logout');?>" 
         class="bg-blue-950 text-blue-100 font-semibold px-4 py-2 rounded-lg shadow hover:bg-white/20 transition">
         Logout
      </a>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="max-w-6xl mx-auto mt-10 px-4">

    <div class="bg-slate-900/90 backdrop-blur-xl shadow-xl rounded-2xl p-8 border border-slate-800 animate-fadeIn">

      <!-- Logged In User Display -->
      <?php if(!empty($logged_in_user)): ?>
        <div class="mb-8 bg-gradient-to-r from-blue-950 to-blue-800 text-blue-100 px-6 py-5 rounded-xl shadow-md text-center">
          <h2 class="text-2xl mb-1">
            Welcome, <span class="text-white-950 font-bold"><?= html_escape($logged_in_user['username']); ?></span>
          </h2>
          <p class="text-lg">
            Role: 
            <span class="inline-block px-3 py-1 rounded-full font-semibold 
              <?= $logged_in_user['role'] === 'admin' 
                  ? 'bg-gradient-to-r from-indigo-700 via-purple-800 to-purple-900 text-indigo-100 border border-purple-700' 
                  : 'bg-gradient-to-r from-cyan-600 via-blue-700 to-blue-900 text-cyan-100 border border-cyan-700'; ?>">
              <?= html_escape($logged_in_user['role']); ?>
            </span>
          </p>
        </div>
      <?php else: ?>
        <div class="mb-6 bg-red-900/70 text-red-300 px-4 py-3 rounded-lg shadow text-center">
          Logged in user not found
        </div>
      <?php endif; ?>

      <!-- Header -->
      <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
          <a href="<?=site_url('users/create')?>"
           class="inline-block bg-blue-800 hover:bg-blue-900 text-white font-medium px-6 py-3 rounded-full shadow-md transition duration-200 transform hover:scale-105">
          Create New User
        </a>

        <!-- Search Bar -->
        <form method="get" action="<?=site_url('users');?>" class="flex w-full md:w-auto">
          <input 
            type="text" 
            name="q" 
            value="<?=html_escape($_GET['q'] ?? '')?>" 
            placeholder="Search user..." 
            class="w-full border border-slate-700 bg-slate-800 rounded-l-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-100 transition">
          <button 
    type="submit" 
    class="bg-blue-700 hover:bg-blue-800 text-white px-5 rounded-r-xl transition text-lg flex items-center justify-center">
    🔍  </button>

        </form>
      </div>
      
      <!-- Table -->
      <div class="overflow-x-auto rounded-xl border border-slate-700 shadow-sm">
        <table class="w-full text-center border-collapse">
          <thead>
            <tr class="bg-gradient-to-r from-blue-900 to-blue-700 text-white text-sm uppercase tracking-wide">
              <th class="py-3 px-4">ID</th>
              <th class="py-3 px-4">Username</th>
              <th class="py-3 px-4">Email</th>
              <th class="py-3 px-4">Role</th>
              <th class="py-3 px-4">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-700 text-sm">
            <?php foreach(html_escape($users) as $user): ?>
              <tr class="hover:bg-blue-950 transition duration-200">
                <td class="py-3 px-4 font-medium"><?=($user['id']);?></td>
                <td class="py-3 px-4 text-gray-200 font-semibold"><?=($user['username']);?></td>
                <td class="py-3 px-4 text-gray-400 italic"><?=($user['email']);?></td>
                <td class="py-3 px-4">
                  <span class="px-3 py-1 text-sm font-semibold rounded-full border
                    <?= $user['role'] === 'admin' 
                      ? 'bg-gradient-to-r from-indigo-700 via-purple-800 to-purple-900 text-indigo-100 border-purple-700' 
                      : 'bg-gradient-to-r from-cyan-600 via-blue-700 to-blue-900 text-cyan-100 border-cyan-700'; ?>">
                    <?=($user['role']);?>
                  </span>
                </td>
                <td class="py-3 px-4 space-x-3">
                  <?php if($logged_in_user['role'] === 'admin' || $logged_in_user['id'] == $user['id']): ?>
                    <a href="<?=site_url('users/update/'.$user['id']);?>"
                       class="px-3 py-1 text-sm rounded-lg bg-blue-900/70 text-blue-300 hover:bg-blue-700 hover:text-white transition duration-200 shadow-sm">
                      Update
                    </a>
                  <?php endif; ?>

                  <?php if($logged_in_user['role'] === 'admin'): ?>
                    <a href="<?=site_url('users/delete/'.$user['id']);?>"
                       onclick="return confirm('Are you sure you want to delete this record?');"
                       class="px-3 py-1 text-sm rounded-lg bg-red-900/70 text-red-300 hover:bg-red-700 hover:text-white transition duration-200 shadow-sm">
                      Delete
                    </a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    
      </div>

      <!-- Pagination -->
      <div class="mt-6 flex justify-center">
        <div class="pagination">
          <?= $page; ?>
        </div>
      </div>
    </div>
    <div class="mt-10">
  </div>
</body>
</html>
