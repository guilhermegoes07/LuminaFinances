import React, { useState } from 'react';
import { useTransactions, useGoals } from '../context/AppContext';
import TransactionForm from './TransactionForm';
import FinancialGoals from './FinancialGoals';
import {
  BarChart3,
  DollarSign,
  PlusCircle,
  TrendingUp,
  TrendingDown,
  Wallet,
  Clock
} from 'lucide-react';

const Dashboard: React.FC = () => {
  const [showTransactionForm, setShowTransactionForm] = useState(false);
  const { transactions, addTransaction } = useTransactions();
  const { goals, updateGoalProgress } = useGoals();

  const totalBalance = transactions.reduce((acc, curr) => {
    return curr.type === 'income' ? acc + curr.amount : acc - curr.amount;
  }, 0);

  const monthlyIncome = transactions
    .filter(t => t.type === 'income' && new Date(t.date).getMonth() === new Date().getMonth())
    .reduce((acc, curr) => acc + curr.amount, 0);

  const monthlyExpenses = transactions
    .filter(t => t.type === 'expense' && new Date(t.date).getMonth() === new Date().getMonth())
    .reduce((acc, curr) => acc + curr.amount, 0);

  const handleTransactionSubmit = (transaction: any) => {
    addTransaction(transaction);
    setShowTransactionForm(false);
  };

  return (
    <div className="min-h-screen bg-background">
      <div className="container mx-auto px-4 py-8">
        <div className="flex justify-between items-center mb-8">
          <div className="flex items-center space-x-3">
            <div className="flex items-center space-x-2">
              <BarChart3 className="h-8 w-8 text-primary" />
              <DollarSign className="h-8 w-8 text-success" />
            </div>
            <h1 className="text-3xl font-bold text-text">Dashboard Financeiro</h1>
          </div>
          <button
            onClick={() => setShowTransactionForm(true)}
            className="flex items-center space-x-2 bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl transition-all duration-150 ease-in-out shadow-lg hover:shadow-xl"
          >
            <PlusCircle className="w-5 h-5" />
            <span>Nova Transação</span>
          </button>
        </div>

        {/* Resumo Financeiro */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <div className="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-150">
            <div className="flex items-center space-x-3 mb-4">
              <Wallet className="w-6 h-6 text-primary" />
              <h2 className="text-lg font-semibold text-text">Saldo Total</h2>
            </div>
            <p className={`text-2xl font-bold ${totalBalance >= 0 ? 'text-success' : 'text-danger'}`}>
              R$ {totalBalance.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}
            </p>
          </div>
          <div className="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-150">
            <div className="flex items-center space-x-3 mb-4">
              <TrendingUp className="w-6 h-6 text-success" />
              <h2 className="text-lg font-semibold text-text">Receitas do Mês</h2>
            </div>
            <p className="text-2xl font-bold text-success">
              R$ {monthlyIncome.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}
            </p>
          </div>
          <div className="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-150">
            <div className="flex items-center space-x-3 mb-4">
              <TrendingDown className="w-6 h-6 text-danger" />
              <h2 className="text-lg font-semibold text-text">Despesas do Mês</h2>
            </div>
            <p className="text-2xl font-bold text-danger">
              R$ {monthlyExpenses.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}
            </p>
          </div>
        </div>

        {/* Objetivos Financeiros */}
        <FinancialGoals goals={goals} onAddProgress={updateGoalProgress} />

        {/* Últimas Transações */}
        <div className="bg-white rounded-xl shadow-lg p-6 mt-8 animate-fade-in">
          <div className="flex items-center space-x-3 mb-6">
            <Clock className="w-6 h-6 text-primary" />
            <h2 className="text-xl font-semibold text-text">Últimas Transações</h2>
          </div>
          <div className="space-y-4">
            {transactions.slice(0, 5).map((transaction) => (
              <div
                key={transaction.id}
                className="flex justify-between items-center border-b border-background pb-4 hover:bg-background/5 p-2 rounded-lg transition-colors duration-150"
              >
                <div>
                  <p className="font-medium text-text">{transaction.description}</p>
                  <p className="text-sm text-text-muted">
                    {new Date(transaction.date).toLocaleDateString('pt-BR')}
                  </p>
                </div>
                <span className={`font-medium ${
                  transaction.type === 'income' ? 'text-success' : 'text-danger'
                }`}>
                  {transaction.type === 'income' ? '+' : '-'} R$ {transaction.amount.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}
                </span>
              </div>
            ))}
          </div>
        </div>
      </div>

      {showTransactionForm && (
        <TransactionForm
          onSubmit={handleTransactionSubmit}
          onClose={() => setShowTransactionForm(false)}
        />
      )}
    </div>
  );
};

export default Dashboard;
