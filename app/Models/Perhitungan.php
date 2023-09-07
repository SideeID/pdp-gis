<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perhitungan extends Model
{
    use HasFactory;
    protected $table = 'perhitungans'; // mendevinisikan nama table
    protected $primaryKey = 'id'; // mendevinisikan primary key
    public $incrementing = true; // auto pada primaryKey incremment true
    public $timestamps = true; // create_at dan update_at false

    // fillable mendevinisikan field mana saja yang dapat kita isikan
    protected $guarded = [];

    public function parameter(){
        return $this->belongsTo(Parameter::class, 'parameter_id', 'id');
    }

    public function afdeling(){
        return $this->belongsTo(Afdeling::class, 'afdeling_id', 'id');
    }
}
