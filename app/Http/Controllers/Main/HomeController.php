<?php

namespace App\Http\Controllers\Main;

use Carbon\Carbon;
use App\Models\Main\Product;
use App\Models\Main\Category;
use App\Models\Main\Transaction;
use App\Http\Controllers\Controller;
use App\Models\Main\TransactionDetail;

class HomeController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalTransactions = Transaction::count();

        // Calculate today's total transactions
        $todayTotal = Transaction::whereDate('created_at', Carbon::today())
            ->sum('payment_amount');

        // Calculate today's products sold
        $productsSold = TransactionDetail::whereDate('created_at', Carbon::today())
            ->sum('quantity');

        // Calculate this month's total transactions
        $monthTotal = Transaction::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('payment_amount');

        // Statistics on total transactions per day for the last 1 month
        $transactionsPerDay = [];
        for ($i = 0; $i < 30; $i++) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $transactionsPerDay[] = Transaction::whereDate('created_at', $date)->sum('payment_amount');
        }
        $transactionsPerDay = array_reverse($transactionsPerDay);

        return response()->json([
            'total_products' => $totalProducts,
            'total_categories' => $totalCategories,
            'total_transactions' => $totalTransactions,
            'total_today' => $todayTotal,
            'total_this_month' => $monthTotal,
            'transactions_per_day' => $transactionsPerDay,
            'products_sold' => $productsSold
        ]);
    }
}
