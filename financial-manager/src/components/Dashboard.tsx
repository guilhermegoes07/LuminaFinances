import React, { useState } from 'react';
import { useApp } from '../context/AppContext';
import TransactionForm from './TransactionForm';
import FinancialGoals from './FinancialGoals';
import FinancialSummary from './FinancialSummary';
import RecentTransactions from './RecentTransactions';
import {
  BarChart3,
  DollarSign,
  PlusCircle,
  LogOut
} from 'lucide-react';
import { useNavigate } from 'react-router-dom';

const Dashboard: React.FC = () => {
  const [showTransactionForm, setShowTransactionForm] = useState(false);
  const { logout, goals, updateGoalProgress } = useApp();
  const navigate = useNavigate();

  const handleLogout = async () => {
    try {
      await logout();
      navigate('/');
    } catch (error) {
      console.error('Erro ao fazer logout:', error);
    }
  };

  return (
    <div className="min-h-screen bg-background">
      {/* Header */}
      <div className="bg-white shadow-lg">
        <div className="container mx-auto px-4 py-4">
          <div className="flex justify-between items-center">
            <div className="flex items-center space-x-3">
              <div className="flex items-center space-x-2">
                <BarChart3 className="h-8 w-8 text-primary" />
                <DollarSign className="h-8 w-8 text-success" />
              </div>
              <h1 className="text-3xl font-bold text-text">Dashboard Financeiro</h1>
            </div>
            <div className="flex items-center space-x-4">
              <button
                onClick={() => setShowTransactionForm(true)}
                className="flex items-center space-x-2 bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl transition-all duration-150 ease-in-out shadow-lg hover:shadow-xl"
              >
                <PlusCircle className="w-5 h-5" />
                <span>Nova Transação</span>
              </button>
              <button
                onClick={handleLogout}
                className="flex items-center space-x-2 text-text-light hover:text-primary transition-colors duration-150"
              >
                <LogOut className="w-5 h-5" />
                <span>Sair</span>
              </button>
            </div>
          </div>
        </div>
      </div>

      {/* Conteúdo Principal */}
      <div className="container mx-auto px-4 py-8">
        {/* Resumo Financeiro */}
        <FinancialSummary />

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
          {/* Objetivos Financeiros */}
          <FinancialGoals goals={goals} onAddProgress={updateGoalProgress} />

          {/* Últimas Transações */}
          <RecentTransactions />
        </div>
      </div>

      {/* Modal de Nova Transação */}
      {showTransactionForm && (
        <TransactionForm
          onSubmit={() => setShowTransactionForm(false)}
          onClose={() => setShowTransactionForm(false)}
        />
      )}
    </div>
  );
};

export default Dashboard;
