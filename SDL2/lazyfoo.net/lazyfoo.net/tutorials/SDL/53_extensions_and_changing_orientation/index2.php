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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac Android iOS iPhone iPad ipod Touch orientation">
<meta name="description" content="Handle orientation changes on Android/iOS with SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Extensions and Changing Orientation - Handling Orientation Changes</title>

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
    <h1 class="text-center">Extensions and Changing Orientation - Handling Orientation Changes</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Extensions and Changing Orientation - Handling Orientation Changes screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 10th, 2024</b></p>
    
        Now that we got SDL_image loading PNGs, it's time to handle when our mobile device rotates.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Screen dimensions
SDL_Rect gScreenRect = { 0, 0, 320, 240 };

//Scene textures
LTexture gPortraitTexture;
LTexture gLandscapeTexture;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this application we'll be having a different textures render depending on whether the device is in portrait or landscape mode.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Create window
        gWindow = SDL_CreateWindow( "SDL Tutorial", SDL_WINDOWPOS_UNDEFINED, SDL_WINDOWPOS_UNDEFINED, gScreenRect.w, gScreenRect.h, SDL_WINDOW_SHOWN | SDL_WINDOW_RESIZABLE );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When you rotate your device, the height/width of the window changes which means the window size changes. In order to support rotation, the window needs to be created as resizable.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Handle events on queue
                while( SDL_PollEvent( &e ) != 0 )
                {
                    //User requests quit
                    if( e.type == SDL_QUIT )
                    {
                        quit = true;
                    }
                    //Window event
                    else if( e.type == SDL_WINDOWEVENT )
                    {
                        //Window resize/orientation change
                        if( e.window.event == SDL_WINDOWEVENT_SIZE_CHANGED )
                        {
                            //Get screen dimensions
                            gScreenRect.w = e.window.data1;
                            gScreenRect.h = e.window.data2;
                            
                            //Update screen
                            SDL_RenderPresent( gRenderer );
                        }
                    }
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">SDL 2 turns orientation change events into window change events. We check for window events and if the window event is a size change, we get the new dimensions, and update the screen.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render splash
                if( gScreenRect.h >= gScreenRect.w )
                {
                    gPortraitTexture.render( ( gScreenRect.w - gPortraitTexture.getWidth() ) / 2, ( gScreenRect.h - gPortraitTexture.getHeight() ) / 2 );    
                }
                else
                {
                    gLandscapeTexture.render( ( gScreenRect.w - gLandscapeTexture.getWidth() ) / 2, ( gScreenRect.h - gLandscapeTexture.getHeight() ) / 2 );    
                }

                //Update screen
                SDL_RenderPresent( gRenderer );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">How do we tell if the device is in portrait or landscape? Simple: if the height is greater width, it's in portrait. Otherwise, it's in landscape.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="53_extensions_and_changing_orientation.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Extensions and Changing Orientation">Back to Index</a>


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