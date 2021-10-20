<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;

class Client extends Model
{
    use HasFactory;
    public function message()
    {
        return $this->hasOne(Message::class);
    }
}
