<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/components/dropdown.css">
    <link rel="stylesheet" href="http://10.42.0.40/taggify-laravel/public/css/taggify.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/components/dropdown.js"></script>
    <script src="http://10.42.0.40/taggify-laravel/public/js/taggify.js"></script>
    <script src="http://10.42.0.40/taggify-laravel/public/js/jquery.waypoints.min.js"></script>
    <script src="http://10.42.0.40/taggify-laravel/public/js/infinite.min.js"></script>
  <style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
    </style>
</head>
<body class="w3-light-grey w3-content" style="max-width:1600px">
    @yield('content')
</body>
</html>