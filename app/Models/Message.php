<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Sentence;
use App\Models\Carpenter;

class Message extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function sentence()
    {
        return $this->hasOne(Sentence::class);
    }

    public function carpenter()
    {
        return $this->hasMany(Carpenter::class);
    }
}
