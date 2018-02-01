@extends('layouts.taggify_scroll')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="widget center">
                <div class="blur"></div>
                <div class="text center">
                        <h1>
                                <a class="title-home-page" href="/taggify-laravel/public"> 
                                        <span style="color:#fff"> #Taggify </span> 
                                </a>
                        </h1>
                </div>
        </div>
    </div>

        <style>
                body {
                        background: url('/images/bg.png') no-repeat center center fixed;
                        background-size: cover;  
                }
        </style>
@endsection