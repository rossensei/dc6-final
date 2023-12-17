<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $users = User::all();
        
        foreach($users as $user)
        {
            $user->wallet()->create([
                'balance' => fake()->randomFloat(2),
                'wallet_type' => fake()->randomElement(['Personal', 'Business', 'Savings'])
            ]);
        }
    }
}
