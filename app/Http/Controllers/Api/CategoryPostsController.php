<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryPosts;

class CategoryPostsController extends Controller
{
    public function index()
    {
        $rs = CategoryPosts::all();
        return response()->json([
            'data' => $rs,
            'status' => 'Ok'
        ], 202);
    }

    public function store(Request $request)
    {
        $categoryPosts = CategoryPosts::create([
            'category_name' => $request->category_name,
            'category_active' => $request->category_active,
        ]);

        $id = $categoryPosts->id;

        return response()->json([
            'id' => $id,
            'status' => 'Data Tersimpan',
        ], 200);
    }

    public function create()
    {
        
    }

    public function show($param)
    {
        $rs = CategoryPosts::where('id', $param)->get();

        return response()->json([
            'data' => $rs,
            'status' => 'Ok',
        ], 202);
    }

    public function update()
    {
        
    }

    public function destroy()
    {
        
    }

    public function edit()
    {
        
    }
}
