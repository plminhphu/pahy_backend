<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
      <div class="text-3xl font-bold p-6 border-b border-gray-700">MyDashboard</div>
      <nav class="flex-1 p-4 space-y-2">
        <NuxtLink to="/" class="block px-4 py-2 rounded hover:bg-gray-700" active-class="bg-gray-700">Home</NuxtLink>
        <NuxtLink to="/admin/users" class="block px-4 py-2 rounded hover:bg-gray-700" active-class="bg-gray-700">Users</NuxtLink>
        <NuxtLink to="/admin/settings" class="block px-4 py-2 rounded hover:bg-gray-700" active-class="bg-gray-700">Settings</NuxtLink>
      </nav>
      <div class="p-6 border-t border-gray-700 text-sm">© 2025 Your Company</div>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col">
      <!-- Header -->
      <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-xl font-semibold text-gray-800"><slot name="header">Dashboard</slot></h1>
        <div>
          <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Logout</button>
        </div>
      </header>

      <!-- Content -->
      <main class="p-6 overflow-auto flex-1 bg-gray-50">
        <slot />
      </main>
    </div>
  </div>
</template>
