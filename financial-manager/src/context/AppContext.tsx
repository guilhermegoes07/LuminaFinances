import React, { createContext, useContext, useReducer, ReactNode, Dispatch, useEffect } from 'react';
import api from '../services/api';
import { Transaction, Goal, Profile } from '../types';

// Types
export interface User {
  id: string;
  name: string;
  email: string;
}

export interface AppState {
  currentUser: User | null;
  isLoading: boolean;
  error: string | null;
  transactions: Transaction[];
  goals: Goal[];
  currentProfile: Profile | null;
}

type AppAction =
  | { type: 'SET_USER'; payload: User }
  | { type: 'CLEAR_USER' }
  | { type: 'SET_LOADING'; payload: boolean }
  | { type: 'SET_ERROR'; payload: string }
  | { type: 'SET_TRANSACTIONS'; payload: Transaction[] }
  | { type: 'ADD_TRANSACTION'; payload: Transaction }
  | { type: 'UPDATE_TRANSACTION'; payload: Transaction }
  | { type: 'DELETE_TRANSACTION'; payload: string }
  | { type: 'SET_GOALS'; payload: Goal[] }
  | { type: 'ADD_GOAL'; payload: Goal }
  | { type: 'UPDATE_GOAL'; payload: Goal }
  | { type: 'DELETE_GOAL'; payload: string }
  | { type: 'SET_PROFILE'; payload: Profile }
  | { type: 'UPDATE_GOAL_PROGRESS'; payload: { goalId: number; amount: number } };

interface AppContextType {
  state: AppState;
  dispatch: Dispatch<AppAction>;
  login: (email: string, password: string) => Promise<void>;
  register: (name: string, email: string, password: string) => Promise<void>;
  logout: () => Promise<void>;
}

// Initial state
const initialState: AppState = {
  currentUser: null,
  isLoading: false,
  error: null,
  transactions: [],
  goals: [],
  currentProfile: null,
};

// Reducer
const appReducer = (state: AppState, action: AppAction): AppState => {
  switch (action.type) {
    case 'SET_USER':
      return {
        ...state,
        currentUser: action.payload,
        error: null,
      };
    case 'CLEAR_USER':
      return {
        ...state,
        currentUser: null,
        transactions: [],
        goals: [],
        currentProfile: null,
      };
    case 'SET_LOADING':
      return {
        ...state,
        isLoading: action.payload,
      };
    case 'SET_ERROR':
      return {
        ...state,
        error: action.payload,
      };
    case 'SET_TRANSACTIONS':
      return {
        ...state,
        transactions: action.payload,
      };
    case 'ADD_TRANSACTION':
      return {
        ...state,
        transactions: [...state.transactions, action.payload],
      };
    case 'UPDATE_TRANSACTION':
      return {
        ...state,
        transactions: state.transactions.map((transaction) =>
          transaction.id === action.payload.id ? action.payload : transaction
        ),
      };
    case 'DELETE_TRANSACTION':
      return {
        ...state,
        transactions: state.transactions.filter((transaction) => transaction.id !== action.payload),
      };
    case 'SET_GOALS':
      return {
        ...state,
        goals: action.payload,
      };
    case 'ADD_GOAL':
      return {
        ...state,
        goals: [...state.goals, action.payload],
      };
    case 'UPDATE_GOAL':
      return {
        ...state,
        goals: state.goals.map((goal) =>
          goal.id === action.payload.id ? action.payload : goal
        ),
      };
    case 'DELETE_GOAL':
      return {
        ...state,
        goals: state.goals.filter((goal) => goal.id !== action.payload),
      };
    case 'SET_PROFILE':
      return {
        ...state,
        currentProfile: action.payload,
      };
    case 'UPDATE_GOAL_PROGRESS':
      return {
        ...state,
        goals: state.goals.map((goal) =>
          goal.id === action.payload.goalId
            ? { ...goal, currentAmount: goal.currentAmount + action.payload.amount }
            : goal
        ),
      };
    default:
      return state;
  }
};

// Context
const AppContext = createContext<AppContextType | undefined>(undefined);

