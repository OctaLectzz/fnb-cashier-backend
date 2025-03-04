<?php

namespace Database\Seeders\Main;

use App\Models\Main\Product;
use Illuminate\Database\Seeder;
use App\Models\Main\Transaction;
use App\Models\Main\TransactionDetail;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Rupiah
        $cash_denominations = [1000, 2000, 5000, 10000, 20000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000];

        for ($i = 1; $i <= 10; $i++) {
            $invoice = 'WINE' . now()->format('YmdHis') . str_pad(Transaction::max('id') + 1, 5, '0', STR_PAD_LEFT);
            $total_price = 0;
            $discount = rand(0, 50);
            $payment_amount = 0;
            $payment_type = ['cash', 'qris', 'others'][rand(0, 2)];

            $transaction = Transaction::create([
                'invoice' => $invoice,
                'name' => 'Customer ' . $i,
                'payment_type' => $payment_type,
                'total_price' => 0,
                'discount' => $discount,
                'payment_amount' => 0,
                'money_amount' => 0,
                'change_amount' => 0,
                'notes' => 'Sample transaction notes ' . $i
            ]);

            // Create 2-5 transactiondetails
            for ($j = 1; $j <= rand(2, 5); $j++) {
                $product = Product::inRandomOrder()->first();
                if (!$product) continue;

                $quantity = rand(1, 5);
                $subtotal = $product->purchase_price * $quantity;
                $total_price += $subtotal;

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'total_price' => $subtotal,
                    'quantity' => $quantity,
                ]);
            }

            // Discount
            $discount_value = ($discount / 100) * $total_price;
            $payment_amount = $total_price - $discount_value;

            // Money Amount
            if ($payment_type === 'cash') {
                $money_amount = collect($cash_denominations)->filter(fn($value) => $value >= $payment_amount)->sort()->first() ?? max($cash_denominations);
            } else {
                $money_amount = $payment_amount;
            }
            $change_amount = max(0, $money_amount - $payment_amount);

            $transaction->update([
                'total_price' => $total_price,
                'payment_amount' => $payment_amount,
                'money_amount' => $money_amount,
                'change_amount' => $change_amount
            ]);
        }
    }
}
