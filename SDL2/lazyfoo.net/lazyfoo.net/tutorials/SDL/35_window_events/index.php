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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac window resize minimize maximize events">
<meta name="description" content="Handle resizable windows in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Window Events</title>

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
    <h1 class="text-center">Window Events</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Window Events screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Nov 26th, 2023</b></p>
    
        SDL also supports resizable windows. When you have resizable windows there are additional events to handle, which is what we'll be doing here.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">class LWindow
{
    public:
        //Intializes internals
        LWindow();

        //Creates window
        bool init();

        //Creates renderer from internal window
        SDL_Renderer* createRenderer();

        //Handles window events
        void handleEvent( SDL_Event& e );

        //Deallocates internals
        void free();

        //Window dimensions
        int getWidth();
        int getHeight();

        //Window focii
        bool hasMouseFocus();
        bool hasKeyboardFocus();
        bool isMinimized();

    private:
        //Window data
        SDL_Window* mWindow;

        //Window dimensions
        int mWidth;
        int mHeight;

        //Window focus
        bool mMouseFocus;
        bool mKeyboardFocus;
        bool mFullScreen;
        bool mMinimized;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our window class we'll be using as a wrapper for the SDL_Window. It has a constructor, an initializer that creates the window, a function to create a renderer from the window, an event handler, a deallocator, and some
accessor functions to get various attributes from the window.<br/>
<br/>
In terms of data members, we have the window we're wrapping, the dimensions of the window, and flags for the types of focus the windows has. We'll go into more detail further in the program.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Our custom window
LWindow gWindow;

//The window renderer
SDL_Renderer* gRenderer = NULL;

//Scene textures
LTexture gSceneTexture;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">We'll be using our window as a global object.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">LWindow::LWindow()
{
    //Initialize non-existant window
    mWindow = NULL;
    mMouseFocus = false;
    mKeyboardFocus = false;
    mFullScreen = false;
    mMinimized = false;
    mWidth = 0;
    mHeight = 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the constructor we initialize all our variables.
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
    }

    return mWindow != NULL;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Our initialization function creates the window with the <a href="http://wiki.libsdl.org/SDL_WindowFlags">SDL_WINDOW_RESIZABLE</a> flag which allows for our window to be resizable. If the function succeeds we set the
corresponding flags and dimensions. Then we return whether the window is null or not.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">SDL_Renderer* LWindow::createRenderer()
{
    return SDL_CreateRenderer( mWindow, -1, SDL_RENDERER_ACCELERATED | SDL_RENDERER_PRESENTVSYNC );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we're handling the creation of a renderer from the member window. We're returning the created renderer because rendering will be handled outside of the class.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void LWindow::handleEvent( SDL_Event& e )
{
    //Window event occured
    if( e.type == SDL_WINDOWEVENT )
    {
        //Caption update flag
        bool updateCaption = false;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our window's event handler we'll be looking for events of type <a href="http://wiki.libsdl.org/SDL_WindowEvent">SDL_WINDOWEVENT</a>. SDL_WindowEvents are actually a family of events. Depending on the event we may have to
update the caption of the window, so we have a flag that keeps track of that.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        switch( e.window.event )
        {
            //Get new dimensions and repaint on window size change
            case SDL_WINDOWEVENT_SIZE_CHANGED:
            mWidth = e.window.data1;
            mHeight = e.window.data2;
            SDL_RenderPresent( gRenderer );
            break;

            //Repaint on exposure
            case SDL_WINDOWEVENT_EXPOSED:
            SDL_RenderPresent( gRenderer );
            break;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When we have a window event we then want to check the <a href="http://wiki.libsdl.org/SDL_WindowEventID">SDL_WindowEventID</a> to see what type of event it is. An SDL_WINDOWEVENT_SIZE_CHANGED is a resize event, so we get the
new dimensions and refresh the image on the screen.<br/>
<br/>
An SDL_WINDOWEVENT_EXPOSED just means that window was obscured in some way and now is not obscured so we want to repaint the window.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Mouse entered window
            case SDL_WINDOWEVENT_ENTER:
            mMouseFocus = true;
            updateCaption = true;
            break;
            
            //Mouse left window
            case SDL_WINDOWEVENT_LEAVE:
            mMouseFocus = false;
            updateCaption = true;
            break;

            //Window has keyboard focus
            case SDL_WINDOWEVENT_FOCUS_GAINED:
            mKeyboardFocus = true;
            updateCaption = true;
            break;

            //Window lost keyboard focus
            case SDL_WINDOWEVENT_FOCUS_LOST:
            mKeyboardFocus = false;
            updateCaption = true;
            break;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">SDL_WINDOWEVENT_ENTER/SDL_WINDOWEVENT_LEAVE handles when the mouse moves into and out of the window. SDL_WINDOWEVENT_FOCUS_GAINED/SDL_WINDOWEVENT_FOCUS_LOST have to do when the window is getting input from the keyboard. Since
our caption keeps track of mouse/keyboard focus, we set the update caption flag when any of these events happen.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Window minimized
            case SDL_WINDOWEVENT_MINIMIZED:
            mMinimized = true;
            break;

            //Window maximized
            case SDL_WINDOWEVENT_MAXIMIZED:
            mMinimized = false;
            break;
            
            //Window restored
            case SDL_WINDOWEVENT_RESTORED:
            mMinimized = false;
            break;
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally here we handle when the window was minimized, maximized, or restored from being minimized.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Update window caption with new data
        if( updateCaption )
        {
            std::stringstream caption;
            caption << "SDL Tutorial - MouseFocus:" << ( ( mMouseFocus ) ? "On" : "Off" ) << " KeyboardFocus:" << ( ( mKeyboardFocus ) ? "On" : "Off" );
            SDL_SetWindowTitle( mWindow, caption.str().c_str() );
        }
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">If the caption needs to be updated, we load a string stream with the updated data and update the caption with <a href="http://wiki.libsdl.org/SDL_SetWindowTitle">SDL_SetWindowTitle</a>.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Enter exit full screen on return key
    else if( e.type == SDL_KEYDOWN && e.key.keysym.sym == SDLK_RETURN )
    {
        if( mFullScreen )
        {
            SDL_SetWindowFullscreen( mWindow, 0 );
            mFullScreen = false;
        }
        else
        {
            SDL_SetWindowFullscreen( mWindow, SDL_WINDOW_FULLSCREEN_DESKTOP );
            mFullScreen = true;
            mMinimized = false;
        }
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this demo we'll be toggling fullscreen with the return key. We can set fullscreen mode desktop mode using <a href="http://wiki.libsdl.org/SDL_SetWindowFullscreen">SDL_SetWindowFullscreen</a>. Full screen desktop mode is
essentially a "fake" fullscreen mode that resizes the window to the size of the screen. You can also use true fullscreen but there will be a slight delay in the transition. Each has their costs and benefits so pick the fullscreen
mode that will work for your application.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">int LWindow::getWidth()
{
    return mWidth;
}

int LWindow::getHeight()
{
    return mHeight;
}

bool LWindow::hasMouseFocus()
{
    return mMouseFocus;
}

bool LWindow::hasKeyboardFocus()
{
    return mKeyboardFocus;
}

bool LWindow::isMinimized()
{
    return mMinimized;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is a quick rundown of the accessors we use.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Create window
        if( !gWindow.init() )
        {
            printf( "Window could not be created! SDL Error: %s\n", SDL_GetError() );
            success = false;
        }
        else
        {
            //Create renderer for window
            gRenderer = gWindow.createRenderer();
            if( gRenderer == NULL )
            {
                printf( "Renderer could not be created! SDL Error: %s\n", SDL_GetError() );
                success = false;
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our initialization function we create our window and renderer only this time with our window wrapper.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void close()
{
    //Free loaded images
    gSceneTexture.free();

    //Destroy window    
    SDL_DestroyRenderer( gRenderer );
    gWindow.free();

    //Quit SDL subsystems
    IMG_Quit();
    SDL_Quit();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our clean up function we still deallocate our window and renderer.
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

                    //Handle window events
                    gWindow.handleEvent( e );
                }

                //Only draw when not minimized
                if( !gWindow.isMinimized() )
                {
                    //Clear screen
                    SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                    SDL_RenderClear( gRenderer );

                    //Render text textures
                    gSceneTexture.render( ( gWindow.getWidth() - gSceneTexture.getWidth() ) / 2, ( gWindow.getHeight() - gSceneTexture.getHeight() ) / 2 );

                    //Update screen
                    SDL_RenderPresent( gRenderer );
                }
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the main loop we make sure to pass events to the window wrapper to handle resize events and in the rendering part of our code we make sure to only render when the window is not
minimized because this can cause some bugs when we try to render to a minimized window.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="35_window_events.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Window Events">Back to Index</a>


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