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
<div class="tutPreface"><h1 class="tutHead">Alpha Blending</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 2/1/14</h6>
Alpha blending allows you to have have surfaces with different levels of transparency. In this tutorial we blit
two surfaces with the front one being able to fade in/out by changing its alpha value.<br/>
<br/>
An <a class="tutLink" href="../../tutorials/SDL/13_alpha_blending/index.php">Alpha Blending tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The frame rate
const int FRAMES_PER_SECOND = 20;
</div>

<div class="tutText">
SDL's alpha transparency is notoriously slow.
That's because it's not hardware accelerated.
Stick whatever graphics card in your system it won't make much of a difference.<br>
<br>
I just wanted to point out that if you notice SDL being really slow in this demo,
it may be because the frame rate is capped at 20 fps.<br>
<br>
If you want hardware accelerated graphics, consider moving on to OpenGL.
It works very well with SDL.
</div>

<div class="tutCode">    //Quit flag
    bool quit = false;
    
    //The front surface alpha value
    int alpha = SDL_ALPHA_OPAQUE;
    
    //The frame rate regulator
    Timer fps;
    
    //Initialize
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
Near the top of our main function we declare "alpha" to hold the alpha value of our front surface.
</div>

<div class="tutCode">        //Get the keystates
        Uint8 *keystates = SDL_GetKeyState( NULL );
    
        //If up is pressed
        if( keystates[ SDLK_UP ] )
        {
            //If alpha is not at maximum
            if( alpha < SDL_ALPHA_OPAQUE )
            {
                //Increase alpha
                alpha += 5;
            }
        }
    
        //If down is pressed
        if( keystates[ SDLK_DOWN ] )
        {
            //If alpha is not at minimum
            if( alpha > SDL_ALPHA_TRANSPARENT )
            {
                //Decrease alpha
                alpha -= 5;
            }
        }
</div>

<div class="tutText">
Here's where we play with our alpha value.<br>
<br>
Alpha goes from 0 to 255 like Red, Green, or Blue.
Alpha at 0 is completely transparent and equal to SDL_ALPHA_TRANSPARENT.
Alpha at 255 is completely opaque and equal to SDL_ALPHA_OPAQUE.<br>
<br>
In this piece of code we get the key states, then increase alpha when up is pressed
and decrease alpha when down is pressed.
</div>

<div class="tutCode">        //Set surface alpha
        SDL_SetAlpha( front, SDL_SRCALPHA, alpha );
        
        //Apply the back
        apply_surface( 0, 0, back, screen );
        
        //Apply the front
        apply_surface( 0, 0, front, screen );
        
        //Update the screen
        if( SDL_Flip( screen ) == -1 )
        {
            return 1;    
        }
</div>

<div class="tutText">
Here we apply the alpha value to the front surface using SDL_SetAlpha().
Now when the front surface us blitted, it will have the transparency we set.<br>
<br>
Then we blit back surface, then the front surface with the alpha value we gave it and finally we update the screen.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson27.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson26/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson28/index.php">Next Tutorial</a><br>
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