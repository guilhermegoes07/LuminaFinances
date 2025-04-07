import React from 'react';
import { useNavigate } from 'react-router-dom';
import { BarChart3, DollarSign, LogIn, UserPlus } from 'lucide-react';

const Navbar: React.FC = () => {
  const navigate = useNavigate();

  return (
    <nav className="bg-white shadow-lg">
      <div className="container mx-auto px-4">
        <div className="flex justify-between items-center h-16">
          {/* Logo */}
          <div className="flex items-center space-x-2 cursor-pointer" onClick={() => navigate('/')}>
            <div className="flex items-center space-x-1">
              <BarChart3 className="h-8 w-8 text-primary" />
              <DollarSign className="h-8 w-8 text-success" />
            </div>
            <span className="text-xl font-bold text-text">Lumina Finances</span>
          </div>

          {/* Navigation Links */}
          <div className="hidden md:flex items-center space-x-8">
            <a href="#features" className="text-text-light hover:text-primary transition-colors duration-150">
              Funcionalidades
            </a>
            <a href="#benefits" className="text-text-light hover:text-primary transition-colors duration-150">
              Benefícios
            </a>
            <a href="#pricing" className="text-text-light hover:text-primary transition-colors duration-150">
              Planos
            </a>
          </div>

          {/* Auth Buttons */}
          <div className="flex items-center space-x-4">
            <button
              onClick={() => navigate('/login')}
              className="flex items-center space-x-2 text-text-light hover:text-primary transition-colors duration-150"
            >
              <LogIn className="w-5 h-5" />
              <span>Entrar</span>
            </button>
            <button
              onClick={() => navigate('/register')}
              className="flex items-center space-x-2 bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-xl transition-all duration-150 ease-in-out"
            >
              <UserPlus className="w-5 h-5" />
              <span>Criar Conta</span>
            </button>
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
