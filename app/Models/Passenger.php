<?php
namespace App\Models;

use App\Models\Flight;
use App\Models\Registration;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

}
