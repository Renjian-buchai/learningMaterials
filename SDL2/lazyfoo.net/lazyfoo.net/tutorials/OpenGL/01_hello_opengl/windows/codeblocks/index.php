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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows codeblocks install freeGLUT">
<meta name="description" content="Install OpenGL freeGLUT on Windows Codeblocks.">

<link href="../../../../../assets/style.css" rel="stylesheet">
<script src="../../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up freeGLUT on Code::Blocks 10.05</title>

<script src="../../../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../../../assets/external-link.svg"></a>
	<a href="../../../../SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../../index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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
    <h1 class="text-center">Setting up freeGLUT on Code::Blocks 10.05</h1>
    
        <div class="text-center"><img class="img-fluid" src="https://lazyfoo.net/tutorials/OpenGL/01_hello_opengl/windows/codeblocks/preview.png" alt="Setting up freeGLUT on Code::Blocks 10.05 screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <a name="1" href="index.php#1">1)</a>First thing you need to do is download freeGLUT headers and binaries. You will find them on the freeGLUT website, specifically
on <a href="http://freeglut.sourceforge.net/index.php#download">this page</a>.<br/>
<br/>
Scroll down to the Prepackaged Releases section and click on the prepackaged windows binaries page.<br/>
<div class="text-center"><img class="img-fluid" alt="download" src="../download.png"></div>
<br/>
Then download the MinGW binaries archive.<br/>
<div class="text-center"><img class="img-fluid" alt="mingw package" src="mingw_package.png"></div>
<br/>
Open the zip archive and there should be a folder called "freeglut". Copy that entire folder and put it anywhere you'd like. For these tutorials I'm putting it in a 
directory I created called C:\mingw_dev_lib<br/>
<br/>
<a name="2" href="index.php#2">2)</a>Start up Code::Blocks and create a new empty project.<br/>
<div class="text-center"><img class="img-fluid" alt="new project" src="new_project.png"></div>
<br/>
<a name="3" href="index.php#3">3)</a>Go to project properties.<br/>
<div class="text-center"><img class="img-fluid" alt="project properties" src="project_properties.png"></div>
<br/>
<!--Include-->
<a name="4" href="index.php#4">4)</a>Now we have to tell Code::Blocks to search for header files in the freeglut folder we just extracted.
Go to build options.
<div class="text-center"><img class="img-fluid" alt="build options" src="build_options.png"></div>
<br/>
In the Search Directories, add a new compiler directory.
<div class="text-center"><img class="img-fluid" alt="search directories" src="search_directories.png"></div>
<br/>
Select the include directory from the folder you extracted.
<div class="text-center"><img class="img-fluid" alt="add directory" src="add_directory.png"></div>
<br/>
And say no when it asks you whether you want it to be a relative path. Now Code::Blocks knows where to find the freeGLUT header files.
<div class="text-center"><img class="img-fluid" alt="added directories" src="added_directories.png"></div>
<br/>	
<!--Lib-->
<a name="5" href="index.php#5">5)</a>Next we are going to tell Code::Blocks to search for library files in the freeGLUT folder we just extracted.
All you have to is add the lib directory from the freeGLUT folder you extacted to the linker search directories.<br/>
<div class="text-center"><img class="img-fluid" alt="linker directory" src="linker_directory.png"></div>
<br/>	

<!--Link-->
<a name="6" href="index.php#6">6)</a>In order to compile OpenGL and freeGLUT code, we have to tell the Code::Blocks to link against the libraries.
Go under Linker Settings and paste<br/>
<br/>
<code>-lOpenGL32 -lglu32 -lfreeglut</code><br/>
<br/>
<div class="text-center">
into the other linker options field and click OK.<br/>
<img class="img-fluid" alt="linker" src="linker.png">
</div>
<br/>

<!--Sybsystem-->
<a name="7" href="index.php#7">7)</a>Go back to the project properites and under Build Targets select the build type.<br/>
<div class="text-center"><img class="img-fluid" alt="build type" src="build_type.png"></div>
I recommend setting it to GUI Application if you don't want console output, and Console Application if you do want console output.<br/>
<br/>

<a name="8" href="index.php#8">8)</a>When our OpenGL/freeGLUT application runs, the operating system needs to be able to find the dll file.<br/>
<br/>
Go find the freeGLUT folder you extracted and from the bin folder inside copy freeglut.dll and put it either
where your executable will run, or inside of the system directory. C:\WINDOWS\SYSTEM32 is the 32bit windows system directory and C:\Windows\SysWOW64 is the
64bit system directory of 32bit applications. For these tutorials, I'm assuming we're making 32bit applications.<br/>
<br/>

<a name="9" href="index.php#9">9)</a>Now go download the <a href="../../01_hello_freeglut.zip">source for lesson 01</a>. Add the source
files inside to your project.<br/>
<br/>
Now build. If there are any errors, make sure you didn't skip a step.<br/>
<br/>
Now that you have OpenGL and freeGLUT compiling, it time to go onto part 2 of the tutorial.

</div>
                    
                
                    
                        <div class="container border py-3 my-3">




The documentation for OpenGL can be found <a href="http://www.opengl.org/documentation/">here</a>.<br/>
The documentation for GLUT (the API freeGLUT is based on) can be found <a href="http://www.opengl.org/documentation/specs/glut/spec3/spec3.html">here</a>.<br/>
The documentation for freeGLUT can be found <a href="http://freeglut.sourceforge.net/docs/api.php">here</a>.<br/>
<br/>
<a href="../../index2.php">Hello OpenGL Part 2: Your First Polygon</a>




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
	<a href="../../../../SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../../index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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