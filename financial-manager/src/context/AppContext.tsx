import React, { createContext, useContext, useReducer, ReactNode, Dispatch } from 'react';
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

  const login = async (email: string, password: string) => {
    try {
      dispatch({ type: 'SET_LOADING', payload: true });
      const response = await api.post('/auth/login', { email, password });
      const { user, token } = response.data;

      localStorage.setItem('token', token);
      api.defaults.headers.common['Authorization'] = `Bearer ${token}`;

      dispatch({ type: 'SET_USER', payload: user });
    } catch (error) {
      dispatch({ type: 'SET_ERROR', payload: 'Falha ao fazer login' });
      throw error;
    } finally {
      dispatch({ type: 'SET_LOADING', payload: false });
    }
  };

  const register = async (name: string, email: string, password: string) => {
    try {
      dispatch({ type: 'SET_LOADING', payload: true });
      const response = await api.post('/auth/register', { name, email, password });
      const { user, token } = response.data;

      localStorage.setItem('token', token);
      api.defaults.headers.common['Authorization'] = `Bearer ${token}`;

      dispatch({ type: 'SET_USER', payload: user });
    } catch (error) {
      dispatch({ type: 'SET_ERROR', payload: 'Falha ao criar conta' });
      throw error;
    } finally {
      dispatch({ type: 'SET_LOADING', payload: false });
    }
  };

  const logout = async () => {
    try {
      await api.post('/auth/logout');
      localStorage.removeItem('token');
      delete api.defaults.headers.common['Authorization'];
      dispatch({ type: 'CLEAR_USER' });
    } catch (error) {
      console.error('Erro ao fazer logout:', error);
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

  const addTransaction = (transaction: Omit<Transaction, 'id'>) => {
    dispatch({
      type: 'ADD_TRANSACTION',
      payload: {
        ...transaction,
        id: Date.now(), // Simplificado para exemplo
      },
    });
  };

  return {
    transactions: state.transactions,
    addTransaction,
  };
}

export function useGoals() {
  const { state, dispatch } = useApp();

  const addGoal = (goal: Omit<Goal, 'id'>) => {
    dispatch({
      type: 'ADD_GOAL',
      payload: {
        ...goal,
        id: Date.now(), // Simplificado para exemplo
      },
    });
  };

  const updateGoalProgress = (goalId: number, amount: number) => {
    dispatch({
      type: 'UPDATE_GOAL_PROGRESS',
      payload: { goalId, amount },
    });
  };

  return {
    goals: state.goals,
    addGoal,
    updateGoalProgress,
  };
}

export function useProfile() {
  const { state, dispatch } = useApp();

  const setProfile = (profile: Profile) => {
    dispatch({ type: 'SET_PROFILE', payload: profile });
  };

  return {
    currentProfile: state.currentProfile,
    setProfile,
  };
}
