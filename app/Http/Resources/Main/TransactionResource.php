<?php

namespace App\Http\Resources\Main;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice' => $this->invoice,
            'name' => $this->name,
            'payment_type' => $this->payment_type,
            'total_price' => $this->total_price,
            'discount' => $this->discount,
            'payment_amount' => $this->payment_amount,
            'money_amount' => $this->money_amount,
            'change_amount' => $this->change_amount,
            'notes' => $this->notes,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),

            'transactiondetails' => $this->transactiondetails->map(function ($transactiondetail) {
                return [
                    'id' => $transactiondetail->id,
                    'transaction_id' => $transactiondetail->transaction_id,
                    'product_id' => $transactiondetail->product_id,
                    'product_image' => $transactiondetail->product->image ?? null,
                    'product_name' => $transactiondetail->product->name ?? null,
                    'product_price' => $transactiondetail->product->purchase_price ?? null,
                    'total_price' => $transactiondetail->total_price,
                    'quantity' => $transactiondetail->quantity,
                    'created_at' => $transactiondetail->created_at->format('Y-m-d H:i:s')
                ];
            })
        ];
    }
}
