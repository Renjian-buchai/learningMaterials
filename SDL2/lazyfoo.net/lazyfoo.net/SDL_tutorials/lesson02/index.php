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
<div class="tutPreface"><h1 class="tutHead">Optimized Surface Loading and Blitting</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 1/1/14</h6>
Now that you got an image on the screen in
<a class="tutLink" href="../lesson01/index2.php">part 2 of the last tutorial</a>, it's time do your surface
loading and blitting in a more efficient way.<br/>
<br/>
An <a class="tutLink" href="../../tutorials/SDL/05_optimized_surface_loading_and_soft_stretching/index.php">Optimized Surface Loading and Blitting tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The headers
#include "SDL/SDL.h"
#include &#060string&#062
</div>

<div class="tutText">
Here are our headers for this program.<br>
<br>
SDL.h is included because obviously we're going to need SDL's functions.<br>
<br>
The string header is used because ... eh I just like std::string over char*<br>
</div>

<div class="tutCode">//The attributes of the screen
const int SCREEN_WIDTH = 640;
const int SCREEN_HEIGHT = 480;
const int SCREEN_BPP = 32;
</div>

<div class="tutText">
Here we have the various attributes of the screen.<br>
<br>
I'm pretty sure you can figure out what SCREEN_WIDTH and SCREEN_HEIGHT are.
SCREEN_BPP is the bits per-pixel. In all of the tutorials, 32-bit color will be used.
</div>

<div class="tutCode">//The surfaces that will be used
SDL_Surface *message = NULL;
SDL_Surface *background = NULL;
SDL_Surface *screen = NULL;
</div>

<div class="tutText">
These are the three images that are going to be used.<br>
<br>
"background" is obviously going to be the background image, "message" is the bitmap that says "Hello" and
"screen" is obviously the screen.<br>
<br>
Remember: its a good idea to always set your pointers to NULL if they're not pointing to anything.
</div>

<div class="tutCode">SDL_Surface *load_image( std::string filename ) 
{
    //Temporary storage for the image that's loaded
    SDL_Surface* loadedImage = NULL;
    
    //The optimized image that will be used
    SDL_Surface* optimizedImage = NULL;
</div>

<div class="tutText">
Here we have our image loading function.<br>
<br>
What this function does is load the image, then returns a pointer to the optimized version of the loaded image.<br>
<br>
The argument "filename" is the path of the image to be loaded.
"loadedImage" is the surface we get when the image is loaded.
"optimizedImage" is the surface that is going to be used.
</div>

<div class="tutCode">    //Load the image
    loadedImage = SDL_LoadBMP( filename.c_str() );
</div>

<div class="tutText">
First the image is loaded using SDL_LoadBMP().<br>
<br>
But it shouldn't be used immediately because the bitmap is 24-bit. The screen is 32-bit and it's not a good idea
to blit a surface onto another surface that is a different format because SDL will have to change the format on
the fly which causes slow down.<br>
</div>

<div class="tutCode">    //If nothing went wrong in loading the image
    if( loadedImage != NULL )
    {
        //Create an optimized image
        optimizedImage = SDL_DisplayFormat( loadedImage );
        
        //Free the old image
        SDL_FreeSurface( loadedImage );
    }
</div>

<div class="tutText">
Next we check if the image was loaded properly. If there was an error, loadedImage will be NULL.<br>
<br>
If the image loaded fine, SDL_DisplayFormat() is called which creates a new version of "loadedImage" in the same
format as the screen. The reason we do this is because when you try to stick one surface onto another one of a
different format, SDL converts the surface so they're the same format.<br>
<br>
Creating the converted surface every time you blit wastes processing power which costs you speed. Because we
convert the surface when we load it, when you want to apply the surface to the screen, the surface is already the
same format as the screen. Now SDL won't have to convert it on the fly.<br>
<br>

So now we have 2 surfaces, the old loaded image and the new optimized image.<br>
<div class="tutImg"><img src="displayformat.jpg"></div>
SDL_DisplayFormat() created a new optimized surface but didn't get rid of the old one.<br>
<br>
So we call SDL_FreeSurface() to get rid of the old loaded image.<br>
<div class="tutImg"><img src="freesurface.jpg"></div>
</div>

<div class="tutCode">    //Return the optimized image
    return optimizedImage;
}
</div>

