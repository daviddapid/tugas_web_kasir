<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    function getItemPrice()
    {
        return $this->item->price;
    }
    function getSubTotal()
    {
        return $this->getItemPrice() * $this->qty;
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
