<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;
    
    protected $table = "calendars";

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "calendar_id",
		"name"
    ];
}
