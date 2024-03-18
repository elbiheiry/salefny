<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id' , 'amount' , 'months' , 'accepted' , 'reason'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function getStatusAttribute()
    {
        if ($this->accepted == 1) {
            return 'تم قبول السلفة';
        }else if ($this->accepted == 0) {
            return 'لم يتم الرد علي الطلب بعد';
        }else{
            return 'تم رفض السلفة';
        }
    }

    public function getInstallmentAttribute()
    {
        return $this->amount / $this->months;
    }
}
