<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsTo;

class LoginHistoryLog extends Model
{
    use HasFactory, BelongsTo;

    protected $table = "login_histories_log";

    protected $guarded = [];

    

}
