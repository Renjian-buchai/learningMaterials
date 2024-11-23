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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac Android iOS iPhone iPad iPod touch">
<meta name="description" content="Learn how to handle touch input from an Android/iOS device in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Touches</title>

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
    <h1 class="text-center">Touches</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Touches screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 10th, 2024</b></p>
    
        Now that we know how to load images on mobile, it's time to handle touch input events.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Scene textures
LTexture gTouchDownTexture;
LTexture gTouchMotionTexture;
LTexture gTouchUpTexture;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this demo we'll have a set of textures we'll be using to indicate what type of touch event happens.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Main loop flag
            bool quit = false;

            //Event handler
            SDL_Event e;

            //Touch variables
            SDL_Point touchLocation = { gScreenRect.w / 2, gScreenRect.h / 2 };
            LTexture* currentTexture = &gTouchUpTexture;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">We'll need to keep track of the touch location and the current touch texture. Here we're setting the default touch location as the center of the screen and the default touch texture to the touch up texture.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                    //Touch down
                    else if( e.type == SDL_FINGERDOWN )
                    {
                        touchLocation.x = e.tfinger.x * gScreenRect.w;
                        touchLocation.y = e.tfinger.y * gScreenRect.h;
                        currentTexture = &gTouchDownTexture;
                    }
                    //Touch motion
                    else if( e.type == SDL_FINGERMOTION )
                    {
                        touchLocation.x = e.tfinger.x * gScreenRect.w;
                        touchLocation.y = e.tfinger.y * gScreenRect.h;
                        currentTexture = &gTouchMotionTexture;
                    }
                    //Touch release
                    else if( e.type == SDL_FINGERUP )
                    {
                        touchLocation.x = e.tfinger.x * gScreenRect.w;
                        touchLocation.y = e.tfinger.y * gScreenRect.h;
                        currentTexture = &gTouchUpTexture;
                    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When you interact with a touch display, you generate a <a href="https://wiki.libsdl.org/SDL_TouchFingerEvent">SDL_TouchFingerEvent</a>. When the touch starts you get a SDL_FINGERDOWN event, when you move around
your finger a SDL_FINGERMOTION happens, and when you release your touch you get a SDL_FINGERUP.<br/>
<br/>
Touch events function pretty much like mouse events with one major difference: touch coordinates are normalized. This means instead of going from 0 to 640 (or what ever the size of your mobile display), they always go from 0 to
1. To get the touch coordinates in screen coordinates simply multiply the touch coordinates by the screen resolution. If you look at the code above that's exactly what we're doing here, along with setting the corresponding
texture for the given touch event.<br/>
<br/>
One thing not covered here is handling multiple fingers. All we do here is handle the most recent touch event. If you want to handle more than one finger, just keep track of them with their finger IDs. The finger IDs aren't
simple 0, 1, 2, etc but a 64bit integer version of the pointer to the touch data. This quirk has tripped people over before so keep it in mind.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render touch texture
                currentTexture->render( touchLocation.x - currentTexture->getWidth() / 2, touchLocation.y - currentTexture->getHeight() / 2 );

                //Update screen
                SDL_RenderPresent( gRenderer );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As you can see in our rendering, we just render the touch texture at the touch position.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="54_touches.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Touches">Back to Index</a>


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