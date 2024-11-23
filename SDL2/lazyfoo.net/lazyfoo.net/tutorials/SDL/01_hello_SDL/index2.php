<!-- Get tutorial set -->


<!-- Tutorial root -->



    <!-- Desktop tutorial set -->
    
        
    

                    

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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac SDL window">
<meta name="description" content="Create your first GUI Window with SDL2!">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Hello SDL: Your First Graphics Window</title>

<script src="../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
	<a href="../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../donate.php" class="nav-item nav-link">Donations</a>
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
    <h1 class="text-center">Hello SDL: Your First Graphics Window</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Hello SDL: Your First Graphics Window screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Apr 26th, 2024</b></p>
    
        This tutorial covers the first major stepping stone: getting a window to pop up.<br/>
<br/>
Now that you have SDL set up, it's time to make a bare bones SDL graphics application that renders a quad on the screen.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Using SDL and standard IO
#include &#060SDL.h&#062
#include &#060stdio.h&#062

//Screen dimension constants
const int SCREEN_WIDTH = 640;
const int SCREEN_HEIGHT = 480;</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of our source file we include SDL since we're going to need the SDL functions and datatypes to make any SDL code. We're also going to include C standard IO to print errors
to the console. You're probably more used to using iostream, but I use printf in my applications because it's more thread safe. For these early applications, use what ever you are
most comfortable with.<br/>
<br/>
After including our headers, we declare the width and height of the window we're going to render to.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">int main( int argc, char* args[] )
{
    //The window we'll be rendering to
    SDL_Window* window = NULL;
    
    //The surface contained by the window
    SDL_Surface* screenSurface = NULL;

    //Initialize SDL
    if( SDL_Init( SDL_INIT_VIDEO ) < 0 )
    {
        printf( "SDL could not initialize! SDL_Error: %s\n", SDL_GetError() );
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the top of our main function. It's important that we have the arguments of the function be an integer followed by a char* array and the return type be an integer. Any other
type of main function will cause an undefined reference to main. SDL requires this type of main so it is compatible with multiple platforms.<br/>
<br/>
We then declare our SDL window which we will be creating in a little bit. Following that we have a screen SDL surface. A SDL surface is just a 2D image. A 2D image can be loaded from a
file or it can be the image inside of a window. In this case it will be the image we see inside of the window on the screen.<br/>
<br/>
After declaring our window and screen surface, we initialize SDL. You can't call any SDL functions without initializing SDL first. Since all we care about is using SDL's video
subsystem, we will only be passing it the SDL_INIT_VIDEO flag.<br/>
<br/>
When there's an error, SDL_Init returns -1. When there's an error we want to print to the console what happened, other wise the application will just flash for a second and then go
away.<br/>
<br/>
If you have never used printf before, it stands for print format. It prints the string in the first argument with the variables in the following arguments. When there's an error here,
"SDL could not initialize! SDL_Error: " will be written to the console followed by the string returned by SDL_GetError. That %s is special formatting. %s means output a string from our
variable list. Since SDL_GetError is the only argument, the string it returns will be added. SDL_GetError returns the latest error produced by an SDL function.<br/>
<br/>
SDL_GetError is a very useful function. Whenever something goes wrong you need to know why. SDL_GetError will let you know if any errors happened inside of any SDL function.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    else
    {
        //Create window
        window = SDL_CreateWindow( "SDL Tutorial", SDL_WINDOWPOS_UNDEFINED, SDL_WINDOWPOS_UNDEFINED, SCREEN_WIDTH, SCREEN_HEIGHT, SDL_WINDOW_SHOWN );
        if( window == NULL )
        {
            printf( "Window could not be created! SDL_Error: %s\n", SDL_GetError() );
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">If SDL initialized successfully, we'll want to create a window using SDL_CreateWindow. The first argument sets the window's caption or this part of the window:
<div class="text-center"><img class="img-fluid" alt="window captions" src="caption.png"></div>
<br/>
The next two arguments define the x and y position the window is created in. Since we don't care where it is created, we just put SDL_WINDOWPOS_UNDEFINED for the x and y position.<br/>
<br/>
The next two arguments define the window's width and height. The last argument are the creation flags. SDL_WINDOW_SHOWN makes sure the window is shown when it is created.<br/>
<br/>
If there is an error, SDL_CreateWindow returns NULL. If there's no window, we want to print out the error to the console.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        else
        {
            //Get window surface
            screenSurface = SDL_GetWindowSurface( window );

            //Fill the surface white
            SDL_FillRect( screenSurface, NULL, SDL_MapRGB( screenSurface->format, 0xFF, 0xFF, 0xFF ) );
            
            //Update the surface
            SDL_UpdateWindowSurface( window );

            //Hack to get window to stay up
            SDL_Event e; bool quit = false; while( quit == false ){ while( SDL_PollEvent( &e ) ){ if( e.type == SDL_QUIT ) quit = true; } }
        }
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">If the window was created successfully, we want to get the window's surface so we can draw to it. SDL_GetWindowSurface does just this.<br/>
<br/>
To keep this tutorial simple, all we're going to do here is fill the window's surface white using SDL_FillRect. Don't worry too much about this function here. This tutorial is only
concerned about getting a window to pop up.<br/>
<br/>
An important thing to know about rendering is that just because you've drawn something to the screen surface doesn't mean you'll see it. After you've done all your drawing you need
to update the window so it shows everything you drew. A call to SDL_UpdateWindowSurface will do this.<br/>
<br/>
If all we do is create the window, fill it, and update it, all we're going to see is a window flash for a second and then close. To keep it from disappearing, we'll put a hacky line to keep it from closing. Normally,
we'd put a delay using SDL_Delay, but the way MacOS handles graphics and input has changed since I first made the tutorial and I do not want to refactor the tutorials to accommodate this. We'll explain how to keep the
window up properly once we get to the events tutorial, but for now this one liner will do.<br/>
<br/>
You may think that's unprofessional, but if you end up working in the gaming industry for any significant amount of time you will quickly find out that hacky code is the basically the only way games get shipped on any
sort of schedule.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Destroy window
    SDL_DestroyWindow( window );

    //Quit SDL subsystems
    SDL_Quit();

    return 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After the window has delayed, we'll destroy the window to free its memory. This will also take care of the SDL_Surface we got from it. After everything is
deallocated, we quit SDL and return 0 to terminate the program.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="01_hello_SDL.zip">Download the media and source code for this demo here.</a><br/>
<br/>

<a href="sdl3-01_hello_SDL.zip">Download SDL3 port of this demo (graciously provided by Sam Lantinga, creator of SDL) here.</a><br/>
<br/>








<a href="../index.php#Hello SDL">Back to Index</a>


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
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
	<a href="../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>