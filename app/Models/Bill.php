<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount' , 'loan_id' , 'status' , 'payment_date'
    ];

    protected $dates = ['payment_date'];

    public function get_status()
    {
        if ($this->status == 'pending') {
            return 'لم يتم السداد بعد';
        }else{
            return 'تم السداد';
        }
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
