import React, { createContext, useContext, useReducer, ReactNode } from 'react';
import { Transaction, Goal, Profile, User } from '../types';

interface AppState {
  currentUser: User | null;
  currentProfile: Profile | null;
  transactions: Transaction[];
  goals: Goal[];
  isLoading: boolean;
  error: string | null;
}

type AppAction =
  | { type: 'SET_USER'; payload: User }
  | { type: 'SET_PROFILE'; payload: Profile }
  | { type: 'ADD_TRANSACTION'; payload: Transaction }
  | { type: 'ADD_GOAL'; payload: Goal }
  | { type: 'UPDATE_GOAL_PROGRESS'; payload: { goalId: number; amount: number } }
  | { type: 'SET_LOADING'; payload: boolean }
  | { type: 'SET_ERROR'; payload: string | null };

const initialState: AppState = {
  currentUser: null,
  currentProfile: null,
  transactions: [],
  goals: [],
  isLoading: false,
  error: null,
};

const AppContext = createContext<{
  state: AppState;
  dispatch: React.Dispatch<AppAction>;
} | undefined>(undefined);

function appReducer(state: AppState, action: AppAction): AppState {
  switch (action.type) {
    case 'SET_USER':
      return {
        ...state,
        currentUser: action.payload,
      };
    case 'SET_PROFILE':
      return {
        ...state,
        currentProfile: action.payload,
        transactions: action.payload.transactions,
        goals: action.payload.goals,
      };
    case 'ADD_TRANSACTION':
      return {
        ...state,
        transactions: [action.payload, ...state.transactions],
      };
    case 'ADD_GOAL':
      return {
        ...state,
        goals: [action.payload, ...state.goals],
      };
    case 'UPDATE_GOAL_PROGRESS':
      return {
        ...state,
        goals: state.goals.map((goal) =>
          goal.id === action.payload.goalId
            ? {
                ...goal,
                currentAmount: goal.currentAmount + action.payload.amount,
              }
            : goal
        ),
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
    default:
      return state;
  }
}

export function AppProvider({ children }: { children: ReactNode }) {
  const [state, dispatch] = useReducer(appReducer, initialState);

  return (
    <AppContext.Provider value={{ state, dispatch }}>
      {children}
    </AppContext.Provider>
  );
}

export function useApp() {
  const context = useContext(AppContext);
  if (context === undefined) {
    throw new Error('useApp must be used within an AppProvider');
  }
  return context;
}

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
