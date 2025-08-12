import axios from 'axios';

const apiClient = axios.create({
  baseURL: 'http://127.0.0.1:8000/api', // URL backend Laravel của bạn
  headers: {
    'Content-Type': 'application/json',
  },
});

export const getUsers = () => {
  return apiClient.get('/admin/users');
};
