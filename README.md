# Documentação Técnica - Lumina Finances

## Sumário
1. [Visão Geral](#1-visão-geral)
2. [Arquitetura](#2-arquitetura)
3. [Módulos e Componentes](#3-módulos-e-componentes)
4. [Fluxos Principais](#4-fluxos-principais)
5. [Padrões e Práticas](#5-padrões-e-práticas)
6. [Guia de Desenvolvimento](#6-guia-de-desenvolvimento)
7. [Exemplos](#7-exemplos)
8. [Glossário](#8-glossário)

## 1. Visão Geral

O Lumina Finances é um sistema de gerenciamento financeiro pessoal desenvolvido em Laravel. Ele permite aos usuários:
- Controlar receitas e despesas
- Definir e acompanhar metas financeiras
- Gerenciar transações recorrentes
- Categorizar transações
- Visualizar relatórios e análises financeiras

### 1.1 Stack Tecnológica

- **Backend**: Laravel 10.x (PHP 8.2+)
- **Frontend**: Blade + TailwindCSS + Alpine.js
- **Banco de Dados**: PostgreSQL
- **Ambiente**: Docker
- **Dependências**: Composer, NPM

## 2. Arquitetura

### 2.1 Estrutura MVC

O sistema segue o padrão MVC do Laravel:

```
app/
├── Http/
│   ├── Controllers/    # Controladores
│   └── Requests/      # Form Requests para validação
├── Models/            # Modelos Eloquent
├── Policies/         # Políticas de autorização
└── Observers/        # Observadores de modelos

resources/
├── views/            # Views Blade
│   ├── layouts/     # Layouts base
│   ├── components/  # Componentes reutilizáveis
│   └── ...         # Views específicas
```

### 2.2 Banco de Dados

Principais entidades e seus relacionamentos:

- User (Usuário)
  - hasMany: Transaction, Goal, Category, RecurringTransaction
- Transaction (Transação)
  - belongsTo: User, Category
- Category (Categoria)
  - belongsTo: User
  - hasMany: Transaction
- Goal (Meta)
  - belongsTo: User
- RecurringTransaction (Transação Recorrente)
  - belongsTo: User

## 3. Módulos e Componentes

### 3.1 Autenticação
- `app/Http/Controllers/Auth/*`
- Gerencia registro, login e recuperação de senha
- Utiliza o sistema de autenticação nativo do Laravel

### 3.2 Transações
- `app/Http/Controllers/TransactionController.php`
- CRUD de transações
- Validação de dados
- Categorização
- Filtros e relatórios

### 3.3 Metas Financeiras
- `app/Http/Controllers/GoalController.php`
- Criação e acompanhamento de metas
- Cálculo de progresso
- Notificações de atingimento

### 3.4 Categorias
- `app/Http/Controllers/CategoryController.php`
- Gerenciamento de categorias personalizadas
- Associação com transações
- Relatórios por categoria

### 3.5 Transações Recorrentes
- `app/Http/Controllers/RecurringTransactionController.php`
- Agendamento de transações
- Processamento automático via comando artisan
- Notificações

## 4. Fluxos Principais

### 4.1 Criação de Transação

1. Usuário acessa o dashboard
2. Clica em "Nova Transação"
3. Preenche o formulário com:
   - Descrição
   - Valor
   - Tipo (Receita/Despesa)
   - Categoria (opcional)
   - Data
4. Sistema valida os dados
5. Cria a transação
6. Atualiza o saldo e relatórios

### 4.2 Processamento de Transações Recorrentes

1. Scheduler executa comando diariamente
2. Sistema busca transações recorrentes pendentes
3. Cria novas transações
4. Notifica usuários
5. Atualiza próxima data de processamento

## 5. Padrões e Práticas

### 5.1 Convenções de Código
- PSR-12 para PHP
- BEM para CSS
- Airbnb para JavaScript

### 5.2 Padrões de Nomenclatura
```php
// Models: singular, PascalCase
class Transaction extends Model

// Controllers: plural, PascalCase + Controller
class TransactionsController extends Controller

// Tables: plural, snake_case
protected $table = 'recurring_transactions';
```

### 5.3 Validação
- Form Requests para validação complexa
- Validação inline para casos simples
- Mensagens de erro em português

## 6. Guia de Desenvolvimento

### 6.1 Estrutura de Branches
```
main           # Produção
├── develop    # Desenvolvimento
└── feature/*  # Features
    ├── fix/*  # Correções
    └── docs/* # Documentação
```

### 6.2 Commits
```
feat: nova funcionalidade
fix: correção de bug
refactor: refatoração
docs: documentação
style: formatação
chore: manutenção
```

### 6.3 Deploy
1. Merge para `develop`
2. Testes automatizados
3. Review de código
4. Merge para `main`
5. Deploy automático

## 7. Exemplos

### 7.1 Criando uma Nova Transação
```php
// TransactionController.php
public function store(Request $request)
{
    $validated = $request->validate([
        'description' => 'required|string',
        'amount' => 'required|numeric',
        'type' => 'required|in:income,expense',
        'category_id' => 'nullable|exists:categories,id'
    ]);

    $transaction = auth()->user()->transactions()->create($validated);

    return redirect()->route('dashboard')
        ->with('success', 'Transação criada com sucesso!');
}
```

### 7.2 Componente de Modal
```blade
<!-- components/modal.blade.php -->
<div x-data="{ open: false }"
     x-show="open"
     @keydown.escape.window="open = false"
     class="fixed inset-0 z-50 overflow-y-auto">
    <!-- Conteúdo do modal -->
</div>
```

## 8. Glossário

- **Alpine.js**: Framework JavaScript minimalista para comportamentos interativos
- **Blade**: Sistema de templates do Laravel
- **Eloquent**: ORM do Laravel
- **Form Request**: Classe para validação de formulários
- **Migration**: Sistema de versionamento de banco de dados
- **Policy**: Classe para autorização de ações
- **Seeder**: Classe para popular banco de dados
- **TailwindCSS**: Framework CSS utility-first

Esta documentação deve ser mantida atualizada conforme o sistema evolui. Sugestões de melhorias são bem-vindas através de pull requests na branch `docs/*`.
