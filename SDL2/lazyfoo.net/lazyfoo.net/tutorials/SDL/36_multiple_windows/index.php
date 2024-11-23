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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac multiple windows">
<meta name="description" content="Handle multiple windows in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Multiple Windows</title>

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
    <h1 class="text-center">Multiple Windows</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Multiple Windows screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 14th, 2022</b></p>
    
        One of the new features SDL 2 has is being able to handle multiple windows at once. In this tutorial we'll be moving around 3 resizable windows.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Total windows
const int TOTAL_WINDOWS = 3;

class LWindow
{
    public:
        //Intializes internals
        LWindow();

        //Creates window
        bool init();

        //Handles window events
        void handleEvent( SDL_Event& e );

        //Focuses on window
        void focus();

        //Shows windows contents
        void render();

        //Deallocates internals
        void free();

        //Window dimensions
        int getWidth();
        int getHeight();

        //Window focii
        bool hasMouseFocus();
        bool hasKeyboardFocus();
        bool isMinimized();
        bool isShown();

    private:
        //Window data
        SDL_Window* mWindow;
        SDL_Renderer* mRenderer;
        int mWindowID;

        //Window dimensions
        int mWidth;
        int mHeight;

        //Window focus
        bool mMouseFocus;
        bool mKeyboardFocus;
        bool mFullScreen;
        bool mMinimized;
        bool mShown;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our <a href="../35_window_events/index.php">window wrapper from before</a> with a few adjustments. We want to be able to grab focus and we want to tell if
the window is shown so we add functions to do that.<br/>
<br/>
Each window is going to have their own renderer so we add a member variable for that. We also keep track of the window ID to tell which events belong to which window and we also 
added a flag to keep track of whether the window is shown.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Our custom windows
LWindow gWindows[ TOTAL_WINDOWS ];
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this program we'll have 3 globally allocated windows.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool LWindow::init()
{
    //Create window
    mWindow = SDL_CreateWindow( "SDL Tutorial", SDL_WINDOWPOS_UNDEFINED, SDL_WINDOWPOS_UNDEFINED, SCREEN_WIDTH, SCREEN_HEIGHT, SDL_WINDOW_SHOWN | SDL_WINDOW_RESIZABLE );
    if( mWindow != NULL )
    {
        mMouseFocus = true;
        mKeyboardFocus = true;
        mWidth = SCREEN_WIDTH;
        mHeight = SCREEN_HEIGHT;

        //Create renderer for window
        mRenderer = SDL_CreateRenderer( mWindow, -1, SDL_RENDERER_ACCELERATED | SDL_RENDERER_PRESENTVSYNC );
        if( mRenderer == NULL )
        {
            printf( "Renderer could not be created! SDL Error: %s\n", SDL_GetError() );
            SDL_DestroyWindow( mWindow );
            mWindow = NULL;
        }
        else
        {
            //Initialize renderer color
            SDL_SetRenderDrawColor( mRenderer, 0xFF, 0xFF, 0xFF, 0xFF );

            //Grab window identifier
            mWindowID = SDL_GetWindowID( mWindow );

            //Flag as opened
            mShown = true;
        }
    }
    else
    {
        printf( "Window could not be created! SDL Error: %s\n", SDL_GetError() );
    }

    return mWindow != NULL && mRenderer != NULL;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our window and renderer creation code. It is pretty much the same as we have always done it, only now it's happening inside our wrapper class. We do have to make sure to grab
the window ID after creating the window as we'll need the ID for event handling.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void LWindow::handleEvent( SDL_Event& e )
{
    //If an event was detected for this window
    if( e.type == SDL_WINDOWEVENT && e.window.windowID == mWindowID )
    {
        //Caption update flag
        bool updateCaption = false;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">All events from all windows go onto the same event queue, so to know which events belong to which window we check that the event's window ID matches ours.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        switch( e.window.event )
        {
            //Window appeared
            case SDL_WINDOWEVENT_SHOWN:
            mShown = true;
            break;

            //Window disappeared
            case SDL_WINDOWEVENT_HIDDEN:
            mShown = false;
            break;

            //Get new dimensions and repaint
            case SDL_WINDOWEVENT_SIZE_CHANGED:
            mWidth = e.window.data1;
            mHeight = e.window.data2;
            SDL_RenderPresent( mRenderer );
            break;

            //Repaint on expose
            case SDL_WINDOWEVENT_EXPOSED:
            SDL_RenderPresent( mRenderer );
            break;

            //Mouse enter
            case SDL_WINDOWEVENT_ENTER:
            mMouseFocus = true;
            updateCaption = true;
            break;
            
            //Mouse exit
            case SDL_WINDOWEVENT_LEAVE:
            mMouseFocus = false;
            updateCaption = true;
            break;

            //Keyboard focus gained
            case SDL_WINDOWEVENT_FOCUS_GAINED:
            mKeyboardFocus = true;
            updateCaption = true;
            break;
            
            //Keyboard focus lost
            case SDL_WINDOWEVENT_FOCUS_LOST:
            mKeyboardFocus = false;
            updateCaption = true;
            break;

            //Window minimized
            case SDL_WINDOWEVENT_MINIMIZED:
            mMinimized = true;
            break;

            //Window maxized
            case SDL_WINDOWEVENT_MAXIMIZED:
            mMinimized = false;
            break;
            
            //Window restored
            case SDL_WINDOWEVENT_RESTORED:
            mMinimized = false;
            break;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When you have multiple windows, Xing out the window doesn't necessarily mean we're quitting the program. What we're going to do instead is have each window hide when Xed out. So
we'll need keep track of when the window is hidden/shown by checking for SDL_WINDOWEVENT_SHOWN/SDL_WINDOWEVENT_HIDDEN events.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Hide on close
            case SDL_WINDOWEVENT_CLOSE:
            SDL_HideWindow( mWindow );
            break;
        }

        //Update window caption with new data
        if( updateCaption )
        {
            std::stringstream caption;
            caption << "SDL Tutorial - ID: " << mWindowID << " MouseFocus:" << ( ( mMouseFocus ) ? "On" : "Off" ) << " KeyboardFocus:" << ( ( mKeyboardFocus ) ? "On" : "Off" );
            SDL_SetWindowTitle( mWindow, caption.str().c_str() );
        }
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When you have multiple windows, Xing out the window gets interpreted as SDL_WINDOWEVENT_CLOSE window events. When we get these events we're going to hide the window using 
<a href="http://wiki.libsdl.org/SDL_HideWindow">SDL_HideWindow</a>.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void LWindow::focus()
{
    //Restore window if needed
    if( !mShown )
    {
        SDL_ShowWindow( mWindow );
    }

    //Move window forward
    SDL_RaiseWindow( mWindow );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our function for grabbing focus to a window. First we check if our window is even being shown and then show it with <a href="http://wiki.libsdl.org/SDL_ShowWindow">SDL_ShowWindow</a> if it isn't being shown. Next we
call <a href="http://wiki.libsdl.org/SDL_RaiseWindow">SDL_RaiseWindow</a> to focus the window.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void LWindow::render()
{
    if( !mMinimized )
    {    
        //Clear screen
        SDL_SetRenderDrawColor( mRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
        SDL_RenderClear( mRenderer );

        //Update screen
        SDL_RenderPresent( mRenderer );
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Like before, we only want to render if the window is not minimized.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool init()
{
    //Initialization flag
    bool success = true;

    //Initialize SDL
    if( SDL_Init( SDL_INIT_VIDEO ) < 0 )
    {
        printf( "SDL could not initialize! SDL Error: %s\n", SDL_GetError() );
        success = false;
    }
    else
    {
        //Set texture filtering to linear
        if( !SDL_SetHint( SDL_HINT_RENDER_SCALE_QUALITY, "1" ) )
        {
            printf( "Warning: Linear texture filtering not enabled!" );
        }

        //Create window
        if( !gWindows[ 0 ].init() )
        {
            printf( "Window 0 could not be created!\n" );
            success = false;
        }
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the initialization function we open up a single window to check if window creation is functioning properly.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void close()
{
    //Destroy windows
    for( int i = 0; i < TOTAL_WINDOWS; ++i )
    {
        gWindows[ i ].free();
    }

    //Quit SDL subsystems
    SDL_Quit();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the clean up function we close out any windows that might be open.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Initialize the rest of the windows
        for( int i = 1; i < TOTAL_WINDOWS; ++i )
        {
            gWindows[ i ].init();
        }

        //Main loop flag
        bool quit = false;

        //Event handler
        SDL_Event e;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Before we enter the main loop we open up the rest of the windows we have.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //While application is running
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

                //Handle window events
                for( int i = 0; i < TOTAL_WINDOWS; ++i )
                {
                    gWindows[ i ].handleEvent( e );
                }

                //Pull up window
                if( e.type == SDL_KEYDOWN )
                {
                    switch( e.key.keysym.sym )
                    {
                        case SDLK_1:
                        gWindows[ 0 ].focus();
                        break;

                        case SDLK_2:
                        gWindows[ 1 ].focus();
                        break;
                            
                        case SDLK_3:
                        gWindows[ 2 ].focus();
                        break;
                    }
                }
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the main loop after we handle the events for all the windows, we handle some special key presses. For this demo, when we press 1, 2, or 3 it will bring the corresponding window to focus.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Update all windows
            for( int i = 0; i < TOTAL_WINDOWS; ++i )
            {
                gWindows[ i ].render();
            }
                
            //Check all windows
            bool allWindowsClosed = true;
            for( int i = 0; i < TOTAL_WINDOWS; ++i )
            {
                if( gWindows[ i ].isShown() )
                {
                    allWindowsClosed = false;
                    break;
                }
            }

            //Application closed all windows
            if( allWindowsClosed )
            {
                quit = true;
            }
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Next we render all the windows and then go through all the windows to check if any of them are shown. If all of them have been closed out we set the quit flag to true to end the
program.<br/>
<br/>
Now in this demo we did not actually render anything inside of the windows. This would involve having to manage renderers and windows and having them share resources. There is no
right way to do this and the best way depends entirely on what type of application you're building. I recommend reading through the SDL documentation to understand how renderers work
and then experimenting to figure out the best way for you to manage your resources.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="36_multiple_windows.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Multiple Windows">Back to Index</a>


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