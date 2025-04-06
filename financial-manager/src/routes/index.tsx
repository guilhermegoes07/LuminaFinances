import React from 'react';
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import Dashboard from '../components/Dashboard';
import Login from '../components/Login';
import { useApp } from '../context/AppContext';
import Layout from '../components/Layout';

const PrivateRoute: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const { state } = useApp();
  return state.currentUser ? <>{children}</> : <Navigate to="/login" />;
};

const Router: React.FC = () => {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/login" element={<Login />} />
        <Route
          path="/"
          element={
            <Layout>
              <PrivateRoute>
                <Dashboard />
              </PrivateRoute>
            </Layout>
          }
        />
        {/* Adicione mais rotas aqui */}
      </Routes>
    </BrowserRouter>
  );
};

export default Router;
