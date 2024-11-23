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
<meta name="description" content="Install SDL_image (or SDL_ttf/SDL_mixer) on Visual Studio.">

<link href="../../../../../assets/style.css" rel="stylesheet">
<script src="../../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL Extension Libraries on Visual Studio 2010 Ultimate</title>

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
    <h1 class="text-center">Setting up SDL Extension Libraries on Visual Studio 2010 Ultimate</h1>
    
    <p class="text-center"><b>Last Updated: Aug 22nd, 2022</b></p>
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <a name="1" href="index.php#1">1)</a> First thing you need to do is download SDL_image headers and binaries. You will find them on the SDL_image website, specifically on
<a href="https://github.com/libsdl-org/SDL_image/releases">this page</a>.<br/>
<br/>
You'll want to download the visual c++ development libraries.<br/>
<div class="text-center"><img class="img-fluid" alt="visual studio package" src="msvc_package.png"></div>
<br/>

<a name="2" href="index.php#2">2)</a> Open the zip archive and there should be a folder that contains folders called include and another one called lib. Copy the contents of the folder and put them where you want. I recommend putting
them in the same directory where you put your SDL install. For these tutorials I'm putting them in a directory I created called C:\vs_dev_lib<br/>
<br/>

<a name="3" href="index.php#3">3)</a> Open your SDL project and go to project properties.<br/>
<div class="text-center"><img class="img-fluid" alt="project properties" src="project_properties.png"></div>
<br/>

<!--Include-->
<a name="4" href="index.php#4">4)</a> Now we have to tell Visual C++ to search for header files in the SDL extension include folder we just extracted. Under Configuration Properties in the VC++ Directories menu, select the Include
Directories field, click the tiny down arrow button, and click edit.<br/>
<div class="text-center"><img class="img-fluid" alt="include directories" src="include_directories.png"></div>
<br/>

<a name="5" href="index.php#5">5)</a> Click the folder icon, and then click the button that pops up.<br/>
<div class="text-center"><img class="img-fluid" alt="add include" src="add_include.png"></div>
<br/>

<a name="6" href="index.php#6">6)</a> Now go find the SDL_image (or SDL_ttf/SDL_mixer) folders you extracted, and select the include folder and click OK.<br/>
<div class="text-center"><img class="img-fluid" alt="new include" src="new_include.png"></div>
Now Visual Studio knows where to find the header files. If you get an error that the compiler can't find SDL_image.h (or SDL_ttf.h/SDL_mixer.h), it means you messed up this step.<br/>
<br/>
You may have noticed that the directory added here is the same from the setting up SDL tutorial. This is because I over wrote the include directory so it has both the headers from SDL 2 and SDL_image/SDL_ttf/SDL_mixer headers
are in the same directory. If you did this you can skip this step because our project already knew where to find the header files. Some prefer keep their SDL and SDL extension libaries in different directories, some prefer
them in the same directory. Your choice.<br/>
<br/>

<!--Lib-->
<a name="7" href="index.php#7">7)</a> Next we're going to tell Visual C++ to search for library files in the SDL_image/SDL_ttf/SDL_mixer library folder we just extracted. Select the Library Directories field, click the tiny down arrow
button, and click edit.<br/>
<div class="text-center"><img class="img-fluid" alt="library directories" src="library_directories.png"></div>
<br/>

<a name="8" href="index.php#8">8)</a> Click the folder icon, and then click the button that pops up.<br/>
<div class="text-center"><img class="img-fluid" alt="add library" src="add_library.png"></div>
<br/>

<a name="9" href="index.php#9">9)</a> Now go find the lib folder you extracted, and select the lib folder where you find two folders. There's one for 32bit x86 architecture and for 64bit x64 architecture.<br/>
<div class="text-center"><img class="img-fluid" alt="select library" src="select_library.png"><br/></div>
<br/>
<b>This is important:</b> most compilers still compile 32bit binaries by default to maximize compatibility. We will be using the 32bit binaries for this tutorial set. It doesn't matter if you have a 64bit operating system,
since we are compiling 32bit binaries we will be using the 32bit library. This means you need to select the x86 folder and click ok. Now Visual Studio knows where to find the library files. If you get an error how the linker
can't find SDL2_image.lib/SDL2_ttf.lib/SDL2_mixer.lib, it means you missed this step.<br/>
<br/>
Like before, you might notice that the lib directory is the same from tutorial 01. Again, this is because I personally like to put the library files for SDL, SDL_image, SDL_ttf, and SDL_mixer in the same directory. If you do
this you can skip this step since visual studio is already looking for library files there. For you people you put them in a separate directory, you need to tell visual studio where to find the lib files.<br/>
<br/>

<!--Link-->
<a name="10" href="index.php#10">10)</a> In order to compile SDL code, we have to tell the Visual C++ to link against the libraries. Go under Linker in the Input menu, edit the additional dependencies.<br/>
<div class="text-center"><img class="img-fluid" alt="additional dependencies" src="additional_dependencies.png"></div>
<br/>

<a name="11" href="index.php#11">11)</a>Now paste<br/>
<br/>
<code>SDL2_image.lib;</code><br/>
<br/>
into the Additional dependencies field and click OK.<br/>
<div class="text-center"><img class="img-fluid" alt="linker" src="linker.png"></div>
If you were linking SDL_ttf, you'd put <code>SDL2_ttf.lib;</code>. If you were linking SDL2_mixer, you'd put <code>SDL2_mixer.lib;</code>.<br/>
<br/>
Now Visual Studio knows to link against the extension library. If you get a bunch of undefined reference error after compiling, it means you messed up this step.<br/>
<br/>

<a name="12" href="index.php#12">12)</a> Like with plain SDL, the operating system needs to be able to find the dll files for the extension library while running.<br/>
<br/>
Go find the lib folder you extracted from the extension library and copy <b>all</b> of the dll files and put them either your project's working directory (where the vcxproj file is at), or inside of the system directory.
C:\WINDOWS\SYSTEM32 is the 32bit windows system directory and C:\Windows\SysWOW64 is the 64bit system directory of 32bit applications. For these tutorials, I'm assuming we're making 32bit applications.<br/>
<br/>

<a name="13" href="index.php#13">13)</a> Now go download the <a href="../../06_extension_libraries_and_loading_other_image_formats.zip">source for lesson 06</a>. Add the source file inside to your project.<br/>
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