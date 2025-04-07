import React, { createContext, useContext, useState, useEffect } from 'react';
import { User, Goal, Transaction } from '../types';
import api from '../services/api';

interface AppContextType {
  user: User | null;
  token: string | null;
  goals: Goal[];
  transactions: Transaction[];
  loading: boolean;
  error: string | null;
  login: (email: string, password: string) => Promise<void>;
  logout: () => Promise<void>;
  register: (name: string, email: string, password: string) => Promise<void>;
  updateGoalProgress: (goalId: string, progress: number) => Promise<void>;
}

const AppContext = createContext<AppContextType | undefined>(undefined);

export const AppProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [user, setUser] = useState<User | null>(null);
  const [token, setToken] = useState<string | null>(null);
  const [goals, setGoals] = useState<Goal[]>([]);
  const [transactions] = useState<Transaction[]>([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const storedToken = localStorage.getItem('token');
    if (storedToken) {
      setToken(storedToken);
      api.defaults.headers.common['Authorization'] = `Bearer ${storedToken}`;
    }
  }, []);

  const login = async (email: string, password: string) => {
    try {
      setLoading(true);
      setError(null);
      const response = await api.post('/login', { email, password });
      const { token: newToken, user: userData } = response.data;

      setToken(newToken);
      setUser(userData);

      localStorage.setItem('token', newToken);
      api.defaults.headers.common['Authorization'] = `Bearer ${newToken}`;
    } catch (error: any) {
      setError(error.response?.data?.message || 'Erro ao fazer login');
      throw error;
    } finally {
      setLoading(false);
    }
  };

  const logout = async () => {
    try {
      setLoading(true);
      setError(null);
      await api.post('/logout');
      setToken(null);
      setUser(null);
      localStorage.removeItem('token');
      delete api.defaults.headers.common['Authorization'];
    } catch (error: any) {
      setError(error.response?.data?.message || 'Erro ao fazer logout');
      throw error;
    } finally {
      setLoading(false);
    }
  };

  const register = async (name: string, email: string, password: string) => {
    try {
      setLoading(true);
      setError(null);
      const response = await api.post('/register', { name, email, password });
      const { token: newToken, user: userData } = response.data;

      setToken(newToken);
      setUser(userData);

      localStorage.setItem('token', newToken);
      api.defaults.headers.common['Authorization'] = `Bearer ${newToken}`;
    } catch (error: any) {
      setError(error.response?.data?.message || 'Erro ao registrar');
      throw error;
    } finally {
      setLoading(false);
    }
  };

  const updateGoalProgress = async (goalId: string, progress: number) => {
    try {
      setLoading(true);
      setError(null);
      const response = await api.put(`/goals/${goalId}`, { progress });
      setGoals(goals.map(goal => goal.id === goalId ? response.data : goal));
    } catch (error: any) {
      setError(error.response?.data?.message || 'Erro ao atualizar meta');
      throw error;
    } finally {
      setLoading(false);
    }
  };

  return (
    <AppContext.Provider
      value={{
        user,
        token,
        goals,
        transactions,
        loading,
        error,
        login,
        logout,
        register,
        updateGoalProgress,
      }}
    >
      {children}
    </AppContext.Provider>
  );
};

export const useApp = () => {
  const context = useContext(AppContext);
  if (context === undefined) {
    throw new Error('useApp must be used within an AppProvider');
  }
  return context;
};

export default AppContext;
