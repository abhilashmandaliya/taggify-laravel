@extends('layouts.taggify')

@section('title')
    Show Images
@endsection

@section('content')

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar">
    <br>
    <div class="w3-container">
        <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
        <i class="fa fa-remove"></i>
        </a>
        <img src="https://www.w3schools.com/w3images/avatar_g2.jpg" style="width:45%;" class="w3-round"><br><br>
        <h4><b>Abhilash Mandaliya</b></h4>
    </div>
    <div class="w3-bar-block">
        <a href="#portfolio" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>My Uploads</a> 
        <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>Profile</a> 
    </div>
</nav>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">
    <!-- Header -->
    <br/>
    <header id="portfolio">
        <a href="#"><img src="https://www.w3schools.com/w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
        <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
        <div class="w3-container">
            <div class="ui fluid multiple search selection dropdown">
                <input type="hidden" name="country">
                <i class="dropdown icon"></i>
                <div class="default text">Select Tags</div>
                <div class="menu">
                    @foreach($unique_tags as $unique_tag)
                        <div class="item" data-value="{{ $unique_tag }}">
                            {{ $unique_tag }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </header>
    <br/>
    <!-- First Photo Grid-->
    <div class="w3-row-padding">
        @foreach($user_contents as $user_content)
            <div class="w3-third w3-container w3-margin-bottom">
                <img src="{{ asset( preg_replace('/public/', 'storage', $user_content['file_name'], 1) ) }}" alt="Norway" style="width:100%" class="w3-hover-opacity">
                <div class="w3-container w3-white">
                    @foreach($user_content['tags'] as $tag)
                        <a href="{{ URL::to('/') }}/user_contents?tag={{ $tag }}">
                            #{{ $tag }}&nbsp;
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <!-- End page content -->
</div>
<script>
    // Script to open and close sidebar
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }
     
    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }
</script>

@endsection