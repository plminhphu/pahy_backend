<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Danh sách User</h1>

    <table class="min-w-full border border-gray-300 rounded-md text-gray-700">
      <thead class="bg-blue-600 text-white">
        <tr>
          <th class="px-6 py-3 text-left">Tên</th>
          <th class="px-6 py-3 text-left">Email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id" class="hover:bg-blue-50">
          <td class="px-6 py-4 border-b border-gray-300">{{ user.name }}</td>
          <td class="px-6 py-4 border-b border-gray-300">{{ user.email }}</td>
        </tr>
        <tr v-if="users.length === 0">
          <td colspan="2" class="text-center py-4 italic">Không có user nào.</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { getUsers } from '../../services/api.js';

const users = ref([]);

onMounted(async () => {
  try {
    const response = await getUsers();
    users.value = response.data.data || [];
  } catch (error) {
    console.error(error);
  }
});
</script>

<script>
export default {
  layout: 'dashboard'
}
</script>
