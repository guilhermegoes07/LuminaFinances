import axios from 'axios';
import { Transaction, Goal, Profile, User } from '../types';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Interceptor para adicionar token de autenticação
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

// Serviços de autenticação
export const authService = {
  login: async (email: string, password: string) => {
    const response = await api.post('/auth/login', { email, password });
    return response.data;
  },
  register: async (name: string, email: string, password: string) => {
    const response = await api.post('/auth/register', { name, email, password });
    return response.data;
  },
  logout: () => {
    localStorage.removeItem('token');
  },
};

// Serviços de transações
export const transactionService = {
  getAll: async (): Promise<Transaction[]> => {
    const response = await api.get('/transactions');
    return response.data;
  },
  create: async (transaction: Omit<Transaction, 'id'>): Promise<Transaction> => {
    const response = await api.post('/transactions', transaction);
    return response.data;
  },
  update: async (id: number, transaction: Partial<Transaction>): Promise<Transaction> => {
    const response = await api.put(`/transactions/${id}`, transaction);
    return response.data;
  },
  delete: async (id: number): Promise<void> => {
    await api.delete(`/transactions/${id}`);
  },
};

// Serviços de objetivos financeiros
export const goalService = {
  getAll: async (): Promise<Goal[]> => {
    const response = await api.get('/goals');
    return response.data;
  },
  create: async (goal: Omit<Goal, 'id'>): Promise<Goal> => {
    const response = await api.post('/goals', goal);
    return response.data;
  },
  update: async (id: number, goal: Partial<Goal>): Promise<Goal> => {
    const response = await api.put(`/goals/${id}`, goal);
    return response.data;
  },
  updateProgress: async (id: number, amount: number): Promise<Goal> => {
    const response = await api.patch(`/goals/${id}/progress`, { amount });
    return response.data;
  },
  delete: async (id: number): Promise<void> => {
    await api.delete(`/goals/${id}`);
  },
};

// Serviços de perfil
export const profileService = {
  getAll: async (): Promise<Profile[]> => {
    const response = await api.get('/profiles');
    return response.data;
  },
  get: async (id: number): Promise<Profile> => {
    const response = await api.get(`/profiles/${id}`);
    return response.data;
  },
  create: async (profile: Omit<Profile, 'id'>): Promise<Profile> => {
    const response = await api.post('/profiles', profile);
    return response.data;
  },
  update: async (id: number, profile: Partial<Profile>): Promise<Profile> => {
    const response = await api.put(`/profiles/${id}`, profile);
    return response.data;
  },
  delete: async (id: number): Promise<void> => {
    await api.delete(`/profiles/${id}`);
  },
};

// Serviços de usuário
export const userService = {
  getCurrentUser: async (): Promise<User> => {
    const response = await api.get('/user');
    return response.data;
  },
  updateProfile: async (data: Partial<User>): Promise<User> => {
    const response = await api.put('/user', data);
    return response.data;
  },
  updatePassword: async (currentPassword: string, newPassword: string): Promise<void> => {
    await api.put('/user/password', { currentPassword, newPassword });
  },
};

export default api;
