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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac SDL Events">
<meta name="description" content="Handle events with SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Event Driven Programming</title>

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
    <h1 class="text-center">Event Driven Programming</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Event Driven Programming screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 7th, 2024</b></p>
    
        Besides just putting images on the screen, games require that you handle input from the user. You can do that with SDL using the event handling system.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">            //Main loop flag
            bool quit = false;

            //Event handler
            SDL_Event e;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our code after SDL is initialized and the media is loaded (as mentioned in the <a href="../02_getting_an_image_on_the_screen/index.php">previous tutorial</a>), we declare a quit flag that keeps track of whether the user
has quit or not. Since we just started the application at this point, it is obviously initialized to false.<br/>
<br/>
We also declare an <a href="http://wiki.libsdl.org/SDL_Event?highlight=%28%5CbCategoryStruct%5Cb%29%7C%28CategoryEvents%29">SDL_Event</a> union. A SDL event is some thing like a 
<a href="http://wiki.libsdl.org/SDL_KeyboardEvent?highlight=%28\bCategoryStruct\b%29|%28CategoryEvents%29">key press</a>,
<a href="http://wiki.libsdl.org/SDL_MouseMotionEvent?highlight=%28\bCategoryStruct\b%29|%28CategoryEvents%29">mouse motion</a>,
<a href="http://wiki.libsdl.org/SDL_JoyButtonEvent?highlight=%28\bCategoryStruct\b%29|%28CategoryEvents%29">joy button press</a>, etc. In this application we're going to look for quit events to end the application.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //While application is running
            while( !quit )
            {
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the previous tutorials, we had the program wait for a few seconds before closing. In this application we're having the application wait until the user quits before closing.<br/>
<br/>
So we'll have the application loop while the user has not quit. This loop that keeps running while the application is active is called the main loop, which is sometimes called the game loop. It is the core of any game
application.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Handle events on queue
                while( SDL_PollEvent( &e ) != 0 )
                {
                    //User requests quit
                    if( e.type == SDL_QUIT )
                    {
                        quit = true;
                    }
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of our main loop we have our event loop. What this does is keep processing the event queue until it is empty.<br/>
<br/>
When you press a key, move the mouse, or touch a touch screen you put events onto the event queue.<br/>
<div class="text-center"><img class="img-fluid" alt="enqueue" src="enqueue.png"></div>
<br/>
The event queue will then store them in the order the events occurred waiting for you to process them. When you want to find out what events occured so you can process them, you poll the event queue to get the most recent
event by calling <a href="http://wiki.libsdl.org/SDL_PollEvent?highlight=%28\bCategoryEvents\b%29|%28CategoryEnum%29|%28CategoryStruct%29">SDL_PollEvent</a>. What SDL_PollEvent does is take the most recent event from the
event queue and puts the data from the event into the SDL_Event we passed into the function.
<div class="text-center"><img class="img-fluid" alt="dequeue" src="dequeue.png"></div><br/>
<br/>
SDL_PollEvent will keep taking events off the queue until it is empty. When the queue is empty, SDL_PollEvent will return 0. So what this piece of code does is keep polling events off the event queue until it's empty. If an
event from the event queue is an SDL_QUIT event (which is the event when the user Xs out the window), we set the quit flag to true so we can exit the application.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Apply the image
                SDL_BlitSurface( gXOut, NULL, gScreenSurface, NULL );
            
                //Update the surface
                SDL_UpdateWindowSurface( gWindow );
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After we're done processing the events for our frame, we draw to the screen and update it (as discussed in the <a href="../02_getting_an_image_on_the_screen/index.php">previous tutorial</a>). If the quit flag was set to true,
the application will exit at the end of the loop. If it is still false it will keep going until the user Xs out the window.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="03_event_driven_programming.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Event Driven Programming">Back to Index</a>


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