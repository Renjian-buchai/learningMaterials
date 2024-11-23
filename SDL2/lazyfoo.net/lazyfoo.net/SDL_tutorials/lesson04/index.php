<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" 
"http://www.w3.org/TR/REC-html40/strict.dtd">
<html>

<head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VP5RSQ168Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VP5RSQ168Y');
</script>



<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">

<META NAME=KEYWORDS CONTENT="Lazy Foo' Productions C++ SDL Window Linux Mac Game Programming Tutorials">

<META NAME=DESCRIPTION CONTENT="Tutorials for those who want to start making video games.">

<title>Lazy Foo' Productions</title>

<link REL="stylesheet" TYPE="text/css" href="../lazy.css">
</head>

<body>

<div class="header">
<h1 style="margin-bottom:0px;padding-bottom:0px;border-bottom:0px;">Lazy Foo' Productions</h1>

<div class="nav">
Yes, I am keeping the old tutorial set in the old layout for the sake of having a nostalgic eater egg. It's not because I am too lazy to port this over to the data driven static site generator.<br/>
<br/>
<a class="nav" href="https://discourse.libsdl.org/">SDL Forums</a>
<a class="nav" href="../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../articles/index.php">Articles</a>
<a class="nav" href="../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../index.php">News</a>
<a class="nav" href="../../faq.php">FAQs</a>
<a class="nav" href="../../contact.php">Contact</a>
<a class="nav" href="../../donate.php">Donations</a><br/>
<br/>

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

</div>

</div>

<div class="content">
<div class="tutPreface"><h1 class="tutHead">Event Driven Programming</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 1/1/14</h6>
Up until this point you're probably used to command driven programs using cin and cout. This tutorial will teach
you how to check for events and handle events.<br>
<br>
An event is simply something that happens. It could be a key press, movement of the mouse, resizing the window or
in this case when the user wants to X out the window.<br/>
<br/>
An <a class="tutLink" href="../../tutorials/SDL/03_event_driven_programming/index.php">Event Driven Programming tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The headers
#include "SDL/SDL.h"
#include "SDL/SDL_image.h"
#include &#060string&#062

//Screen attributes
const int SCREEN_WIDTH = 640;
const int SCREEN_HEIGHT = 480;
const int SCREEN_BPP = 32;

//The surfaces
SDL_Surface *image = NULL;
SDL_Surface *screen = NULL;
</div>

<div class="tutText">
Here we have the same story as before, we have our headers, constants and surfaces.
</div>

<div class="tutCode">//The event structure that will be used
SDL_Event event;
</div>

<div class="tutText">
Now this is new. A SDL_Event structure stores event data for us to handle.
</div>

<div class="tutCode">SDL_Surface *load_image( std::string filename ) 
{
    //The image that's loaded
    SDL_Surface* loadedImage = NULL;
    
    //The optimized image that will be used
    SDL_Surface* optimizedImage = NULL;
    
    //Load the image
    loadedImage = IMG_Load( filename.c_str() );
    
    //If the image loaded
    if( loadedImage != NULL )
    {
        //Create an optimized image
        optimizedImage = SDL_DisplayFormat( loadedImage );
        
        //Free the old image
        SDL_FreeSurface( loadedImage );
    }
    
    //Return the optimized image
    return optimizedImage;
}

void apply_surface( int x, int y, SDL_Surface* source, SDL_Surface* destination )
{
    //Temporary rectangle to hold the offsets
    SDL_Rect offset;
    
    //Get the offsets
    offset.x = x;
    offset.y = y;
    
    //Blit the surface
    SDL_BlitSurface( source, NULL, destination, &offset );
}
</div>

<div class="tutText">
Here we have our surface loading and blitting functions.
Nothing has changed from the previous tutorial.
</div>

<div class="tutCode">bool init()
{
    //Initialize all SDL subsystems
    if( SDL_Init( SDL_INIT_EVERYTHING ) == -1 )
    {
        return false;    
    }
    
    //Set up the screen
    screen = SDL_SetVideoMode( SCREEN_WIDTH, SCREEN_HEIGHT, SCREEN_BPP, SDL_SWSURFACE );
    
    //If there was an error in setting up the screen
    if( screen == NULL )
    {
        return false;    
    }
    
    //Set the window caption
    SDL_WM_SetCaption( "Event test", NULL );
    
    //If everything initialized fine
    return true;
}
</div>

