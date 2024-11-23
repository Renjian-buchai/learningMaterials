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
<div class="tutPreface"><h1 class="tutHead">Regulating Frame Rate</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 2/24/14</h6>
What may run on your computer at 60 FPS, may run on someone else's at 200 FPS. Since speed varies from computer to
computer, you're going to have to regulate frame rate to keep the game from running too fast. If a game runs too
fast it becomes unplayable. To prevent that you must cap the frame rate.<br>
<br>
This tutorial teaches you just that.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/25_capping_frame_rate/index.php">Capping Frame Rate tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The frames per second
const int FRAMES_PER_SECOND = 20;
</div>

<div class="tutText">
We define our frames per second as a global constant.
</div>

<div class="tutCode">    //Keep track of the current frame
    int frame = 0;
    
    //Whether or not to cap the frame rate
    bool cap = true;

    //The frame rate regulator
    Timer fps;
</div>

<div class="tutText">
Here are some variables declared in the main() function.
The "frame" variable keeps track of how many frames have been animated, which is important for knowing where to blit the message surface in this demo program.
There's also the "cap" variable which keeps track of whether the user wants to cap the frame rate.<br>
<br>
Then we declare a timer object which we use to cap the frame rate.
</div>
	
<div class="tutCode">    //Generate the message surfaces
    message = TTF_RenderText_Solid( font, "Testing Frame Rate", textColor );
</div>

<div class="tutText">
Now we render the message surface that will move across the screen.
</div>

<div class="tutCode">    //While the user hasn't quit
    while( quit == false )
    {
        //Start the frame timer
        fps.start();
</div>

<div class="tutText">
Now we enter our main loop. At the beginning of every frame, we have to start our frame timer.
</div>

<div class="tutCode">        //While there's events to handle
        while( SDL_PollEvent( &event ) )
        {
            //If a key was pressed
            if( event.type == SDL_KEYDOWN )
            {
                //If enter was pressed
                if( event.key.keysym.sym == SDLK_RETURN )
                {
                    //Switch cap
                    cap = ( !cap );
                }
            }
            
            //If the user has Xed out the window
            else if( event.type == SDL_QUIT )
            {
                //Quit the program
                quit = true;
            }
        }
</div>

<div class="tutText">
Here we do our event handling.
Basically this turns the FPS cap on/off when the user presses enter, and quits the program when the user wants to X out.<br>
<br>
You typically don't need a variable to turn the frame regulation on/off when you're capping the frame rate in an actual game,
but it's here in this program so you can see the difference between regulated and unregulated frame rate.
</div>

<div class="tutCode">        //Apply the background
        apply_surface( 0, 0, background, screen );
        
        //Apply the message
        apply_surface( ( SCREEN_WIDTH - message->w ) / 2, ( ( SCREEN_HEIGHT + message->h * 2 ) / FRAMES_PER_SECOND ) * ( frame % FRAMES_PER_SECOND ) - message->h, message, screen );
</div>

<div class="tutText">
Then we apply the background and message surface.<br>
<br>
Don't worry about all that coding that went into blitting the message surface.
It was basically a shorter way of doing:<br>
<br>
if( frame % FRAMES_PER_SECOND == 0 )<br>
{<br>
//blit here<br>
}<br>
if( frame % FRAMES_PER_SECOND == 1 )<br>
{<br>
//blit there<br>
}<br>
<br>
etc, etc.
</div>

<div class="tutCode">        //Update the screen
        if( SDL_Flip( screen ) == -1 )
        {
            return 1;    
        }
        
        //Increment the frame counter
        frame++;
</div>

<div class="tutText">
Then we update the screen and increment the frame counter.<br>
Now we've finished everything we needed to do for this frame.
</div>

<div class="tutCode">        //If we want to cap the frame rate
        if( ( cap == true ) && ( fps.get_ticks() < 1000 / FRAMES_PER_SECOND ) )
        {
            //Sleep the remaining frame time
            SDL_Delay( ( 1000 / FRAMES_PER_SECOND ) - fps.get_ticks() );
        }
</div>

<div class="tutText">
This is where we do the actual frame rate capping.<br>
<br>
When we started the frame, we started a timer to keep track of how much time it took to output this frame.
In order for this program not to run too fast, each frame must take a certain amount of time.
Since 20 frames are being shown per second, each frame must take no less than 1/20th of a second.
If the frame rate is at 60 FPS, each frame must take no less than 1/60th of a second.
Since this demo is running at 20 FPS, that means we should spend 50 milliseconds (1000 milliseconds / 20 frames)
per frame.<br>
<br>
To regulate the frame rate, first we check if the frame timer is less than the time allowed per frame. If it's
more, it means we're either on time or behind schedule so we don't have time to wait. If it is less, then we use
SDL_Delay() to sleep the rest of the frame time.<br>
<br>
So if the frame timer in this program is at 20 milliseconds we sleep for 30 milliseconds. If the frame timer
is at 40 milliseconds, we sleep for 10 milliseconds, etc, etc.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson14.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson13/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson15/index.php">Next Tutorial</a><br>
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