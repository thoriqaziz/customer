<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Customer extends Model
{
    use Searchable;

    protected $guarded = [];

    public function url()
    {
        return '/customers/' . $this->id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
