<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Flat extends Model
{
    //
    protected $geometry = ['geolocation'];
    protected $geometryAsText = true;

    /* Decode attribute 'geolocation' in string */
    public function newQuery($excludeDeleted = true)
    {
        if (!empty($this->geometry) && $this->geometryAsText === true)
        {
            $raw = '';
            foreach ($this->geometry as $column)
            {
                $raw .= 'AsText(`' . $this->table . '`.`' . $column . '`) as `' . $column . '`, ';
            }
            $raw = substr($raw, 0, -2);
            return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($raw));
        }
        return parent::newQuery($excludeDeleted);
    }

    /* UTILITIES */
    public function getGeolocation() {
        preg_match_all("(-?\d+.?\d*)", $this->geolocation, $matches);
        return $matches[0];
    }

    public function getLat() {
        return floatval($this->getGeolocation()[0]);
    }

    public function getLong() {
        return floatval($this->getGeolocation()[1]);
    }

    function getDistance($location) {
        $r = 6356.752;  // Earth radius
        // coordinates and distance in radiants for f(lat) and l(ocation)
        $f_lat = $this->getLat()  * M_PI / 180;
        $l_lat = $location[0] * M_PI / 180;
        $delta_lat = ($this->getLat()  - $location[0]) * M_PI / 180;
        $delta_long = ($this->getLong() - $location[1]) * M_PI / 180;

        $raw_distance = 2 * $r * asin(sqrt(
            sin($delta_lat/2)**2 + cos($f_lat) * cos($l_lat) * sin($delta_long/2)**2));
        return intval($raw_distance);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requests()
    {
        return $this->hasMany('App\Request');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sponsorships()
    {
        return $this->belongsToMany('App\Sponsorship');
    }
}
