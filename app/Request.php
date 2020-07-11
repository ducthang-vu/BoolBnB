<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

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
