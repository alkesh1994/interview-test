<?php
namespace App\Models;

use App\Models\Day;
use App\Models\Metro;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function metro()
    {
        return $this->belongsTo(Metro::class);
    }
}
