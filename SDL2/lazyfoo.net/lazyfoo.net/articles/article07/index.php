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
<meta name="keywords" content="C++ 2D Windows Linux Mac multiple source files">
<meta name="description" content="Split up your single source C++ applications.">

<link href="../../assets/style.css" rel="stylesheet">
<script src="../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Multiple Source Files</title>

<script src="../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
	<a href="../../tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../index.php" class="nav-item nav-link">Articles</a>
	<a href="../../tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../index.php" class="nav-item nav-link">News</a>
	<a href="../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../donate.php" class="nav-item nav-link">Donations</a>
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
    <h1 class="text-center">Multiple Source Files</h1>
    
    <p class="text-center"><b>Last Updated: Aug 1st, 2022</b></p>
    
        As you saw with the last article, program source codes can get pretty big. Here you'll learn how to break your program's source into smaller, easier to manage pieces.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    The state machine demo had over 1500 lines of code. Any of you that have tried know it's a pain having to search through one big source file. By having your program's source split into multiple source files, you no
longer have to sift through one big chunk of code.<br/>
<br/>
When dealing with multiple source files there's basically two types of files you're going to be dealing with: source files and header files. Standard *.cpp source files you already know as you've been using them since you
started programming. Headers, however, are a bit tricky.<br/>
<br/>
To try to understand what headers do, look in the SDL_image.h file. Inside, you'll see a bunch of declarations of the functions in the SDL_image API like IMG_Load(), IMG_GetError(), IMG_isPNG(), etc, but you don't actually see
the definitions of the functions that load the images, get the errors, and such. Is all that headers do is declare constants/classes/functions/variables?<br/>
<br/>
The answer is yes. All SDL_image.h does is tell the compiler about the functions in SDL_image so it can compile your source file. Is that all it needs? Well, when you try to build your executable, the compiler will compile
your source file, then the linker will try to link everything together into one binary. After it compiles your .cpp file, it will try to look up the actual definitions for the SDL_image functions. When the linker doesn't find the
function definitions in one of the *.cpp files in your project, it will complain that it can't find the definitions and abort.<br/>
<br/>
Well where is the actual code for SDL_image functions? The functions are compiled inside of the SDL_image binary (*.dll on windows and *.so on *nix). To get the linker to stop complaining, we give it a lib file which tells the
linker where function definitions are in the SDL_image binary so it can link dynamically at the program's run time.<br/>
<br/>
This might not make much sense now, but it will after we get our hands dirty by splitting up the motion tutorial
source code into mulitple files.

</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Constants.h</div>


<pre class="border my-0 py-3">#ifndef CONSTANTS_H
#define CONSTANTS_H

//Screen dimension constants
const int SCREEN_WIDTH = 640;
const int SCREEN_HEIGHT = 480;

#endif 
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the code inside of the constants.h file. This header file declares the constants we're going to use in the program.<br/>
<br/>
The preprocessors at the top and the bottom might be new to you. For those of you who don't know what a preprocessor is, it's basically a way to talk to the compiler. For example the #include preprocessor tells the
compiler to include a file into the code.<br/>
<br/>
What "#ifndef CONSTANTS_H" does is asks <b>if</b> CONSTANTS_H is <b>n</b>ot <b>def</b>ined. If CONSTANTS_H is not
defined, the next line defines CONSTANTS_H. Then we continue on with the code that defines the constants. Then
#endif serves as the end of the "#ifndef CONSTANTS_H" condition block.<br/>
<br/>
Now why did we do that?
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">#include "Constants.h"
#include "Constants.h"
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Let's say we had a situation where we included the same file twice.<br/>
<br/>
In the first line where we include Constants.h, the compiler will check if CONSTANTS_H is defined. Since it's not, it will define CONSTANTS_H and use the constants code inside the Constants.h normally.<br/>
<br/>
In the second line when we try to include Constants.h, the compiler will try check if CONSTANTS_H is defined. Because CONSTANTS_H was defined already, it will skip past the code that defines the constants. This prevents the
constants from being defined twice and causing a conflict.<br/>
<br/>
So now you see how this simple but effective safeguard works.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">#ifndef BACON
#define BACON

