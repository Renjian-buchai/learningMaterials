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
<div class="tutPreface"><h1 class="tutHead">Setting up SDL for XCode</h1>

<h6>Last Updated 12/21/12</h6>

</div>

<div class="tutText">
<a class="tutLink" name="1" href="index.php#1">1)</a> First thing you need to do is download the SDL library. It's available on the SDL website.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/mac/xcode/download.jpg"></div>
Fortunately, the runtime and development libraries are the same for Mac OS X Lion.<br>
<br>
<a class="tutLink" name="2" href="index.php#2">2)</a> Open up the runtime package. Copy the SDL.framework folder to /Library/Frameworks. For those unfamiliar with Lion, pressing
command+shift+g to get a path prompt.
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/mac/xcode/path.png"></div>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/mac/xcode/frameworks.png"></div>
<br>
If you don't have root access, you can put it in your user's Library/Frameworks directory.<br>
<br>
<a class="tutLink" name="3" href="index.php#3">3)</a> Start up XCode and create a new XCode project. Select SDL Command Line Application.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/mac/xcode/new_project.png"></div>
<br>
<a class="tutLink" name="4" href="index.php#4">4)</a> Go back to the runtime package and copy the SDLmain templates from the devel directory to your project directory and add them to
your project.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/mac/xcode/devel.png"></div>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/mac/xcode/copy_templates.png"></div>
<br>
<a class="tutLink" name="5" href="index.php#5">5)</a> Click on your target to bring up the Build Settings/Build Phases/Build Rules tabs.
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/mac/xcode/build_targets.png"></div>
<br>
<a class="tutLink" name="6" href="index.php#6">6)</a> In the Build Settings tab, add /Library/Frameworks to the Framework search paths so XCode can find the frameworks we added.
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/mac/xcode/framework_path.png"></div>
<br>
<a class="tutLink" name="7" href="index.php#7">7)</a> In the Build Phases tab under Link Binary With Libraries add the Cocoa Framework.
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/mac/xcode/build_phases.png"></div>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/mac/xcode/add_cocoa.png"></div>
<br>
<a class="tutLink" name="8" href="index.php#8">8)</a> Now you're going to have to add SDL framework. Click Add Other to bring up the file selector menu and then hit command+shift+g
to go the the /Library/Frameworks directory and open the SDL.framework framework.
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/mac/xcode/add_other.png"></div>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/mac/xcode/add_SDL.png"></div>
<br>
<a class="tutLink" name="9" href="index.php#9">9)</a> Go into the SDLmain.m template file you added and change <b>#include "SDL.h"</b> to <b>#include "SDL/SDL.h"</b><br>
<br>
<a class="tutLink" name="10" href="index.php#10">10)</a> Go into main.cpp file that XCode auto generated and replace the code inside with the following code.
</div>

<div class="tutCode">#include "SDL/SDL.h"

int main( int argc, char* args[] )
{
    //Start SDL
    SDL_Init( SDL_INIT_EVERYTHING );
    
    //Quit SDL
    SDL_Quit();
    
    return 0;    
}
</div>

<div class="tutText">
If it compiles you're done. Otherwise go back and make sure you didn't skip a step.
</div>

<div class="tutFooter">
<a class="leftNav" href="../../../index.php">Tutorial Index</a>
<a class="rightNav" href="../../index2.php">Part 2: Getting an Image on the Screen</a><br>
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