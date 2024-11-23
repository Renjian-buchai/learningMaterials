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
            <div class="tutPreface"><h1 class="tutHead">Using SDL with OpenGL 2.1</h1>
            <div class="tutImg"><img src="preview.png"></div>
            <h6>Last Updated 8/6/12</h6>
            There's a point where SDL's rendering just isn't enough. When you need more power, speed, and flexibility, it's time to move onto OpenGL.<br>
            <br>
            While we won't cover how to use OpenGL here (<a class="tutLink" href="../../tutorials/OpenGL/index.php">I hear there's a tutorial for that</a>) we will cover
            how to use SDL to render OpenGL.<br/>
			<br/>
			<a class="tutLink" href="../../tutorials/SDL/50_SDL_and_opengl_2/index.php">SDL and OpenGL 2.1 tutorial with SDL 2</a> is now available. A
			<a class="tutLink" href="../../tutorials/SDL/51_SDL_and_modern_opengl/index.php">SDL and Modern OpenGL tutorial with SDL 2</a> is also available.
            </div>

<div class="tutCode">#include "SDL/SDL.h"
#include "SDL/SDL_opengl.h"
</div>

            <div class="tutText">
            First we need to remember to include the SDL OpenGL header so we can use OpenGL's rendering.
            </div>

<div class="tutCode">bool init()
{
    //Initialize SDL
    if( SDL_Init( SDL_INIT_EVERYTHING ) < 0 )
    {
        return false;    
    }
    
    //Create Window
    if( SDL_SetVideoMode( SCREEN_WIDTH, SCREEN_HEIGHT, SCREEN_BPP, SDL_OPENGL ) == NULL )
    {
        return false;
    }
    
    //Initialize OpenGL
    if( initGL() == false )
    {
        return false;    
    }
    
    //Set caption
    SDL_WM_SetCaption( "OpenGL Test", NULL );
    
    return true;    
}
</div>

            <div class="tutText">
            Here is our init() function.<br>
            <br>
            First we initialize SDL as we always do. Then we create our OpenGL window with an OpenGL context. When we want to use OpenGL we pass the SDL_OPENGL flag to SDL_SetVideoMode()
            instead of SDL_SWSURFACE. Now the window will use OpenGL's hardware accelerated rendering instead of SDL's software rendering. This also means we can't use SDL rendering calls
            (like SDL_Flip()) to draw to the screen.<br>
            <br>
            Then we call our initGL() function (which we'll go over in a second) to initialize OpenGL and lastly we set the window caption.
            </div>

<div class="tutCode">bool initGL()
{
    //Initialize Projection Matrix
    glMatrixMode( GL_PROJECTION );
    glLoadIdentity();

    //Initialize Modelview Matrix
    glMatrixMode( GL_MODELVIEW );
    glLoadIdentity();

    //Initialize clear color
    glClearColor( 0.f, 0.f, 0.f, 1.f );

    //Check for error
    GLenum error = glGetError();
    if( error != GL_NO_ERROR )
    {
        printf( "Error initializing OpenGL! %s\n", gluErrorString( error ) );
        return false;
    }

    return true;
}
</div>

            <div class="tutText">
            Here we have some actual OpenGL calls.<br>
            <br>
            We do our post OpenGL window/context creation initialization. All we do here is initialize the OpenGL matrices and initialize the clear color. If there's an error,
            we report it using gluErrorString().
            </div>

<div class="tutCode">void handleKeys( unsigned char key, int x, int y )
{
    //Toggle quad
    if( key == 'q' )
    {
        renderQuad = !renderQuad;
    }
}
</div>

            <div class="tutText">
            This handleKeys() function takes in the ASCII value of a key press and the current mouse position (which we're not using here).<br>
            <br>
            All this function does is toggle a bool flag when the q key is pressed.
            </div>

<div class="tutCode">void update()
{

}

void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Render quad
    if( renderQuad == true )
    {
        glBegin( GL_QUADS );
            glVertex2f( -0.5f, -0.5f );
            glVertex2f(  0.5f, -0.5f );
            glVertex2f(  0.5f,  0.5f );
            glVertex2f( -0.5f,  0.5f );
        glEnd();
    }

    //Update screen
    SDL_GL_SwapBuffers();
}
</div>

            <div class="tutText">
            Here are the update() and render() functions that represent the update and render portions of the game loop. As you can see, the update() function is just there for the sake of
            representing the update portion of the game loop.<br>
            <br>
            Our render function is much more interesting. It clears the color buffer using glClear() then renders a quad to the screen. We can't use SDL_Flip() update the screen, we need to
            call SDL_GL_SwapBuffers() to update a SDL/OpenGL window.
            </div>

<div class="tutCode">        //While there are events to handle
        while( SDL_PollEvent( &event ) )
        {
            if( event.type == SDL_QUIT )
            {
                quit = true;
            }
            else if( event.type == SDL_KEYDOWN )
            {
                //Handle keypress with current mouse position
                int x = 0, y = 0;
                SDL_GetMouseState( &x, &y );
                handleKeys( event.key.keysym.unicode, x, y );
            }
        }

        //Run frame update
        update();

        //Render frame
        render();
        
        //Cap the frame rate
        if( fps.get_ticks() < 1000 / FRAMES_PER_SECOND )
        {
            SDL_Delay( ( 1000 / FRAMES_PER_SECOND ) - fps.get_ticks() );
        }
</div>

            <div class="tutText">
            Here's our main loop.<br>
            <br>
            First we handle events and pass in the unicode value to our handleKeys() function. Then we run the update() and render() functions to complete the main loop.
            </div>

            <div class="tutText">
            For those of you who have never used OpenGL, a lot of this probably went over your head. For the most part, this tutorial was designed to show people how to use SDL with
            OpenGL as opposed to teaching them how to use OpenGL. If you want to learn to use OpenGL check out the OpenGL tutorial set on this site.<br>
            <br>
            The OpenGL tutorial set uses freeGLUT. Not necessarily because it's better (it's not), but because freeGLUT supports context controls in the current stable release.
            SDL 2.0 will support context control but as of the the last update of this tutorial it's not officially released yet. With this tutorial, you should be able to easily
            port the freeGLUT based OpenGL applications to SDL.<br>
            <br>
            A word of caution to beginners: there's a reason this tutorial set uses OpenGL. OpenGL is much more powerful, but it's significantly more difficult to use. It takes 8
            tutorial to get the same result this tutorial set gets in 1 tutorial. I recommend making games with a simpler APIs like SDL first and then moving on APIs like OpenGL.<br>
            <br>
            If you do think you're ready, click the OpenGL tutorials link and dive in =)
            </div>

            <div class="tutFooter">
            Download the media and source code for this tutorial <a class="tutLink" href="lesson36.zip">here</a>.<br>
            <br>
            Make sure to read readme.txt to see what you need to link against.<br>
            <br>
            <a class="leftNav" href="../lesson35/index.php">Previous Tutorial</a><a class="rightNav" href="../index.php">Tutorial Index</a><br>
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