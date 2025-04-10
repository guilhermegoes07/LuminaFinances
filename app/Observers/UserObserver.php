<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Category;

class UserObserver
{
    public function created(User $user)
    {
        $categories = [
            // Categorias de receitas
            ['name' => 'Salário', 'type' => 'income', 'user_id' => $user->id],
            ['name' => 'Freelance', 'type' => 'income', 'user_id' => $user->id],
            ['name' => 'Investimentos', 'type' => 'income', 'user_id' => $user->id],
            ['name' => 'Dividendos', 'type' => 'income', 'user_id' => $user->id],
            ['name' => 'Aluguel', 'type' => 'income', 'user_id' => $user->id],
            ['name' => 'Vendas', 'type' => 'income', 'user_id' => $user->id],
            ['name' => 'Presentes', 'type' => 'income', 'user_id' => $user->id],
            ['name' => 'Reembolsos', 'type' => 'income', 'user_id' => $user->id],
            ['name' => 'Outros', 'type' => 'income', 'user_id' => $user->id],

            // Categorias de despesas
            ['name' => 'Alimentação', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Supermercado', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Restaurante', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Moradia', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Aluguel', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Condomínio', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Contas', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Água', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Luz', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Internet', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Transporte', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Combustível', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Ônibus', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Táxi', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Lazer', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Cinema', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Viagens', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Saúde', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Plano de Saúde', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Medicamentos', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Educação', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Cursos', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Livros', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Vestuário', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Roupas', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Calçados', 'type' => 'expense', 'user_id' => $user->id],
            ['name' => 'Outros', 'type' => 'expense', 'user_id' => $user->id],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
