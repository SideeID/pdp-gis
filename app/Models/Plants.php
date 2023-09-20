<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plants extends Model
{
    use HasFactory;
    protected $table = 'plants'; // mendevinisikan nama table
    protected $primaryKey = 'id'; // mendevinisikan primary key
    public $incrementing = true; // auto pada primaryKey incremment true
    public $timestamps = true; // create_at dan update_at false

    // fillable mendevinisikan field mana saja yang dapat kita isikan
    protected $guarded = [];
}
