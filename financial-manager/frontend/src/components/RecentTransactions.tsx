import React from 'react';
import { useApp } from '../context/AppContext';
import { Clock, TrendingUp, TrendingDown, MoreVertical } from 'lucide-react';
import { Transaction } from '../types';

const RecentTransactions: React.FC = () => {
  const { transactions } = useApp();

  const recentTransactions = transactions
    .sort((a: Transaction, b: Transaction) => new Date(b.date).getTime() - new Date(a.date).getTime())
    .slice(0, 5);

  const getTransactionIcon = (type: string) => {
    return type === 'income' ? (
      <TrendingUp className="w-5 h-5 text-success" />
    ) : (
      <TrendingDown className="w-5 h-5 text-danger" />
    );
  };

  return (
    <div className="bg-white rounded-xl shadow-lg p-6">
      <div className="flex items-center justify-between mb-6">
        <div className="flex items-center space-x-3">
          <Clock className="w-6 h-6 text-primary" />
          <h2 className="text-xl font-semibold text-text">Últimas Transações</h2>
        </div>
        <button className="text-text-light hover:text-primary transition-colors duration-150">
          <MoreVertical className="w-5 h-5" />
        </button>
      </div>

      <div className="space-y-4">
        {recentTransactions.map((transaction) => (
          <div
            key={transaction.id}
            className="flex items-center justify-between p-4 border-b border-background last:border-0 hover:bg-background/5 rounded-lg transition-colors duration-150"
          >
            <div className="flex items-center space-x-4">
              <div className="p-2 bg-background rounded-lg">
                {getTransactionIcon(transaction.type)}
              </div>
              <div>
                <p className="font-medium text-text">{transaction.description}</p>
                <div className="flex items-center space-x-2 text-sm text-text-light">
                  <span>{new Date(transaction.date).toLocaleDateString('pt-BR')}</span>
                  <span>•</span>
                  <span>{transaction.categoryId}</span>
                </div>
              </div>
            </div>
            <div className="text-right">
              <p className={`font-medium ${
                transaction.type === 'income' ? 'text-success' : 'text-danger'
              }`}>
                {transaction.type === 'income' ? '+' : '-'} R$ {transaction.amount.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}
              </p>
              <p className="text-xs text-text-light">
                {transaction.type === 'income' ? 'Receita' : 'Despesa'}
              </p>
            </div>
          </div>
        ))}
      </div>

      {recentTransactions.length === 0 && (
        <div className="text-center py-8">
          <p className="text-text-light">Nenhuma transação recente</p>
        </div>
      )}
    </div>
  );
};

export default RecentTransactions;
