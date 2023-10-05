<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

//    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];

    public function scopeFilter($query, array $filters){
        if($filters['tag'] ?? false){
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
        if($filters['search'] ?? false){
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
            ->orWhere('tags', 'like', '%' . request('search') . '%');
        }


    }

    //explain me the function above
    //scopeFilter is a function that takes two parameters
    //the first parameter is the query
    //the second parameter is an array of filters
    //if the tag is in the array of filters
    //then the query will be filtered by the tag
    //if the search is in the array of filters
    //then the query will be filtered by the search

    //Relationship to user
    public function user(){

        return $this->belongsTo(User::class, 'user_id');
    }
}
