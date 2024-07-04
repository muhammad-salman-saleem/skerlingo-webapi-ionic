<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class BlogPost extends Model
{
    //
    public function type()
    {
        return $this->belongsTo('App\BlogType', 'type_id');
    }

    public function getImage()
    {
        if (!$this->image)
            return 'https://via.placeholder.com/300/004c68/FFF?text=Image';
        return asset('/storage/blog_articles/' . $this->image);
    }


    public function getUrlAttribute(): string
    {
        return  route('blogpost_page' . (Session::get('locale') ? '_' . Session::get('locale') : ''), [$this->id, $this->alias]);
    }
}
