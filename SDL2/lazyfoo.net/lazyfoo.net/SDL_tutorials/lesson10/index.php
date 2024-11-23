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
<div class="tutPreface"><h1 class="tutHead">Key States</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 2/23/14</h6>
Here you're going to check if a key is pressed without even using events. This is possible due to keystates.
Sometimes just checking if a key is up or down is easier than monitoring events.<br>
<br>
This tutorial will teach you to check if the key is pressed, rather than monitoring key events.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/18_key_states/index.php">Key states tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">    //While the user hasn't quit
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
</div>

<div class="tutText">
As you can see, despite the fact that we're showing the messages based on key presses we don't check for any key events.
</div>

<div class="tutCode">        //Get the keystates
        Uint8 *keystates = SDL_GetKeyState( NULL );
</div>

<div class="tutText">
Instead what we do is use SDL_GetKeyState().<br>
<br>
What SDL_GetKeyState() does is give us the key state array.
The key state array is a list of every key and whether the key is pressed or not, kind of like this:<br>
<div class="tutImg"><img src="keystate.jpg"></div>
<br>
Now we can tell which key is down.<br>
<br>
Just for information's sake, the argument we give SDL_GetKeyState() gets the number of keys available.
Since we don't care about how many keys there are, we just set it to NULL.
</div>

<div class="tutCode">        //If up is pressed
        if( keystates[ SDLK_UP ] )
        {
            apply_surface( ( SCREEN_WIDTH - up->w ) / 2, ( SCREEN_HEIGHT / 2 - up->h ) / 2, up, screen );
        }
    
        //If down is pressed
        if( keystates[ SDLK_DOWN ] )
        {
            apply_surface( ( SCREEN_WIDTH - down->w ) / 2, ( SCREEN_HEIGHT / 2 - down->h ) / 2 + ( SCREEN_HEIGHT / 2 ), down, screen );
        }
    
        //If left is pressed
        if( keystates[ SDLK_LEFT ] )
        {
            apply_surface( ( SCREEN_WIDTH / 2 - left->w ) / 2, ( SCREEN_HEIGHT - left->h ) / 2, left, screen );
        }
    
        //If right is pressed
        if( keystates[ SDLK_RIGHT ] )
        {
            apply_surface( ( SCREEN_WIDTH / 2 - right->w ) / 2 + ( SCREEN_WIDTH / 2 ), ( SCREEN_HEIGHT - right->h ) / 2, right, screen );
        }
		
        //Update the screen
        if( SDL_Flip( screen ) == -1 )
        {
            return 1;    
        }
</div>

<div class="tutText">
Here's a basic if up is pressed show the up message, if down is pressed show the down message, etc.<br>
<br>
Had this program been done with events, the code would be a good size longer.<br>
<br>
SDL_GetKeyState() and other state functions like SDL_GetModState(), SDL_GetMouseState(), SDL_JoystickGetAxis() and others can be incredibly useful.
Learn more about them in the SDL API reference, which you should have handy on your computer.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson10.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson09/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson11/index.php">Next Tutorial</a><br>
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