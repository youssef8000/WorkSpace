<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'senderEmail',
        'receiveEmail',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'senderEmail', 'email');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiveEmail', 'email');
    }
}
