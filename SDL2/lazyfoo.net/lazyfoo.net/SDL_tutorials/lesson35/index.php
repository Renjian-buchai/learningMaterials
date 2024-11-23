<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" 
"http://www.w3.org/TR/REC-html40/strict.dtd">
<html>

<head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VP5RSQ168Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VP5RSQ168Y');
</script>



<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">

<META NAME=KEYWORDS CONTENT="Lazy Foo' Productions C++ SDL Window Linux Mac Game Programming Tutorials">

<META NAME=DESCRIPTION CONTENT="Tutorials for those who want to start making video games.">

<title>Lazy Foo' Productions</title>

<link REL="stylesheet" TYPE="text/css" href="../lazy.css">
</head>

<body>

<div class="header">
<h1 style="margin-bottom:0px;padding-bottom:0px;border-bottom:0px;">Lazy Foo' Productions</h1>

<div class="nav">
Yes, I am keeping the old tutorial set in the old layout for the sake of having a nostalgic eater egg. It's not because I am too lazy to port this over to the data driven static site generator.<br/>
<br/>
<a class="nav" href="https://discourse.libsdl.org/">SDL Forums</a>
<a class="nav" href="../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../articles/index.php">Articles</a>
<a class="nav" href="../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../index.php">News</a>
<a class="nav" href="../../faq.php">FAQs</a>
<a class="nav" href="../../contact.php">Contact</a>
<a class="nav" href="../../donate.php">Donations</a><br/>
<br/>

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

</div>

</div>

<div class="content">
<div class="tutPreface"><h1 class="tutHead">Mutexes and Conditions</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/28/10</h6>
Here we're going to do some more advanced thread synchronization using mutexes and conditions.<br/>
<br/>
<a class="tutLink" href="../../tutorials/SDL/49_mutexes_and_conditions/index.php">Mutexes and Conditions tutorial with SDL 2</a> is now available.
</div>

<div class="tutText">
In case you missed the semaphores tutorial let me say this once again:<br>
In this tutorial we have video functions running in separate threads.
You should never do this in a real application.
It's just bad software design and in some cases can cause your OS to become unstable.
The only reason we're doing it here is because it's a small program and nothing's going to go wrong.
We're doing it here just as a simple demonstration of mutexes/conditions in action.
Now on with the tutorial.<br>
<br>
In this tutorial we'll have a "producer" thread which will pick one of 5 surfaces and store it in a buffer, then
show the "generated" surface on the left side of the screen.<br>
<br>
Then we'll have a "consumer" thread which shows the surface in the buffer on the right side of the screen then
empties the buffer out.<br>
<br>
Here's the catch: unlike in the previous tutorial where there were 5 blits in order every 1/5 of a second,
in this program we're going to have the producer produce 5 times at random and the consumer consume 5 times at
random.<br>
<br>
In the last tutorial we used semaphores to prevent the two threads from trying to manipulate the screen at the same time.
Here we're going to use a mutex. A mutex is just a binary semaphore or one that will only let one thread pass through it at a time.
In fact the semaphores tutorial could be redone with mutexes instead.
All you'd have to do is swap the semaphore with a mutex and swap the lock/unlock functions.<br>
<br>
Because the threads are doing things at random and they're dependent on each other, using just a mutex isn't enough.
What if the consumer tries to consume and the buffer is empty?
Or producer tries to produce but the buffer is full?
This is where conditions come into play. 
</div>

<div class="tutCode">SDL_Surface *images[ 5 ] = { NULL, NULL, NULL, NULL, NULL };
SDL_Surface *buffer = NULL;
</div>

<div class="tutText">The buffer contains the surface "produced" by the producer. When the producer produces
a surface, it just points to one of 5 surfaces which are loaded at the beginning of the program.<br>
<br>
I just want to prevent any confusion on what the buffer is and what it holds.
</div>

<div class="tutCode">//The threads that will be used
SDL_Thread *producerThread = NULL;
SDL_Thread *consumerThread = NULL;

//The protective mutex
SDL_mutex *bufferLock = NULL;

//The conditions
SDL_cond *canProduce = NULL;
SDL_cond *canConsume = NULL;
</div>

<div class="tutText">
Here we have our threads along with our mutex.
The mutex will prevent the threads from manipulating the buffer and/or screen at the same time.<br>
<br>
Then we have the conditions which will tell when the producer can produce and the consumer can consume.
</div>

<div class="tutCode">bool init()
{
    //Initialize all SDL subsystems
    if( SDL_Init( SDL_INIT_EVERYTHING ) == -1 )
    {
        return false;    
    }
    
    //Set up the screen
    screen = SDL_SetVideoMode( SCREEN_WIDTH, SCREEN_HEIGHT, SCREEN_BPP, SDL_SWSURFACE );
    
    //If there was an error in setting up the screen
    if( screen == NULL )
    {
        return false;    
    }
    
    //Create the mutex
    bufferLock = SDL_CreateMutex();
    
    //Create Conditions
    canProduce = SDL_CreateCond();
    canConsume = SDL_CreateCond();
    
    //Set the window caption
    SDL_WM_SetCaption( "Producer / Consumer Test", NULL );
    
    //If everything initialized fine
    return true;
}
</div>

