import React from 'react';
import { useTransactions } from '../context/AppContext';
import {
  Wallet,
  TrendingUp,
  TrendingDown,
  BarChart3,
  PieChart
} from 'lucide-react';

const FinancialSummary: React.FC = () => {
  const { transactions } = useTransactions();

  const totalBalance = transactions.reduce((acc, curr) => {
    return curr.type === 'income' ? acc + curr.amount : acc - curr.amount;
  }, 0);

  const monthlyIncome = transactions
    .filter(t => t.type === 'income' && new Date(t.date).getMonth() === new Date().getMonth())
    .reduce((acc, curr) => acc + curr.amount, 0);

  const monthlyExpenses = transactions
    .filter(t => t.type === 'expense' && new Date(t.date).getMonth() === new Date().getMonth())
    .reduce((acc, curr) => acc + curr.amount, 0);

  const monthlyBalance = monthlyIncome - monthlyExpenses;

  const categoryExpenses = transactions
    .filter(t => t.type === 'expense' && new Date(t.date).getMonth() === new Date().getMonth())
    .reduce((acc: { [key: string]: number }, curr) => {
      acc[curr.category] = (acc[curr.category] || 0) + curr.amount;
      return acc;
    }, {});

  return (
    <div className="space-y-6">
      {/* Cards de Resumo */}
      <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
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

        <div className="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-150">
          <div className="flex items-center space-x-3 mb-4">
            <BarChart3 className="w-6 h-6 text-primary" />
            <h2 className="text-lg font-semibold text-text">Saldo do Mês</h2>
          </div>
          <p className={`text-2xl font-bold ${monthlyBalance >= 0 ? 'text-success' : 'text-danger'}`}>
            R$ {monthlyBalance.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}
          </p>
        </div>
      </div>

      {/* Gráfico de Despesas por Categoria */}
      <div className="bg-white rounded-xl shadow-lg p-6">
        <div className="flex items-center space-x-3 mb-6">
          <PieChart className="w-6 h-6 text-primary" />
          <h2 className="text-xl font-semibold text-text">Despesas por Categoria</h2>
        </div>
        <div className="space-y-4">
          {Object.entries(categoryExpenses).map(([category, amount]) => (
            <div key={category} className="flex items-center space-x-4">
              <div className="w-24">
                <span className="text-sm font-medium text-text">{category}</span>
              </div>
              <div className="flex-1">
                <div className="h-2 bg-background rounded-full overflow-hidden">
                  <div
                    className="h-full bg-primary rounded-full"
                    style={{
                      width: `${(amount / monthlyExpenses) * 100}%`,
                    }}
                  />
                </div>
              </div>
              <div className="w-24 text-right">
                <span className="text-sm font-medium text-text">
                  R$ {amount.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}
                </span>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default FinancialSummary;
