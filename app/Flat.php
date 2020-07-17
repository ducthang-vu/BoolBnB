<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

class Flat extends Model
{
    use Searchable;

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

    /* UTILITIES */
    public function getLatLngAsStr() {

        return $this->lat . '-' . $this->lng;
    }

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
        $array = $this->transform($array);
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

    public function getNumberOfRequests() {
        return $this->requests()->count();
    }
}
