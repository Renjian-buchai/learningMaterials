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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac Android iOS iPhone iPad iPod multi touch">
<meta name="description" content="Learn how to handle multi touch gestures on Android/iOS with SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Multi Touch</title>

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
    <h1 class="text-center">Multi Touch</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Multi Touch screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 10th, 2024</b></p>
    
        In this tutorial we'll be using SDL 2's built in functionality to handle multi touch gestures like pinch and rotate.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Scene textures
LTexture gPinchCloseTexture;
LTexture gPinchOpenTexture;
LTexture gRotateTexture;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Like in the previous tutorial, we'll be using a set of textures to show which type of input is happening.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Main loop flag
            bool quit = false;

            //Event handler
            SDL_Event e;

            //Touch variables
            SDL_Point touchLocation = { gScreenRect.w / 2, gScreenRect.h / 2 };
            LTexture* currentTexture = &gPinchOpenTexture;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Also like the previous tutorial, we'll need to keep track of the touch location and the current texture to render.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                    //Multi touch gesture
                    else if( e.type == SDL_MULTIGESTURE )
                    {
                        //Rotation detected
                        if( fabs( e.mgesture.dTheta ) > 3.14 / 180.0 )
                        {
                            touchLocation.x = e.mgesture.x * gScreenRect.w;
                            touchLocation.y = e.mgesture.y * gScreenRect.h;
                            currentTexture = &gRotateTexture;
                        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When a multi touch gesture happens a <a href="https://wiki.libsdl.org/SDL_MultiGestureEvent">SDL_MultiGestureEvent</a> gets generated. Here we check for rotations first by checking the angle on the gesture. The thing to
remember is that the smallest rotation will get reported so if you pinch and rotate by a 1000th of a radian, it will show up in the gesture. Here we make sure the rotation is at least one degree before reporting it as a
rotation.<br/>
<br/>
If the rotation is big enough, we set the location of the gesture and set the texture.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                        //Pinch detected
                        else if( fabs( e.mgesture.dDist ) > 0.002 )
                        {
                            touchLocation.x = e.mgesture.x * gScreenRect.w;
                            touchLocation.y = e.mgesture.y * gScreenRect.h;
                            
                            //Pinch open
                            if( e.mgesture.dDist > 0 )
                            {
                                currentTexture = &gPinchOpenTexture;
                            }
                            //Pinch close
                            else
                            {
                                currentTexture = &gPinchCloseTexture;
                            }
                        }
                    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">If the rotation wasn't big enough, we then check the distance of the pinch. Again remember that coordinates are normalized so a 10 pixel pinch on a 1920 resolution tablet will be reported at around 0.0052.<br/>
<br/>
If the pinch is big enough, we set the gesture position and then check if the pinch was opening or closing.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render touch texture
                currentTexture->render( touchLocation.x - currentTexture->getWidth() / 2, touchLocation.y - currentTexture->getHeight() / 2 );

                //Update screen
                SDL_RenderPresent( gRenderer );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Once again like the previous tutorial, in the rendering we show the current gesture texture and the gesture position.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="55_multitouch.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Multi Touch">Back to Index</a>


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