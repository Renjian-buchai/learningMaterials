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
<h6>Last Updated 11/02/09</h6>
</div>

<div class="tutText">
<a class="tutLink" name="1" href="index.php#1">1)</a>First thing you need to do is download SDL headers and binaries.<br>
You will find them on the SDL website, specifically on <a class="tutLink" href="http://www.libsdl.org/download-1.2.php">this page</a>.<br>
<br>
Scroll Down to the Development Libraries section and download the MinGW32 development library<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/eclipse/download.jpg"></div>
<br>
Open gz archive and there should be a *.tar archive inside.<br>
Open the *.tar and there should be a folder inside of that.<br>
Open the folder and it'll contain a bunch of subfolders.<br>
<br>
<a class="tutLink" name="2" href="index.php#2">2)</a>Copy the contents of the lib subfolder to the MinGW lib folder.<br>
The MinGW lib folder should be at C:\MinGW\lib.<br>
<br>
<a class="tutLink" name="3" href="index.php#3">3)</a>After that, open the include subfolder in the archive and extract the folder named "SDL" to
the MinGW include folder, which should be at C:\MinGW\include.<br>
<br>
Note: Some versions of SDL won't have a folder named "SDL" in the archive's include subfolder, but just a bunch of
header files. To get around this simply create a folder named "SDL" in your MinGW include folder and copy all the
header files from the archive to that folder you made.<br>
<br>
<a class="tutLink" name="4" href="index.php#4">4)</a>Now take the SDL.dll from the archive (it should be inside the bin
subfolder) and extract it. You're going to put this in the same directory as your exe when you compile it.<br>
<br>
Alternatively, you can copy SDL.dll to C:\WINDOWS\SYSTEM32 so your SDL app will find SDL.dll even if it's not in
the same directory. If you're using a 64bit version of Windows, you'll want to put the dll in C:\Windows\SysWOW64.<br>
<br>
The problem with this method is if you have multiple SDL apps that use different versions of SDL, you'll have
version conflicts. If you have SDL 1.2.8 in SYSTEM32 when the app uses 1.2.13 you're going to run into problems.
Generally you want to have your SDL.dll in the same directory as your executable developing and you'll
<b>always</b> want to have SDL.dll in the same directory as the exe when distributing your app.<br>
<br>
<a class="tutLink" name="5" href="index.php#5">5)</a>Now start up Eclipse and start a new project.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/eclipse/new_project.jpg"></div>
<br>
<a class="tutLink" name="6" href="index.php#6">6)</a>Make it a managed make C++ project.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/eclipse/managed.jpg"></div>
Then hit next.<br>
<br>
<a class="tutLink" name="7" href="index.php#7">7)</a>Name your project.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/eclipse/name.jpg"></div>
Then hit next.<br>
<br>
<a class="tutLink" name="8" href="index.php#8">8)</a>Then hit finish.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/eclipse/project_finish.jpg"></div>
<br>
<a class="tutLink" name="9" href="index.php#9">9)</a>Go to the project properties.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/eclipse/project_properties.jpg"></div>
<br>
<a class="tutLink" name="10" href="index.php#10">10)</a>Go to the C/C++ Build menu, then the Libraries submenu.
In the Libraries submenu click add.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/eclipse/add.jpg"></div>
<br>
<a class="tutLink" name="11" href="index.php#11">11)</a>Then paste in:
<h6>mingw32</h6>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/eclipse/mingw32.jpg"></div>
and click ok.<br>
<br>
<a class="tutLink" name="12" href="index.php#12">12)</a>Then do the same with:
<h6>SDLmain</h6>
and
<h6>SDL</h6>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/eclipse/link.jpg"></div>
Do it in this exact order or it won't work.<br>
<br>
<a class="tutLink" name="13" href="index.php#13">13)</a>Add source new source file to the project, and
paste the following code into the new source file:
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
<a class="tutLink" name="14" href="index.php#14">14)</a>Now save the source and compile. Make sure SDL.dll is in the same
directory as the executable. If there are no errors, you're finished. Otherwise go back and make sure you didn't
skip a step.
</div>

<div class="tutFooter">
Also, In the archive you just downloaded there's a subfolder called "docs".
It contains the SDL documentation.<br>
<br>
I highly recommend that you extract them somewhere and keep it for reference.<br>
<br>
<a class="leftNav" href="../../../index.php">Tutorial Index</a><a class="rightNav" href="../../index2.php">Part 2: Getting an Image on the Screen</a><br>
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