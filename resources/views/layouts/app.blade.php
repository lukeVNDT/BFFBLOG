<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>TanBlog</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog Template">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
	<script defer src="{{asset('assets/fontawesome/js/all.min.js')}}"></script>
    
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{asset('assets/css/theme-4.css')}}">
	<link  rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

</head> 

<body>
<div id="app">
    <header class="header text-center">	    
	    <h1 class="blog-name pt-lg-4 mb-0"><a class="no-text-decoration" href="index.html">BFF Blog</a></h1>
        
	    <nav class="navbar navbar-expand-lg navbar-dark" >
           
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			@foreach($user as $key => $profile)
			<div id="navigation" class="collapse navbar-collapse flex-column" >
				<div class="profile-section pt-3 pt-lg-0">
				    <img class="profile-image mb-3 rounded-circle mx-auto" src="{{'https://res.cloudinary.com/dtiazqxyd/image/upload/v1648268980/'.$profile->image}}" alt="image" >			
					
					<div class="bio mb-3">{{$profile->shortdescription}}<br> <router-link class="nav-link" to="/aboutme">Find out more about Me</router-link></div><!--//bio-->
					<ul class="social-list list-inline py-3 mx-auto">
			            <!-- <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
			            <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in fa-fw"></i></a></li> -->
			            <li class="list-inline-item"><a href="{{$profile->github_link}}"><i class="fab fa-github"></i></a></li>
			            <li class="list-inline-item"><a href="{{$profile->fb_link}}"><i class="fab fa-facebook-f"></i></a></li>
			            <!-- <li class="list-inline-item"><a href="#"><i class="fab fa-codepen fa-fw"></i></a></li> -->
			        </ul><!--//social-list-->
			        <hr> 
				</div><!--//profile-section-->
				@endforeach
				<ul class="navbar-nav flex-column text-start">
					<li class="nav-item" >
					    <router-link class="nav-link" :class="[{active: $route.name === 'contentblog'}]" to="/"><i class="fas fa-bookmark fa-fw me-2"></i>Blog Post</router-link>
					</li>
					<li class="nav-item" >
					    <router-link class="nav-link" :class="[{active: $route.name === 'aboutme'}]" to="/aboutme"><i class="fas fa-user fa-fw me-2"></i>About Me</router-link>
					</li>
				</ul>
				
				<!-- <div class="my-2 my-md-3">
				    <a class="btn btn-primary" href="https://themes.3rdwavemedia.com/" target="_blank">Get in Touch</a>
				</div> -->
			</div>
		</nav>
    </header>
    
    <div class="main-wrapper">
			<router-view>
            @yield('content')
              </router-view>
    </div><!--//main-wrapper-->

</div>      
    <!-- Javascript -->    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>      
    <script src="{{asset('assets/plugins/popper.min.js')}}"></script> 
	<script src="{{mix('js/app.js')}}"></script>
    
	
    

</body>
</html> 

