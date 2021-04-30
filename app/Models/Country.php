<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    // protected $guarded=[];
    protected $fillable = ['countrycode','countryname','code'];

    public $timestamps=false;

public function book()
{
    return $this->belongsToMany(book::class);
}

}
