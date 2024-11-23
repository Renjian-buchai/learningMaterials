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
<meta name="keywords" content="SDL 2 C++ Tutorial 2D Windows Install SDL Visual Studio 2019 Community">
<meta name="description" content="Install SDL 2 on Visual Studio 2019 Community Edition.">

<link href="../../../../../assets/style.css" rel="stylesheet">
<script src="../../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL 2 on Visual Studio 2019 Community Edition</title>

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
    <h1 class="text-center">Setting up SDL 2 on Visual Studio 2019 Community Edition</h1>
    
    <p class="text-center"><b>Last Updated: Sep 17th, 2022</b></p>
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <a name="1" href="index.php#1">1)</a>First thing you need to do is download SDL 2 headers and binaries. You will find them on the SDL GitHub, specifically on <a href="https://github.com/libsdl-org/SDL/releases">this page</a>. 
You'll want to download the Visual C++ development libraries.    
<div class="text-center"><img class="img-fluid" alt="SDL download page" src="../sdl2_vc.png"></div>
<br/>
Open the zip archive and there should be a folder called SDL2-2.<i>something</i>.<i>something</i>. Copy the contents of the folder and put it anywhere you'd like. I recommend putting it in a folder that you dedicate 
to holding all your development libraries for Visual C++. For these tutorials I'm putting them in a directory I created called C:\vclib<br/>
<br/>

<a name="2" href="index.php#2">2)</a>Start up Visual Studio and create a new empty C++ project.    
<div class="text-center"><img class="img-fluid" alt="new project page" src="empty-project.png"></div>
Give your project/solution whatever name you'd like and place it where ever you'd like.<br/>
<br/>
    
<a name="3" href="index.php#3">3)</a>Go download the <a href="../../01_hello_SDL.zip">source for lesson 01</a> and extract the source file. Right click on the source files folder in your solution, and then add the source file 
you downloaded.
<div class="text-center"><img class="img-fluid" alt="add existing item" src="add-existing-item.png"></div>
<br/>

<a name="4" href="index.php#4">4)</a>Now, if your default build setting is Debug x86, you may need to change it:
<div class="text-center"><img class="img-fluid" alt="x64 configuration" src="default-config.png"></div>
For the rest of this tutorial, we will be assuming you are building for Debug x64 so make sure your configuation is set to Debug x64. Because libraries are different per configuation, you will need to add SDL to 
every configuation you plan on using. So if you want to build for Release x64 or Debug x86, you will need to add SDL2 to each configuation.<br/>
<br/>
    
<a name="5" href="index.php#5">5)</a>Build your solution and you should get the following error:<br/>
<br/>
<code>Cannot open include file: 'SDL.h': No such file or directory</code><br/>
<br/>
This means Visual C++ cannot find the SDL header files and you need to add the SDL include folder to the Visual C++ include directories.
    
Go to project properties:
<div class="text-center"><img class="img-fluid" alt="project properties" src="project-properties.png"></div>
    
Go to Configuration Properties -> VC++ Directories -> Include Directories -> Edit.
<div class="text-center"><img class="img-fluid" alt="edit include directories" src="edit-include-directories.png"></div>
<br/>
And then add the include directory from the SDL development folder we extracted.
<div class="text-center"><img class="img-fluid" alt="add include folder" src="add-include.png"></div>
<br/>
<a name="6" href="index.php#6">6)</a>Try to build your solution again and you should get a bunch of errors including:<br/>
<br/>
<code>unresolved external symbol SDL_GetError referenced in function SDL_main</code><br/>
<br/>
The header file tells the compiler what the SDL functions are, not where to find them. The library file tells the compiler where they are and we need to tell it to use the SDL library file. Go to Configuration
Properties -> Linker -> Additional Dependencies -> Edit.
<div class="text-center"><img class="img-fluid" alt="edit additional dependencies"  src="additional-dependencies.png"></div>
<br/>
Now add<br/>
<code>SDL2.lib; SDL2main.lib;</code><br/>
<br/>
<div class="text-center"><img class="img-fluid" alt="sdl libs" src="add-additional-dependencies.png"></div>
<br/>

<a name="7" href="index.php#7">7)</a>Try to build your solution again and you should get a new error:<br/>
<br/>
<code>cannot open file 'SDL2.lib'</code><br/>
<br/>
While we did tell Visual C++ to use the SDL library files, we didn't tell it where to find it. Add the library directory like you did the include directory
<div class="text-center"><img class="img-fluid" alt="edit library directories" src="edit-library-directories.png"></div>
<br/>
Make sure to add the library that matches your build configuation. If your building for x64, make sure to use the x64 library.
<div class="text-center"><img class="img-fluid" alt="add lib directory" src="add-x64.png"></div>
<br/>

<a name="8" href="index.php#8">8)</a>Build and your application should build, but try to run it and you'll get this error:<br/>
<br/>
<code>The code execution cannot proceed because SDL2.dll was not found.</code><br/>
<br/>
This is because your application needs SDL2.dll to run but can't find it. Windows uses environment variables to define where to look for dll files. To edit the PATH environment variable, go into Windows Settings and 
search for edit the system environment variables:<br/>
<div class="text-center"><img class="img-fluid" alt="edit env vars" src="edit-system-environment-variables.png"></div>
<br/>
Click environment variables and under System Variables select Path and click Edit
<div class="text-center"><img class="img-fluid" alt="edit path vars" src="edit-path.png"></div>
<br/>
Then click new, then browse to add the lib directory for your build configuation:
<div class="text-center"><img class="img-fluid" alt="add path"  src="add-path.png"></div>
<br/>
Restart Visual Studio so Visual C++ can get the updated path variable, start your program and it should run.<br/>
<br/>
Now that you have SDL 2 compiling, it's time to go onto part 2 of the tutorial.

</div>
                    
                
                    
                        <div class="container border py-3 my-3">




<a href="../../index2.php">Hello SDL Part 2: Your First Graphics Window</a>




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