<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as FacadesDB;

class CategoryPosts extends Model
{
    protected $fillable = [
        'category_name','category_active'
    ];

    public function getAllCategory()
    {
        $rs = CategoryPosts::All();

        return $rs;
    }

    public function getCategoryActive()
    {
        $rs = CategoryPosts::where('category_active',1)->get();

        return $rs;
    }

    public function getCategoryNonActive()
    {
        $rs = CategoryPosts::where('category_active',0)->get();

        return $rs;
    }

    public function getPostsCategory()
    {
        $rs = FacadesDB::table('posts')
        ->join('category_posts','posts.id_category','=','category_posts.id')
        ->select('posts.title','posts.authors','posts.publish_date','category_posts.category_name')
        ->get();

        return $rs;
    }
}
