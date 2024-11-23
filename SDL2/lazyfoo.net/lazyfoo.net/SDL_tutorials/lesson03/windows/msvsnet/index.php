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
<div class="tutPreface"><h1 class="tutHead">Setting up SDL Extension Libraries in Visual Studio.NET 2003</h1>
<h6>Last Updated 2/18/12</h6>
In this tutorial you're going to learn to set up SDL_image. If you know how to set up this extension, you can set any of them up.<br>
<br>
SDL_image is located on <a class="tutLink" href="http://www.libsdl.org/projects/SDL_image/release-1.2.html">this page</a>.
</div>

<div class="tutText">
<a class="tutLink" name="1" href="index.php#1">1)</a>Scroll down to the Binary section and download the Windows development library<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson03/windows/msvsnet/download.jpg"></div>
<br>
Every extension libary has 3 essential parts:<br>
<ol>
<li>The header file.</li>
<li>The lib file.</li>
<li>The *.dll file(s)</li>
</ol>
They're all set up pretty much the same way no matter which extension you're setting up.<br>
<br>
Open up the zip archive and there should be a folder inside.<br>
Open the folder and it'll contain 2 subfolders.<br>
<br>
<a class="tutLink" name="2" href="index.php#2">2)</a>First, open the include subfolder in the archive and extract the header file inside
to the SDL subfolder inside of the Visual C++ include folder.
It should be at C:\Program Files\Microsoft Visual Studio .NET 2003\Vc7\Include\SDL.<br>
<br>
<a class="tutLink" name="3" href="index.php#3">3)</a>Now find the lib folder from the archive. Take the library file(s) from the archive and put them with the rest of the SDL library files.
The Visual C++ lib folder should be at C:\Program Files\Microsoft Visual Studio .NET 2003\Vc7\Lib.<br>
<br>
For certain versions of SDL_image, there will be a x86 folder and a x64 folder inside of the lib folder from the archive. The x86 folder contains the 32bit *.lib files
and the x64 bit folder contains the 64bit versions of the library files. If you're compiling a 32bit program, copy the library file(s) from the x86 folder and if you're
compiling a 64bit version copy the library file(s) from the x64 folder. By default Visual Studio compiles in 32bit so if you're not sure how you're compiling, try the 32bit
libraries first. What matters here is not whether you have 32/64bit windows, but what type of program you're compiling.<br>
<br>
If you don't see a x86 or x64 folder inside of the lib directory from the archive, just copy the library file(s) from the lib folder from the archive.<br>
<br>
<a class="tutLink" name="4" href="index.php#4">4)</a>Now extract all of the *.dll file(s) from the archive and put them in
the same directory as your project/exe.<br>
<br>
Like before, you can copy them to C:\WINDOWS\SYSTEM32 (or C:\Windows\SysWOW64 on 64bit Windows) so your SDL app
will find the *.dll(s) even if they're not in the same directory. The problem with this method is if you have
multiple SDL apps that use different versions of SDL, you'll have version conflicts. If you have an old version
in SYSTEM32 when the app uses the new version you're going to run into problems. Generally you want to have your
the *.dll(s) in the same directory as your executable developing and you'll <b>always</b> want to have *.dll(s) in
the same directory as the exe when distributing your app.<br>
<br>
<a class="tutLink" name="5" href="index.php#5">5)</a>Now open up your SDL project and go to the project properties.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson03/windows/msvsnet/project_properties.jpg"></div>
<br>
<a class="tutLink" name="6" href="index.php#6">6)</a>In the Linker folder under Input, paste:
<h6>SDL_image.lib</h6>
in the additional dependencies field after "SDL.lib SDLmain.lib".<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson03/windows/msvsnet/extension.jpg"></div>
<br>
If you were linking SDL_ttf you'd put <h6>SDL_ttf.lib</h6> if you were linking SDL_mixer you'd put <h6>SDL_mixer.lib</h6>
etc, etc.<br>
<br>
<a class="tutLink" name="7" href="index.php#7">7)</a>To use SDL_image make sure to include the header file.
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
Here is a revised version of the image loading function from the previous tutorial.
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