<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // ============
    //  UTIL METHOD
    // ============
    function getKembalian()
    {
        return $this->pay_total - $this->total;
    }
    function getDate()
    {
        return Carbon::parse($this->date)->format('d F Y');
    }

    // ================
    //  RELATION METHOD
    // ================
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
