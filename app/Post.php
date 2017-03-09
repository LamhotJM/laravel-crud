<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	//Create column names
	protected $fillable = ['title', 'content'];

    //User belogns to post
    public function user()
    {
    	return $this->belognsTo(User::class);
    }
}
