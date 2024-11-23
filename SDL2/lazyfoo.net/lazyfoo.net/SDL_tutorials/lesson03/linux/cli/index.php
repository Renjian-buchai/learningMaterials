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

<link REL="stylesheet" TYPE="text/css" href="../../../lazy.css">
</head>

<body>

<div class="header">
<h1 style="margin-bottom:0px;padding-bottom:0px;border-bottom:0px;">Lazy Foo' Productions</h1>

<div class="nav">
Yes, I am keeping the old tutorial set in the old layout for the sake of having a nostalgic eater egg. It's not because I am too lazy to port this over to the data driven static site generator.<br/>
<br/>
<a class="nav" href="https://discourse.libsdl.org/">SDL Forums</a>
<a class="nav" href="../../../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../../../articles/index.php">Articles</a>
<a class="nav" href="../../../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../../../index.php">News</a>
<a class="nav" href="../../../../faq.php">FAQs</a>
<a class="nav" href="../../../../contact.php">Contact</a>
<a class="nav" href="../../../../donate.php">Donations</a><br/>
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
<div class="tutPreface"><h1 class="tutHead">Setting up SDL Extensions for g++</h1>
<h6>Last Updated 12/09/07</h6>
</div>

<div class="tutText">
When you compile your program simply add
<h6>-lSDL_image</h6>
after
<h6>g++ -o myprogram mysource.cpp -lSDL</h6>
</p>
<p>
If you were linking SDL_ttf you'd add <h6>-lSDL_ttf</h6>
If you were linking SDL_mixer you'd add <h6>-lSDL_mixer</h6>
etc, etc.<br>
<br>
To use SDL_image make sure to include the header file.
</div>

<div class="tutCode">#include "SDL/SDL_image.h"
</div>

<div class="tutText">If you were setting up SDL_ttf you'd put <h6>#include "SDL/SDL_ttf.h"</h6>
If you were setting up SDL_mixer you'd put <h6>#include "SDL/SDL_mixer.h"</h6>
etc, etc.<br>
<br>
Now the extension library is all set up.
</div>

<div class="tutText">
Now you can use SDL_image functions.<br>
<br>
The main one you want to know about is IMG_Load().<br>
</div>

<div class="tutCode">SDL_Surface *load_image( std::string filename ) 
{
    //The image that's loaded
    SDL_Surface* loadedImage = NULL;
    
    //The optimized image that will be used
    SDL_Surface* optimizedImage = NULL;
    
    //Load the image using SDL_image
    loadedImage = IMG_Load( filename.c_str() );
    
    //If the image loaded
    if( loadedImage != NULL )
    {
        //Create an optimized image
        optimizedImage = SDL_DisplayFormat( loadedImage );
        
        //Free the old image
        SDL_FreeSurface( loadedImage );
    }
    
    //Return the optimized image
    return optimizedImage;
}
</div>

<div class="tutText">
Here is a revised version of the image loading function from the previous tutorial.<br>
<br>
As you can see IMG_Load() functions exactly the same as SDL_LoadBMP(), but there's one big exception:
IMG_Load() can load BMP, PNM, XPM, LBM, PCX, GIF, JPEG, TGA and PNG files.<br>
<br>
From this tutorial on, PNG image files will be the primary image format used. PNGs have excellent lossless compression.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial
<a href="https://lazyfoo.net/SDL_tutorials/lesson03/lesson03.zip" class="tutLink">here</a>. <br>
<br>
I highly recommend that you download the documentation for SDL_image and keep it handy.<br>
<br>
It can be found <a class="tutLink" href="http://jcatki.no-ip.org:8080/SDL_image/SDL_image_html.tar.gz">here</a>. <br>
<br>
<a class="leftNav" href="../../../lesson02/index.php">Previous Tutorial</a><a class="rightNav" href="../../../lesson04/index.php">Next Tutorial</a><br>
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
<a class="nav" href="../../../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../../../articles/index.php">Articles</a>
<a class="nav" href="../../../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../../../index.php">News</a>
<a class="nav" href="../../../../faq.php">FAQs</a>
<a class="nav" href="../../../../contact.php">Contact</a>
<a class="nav" href="../../../../donate.php">Donations</a>
</div>

<h6>Copyright Lazy Foo' Productions 2004-2024</h6>
</div>

</body>
</html>