@extends('layouts.taggify_scroll')

@section('title')
   Load Tagged Images
@endsection

@section('content')

    <br/>
    <div class="ui fluid multiple search selection dropdown">
            <i class="dropdown icon"></i>
            <div class="default text"><b>Select By Tags</b></div>
            <div class="menu">
                    @foreach($unique_tags as $unique_tag)
                    <div class="item" data-value="{{ $unique_tag }}">
                            {{ $unique_tag }}
                    </div>
                    @endforeach
            </div>
            <button type="button" id="tag_search_btn" class="btn btn-primary pull-right">Search</button>
    </div>
    <br/>
        
    <div class="grid">
        <div class="grid__col-sizer"></div>
        <div class="grid__gutter-sizer"></div>
    </div>

    <div class="page-load-status">
        <div class="loader-ellips infinite-scroll-request">
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
        </div>
        <p class="infinite-scroll-last">End of content</p>
        <p class="infinite-scroll-error">No more pages to load</p>
    </div>

    <script type="text/html" id="photo-item-template">
        <div class="photo-item">
            <img class="photo-item__image" src="{file_name}" alt="photo-not-found" />
            <p class="photo-item__caption" style='background-color: rgba(0,0,0,0.6);'>
                {tags}
            </p>
        </div>
    </script>

    @isset($tags)
        <input type="hidden" id="myurl" data-value="http://10.42.0.40/taggify-laravel/public/user_contents/?tags={{ $tags }}" />
    @else
        <input type="hidden" id="myurl" data-value="http://10.42.0.40/taggify-laravel/public/user_contents" />
    @endisset
@endsection