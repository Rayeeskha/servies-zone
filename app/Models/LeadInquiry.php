<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsTo;
class LeadInquiry extends Model
{
    use HasFactory, SoftDeletes, BelongsTo;


    protected $guarded = [];

    public function scopeDateFilter($query, $startDate, $endDate){
        if ($startDate != null && $endDate == null) {
            return $query->whereDate('created_at',date('Y-m-d', strtotime($startDate)));
        }else{
            return $query->whereBetween('created_at',[date('Y-m-d', strtotime($startDate)), date('Y-m-d', strtotime($endDate)) ]);   
        }
    }

    

    


}
