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
<div class="tutPreface"><h1 class="tutHead">Setting up SDL in Eclipse</h1>
<h6>Last Updated 6/14/11</h6>
</div>

<div class="tutText"><a class="tutLink" name="1" href="index.php#1">1)</a>Start a new managed make project:<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/linux/eclipse/new_project.png"></div>
<br>
<a class="tutLink" name="2" href="index.php#2">2)</a>After you've named your project and everything go to project properties:<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/linux/eclipse/project_properties.png"></div>
<br>
<a class="tutLink" name="3" href="index.php#3">3)</a>Go to the C/C++ Build menu, then the Libraries submenu. In the Libraries submenu click add.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/linux/eclipse/add.png"></div>
<br>
<a class="tutLink" name="4" href="index.php#4">4)</a>Then paste
<h6>SDL</h6>
and click ok.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/linux/eclipse/link.png"></div>
<br>
<a class="tutLink" name="5" href="index.php#5">5)</a>Add a new source file to your project and paste the following code into it:
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
<a class="tutLink" name="6" href="index.php#6">6)</a>Now save and compile your project.
If it compiles you're done. Otherwise go back and make sure you didn't skip a step.
</div>

<div class="tutFooter">
The RPM also installed the SDL documentation on your computer.<br>
<br>
It should be at usr/doc/SDL-devel-1.2.9/index.html,<br>
usr/doc/SDL-devel-1.2.10/index.html if you're using SDL 1.2.10,<br>
usr/doc/SDL-devel-1.2.11/index.html if you're using SDL 1.2.11, etc, etc.<br>
<br>
Under some linux distributions, it will be located at:<br>
/usr/share/doc/libsdl1.2-dev/docs/index.html<br>
/usr/share/doc/libsdl1.2-dev/docs/html/index.html<br>
<br>
Bookmark it and keep it handy for reference.<br>
<br>
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