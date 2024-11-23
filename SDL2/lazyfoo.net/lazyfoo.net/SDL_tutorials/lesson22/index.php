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
<div class="tutPreface"><h1 class="tutHead">Scrolling Backgrounds</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/28/10</h6>
In some cases making a one large background is either wasteful or impractical. This is where smooth scrolling
backgrounds come in handy.<br>
<br>
Whether you have a level that will run for an indefinite length or you're just too lazy to make a background for
an entire level, scrolling backgrounds can be quite useful. This tutorial will teach you to make an endless smooth
scrolling background.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/31_scrolling_backgrounds/index.php">Scrolling Backgrounds tutorial with SDL 2</a> is now available.
</div>

<div class="tutText">
With a scrolling background, you see something like this:
<div class="tutImg"><img src="scrolling.gif"></div>
While what you want will probably be a bit smoother, it's a seemingly endless background.<br>
<br>
What is actually happening is this:<br>
<div class="tutImg"><img src="looping.gif"></div>
The background is blitted multiple times, and with every frame it moves over slightly.
When the background goes too far, its offset is reset.<br>
<br>
The program loops through this process to give the illusion of an endless background.
This is the basic premise of a scrolling background.
</div>

<div class="tutCode">    //The offsets of the background
    int bgX = 0, bgY = 0;
</div>

<div class="tutText">
Since the background is moving, we have to have variables to store its offset.<br>
<br>
It's typically better to have all scrolling done in a separate class but eh,
doing it locally in main function is less typing for me.
</div>

<div class="tutCode">    //While the user hasn't quit
    while( quit == false )
    {
        //Start the frame timer
        fps.start();
        
        //While there's an event to handle
        while( SDL_PollEvent( &event ) )
        {   
            //If the user has Xed out the window
            if( event.type == SDL_QUIT )
            {
                //Quit the program
                quit = true;
            }
        }
        
        //Scroll background
        bgX -= 2;
        
        //If the background has gone too far
        if( bgX <= -background->w )
        {
            //Reset the offset
            bgX = 0;
        }
</div>

<div class="tutText">
After we do our event handling in the main loop, we scroll the background over to the left.
Then we check if the background went too far to the left.
If it did we restart our scrolling animation by moving the background back.
</div>

<div class="tutCode">        //Show the background
        apply_surface( bgX, bgY, background, screen );
        apply_surface( bgX + background->w, bgY, background, screen );
        
        //Show the dot
        apply_surface( 310, 230, dot, screen );
        
        //Update the screen
        if( SDL_Flip( screen ) == -1 )
        {
            return 1;    
        }
        
        //Cap the frame rate
        if( fps.get_ticks() < 1000 / FRAMES_PER_SECOND )
        {
            SDL_Delay( ( 1000 / FRAMES_PER_SECOND ) - fps.get_ticks() );
        }
    }
</div>

<div class="tutText">
Then we show our background once at its offset,
then once again right next to it and that should give us the illusion of an endless background.<br>
<br>
Then we show the dot, update the screen, cap the frame rate and all that good stuff.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson22.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson21/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson23/index.php">Next Tutorial</a><br>
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