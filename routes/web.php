<?php

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/detail/{slug}', [ProductController::class, 'detail']);

Route::get('/post', function () {
    $query = DB::table('posts')
        ->select('id', 'name', 'view')
        ->orderBy('view', 'desc')
        ->limit(10);
    $data = $query->get();
    foreach ($data as $post) echo "<p>{$post->name}</p>";
});

Route::get('/postnew', function () {
    $query = DB::table('posts')
        ->select('id', 'name', 'content', 'created_at')
        ->orderBy('created_at', 'desc')
        ->limit(10);
    $data = $query->get();
    return view('client.post.postnew', ['data' => $data]);
});

Route::get('/post/{id}', function ($id) {
    $data = DB::table('posts')
        ->where('id', $id)
        ->first();
    return view('client.post.detailpost', ['data' => $data]);
});

Route::get('/categoryposts/{id}', function ($id) {

    $query = DB::table('posts')
        ->select('id', 'name', 'created_at')
        ->where('id_categori_post', '=', $id)
        ->orderBy('created_at', 'desc');
    $data = $query->get();
    return view('client.post.categoryposts', ['data' => $data]);
});




Route::get('/countsinhvien', function () {
    $query = DB::table('sinhviens')
        ->join('khoas', 'khoas.id', '=', 'sinhviens.khoa_id')
        ->select('khoas.name as khoa_name', DB::raw('COUNT(sinhviens.id) as total_students'))
        ->groupBy('khoas.id', 'khoas.name');
    $data = $query->get();
    return view('client.home', ['data' => $data]);
});
