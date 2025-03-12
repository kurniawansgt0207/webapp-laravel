<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class Posts extends Model
{
    use HasFactory;
   
    protected $fillable = [     
        'title',
        'authors',
        'publish_date',
        'publish_active',
        'content',
        'id_category'
    ];

    public function findPostsByAuthor(string $keyword)
    {
        $sql = "SELECT * FROM posts WHERE authors LIKE :authors";

        $rs = DB::select($sql, ['authors' => '%'.$keyword.'%']);

        /*$pdo = DB::connection()->getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['authors' => '%'.$keyword.'%']);

        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);*/

        return $rs;
    }
}
