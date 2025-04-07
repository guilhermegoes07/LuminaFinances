import React from 'react';
import { Goal } from '../types';

interface FinancialGoalsProps {
  goals: Goal[];
  onAddProgress: (goalId: string, amount: number) => void;
}

const FinancialGoals: React.FC<FinancialGoalsProps> = ({ goals, onAddProgress }) => {
  const getProgressColor = (progress: number) => {
    if (progress >= 75) return 'bg-green-600';
    if (progress >= 50) return 'bg-blue-600';
    if (progress >= 25) return 'bg-yellow-600';
    return 'bg-red-600';
  };

  return (
    <div className="bg-white rounded-lg shadow p-6">
      <div className="flex justify-between items-center mb-6">
        <h2 className="text-xl font-semibold text-gray-800">Objetivos Financeiros</h2>
        <button className="text-sm text-blue-600 hover:text-blue-800">
          + Novo Objetivo
        </button>
      </div>

      <div className="space-y-6">
        {goals.map((goal) => {
          const progressColor = getProgressColor(goal.progress);

          return (
            <div key={goal.id} className="border-b pb-6">
              <div className="flex justify-between items-start mb-2">
                <div>
                  <h3 className="font-medium text-gray-900">{goal.name}</h3>
                </div>
                <div className="text-right">
                  <p className="text-sm font-medium text-gray-900">
                    Meta: R$ {goal.target.toLocaleString('pt-BR')}
                  </p>
                  <p className="text-sm text-gray-500">
                    Progresso: {goal.progress}%
                  </p>
                </div>
              </div>

              <div className="relative pt-1">
                <div className="flex mb-2 items-center justify-between">
                  <div>
                    <span className="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200">
                      Progresso
                    </span>
                  </div>
                  <div className="text-right">
                    <span className="text-xs font-semibold inline-block text-blue-600">
                      {goal.progress}%
                    </span>
                  </div>
                </div>
                <div className="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                  <div
                    style={{ width: `${goal.progress}%` }}
                    className={`shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center ${progressColor}`}
                  ></div>
                </div>
              </div>

              <div className="flex justify-end space-x-2">
                <button
                  onClick={() => onAddProgress(goal.id, 10)}
                  className="px-3 py-1 text-sm text-blue-600 hover:text-blue-800 font-medium"
                >
                  + Adicionar Progresso
                </button>
                <button className="px-3 py-1 text-sm text-gray-600 hover:text-gray-800 font-medium">
                  Editar
                </button>
              </div>
            </div>
          );
        })}
      </div>
    </div>
  );
};

export default FinancialGoals;