//The screen attributes
const int SCREEN_WIDTH = 640;
const int SCREEN_HEIGHT = 480;
const int SCREEN_BPP = 32;

//The frame rate
const int FRAMES_PER_SECOND = 20;

//The dimensions of the dot
const int DOT_WIDTH = 20;
const int DOT_HEIGHT = 20;

#endif
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Just for the sake of information, what definition you check for doesn't matter. The above code will work perfectly. The thing is, using FILENAME_H is the common naming standard and as I have mentioned before it's important to use
a naming standard.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Dot.h</div>


<pre class="border my-0 py-3">#ifndef DOT_H
#define DOT_H

#include &#060SDL.h&#062

//The dot that will move around on the screen
class Dot
{
public:
    //The dimensions of the dot
    static const int DOT_WIDTH = 20;
    static const int DOT_HEIGHT = 20;

    //Maximum axis velocity of the dot
    static const int DOT_VEL = 10;

    //Initializes the variables
    Dot();

    //Takes key presses and adjusts the dot's velocity
    void handleEvent( SDL_Event& e );

    //Moves the dot
    void move();

    //Shows the dot on the screen
    void render();

private:
    //The X and Y offsets of the dot
    int mPosX, mPosY;

    //The velocity of the dot
    int mVelX, mVelY;
};

#endif 
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the Dot.h file which declares the Dot class. The general rule is you should have a header file associated with each source file and one class per header/source pair. It's a loose rule that often gets broken in real
professional games, but I recommend sticking to it when you can.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Util.h</div>


<pre class="border my-0 py-3">#ifndef UTIL_H
#define UTIL_H

//Starts up SDL and creates window
bool init();

//Loads media
bool loadMedia();

//Frees media and shuts down SDL
void close();

#endif 
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here are the declarations for our utility functions. Having a bunch of stray functions can be awkward to manage which is why functions are typically tied to some class.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Globals.h</div>


<pre class="border my-0 py-3">#ifndef GLOBALS_H
#define GLOBALS_H

#include "LTexture.h"

//The window we'll be rendering to
extern SDL_Window* gWindow;

//The window renderer
extern SDL_Renderer* gRenderer;

//Scene textures
extern LTexture gDotTexture;

#endif 
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the Globals.h which contains the declarations for the global variables in the program. At the top you see we included LTexture.h because the header needs to know what an LTexture is.<br/>
<br/>
Now the extern keyword you see infront of the global variables might be new to you. Well remember that header files are just supposed to inform the compiler that something exists because the compiler compiles each cpp file
independently of one another. If we didn't have extern infront of the globals, when the header is included in a source file the compiler will create a copy of the variable for that source file. Then when the linker tries to
link everything together, it will find multiple copies of the same variable and it will complain and abort.<br/>
<br/>
The extern keyword just tells the compiler the variable exists somewhere. Now you won't have multiple definitions of the same variable, but where are the actual globals located? 
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Globals.cpp</div>


<pre class="border my-0 py-3">#include "Globals.h"
#include "LTexture.h"

//The window we'll be rendering to
SDL_Window* gWindow = NULL;

//The window renderer
SDL_Renderer* gRenderer = NULL;

//Scene textures
LTexture gDotTexture;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When the linker looks for the definitions for the of the globals, it'll find them in the Globals.cpp source file. Also notice this is where we initialize the globals which makes sense since these are the actual variables and not
just a declaration.<br/>
<br/>
Just a tip: in case you mess up with the globals and get a multiple definiton error and then you fix the source code but the linker still complains, try rebuilding the whole project. To save time, the compiler will only
recompile the source codes that have been changed, and since the source files haven't been changed, the linker stll has them compiled with multiple definitons. Rebuilding them will get rid of the old compiled code.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Dot.h</div>


<pre class="border my-0 py-3">#include "Dot.h"
#include "Globals.h"
#include "Constants.h"

