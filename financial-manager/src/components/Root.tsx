import React from 'react';
import { useLocation, Navigate } from 'react-router-dom';
import { useApp } from '../context/AppContext';
import LandingPage from './LandingPage';

const Root: React.FC = () => {
  const { user } = useApp();
  const location = useLocation();

  // Se o usuário estiver logado e na rota principal, redireciona para o dashboard
  if (user && location.pathname === '/') {
    return <Navigate to="/dashboard" replace />;
  }

  // Se não estiver logado, mostra a landing page
  return <LandingPage />;
};

export default Root;
