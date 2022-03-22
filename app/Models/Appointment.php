<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = "appointment";

    protected $fillable = [
      'title',
      'message',
      'price_expected',
      'discount',
      'status',
      'sheduled_date',
      'end_time',
      'person_id'
    ];
}
