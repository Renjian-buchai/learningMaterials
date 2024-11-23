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
<div class="tutPreface"><h1 class="tutHead">Semaphores</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/28/10</h6>
When you have multiple threads running you have to make sure that they don't try to manipulate the same piece of
data at the same time. In this tutorial we'll use semaphores to lock threads to prevent them from crashing into
each other.<br/>
<br/>
<a class="tutLink" href="../../tutorials/SDL/47_semaphores/index.php">Semaphores tutorial with SDL 2</a> is now available.
</div>

<div class="tutText">
Before we start there's something that has to be said.
In this tutorial we have video functions running in separate threads.
You should never do this in a real application.
It's just bad software design and in some cases can cause your OS to become unstable.
The only reason we're doing it here is because it's a small program and nothing's going to go wrong.
We're doing it here just as a simple demonstration of semaphores in action.<br>
<br>
Now with that out of the way let's start with the tutorial.
In this program we're going to have two threads trying to blit surfaces to screen and update the screen at the same time.
Having two threads trying to manipulate the same data at the same time is a recipe for disaster.
This is where the semaphores come into play.
What the semaphore will do is allow only one thread to manipulate to the screen at a time.
</div>

<div class="tutCode">//The threads that will be used
SDL_Thread *threadA = NULL;
SDL_Thread *threadB = NULL;

//The protective semaphore
SDL_sem *videoLock = NULL;
</div>

<div class="tutText">
At the top of our program we have our two threads we're going to have running along with our semaphore.
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
    
    //Initialize SDL_ttf
    if( TTF_Init() == -1 )
    {
        return false;    
    }
    
    //Create the semaphore
    videoLock = SDL_CreateSemaphore( 1 );
    
    //Set the window caption
    SDL_WM_SetCaption( "Testing Threads", NULL );
    
    //If everything initialized fine
    return true;
}
</div>

<div class="tutText">
Before we can use a semaphore you have to create it using SDL_CreateSemaphore().<br>
<br>
You may be wondering what that 1 argument does. I'll explain later.
</div>

<div class="tutCode">int blitter_a( void *data )
{
    //Y offset
    int y = 10;
    
    //Go through the surface
    for( int b = 0; b < 5; b++ )
    {
        //Wait
        SDL_Delay( 200 );
    
        //Show surface
        show_surface( ( ( SCREEN_WIDTH / 2 ) - text[ b ]->w ) / 2, y, text[ b ] );
        
        //Move down
        y += 100;
    }
    
    return 0;
}

int blitter_b( void *data )
{
    //Y offset
    int y = 10;
    
    //Go through the surface
    for( int b = 0; b < 5; b++ )
    {
        //Wait
        SDL_Delay( 200 );
    
        //Show surface
        show_surface( ( SCREEN_WIDTH / 2 ) + ( ( ( SCREEN_WIDTH / 2 ) - text[ b ]->w ) / 2 ), y, text[ b ] );
        
        //Move down
        y += 100;
    }
    
    return 0;
}
</div>

<div class="tutText">
Here are our threads functions.
All they do is go through an array of surfaces and show them on the screen.
blitter_a() blits surfaces on the left of the screen and blitter_b() blits surfaces on the right.<br>
<br>
As you can see we're not using our usual apply_surface() function.
We're using show_surface(), a modified version of apply_surface() which applies the surface using SDL_BlitSurface() and
updates the screen using SDL_Flip() all in one function.
You'll see it in a little bit.<br>
<br>
Since we're going to have the threads run at the same time we have prevent them from trying to manipulate the screen at the same time.
To do this we're going to have to protect the show_surface() function using our semaphore.
</div>

<div class="tutCode">void show_surface( int x, int y, SDL_Surface* source )
{
    //Lock
    SDL_SemWait( videoLock );
    
    //Holds offsets
    SDL_Rect offset;
    
    //Get offsets
    offset.x = x;
    offset.y = y;
    
    //Blit
    SDL_BlitSurface( source, NULL, screen, &offset );
    
    //Update the screen
    SDL_Flip( screen );

    //Unlock
    SDL_SemPost( videoLock );
}
</div>

<div class="tutText">
Here's our show_surface() function which blits a surface then updates the screen.
We also put SDL_SemWait() at the top of our function and SDL_SemPost() at the bottom.<br>
<br>
What SDL_SemWait() does is lock the semaphore:<br>
<div class="tutImg"><img src="lock.png"></div>
<br>
So when another thread tries to get through, it has to wait:<br>
<div class="tutImg"><img src="wait.png"></div>
<br>
Until SDL_SemPost() is called to unlock the semaphore:<br>
<div class="tutImg"><img src="unlock.png"></div>
<br>
Then the next thread does its thing and locks the semaphore behind it:<br>
<div class="tutImg"><img src="nextthread.png"></div>
<br>
Because SDL_BlitSurface() and SDL_Flip() are protected by the semaphore,
only one thread can call video functions at a time so there's no conflict.<br>
<br>
As I mentioned earlier we passed 1 argument in SDL_CreateSemaphore() in our init() function.
That 1 is how many threads can get past the semaphore before it locks.
If we wanted to we could have allowed 2 threads to pass, but that would be pointless in this case.
Most of the time you will only want one thread to pass through a semaphore before locking.
</div>

<div class="tutCode">    //Show the background
    show_surface( 0, 0, background );
        
    //Create and run the threads
    threadA = SDL_CreateThread( blitter_a, NULL );
    threadB = SDL_CreateThread( blitter_b, NULL );
    
    //Wait for the threads to finish
    SDL_WaitThread( threadA, NULL );
    SDL_WaitThread( threadB, NULL );
    
    //While the user hasn't quit
    while( quit == false )
    {
        //If there's an event to handle
        if( SDL_PollEvent( &event ) )
        {
            //If the user has Xed out the window
            if( event.type == SDL_QUIT )
            {
                //Quit the program
                quit = true;
            }
        }
    }
</div>

<div class="tutText">
In the main() thread after everything is loaded and initialized we show the background on the screen.<br>
<br>
Then we run our two threads and wait for them to finish by using SDL_WaitThread().
After the threads are finished we simply wait for the user to quit.
</div>

<div class="tutCode">void clean_up()
{
    //Destroy semaphore
    SDL_DestroySemaphore( videoLock );
    
    //Free the surfaces
    SDL_FreeSurface( background );
    
    //Free text
    for( int t = 0; t < 5; t++ )
    {
        SDL_FreeSurface( text[ t ] );
    }
    
    //Close the font
    TTF_CloseFont( font );
    
    //Quit SDL_ttf
    TTF_Quit();
    
    //Quit SDL
    SDL_Quit();
}
</div>

<div class="tutText">
Don't forget to clean up your semaphore when you're done with it.<br>
<br>
We do that in our clean up function using SDL_DestroySemaphore().
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson34.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson33/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson35/index.php">Next Tutorial</a><br>
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