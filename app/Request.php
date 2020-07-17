<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    public static function getRequestByUser($id) {
        $flats = User::find($id)->flats;
        return $flats->map(function($flat) {
            return $flat->requests;
        })->flatten();
    }

    protected $fillable = [
        'flat_id',
        'surname',
        'name',
        'email',
        'message'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flat()
    {
        return $this->belongsTo('App\Flat');
    }
}
