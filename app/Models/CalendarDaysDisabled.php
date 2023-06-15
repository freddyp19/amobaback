<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarDaysDisabled extends Model
{
    use HasFactory;
    
    protected $table = "calendar_days_disableds";

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "calendar_id",
		"day",
		"enabled"
    ];
}
