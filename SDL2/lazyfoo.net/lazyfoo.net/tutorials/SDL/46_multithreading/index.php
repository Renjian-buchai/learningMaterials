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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac Multithreading">
<meta name="description" content="Run multithreaded applications in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Multithreading</title>

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
    <h1 class="text-center">Multithreading</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Multithreading screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 10th, 2024</b></p>
    
        Multithreading can be used to make your program execute two things at once and take advantage of multithreaded architectures. Here we'll make a simple program that outputs to the console while the main thread runs.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    There is a saying in computer science:

<h2>Premature optimization is the root of all evil</h2>

A major problem with newbie programmers is that they want to be like the professionals without paying their dues. They hear about a technology that the latest and greatest developers out there are using and they think if they
use it too it will make them magically better.<br/>
<br/>
One of these tools is multithreading. Since multicore processors launched at a consumer level in the early 00s, developers have been using this new tech to squeeze out as much performance as they can from their
applications.<br/>
<br/>
<b>Here's the important part:</b> a poorly made multithreaded program can perform worse than a single threaded program. Much worse. The fact is that multithreading inherently adds more overhead because threads then have to be
managed. If you do not know the costs of using different multithreading tools, you can end up with code that is much slower than its single threaded equivalent.<br/>
<br/>
The general rule is if you don't know:
<ul>
<li>What cache coherency is.</li>
<li>What cache alignment is.</li>
<li>How operating systems handle threads and processes.</li>
<li>How to use a profiler.</li>
</ul>
You should not be trying to use multithreaded optimization. Play with fire and you will get burned. However doing something not for the sake of performance like asynchronous file loading isn't a bad idea for intermediate
game developers.

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Using SDL, SDL Threads, SDL_image, standard IO, and, strings
#include &#60SDL.h&#62
#include &#60SDL_thread.h&#62
#include &#60SDL_image.h&#62
#include &#60stdio.h&#62
#include &#60string&#62
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When we want to use threads we need to make sure to include the SDL threads header.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Our test thread function
int threadFunction( void* data );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Just like with callback functions, thread functions need to declared a certain way. They need to take in a void pointer as an argument and return an integer.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">int threadFunction( void* data )
{
    //Print incoming data
    printf( "Running thread with value = %d\n", (int)data );

    return 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Our thread function is fairly simple. All it does is take in the data as an integer and uses it to print a message to the console.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Run the thread
            int data = 101;
            SDL_Thread* threadID = SDL_CreateThread( threadFunction, "LazyThread", (void*)data );

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

                //Render prompt
                gSplashTexture.render( 0, 0 );

                //Update screen
                SDL_RenderPresent( gRenderer );
            }

            //Wait for thread to finish
            SDL_WaitThread( threadID, NULL );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Before we enter the main loop we run the thread function using <a href="http://wiki.libsdl.org/SDL_CreateThread">SDL_CreateThread</a>. This call will run the function in first argument, give it the name in the second argument
(names are used to identify it for debugging purposes), and passes in the data from the third argument.<br/>
<br/>
The thread will then execute while the main thread is still going. In case the main loop ends before the thread finishes, we make a call to <a href="http://wiki.libsdl.org/SDL_WaitThread">SDL_WaitThread</a> to make sure the
thread finishes before the application closes.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="46_multithreading.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Multithreading">Back to Index</a>


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