<div class="tutText">
Here is the initialization function. This function starts up SDL, sets up the window, sets the caption and returns false if there are any errors.<br>
</div>

<div class="tutCode">bool load_files()
{
    //Load the image
    image = load_image( "x.png" );
    
    //If there was an error in loading the image
    if( image == NULL )
    {
        return false;    
    }
    
    //If everything loaded fine
    return true;    
}
</div>

<div class="tutText">
Here is the file loading function. It loads the images, and returns false if there were any problems.
</div>

<div class="tutCode">void clean_up()
{
    //Free the image
    SDL_FreeSurface( image );
    
    //Quit SDL
    SDL_Quit();    
}
</div>

<div class="tutText">
Here we have the end of the program clean up function.
It frees up the surface and quits SDL.
</div>

<div class="tutCode">int main( int argc, char* args[] )
{
    //Make sure the program waits for a quit
    bool quit = false;
</div>

<div class="tutText">
Now we enter the main function.<br>
<br>
Here we have the quit variable which keeps track of whether the user wants to quit.
Since the program just started we set it to false or the program will end immediately.
</div>

<div class="tutCode">    //Initialize
    if( init() == false )
    {
        return 1;    
    }
    
    //Load the files
    if( load_files() == false )
    {
        return 1;    
    }
</div>

<div class="tutText">
Now we call the initialization and file loading functions we made earlier.
</div>

<div class="tutCode">    //Apply the surface to the screen
    apply_surface( 0, 0, image, screen );
    
    //Update the screen
    if( SDL_Flip( screen ) == -1 )
    {
        return 1;    
    }
</div>

<div class="tutText">
Then we show the image on the screen.
</div>

<div class="tutCode">    //While the user hasn't quit
    while( quit == false )
    {
</div>

<div class="tutText">
Now we start the main loop.
This loop will keep going until the user sets quit to true.
</div>

<div class="tutCode">        //While there's an event to handle
        while( SDL_PollEvent( &event ) )
        {
</div>

<div class="tutText">
In SDL whenever an event happens, it is put on the event queue.
The event queue holds the event data for every event that happens.<br>
<br>
So if you were to press a mouse button, move the mouse around,
then press a keyboard key, the event queue would look something like this:<br>
<div class="tutImg"><img src="queue.jpg"></div>
<br>
What SDL_PollEvent() does is take an event from the queue and sticks its data in our event structure:<br>
<div class="tutImg"><img src="poll.jpg"></div>
<br>
What this code does is keep getting event data while there's events on the queue.
</div>

<div class="tutCode">            //If the user has Xed out the window
            if( event.type == SDL_QUIT )
            {
                //Quit the program
                quit = true;
            }    
        }
    }
</div>

<div class="tutText">
When the user Xs out the window, the event type will be SDL_QUIT.<br>
<br>
But when the user does that it does not end the program, all it does inform us the user wants to exit the program.<br>
<br>
Since we want the program to end when the user Xs the window, we set quit to true and it will break the loop we are in.
</div>

<div class="tutCode">    //Free the surface and quit SDL
    clean_up();
        
    return 0;    
}
</div>

<div class="tutText">
Finally, we do the end of the program clean up.<br>
<br>
There are other ways to handle events like SDL_WaitEvent() and SDL_PeepEvents(). You can find out more about them
in the SDL documentation.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson04.zip">here</a>.<br>
<br>
On a side note, now would also be a good time to learn to use the SDL error functions. I don't have a tutorial on
them, but I touch on them in <a class="tutLink" href="../../articles/article05/index.php">article 5</a>. The SDL
documentation should explain SDL_GetError(), and the SDL_image documentation should explain IMG_GetError().
SDL_ttf and SDL_mixer also have their error functions so remember to look those up in their documentations.<br>
<br>
<a class="leftNav" href="../lesson03/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson05/index.php">Next Tutorial</a><br>
</div>

</div>

<div class="footer">


<div class="nav">

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
<br/>
<a class="nav" href="https://discourse.libsdl.org/">SDL Forums</a>
<a class="nav" href="../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../articles/index.php">Articles</a>
<a class="nav" href="../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../index.php">News</a>
<a class="nav" href="../../faq.php">FAQs</a>
<a class="nav" href="../../contact.php">Contact</a>
<a class="nav" href="../../donate.php">Donations</a>
</div>

<h6>Copyright Lazy Foo' Productions 2004-2024</h6>
</div>

</body>
</html>