import React from 'react';

const Navbar: React.FC = () => {
  return (
    <nav className="bg-white shadow-lg">
      <div className="container mx-auto px-4">
        <div className="flex justify-between items-center h-16">
          <div className="flex items-center">
            <span className="text-xl font-bold text-gray-800">FinanceManager</span>
          </div>

          <div className="hidden md:flex items-center space-x-8">
            <a href="#" className="text-gray-600 hover:text-gray-800">Dashboard</a>
            <a href="#" className="text-gray-600 hover:text-gray-800">Transações</a>
            <a href="#" className="text-gray-600 hover:text-gray-800">Objetivos</a>
            <a href="#" className="text-gray-600 hover:text-gray-800">Relatórios</a>
          </div>

          <div className="flex items-center space-x-4">
            <button className="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
              Nova Transação
            </button>
            <div className="relative">
              <button className="flex items-center space-x-2 text-gray-600 hover:text-gray-800">
                <span>Perfil</span>
                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>

      {/* Menu Mobile */}
      <div className="md:hidden">
        <div className="px-2 pt-2 pb-3 space-y-1">
          <a href="#" className="block px-3 py-2 text-gray-600 hover:text-gray-800">Dashboard</a>
          <a href="#" className="block px-3 py-2 text-gray-600 hover:text-gray-800">Transações</a>
          <a href="#" className="block px-3 py-2 text-gray-600 hover:text-gray-800">Objetivos</a>
          <a href="#" className="block px-3 py-2 text-gray-600 hover:text-gray-800">Relatórios</a>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
