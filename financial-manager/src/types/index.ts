export interface Transaction {
  id: number;
  type: 'income' | 'expense';
  description: string;
  amount: number;
  category: string;
  date: string;
}

export interface Goal {
  id: number;
  title: string;
  targetAmount: number;
  currentAmount: number;
  deadline: string;
  category: string;
}

export interface User {
  id: number;
  name: string;
  email: string;
  profiles: {
    id: number;
    name: string;
    type: 'personal' | 'business';
  }[];
}

export interface Profile {
  id: number;
  name: string;
  type: 'personal' | 'business';
  transactions: Transaction[];
  goals: Goal[];
}
