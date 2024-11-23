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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac SDL OpenGL 2.1 legacy">
<meta name="description" content="Support Legacy OpenGL in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - SDL and OpenGL 2</title>

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
    <h1 class="text-center">SDL and OpenGL 2</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="SDL and OpenGL 2 screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Oct 13th, 2022</b></p>
    
        One SDL's most powerful features is its ability to combine with OpenGL. Here we'll make a basic OpenGL demo using easier to use legacy OpenGL.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Using SDL, SDL OpenGL, standard IO, and, strings
#include &#60SDL.h&#62
#include &#60SDL_opengl.h&#62
#include &#60GL\GLU.h&#62
#include &#60stdio.h&#62
#include &#60string&#62
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">To use OpenGL with SDL, make sure to include the SDL OpenGL header. We'll also be using GLU (Open<b>GL</b> <b>U</b>tilities) for this demo.<br/>
<br/>
Also make sure to check the readme.txt file to check which libraries you need to link against.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Starts up SDL, creates window, and initializes OpenGL
bool init();

//Initializes matrices and clear color
bool initGL();

//Input handler
void handleKeys( unsigned char key, int x, int y );

//Per frame update
void update();

//Renders quad to the screen
void render();

//Frees media and shuts down SDL
void close();

//The window we'll be rendering to
SDL_Window* gWindow = NULL;

//OpenGL context
SDL_GLContext gContext;

