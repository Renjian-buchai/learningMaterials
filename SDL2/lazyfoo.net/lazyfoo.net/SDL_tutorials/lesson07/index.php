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
<div class="tutPreface"><h1 class="tutHead">True Type Fonts</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 2/16/14</h6>
Now it's time to render text. SDL does not support *.ttf files natively so the SDL_ttf extension library is
needed. SDL_ttf is an extension library that allows you to generate surfaces from true type fonts.<br>
<br>
You can get SDL_ttf from <a class="tutLink" href="http://www.libsdl.org/projects/SDL_ttf/release-1.2.html">here</a>. <br>
<br>
To install SDL_ttf just follow the <a class="tutLink" href="../lesson03/index.php">extension library tutorial</a>.
Installing SDL_ttf is done pretty much the way SDL_image is, so just replace where you see SDL_image with SDL_ttf.<br>
<br>
*nix users may also have to link against freetype.<br>
<br>
This tutorial covers the basics of using SDL_ttf.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/16_true_type_fonts/index.php">True Type Fonts tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The surfaces
SDL_Surface *background = NULL;
SDL_Surface *message = NULL;
SDL_Surface *screen = NULL;

//The event structure
SDL_Event event;

//The font that's going to be used
TTF_Font *font = NULL;

//The color of the font
SDL_Color textColor = { 255, 255, 255 };
</div>

<div class="tutText">Here we have our variables. There's the background and screen surface and the event structure from before.
We also have the "message" surface which will hold the surface with the text.<br>
<br>
There's also the new data type "TTF_Font" which is the font we're going to use, and there's also the SDL_Color
which is the color we are going to render the text. In this case it is set to white.<br>
<br>
If you want to know more about the SDL_Color data type, you can look it up in the SDL documentation.
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
    
    //Initialize SDL_ttf
    if( TTF_Init() == -1 )
    {
        return false;    
    }
    
    //Set the window caption
    SDL_WM_SetCaption( "TTF Test", NULL );
    
    //If everything initialized fine
    return true;
}
</div>

<div class="tutText">Here's our initialization function.
It's pretty much the same as before but this time we have to initialize SDL_ttf.<br>
<br>
SDL_ttf is initialized by calling TTF_Init(). TTF_Init() returns -1 when there is an error.<br>
<br>
TTF_Init() has to be called before using any SDL_ttf functions.
</div>

<div class="tutCode">bool load_files()
{
    //Load the background image
    background = load_image( "background.png" );
    
    //Open the font
    font = TTF_OpenFont( "lazy.ttf", 28 );
    
    //If there was a problem in loading the background
    if( background == NULL )
    {
        return false;    
    }
    
    //If there was an error in loading the font
    if( font == NULL )
    {
        return false;
    }
    
    //If everything loaded fine
    return true;    
}
</div>

<div class="tutText">Here's the file loading function. To load the *.ttf font, TTF_OpenFont() must be called.<br>
<br>
The first argument of TTF_OpenFont() is the filename of the *.ttf font you want to open, the second argument is the size you want to set the font to when you open it.<br>
<br>
When there's an error loading the font, TTF_OpenFont() will return NULL.
</div>

<div class="tutCode">    //Render the text
    message = TTF_RenderText_Solid( font, "The quick brown fox jumps over the lazy dog", textColor );
    
    //If there was an error in rendering the text
    if( message == NULL )
    {
        return 1;    
    }
    
    //Apply the images to the screen
    apply_surface( 0, 0, background, screen );
    apply_surface( 0, 150, message, screen );
    
    //Update the screen
    if( SDL_Flip( screen ) == -1 )
    {
        return 1;    
    }
</div>

<div class="tutText">Here's the rendering code inside the main() function.<br>
<br>
The fastest way to render text is to use TTF_RenderText_Solid().<br>
<br>
TTF_RenderText_Solid() takes the font in the first argument, and creates a surface with the text in the second argument with the color in the third argument.
TTF_RenderText_Solid() returns NULL when there's an error.<br>
<br>
There are other ways to render text, check them out in the <a class="tutLink" href="http://jcatki.no-ip.org/SDL_ttf/SDL_ttf_html.tar.gz">SDL_ttf documentation</a>.
For some Linux users TTF_RenderText_Solid() won't work, so make sure to upgrade freetype (the library SDL_ttf is
based on) and SDL_ttf. If that doesn't work, try using TTF_RenderText_Shaded() instead.
</div>

<div class="tutCode">void clean_up()
{
    //Free the surfaces
    SDL_FreeSurface( background );
    SDL_FreeSurface( message );
    
    //Close the font that was used
    TTF_CloseFont( font );
    
    //Quit SDL_ttf
    TTF_Quit();
    
    //Quit SDL
    SDL_Quit();
}
</div>

<div class="tutText">
Here we have the clean up function. First we free the background surface, then get rid of the text surface we generated.<br>
<br>
We also close the font we opened using TTF_CloseFont(), and then quit SDL_ttf using TTF_Quit().<br>
<br>
After that we quit SDL as usual.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson07.zip">here</a>.<br>
<br>
I highly recommend that you download the <a class="tutLink" href="http://jcatki.no-ip.org:8080/SDL_ttf/SDL_ttf_html.tar.gz">SDL_ttf documentation</a>, and keep it around for reference.<br>
<br>
<a class="leftNav" href="../lesson06/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson08/index.php">Next Tutorial</a><br>
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