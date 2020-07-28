<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // Utilities
    public function getIcon()
    {
        $icons = [
            'WiFi' => '<i class="fas fa-wifi"></i>',
            'Posto Macchina' => '<i class="fas fa-car"></i>',
            'Piscina' => '<i class="fas fa-swimmer"></i>',
            'Portineria' => '<i class="fas fa-concierge-bell"></i>',
            'Sauna' => '<i class="fas fa-hot-tub"></i>',
            'Vista Mare' => '<i class="fas fa-umbrella-beach"></i>'
        ];

        return $icons[$this->type];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function flats()
    {
        return $this->belongsToMany('App\Flat');
    }
}
