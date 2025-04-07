import axios from 'axios';
import type { LoginCredentials, RegisterCredentials, AuthResponse, ApiError } from '../types';

const api = axios.create({
  baseURL: '/api',
  headers: {
    'Content-Type': 'application/json',
  },
});

export class AuthService {
  static async login(credentials: LoginCredentials): Promise<AuthResponse> {
    try {
      const response = await api.post<AuthResponse>('/auth/login', credentials);
      return response.data;
    } catch (error) {
      if (axios.isAxiosError(error)) {
        throw {
          message: error.response?.data?.message || 'An error occurred during login',
          status: error.response?.status,
        } as ApiError;
      }
      throw { message: 'An unexpected error occurred' } as ApiError;
    }
  }

  static async register(credentials: RegisterCredentials): Promise<AuthResponse> {
    try {
      const response = await api.post<AuthResponse>('/auth/register', credentials);
      return response.data;
    } catch (error) {
      if (axios.isAxiosError(error)) {
        throw {
          message: error.response?.data?.message || 'An error occurred during registration',
          status: error.response?.status,
        } as ApiError;
      }
      throw { message: 'An unexpected error occurred' } as ApiError;
    }
  }

  static setAuthToken(token: string): void {
    api.defaults.headers.common['Authorization'] = `Bearer ${token}`;
  }

  static removeAuthToken(): void {
    delete api.defaults.headers.common['Authorization'];
  }
}
