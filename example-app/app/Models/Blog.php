<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'username',
        'user_id',
        'image'
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'comments' => 'array', // Cast the JSON comments field to an array
    ];


    // The hasMany() method returns an instance of the Laravel HasMany relationship. 
    // This instance represents the association between the Blog model and the Comment model.
    //  It allows you to perform various operations and queries related to this relationship, such as retrieving all comments belonging to a specific blog post.

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
}
