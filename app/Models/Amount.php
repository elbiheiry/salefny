<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount' , 'status'
    ];

    public function get_status()
    {
        if ($this->status == '1') {
            return 'مفعل';
        }else{
            return 'غير مفعل';
        }
    }
}