<div class="tutText">
Then the newly made optimized version of the loaded image is returned.
</div>

<div class="tutCode">void apply_surface( int x, int y, SDL_Surface* source, SDL_Surface* destination )
{
    //Make a temporary rectangle to hold the offsets
    SDL_Rect offset;
    
    //Give the offsets to the rectangle
    offset.x = x;
    offset.y = y;
</div>

<div class="tutText">
Here we have our surface blitting function.<br>
<br>
It takes in the coordinates of where you want to blit the surface, the surface you're going to blit and the
surface you're going to blit it to.<br>
<br>
First we take the offsets and put them inside an SDL_Rect. We do this because SDL_BlitSurface() only accepts the
offsets inside of an SDL_Rect.<br>
<br>
An SDL_Rect is a data type that represents a rectangle. It has four members representing the X and Y offsets, the
width and the height of a rectangle. Here we're only concerned about x and y data members.
</div>

<div class="tutCode">    //Blit the surface
    SDL_BlitSurface( source, NULL, destination, &offset );
}
</div>

<div class="tutText">
Now we actually blit the surface using SDL_BlitSurface().<br>
<br>
The first argument is the surface we're using.<br>
Don't worry about the second argument, we'll just set it to NULL for now.<br>
The third argument is the surface we're going to blit on to.<br>
The fourth argument holds the offsets to where on the destination the source is going to be applied.
</div>

<div class="tutCode">int main( int argc, char* args[] )
{
</div>

<div class="tutText">
Now we start the main function.<br>
<br>
When using SDL, you should always use:<br>
int main( int argc, char* args[] )<br>
<br>
or<br>
<br>
int main( int argc, char** args )<br>
<br>
Using int main(), void main(), or any other kind won't work.
</div>

<div class="tutCode">    //Initialize all SDL subsystems
    if( SDL_Init( SDL_INIT_EVERYTHING ) == -1 )
    {
        return 1;    
    }
</div>

<div class="tutText">
Here we start up SDL using SDL_Init().<br>
<br>
We give SDL_Init() SDL_INIT_EVERYTHING, which starts up every SDL subsystem. SDL subsystems are things like the
video, audio, timers, etc that are the individual engine components used to make a game.<br>
<br>
We're not going to use every subsystem but it's not going to hurt us if they're initialized anyway.<br>
<br>
If SDL can't initialize, it returns -1. In this case we handle the error by returning 1, which will end the
program.
</div>

<div class="tutCode">    //Set up the screen
    screen = SDL_SetVideoMode( SCREEN_WIDTH, SCREEN_HEIGHT, SCREEN_BPP, SDL_SWSURFACE );
</div>

<div class="tutText">
Now it's time to make our window and get a pointer to the window's surface so we can blit images to the screen.<br>
<br>
You already know what the first 3 arguments do. The fourth argument creates the screen surface in system memory.
</div>

<div class="tutCode">    //If there was an error in setting up the screen
    if( screen == NULL )
    {
        return 1;    
    }
</div>

<div class="tutText">
If there was a problem in making the screen pop up, screen will be set to NULL.
</div>

<div class="tutCode">    //Set the window caption
    SDL_WM_SetCaption( "Hello World", NULL );
</div>

<div class="tutText">
Here the caption is set to "Hello World".<br>
<br>
The caption is this part of the window:<br>
<div class="tutImg"><img src="caption.jpg"></div>
</div>

<div class="tutCode">    //Load the images
    message = load_image( "hello.bmp" );
    background = load_image( "background.bmp" );
</div>

<div class="tutText">
Now the images are loaded using the image loading function we made.
</div>

<div class="tutCode">    //Apply the background to the screen
    apply_surface( 0, 0, background, screen );
</div>

<div class="tutText">
Now it's time to apply the background with the function we made.<br>
<br>
Before we blitted the background, the screen looked like this:<br>
<div class="tutImg"><img src="blank.jpg"></div>
<br>
But now that we blitted the background image, the screen looks like this in memory:<br>
<div class="tutImg"><img src="background.jpg"></div>
<br>
When you blit, you copy the pixels from one surface onto another. So now the screen has our background image in
the top left corner, but we want to fill up the entire screen. Does that mean we have to load the background image
3 more times?
</div>

<div class="tutCode">    apply_surface( 320, 0, background, screen );
    apply_surface( 0, 240, background, screen );
    apply_surface( 320, 240, background, screen );</div>

<div class="tutText">
Nope.  We can just blit the same surface 3 more times.
</div>

<div class="tutCode">    //Apply the message to the screen
    apply_surface( 180, 140, message, screen );
</div>

<div class="tutText">
Now we're going to apply the message surface onto the screen at x offset 180 and y offset 140.<br>
<br>
The thing is SDL coordinate system doesn't work like this:<br>
<div class="tutImg"><img src="cartesian.jpg"></div>
<br>
SDL's coordinate system works like this:<br>
<div class="tutImg"><img src="sdlcoord.jpg"></div>
So the origin (0,0) is at the top left corner instead of the bottom left.<br>
<br>
So when you blit the message surface, it's going to blit it 180 pixels right, and 140 pixels down from the origin
in the top left corner:<br>
<div class="tutImg"><img src="coorddemo.jpg"></div>
<br>
SDL's coordinate system is awkward at first but you'll get used to it.
</div>

<div class="tutCode">    //Update the screen
    if( SDL_Flip( screen ) == -1 )
    {
        return 1;    
    }
</div>

<div class="tutText">
Even though we have applied our surfaces, the screen we see is still blank.<br>
<br>
Now we have to update the screen using SDL_Flip() so that the screen surface we have in memory matches the one
shown on the screen.<br>
<br>
If there's an error it will return -1.<br>
</div>

<div class="tutCode">    //Wait 2 seconds
    SDL_Delay( 2000 );
</div>

<div class="tutText">
We call SDL_Delay() so that the window doesn't just flash on the screen for a split second. SDL_Delay() accepts
time in milliseconds, or 1/1000 of a second.<br>
<br>
So the window will stay up for 2000/1000 of a second or 2 seconds.
</div>

<div class="tutCode">    //Free the surfaces
    SDL_FreeSurface( message );
    SDL_FreeSurface( background );
    
    //Quit SDL
    SDL_Quit();
    
    //Return
    return 0;
}
</div>

