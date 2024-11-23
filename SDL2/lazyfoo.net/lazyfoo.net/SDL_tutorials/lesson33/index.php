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
<div class="tutPreface"><h1 class="tutHead">Multithreading</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 11/22/12</h6>
Up until now you've been making programs that only do one process at a time. With multithreading, you can make
programs that can do multiple processes at once. This tutorial will introduce you to SDL's cross platform
multithreading capabilities.<br/>
<br/>
<a class="tutLink" href="../../tutorials/SDL/46_multithreading/index.php">Multithreading tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">#include "SDL/SDL.h"
#include "SDL/SDL_image.h"
#include "SDL/SDL_thread.h"
#include &#060string&#062
</div>

<div class="tutText">
First off we have to remember to include the header for SDL threads.<br>
<br>
*nix user may have to include X11:
<h6>#include "X11/Xlib.h"</h6>
You'll also have to call XInitThreads() in your initialization function and link with <b>-lX11</b>
</div>

<div class="tutCode">//The thread that will be used
SDL_Thread *thread = NULL;

//Quit flag
bool quit = false;
</div>

<div class="tutText">
Here are two important global variables.<br>
<br>
First we have the SDL_Thread which is going to be the thread we are going to run.
Then we have our "quit" variable, which we usually have as a local variable in main() but this time we need it to be global.
</div>

<div class="tutCode">int my_thread( void *data )
{
    //While the program is not over
    while( quit == false )
    {
        //Do the caption animation
        SDL_WM_SetCaption( "Thread is running", NULL );
        SDL_Delay( 250 );
        
        SDL_WM_SetCaption( "Thread is running.", NULL );
        SDL_Delay( 250 );
        
        SDL_WM_SetCaption( "Thread is running..", NULL );
        SDL_Delay( 250 );
        
        SDL_WM_SetCaption( "Thread is running...", NULL );
        SDL_Delay( 250 );
    }
    
    return 0;    
}
</div>

<div class="tutText">
Here's the function that's going to be our thread.
All it does is put a different caption every quarter of a second while the user has not quit.
Now you see why the "quit" variable needed to be global.<br>
<br>
In order for a function to be used as a thread in SDL it has to meet 2 requirements.
First off it must return an int.
Secondly it must have the argument that is a pointer to a data type of void.
If the function does not meet both of these requirements it cannot be used as a thread.
</div>

<div class="tutCode">    //Create and run the thread
    thread = SDL_CreateThread( my_thread, NULL );
</div>

<div class="tutText">
In the main function after everything is initialized and loaded, we call SDL_CreateThread().<br>
<br>
SDL_CreateThread() takes in the function in the first argument, turns it into a thread and then runs the newly made thread.
It returns a pointer to the thread so we can keep track of it.
</div>

<div class="tutCode">    //Apply the image to the screen
    apply_surface( 0, 0, image, screen );
    
    //Update the screen
    if( SDL_Flip( screen ) == -1 )
    {
        return 1;    
    }
    
    //While the user hasn't quit
    while( quit == false )
    {
        //While there's events to handle
        while( SDL_PollEvent( &event ) )
        {
            //If the user has Xed out the window
            if( event.type == SDL_QUIT )
            {
                //Quit the program
                quit = true;
            }    
        }
    }
</div>

<div class="tutText">
Then we show the image on the screen, then wait for the user to quit.<br>
<br>
While this is going on, the caption is changing in our thread that is currently running parallel to what we're doing.
Thanks to SDL's multithreading capabilities, you're able to do these two things simultaneously.
</div>

<div class="tutCode">void clean_up()
{
    //Stop the thread
    SDL_KillThread( thread );
    
    //Free the surface
    SDL_FreeSurface( image );
    
    //Quit SDL
    SDL_Quit();    
}
</div>

<div class="tutText">
Here's our clean up function.<br>
<br>
First we call SDL_KillThread() which instantly stops the thread. Typically you should wait for the thread to
finish, but in this case it won't do any harm to just stop it. Then we free the surface, and quit SDL.</div>

<div class="tutText">
When it comes to using multithreading in games, the general rule is "Don't".
There's so much more you have to deal with than in single threaded programs.
With the rise of multicore CPUs, it's tempting to jump right in.<br>
<br>
However there are cases where multithreading can be useful in game.
If you're new to game programming, don't use it until you're more experienced.
Multithreading can be more of a headache than it's worth.
You have to know thread synchronization (which the next two tutorials teach), and how to deal with concurrency.
Only when you have a good handle on software architecture should you use this powerful tool.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson33.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson32/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson34/index.php">Next Tutorial</a><br>
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