<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Posts;

/**
 * @OA\Get(
 *     path="/api/listposts",
 *     summary="Menampilkanseluruh data dari tabel Posts",
 *     tags={"Posts"},
 *     @OA\Response(
 *         response=202,
 *         description="Sukses",
 *         @OA\JsonContent(type="array", @OA\Items(type="object"))
 *     )
 * )
 * 
 *  @OA\Get(
 *     path="/api/findposts/{id}",
 *     summary="Menampilkan data dari tabel Posts berdasarkan ID Data (Primary Key)",
 *     tags={"Posts"},
 *     @OA\Parameter(
*         name="id",
*         in="path",
*         description="ID Posts",
*         required=true,
*         @OA\Schema(type="integer")
*      ),
 *     @OA\Response(
 *         response=202,
 *         description="Sukses",
 *         @OA\JsonContent(type="array", @OA\Items(type="object"))
 *     )
 * )
 **  @OA\Post(
 *     path="/api/storeposts",
 *     summary="Menyimpan input data Posts",
 *     tags={"Posts"},
*      @OA\RequestBody(
*         required=true,
*         @OA\MediaType(
*             mediaType="multipart/form-data",
*             @OA\Schema(
*                 
*                 @OA\Property(
*                     property="title",
*                     type="string",
*                     example="Judul Artikel",
*                     description="Judul artikel/posts"
*                 ),
*                 @OA\Property(
*                     property="authors",
*                     type="string",
*                     example="John Dee",
*                     description="Nama penulis artikel/posts"
*                 ),
*                 @OA\Property(
*                     property="publishdate",
*                     type="date",
*                     example="2025-02-10",
*                     description="Tanggal publish artikel/posts"
*                 ),
*                 @OA\Property(
*                     property="publishactive",
*                     type="number",
*                     example="1",
*                     description="Status publish artikel/posts"
*                 ),
*                 @OA\Property(
*                     property="content",
*                     type="text",
*                     example="Bla...Bla...Bla",
*                     description="Isi konten artikel/posts"
*                 ),
*                 @OA\Property(
*                     property="idcatgegory",
*                     type="number",
*                     example="2",
*                     description="ID Kategori artikel/posts"
*                 ),
*             )
*         )
*     ),
 *     @OA\Response(
 *         response=202,
 *         description="Sukses",
 *         @OA\JsonContent(type="array", @OA\Items(type="object"))
 *     )
 * )
 */

class PostsController extends Controller
{
    public function storeData(Request $request)
    {
        $title = $request->title;
        $authors = $request->authors;
        $publish_date = $request->publishdate;
        $publish_active = $request->publishactive;
        $content = $request->content;
        $idcategory = $request->idcategory;

        //dd($request);
        Posts::create([
            'title' => $title,
            'authors' => $authors,
            'publish_date' => $publish_date,
            'publish_active' => $publish_active,
            'content' => $content,
            'id_category' => $idcategory
        ]);

        return response()->json([
            'status' => 'Data Tersimpan',
        ], 200);
    }

    public function listData()
    {
        $listPosts = Posts::all();

        return response()->json([
            'data' => $listPosts,
            'status' => 'Ok'
        ], 202);
    }

    public function findData(string $id)
    {
        $PostsData = Posts::findOrFail($id);

        return response()->json([
            'data' => $PostsData,
            'status' => 'Ok'
        ], 202);
    }

    public function findByAuthors($keyword)
    {
        $posts = new Posts();
        $PostsData = $posts->findPostsByAuthor($keyword);

        return response()->json([
            'data' => $PostsData,
            'status' => 'Ok'
        ], 202);
    }

    public function deleteData($id)
    {
        $posts = Posts::findOrFail($id);
        $posts->delete();

        return response()->json([
            'pesan' => 'Dara Berhasil Terhapus',
            'status' => 'Ok'
        ], 202);
    }

    //public function updateData(Request $request) // jika pakai method POST
    public function updateData(Request $request, string $id)
    {
        //$posts = Posts::findOrFail($request->id); // jika pakai method POST
        $posts = Posts::findOrFail($id);
        
        $title = $request->title;
        $authors = $request->authors;
        $publish_date =$request->publishdate;
        $publish_active = $request->publishactive;
        $content = $request->content;
        $id_category = $request->idcategory;

        $posts->update([
            'title' => $title,
            'authors' => $authors,
            'publish_date' => $publish_date,
            'publish_active' => $publish_active,
            'id_category' => $id_category,
            'content' => $content,
        ]);

        return response()->json([
            'status' => 'Data Berhasil Terupdate',
            'data' => $posts,
        ], 200);
    }
}
