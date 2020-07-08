<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    //

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function flats()
    {
        return $this->belongsToMany('App\Flat');
    }
}