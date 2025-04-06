import React, { useState } from 'react';
import { useApp } from '../context/AppContext';
import { useNavigate } from 'react-router-dom';
import { User } from '../types';
import { BarChart3, DollarSign, LogIn } from 'lucide-react';

const Login: React.FC = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const { dispatch } = useApp();
  const navigate = useNavigate();

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    // TODO: Implement actual login logic
    const mockUser: User = {
      id: 1,
      name: 'Test User',
      email: email,
      profiles: [
        {
          id: 1,
          name: 'Personal',
          type: 'personal'
        }
      ]
    };
    dispatch({ type: 'SET_USER', payload: mockUser });
    navigate('/');
  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-background py-12 px-4 sm:px-6 lg:px-8">
      <div className="max-w-md w-full space-y-8 bg-white p-8 rounded-xl shadow-lg animate-fade-in">
        <div>
          <div className="flex justify-center items-center space-x-2">
            <BarChart3 className="h-8 w-8 text-primary" />
            <DollarSign className="h-8 w-8 text-success" />
          </div>
          <h2 className="mt-6 text-center text-3xl font-bold text-text">
            Planejador Financeiro
          </h2>
          <p className="mt-2 text-center text-sm text-text-muted">
            Controle suas finanças de forma simples e eficiente
          </p>
        </div>
        <form className="mt-8 space-y-6" onSubmit={handleSubmit}>
          <div className="rounded-xl shadow-sm -space-y-px">
            <div>
              <label htmlFor="email-address" className="sr-only">
                Email
              </label>
              <input
                id="email-address"
                name="email"
                type="email"
                autoComplete="email"
                required
                className="appearance-none rounded-t-xl relative block w-full px-4 py-3 border border-gray-300 placeholder-text-muted text-text focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:z-10 text-sm md:text-base transition-all"
                placeholder="Seu email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
              />
            </div>
            <div>
              <label htmlFor="password" className="sr-only">
                Senha
              </label>
              <input
                id="password"
                name="password"
                type="password"
                autoComplete="current-password"
                required
                className="appearance-none rounded-b-xl relative block w-full px-4 py-3 border border-gray-300 placeholder-text-muted text-text focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:z-10 text-sm md:text-base transition-all"
                placeholder="Sua senha"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
              />
            </div>
          </div>

          <div>
            <button
              type="submit"
              className="group relative w-full flex justify-center items-center py-3 px-4 border border-transparent text-sm md:text-base font-medium rounded-xl text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-150 ease-in-out"
            >
              <LogIn className="w-5 h-5 mr-2" />
              Entrar
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default Login;
