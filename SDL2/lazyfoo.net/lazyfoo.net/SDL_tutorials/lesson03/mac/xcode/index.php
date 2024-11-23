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
<div class="tutPreface"><h1 class="tutHead">Setting up SDL Extension Libraries for XCode</h1>

<h6>Last Updated 9/17/12</h6>
In this tutorial you're going to learn to set up SDL_image. If you know how to set up this extension, you can set any of them up.<br>
<br>
SDL_image is located on <a class="tutLink" href="http://www.libsdl.org/projects/SDL_image/release-1.2.html">this page</a>.<br>
</div>

<div class="tutText">
<a class="tutLink" name="1" href="index.php#1">1)</a>Scroll down to the Binary section and download the Mac OS X package:<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson03/mac/xcode/download.jpg"></div>
<br>
<a class="tutLink" name="2" href="index.php#2">2)</a>Copy the SDL_image.framework folder from the runtime library package
to /Library/Frameworks.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson03/mac/xcode/image_framework.png"></div>
<br>
If you were setting up SDL_ttf you'd copy <h6>SDL_ttf.framework</h6>
if you were setting up SDL_mixer you'd put <h6>SDL_mixer.framework</h6>
etc, etc.<br>
<br>
<a class="tutLink" name="3" href="index.php#3">3)</a>Open up your SDL project. In the Build Phases Tab under Link Binary With Libraries add the SDL_image framework. Click Add Other to bring
up the file selector menu and then hit command+shift+g to go the /Library/Frameworks directory and open the SDL_image.framework framework.
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson03/mac/xcode/build_phases.png"></div>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson03/mac/xcode/add_other.png"></div>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson03/mac/xcode/add_SDL.png"></div>
<br>

<a class="tutLink" name="4" href="index.php#4">4)</a>To use SDL_image make sure to include the header file.
</div>

<div class="tutCode">#include "SDL_image/SDL_image.h"
</div>

<div class="tutText">If you were setting up SDL_ttf you'd put <h6>#include "SDL_ttf/SDL_ttf.h"</h6>
If you were setting up SDL_mixer you'd put <h6>#include "SDL_mixer/SDL_mixer.h"</h6>
etc, etc.<br>
<br>
Now the extension library is all set up.
</div>

<div class="tutText">Now you can use SDL_image functions.<br>
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
Here is a revised version of the image loading function from the previous tutorial.
As you can see IMG_Load() functions exactly the same as SDL_LoadBMP(), but there's one big exception:
IMG_Load() can load BMP, PNM, XPM, LBM, PCX, GIF, JPEG, TGA and PNG files.<br>
<br>
From this tutorial on, PNG image files will be the primary image format used. PNGs have excellent lossless compression.<br>
<br>
In the tutorials ahead, the example source codes include the SDL extensions differently.
</div>

<div class="tutCode">#include "SDL/SDL_image.h"
#include "SDL/SDL_ttf.h"
#include "SDL/SDL_mixer.h"
</div>

<div class="tutText">
This is how both Linux and Windows do it. Since this is how most platforms do it, it's how my example programs do it. To get the example programs to work with Mac OS X, simply remember to change how the SDL extension headers are included.
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