<div class="tutText">
Before we can use a mutex or condition we have to create them.
We do so by calling SDL_CreateMutex() and SDL_CreateCond() in our init() function.
</div>

<div class="tutCode">int producer( void *data )
{
    //The offset of the blit.
    int y = 10;
    
    //Seed random
    srand( SDL_GetTicks() );
    
    //Produce
    for( int p = 0; p < 5; p++ )
    {
        //Wait
        SDL_Delay( rand() % 1000 );
        
        //Produce
        produce( 10, y );
        
        //Move down
        y += 90;
    }
    
    return 0;
}

int consumer( void *data )
{
    //The offset of the blit.
    int y = 10;
    
    for( int p = 0; p < 5; p++ )
    {
        //Wait
        SDL_Delay( rand() % 1000 );
        
        //Consume
        consume( 330, y );
        
        //Move down
        y += 90;
    }
    
    return 0;
}
</div>

<div class="tutText">
Here we have our producer/consumer thread functions.
They produce/consume 5 times at random time intervals.
</div>

<div class="tutCode">void produce( int x, int y )
{
    //Lock
    SDL_mutexP( bufferLock );
    
    //If the buffer is full
    if( buffer != NULL )
    {
        //Wait for buffer to be cleared
        SDL_CondWait( canProduce, bufferLock );
    }
    
    //Fill and show buffer
    buffer = images[ rand() % 5 ];
    apply_surface( x, y, buffer, screen );
    
    //Update the screen
    SDL_Flip( screen );
    
    //Unlock
    SDL_mutexV( bufferLock );
    
    //Signal consumer
    SDL_CondSignal( canConsume );
}

void consume( int x, int y )
{
    //Lock
    SDL_mutexP( bufferLock );
    
    //If the buffer is empty
    if( buffer == NULL )
    {
        //Wait for buffer to be filled
        SDL_CondWait( canConsume, bufferLock );
    }
    
    //Show and empty buffer
    apply_surface( x, y, buffer, screen );
    buffer = NULL;
    
    //Update the screen
    SDL_Flip( screen );
    
    //Unlock
    SDL_mutexV( bufferLock );
    
    //Signal producer
    SDL_CondSignal( canProduce );
}
</div>

<div class="tutText">
Here are our producer/consumer functions which are each called 5 times at random.
How do they work? Well let's take this example situation:<br>
<br>
Let's say the consumer function is called first.
It goes in and calls SDL_mutexP() to lock the mutex:<br>
<div class="tutImg"><img src="lock.png"></div>
<br>
Then the producer tries to go in but can't because the mutex is locked.
The mutex makes sure that the buffer and/or screen aren't manipulated by two threads at once.<br>
<div class="tutImg"><img src="wait.png"></div>
<br>
But let's say the buffer is empty.
Now the consumer calls SDL_CondWait() which makes the thread wait on the "canConsume" condition.
It also unlocks the mutex.<br>
<div class="tutImg"><img src="condwait.png"></div>
<br>
Now the producer can go through and produce.<br>
<div class="tutImg"><img src="produce.png"></div>
<br>
When the producer is done it calls SDL_mutexV() to unlock the mutex.
But the consumer thread is still sleeping.
<div class="tutImg"><img src="produced.png"></div>
<br>
That's why we call SDL_CondSignal() to signal the consumer waiting on the "canConsume" condition.
<div class="tutImg"><img src="signal.png"></div>
<br>
Now that SDL_CondWait() has been signaled,
the consumer wakes up, the mutex is relocked and now the consumer does its thing.
<div class="tutImg"><img src="consume.png"></div>
<br>
The threads not only stay out of each other's way, they also wait on and signal on each other thanks to mutexes/conditions.
</div>

<div class="tutCode">void clean_up()
{
    //Destroy mutex
    SDL_DestroyMutex( bufferLock );
    
    //Destroy condition
    SDL_DestroyCond( canProduce );
    SDL_DestroyCond( canConsume );
    
    //Free the surfaces
    for( int i = 0; i < 5; i++ )
    {
        SDL_FreeSurface( images[ i ] );
    }
    
    //Quit SDL
    SDL_Quit();
}
</div>

<div class="tutText">
As always, don't forget to free anything dynamically allocated.
Here we free our mutex and conditions using SDL_DestroyMutex() and SDL_DestroyCond().
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson35.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson34/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson36/index.php">Next Tutorial</a><br>
</div>
</div>

<div class="footer">


<div class="nav">

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
<br/>
<a class="nav" href="https://discourse.libsdl.org/">SDL Forums</a>
<a class="nav" href="../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../articles/index.php">Articles</a>
<a class="nav" href="../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../index.php">News</a>
<a class="nav" href="../../faq.php">FAQs</a>
<a class="nav" href="../../contact.php">Contact</a>
<a class="nav" href="../../donate.php">Donations</a>
</div>

<h6>Copyright Lazy Foo' Productions 2004-2024</h6>
</div>

</body>
</html>