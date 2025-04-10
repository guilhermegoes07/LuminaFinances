<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Categorias de despesas
            Category::create([
                'user_id' => $user->id,
                'name' => 'Alimentação',
                'type' => 'expense',
            ]);

            Category::create([
                'user_id' => $user->id,
                'name' => 'Transporte',
                'type' => 'expense',
            ]);

            Category::create([
                'user_id' => $user->id,
                'name' => 'Moradia',
                'type' => 'expense',
            ]);

            Category::create([
                'user_id' => $user->id,
                'name' => 'Lazer',
                'type' => 'expense',
            ]);

            Category::create([
                'user_id' => $user->id,
                'name' => 'Saúde',
                'type' => 'expense',
            ]);

            // Categorias de receitas
            Category::create([
                'user_id' => $user->id,
                'name' => 'Salário',
                'type' => 'income',
            ]);

            Category::create([
                'user_id' => $user->id,
                'name' => 'Freelance',
                'type' => 'income',
            ]);

            Category::create([
                'user_id' => $user->id,
                'name' => 'Investimentos',
                'type' => 'income',
            ]);
        }
    }
}
