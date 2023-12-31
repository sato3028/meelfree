<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Image;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'post_image'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function images()
    {
    return $this->hasMany(Image::class);
    }
}
