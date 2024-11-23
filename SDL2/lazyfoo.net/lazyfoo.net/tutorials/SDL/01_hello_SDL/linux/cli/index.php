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
<meta name="keywords" content="SDL 2 C++ Tutorial Linux install g++ cli">
<meta name="description" content="Install SDL 2 for Linux command line.">

<link href="../../../../../assets/style.css" rel="stylesheet">
<script src="../../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL 2 on g++</title>

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
    <h1 class="text-center">Setting up SDL 2 on g++</h1>
    
    <p class="text-center"><b>Last Updated: Jun 21st, 2014</b></p>
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <a name="1" href="index.php#1">1)</a> Go download the <a href="../../01_hello_SDL.zip">source for lesson 01</a>. Extract the source somewhere. Now compile by entering this command:<br/>
<br/>
<code>g++ 01_hello_SDL.cpp -w -lSDL2 -o 01_hello_SDL</code><br/>
<br/>
Now you may get an error saying it can't find SDL.h. For linux, we'll have to include the SDL headers like this:<br/>
<br/>
<code>#include &#060SDL2/SDL.h&#062</code><br/>
<br/>

As the programs get bigger and bigger, having to manually punch in this compilation command gets very tedious very quickly. This is why I recommend using Make.<br/>
<br/>
<a name="2" href="index.php#2">2)</a> GNU Make allows you to make build scripts that'll automate the compilation process.

</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Basic Makefile</div>


<pre class="border my-0 py-3">#OBJS specifies which files to compile as part of the project
OBJS = 01_hello_SDL.cpp

#OBJ_NAME specifies the name of our exectuable
OBJ_NAME = 01_hello_SDL

#This is the target that compiles our executable
all : $(OBJS)
g++ $(OBJS) -w -lSDL2 -o $(OBJ_NAME)
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we have a basic Makefile. At the top we declare and set the "OBJS" macro which specifies which files we're compiling. Then we set the "OBJ_NAME" macro that specifies
the name of our executable.<br/>
<br/>
After setting these two macros, we have the "all" target which compiles the program. It's followed by the dependencies which as you can see is the OBJS macro, because
obviously you need the source files to compile the program.<br/>
<br/>
After specifying the name of the target and its dependencies, the command to create the target is on the next line. <b>The command to create the target must begin with a
tab or Make will reject it</b>.<br/>
<br/>
As you would expect, the command to compile the program is largely the same as the command we would compile it off the command line. A key difference is that we have
macros that we insert into the command which makes things like adding new files to the project must easier since you only have to change the macro as opposed to changing
the whole command.<br/>
<br/>
In future tutorials, we will be using more libraries. We should probably use more macros to make the process of adding them easier.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Makefile</div>


<pre class="border my-0 py-3">#OBJS specifies which files to compile as part of the project
OBJS = 01_hello_SDL.cpp

#CC specifies which compiler we're using
CC = g++

#COMPILER_FLAGS specifies the additional compilation options we're using
# -w suppresses all warnings
COMPILER_FLAGS = -w

#LINKER_FLAGS specifies the libraries we're linking against
LINKER_FLAGS = -lSDL2

#OBJ_NAME specifies the name of our exectuable
OBJ_NAME = 01_hello_SDL

#This is the target that compiles our executable
all : $(OBJS)
$(CC) $(OBJS) $(COMPILER_FLAGS) $(LINKER_FLAGS) -o $(OBJ_NAME)
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now our compilation command is much more flexible.<br/>
<br/>
Near the top we have the macros that define the files we're compiling and the compiler we're using.<br/>
<br/>
The "COMPILER_FLAGS" macro are the additional options we use when compiling. In this case we're disabling all warnings. The
"LINKER_FLAGS" macro specifies which libraries we're linking against. Here we're compiling against SDL2. Notice how there's a <b>-l</b>
flag before the library.<br/>
<br/>
Finally at the bottom we have our target compiling using all of our macros. Thanks to macros we can very easily change the macros to add more files and libraries as we
need them.<br/>
<br/>
Save this Makefile code to a file named "Makefile" (case sensitive with no file extension) or you can use <a href="Makefile">the Makefile I premade here</a>.
Open a command line in the directory with the source files and run the command <code>make all</code>. Make will search for a file named "Makefile" in the directory
Make was called in and run the Makefile that will compile your code.<br/>
<br/>
Now that you have SDL2 compiling, it time to go onto part 2 of the tutorial.
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