// Provider Component
export const AppProvider: React.FC<{ children: ReactNode }> = ({ children }) => {
  const [state, dispatch] = useReducer(appReducer, initialState);

  // Verificar token ao carregar a aplicação
  useEffect(() => {
    const token = localStorage.getItem('token');
    if (token) {
      // Tentar validar o token e obter dados do usuário
      api.get('/auth/me')
        .then(response => {
          dispatch({ type: 'SET_USER', payload: response.data });
        })
        .catch(() => {
          localStorage.removeItem('token');
        });
    }
  }, []);

  const login = async (email: string, password: string) => {
    try {
      dispatch({ type: 'SET_LOADING', payload: true });
      dispatch({ type: 'SET_ERROR', payload: null });

      const response = await api.post('/auth/login', { email, password });
      const { token, user } = response.data;

      localStorage.setItem('token', token);
      dispatch({ type: 'SET_USER', payload: user });
    } catch (error: any) {
      const errorMessage = error.response?.data?.message || 'Erro ao fazer login';
      dispatch({ type: 'SET_ERROR', payload: errorMessage });
      throw new Error(errorMessage);
    } finally {
      dispatch({ type: 'SET_LOADING', payload: false });
    }
  };

  const register = async (name: string, email: string, password: string) => {
    try {
      dispatch({ type: 'SET_LOADING', payload: true });
      dispatch({ type: 'SET_ERROR', payload: null });

      const response = await api.post('/auth/register', { name, email, password });
      const { token, user } = response.data;

      localStorage.setItem('token', token);
      dispatch({ type: 'SET_USER', payload: user });
    } catch (error: any) {
      const errorMessage = error.response?.data?.message || 'Erro ao criar conta';
      dispatch({ type: 'SET_ERROR', payload: errorMessage });
      throw new Error(errorMessage);
    } finally {
      dispatch({ type: 'SET_LOADING', payload: false });
    }
  };

  const logout = async () => {
    try {
      await api.post('/auth/logout');
    } catch (error) {
      console.error('Erro ao fazer logout:', error);
    } finally {
      localStorage.removeItem('token');
      dispatch({ type: 'CLEAR_USER' });
    }
  };

  const value = {
    state,
    dispatch,
    login,
    register,
    logout,
  };

  return <AppContext.Provider value={value}>{children}</AppContext.Provider>;
};

// Hook
export const useApp = () => {
  const context = useContext(AppContext);
  if (context === undefined) {
    throw new Error('useApp must be used within an AppProvider');
  }
  return context;
};

// Hooks personalizados para ações comuns
export function useTransactions() {
  const { state, dispatch } = useApp();

  const addTransaction = async (transaction: Omit<Transaction, 'id'>) => {
    try {
      const response = await api.post('/transactions', transaction);
      dispatch({ type: 'ADD_TRANSACTION', payload: response.data });
    } catch (error) {
      console.error('Erro ao adicionar transação:', error);
      throw error;
    }
  };

  return {
    transactions: state.transactions,
    addTransaction,
  };
}

export function useGoals() {
  const { state, dispatch } = useApp();

  const addGoal = async (goal: Omit<Goal, 'id'>) => {
    try {
      const response = await api.post('/goals', goal);
      dispatch({ type: 'ADD_GOAL', payload: response.data });
    } catch (error) {
      console.error('Erro ao adicionar meta:', error);
      throw error;
    }
  };

  const updateGoalProgress = async (goalId: number, amount: number) => {
    try {
      await api.put(`/goals/${goalId}/progress`, { amount });
      dispatch({ type: 'UPDATE_GOAL_PROGRESS', payload: { goalId, amount } });
    } catch (error) {
      console.error('Erro ao atualizar progresso da meta:', error);
      throw error;
    }
  };

  return {
    goals: state.goals,
    addGoal,
    updateGoalProgress,
  };
}

export function useProfile() {
  const { state, dispatch } = useApp();

  const setProfile = async (profile: Profile) => {
    try {
      const response = await api.post('/profiles', profile);
      dispatch({ type: 'SET_PROFILE', payload: response.data });
    } catch (error) {
      console.error('Erro ao definir perfil:', error);
      throw error;
    }
  };

  return {
    currentProfile: state.currentProfile,
    setProfile,
  };
}
