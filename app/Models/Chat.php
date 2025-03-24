<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relationship to get receiver profile
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function receiverProfilee()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id')->select(['id', 'firstname', 'image']);
    }

    public function senderProfilee()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id')->select(['id', 'firstname', 'image']);
    }

    public function receiverSellerProfile()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id')->select(['id', 'firstname', 'image']);
    }

    public function senderSellerProfile()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id')->select(['id', 'firstname', 'image']);
    }
}
