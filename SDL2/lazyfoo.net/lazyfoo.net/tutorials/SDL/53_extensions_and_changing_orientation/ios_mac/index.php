<!-- Get tutorial set -->


<!-- Tutorial root -->



    <!-- Desktop tutorial set -->
    
        
        
        
    <!-- Normal tutorial set -->
    

                    

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

	<head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VP5RSQ168Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VP5RSQ168Y');
</script>



<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="SDL 2 C++ Tutorial 2D Mac OS X XCode Install SDL_image SDL_ttf SDL_mixer iOS iPhone iPad iPod Touch">
<meta name="description" content="Install SDL2_image/SDL2_ttf/SDL2_mixer on iOS with XCode.">

<link href="../../../../assets/style.css" rel="stylesheet">
<script src="../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL_image on iOS with XCode 14.1</title>

<script src="../../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
	<a href="../../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../../donate.php" class="nav-item nav-link">Donations</a>
</nav>

<nav class="container">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5880704953225255"
         crossorigin="anonymous"></script>
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-5880704953225255"
         data-ad-slot="7546677284"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</nav>

<br/>

<nav class="container">
		<script async src="https://cse.google.com/cse.js?cx=f01a79f66150b448d">
		</script>
		<div class="gcse-search"></div>
</nav>


</header>


		
		<main>
            <div class="container">
                
                    
                        <div class="container border py-3 my-3">
    <h1 class="text-center">Setting up SDL_image on iOS with XCode 14.1</h1>
    
    <p class="text-center"><b>Last Updated: Nov 7th, 2022</b></p>
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <a name="1" href="index.php#1">1)</a> First, download the SDL_image source on <a href="https://github.com/libsdl-org/SDL_image/releases">this page</a>.
<div class="text-center"><img class="img-fluid" alt="sdl source" src="../src-lib.png"></div>
<br/>
Extract the folder inside to your development directory.<br/>
<br/>

<a name="2" href="index.php#2">2)</a> Go inside the source code folder and look for the external folder. The external folder is supposed to have the external libraries used by the extension.
There should be a download.sh shell script. If there isn't you can download it <a href="../download.sh">here</a>. Run download.sh inside of the external folder so the specific versions of
the external libraries can get pulled down.<br/>
<br/>

<a name="3" href="index.php#3">3)</a> Open up your SDL project. Add the SDL_image XCode project inside of the source directory:
<div class="text-center"><img class="img-fluid" alt="add to project" src="add-sdl-image-project.png"></div>
<br/>

<a name="3" href="index.php#3">3)</a> Add the public SDL_image headers to the header search paths like we did with the SDL 2 public headers:
<div class="text-center"><img class="img-fluid" alt="add headers" src="add-sdl-image-headers.png"></div>
<br/>

<a name="4" href="index.php#4">4)</a> Add the regular SDL_image framework to your project:
<div class="text-center"><img class="img-fluid" alt="add framework" src="add-framework.png"></div>
<br/>

<a name="5" href="index.php#5">5)</a> Make sure the SDL_image framework is marked to embed and sign:
<div class="text-center"><img class="img-fluid" alt="embed and sign" src="embed-and-sign.png"></div>
<br/>

<a name="6" href="index.php#6">6)</a> If you try to build now, SDL_image will complain that it can't find SDL.h. This means you need to add the SDL 2 public headers to SDL_image much like you added it to
your main SDL project:
<div class="text-center"><img class="img-fluid" alt="add headers" src="add-sdl-headers.png"></div>
<br/>

<a name="7" href="index.php#7">7)</a> Download the <a href="../53_extensions_and_changing_orientation.zip">demo source/assets</a>. Extract source file and add it to the project.
If you try to build now, you'll get an error about missing header files. In 53_extensions_and_changing_orientation.cpp, change <code>#include &lt;SDL_image.h&gt;</code> to <code>#include &lt;SDL2_image/SDL_image.h&gt;</code>.<br/>
<br/>

<a name="8" href="index.php#8">8)</a> Add the media files like you did before and the project should now build and run. Now that the application built, it's time to go over the source code.

</div>
                    
                
                    
                        <div class="container border py-3 my-3">




<a href="../index2.php">Extensions and Changing Orientation Part 2: Handling Orientation Changes</a><br/>




</div>
                    
                
            </div>
		</main>
		
<footer class="my-3 py-3">
    
<nav class="container">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5880704953225255"
         crossorigin="anonymous"></script>
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-5880704953225255"
         data-ad-slot="7546677284"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</nav>

	<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
	<a href="../../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>