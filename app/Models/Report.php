<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['report_on', 'reporting_user', 'reported_user', 'reason'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
