<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Models\CategoryPosts;
use App\Models\Posts;

class PostsWebController extends Controller
{
    protected $category; 

    public function __construct()
    {
        ini_set('max_execution_time', 1200);
        $this->category = new CategoryPosts();
    }

    public function index()
    {
        $result  = Request::create('/api/listposts', 'GET');
        $rs =  Route::dispatch($result)->getContent();
        $data = json_decode($rs, true);

        return view('list_posts', compact('data'));
    }

    public function listComponent()
    {
        $result  = Request::create('/api/listposts', 'GET');
        $rs =  Route::dispatch($result)->getContent();
        $data = json_decode($rs, true);

        $posts = collect($data['data'])->map(function ($item) {
            return new Posts($item);
        });

        //dd($posts);        

        return view('posts.index', compact('posts'));
    }

    public function createData()
    {
       
        $activeCategory = $this->category->getCategoryActive();

        return view('form_input_posts', ['category' => $activeCategory]);
    }

    public function saveData(Request $request)
    {
        $title = $request->title;
        $authors = $request->authors;
        $publish_date = $request->publishdate;
        $publish_active = $request->publishactive;
        $content = $request->content;
        $idcategory = $request->idcategory;

        //dd($request);
        $response = Http::timeout(30)->post('http:/127.0.0.1:8081/api/storeposts', [
            'title' => $title,
            'authors' => $authors,
            'publishdate' => $publish_date,
            'publishactive' => $publish_active,
            'content' => $content,
            'idcategory' => $idcategory
        ]);

        $msg = json_decode($response->json(), true);

        dd($msg);

        //$result  = Request::create('/api/listposts', 'GET');
        //$rs =  Route::dispatch($result)->getContent();
        //$data = json_decode($rs, true);

        //return view('list_posts', compact('data'));
    }
}
