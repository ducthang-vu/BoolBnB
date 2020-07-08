<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{

    /* UTILITIES */
    public function getHoursDurationAsStr() {
        preg_match( '/^\d\d/' , $this->duration, $matches);
        return $matches[0];
    }
    public function getHoursDurationAsFloat() {
        return intval($this->getHoursDurationAsStr());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function flats()
    {
        return $this->belongsToMany('App\Flat');
    }
}
