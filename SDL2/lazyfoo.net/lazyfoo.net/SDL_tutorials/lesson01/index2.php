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
<div class="tutPreface"><h1 class="tutHead">Getting an Image on the Screen</h1>
<div class="tutImg"><img src="preview2.jpg"></div>
<h6>Last Updated 1/1/14</h6>
This tutorial covers how to do Hello World SDL style.<br>
<br>
Now that you have SDL set up, it's time to make a bare bones graphics application that loads and displays an image
on the screen.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/02_getting_an_image_on_the_screen/index.php">Getting an Image on the Screen tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//Include SDL functions and datatypes
#include "SDL/SDL.h"
</div>

<div class="tutText">
At the top of the source file we include the SDL header file so we can use the SDL functions and data types.<br>
<br>
Remember that some of you (like Visual Studio users) are going to include SDL like this:
<h6>#include "SDL.h"</h6>
So if the compiler is complaining that it can't find "SDL/SDL.h", then it's either because you're including the
wrong path or you forgot to put SDL.h in the right place.
</div>

<div class="tutCode">int main( int argc, char* args[] )
{
    //The images
    SDL_Surface* hello = NULL;
    SDL_Surface* screen = NULL;
</div>

<div class="tutText">
At the top of the main() function, two SDL_Surface pointers are declared. An SDL_Surface is an image, and in this
application we're going to be dealing with two images. The surface "hello" is the image we're going to be
loading and showing. The "screen" is what is visible on the screen.<br>
<br>
Whenever you're dealing with pointers, you should always remember to initialize them.<br>
<br>
Also, when using SDL, you must have your main() function declared like it is above. You can't use void main() or
anything like that. 
</div>

<div class="tutCode">    //Start SDL
    SDL_Init( SDL_INIT_EVERYTHING );

    //Set up screen
    screen = SDL_SetVideoMode( 640, 480, 32, SDL_SWSURFACE );

    //Load image
    hello = SDL_LoadBMP( "hello.bmp" );
</div>

<div class="tutText">
The first function we call in the main() function is SDL_Init(). This call of SDL_Init() initializes all the SDL
subsystems so we can start using SDL's graphics functions.<br>
<br>
Next SDL_SetVideoMode() is called to set up a 640 pixel wide, 480 pixel high window that has 32 bits per pixel.
The last argument (SDL_SWSURFACE) sets up the surface in software memory. After SDL_SetVideoMode() executes, it
returns a pointer to the window surface so we can use it.<br>
<br>
After the window is set up, we load our image using SDL_LoadBMP(). SDL_LoadBMP() takes in a path to a bitmap file
as an argument and returns a pointer to the loaded SDL_Surface. This function returns NULL if there was an error
in loading the image.
</div>

<div class="tutCode">    //Apply image to screen
    SDL_BlitSurface( hello, NULL, screen, NULL );

    //Update Screen
    SDL_Flip( screen );

    //Pause
    SDL_Delay( 2000 );
</div>

<div class="tutText">
Now that we have our window set up and our image loaded, we want to apply the loaded image onto the screen. We do
this using SDL_BlitSurface(). The first of SDL_BlitSurface() argument is the source surface. The third argument is
the destination surface. SDL_BlitSurface() sticks the source surface onto the destination surface. In this case,
it's going to apply our loaded image onto the screen. You'll find out what the other arguments do in later
tutorials.<br>
<br>
Now that our image is applied to screen, we need to update the screen so we can see it. We do this using SDL_Flip().
If you don't call SDL_Flip(), you'll only see an unupdated blank screen.<br>
<br>
Now that the image is applied to the screen and it's made visible, we have to make the window stay visible so it
doesn't just flash for a split second and disappear. We'll make the window stay by calling SDL_Delay(). Here we
delay the window for 2000 milliseconds (2 seconds). You'll learn a better way to make the window stay in place in
<a class="tutLink" href="../lesson04/index.php">tutorial 4</a>.
</div>

<div class="tutCode">    //Free the loaded image
    SDL_FreeSurface( hello );

    //Quit SDL
    SDL_Quit();

    return 0;
}
</div>

<div class="tutText">
Now that we're not going to use the loaded image anymore in our program, we need to remove it from memory. You
can't just use delete, you have to use SDL_FreeSurface() to remove the image from memory. At the end of our
program, we call SDL_Quit() to shut down SDL.<br>
<br>
You may be wondering why we never deleted the screen surface. Don't worry, SDL_Quit() cleans it up for you.<br>
<br>
Congratulations, you've just made your first graphics application.
</div>

<div class="tutText">
<h1 class="tutHead">Troubleshooting your SDL application</h1>
If the compiler complains that it can't find <b>'SDL/SDL.h'</b>, it means you forgot to set up your header files.
Your compiler/IDE should be looking for the SDL header files, so make sure that it's configured to look in the
SDL include folder.<br>
<br>
If you're using Visual Studio and the compiler complains <b>'SDL/SDL.h': No such file or directory</b>,
go to the top of the source code and make sure it says <b>#include "SDL.h"</b>.<br>
<br>
If your program compiles, but linker complains it can't find some lib files, make sure your compiler/IDE
is looking in the SDL lib folder. If your linker complains about an undefined references to a bunch of SDL
functions, make sure you linked against SDL in the linker.<br>
<br>
If your linker complains about entry points, make sure that you have the main function declared the right way
and that you only have one main function combined in your source code.<br>
<br>
If the program compiles, links, and builds, but when you try to run it it complains that it can't find SDL.dll,
make sure you put SDL.dll in the same directory as the compiled executable. Visual Studio users will need to put
the dll file in the same directory as your vcproj file. Windows users can also put the dll inside of the system32
directory.<br>
<br>
If you run the program and the images don't show up or the window flashes for a second and you find in stderr.txt:<br>
<b>Fatal signal: Segmentation Fault (SDL Parachute Deployed)</b><br>
It's because the program tried to access memory it wasn't supposed to. Odds are its because it tried to access
NULL when SDL_BlitSurface() was called. This means you need to make sure the bitmap files are in the same directory
as the program.  Visual Studio users will need to put the bitmap file in the same directory as your vcproj file.<br>
<br>
Also if you're using Visual Studio and you get the error <b>"The application failed to start because the
application configuration is incorrect. Reinstalling the application may fix this problem."</b>, it's because you
don't have the service pack update installed. <a class="tutLink" href="windows/vcsetup/index.php">Do
not forget to have the latest version of your compiler/IDE with the service pack update for your compiler/IDE or
SDL will not work with Visual Studio</a>.<br>
<br>
Some Linux users will run and get a blank screen. Try running the program from the command line.<br>
<br>
If you had to create a project to compile an SDL program, remember that you will need to create a project for
every SDL program you create. Or, better yet, you can reuse the SDL project you made the first time.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson01.zip">here</a>.<br>
<br>
<a class="leftNav" href="index.php">Tutorial Index</a><a class="rightNav" href="../lesson02/index.php">Next Tutorial</a>
<br>
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