<!-- Get tutorial set -->


<!-- Tutorial root -->



    <!-- Desktop tutorial set -->
    
        
        
        
    <!-- Normal tutorial set -->
    

                    

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

	<head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VP5RSQ168Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VP5RSQ168Y');
</script>



<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="SDL 2 C++ Tutorial 2D Mac OS X XCode Install SDL 2 iOS iPhone iPad iPod Touch">
<meta name="description" content="Install SDL 2 on iOS.">

<link href="../../../../assets/style.css" rel="stylesheet">
<script src="../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL 2 on iOS with XCode 14.1</title>

<script src="../../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
	<a href="../../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../../donate.php" class="nav-item nav-link">Donations</a>
</nav>

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

<nav class="container">
		<script async src="https://cse.google.com/cse.js?cx=f01a79f66150b448d">
		</script>
		<div class="gcse-search"></div>
</nav>


</header>


		
		<main>
            <div class="container">
                
                    
                        <div class="container border py-3 my-3">
    <h1 class="text-center">Setting up SDL 2 on iOS with XCode 14.1</h1>
    
    <p class="text-center"><b>Last Updated: Nov 7th, 2022</b></p>
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <a name="1" href="index.php#1">1)</a> First thing you need to do is download SDL 2 full source. Not just the MacOS libraries, the full source. You will find them on the SDL GitHub, specifically
on <a href="https://github.com/libsdl-org/SDL/releases">this page</a>.<br/>
<div class="text-center"><img class="img-fluid" alt="sdl source" src="../sdl2-src.png"></div>
<br/>
Extract the folder to someplace dedicated to iOS development source code. For this tutorial, we'll be assuming you're going to put it ~/ioslib.<br/>
<br/>

<a name="2" href="index.php#2">2)</a> Start a new iOS game project:
<div class="text-center"><img class="img-fluid" alt="new game project" src="game-project.png"></div>
Make sure it's an Objective-C, Metal project:
<div class="text-center"><img class="img-fluid" alt="objective c metal project" src="objective-c-metal-project.png"></div>
<br/>

<a name="3" href="index.php#3">3)</a> Make sure to delete the auto generated files, except for the Assets and LaunchScreen 
<div class="text-center"><img class="img-fluid" alt="delete auto generated files" src="delete-default-files.png"></div>
<br/>

<a name="4" href="index.php#4">4)</a> We need to add SDL 2 as a sub project to your game project, so right click on your project and select Add Files:<br/>
<div class="text-center"><img class="img-fluid" alt="add project" src="add-project.png"></div>
<br/>
In the SDL 2 source code folder you extracted, go to XCode, SDL, and select SDL.xcodeproj:<br/>
<div class="text-center"><img class="img-fluid" alt="add xcode project" src="add-xcode-project.png"></div>
<br/>

<a name="5" href="index.php#5">5)</a> Before we continue, remember to always <b>DOUBLE CHECK WHICH PROJECT YOU HAVE SELECTED</b>. Because you have multiple projects in your project, it is very easy
to mistakenly make changes to the SDL 2 project when you wanted to make changes to your main project or vice versa.<br/>
<br/>
Select your main project, select the Info tab, select "Main storyboard file base name", and hit delete:<br/>
<div class="text-center"><img class="img-fluid" alt="delete storyboard" src="delete-storyboard.png"></div>
<br/>

<a name="6" href="index.php#6">6)</a> Go to Build Settings, select "All" and "Combined", and drag the Public Headers from the project to the Header Search Paths:<br/>
<div class="text-center"><img class="img-fluid" alt="add public headers" src="add-public-headers.png"></div>
<br/>

<a name="7" href="index.php#7">7)</a> Go to Build Phases, open up Link Binary With Libraries, and click the plus to Add items:<br/>
<div class="text-center"><img class="img-fluid" alt="link with libraries" src="link-with-libraries.png"></div>
<br/>
Select the SDL2.framework from Framework-iOS:<br/>
<div class="text-center"><img class="img-fluid" alt="sdl framework" src="sdl-framework.png"></div>
<br/>

<a name="8" href="index.php#8">8)</a> Go to the General tab, under Frameworks, Libraries, and Embedded Content, set the framework to Embed and Sign:<br/>
<div class="text-center"><img class="img-fluid" alt="embed and sign" src="embed-and-sign.png"></div>
<br/>

<a name="9" href="index.php#9">9)</a> Download the <a href="../52_hello_mobile.zip">source for lesson 52</a>. Add the source file to your project. In the SDL subproject inside of the
project view, drag SDL/Library Source/main/uikit/SDL_uikit_main.c down to the same place as the tutorial source code.<br/>
<br/>
To add media to your project, Add file to your main project, select the folder you want to add, and make sure to "Create folder references" when adding it:<br/>
<div class="text-center"><img class="img-fluid" alt="add folder reference" src="add-folder-reference.png"></div>
<br/>

<a name="10" href="index.php#10">10)</a> Now you should have your source file, media files, and main file added to your project:<br/>
<div class="text-center"><img class="img-fluid" alt="added files" src="added-files.png"></div>
<br/>
Now build and run your application. The simulator can take up to a minute to boot and run so give it time. With the application building and running, it's time to go over the source code.

</div>
                    
                
                    
                        <div class="container border py-3 my-3">




<a href="../index2.php">Hello Mobile Part 2: Your First Mobile SDL 2 App</a><br/>




</div>
                    
                
            </div>
		</main>
		
<footer class="my-3 py-3">
    
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

	<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
	<a href="../../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>