<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <head>
        <style>
            body {
                    font-family: sans-serif;
                    line-height: 1.4;
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/components/dropdown.css">
        <link rel="stylesheet" href="http://10.42.0.40/taggify-laravel/public/css/taggify.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.js"></script>
        <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/components/dropdown.js"></script>
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
        <!-- <script src="{{ asset('js/app.js') }}"></script> -->
        <script src="http://10.42.0.40/taggify-laravel/public/js/scroll.js"></script>
        <script src="http://10.42.0.40/taggify-laravel/public/js/taggify.js"></script>
        </head>
        <body>
        <nav class="navbar navbar-default">
                <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="/taggify-laravel/public">#Taggify</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                @auth
                        <ul class="nav navbar-nav">
                                <li><a href="#">My Uploads</a></li>
                        </ul>
                @endauth
                <ul class="nav navbar-nav navbar-right">
                        <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span>Register</a></li> -->
                        @guest
                                <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                                <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Register</a></li>
                        @else
                                <li>
                                <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                <span class="glyphicon glyphicon-log-out"></span> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                </form>
                                </li>
                        @endguest
                </ul>
                </div>
                </div>
                </nav>
                @yield('content')
    </body>
</html>