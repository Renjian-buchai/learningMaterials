<!-- Get tutorial set -->


<!-- Tutorial root -->



    <!-- Desktop tutorial set -->
    
        
    <!-- Mobile tutorial set -->
    

                    

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
<meta name="keywords" content="SDL_image SDL_ttf SDL_mixer SDL2_image SDL2_ttf SDL2_mixer Tutorial Install Visual Studio set up">
<meta name="description" content="Install SDL_image (or SDL_ttf/SDL_mixer) on 2019 Community.">

<link href="../../../../../assets/style.css" rel="stylesheet">
<script src="../../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL Extension Libraries on Visual Studio 2019 Community</title>

<script src="../../../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../../../assets/external-link.svg"></a>
	<a href="../../../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../../../donate.php" class="nav-item nav-link">Donations</a>
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
    <a name="1" href="index.php#1">1)</a> First thing you need to do is download SDL_image headers and binaries. You will find them on the SDL_image website, specifically on
<a href="https://github.com/libsdl-org/SDL_image/releases">this page</a>.<br/>
<br/>
You'll want to download the Visual C++ development libraries.<br/>
<div class="text-center"><img class="img-fluid" alt="visual studio libraries" src="msvc-library.png"></div>
Extact the folder to where ever you'd like. I recommend keeping your development libraries in the same directory so for this tutorial we will be extacting it to C:\vclib<br/>
<br/>
<a name="2" href="index.php#2">2)</a> Now go download the <a href="../../06_extension_libraries_and_loading_other_image_formats.zip">source for lesson 06</a>. Add the source file to your existing SDL2 project and hit build. You should
get the following error:<br/>
<br/>
<code>Cannot open include file: 'SDL_image.h': No such file or directory</code><br/>
<br/>
Like before, this mean Visual C++ can't find the SDL_image headers, so make sure to add the SDL_image headers to your path:
<div class="text-center"><img class="img-fluid" alt="project properties" src="project-properties.png"></div>
<div class="text-center"><img class="img-fluid" alt="edit include" src="edit-include.png"></div>
<div class="text-center"><img class="img-fluid" alt="add include" src="add-include.png"></div>
<br/>
<a name="3" href="index.php#3">3)</a> Try and build again. You'll probably get the following error:<br/>
<br/>
<code>unresolved external symbol IMG_Init referenced in function "bool __cdecl init(void)" (?init@@YA_NXZ)</code><br/>
<br/>
<h4></h4>
Again, this means Visual Studio does not know it needs to use the SDL_image library, so go add it to your dependencies:
<div class="text-center"><img class="img-fluid" alt="edit additional dependencies" src="edit-additional-dependencies.png"></div>
<div class="text-center"><img class="img-fluid" alt="add additional dependencies" src="add-additional-dependencies.png"></div>
<br/>
<a name="4" href="index.php#4">4)</a>Build again and you'll get this error:<br/>
<br/>
<code>cannot open file 'SDL2_image.lib'</code><br/>
<br/>
This is Visual C++ complaining that it can't find the SDL_image library file, so let's add it to library directories. Again, make sure you pick the library that matches your build configuration (for this tutorial we are using
the Debug x64 configuration):
<div class="text-center"><img class="img-fluid" alt="edit library" src="edit-library.png"></div>
<div class="text-center"><img class="img-fluid" alt="add library" src="add-library.png"></div>
<br/>
<a name="5" href="index.php#5">5)</a> Build one more time and it should compile, but if you try to run you'll get this error:<br/>
<br/>
<code>The code execution cannot proceed because SDL2_image.dll was not found.</code><br/>
<br/>
This is Windows complaining that it can't find SDL2_image.dll along with the other SDL2_image dlls. Let's add it to the path environment variable like we did for SDL
<div class="text-center"><img class="img-fluid" alt="edit system-environment variables" src="edit-system-environment-variables.png"></div>
<div class="text-center"><img class="img-fluid" alt="edit path" src="edit-path.png"></div>
<div class="text-center"><img class="img-fluid" alt="add path" src="add-path.png"></div>
<br/>
<a name="6" href="index.php#6">6)</a> Restart Visual C++ so it can get the updated path variable, and the application should run.<br/>
<br/>
Now that you have the extension library compiling, it's time to go onto part 2 of the tutorial.

</div>
                    
                
                    
                        <div class="container border py-3 my-3">




<a href="../../index2.php">Extension Libraries and Loading Other Image Formats Part 2: Loading PNGs with SDL_image</a>




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
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../../../assets/external-link.svg"></a>
	<a href="../../../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../../../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>