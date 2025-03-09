<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Models\Main\Transaction;
use App\Models\Main\TransactionDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Main\TransactionResource;
use App\Models\Main\Branch;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->id())->latest()->get();

        return TransactionResource::collection($transactions);
    }

    public function branch(Branch $branch)
    {
        $transactions = Transaction::where('branch_id', $branch->id)->latest()->get();

        return TransactionResource::collection($transactions);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'nullable|string|max:255',
            'payment_type' => 'required|string',
            'total_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'payment_amount' => 'required|numeric|min:0',
            'money_amount' => 'required|numeric|min:0',
            'change_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'transactiondetails' => 'required|array',
            'transactiondetails.*.product_id' => 'required|integer|exists:products,id',
            'transactiondetails.*.total_price' => 'required|numeric|min:0',
            'transactiondetails.*.quantity' => 'required|integer|min:1'
        ]);
        $data['user_id'] = auth()->id();
        $data['invoice'] = 'WINE' . now()->format('YmdHis') . str_pad(Transaction::max('id') + 1, 5, '0', STR_PAD_LEFT);

        DB::beginTransaction();
        try {
            $transaction = Transaction::create($data);

            foreach ($data['transactiondetails'] as $transactiondetail) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $transactiondetail['product_id'],
                    'total_price' => $transactiondetail['total_price'],
                    'quantity' => $transactiondetail['quantity'],
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Transaction Created Successfully',
                'data' => new TransactionResource($transaction)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'message' => 'Transaction Created Failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Transaction $transaction)
    {
        return response()->json([
            'data' => new TransactionResource($transaction)
        ]);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'payment_type' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $transaction->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Transaction Edited Successfully',
            'data' => new TransactionResource($transaction)
        ]);
    }

    public function destroy(Transaction $transaction)
    {
        DB::beginTransaction();
        try {
            $transaction->transactiondetails()->delete();

            $transaction->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Transaction Deleted Successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'message' => 'Transaction Deleted Failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
