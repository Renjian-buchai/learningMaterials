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
<meta name="keywords" content="C++ 2D Windows Linux Mac pinpointing a crash">
<meta name="description" content="Log your game logic to find crashes.">

<link href="../../assets/style.css" rel="stylesheet">
<script src="../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Pinpointing a Crash</title>

<script src="../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
	<a href="../../tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../index.php" class="nav-item nav-link">Articles</a>
	<a href="../../tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../index.php" class="nav-item nav-link">News</a>
	<a href="../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../donate.php" class="nav-item nav-link">Donations</a>
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
    <h1 class="text-center">Pinpointing a Crash</h1>
    
    <p class="text-center"><b>Last Updated: Apr 30th, 2023</b></p>
    
        So your application seems to be crashing at random. Here you'll learn a way to find the location of the crash.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    Before I start, let me say this isn't the best method to isolate segfaults. The best way is by using your
debugger. The thing is this site is all about being cross platform, and having to make an article for each of
the debuggers would take more time than I have. After you read this article (or now if you want to), I recommend
looking up how to use your IDEs/compilers debugger and learn to use it. This article is just to give you a method
I've used that helped me successfully find and fix segfaults.<br/>
<br/>
So one day I get an e-mail about someone who can't get one of my tutorial applications to work because it keeps
opening and immediately closing. All the code is correct, he has all the files in the right place, but it still
crashes. The thing is he's on OS X and I don't have a Mac to test the code on. It's in my interest to make sure my
code is bug free so I had to find a way to debug over e-mail.<br/>
<br/>
I decided to use a game log. Game logs record how the application is running. We use it to find the line that
causes the crash by checking the game log to find the last thing the application did before crashing. So I tell
the Mac user to paste some logging code into the program to find the problem.

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//File stream for the game log.
FILE* gLogger = fopen( "log.txt", "w+" );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the file stream we would use to create a game log. It's global because we're going to need it available at all points in the program.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void log( std::string message )
{
    //Write message to file
    char buf[ 1024 ];
    sprintf( buf, "%\n", message.c_str() );

    //Flush the buffer
    fflush( gLogger );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">This is our function that writes to the game log. It writes the message in the argument and goes to the next line. You don't have to start a new line every time you write, but most of the time in our game log we write one line
at a time and it's easier not having to add a "\n" to the message every single time we write to the game log.<br/>
<br/>
The after we write to the game log we flush the buffer. The reason we do this is because whenever we write to a file we are actually requesting to write. It can happen where you request to write to the file and program crashes
before the write goes through. The flush() function makes sure that it gets written..<br/>
<br/>
If you're wondering why we aren't using C++ fstream, the answer is like cout, it isn't thread safe. Sometimes the older methods work best.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Quit flag
    bool quit = false;
    
    //Initialize
    if( init() == false )
    {
        return 1;    
    }
    
    //Load the files
    if( load_files() == false )
    {
        return 1;    
    }
    
    //Apply the surfaces to the screen
    apply_surface( 0, 0, background, screen );
    apply_surface( 240, 190, foo, screen );
    
    //Update the screen
    if( SDL_Flip( screen ) == -1 )
    {
        return 1;    
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">This code is from the old color keying tutorial. Say if this code was crashing, how would we use game logging to find the problem?
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Quit flag
    bool quit = false;
    
    log( "Initializing..." );
    //Initialize
    if( init() == false )
    {
        return 1;    
    }
    
    log( "Loading files..." );
    //Load the files
    if( load_files() == false )
    {
        return 1;    
    }
    
    log( "Blitting..." );
    //Apply the surfaces to the screen
    apply_surface( 0, 0, background, screen );
    apply_surface( 240, 190, foo, screen );
    
    log( "Updating screen..." );
    //Update the screen
    if( SDL_Flip( screen ) == -1 )
    {
        return 1;    
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here you see the logger is writing to the log what's happening in the program as its happening. So if we open
log.txt and we see this:<br/>
<br/><code>
Initializing...<br/>
Loading files...<br/>
</code><br/>
It means the program managed to get to the file loading function but it never got to the blitting. Now we know the crash happened somewhere in the load_files() function. Now it's time to dig deeper.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool load_files()
{
    log( "Loading background..." );
    //Load the background image
    background = load_image( "background.png" );
    
    //If the background didn't load
    if( background == NULL )
    {
        log( SDL_GetError() );
        log( IMG_GetError() );
        return false;    
    }
    
    log( "Loading foo..." );
    //Load the stick figure
    foo = load_image( "foo.png" );
    
    //If the stick figure didn't load
    if( foo == NULL )
    {
        log( SDL_GetError() );
        log( IMG_GetError() );
        return false;    
    }
    
    return true;    
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now we log the file loading function.<br/>
<br/>
Now we not only log to isolate the problem, we also use SDL's error reporting functions. SDL_GetError() returns errors as a string from SDL so we can write it to the game log and IMG_GetError() is used for SDL_image errors.
Other error reporting functions you'll want to know about are TTF_GetError() for SDL_ttf and Mix_GetError() for SDL_mixer.<br/>
<br/>
When our Mac user opened up the log again, he found out load_image() returned NULL and IMG_GetError() reported that the problem was he didn't have proper png support installed.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">
    Remember, segfaults are caused by the program trying to access a piece of memory it shouldn't. This is usually
caused by:
<ol>
<li>Uninitialized pointers.</li>
<li>Trying to use objects from NULL pointers.</li>
<li>Arrays going out of bounds.</li>
</ol>
I was working on an old tetris clone and I had a for loop that was going out of bounds and crashing the application. This loop was deleting game objects after they were no longer being used but it was deleting more objects
than there were that existed. The for loop kept going until it reach the object count, but the object count was wrong. Sure enough, I looked in the constructor for a game object class and I forgot to initialize the object count
so this was looping for an indefinite amount of time. I found this out because I stuck logging code in the object deletion code and the logs showed it has a rediculous number instead of the 4 objects that were expected
to be deleted.<br/>
<br/>
Another tool you can use are the __FILE__ and __LINE__ macros. Every modern C/C++ compiler has these macros that store the value of what file and line the program is at. It's easier to see with an example.

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">void log( std::string file, int line, std::string message = "" )
{
    //Write message to file
    char buf[ 1024 ];
    sprintf( buf, "%s - %d : %s", file.c_str(), line, message.c_str() );
    fputs( buf, gLogger );
    fflush( gLogger );
}

int main( int argc, char* args[] )
{
    //Start SDL
    SDL_Init( SDL_INIT_EVERYTHING );
    
    log( __FILE__, __LINE__ );
    
    //Quit SDL
    SDL_Quit();
    
    return 0;    
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">This would output <code>mysource.cpp 21</code> into your log. This method is useful when you don't want to make unique messages for each log.<br/>
<br/>
Now you have a method to find your segfault which is half the battle when trying to fix them. You can use this method when you don't have access to a debugger, but don't use it as an excuse not to learn to use your
debugger.<br/>
<br/>
Well why don't I create a debugger tutorial instead of showing this hack method of finding segfaults that's more difficult than using debuggers? I originally wrote this article as a college freshman and if you asked me as
college senior to take it down I would have. If you ask me now as somebody who has had years of experience as a game developer, I would say keep it. This specific use case is impractical, but it's simple introduction to
logging which is something that is very important in real software development. I have had more than a few esoteric memory/multithreading bugs that effective use of logging was used to solve them. There are game engine
books that have entire chapters dedicated to logging, because imagine how much an engine like Unreal has going on in a single frame. There are entire companies whose only purpose is managing logs because imagine how many
logs a company like Amazon produces in a day.<br/>
<br/>
While a debugger would be much more useful in this specific case because it would immediately spit out the file/line that causes a segfault, logging is another tool in your debugging toolkit when things like breakpoints and
watches aren't enough.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">




If you have any suggestions to improve this article, It would be great if you <a  href="../../contact.php">contacted me</a> so I can improve this article.




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
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
	<a href="../../tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../index.php" class="nav-item nav-link">Articles</a>
	<a href="../../tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../index.php" class="nav-item nav-link">News</a>
	<a href="../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>