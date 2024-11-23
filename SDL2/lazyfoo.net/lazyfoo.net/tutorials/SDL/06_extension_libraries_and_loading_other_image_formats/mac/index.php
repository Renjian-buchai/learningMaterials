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
<meta name="keywords" content="SDL_image SDL_ttf SDL_mixer SDL2_image SDL2_ttf SDL2_mixer C++ Tutorial 2D Mac OS X setup">
<meta name="description" content="Install SDL_image (or SDL_ttf/SDL_mixer) on Mac OS X.">

<link href="../../../../assets/style.css" rel="stylesheet">
<script src="../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL Extension Libraries on Mac OS X Sonoma</title>

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
    <h1 class="text-center">Setting up SDL Extension Libraries on Mac OS X Sonoma</h1>
    
    <p class="text-center"><b>Last Updated: Jan 7th, 2024</b></p>
    
        Whether you're setting up SDL_image, SDL_ttf, or SDL_mixer, setting up an SDL extension library isn't all that different from setting up SDL itself. If you can set one of them up, you can set any of them up.

    
    
</div>
                    
                
                    
                        <table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="2" class="text-center">Select Your Compiler/IDE</th>
        </tr>
    </thead>
    <tbody>
        
            <tr>
                <td class="text-end">
                    <a href="xcode/index.php" name="Setting up SDL 2 on XCode 15.1"><img alt="Setting up SDL 2 on XCode 15.1" src="xcode/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="xcode/index.php" name="Setting up SDL 2 on XCode 15.1">Setting up SDL 2 on XCode 15.1</a>
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