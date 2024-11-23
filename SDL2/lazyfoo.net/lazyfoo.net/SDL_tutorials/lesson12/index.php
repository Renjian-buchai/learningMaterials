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
<div class="tutPreface"><h1 class="tutHead">Timing</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/24/14</h6>
You've already learned about stuff that's event driven, now it's time to do things that are time driven. Knowing
how to deal with time is key in making games. In this lesson we'll make a simple timer that can start and stop.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/22_timing/index.php">Timing tutorial with SDL 2</a> is now available.
</div>

<div class="tutText">
Now say if you needed to time 30 seconds of something but you didn't have a stop watch.
If there was a clock on the wall with a second hand, you'd wait until it reached a multiple of 15:<br>
<div class="tutImg"><img src="start.jpg"></div>
<br>
and then you'd wait until it was 30 seconds away from the starting point.<br>
<div class="tutImg"><img src="stop.jpg"></div>
<br>
This timer functions on the same principle.
SDL has a timer running in your program and you can get its time in milliseconds using SDL_GetTicks().
If you need to time something for 1000 milliseconds, you'd store the time you started waiting and wait until the difference between the time you started and the current time to be 1000.
</div>

<div class="tutCode">//The headers
#include "SDL/SDL.h"
#include "SDL/SDL_image.h"
#include "SDL/SDL_ttf.h"
#include &#060string&#062
#include &#060sstream&#062
</div>

<div class="tutText">
Along with the usual headers we include the string stream header.
I'll explain what a string stream does later.
</div>

<div class="tutCode">int main( int argc, char* args[] )
{
    //Quit flag
    bool quit = false;
    
    //The timer starting time
    Uint32 start = 0;
    
    //The timer start/stop flag
    bool running = true;
</div>

<div class="tutText">
At the top of our main function we have the two variables we're going to use to make our timer.
There's "start" which holds the time our timer started and "running" flag which keeps track of whether our timer is running.
</div>

<div class="tutCode">    //Start the timer
    start = SDL_GetTicks();
    
    //While the user hasn't quit
    while( quit == false )
    {
</div>

<div class="tutText">
After we initialized and loaded the surfaces it's time to start the timer.<br>
<br>
We start our timer by getting the current time by using SDL_GetTicks().
Then we enter our main loop.
</div>

<div class="tutCode">        //While there's an event to handle
        while( SDL_PollEvent( &event ) )
        {
            //If a key was pressed
            if( event.type == SDL_KEYDOWN )
            {
                //If s was pressed
                if( event.key.keysym.sym == SDLK_s )
                {
                    //If the timer is running
                    if( running == true )
                    {
                        //Stop the timer
                        running = false;
                        start = 0;  
                    }
                    else
                    {
                        //Start the timer
                        running = true;
                        start = SDL_GetTicks();  
                    }
                }
            }
</div>

<div class="tutText">
Here we handle when the 's' key is pressed which starts and stops the timer.<br>
<br>
If the timer is running, we set the "running" flag to false, and set start to 0 just because I don't like stray values.
If the timer is stopped, we set the flag to true and start the timer just like we did when we entered the main loop.
</div>

<div class="tutCode">        //If the timer is running
        if( running == true )
        {
            //The timer's time as a string
            std::stringstream time;
        
            //Convert the timer's time to a string
            time << "Timer: " << SDL_GetTicks() - start;
</div>

<div class="tutText">
After we apply the background and the message surface we check if the timer is running.
If it is, we show the timer's time.<br>
<br>
The formula to calculate the timer's time is:
<h5>time = current time - start time.</h5>
So if you started the timer when SDL_GetTicks() was 10,000 and now SDL_GetTicks() is 20,000, it will return 10,000 meaning 10 seconds have passed since the timer started.<br>
<br>
So here we put "Timer: " + the timer's time in the string stream.<br>
<br>
We make a string stream object named "time" which will hold the message containing the timer's time.
String stream objects allow you make strings out of multiple variables.
As you can see it functions a lot like cout, but instead of taking everything and dumping the text to the console it just stores
the text in the string stream so we can use it.<br>
<br>
For those of you who are still using VC++ 6.0 you'll need to cast (SDL_GetTicks() - start) to an integer.
</div>

<div class="tutCode">            //Render the time surface
            seconds = TTF_RenderText_Solid( font, time.str().c_str(), textColor );
            
            //Apply the time surface
            apply_surface( ( SCREEN_WIDTH - seconds->w ) / 2, 50, seconds, screen );
        
            //Free the time surface
            SDL_FreeSurface( seconds );
        }
        
        //Update the screen
        if( SDL_Flip( screen ) == -1 )
        {
            return 1;    
        }
    }
</div>

<div class="tutText">
Then we render the text surface that shows the timer's time using the text inside the string stream.
Then we apply the timer's time on the screen and free the surface.<br>
<br>
After that the screen is updated and we continue the main loop.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson12.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson11/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson13/index.php">Next Tutorial</a><br>
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