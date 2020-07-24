<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'title', 'content', 'is_read', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
