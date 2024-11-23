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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac Mutexes Conditions">
<meta name="description" content="Synchronize threads with signaling in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Mutexes and Conditions</title>

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
    <h1 class="text-center">Mutexes and Conditions</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Mutexes and Conditions screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 10th, 2024</b></p>
    
        Not only can you lock <a href="../47_semaphores/index.php">critical sections</a> in threads, but with mutexes and conditions it is possible for threads to tell each other when to unlock.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Our worker functions
int producer( void* data );
int consumer( void* data );
void produce();
void consume();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this demo we'll have two threads: a producer which fills a buffer and a consumer that empties a buffer. Not only can the two threads not use the same buffer at the same time, but a consumer can't read from an empty buffer
and a producer can't fill a buffer that's already full.<br/>
<br/>
We'll use a mutex (<b>mut</b>ually <b>ex</b>clusive) to prevent the two threads from grabbing the same piece of data and conditions to let the threads know when they can consume and can produce.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//The protective mutex
SDL_mutex* gBufferLock = NULL;

//The conditions
SDL_cond* gCanProduce = NULL;
SDL_cond* gCanConsume = NULL;

//The "data buffer"
int gData = -1;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we're globally declaring the mutex and conditions that will be used by the threads.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool loadMedia()
{
    //Create the mutex
    gBufferLock = SDL_CreateMutex();
            
    //Create conditions
    gCanProduce = SDL_CreateCond();
    gCanConsume = SDL_CreateCond();

    //Loading success flag
    bool success = true;
    
    //Load splash texture
    if( !gSplashTexture.loadFromFile( "49_mutexes_and_conditions/splash.png" ) )
    {
        printf( "Failed to load splash texture!\n" );
        success = false;
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">To allocate mutexes and conditons we use <a href="http://wiki.libsdl.org/SDL_CreateMutex">SDL_CreateMutex</a> and <a href="http://wiki.libsdl.org/SDL_CreateCond">SDL_CreateCond</a> respectively.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void close()
{
    //Free loaded images
    gSplashTexture.free();

    //Destroy the mutex
    SDL_DestroyMutex( gBufferLock );
    gBufferLock = NULL;
            
    //Destroy conditions
    SDL_DestroyCond( gCanProduce );
    SDL_DestroyCond( gCanConsume );
    gCanProduce = NULL;
    gCanConsume = NULL;

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


    <div class="container border-start border-end border-bottom py-3 mb-3">And to deallocate mutexes and conditions we use <a href="http://wiki.libsdl.org/SDL_DestroyMutex">SDL_DestroyMutex</a> and <a href="http://wiki.libsdl.org/SDL_DestroyCond">SDL_DestroyCond</a>.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">int producer( void *data )
{
    printf( "\nProducer started...\n" );

    //Seed thread random
    srand( SDL_GetTicks() );
    
    //Produce
    for( int i = 0; i < 5; ++i )
    {
        //Wait
        SDL_Delay( rand() % 1000 );
        
        //Produce
        produce();
    }

    printf( "\nProducer finished!\n" );
    
    return 0;

}

int consumer( void *data )
{
    printf( "\nConsumer started...\n" );

    //Seed thread random
    srand( SDL_GetTicks() );

    for( int i = 0; i < 5; ++i )
    {
        //Wait
        SDL_Delay( rand() % 1000 );
        
        //Consume
        consume();
    }
    
    printf( "\nConsumer finished!\n" );

    return 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">So here are our two worker threads. The producer tries to produce 5 times and the consumer tries to consume 5 times.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void produce()
{
    //Lock
    SDL_LockMutex( gBufferLock );
    
    //If the buffer is full
    if( gData != -1 )
    {
        //Wait for buffer to be cleared
        printf( "\nProducer encountered full buffer, waiting for consumer to empty buffer...\n" );
        SDL_CondWait( gCanProduce, gBufferLock );
    }

    //Fill and show buffer
    gData = rand() % 255;
    printf( "\nProduced %d\n", gData );
    
    //Unlock
    SDL_UnlockMutex( gBufferLock );
    
    //Signal consumer
    SDL_CondSignal( gCanConsume );
}

void consume()
{
    //Lock
    SDL_LockMutex( gBufferLock );
    
    //If the buffer is empty
    if( gData == -1 )
    {
        //Wait for buffer to be filled
        printf( "\nConsumer encountered empty buffer, waiting for producer to fill buffer...\n" );
        SDL_CondWait( gCanConsume, gBufferLock );
    }

    //Show and empty buffer
    printf( "\nConsumed %d\n", gData );
    gData = -1;
    
    //Unlock
    SDL_UnlockMutex( gBufferLock );
    
    //Signal producer
    SDL_CondSignal( gCanProduce );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here are the functions that produce and consume. Producing a buffer means generating a random number and consuming a buffer means reseting the generated number. The best way to show  how this works is go through an
example.<br/>
<br/>
Let's say the producer fires first and locks the mutex with <a href="http://wiki.libsdl.org/SDL_LockMutex">SDL_LockMutex</a> much like it would a semaphore with a value of one:
<div class="text-center"><img class="img-fluid" alt="thread run step 1" src="run_01.png"></div>
<br/>
The buffer is empty so it goes through and produces:
<div class="text-center"><img class="img-fluid" alt="thread run step 2" src="run_02.png"></div>
<br/>
It then exits the function to unlock the critical section with <a href="http://wiki.libsdl.org/SDL_UnlockMutex">SDL_UnlockMutex</a> so the consumer can consume:
<div class="text-center"><img class="img-fluid" alt="thread run step 3" src="run_03.png"></div>
<br/>
Ideally, we would want the consumer to consume, but imagine if the producer fired again:
<div class="text-center"><img class="img-fluid" alt="thread run step 4" src="run_01.png"></div>
<br/>
And after the producer locked the critical section the consumer tries to get it but the critical section is already locked to the producer:
<div class="text-center"><img class="img-fluid" alt="thread run step 5" src="run_05.png"></div>
With just a binary semaphore, this would be a problem because the producer can't produce into a full buffer and the consumer is locked behind a mutex. However, mutexes have the ability to be used with conditions.<br/>
<br/>
What the condition allows us to do is if the buffer is already full, we can wait on a condition with <a href="http://wiki.libsdl.org/SDL_CondWait">SDL_CondWait</a> and unlock the mutex for other threads:
<div class="text-center"><img class="img-fluid" alt="thread run step 6" src="run_06.png"></div>
<br/>
Now that the consumer is unlocked it can go through and consume:
<div class="text-center"><img class="img-fluid" alt="thread run step 7" src="run_07.png"></div>
<br/>
And once it's done it signals the producer with <a href="http://wiki.libsdl.org/SDL_CondSignal">SDL_CondSignal</a> to produce again:
<div class="text-center"><img class="img-fluid" alt="thread run step 8" src="run_08.png"></div>
<br/>
And then it can continue through:
<div class="text-center"><img class="img-fluid" alt="thread run step 9" src="run_09.png"></div>
<br/>
With the critical section protected by a mutex and the ability of the threads to talk to each other, the worker threads will work even though we do not know in which order they will execute.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="49_mutexes_and_conditions.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Mutexes and Conditions">Back to Index</a>


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