<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Book extends Model
{
    use HasFactory;
    protected $guarded=[];

    /**
     * Get the user that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class,'user_id');
    }
    public function countries()
    {
        return $this->belongsToMany(country::class);
    }
    public function genres()
    {
        return $this->belongsToMany(genre::class);
    }

}



