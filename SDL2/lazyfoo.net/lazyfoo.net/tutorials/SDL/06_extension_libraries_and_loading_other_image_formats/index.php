<!-- Get tutorial set -->


<!-- Tutorial root -->



    <!-- Desktop tutorial set -->
    
        
    

                    

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
<meta name="keywords" content="SDL2 SDL_image SDL_ttf SDL_mixer SDL2_image SDL2_ttf SDL2_mixer set up tutorial Windows Linux Mac">
<meta name="description" content="Use SDL extension libraries like SDL_image, SDL_ttf, and SDL_mixer to add functionality to SDL.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Extension Libraries and Loading Other Image Formats</title>

<script src="../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
	<a href="../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../donate.php" class="nav-item nav-link">Donations</a>
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
    <h1 class="text-center">Extension Libraries and Loading Other Image Formats</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Extension Libraries and Loading Other Image Formats screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 7th, 2024</b></p>
    
        SDL extension libraries allow you do things like load image files besides BMP, render TTF fonts, and play music. You can set up SDL_image to load PNG files, which can save you a lot of disk space. In this tutorial we'll be
covering how to install SDL_image.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    SDL itself is an extension library since it adds game and media functionality that doesn't come standard with your C++ compiler. As you're setting up your extension library, you'll realize it's nearly identical to installing
SDL by itself. We'll be specifically installing SDL_image, but if you can install that extension library you should be able to install any of them.<br/>
<br/>
After you set up SDL_image, we'll cover <a href="index2.php">how to load a PNG with SDL</a>.

</div>
                    
                
                    
                        <table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="2" class="text-center">Select Your Operating System</th>
        </tr>
    </thead>
    <tbody>
        
            <tr>
                <td class="text-end">
                    <a href="windows/index.php" name="Setting up SDL Extension Libraries on Windows"><img alt="Setting up SDL Extension Libraries on Windows" src="windows/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="windows/index.php" name="Setting up SDL Extension Libraries on Windows">Setting up SDL Extension Libraries on Windows</a>
                </td>
            </tr>
        
            <tr>
                <td class="text-end">
                    <a href="linux/index.php" name="Setting up SDL Extension Libraries on Linux"><img alt="Setting up SDL Extension Libraries on Linux" src="linux/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="linux/index.php" name="Setting up SDL Extension Libraries on Linux">Setting up SDL Extension Libraries on Linux</a>
                </td>
            </tr>
        
            <tr>
                <td class="text-end">
                    <a href="mac/index.php" name="Setting up SDL Extension Libraries on Mac OS X Sonoma"><img alt="Setting up SDL Extension Libraries on Mac OS X Sonoma" src="mac/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="mac/index.php" name="Setting up SDL Extension Libraries on Mac OS X Sonoma">Setting up SDL Extension Libraries on Mac OS X Sonoma</a>
                </td>
            </tr>
        
    </tbody>
 </table>
                    
                
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
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
	<a href="../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>