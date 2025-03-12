<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="API Laravel 11",
 *     version="1.0.0",
 *     description="Dokumentasi API Laravel 11 menggunakan Swagger di Web Aplikasi BKI"
 * )
 *
 * @OA\Get(
 *     path="/api/checkhealth",
 *     summary="Menampilkan hasil dari pengecekan koneksi sistem ke database",
 *     tags={"Check Health"},
 *     @OA\Response(
 *         response=200,
 *         description="Sukses",
 *         @OA\JsonContent(type="array", @OA\Items(type="object"))
 *     )
 * )
 */

class HealthCheckController extends Controller
{
    public function check()
    {
        try {
            DB::connection()->getPdo();

            return response()->json([
                'status' => 'healthy',
                'database' => 'connected',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'unhealthy',
                'database' => 'disconnected',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
