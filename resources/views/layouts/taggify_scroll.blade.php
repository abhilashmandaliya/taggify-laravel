<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://codepen.io/desandro/pen/owWLYz"/>
    <head>
        <style>
            body {
                    font-family: sans-serif;
                    line-height: 1.4;
                    padding: 20px;
                    max-width: 1200px;
                    margin: 0 auto;
                }
            
            .grid__col-sizer,
            .photo-item {
                    width: 32%;
            }
            
            .grid__gutter-sizer {
                    width: 2%;
            }

            .photo-item {
                    margin-bottom: 10px;
                    float: left;
            }
            
            .photo-item__image {
                    display: block;
                    max-width: 100%;
            }
            
            .photo-item__caption {
                    position: absolute;
                    left: 10px;
                    bottom: 10px;
                    margin: 0;
            }

            .photo-item__caption a {
                    color: white;
                    font-size: 0.8em;
                    text-decoration: none;
            }

            .page-load-status {
                    display: none; /* hidden by default */
                    padding-top: 20px;
                    border-top: 1px solid #DDD;
                    text-align: center;
                    color: #777;
            }
        </style>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.js"></script>
        <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
        <script src="http://10.42.0.40/taggify-laravel/public/js/scroll.js"></script>
    </head>
    <body>
        @yield('content')
    </body>
</html>