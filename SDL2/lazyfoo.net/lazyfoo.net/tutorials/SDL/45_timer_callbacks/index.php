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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac timer callbacks">
<meta name="description" content="Run timer callbacks in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Timer Callbacks</title>

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
    <h1 class="text-center">Timer Callbacks</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Timer Callbacks screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 10th, 2024</b></p>
    
        We've covered <a href="../23_advanced_timers/index.php">timers with SDL before</a>, but there are also timer callbacks which execute a function after a given amount of time. In this tutorial we'll make a simple program that
prints to the console after a set time.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Our test callback function
Uint32 callback( Uint32 interval, void* param );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When creating a call back function, know that they have to be declared a certain way. You can't just create any type of function and use it as a callback.<br/>
<br/>
The call back function needs to have a 32 bit integer as its first argument, a void pointer as its second argument, and it has to return a 32 bit integer.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">Uint32 callback( Uint32 interval, void* param )
{
    //Print callback message
    printf( "Callback called back with message: %s\n", reinterpret_cast&#060char*&#062(param) );

    return 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our simple call back function which prints a message to the console after a given amount of time. The interval argument isn't used here but is typically used for timer call backs that need to repeat themselves.<br/>
<br/>
Since void pointers can point to anything, this function is going to take in a string and print it to the console.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Initialize SDL
    if (SDL_Init( SDL_INIT_VIDEO | SDL_INIT_TIMER ) < 0 )
    {
        printf( "SDL could not initialize! SDL Error: %s\n", SDL_GetError() );
        success = false;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Do make sure to initialize with SDL_INIT_TIMER to use timer callbacks.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Set callback
            SDL_TimerID timerID = SDL_AddTimer( 3 * 1000, callback, reinterpret_cast<void*>( "3 seconds waited!" ) );

            //While application is running
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

                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render splash
                gSplashTexture.render( 0, 0 );

                //Update screen
                SDL_RenderPresent( gRenderer );
            }

            //Remove timer in case the call back was not called
            SDL_RemoveTimer( timerID );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">We kick off our timer callback using <a href="http://wiki.libsdl.org/SDL_AddTimer">SDL_AddTimer</a>. The first argument is how long the callback will take which in this case is set to 3000 milliseconds or 3 seconds. The second
argument is the callback function and the last argument is the void data pointer we're sending it.<br/>
<br/>
This application will kick off the call back and then run the main loop. While the main loop is running the callback may spit out the message to the console. In case the callback doesn't happen before the main loop ends, we
remove the callback timer using <a href="http://wiki.libsdl.org/SDL_RemoveTimer">SDL_RemoveTimer</a>. Careful, the timer call back is asynchronous which means it can happen while we're doing something else. Don't have your
call back mess with data while your main thread is messing with that same piece of data.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="45_timer_callbacks.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Timer Callbacks">Back to Index</a>


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