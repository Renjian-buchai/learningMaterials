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
<meta name="keywords" content="SDL_image SDL_ttf SDL_mixer SDL2_image SDL2_ttf SDL2_mixer Tutorial Install Code Blocks set up">
<meta name="description" content="Install SDL_image (or SDL_ttf/SDL_mixer) on Codeblocks.">

<link href="../../../../../assets/style.css" rel="stylesheet">
<script src="../../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL Extension Libraries on Code::Blocks 12.11</title>

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
    <h1 class="text-center">Setting up SDL Extension Libraries on Code::Blocks 12.11</h1>
    
    <p class="text-center"><b>Last Updated: Nov 18th, 2013</b></p>
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <a name="1" href="index.php#1">1)</a> First thing you need to do is download SDL_image headers and binaries. You will find them on the SDL_image website, specifically on
<a href="https://github.com/libsdl-org/SDL_image/releases">this page</a>.<br/>
<br/>
Since Code::Blocks comes with the MinGW compiler by default, odds are you'll want to download the MinGW development libraries.<br/>
<div class="text-center"><img class="img-fluid" alt="mingw package" src="mingw_package.png"></div>
<br/>
Open the gzip archive and there should be a tar archive. Open up the tar archive and the should be a folder called SDL2_image-2.<i>something</i>.<i>something</i>. In side of that folder there should be a bunch of folders and
files, most importantly <b>i686-w64-mingw32</b> which contains the 32bit library and <b>x86_64-w64-mingw32</b> which contains the 64bit library.<br/>
<br/>
<a name="2" href="index.php#2">2)</a> <b>This is important:</b> most compilers still compile 32bit binaries by default to maximize compatibility. We will be using the 32bit binaries for this tutorial set. It doesn't matter if you have
a 64bit operating system, since we are compiling 32bit binaries we will be using the 32bit library.<br/>
<br/>
Inside of i686-w64-mingw32 are the include, lib, and bin folders which contain everything we need compile and run SDL applications. Copy the contents of i686-w64-mingw32 to any directory you want. I recommend putting it in a
folder that you dedicate to holding all your development libraries for MinGW. For these tutorials I'm putting it in a directory I created C:\mingw_dev_lib<br/>
<br/>
<a name="3" href="index.php#3">3)</a> Open up your SDL 2 project and go to project properties.<br/>
<div class="text-center"><img class="img-fluid" alt="project properties" src="project_properties.png"></div>
<br/>

<!--Include-->
<a name="4" href="index.php#4">4)</a> Now we have to tell Code::Blocks to search for header files in the library folder we just extracted. Go to build options.
<div class="text-center"><img class="img-fluid" alt="build options" src="build_options.png"></div>
<br/>
In the Search Directories, we need to add a new compiler directory. Click add, Select the SDL_image folder inside of the include directory from the folder we extracted. Say no when it asks you whether you want it to be a
relative path. Now Code::Blocks knows where to find the SDL_image header files.
<div class="text-center"><img class="img-fluid" alt="search directories" src="search_directories.png"></div>
If you get an error where the compiler says it can't find SDL.h, it means you messed up this step.<br/>
<br/>
You may have noticed that the folder added here is the same as the one for the SDL 2 main set up. Personally, I like keeping the SDL_image, SDL_ttf, and SDL_mixer headers and libraries in the same directories. Other people
like to keep them separate. If you put the extension libary headers in the same directories as SDL 2, you can skip this step since you already told the compiler to look in that directory. If you put them somewhere else, you
have to do this step so your compiler will look for the extension library headers in the right directory.<br/>
<br/>    

<!--Lib-->
<a name="5" href="index.php#5">5)</a> Next we are going to tell Code::Blocks to search for library files in the SDL folder we just extracted. All you have to is go to the linker tab and add the lib directory from the folder we
extacted to the linker search directories.<br/>
<div class="text-center"><img class="img-fluid" alt="linker directory" src="linker_directory.png"></div>
If you get an error where the linker complains it can't find -lSDL2_image (or -lSDL2_ttf/-lSDL2_mixer), it means you messed up this step.<br/>
<br/>
As with before, if you put the library files for the extension library in the same directory as SDL 2, you can skip this step since the compiler is already looking in that directory.<br/>            
<br/>

<!--Link-->
<a name="6" href="index.php#6">6)</a> In order to compile SDL 2 code, we have to tell the compiler to link against the libraries. Go under Linker Settings and paste<br/>
<br/>
<code>-lSDL2_image</code><br/>
<br/>
into the other linker options field after <code>-lmingw32 -lSDL2main -lSDL2</code> and click OK. If you were setting up SDL_ttf, you'd put <code>-lSDL2_ttf</code> and you'd put <code>-lSDL2_mixer</code> for SDL_mixer.<br/>
<div class="text-center"><img class="img-fluid" alt="linker" src="linker.png"></div>
If you get an error where the linker complains about a bunch of undefined references, it means you messed up this step.<br/>
<br/>

<a name="7" href="index.php#7">7)</a> Like with plain SDL, the operating system needs to be able to find the dll files for the extension library while running.<br/>
<br/>
Go find the SDL 2 folder you extracted and from the bin folder inside copy the dll files (all of them if there's more than one) and put it either where your executable will run, or inside of the system directory.
C:\WINDOWS\SYSTEM32 is the 32bit windows system directory and C:\Windows\SysWOW64 is the 64bit system directory of 32bit applications. For these tutorials, I'm assuming we're making 32bit applications. If you get an error
when you run the program where it complains that it can't find dll files, it means you messed up this step.<br/>
<br/>

<a name="8" href="index.php#8">8)</a> Now go download the <a href="../../06_extension_libraries_and_loading_other_image_formats.zip">source for lesson 06</a>. Add the source file inside to your project.<br/>
<br/>
Now build. If there are any errors, make sure you didn't skip a step.<br/>
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