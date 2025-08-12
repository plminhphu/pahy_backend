<template>
  <div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-2">Users</h2>
        <p class="text-3xl font-bold text-blue-600">128</p>
        <p class="text-gray-500 mt-1">Active users this month</p>
      </div>
      <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-2">Revenue</h2>
        <p class="text-3xl font-bold text-green-600">$12,345</p>
        <p class="text-gray-500 mt-1">Monthly revenue</p>
      </div>
      <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-2">Tasks</h2>
        <p class="text-3xl font-bold text-yellow-500">27</p>
        <p class="text-gray-500 mt-1">Pending tasks</p>
      </div>
    </div>
  </div>
</template>

<script setup>
definePageMeta({
  layout: 'dashboard'
})
</script>
