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
<meta name="keywords" content="SDL 2 SDL_image SDL_ttf SDL_mixer C++ Tutorial 2D Windows Linux Mac Android iPhone iPad iPod Touch">
<meta name="description" content="Use SDL_image/SDL_ttf/SDL_mixer and handle orientation on Android/iOS.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Extensions and Changing Orientation</title>

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
    <h1 class="text-center">Extensions and Changing Orientation</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Extensions and Changing Orientation screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 10th, 2024</b></p>
    
        So you learned how to set up the SDL2 library and you want to add SDL extension libraries. Fortunately, SDL_image/SDL_ttf/SDL_mixer are just another library you have to add on and if you already set up SDL2, you
made it through the hard part.<br/>
<br/>
After we set up SDL_image, we'll cover <a href="index2.php">handling orientation change on Android/iOS</a>.

    
    
</div>
                    
                
                    
                        <table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="2" class="text-center">Select Your Mobile Platform</th>
        </tr>
    </thead>
    <tbody>
        
            <tr>
                <td class="text-end">
                    <a href="android_windows/index.php" name="Setting up SDL_image on Windows Android Studio 3.0.1"><img alt="Setting up SDL_image on Windows Android Studio 3.0.1" src="android_windows/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="android_windows/index.php" name="Setting up SDL_image on Windows Android Studio 3.0.1">Setting up SDL_image on Windows Android Studio 3.0.1</a>
                </td>
            </tr>
        
            <tr>
                <td class="text-end">
                    <a href="android_linux/index.php" name="Setting up SDL_image on Linux Android Studio 3.0.1"><img alt="Setting up SDL_image on Linux Android Studio 3.0.1" src="android_linux/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="android_linux/index.php" name="Setting up SDL_image on Linux Android Studio 3.0.1">Setting up SDL_image on Linux Android Studio 3.0.1</a>
                </td>
            </tr>
        
            <tr>
                <td class="text-end">
                    <a href="android_mac/index.php" name="Setting up SDL_image on Mac Android Studio 3.0.1"><img alt="Setting up SDL_image on Mac Android Studio 3.0.1" src="android_mac/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="android_mac/index.php" name="Setting up SDL_image on Mac Android Studio 3.0.1">Setting up SDL_image on Mac Android Studio 3.0.1</a>
                </td>
            </tr>
        
            <tr>
                <td class="text-end">
                    <a href="ios_mac/index.php" name="Setting up SDL_image on iOS with XCode 14.1"><img alt="Setting up SDL_image on iOS with XCode 14.1" src="ios_mac/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="ios_mac/index.php" name="Setting up SDL_image on iOS with XCode 14.1">Setting up SDL_image on iOS with XCode 14.1</a>
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