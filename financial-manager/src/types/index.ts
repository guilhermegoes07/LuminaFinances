export interface Transaction {
  id: string;
  description: string;
  amount: number;
  type: 'income' | 'expense';
  date: string;
  categoryId: string;
  userId: string;
}

export interface Goal {
  id: string;
  title: string;
  targetAmount: number;
  currentAmount: number;
  deadline: string;
  userId: string;
}

export interface User {
  id: string;
  name: string;
  email: string;
}

export interface Category {
  id: string;
  name: string;
  type: 'income' | 'expense';
  userId: string;
}

export interface Profile {
  id: string;
  name: string;
  monthlyBudget: number;
  userId: string;
}
