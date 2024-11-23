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
<meta name="keywords" content="SDL 2 C++ Tutorial 2D Windows Install SDL 2 mingw">
<meta name="description" content="Install SDL 2 on MinGW.">

<link href="../../../../../assets/style.css" rel="stylesheet">
<script src="../../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL 2 on MinGW</title>

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
    <h1 class="text-center">Setting up SDL 2 on MinGW</h1>
    
    <p class="text-center"><b>Last Updated: Sep 22nd, 2022</b></p>
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <a name="1" href="index.php#1">1)</a> First thing you need to do is download SDL headers, libary and binaries. You will find them on the SDL GitHub, specifically on 
<a href="https://github.com/libsdl-org/SDL/releases">this page</a>.<br/>
<br/>
You'll want to download the MinGW development libraries.<br/>
<div class="text-center"><img class="img-fluid" alt="download mingw" class="img-fluid" alt="download mingw" src="../sdl2_mingw.png"></div>
<br/>
Open the gzip archive and there should be a tar archive. Open up the tar archive and the should be a folder called SDL2-2.<i>something</i>.<i>something</i>. Inside of that folder there should be a bunch of folders and files,
most importantly <b>i686-w64-mingw32</b> which contains the 32bit library and <b>x86_64-w64-mingw32</b> which contains the 64bit library.<br/>
<br/>
<b>This is important:</b> most compilers still compile 32bit binaries by default to maximize compatibility. We will be using the 32bit binaries for this tutorial set. It doesn't matter if you have a 64bit operating system,
since we are compiling 32bit binaries we will be using the 32bit library.<br/>
<br/>
Inside of i686-w64-mingw32 are the include, lib, and bin folders which contain everything we need compile and run SDL applications. Copy the contents of i686-w64-mingw32 to any directory you want. I recommend putting it in a 
folder that you dedicate to holding all your development libraries for MinGW. For these tutorials I'm putting it in a directory I created C:\mingw_dev_lib<br/>
<br/>
<a name="2" href="index.php#2">2)</a> Next you're going to want to get up the path for mingw so you can run mingw commands in any directory. Open up the system menu either by A) right clicking My Computer and selecting Properties or
B) going to the Control Panel and selecting the system menu. Once your in the system menu, click advanced system settings.
<div class="text-center"><img class="img-fluid" alt="Advanced system settings" src="system.png"></div>
<br/>
and then click environment variables
<div class="text-center"><img class="img-fluid" alt="env vars" src="environment_variables.png"></div>
<br/>
Under system variables, select the "Path" variable and click edit.
<div class="text-center"><img class="img-fluid" alt="edit path" src="edit_path.png"></div>
<br/>
What the path variable does is tell the OS where to look when running an executable. What we want to do is whenever we run the g++ command, the OS should look in the MinGW bin directory where g++.exe is located. If you
installed MinGW by itself, the MinGW bin directory should be<br/>
<br/>
<code>C:\MinGW\bin</code><br/>
<br/>
Append it to the long list of paths with a semi-colon after it and click ok.
<div class="text-center"><img class="img-fluid" alt="adding path" src="add_path.png"></div>

If you're using an IDE like Code::Blocks which uses MinGW, you can also set its MinGW bin directory which should be at<br/>
<br/>
<code>C:\Program Files (x86)\CodeBlocks\MinGW\bin</code><br/>
<br/>
Now when ever you run a command that uses a MinGW executable, the OS will know to look in the MinGW bin directory.<br/>
<br/>
If you run your program and it complains that it can't find SDL2.dll, it means you did not set the path correctly.<br/>
<br/>
<a name="3" href="index.php#3">3)</a> Now go download the <a href="../../01_hello_SDL.zip">source for lesson 01</a>. Extract the source somewhere. Open up a command window in the directory by holding shift and right clicking.
<div class="text-center"><img class="img-fluid" alt="command line" src="command.png"></div>
<br/>
Now compile by entering this big old command (This command assumed you have SDL 2 extracted at C:\mingw_dev_lib):<br/>
<br/>
<code>g++ 01_hello_SDL.cpp -IC:\mingw_dev_lib\include\SDL2 -LC:\mingw_dev_lib\lib -w -Wl,-subsystem,windows -lmingw32 -lSDL2main -lSDL2 -o 01_hello_SDL</code><br/>
<br/>

