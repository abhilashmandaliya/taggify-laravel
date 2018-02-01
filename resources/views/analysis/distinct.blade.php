@extends('layouts.taggify_scroll')

@section('title')
    Distinct Tags
@endsection

@section('content')
    @foreach($tags as $tag)
        <div class="col-sm-4">
            <a href="/user_contents?first=true&tags={{ str_replace('"]', '', str_replace('["', '', $tag)) }}" class="tile magenta">
                <h3 class="title">#{{ str_replace('"]', '', str_replace('["', '', $tag)) }}</h3>
                <p><b>{{ mt_rand(1,10) }}</b></p>
            </a>
        </div>
    @endforeach
@endsection