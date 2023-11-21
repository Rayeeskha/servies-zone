<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsTo;

class PaymentDetail extends Model
{
    use HasFactory, SoftDeletes, BelongsTo;

    protected $table = "payment_details";

    protected $guarded = [];
}
