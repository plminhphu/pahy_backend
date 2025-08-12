

<template>
  <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-md mt-8">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Danh sách User</h1>

    <div v-if="loading" class="text-center py-6 text-gray-600">Đang tải dữ liệu...</div>

    <table v-else class="min-w-full border border-gray-200 rounded-md">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 border-b border-gray-300 text-left">Tên</th>
          <th class="px-4 py-2 border-b border-gray-300 text-left">Email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in paginatedUsers" :key="user.id" class="hover:bg-gray-50">
          <td class="px-4 py-3 border-b border-gray-200">{{ user.name }}</td>
          <td class="px-4 py-3 border-b border-gray-200">{{ user.email }}</td>
        </tr>
        <tr v-if="users.length === 0">
          <td colspan="2" class="text-center py-4 text-gray-500 italic">Không có user nào.</td>
        </tr>
      </tbody>
    </table>

    <div class="mt-4 flex justify-center gap-2">
      <button
        class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50"
        :disabled="currentPage === 1"
        @click="currentPage--"
      >
        Trước
      </button>
      <button
        class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50"
        :disabled="currentPage * perPage >= users.length"
        @click="currentPage++"
      >
        Sau
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { getUsers } from '~~/services/api.js';

const users = ref([]);
const loading = ref(false);

const currentPage = ref(1);
const perPage = 5;

const paginatedUsers = computed(() => {
  const start = (currentPage.value - 1) * perPage;
  return users.value.slice(start, start + perPage);
});

onMounted(async () => {
  loading.value = true;
  try {
    const response = await getUsers();
    users.value = response.data.data || [];
  } catch (error) {
    console.error(error);
  } finally {
    loading.value = false;
  }
});
</script>
