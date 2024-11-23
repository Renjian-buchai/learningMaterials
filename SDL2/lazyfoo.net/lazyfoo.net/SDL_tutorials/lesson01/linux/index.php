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

<link REL="stylesheet" TYPE="text/css" href="../../lazy.css">
</head>

<body>

<div class="header">
<h1 style="margin-bottom:0px;padding-bottom:0px;border-bottom:0px;">Lazy Foo' Productions</h1>

<div class="nav">
Yes, I am keeping the old tutorial set in the old layout for the sake of having a nostalgic eater egg. It's not because I am too lazy to port this over to the data driven static site generator.<br/>
<br/>
<a class="nav" href="https://discourse.libsdl.org/">SDL Forums</a>
<a class="nav" href="../../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../../articles/index.php">Articles</a>
<a class="nav" href="../../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../../index.php">News</a>
<a class="nav" href="../../../faq.php">FAQs</a>
<a class="nav" href="../../../contact.php">Contact</a>
<a class="nav" href="../../../donate.php">Donations</a><br/>
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
<div class="tutPreface"><h1 class="tutHead">Setting up SDL in Linux</h1>
<h6>Last Updated 6/14/11</h6>
Since there are so many flavors of Linux these tutorials might not work on your Linux set up.
Try reading the <a class="tutLink" href="http://www.libsdl.org/faq.php?action=listentries&category=3">SDL Linux FAQ</a>.
If you've tried everything and are still having problems, <a href="../../../contact.php" class="tutLink">contact me</a>
and I'll try to add on a distro specific fix.<br/>
<br/>
A <a class="tutLink" href="../../../tutorials/SDL/01_hello_SDL/linux/index.php">Setting up SDL 2 on linux tutorial</a> is now available.
</div>

<div class="tutText">
<a class="tutLink" name="1" href="index.php#1">1)</a>
For Ubuntu users, it's recommended that you use the built in package manager. You can access the package manager
going to system -> administration -> Synaptic Package Manager. Once you're in, search for "libsdl1.2-dev"
(without quotes), which is the SDL development package. Once you find it, click and install it.<br>
<br>
<a class="tutLink" name="2" href="index.php#2">2)</a>
For those of you who have Advanced Packaging Tool available you can enter the command:

<h6>apt-get install libsdl1.2-dev libsdl-image1.2-dev libsdl-mixer1.2-dev libsdl-ttf2.0-dev</h6>

You need to have root priviledges, so use the "su" command or "sudo" command.<br>
<br>
<a class="tutLink" name="3" href="index.php#3">3)</a>
For the Yellow dog Updater, Modified you can enter the command:

<h6>yum install SDL-devel SDL_mixer-devel SDL_image-devel SDL_ttf-devel</h6>

As with apt-get, you'll need root priviledges.<br>
<br>
<a class="tutLink" name="4" href="index.php#4">4)</a>
For RPM based distros, you'll need the SDL development RPM.<br>
You will find them on the SDL website, specifically on <a class="tutLink" href="http://www.libsdl.org/download-1.2.php">this page</a>.<br>
<br>
Scroll Down to the Development Libraries section and download the Linux development library:<br>
<div class="tutImg"><img src="download.jpg"></div>
<br>
Now run the RPM and let it do it's thing.<br>
<br>
Now that you've installed the development libraries, it's time to start up your IDE/compiler.
</div>

<table class="tutToC">
<col width="1%">
	<tr>
	<td class="ToCTitle" colspan="2">Select Your IDE/Compiler</td>
	</tr>
	
	<tr>
		<td class="tutLink"><a href="anjuta/index.php" class="tutLink"><img src="anjuta/logo.jpg"></a></td>
		<td class="tutLink"><a href="anjuta/index.php" class="tutLink">Anjuta 1.2.2</a></td>
	</tr>

	<tr>
		<td class="tutLink"><a href="kdevelop/index.php" class="tutLink"><img src="kdevelop/logo.jpg"></a></td>
		<td class="tutLink"><a href="kdevelop/index.php" class="tutLink">KDevelop 3.2</a></td>
	</tr>
	
	<tr>
		<td class="tutLink"><a href="eclipse/index.php" class="tutLink"><img src="eclipse/logo.jpg"></a></td>
		<td class="tutLink"><a href="eclipse/index.php" class="tutLink">Eclipse 3.0</a></td>
	</tr>
	
	<tr>
		<td class="tutLink"><a href="cli/index.php" class="tutLink"><img src="cli/logo.jpg"></a></td>
		<td class="tutLink"><a href="cli/index.php" class="tutLink">Command Line</a></td>
	</tr>

	<tr>
	<td colspan="2" class="tutLink"><a href="../index.php" class="tutLink">Back</a></td>
	</tr>
</table>


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
<a class="nav" href="../../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../../articles/index.php">Articles</a>
<a class="nav" href="../../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../../index.php">News</a>
<a class="nav" href="../../../faq.php">FAQs</a>
<a class="nav" href="../../../contact.php">Contact</a>
<a class="nav" href="../../../donate.php">Donations</a>
</div>

<h6>Copyright Lazy Foo' Productions 2004-2024</h6>
</div>

</body>
</html>