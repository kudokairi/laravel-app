<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    protected $fillable = [
        'body',
    ];

    public function articles(): BelongsTo
    {
        return $this->belongsTo('App\Article');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User','reply_user_id');
    }

}
