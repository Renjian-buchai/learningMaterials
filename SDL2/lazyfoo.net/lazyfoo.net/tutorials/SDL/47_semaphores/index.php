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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac semaphores thread safety">
<meta name="description" content="Lock data between threads in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Semaphores</title>

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
    <h1 class="text-center">Semaphores</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Semaphores screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 10th, 2024</b></p>
    
        The only <a href="../46_multithreading/index.php">multithreading</a> we've done had the main thread and a second thread each do their own thing. In most cases two threads will have to share data and with semaphores you can
prevent two threads from accidentally accessing the same piece of data at once.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Our worker thread function
int worker( void* data );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our worker thread function. We will spawn two threads that will each execute their copy of this code.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Data access semaphore
SDL_sem* gDataLock = NULL;

//The "data buffer"
int gData = -1;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The object gDataLock is our semaphore which will lock our gData buffer. A single integer is not much of a data buffer to protect, but since there are going to be two threads that are going to be reading and writing to it we
need to make sure it is only being accessed by one thread at a time.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool loadMedia()
{
    //Initialize semaphore
    gDataLock = SDL_CreateSemaphore( 1 );

    //Loading success flag
    bool success = true;
    
    //Load splash texture
    if( !gSplashTexture.loadFromFile( "47_semaphores/splash.png" ) )
    {
        printf( "Failed to load splash texture!\n" );
        success = false;
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">To create a semaphore we call <a href="http://wiki.libsdl.org/SDL_CreateSemaphore">SDL_CreateSemaphore</a> with an initial value for the semaphore. The initial value controls how many times code can pass through a semaphore
before it locks.<br/>
<br/>
For example, say you only want 4 threads to run at a time because you're on hardware with 4 cores. You'd give the semaphore a value of 4 to start with to make sure no more than 4 threads run at the same time. In this demo we
only want 1 thread accessing the data buffer at once so the mutex starts with a value of one.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void close()
{
    //Free loaded images
    gSplashTexture.free();

    //Free semaphore
    SDL_DestroySemaphore( gDataLock );
    gDataLock = NULL;

    //Destroy window    
    SDL_DestroyRenderer( gRenderer );
    SDL_DestroyWindow( gWindow );
    gWindow = NULL;
    gRenderer = NULL;

    //Quit SDL subsystems
    IMG_Quit();
    SDL_Quit();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When we're done with a semaphore we call <a href="http://wiki.libsdl.org/SDL_DestroySemaphore">SDL_DestroySemaphore</a>.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">int worker( void* data )
{
    printf( "%s starting...\n", data );

    //Pre thread random seeding
    srand( SDL_GetTicks() );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we are starting our worker thread. An important thing to know is that seeding your random value is done per thread, so make sure you seed your random values for each thread you run.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Work 5 times
    for( int i = 0; i < 5; ++i )
    {
        //Wait randomly
        SDL_Delay( 16 + rand() % 32 );
        
        //Lock
        SDL_SemWait( gDataLock );

        //Print pre work data
        printf( "%s gets %d\n", data, gData );

        //"Work"
        gData = rand() % 256;

        //Print post work data
        printf( "%s sets %d\n\n", data, gData );
        
        //Unlock
        SDL_SemPost( gDataLock );

        //Wait randomly
        SDL_Delay( 16 + rand() % 640 );
    }

    printf( "%s finished!\n\n", data );

    return 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">What each worker thread does is delay for a semi random amount, print the data that is there when it started working, assign a random number to it, print the number assigned to the data buffer, and delay for a bit more before
working again. The reason we need to lock data is because we do not want two threads reading or writing our shared data at the same time.<br/>
<br/>
Notice the calls to <a href="http://wiki.libsdl.org/SDL_SemWait">SDL_SemWait</a> and <a href="http://wiki.libsdl.org/SDL_SemPost">SDL_SemPost</a>. What's in between them is the critical section or the code we only want one
thread to access at once. SDL_SemWait decrements the semaphore count and since the initial value is one, it will lock. After the critical section executes, we call SDL_SemPost to increment the semaphore and unlock it.<br/>
<br/>
If we have a situation where thread A locks and then thread B tries to lock, thread B will wait until thread A finishes the critical section and unlocks the semaphore. With the critical section protected by a semaphore
lock/unlock pair, only one thread can execute the critical section at once. 
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Main loop flag
            bool quit = false;

            //Event handler
            SDL_Event e;

            //Run the threads
            srand( SDL_GetTicks() );
            SDL_Thread* threadA = SDL_CreateThread( worker, "Thread A", (void*)"Thread A" );
            SDL_Delay( 16 + rand() % 32 );
            SDL_Thread* threadB = SDL_CreateThread( worker, "Thread B", (void*)"Thread B" );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the main function before we enter the main loop we launch two worker threads with a bit of random delay in between them. There's no guarantee thread A or B will work first but since the data they share is protected, we know
they won't try to execute the same piece of code at once.
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

                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render splash
                gSplashTexture.render( 0, 0 );

                //Update screen
                SDL_RenderPresent( gRenderer );
            }

            //Wait for threads to finish
            SDL_WaitThread( threadA, NULL );
            SDL_WaitThread( threadB, NULL );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here the main thread runs while the threads to their work. If the main loop ends before the threads finish working, we wait on them to finish with SDL_WaitThread.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="47_semaphores.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Semaphores">Back to Index</a>


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