<div class="tutText">
Now we do the end of the program clean up.<br>
<br>
SDL_FreeSurface() is used to get rid of the surfaces we loaded since we're not using them anymore. If we don't
free the memory we used, we will cause a memory leak.<br>
<br>
Then SDL_Quit() is called to quit SDL. Then we return 0, ending the program.<br>
<br>
You may be asking yourself "why aren't we freeing the screen surface?". Don't worry. SDL_Quit() will take care of
that for us.
</div>

<div class="tutText">
If you run the program and the images don't show up or the window flashes for a second and you find in stderr.txt:<br>
Fatal signal: Segmentation Fault (SDL Parachute Deployed)<br>
<br>
It's because the program tried to access memory it wasn't supposed to.
Odds are it's because it tried to access NULL when apply_surface() was called.
This means you need to make sure the bitmap files are in the same directory as the program.<br>
<br>
If the window pops up and the image doesn't show up, again make sure the bitmaps are in the same folder as the
program or in the project directory.<br>
<br>
If you're using Visual Studio and the compiler complains about <b>'SDL/SDL.h': No such file or directory</b>,
go to the top of the source code and make sure it says <b>#include "SDL.h"</b>.<br>
<br>
Also if you're using Visual Studio and you get the error <b>"The application failed to start because the
application configuration is incorrect. Reinstalling the application may fix this problem."</b>, it's because you
don't have the service pack update installed. <a class="tutLink" href="../lesson01/windows/vcsetup/index.php">Do
not forget to have the latest version of your compiler/IDE with the service pack update for your compiler/IDE or
SDL will not work with Visual Studio</a>.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson02.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson01/index2.php">Previous Tutorial</a><a class="rightNav" href="../lesson03/index.php">Next Tutorial</a>
<br>
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