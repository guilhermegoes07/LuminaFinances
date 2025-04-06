import React from 'react';
import { useNavigate } from 'react-router-dom';
import {
  BarChart3,
  PieChart,
  Target,
  TrendingUp,
  Bell,
  Shield,
  Smartphone,
  Users,
  CheckCircle2
} from 'lucide-react';
import Navbar from './Navbar';

const LandingPage: React.FC = () => {
  const navigate = useNavigate();

  const features = [
    {
      icon: <BarChart3 className="w-8 h-8 text-primary" />,
      title: 'Dashboard Intuitivo',
      description: 'Visualize suas finanças de forma clara e objetiva com gráficos e indicadores personalizados.'
    },
    {
      icon: <PieChart className="w-8 h-8 text-primary" />,
      title: 'Categorização Inteligente',
      description: 'Organize suas despesas e receitas automaticamente em categorias personalizáveis.'
    },
    {
      icon: <Target className="w-8 h-8 text-primary" />,
      title: 'Metas Financeiras',
      description: 'Estabeleça objetivos e acompanhe seu progresso rumo à independência financeira.'
    },
    {
      icon: <TrendingUp className="w-8 h-8 text-primary" />,
      title: 'Análise de Investimentos',
      description: 'Acompanhe o desempenho dos seus investimentos e receba sugestões personalizadas.'
    },
    {
      icon: <Bell className="w-8 h-8 text-primary" />,
      title: 'Alertas Personalizados',
      description: 'Receba notificações sobre gastos, vencimentos e oportunidades de economia.'
    },
    {
      icon: <Shield className="w-8 h-8 text-primary" />,
      title: 'Segurança Avançada',
      description: 'Seus dados financeiros protegidos com a mais alta tecnologia de criptografia.'
    }
  ];

  const plans = [
    {
      name: 'Básico',
      price: 'Grátis',
      features: [
        'Dashboard básico',
        'Controle de despesas',
        'Metas financeiras',
        'Suporte por email'
      ]
    },
    {
      name: 'Premium',
      price: 'R$ 19,90/mês',
      features: [
        'Todas as funcionalidades básicas',
        'Análise de investimentos',
        'Alertas personalizados',
        'Relatórios avançados',
        'Suporte prioritário'
      ],
      highlighted: true
    },
    {
      name: 'Empresarial',
      price: 'R$ 49,90/mês',
      features: [
        'Todas as funcionalidades premium',
        'Múltiplos usuários',
        'API de integração',
        'Gestor de conta dedicado',
        'Personalização avançada'
      ]
    }
  ];

  return (
    <div className="min-h-screen bg-background">
      <Navbar />

      {/* Hero Section */}
      <section className="pt-20 pb-32 px-4">
        <div className="container mx-auto text-center">
          <h1 className="text-5xl font-bold text-text mb-6">
            Transforme sua vida financeira
          </h1>
          <p className="text-xl text-text-light mb-12 max-w-2xl mx-auto">
            Gerencie suas finanças de forma inteligente, estabeleça metas e alcance sua independência financeira com o Lumina Finances.
          </p>
          <div className="flex justify-center space-x-6">
            <button
              onClick={() => navigate('/signup')}
              className="bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl text-lg font-semibold transition-all duration-150 ease-in-out shadow-lg hover:shadow-xl"
            >
              Comece Agora - É Grátis!
            </button>
          </div>
        </div>
      </section>

      {/* Features Section */}
      <section id="features" className="py-20 bg-white">
        <div className="container mx-auto px-4">
          <h2 className="text-4xl font-bold text-text text-center mb-16">
            Funcionalidades Poderosas
          </h2>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            {features.map((feature, index) => (
              <div
                key={index}
                className="p-6 bg-background rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300"
              >
                <div className="mb-4">{feature.icon}</div>
                <h3 className="text-xl font-semibold text-text mb-3">
                  {feature.title}
                </h3>
                <p className="text-text-light">
                  {feature.description}
                </p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Benefits Section */}
      <section id="benefits" className="py-20">
        <div className="container mx-auto px-4">
          <h2 className="text-4xl font-bold text-text text-center mb-16">
            Por que escolher o Lumina Finances?
          </h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div className="space-y-8">
              <div className="flex items-start space-x-4">
                <Smartphone className="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                <div>
                  <h3 className="text-xl font-semibold text-text mb-2">
                    Acesso em Qualquer Lugar
                  </h3>
                  <p className="text-text-light">
                    Gerencie suas finanças de qualquer dispositivo, a qualquer momento.
                  </p>
                </div>
              </div>
              <div className="flex items-start space-x-4">
                <Users className="w-6 h-6 text-primary flex-shrink-0 mt-1" />
                <div>
                  <h3 className="text-xl font-semibold text-text mb-2">
                    Perfeito para Famílias
                  </h3>
                  <p className="text-text-light">
                    Compartilhe o controle financeiro com sua família de forma segura.
                  </p>
                </div>
              </div>
            </div>
            <div className="relative">
              {/* Placeholder para uma imagem ou ilustração */}
              <div className="bg-primary/10 rounded-xl h-96 flex items-center justify-center">
                <BarChart3 className="w-32 h-32 text-primary" />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Pricing Section */}
      <section id="pricing" className="py-20 bg-white">
        <div className="container mx-auto px-4">
          <h2 className="text-4xl font-bold text-text text-center mb-16">
            Planos para Todos os Perfis
          </h2>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {plans.map((plan, index) => (
              <div
                key={index}
                className={`p-8 rounded-xl shadow-lg ${
                  plan.highlighted
                    ? 'bg-primary text-white transform scale-105'
                    : 'bg-background'
                }`}
              >
                <h3 className={`text-2xl font-bold mb-4 ${
                  plan.highlighted ? 'text-white' : 'text-text'
                }`}>
                  {plan.name}
                </h3>
                <p className={`text-3xl font-bold mb-8 ${
                  plan.highlighted ? 'text-white' : 'text-primary'
                }`}>
                  {plan.price}
                </p>
                <ul className="space-y-4 mb-8">
                  {plan.features.map((feature, featureIndex) => (
                    <li key={featureIndex} className="flex items-center space-x-3">
                      <CheckCircle2 className={`w-5 h-5 ${
                        plan.highlighted ? 'text-white' : 'text-success'
                      }`} />
                      <span className={plan.highlighted ? 'text-white' : 'text-text-light'}>
                        {feature}
                      </span>
                    </li>
                  ))}
                </ul>
                <button
                  className={`w-full py-3 rounded-xl transition-all duration-150 ${
                    plan.highlighted
                      ? 'bg-white text-primary hover:bg-gray-100'
                      : 'bg-primary text-white hover:bg-primary-dark'
                  }`}
                  onClick={() => navigate('/signup')}
                >
                  Começar Agora
                </button>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Footer */}
      <footer className="bg-text py-12">
        <div className="container mx-auto px-4">
          <div className="flex justify-between items-center">
            <div className="flex items-center space-x-2">
              <BarChart3 className="h-8 w-8 text-white" />
              <span className="text-xl font-bold text-white">Lumina Finances</span>
            </div>
            <div className="text-white text-sm">
              © 2024 Lumina Finances. Todos os direitos reservados.
            </div>
          </div>
        </div>
      </footer>
    </div>
  );
};

export default LandingPage;