Having to manually punch in this compilation command gets very tedious very quickly. This is why I recommend using Make.<br/>
<br/>
<a name="4" href="index.php#4">4)</a> MingGW Make allows you to make build scripts that'll automate the compilation process.

</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Basic Makefile</div>


<pre class="border my-0 py-3">#OBJS specifies which files to compile as part of the project
OBJS = 01_hello_SDL.cpp

#OBJ_NAME specifies the name of our exectuable
OBJ_NAME = 01_hello_SDL

#This is the target that compiles our executable
all : $(OBJS)
g++ $(OBJS) -IC:\mingw_dev_lib\include\SDL2 -LC:\mingw_dev_lib\lib -w -Wl,-subsystem,windows -lmingw32 -lSDL2main -lSDL2 -o $(OBJ_NAME)
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we have a basic Makefile. At the top we declare and set the "OBJS" macro which specifies which files we're compiling. Then we set the "OBJ_NAME" macro that specifies the name of our executable.<br/>
<br/>
After setting these two macros, we have the "all" target which compiles the program. It's followed by the dependencies which as you can see is the OBJS macro, because obviously you need the source files to compile
the program.<br/>
<br/>
After specifying the name of the target and its dependencies, the command to create the target is on the next line. <b>The command to create the target must begin with a tab or Make will reject it</b>.<br/>
<br/>
As you would expect, the command to compile the program is largely the same as the command we would compile it off the command line. A key difference is that we have macros that we insert into the command which makes things
like adding new files to the project must easier since you only have to change the macro as opposed to changing the whole command.<br/>
<br/>
In future tutorials, we will be using more libraries. We should probably use more macros to make the process of adding them easier.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Makefile</div>


<pre class="border my-0 py-3">#OBJS specifies which files to compile as part of the project
OBJS = 01_hello_SDL.cpp

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
LINKER_FLAGS = -lmingw32 -lSDL2main -lSDL2

#OBJ_NAME specifies the name of our exectuable
OBJ_NAME = 01_hello_SDL

#This is the target that compiles our executable
all : $(OBJS)
$(CC) $(OBJS) $(INCLUDE_PATHS) $(LIBRARY_PATHS) $(COMPILER_FLAGS) $(LINKER_FLAGS) -o $(OBJ_NAME)
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now our compilation command is much more flexible.<br/>
<br/>
Near the top we have the macros that define the files we're compiling and the compiler we're using.<br/>
<br/>
Next we have the "INCLUDE_PATHS" macro which specifies the additional directories we're getting header files from. As you can see, we're using the include directory
from the SDL2 folder we extacted earlier. The "LIBRARY_PATHS" sets the additional library file paths. Notice how there's a <b>-I</b> before every include directory
and a <b>-L</b> before every library directory.<br/>
<br/>
The "COMPILER_FLAGS" macro are the additional options we use when compiling. In this case we're disabling all warnings and disabling the console window. The
"LINKER_FLAGS" macro specifies which libraries we're linking against. Here we're compiling against 32bit mingw, SDL2, and SDL2main. Notice how there's a <b>-l</b>
flag before every library.<br/>
<br/>
Finally at the bottom we have our target compiling using all of our macros. Thanks to macros we can very easily change the macros to add more files and libraries as we
need them.<br/>
<br/>
Save this Makefile code to a file named "Makefile" (case sensitive with no file extension) or you can use <a href="Makefile">the premade Makefile here</a>.
Open a command line in the directory with the source files and run the command <b>mingw32-make.exe</b>. Make will search for a file named "Makefile" in the directory
Make was called in and run the Makefile that will compile your code.<br/>
<br/>
Now that you have SDL 2 compiling, it time to go onto part 2 of the tutorial.<br/>
<br/>
Note: to run your application you'll have to add the SDL2 i686-w64-mingw32 bin directory to your PATH just like you added MinGW bin directory so Windows can find SDL2.dll.
If you updated the PATH environment variable you'll need to close your command prompt and open a new one because the command prompt only reads updated environment variables when it opens.
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