Dot::Dot()
{
    //Initialize the offsets
    mPosX = 0;
    mPosY = 0;

    //Initialize the velocity
    mVelX = 0;
    mVelY = 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the top of the Dot.cpp file which defines the Dot class.<br/>
<br/>
As a general rule, make sure to only include the files you need to. Just including everything can cause unnecessary overhead and dependencies when compiling.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Util.cpp</div>


<pre class="border my-0 py-3">#include "Util.h"
#include "Globals.h"
#include "Constants.h"

bool init()
{
    //Initialization flag
    bool success = true;

    //Initialize SDL
    if( SDL_Init( SDL_INIT_VIDEO ) < 0 )
    {
        printf( "SDL could not initialize! SDL Error: %s\n", SDL_GetError() );
        success = false;
    }
    else
    {
        //Set texture filtering to linear
        if( !SDL_SetHint( SDL_HINT_RENDER_SCALE_QUALITY, "1" ) )
        {
            printf( "Warning: Linear texture filtering not enabled!" );
        }

        //Create window
        gWindow = SDL_CreateWindow( "SDL Tutorial", SDL_WINDOWPOS_UNDEFINED, SDL_WINDOWPOS_UNDEFINED, SCREEN_WIDTH, SCREEN_HEIGHT, SDL_WINDOW_SHOWN );
        if( gWindow == NULL )
        {
            printf( "Window could not be created! SDL Error: %s\n", SDL_GetError() );
            success = false;
        }
        else
        {
            //Create vsynced renderer for window
            gRenderer = SDL_CreateRenderer( gWindow, -1, SDL_RENDERER_ACCELERATED | SDL_RENDERER_PRESENTVSYNC );
            if( gRenderer == NULL )
            {
                printf( "Renderer could not be created! SDL Error: %s\n", SDL_GetError() );
                success = false;
            }
            else
            {
                //Initialize renderer color
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );

                //Initialize PNG loading
                int imgFlags = IMG_INIT_PNG;
                if( !( IMG_Init( imgFlags ) & imgFlags ) )
                {
                    printf( "SDL_image could not initialize! SDL_image Error: %s\n", IMG_GetError() );
                    success = false;
                }
            }
        }
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the top of Util.cpp file. Another common convention to follow is to include the matching header file at the top of the include block, and then include the supplementary headers afterward. Remember how header files
are included and processed sequentially, so you want to maintain a consistent order to prevent inconsistent behavior.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Main.cpp</div>


<pre class="border my-0 py-3">#include "Util.h"
#include "Dot.h"
#include "Globals.h"

int main( int argc, char* args[] )
{
    //Start up SDL and create window
    if( !init() )
    {
        printf( "Failed to initialize!\n" );
    }
    else
    {
        //Load media
        if( !loadMedia() )
        {
            printf( "Failed to load media!\n" );
        }
        else
        {    
            //Main loop flag
            bool quit = false;

            //Event handler
            SDL_Event e;

            //The dot that will be moving around on the screen
            Dot dot;

            //While application is running
            while( !quit )
            {
                //Handle events on queue
                while( SDL_PollEvent( &e ) != 0 )
                {
                    //User requests quit
                    if( e.type == SDL_QUIT )
                    {
                        quit = true;
                    }

                    //Handle input for the dot
                    dot.handleEvent( e );
                }

                //Move the dot
                dot.move();

                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render objects
                dot.render();

                //Update screen
                SDL_RenderPresent( gRenderer );
            }
        }
    }

    //Free resources and close SDL
    close();

    return 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally The main function itself is exactly the same as its single source file counterpart. Even though this could be considered a utility function, it is convention to put the main function in its own source file.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">



<a href="07_multiple_source_files.zip">Download the media and source code for this demo here.</a><br/>
<br/>





<a href="../index.php#Multiple Source Files">Back to Index</a>


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
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
	<a href="../../tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../index.php" class="nav-item nav-link">Articles</a>
	<a href="../../tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../index.php" class="nav-item nav-link">News</a>
	<a href="../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>