<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'title',
        'content',
        'is_active',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The roles that belong to the event.
     */
    public function events()
    {
        return $this->belongsToMany('App\Models\Entities\Event');
    }
}
