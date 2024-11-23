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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac key state">
<meta name="description" content="Query current key state with SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Key States</title>

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
    <h1 class="text-center">Key States</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Key States screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jun 11th, 2019</b></p>
    
        As we saw in the <a href="../17_mouse_events/index.php">mouse input tutorial</a>, there are ways to get the state of the input devices (mouse, keyboard, etc) other than using events. In this tutorial, we'll be remaking the
<a href="../04_key_presses/index.php">keyboard input tutorial</a> using key states instead of events.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">            //Main loop flag
            bool quit = false;

            //Event handler
            SDL_Event e;

            //Current rendered texture
            LTexture* currentTexture = NULL;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Right before we enter the main loop, we declare a texture pointer to keep track of which texture we're rendering to the screen.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //While application is running
            while( !quit )
            {
                //Handle events on queue
                while( SDL_PollEvent( &e ) != 0 )
                {
                    //User requests quit
                    if( e.type == SDL_QUIT )
                    {
                        quit = true;
                    }
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As you can see, we aren't checking for key events in the event loop. All our keyboard input is going to be handled with key states.<br/>
<br/>
One important thing to know about how SDL handles key states is that you still need an event loop running. SDL's internal keystates are updated every time  <a href="http://wiki.libsdl.org/SDL_PollEvent">SDL_PollEvent</a> is
called, so make sure you polled all events on queue before checking key states.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Set texture based on current keystate
                const Uint8* currentKeyStates = SDL_GetKeyboardState( NULL );
                if( currentKeyStates[ SDL_SCANCODE_UP ] )
                {
                    currentTexture = &gUpTexture;
                }
                else if( currentKeyStates[ SDL_SCANCODE_DOWN ] )
                {
                    currentTexture = &gDownTexture;
                }
                else if( currentKeyStates[ SDL_SCANCODE_LEFT ] )
                {
                    currentTexture = &gLeftTexture;
                }
                else if( currentKeyStates[ SDL_SCANCODE_RIGHT ] )
                {
                    currentTexture = &gRightTexture;
                }
                else
                {
                    currentTexture = &gPressTexture;
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we set our texture that's going to be rendered. First we get a pointer to the array of key states using <a href="http://wiki.libsdl.org/SDL_GetKeyboardState">SDL_GetKeyboardState</a>. The state of all the keys are ordered
by <a href="http://wiki.libsdl.org/SDL_Scancode">SDL_Scancode</a>. Scan codes are like the <a href="http://wiki.libsdl.org/SDL_Keycode">SDL_Keycode</a> values, only scan codes are designed to work with international keyboards.
Depending on the keyboard layout, different letters might be in different places. Scan codes go off default physical position of the keys as opposed to where they might be on a specific keyboard.<br/>
<br/>
All you have to do to check if a key is down is to check its state in the key state array. As you can see in the above code, if the key is down we set the current texture to the corresponding texture. If none of the keys are
down, we set the default texture.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render current texture
                currentTexture->render( 0, 0 );

                //Update screen
                SDL_RenderPresent( gRenderer );
            }
        }
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally here we render the current texture to the screen.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="18_key_states.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Key States">Back to Index</a>


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