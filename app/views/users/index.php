<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Directory</title>
  <link rel="stylesheet" href="<?=base_url();?>/public/style.css">
  <script src="https://cdn.tailwindcss.com"></script>

<style>
  .pagination {
    display: flex;
    gap: 0.6rem;
    flex-wrap: wrap;
    justify-content: center;
  }
  .pagination a {
    display: inline-block;
    padding: 0.5rem 1.1rem;
    background: white;
    border: 1px solid #d1d5db; /* gray-300 */
    color: #374151; /* gray-700 */
    border-radius: 9999px; /* full pill */
    font-weight: 500;
    text-decoration: none;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    transition: all 0.25s ease-in-out;
  }
  .pagination a:hover {
    background: #2563eb; /* blue-600 */
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }
  .pagination strong {
    display: inline-block;
    padding: 0.5rem 1.1rem;
    background: linear-gradient(to right, #2563eb, #1e40af); /* blue gradient */
    color: white;
    border-radius: 9999px;
    font-weight: 600;
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
  }
</style>

</head>

<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100 text-gray-800 font-sans min-h-screen">

  <!-- Navbar -->
  <nav class="bg-gradient-to-r from-blue-800 to-blue-500 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <a href="#" class="text-white font-bold text-xl tracking-wide">
        User Management
      </a>
      <a href="<?=site_url('reg/logout');?>" 
         class="bg-white/90 text-blue-800 font-semibold px-4 py-2 rounded-lg shadow hover:bg-gray-100 transition">
         Logout
      </a>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="max-w-6xl mx-auto mt-10 px-4">

    <div class="bg-white/80 backdrop-blur-xl shadow-xl rounded-2xl p-8 border border-gray-200">

      <!-- Logged In User Display -->
      <?php if(!empty($logged_in_user)): ?>
        <div class="mb-8 bg-gradient-to-r from-blue-100 to-blue-50 text-blue-900 px-6 py-5 rounded-xl shadow-md text-center">
          <h2 class="text-2xl font-bold mb-1">
            Welcome, <span class="text-blue-700"><?= html_escape($logged_in_user['username']); ?></span>
          </h2>
          <p class="text-lg">
            Role: 
            <span class="inline-block px-3 py-1 rounded-full font-semibold 
              <?= $logged_in_user['role'] === 'admin' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'; ?>">
              <?= html_escape($logged_in_user['role']); ?>
            </span>
          </p>
        </div>
      <?php else: ?>
        <div class="mb-6 bg-red-100 text-red-700 px-4 py-3 rounded-lg shadow text-center">
          Logged in user not found
        </div>
      <?php endif; ?>

      <!-- Header -->
      <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-2xl font-semibold text-gray-800">User Directory</h1>

        <!-- Search Bar -->
        <form method="get" action="<?=site_url('users');?>" class="flex w-full md:w-auto">
          <input 
            type="text" 
            name="q" 
            value="<?=html_escape($_GET['q'] ?? '')?>" 
            placeholder="Search user..." 
            class="w-full border border-gray-300 bg-gray-50 rounded-l-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 transition">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-r-xl transition">
            Search
          </button>
        </form>
      </div>
      
      <!-- Table -->
      <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
        <table class="w-full text-center border-collapse">
          <thead>
            <tr class="bg-gradient-to-r from-blue-800 to-blue-500 text-white text-sm uppercase tracking-wide">
              <th class="py-3 px-4">ID</th>
              <th class="py-3 px-4">Username</th>
              <th class="py-3 px-4">Email</th>
              <th class="py-3 px-4">Role</th>
              <th class="py-3 px-4">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 text-sm">
            <?php foreach(html_escape($users) as $user): ?>
              <tr class="hover:bg-blue-50 transition duration-200">
                <td class="py-3 px-4 font-medium"><?=($user['id']);?></td>
                <td class="py-3 px-4 text-gray-700 font-semibold"><?=($user['username']);?></td>
                <td class="py-3 px-4 text-gray-600 italic"><?=($user['email']);?></td>
                <td class="py-3 px-4">
                  <span class="px-3 py-1 text-sm font-semibold rounded-full
                    <?= $user['role'] === 'admin' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'; ?>">
                    <?=($user['role']);?>
                  </span>
                </td>
                <td class="py-3 px-4 space-x-3">
                  <?php if($logged_in_user['role'] === 'admin' || $logged_in_user['id'] == $user['id']): ?>
                    <a href="<?=site_url('users/update/'.$user['id']);?>"
                       class="px-3 py-1 text-sm rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-700 hover:text-white transition duration-200 shadow-sm">
                      Update
                    </a>
                  <?php endif; ?>

                  <?php if($logged_in_user['role'] === 'admin'): ?>
                    <a href="<?=site_url('users/delete/'.$user['id']);?>"
                       onclick="return confirm('Are you sure you want to delete this record?');"
                       class="px-3 py-1 text-sm rounded-lg bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition duration-200 shadow-sm">
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

      <!-- Create New User -->
      <div class="mt-6 text-center md:text-right">
        <a href="<?=site_url('users/create')?>"
           class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-medium px-6 py-3 rounded-full shadow-md transition duration-200 transform hover:scale-105">
          Create New User
        </a>
      </div>
    </div>
  </div>

</body>
</html>
