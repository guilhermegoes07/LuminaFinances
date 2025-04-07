import React from 'react';
import { useApp } from '../context/AppContext';
import {
  TrendingUp,
  TrendingDown,
  Wallet,
  BarChart3
} from 'lucide-react';

const FinancialSummary: React.FC = () => {
  const { transactions } = useApp();

  const totalBalance = transactions.reduce((acc, curr) => {
    return curr.type === 'income' ? acc + curr.amount : acc - curr.amount;
  }, 0);

  const monthlyIncome = transactions
    .filter(t => t.type === 'income' && new Date(t.date).getMonth() === new Date().getMonth())
    .reduce((acc, curr) => acc + curr.amount, 0);

  const monthlyExpenses = transactions
    .filter(t => t.type === 'expense' && new Date(t.date).getMonth() === new Date().getMonth())
    .reduce((acc, curr) => acc + curr.amount, 0);

  // Agrupar despesas por categoria
  const expensesByCategory = transactions
    .filter(t => t.type === 'expense')
    .reduce((acc: { [key: string]: number }, curr) => {
      const categoryId = curr.categoryId;
      acc[categoryId] = (acc[categoryId] || 0) + curr.amount;
      return acc;
    }, {});

  return (
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

      {/* Gráfico de Despesas por Categoria */}
      <div className="col-span-full bg-white rounded-xl shadow-lg p-6">
        <div className="flex items-center space-x-3 mb-6">
          <BarChart3 className="w-6 h-6 text-primary" />
          <h2 className="text-lg font-semibold text-text">Despesas por Categoria</h2>
        </div>
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
          {Object.entries(expensesByCategory).map(([categoryId, amount]) => (
            <div key={categoryId} className="bg-background rounded-lg p-4">
              <p className="text-sm text-text-light mb-2">{categoryId}</p>
              <p className="text-lg font-semibold text-danger">
                R$ {amount.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}
              </p>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default FinancialSummary;
