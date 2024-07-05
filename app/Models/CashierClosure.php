<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CashierClosure extends Model
{
    use HasFactory;

    protected $table = 'cashier_closures';

    protected $fillable = [
        'user_id','amount_start','deposit','output','cash_sale','credit_sale','cash_purchase','buy_credit','missing_balance','remaining_balance','cash_balance','status'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });

        static::updating(function ($model) {
            if (!$model->user_id) {
                $model->user_id = Auth::id();
            }
        });
    }

}
