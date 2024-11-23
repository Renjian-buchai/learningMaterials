<!-- Get tutorial set -->


<!-- Tutorial root -->



    <!-- Desktop tutorial set -->
    
        
    <!-- Mobile tutorial set -->
    

                    

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
<meta name="keywords" content="SDL 2 C++ Tutorial 2D Mac OS X XCode install">
<meta name="description" content="Install SDL 2 on Mac OS X XCode.">

<link href="../../../../../assets/style.css" rel="stylesheet">
<script src="../../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL 2 on XCode 15.1</title>

<script src="../../../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../../../assets/external-link.svg"></a>
	<a href="../../../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../../../donate.php" class="nav-item nav-link">Donations</a>
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
    <h1 class="text-center">Setting up SDL 2 on XCode 15.1</h1>
    
    <p class="text-center"><b>Last Updated: Jan 7th, 2024</b></p>
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <a name="1" href="index.php#1">1)</a>
In XCode, create a new MacOS app:
<div class="text-center"><img class="img-fluid" alt="Create MacOS App" src="macos-app.png"></div>
<br/>
Set the interface to XIB and language to Objective-C. The other parameters like product name you can set however you want:
<div class="text-center"><img class="img-fluid" alt="project options" src="project-options.png"></div>
You can also place the project where ever you want, I am putting it in the user Documents folder.<br/>
<br/>

<a name="2" href="index.php#2">2)</a>
In your project, delete the AppDelegate.h/AppDelegate.m, main.m, and main.xib:
<div class="text-center"><img class="img-fluid" alt="delete files" src="delete-files.png"></div>
Make sure to leave everything else.<br/>
<br/>

<a name="3" href="index.php#3">3)</a>
Go download the OS X development libraries from the
<a href="https://github.com/libsdl-org/SDL/releases">SDL GitHub</a>.
<div class="text-center"><img class="img-fluid" alt="sdl2 dmg download page" src="../sdl2-dmg.png"></div>
<br/>
Open the dmg and then drag the SDL2.framework folder to place it alongside your xcodeproj file in your project folder:
<div class="text-center"><img class="img-fluid" alt="copy framework" src="copy-framework.png"></div>
<br/>

<a name="4" href="index.php#4">4)</a>
Now go download the <a href="../../01_hello_SDL.zip">source for lesson 01</a> and add the cpp file to your project alongside your Assets.xcassets folder. Try to build it and you will get an error about not being able to find
SDL.h.<br/>
<br/>
By default in the tutorials, the SDL headers are included like this:<br/>
<br/>
<code>#include &#060SDL/SDL.h&#062</code><br/>
<br/>
SDL on Mac OS X does things differently, so we have to include the headers like this:<br/>
<br/>
<code>#include &#060SDL2/SDL.h&#062</code><br/>
<br/>
If you change that include and try to build, you will still get errors. While the include is now correct, we need to tell XCode to include the SDL2 framework we downloaded. Select your project and go to General -> Frameworks,
Libraries, and Embedded Content -> click the plus sign to add items:
<div class="text-center"><img class="img-fluid" alt="add framework" src="add-items.png"></div>
<br/>
Click Add Other, then Add Files:
<div class="text-center"><img class="img-fluid" alt="add other files" src="add-other-files.png"></div>
<br/>
And open the SDL2.framework:
<div class="text-center"><img class="img-fluid" alt="open SDL2 framework" src="open-framework.png"></div>
<br/>

<a name="5" href="index.php#5">5)</a>
The project should now build and a blank window should appear.<br/>
<br/>
If you want to load files like images (as you will in the next tutorial), you need to add them to your project. As an example, go download the
<a href="../../../02_getting_an_image_on_the_screen/02_getting_an_image_on_the_screen.zip">source for the next tutorial</a>. Remove the source from the current tutorial, and replace it with the source from the next tutorial. 
Don't forget to edit the include for the header.<br/>
<br/>
If you build and run the application now, it will build and run but return a non-zero because it cannot find the files for tutorial. To add the files to the app, copy the 02_getting_an_image_on_the_screen folder from the zip and
place it alongside the xcodeproj file with the SDL2.framework folder. In your project, right click to add files to your project and select the 02_getting_an_image_on_the_screen folder making sure that Create Folder References is
selected. Adding it as a folder reference essentially makes that folder part of the app's directory structure:
<div class="text-center"><img class="img-fluid" alt="open SDL2 framework" src="folder-reference.png"></div>
<br/>
Build and run and the image should show up. We'll cover how to load images in the next tutorial but for now let's cover how to create windows.

</div>
                    
                
                    
                        <div class="container border py-3 my-3">




<a href="../../index2.php">Hello SDL Part 2: Your First Graphics Window</a>




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
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../../../assets/external-link.svg"></a>
	<a href="../../../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../../../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>