<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = [
            ['description' => 'Salary', 'amount' => 5000, 'transaction_date' => '2024-08-01'],
            ['description' => 'Groceries', 'amount' => -150, 'transaction_date' => '2024-08-02'],
            ['description' => 'Electricity Bill', 'amount' => -75, 'transaction_date' => '2024-08-03'],
            ['description' => 'Internet Bill', 'amount' => -50, 'transaction_date' => '2024-08-04'],
        ];

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }
    }
}
