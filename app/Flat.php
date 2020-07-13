<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

class Flat extends Model
{
    use Searchable;

    //
    //protected $geometry = ['geolocation'];
    //protected $geometryAsText = true;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'number_of_rooms',
        'number_of_beds',
        'number_of_bathrooms',
        'square_meters',
        'address',
        'image',
    ];

    /* Decode attribute 'geolocation' in string */
    // public function newQuery($excludeDeleted = true)
    // {
    //     if (!empty($this->geometry) && $this->geometryAsText === true)
    //     {
    //         $raw = '';
    //         foreach ($this->geometry as $column)
    //         {
    //             $raw .= 'AsText(`' . $this->table . '`.`' . $column . '`) as `' . $column . '`, ';
    //         }
    //         $raw = substr($raw, 0, -2);
    //         return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($raw));
    //     }
    //     return parent::newQuery($excludeDeleted);
    // }

    /* UTILITIES */

    // public function getGeolocation() {
    //     preg_match_all("(-?\d+.?\d*)", $this->geolocation, $matches);
    //     return $matches[0];
    // }

    // public function getLat() {
    //     return floatval($this->getGeolocation()[0]);
    // }

    // public function getLong() {
    //     return floatval($this->getGeolocation()[1]);
    // }

    // function getDistance($location) {
    //     $r = 6356.752;  // Earth radius
    //     // coordinates and distances in radians for f(lat) and l(ocation)
    //     $f_lat = $this->getLat()  * M_PI / 180;
    //     $l_lat = $location[0] * M_PI / 180;
    //     $delta_lat = ($this->getLat()  - $location[0]) * M_PI / 180;
    //     $delta_long = ($this->getLong() - $location[1]) * M_PI / 180;

    //     $raw_distance = 2 * $r * asin(sqrt(
    //         sin($delta_lat/2)**2 + cos($f_lat) * cos($l_lat) * sin($delta_long/2)**2));
    //     return intval($raw_distance);
    // }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // // Applies Scout Extended default transformations:
        $array = $this->transform($array);

        // Add an extra attribute:
        $array['_geoloc'] = [
            'lat' => $this->lat,
            'lng' => $this->lng
        ];

        return $array;
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
        return $this->belongsToMany('App\Sponsorship')->withPivot('start', 'end');
    }

    public function hasActiveSponsorship() {
        $activeSponsorships = DB::table('flat_sponsorship')
            ->where('flat_id', $this->id)
            ->where('end', '>=', date("Y-m-d H:i:s"))
            ->get();
        return $activeSponsorships->isNotEmpty();
    }

    public function getServicesId() {
        return $this->services->map(function($flat) {return $flat->id;});
    }
}
