@extends('layouts.taggify_scroll')

@section('title')
   Load Tagged Images
@endsection

@section('content')

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
@endsection