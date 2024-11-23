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
<div class="tutPreface"><h1 class="tutHead">Calculating Frame Rate</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/24/14</h6>
Performance is always a concern when dealing with games. Whether you need to know what frame rate your game can
run at, or you're just wondering how much juice you can get out of SDL's rendering, knowing how to calculate frame
rate is a useful skill. This tutorial will teach you to make a simple frames per second test.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/24_calculating_frame_rate/index.php">Calculating Frame Rate tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">    //Keep track of the frame count
    int frame = 0;
    
    //Timer used to calculate the frames per second
    Timer fps;
    
    //Timer used to update the caption
    Timer update;
</div>

<div class="tutText">
Here are the 3 key variables in our frames per second test.
"frame" keeps track of how many frames have been rendered.
"fps" is the timer that keeps track of how much time that has been spent rendering.
"update" is the timer that we use to update the caption, which is where we show the frames per second.
</div>

<div class="tutCode">    //Start the update timer
    update.start();
    
    //Start the frame timer
    fps.start();
    
    //While the user hasn't quit
    while( quit == false )
    {
</div>

<div class="tutText">
After everything has been initialized and loaded, we start the timers then enter the main loop.
</div>

<div class="tutCode">        //While there's events to handle
        while( SDL_PollEvent( &event ) )
        {
            //If the user has Xed out the window
            if( event.type == SDL_QUIT )
            {
                //Quit the program
                quit = true;
            }
        }
</div>

<div class="tutText">
There's no advanced event handling here, we just deal with the user wanting to X out.
</div>

<div class="tutCode">        //Apply the surface
        apply_surface( 0, 0, image, screen );
        
        //Update the screen
        if( SDL_Flip( screen ) == -1 )
        {
            return 1;    
        }
        
        //Increment the frame counter
        frame++;
</div>

<div class="tutText">
After we handle events, we apply the surface, update the screen, then increment the frame counter.
</div>

<div class="tutCode">        //If a second has passed since the caption was last updated
        if( update.get_ticks() > 1000 )
        {
            //The frame rate as a string
            std::stringstream caption;
            
            //Calculate the frames per second and create the string
            caption << "Average Frames Per Second: " << frame / ( fps.get_ticks() / 1000.f );
            
            //Reset the caption
            SDL_WM_SetCaption( caption.str().c_str(), NULL );
            
            //Restart the update timer
            update.start();    
        }
    }
</div>

<div class="tutText">
Here is where we show the frames per second.<br>
<br>
First we check if it has been at least one second since the caption has last been updated.<br>
<br>
If it is time to update the caption, we create a string stream object, and put the FPS in the string stream.<br>
<br>
Frames per second is calculated by taking the amount of frames rendered divided by the time it took to render them (in seconds).<br>
<br>
After that we update the caption, and restart the update timer.
The we continue our FPS test program.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson15.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson14/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson16/index.php">Next Tutorial</a><br>
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