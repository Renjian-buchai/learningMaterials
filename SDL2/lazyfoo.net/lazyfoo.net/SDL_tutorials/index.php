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

<link REL="stylesheet" TYPE="text/css" href="lazy.css">
</head>

<body>

<div class="header">
<h1 style="margin-bottom:0px;padding-bottom:0px;border-bottom:0px;">Lazy Foo' Productions</h1>

<div class="nav">
Yes, I am keeping the old tutorial set in the old layout for the sake of having a nostalgic eater egg. It's not because I am too lazy to port this over to the data driven static site generator.<br/>
<br/>
<a class="nav" href="https://discourse.libsdl.org/">SDL Forums</a>
<a class="nav" href="../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../articles/index.php">Articles</a>
<a class="nav" href="../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../index.php">News</a>
<a class="nav" href="../faq.php">FAQs</a>
<a class="nav" href="../contact.php">Contact</a>
<a class="nav" href="../donate.php">Donations</a><br/>
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
<div class="tutPreface"><h1 class="tutHead">Beginning Game Programming</h1>
<h6>Last Updated 6/28/14</h6>
Welcome to the legacy SDL tutorial page. There is now an <a href="../tutorials/SDL/index.php" class="tutLink">SDL 2.0 tutorial</a> page and I recommend visiting that page because
this tutorial page is no longer being updated. Plus this new set has over 50 tutorials with brand new topics.<br/>
<br/>
If you are working with SDL 1.2 or are just feeling nostalgic, feel free to look around.
</div>

<table class="tutToC">

	<col width="17%">
	<col width="17%">
	<col width="17%">
	<col width="17%">
	<col width="17%">
	<col width="17%">
	
	<tr>
	<td class="ToCTitle" colspan="6">Table of Contents</td>
	</tr>
	
	<tr>
		<td class="tutLink">Lesson 1<br>
		<a href="lesson01/index.php" class="tutLink">Setting up SDL</a><br>
		and<br>
		<a href="lesson01/index2.php" class="tutLink">Getting an Image on the Screen</a>
		</td>
		<td class="tutLink">Lesson 2<br><a href="lesson02/index.php" class="tutLink">Optimized Surface Loading and Blitting</a></td>
		<td class="tutLink">Lesson 3<br><a href="lesson03/index.php" class="tutLink">Extension Libraries and Loading Other Image Formats</a></td>
		<td class="tutLink">Lesson 4<br><a href="lesson04/index.php" class="tutLink">Event Driven Programming</a></td>
		<td class="tutLink">Lesson 5<br><a href="lesson05/index.php" class="tutLink">Color Keying</a></td>
		<td class="tutLink">Lesson 6<br><a href="lesson06/index.php" class="tutLink">Clip Blitting and Sprite Sheets</a></td>
	</tr>
	
	<tr>
		<td class="tutLink">Lesson 7<br><a href="lesson07/index.php" class="tutLink">True Type Fonts</a></td>
		<td class="tutLink">Lesson 8<br><a href="lesson08/index.php" class="tutLink">Key Presses</a></td>
		<td class="tutLink">Lesson 9<br><a href="lesson09/index.php" class="tutLink">Mouse Events</a></td>
		<td class="tutLink">Lesson 10<br><a href="lesson10/index.php" class="tutLink">Key States</a></td>
		<td class="tutLink">Lesson 11<br><a href="lesson11/index.php" class="tutLink">Playing Sounds</a></td>
		<td class="tutLink">Lesson 12<br><a href="lesson12/index.php" class="tutLink">Timing</a></td>
	</tr>
	
	<tr>
		<td class="tutLink">Lesson 13<br><a href="lesson13/index.php" class="tutLink">Advanced Timers</a></td>
		<td class="tutLink">Lesson 14<br><a href="lesson14/index.php" class="tutLink">Regulating Frame Rate</a></td>
		<td class="tutLink">Lesson 15<br><a href="lesson15/index.php" class="tutLink">Calculating Frame Rate</a></td>
		<td class="tutLink">Lesson 16<br><a href="lesson16/index.php" class="tutLink">Motion</a></td>
		<td class="tutLink">Lesson 17<br><a href="lesson17/index.php" class="tutLink">Collision Detection</a></td>
		<td class="tutLink">Lesson 18<br><a href="lesson18/index.php" class="tutLink">Per-pixel Collision Detection</a></td>
		
	</tr>
	
	<tr>
		<td class="tutLink">Lesson 19<br><a href="lesson19/index.php" class="tutLink">Circular Collision Detection</a></td>
		<td class="tutLink">Lesson 20<br><a href="lesson20/index.php" class="tutLink">Animation</a></td>
		<td class="tutLink">Lesson 21<br><a href="lesson21/index.php" class="tutLink">Scrolling</a></td>
		<td class="tutLink">Lesson 22<br><a href="lesson22/index.php" class="tutLink">Scrolling Backgrounds</a></td>
		<td class="tutLink">Lesson 23<br><a href="lesson23/index.php" class="tutLink">Getting String Input</a></td>
		<td class="tutLink">Lesson 24<br><a href="lesson24/index.php" class="tutLink">Game Saves</a></td>
	</tr>
	
	<tr>
		<td class="tutLink">Lesson 25<br><a href="lesson25/index.php" class="tutLink">Joysticks</a></td>
		<td class="tutLink">Lesson 26<br><a href="lesson26/index.php" class="tutLink">Resizable Windows and Window Events</a></td>
		<td class="tutLink">Lesson 27<br><a href="lesson27/index.php" class="tutLink">Alpha Blending</a></td>
		<td class="tutLink">Lesson 28<br><a href="lesson28/index.php" class="tutLink">Particle Engines</a></td>
		<td class="tutLink">Lesson 29<br><a href="lesson29/index.php" class="tutLink">Tiling</a></td>
		<td class="tutLink">Lesson 30<br><a href="lesson30/index.php" class="tutLink">Bitmap Fonts</a></td>
	</tr>

	<tr>
		<td class="tutLink">Lesson 31<br><a href="lesson31/index.php" class="tutLink">Pixel Manipulation and Surface Flipping</a></td>
		<td class="tutLink">Lesson 32<br><a href="lesson32/index.php" class="tutLink">Frame Independent Movement</a></td>
		<td class="tutLink">Lesson 33<br><a href="lesson33/index.php" class="tutLink">Multithreading</a></td>
		<td class="tutLink">Lesson 34<br><a href="lesson34/index.php" class="tutLink">Semaphores</a></td>
		<td class="tutLink">Lesson 35<br><a href="lesson35/index.php" class="tutLink">Mutexes and Conditions</a></td>
		<td class="tutLink">Lesson 36<br><a href="lesson36/index.php" class="tutLink">Using OpenGL with SDL</a></td>
	</tr>
</table>

<div class="tutFooter">
Almost all of these tutorials have been ported to <a href="../tutorials/SDL/index.php" class="tutLink">SDL 2.0</a>, so I recommend checking those out.
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
<a class="nav" href="../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../articles/index.php">Articles</a>
<a class="nav" href="../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../index.php">News</a>
<a class="nav" href="../faq.php">FAQs</a>
<a class="nav" href="../contact.php">Contact</a>
<a class="nav" href="../donate.php">Donations</a>
</div>

<h6>Copyright Lazy Foo' Productions 2004-2024</h6>
</div>

</body>
</html>