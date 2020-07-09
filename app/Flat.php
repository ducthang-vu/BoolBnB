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
        preg_match_all("(-?\d+.\d{6})", $this->geolocation, $matches);
        return $matches[0];
    }

    public function getLat() {
        return floatval($this->getGeolocation()[0][0]);
    }

    public function getLong() {
        return floatval($this->getGeolocation()[0][1]);
    }

    public function isInRange($center, $distance)
    {
        $latDist = ($this->getLat() - $center[0]) * 111;
        $longDist = ($this->getLong() - $center[1]) * 111;

        return $latDist ** 2 + $longDist ** 2 <= $distance;
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
