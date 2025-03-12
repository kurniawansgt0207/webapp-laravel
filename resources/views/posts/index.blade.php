@extends('main')
@section('title','List Posts')
@section('content')
<h1>All Posts</h1>

@foreach($posts as $post)
    <x-posts-card :posts="$post" />
@endforeach

@endsection