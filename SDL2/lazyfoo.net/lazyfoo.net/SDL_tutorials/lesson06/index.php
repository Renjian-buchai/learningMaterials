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
<div class="tutPreface"><h1 class="tutHead">Clip Blitting and Sprite Sheets</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 1/04/2014</h6>
Sprite sheets are collections of images held in a single image file. They're useful for when you have large
amounts of images but don't want to have to deal with many image files.<br>
<br>
In order to get the individual images you have to be able to clip the part you want when blitting. Now in this
lesson we have a sprite sheet with 4 different dot sprites on it. This tutorial covers how to clip a sprite from a
sprite sheet.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/11_clip_rendering_and_sprite_sheets/index.php">Clip Rendering and Sprite Sheets tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The surfaces
SDL_Surface *dots = NULL;
SDL_Surface *screen = NULL;

//The event structure
SDL_Event event;

//The portions of the sprite map to be blitted
SDL_Rect clip[ 4 ];
</div>

<div class="tutText">
Here we have some global variables.
There's the screen surface, and the event structure from before.
We also have the "dots" surface which is the sprite sheet that contains all the dot sprites.<br>
<br>
There's also an array of four SDL_Rects. These hold the offsets and dimensions of the 4 dot sprites.
</div>

<div class="tutCode">void apply_surface( int x, int y, SDL_Surface* source, SDL_Surface* destination, SDL_Rect* clip = NULL )
{
    //Holds offsets
    SDL_Rect offset;
    
    //Get offsets
    offset.x = x;
    offset.y = y;
    
    //Blit
    SDL_BlitSurface( source, clip, destination, &offset );
}
</div>

<div class="tutText">
Here's the surface blitting function from before but with some adjustments.<br>
<br>
The new argument is the SDL_Rect called "clip" that defines the rectangular piece of the surface we want to blit.<br>
<br>
We set NULL to be the default argument, which means<br>
apply_surface( 0, 0, image, screen, NULL );<br>
<br>
and<br>
<br>
apply_surface( 0, 0, image, screen );<br>
do the exact same thing.<br>
<br>
We also changed the way we call SDL_BlitSurface().
We no longer just set the second argument to NULL, we now put the "clip" argument in it.<br>
<br>
Now SDL_BlitSurface() will blit the region of the source surface defined by "clip". If "clip" is NULL, then it
will blit the entire source surface.
</div>

<div class="tutCode">    //Clip range for the top left
    clip[ 0 ].x = 0;
    clip[ 0 ].y = 0;
    clip[ 0 ].w = 100;
    clip[ 0 ].h = 100;
    
    //Clip range for the top right
    clip[ 1 ].x = 100;
    clip[ 1 ].y = 0;
    clip[ 1 ].w = 100;
    clip[ 1 ].h = 100;
    
    //Clip range for the bottom left
    clip[ 2 ].x = 0;
    clip[ 2 ].y = 100;
    clip[ 2 ].w = 100;
    clip[ 2 ].h = 100;
    
    //Clip range for the bottom right
    clip[ 3 ].x = 100;
    clip[ 3 ].y = 100;
    clip[ 3 ].w = 100;
    clip[ 3 ].h = 100;
</div>

<div class="tutText">
In the main function after everything is initialized and the files are loaded, we set the clip rectangles.<br>
<br>
We're going to take this sprite sheet:<br>
<div class="tutImg"><img src="sheet.jpg"></div>
<br>
and set the clip rectangles to their designated regions:<br>
<div class="tutImg"><img src="sprites.jpg"></div>
like so.<br>
<br>
Now we're ready to blit the individual sprites from the sprite sheet.
</div>

<div class="tutCode">    //Fill the screen white
    SDL_FillRect( screen, &screen->clip_rect, SDL_MapRGB( screen->format, 0xFF, 0xFF, 0xFF ) );
</div>

<div class="tutText">
Now we fill the screen white using SDL_FillRect().
What SDL_FillRect() does is take the surface in the first argument, and fill the region in the second argument with color in the third argument.<br>
<br>
The region in the second argument is the surface's clip_rect or the entire region of the surface.
</div>

<div class="tutCode">    //Apply the images to the screen
    apply_surface( 0, 0, dots, screen, &clip[ 0 ] );
    apply_surface( 540, 0, dots, screen, &clip[ 1 ] );
    apply_surface( 0, 380, dots, screen, &clip[ 2 ] );
    apply_surface( 540, 380, dots, screen, &clip[ 3 ] );
    
    //Update the screen
    if( SDL_Flip( screen ) == -1 )
    {
        return 1;    
    }
</div>

<div class="tutText">
Now we actually blit the sprites.
Notice that every time we're blitting the same surface.
The only difference is that we're blitting a different piece of the surface.<br>
<br>
The final result should look like this:<br>
<div class="tutImg"><img src="result.jpg"></div>
<br>
Now when you have many images you want to use, you don't have to keep thousands of image files.
You can put collections of sprites in a single image and just blit the portion you want to use.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson06.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson05/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson07/index.php">Next Tutorial</a><br>
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