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
<meta name="keywords" content="SDL_image SDL_ttf SDL_mixer SDL2_image SDL2_ttf SDL2_mixer Tutorial Install mingw set up">
<meta name="description" content="Install SDL_image (or SDL_ttf/SDL_mixer) on MinGW.">

<link href="../../../../../assets/style.css" rel="stylesheet">
<script src="../../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL Extension Libraries on MinGW</title>

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
You'll want to download the MinGW development libraries.<br/>
<div class="text-center"><img class="img-fluid" alt="mingw package" src="mingw_package.png"></div>
<br/>
Open the gzip archive and there should be a tar archive. Open up the tar archive and the should be a folder called SDL2_image-2.<i>something</i>.<i>something</i>. In side of that folder there should be a bunch of folders
and files, most importantly <b>i686-w64-mingw32</b> which contains the 32bit library and <b>x86_64-w64-mingw32</b> which contains the 64bit library.<br/>
<br/>
<a name="2" href="index.php#2">2)</a> <b>This is important:</b> most compilers still compile 32bit binaries by default to maximize compatibility. We will be using the 32bit binaries for this tutorial set. It doesn't matter if you have
a 64bit operating system, since we are compiling 32bit binaries we will be using the 32bit library.<br/>
<br/>
Inside of i686-w64-mingw32 are the include, lib, and bin folders which contain everything we need compile and run SDL applications. Copy the contents of i686-w64-mingw32 to any directory you want. I recommend putting it in a
folder that you dedicate to holding all your development libraries for MinGW. For these tutorials I'm putting it in a directory I created C:\mingw_dev_lib<br/>
<br/>	
<a name="3" href="index.php#3">3)</a> Now go download the <a href="../../06_extension_libraries_and_loading_other_image_formats.zip">source for lesson 06</a>. Extract the source somewhere and compile by entering this big old command
(This command assumed you have SDL_image extracted at C:\mingw_dev_lib):<br/>
<br/>
<code>g++ 06_extension_libraries_and_loading_other_image_formats.cpp -IC:\mingw_dev_lib\include\SDL2 -LC:\mingw_dev_lib\lib -w -Wl,-subsystem,windows -lmingw32 -lSDL2main -lSDL2 -lSDL2_image -o 06_extension_libraries_and_loading_other_image_formats</code><br/>
<br/>
If you're using a makefile, you can just change the values of some of the macros:

</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Makefile</div>


<pre class="border my-0 py-3">#OBJS specifies which files to compile as part of the project
OBJS = 06_extension_libraries_and_loading_other_image_formats.cpp

#CC specifies which compiler we're using
CC = g++

#INCLUDE_PATHS specifies the additional include paths we'll need
INCLUDE_PATHS = -IC:\mingw_dev_lib\include\SDL2

#LIBRARY_PATHS specifies the additional library paths we'll need
LIBRARY_PATHS = -LC:\mingw_dev_lib\lib

#COMPILER_FLAGS specifies the additional compilation options we're using
# -w suppresses all warnings
# -Wl,-subsystem,windows gets rid of the console window
COMPILER_FLAGS = -w -Wl,-subsystem,windows

#LINKER_FLAGS specifies the libraries we're linking against
LINKER_FLAGS = -lmingw32 -lSDL2main -lSDL2 -lSDL2_image

#OBJ_NAME specifies the name of our exectuable
OBJ_NAME = 06_extension_libraries_and_loading_other_image_formats

#This is the target that compiles our executable
all : $(OBJS)
	$(CC) $(OBJS) $(INCLUDE_PATHS) $(LIBRARY_PATHS) $(COMPILER_FLAGS) $(LINKER_FLAGS) -o $(OBJ_NAME)
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As you can see it was as easy as changing the file name of the source and executable and adding<br/>
<br/>
<code>-lSDL2_image</code><br/>
<br/>
to the linker. If we were linking SDL_ttf, we'd add<br/>
<br/>
<code>-lSDL2_ttf</code><br/>
<br/>
and for SDL_mixer we'd put:<br/>
<br/>
<code>-lSDL2_mixer</code><br/>
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