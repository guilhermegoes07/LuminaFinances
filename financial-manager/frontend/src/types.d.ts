declare module '@/types' {
  interface User {
    id: string;
    name: string;
    email: string;
    createdAt: string;
    updatedAt: string;
  }

  interface AuthResponse {
    token: string;
    user: User;
  }

  interface LoginCredentials {
    email: string;
    password: string;
  }

  interface RegisterCredentials extends LoginCredentials {
    name: string;
  }

  interface ApiError {
    message: string;
    status?: number;
  }

  interface Transaction {
    id: string;
    description: string;
    amount: number;
    type: 'income' | 'expense';
    date: string;
    categoryId: string;
    userId: string;
  }

  interface Goal {
    id: string;
    title: string;
    targetAmount: number;
    currentAmount: number;
    deadline: string;
    userId: string;
    createdAt: string;
    updatedAt: string;
  }

  interface Category {
    id: string;
    name: string;
    type: 'income' | 'expense';
    userId: string;
  }

  interface Profile {
    id: string;
    name: string;
    monthlyBudget: number;
    userId: string;
  }
}