//Render flag
bool gRenderQuad = true;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In terms of new functions, we have a dedicated OpenGL initialization function with initGL. We also have dedicated key handlers, updating, and rendering functions for the main loop.<br/>
<br/>
We also have a GL Context. An OpenGL context is just something that handles OpenGL calls and you need to have one for any OpenGL rendering. Finally, we have a boolean flag that toggles rendering.
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
        //Use OpenGL 2.1
        SDL_GL_SetAttribute( SDL_GL_CONTEXT_MAJOR_VERSION, 2 );
        SDL_GL_SetAttribute( SDL_GL_CONTEXT_MINOR_VERSION, 1 );

        //Create window
        gWindow = SDL_CreateWindow( "SDL Tutorial", SDL_WINDOWPOS_UNDEFINED, SDL_WINDOWPOS_UNDEFINED, SCREEN_WIDTH, SCREEN_HEIGHT, SDL_WINDOW_OPENGL | SDL_WINDOW_SHOWN );
        if( gWindow == NULL )
        {
            printf( "Window could not be created! SDL Error: %s\n", SDL_GetError() );
            success = false;
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When creating an SDL OpenGL window, there are a few more steps we have to take.<br/>
<br/>
Before creating the window we need to specify the version we want. We want OpenGL 2.1 so we call <a href="http://wiki.libsdl.org/SDL_GL_SetAttribute">SDL_GL_SetAttribute</a> to set the major version to 2 and the minor version
to 1. After the version is set we can create an OpenGL window by passing the SDL_WINDOW_OPENGL flag to SDL_CreateWindow.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        else
        {
            //Create context
            gContext = SDL_GL_CreateContext( gWindow );
            if( gContext == NULL )
            {
                printf( "OpenGL context could not be created! SDL Error: %s\n", SDL_GetError() );
                success = false;
            }
            else
            {
                //Use Vsync
                if( SDL_GL_SetSwapInterval( 1 ) < 0 )
                {
                    printf( "Warning: Unable to set VSync! SDL Error: %s\n", SDL_GetError() );
                }

                //Initialize OpenGL
                if( !initGL() )
                {
                    printf( "Unable to initialize OpenGL!\n" );
                    success = false;
                }
            }
        }
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After the window has been created successfully we call <a href="http://wiki.libsdl.org/SDL_GL_CreateContext">SDL_GL_CreateContext</a> to create the OpenGL rendering context. If that was successful, we enable Vsync with
<a href="http://wiki.libsdl.org/SDL_GL_SetSwapInterval">SDL_GL_SetSwapInterval</a>.<br/>
<br/>
After the SDL OpenGL window is created, we then initialize OpenGL's internals with our own initGL function.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool initGL()
{
    bool success = true;
    GLenum error = GL_NO_ERROR;

    //Initialize Projection Matrix
    glMatrixMode( GL_PROJECTION );
    glLoadIdentity();
    
    //Check for error
    error = glGetError();
    if( error != GL_NO_ERROR )
    {
        printf( "Error initializing OpenGL! %s\n", gluErrorString( error ) );
        success = false;
    }

    //Initialize Modelview Matrix
    glMatrixMode( GL_MODELVIEW );
    glLoadIdentity();

    //Check for error
    error = glGetError();
    if( error != GL_NO_ERROR )
    {
        printf( "Error initializing OpenGL! %s\n", gluErrorString( error ) );
        success = false;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our first bit of actual OpenGL code. If you were hoping to know all of OpenGL by the end of this tutorial, that is not going to be possible. OpenGL is oceanic in size and complexity and there's no way we could cover it
in a single tutorial. What we're doing in this demo is learning how to use OpenGL with SDL.<br/>
<br/>
First we initialize the projection matrix which controls how perspective works in OpenGL. We initialize it here by setting it to the identity matrix. We check if there was an error and print it to the console. Then we do the
same thing with the model view matrix which controls how your rendered objects are viewed and placed.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Initialize clear color
    glClearColor( 0.f, 0.f, 0.f, 1.f );
    
    //Check for error
    error = glGetError();
    if( error != GL_NO_ERROR )
    {
        printf( "Error initializing OpenGL! %s\n", gluErrorString( error ) );
        success = false;
    }
    
    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Lastly, we set the clear color which is the color that the screen is wiped with when we call glClear.<br/>
<br/>
We didn't go into much detail about how these functions work because our main concern is getting SDL working with OpenGL. If you want more detail you can look it up in the
 <a href="http://www.opengl.org/sdk/docs/man2/">OpenGL 2.1 documentation</a>.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void handleKeys( unsigned char key, int x, int y )
{
    //Toggle quad
    if( key == 'q' )
    {
        gRenderQuad = !gRenderQuad;
    }
}

void update()
{
    //No per frame update needed
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here are our key input and update handlers. The key input handler toggles the render flag and the update handler is just there for compatibility's sake.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );
    
    //Render quad
    if( gRenderQuad )
    {
        glBegin( GL_QUADS );
            glVertex2f( -0.5f, -0.5f );
            glVertex2f( 0.5f, -0.5f );
            glVertex2f( 0.5f, 0.5f );
            glVertex2f( -0.5f, 0.5f );
        glEnd();
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here in the renderer we're clearing the screen and then if rendering is enabled, we render a quad.<br/>
<br/>
The important thing to know is that OpenGL uses normalized coordinates. This means they go from -1 to 1:
<div class="text-center"><img class="img-fluid" alt="normalized coordinates" src="normal_coord.png"></div>
<br/>
This means our quad is wider than it is tall. In order to get a coordinate system like SDL's, you're going to have to set the project matrix to an orthographic perspective.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Enable text input
        SDL_StartTextInput();

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
                //Handle keypress with current mouse position
                else if( e.type == SDL_TEXTINPUT )
                {
                    int x = 0, y = 0;
                    SDL_GetMouseState( &x, &y );
                    handleKeys( e.text.text[ 0 ], x, y );
                }
            }

            //Render quad
            render();
            
            //Update screen
            SDL_GL_SwapWindow( gWindow );
        }
        
        //Disable text input
        SDL_StopTextInput();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our main loop with our main loop functions snapped in.<br/>
<br/>
An important thing to know is that when you use OpenGL's rendering you cannot use SDL's rendering call for surfaces, texturing, and such. As you can see here we need 
<a href="http://wiki.libsdl.org/SDL_GL_SwapWindow">SDL_GL_SwapWindow</a> to update the screen.<br/>
<br/>
We only flew over the details of OpenGL rendering, but if you want to go into more detail there's an <a href="../../OpenGL/index.php">OpenGL tutorial</a> for that. The tutorial uses FreeGLUT, but using this tutorial it should
be easy to port it to SDL 2 for window and event handling. For most of the OpenGL tutorial version 2.1 is used which is old but easier to use. You may not want to use old OpenGL, but think of it this way: Many of the core
graphics algorithms like phoung shading were developed in the 1970s. What's changed is that we have different tools to render them with, but the core concepts have not changed.<br/>
<br/>
If you understand the core concepts, you realize that OpenGL 2, OpenGL 3, OpenGL 4, and even Direct3D are more similar than they are different. What's important is that you know how geometry based rendering systems work and
getting your hands dirty by getting real experience. 
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="50_SDL_and_opengl_2.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#SDL and OpenGL 2">Back to Index</a>


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