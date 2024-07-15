<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'comment',
        'user_id',
        'username',
        'blog_id',
    ];

    /**
     * Get the blog that owns the comment.
     */
    

    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blog() {
        return $this->belongsTo('App\Models\Blog');
    }
}

