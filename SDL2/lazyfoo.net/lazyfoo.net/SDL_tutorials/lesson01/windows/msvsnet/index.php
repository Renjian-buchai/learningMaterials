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
<div class="tutPreface"><h1 class="tutHead">Setting up SDL in Visual Studio.NET 2003</h1>
<h6>Last Updated 2/18/12</h6>
Before you start, make sure you have the Visual Studio 2003 service pack properly installed. If you don't,
<b>SDL will not work</b> with Visual Studio.NET 2003. I have a mini tutorial to properly set up VS.NET available
<a class="tutLink" href="../vcsetup/index.php">here</a>.
</div>

<div class="tutText">
<a class="tutLink" name="1" href="index.php#1">1)</a>First thing you need to do is download SDL headers and binaries.<br>
You will find them on the SDL website, specifically on <a class="tutLink" href="http://www.libsdl.org/download-1.2.php">this page</a>.<br>
<br>
Scroll Down to the Development Libraries section and download the Windows development library<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/msvsnet/dl.jpg"></div>
<br>
Open the zip and there should be a folder inside of it.<br>
Open the folder and it'll contain a bunch of subfolders.<br>
<br>
<a class="tutLink" name="2" href="index.php#2">2)</a>Next go to the Visual C++ include folder and create a folder called "SDL".
The Visual C++ include folder should be at C:\Program Files\Microsoft Visual Studio .NET 2003\Vc7\Include.<br>
<br>
<a class="tutLink" name="3" href="index.php#3">3)</a>Then open the include subfolder in the archive and extract its contents to the folder you just made,
which should be at C:\Program Files\Microsoft Visual Studio .NET 2003\Vc7\Include\SDL.<br>
<br>
<a class="tutLink" name="4" href="index.php#4">4)</a>Copy SDL.lib and SDLmain.lib from the lib subfolder in the archive to the Visual C++ lib folder.
The Visual C++ lib folder should be at C:\Program Files\Microsoft Visual Studio .NET 2003\Vc7\lib.<br>
<br>
For certain versions of SDL, there will be a x86 folder and a x64 folder inside of the lib folder from the archive. The x86 folder contains the 32bit *.lib files
and the x64 bit folder contains the 64bit versions of the library files. If you're compiling a 32bit program, copy the the *.lib files from the x86 folder and if you're
compiling a 64bit version get the library files from the x64 folder. By default Visual Studio compiles in 32bit so if you're not sure how you're compiling, try the 32bit
libraries first. What matters here is not whether you have 32/64bit windows, but what type of program you're compiling.<br>
<br>
<a class="tutLink" name="5" href="index.php#5">5)</a>Now take the SDL.dll from the archive (it should be inside the lib
subfolder) and extract it. You're going to put this in the same directory as your project/exe when you compile it.<br>
<br>
Alternatively, you can copy SDL.dll to C:\WINDOWS\SYSTEM32 so your SDL app will find SDL.dll even if it's not in
the same directory. If you're using a 64bit version of Windows, you'll want to put the dll in C:\Windows\SysWOW64.<br>
<br>
The problem with this method is if you have multiple SDL apps that use different versions of SDL, you'll have
version conflicts. If you have SDL 1.2.8 in SYSTEM32 when the app uses 1.2.13 you're going to run into problems.
Generally you want to have your SDL.dll in the same directory as your executable developing and you'll
<b>always</b> want to have SDL.dll in the same directory as the exe when distributing your app.<br>
<br>
<a class="tutLink" name="7" href="index.php#7">7)</a>Now start up Visual Studio and start a new Win32 project:<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/msvsnet/new_project.jpg"></div>
and click ok.<br>
<br>
<a class="tutLink" name="8" href="index.php#8">8)</a>Make sure it's an empty project by going to the application settings:<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/msvsnet/empty_project.jpg"></div>
and checking "Empty Project" so nothing is automatically generated.<br>
<br>
<a class="tutLink" name="9" href="index.php#9">9)</a>Then add a new source file to the project:
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/msvsnet/new_cpp.jpg"></div>
<br>
<a class="tutLink" name="10" href="index.php#10">10)</a>Now paste the following code into your new source file:
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
and save the source file.<br>
<br>
<a class="tutLink" name="11" href="index.php#11">11)</a>Next go to project settings.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/msvsnet/project_properties.jpg"></div>
<br>
<a class="tutLink" name="12" href="index.php#12">12)</a>In the C/C++ folder under Code Generation, set "Runtime Library" to multi-threaded dll.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/msvsnet/multithreadeddll.jpg"></div>
<br>
<a class="tutLink" name="13" href="index.php#13">13)</a>In the Linker folder under Input, paste:
<h6>SDL.lib SDLmain.lib</h6>
in the additional dependencies field.<br>
<div class="tutImg"><img src="https://lazyfoo.net/SDL_tutorials/lesson01/windows/msvsnet/linker.jpg"></div>
<br>
Now Build. Make sure SDL.dll is in the same directory as the project/executable. If there are no errors, you're
finished. Otherwise go back and make sure you didn't skip a step.
</div>

<div class="tutFooter">
Also, In the archive you just downloaded there's a subfolder called "docs".
It contains the SDL documentation.<br>
<br>
I highly recommend that you extract them somewhere and keep it for reference.<br>
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