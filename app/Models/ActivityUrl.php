<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property string $url
 * @property string $url_hash
 * @property int $ticks
 * @property string $last_tick_at
 * @property string $created_at
 * @property string $updated_at
 */
class ActivityUrl extends Model
{
    protected $hidden = ['url_hash'];

    protected $fillable = ['url', 'url_hash', 'last_tick_at'];
}
