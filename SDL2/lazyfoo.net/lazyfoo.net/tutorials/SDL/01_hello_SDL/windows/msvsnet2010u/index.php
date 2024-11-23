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
<meta name="keywords" content="SDL 2 C++ Tutorial 2D Windows Install SDL Visual Studio">
<meta name="description" content="Install SDL 2 on Visual Studio.">

<link href="../../../../../assets/style.css" rel="stylesheet">
<script src="../../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL 2 on Visual Studio 2010 Ultimate</title>

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
    <h1 class="text-center">Setting up SDL 2 on Visual Studio 2010 Ultimate</h1>
    
    <p class="text-center"><b>Last Updated: Sep 17th, 2022</b></p>
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <a name="1" href="index.php#1">1)</a> First thing you need to do is download SDL 2 headers and binaries. You will find them on the SDL GitHub, specifically on <a href="https://github.com/libsdl-org/SDL/releases">this page</a>.<br/>
<br/>
You'll want to download the Visual C++ development libraries.<br/>
<div class="text-center"><img class="img-fluid" alt="sdl2 download page" src="../sdl2_vc.png"></div>
<br/>
Open the zip archive and there should be a folder called SDL2-2.<i>something</i>.<i>something</i>. Copy the contents of the folder and put it anywhere you'd like. I recommend putting it in a folder that you dedicate to
holding all your development libraries for Visual Studio. For these tutorials I'm putting them in a directory I created called C:\vs_dev_lib<br/>
<br/>
<a name="2" href="index.php#2">2)</a> Start up Visual Studio and create a new empty project.<br/>
<div class="text-center"><img class="img-fluid" alt="new project" src="new_project.png"></div>
<br/>
<a name="3" href="index.php#3">3)</a> Go to project properties.<br/>
<div class="text-center"><img class="img-fluid" alt="project properties" src="project_properties.png"></div>
<br/>

<!--Include-->
<a name="4" href="index.php#4">4)</a> Now we have to tell Visual C++ to search for header files in the SDL 2 include folder we just extracted. Under Configuration Properties in the VC++ Directories menu, select the Include Directories
field, click the tiny down arrow button, and click edit.<br/>
<div class="text-center"><img class="img-fluid" alt="include directories" src="include_directories.png"></div>
<br/>
<a name="5" href="index.php#5">5)</a> Click the folder icon, and then click the button that pops up.<br/>
<div class="text-center"><img class="img-fluid" alt="add include" src="add_include.png"></div>
<br/>
<a name="6" href="index.php#6">6)</a> Now go find the SDL2 folders you extracted, and select the include folder and click OK.<br/>
<div class="text-center">
<img class="img-fluid" alt="new include" src="new_include.png">
</div>
Now Visual Studio knows where to find the header files. If you get an error that the compiler can't find SDL.h, it means you messed up this step.<br/>
<br/>

<!--Lib-->
<a name="7" href="index.php#7">7)</a> Next we going to tell Visual C++ to search for library files in the SDL 2 library folder we just extracted. Select the Library Directories field, click the tiny down arrow button,
and click edit.<br/>
<div class="text-center"><img class="img-fluid" alt="library dirs" src="library_directories.png"></div>
<br/>
<a name="8" href="index.php#8">8)</a> Click the folder icon, and then click the button that pops up.<br/>
<div class="text-center"><img class="img-fluid" alt="add library" src="add_library.png"></div>
<br/>
<a name="9" href="index.php#9">9)</a> Now go find the lib folder you extracted, and select the lib folder where you find two folders. There's one for 32bit x86 architecture and for 64bit x64 architecture.<br/>
<div class="text-center"><img class="img-fluid" alt="select library" src="select_library.png"></div><br/>
<br/>
<b>This is important:</b> most compilers still compile 32bit binaries by default to maximize compatibility. We will be using the 32bit binaries for this tutorial set. It doesn't matter if you have a 64bit operating system,
since we are compiling 32bit binaries we will be using the 32bit library. This means you need to select the x86 folder and click ok. Now Visual Studio knows where to find the library files. If you get an error how the linker
can't find SDL2.lib, it means you missed this step.<br/>
<br/>

<!--Link-->
<a name="10" href="index.php#10">10)</a> In order to compile SDL code, we have to tell the Visual C++ to link against the libraries. Go under Linker in the Input menu, edit the additional dependencies.<br/>
<div class="text-center"><img class="img-fluid" alt="additional dependencies" src="additional_dependencies.png"></div>
<br/>

<a name="11" href="index.php#11">11)</a> Now paste<br/>
<code>
SDL2.lib;<br/>
SDL2main.lib;
</code><br/>
<br/>
into the Additional dependencies field and click OK.<br/>
<div class="text-center"><img class="img-fluid" alt="linker" src="linker.png"></div>
Now Visual Studio knows to link against SDL 2. If you get a bunch of undefined reference error after compiling, it means you messed up this step.<br/>
<br/>

<!--Sybsystem-->
<a name="12" href="index.php#12">12)</a> Under Linker in the System menu, set the subsystem.<br/>
<div class="text-center"><img class="img-fluid" alt="subsystem" src="subsystem.png"></div>
You can set it to Windows if you don't want console output, and Console if you do want console output. For this tutorial set, errors will be printed on the console, so I recommend leaving it as a console application as you
are still learning and prototyping. If you get an error about an entry point not being defined or unresolved external symbol _main it means you skipped this step.<br/>
<br/>

<a name="13" href="index.php#13">13)</a> When our SDL 2 application runs, the operating system needs to be able to find the dll file.<br/>
<br/>
Go find the SDL 2 lib folder you extracted and copy SDL2.dll and put it either your project's working directory (where the vcxproj file is at), or inside of the system directory. C:\WINDOWS\SYSTEM32 is the 32bit windows
system directory and C:\Windows\SysWOW64 is the 64bit system directory of 32bit applications. For these tutorials, I'm assuming we're making 32bit applications.<br/>
<br/>

<a name="14" href="index.php#14">14)</a> Now go download the <a href="../../01_hello_SDL.zip">source for lesson 01</a>. Add the source file inside to your project.<br/>
<br/>
Now build. If there are any errors, make sure you didn't skip a step.<br/>
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