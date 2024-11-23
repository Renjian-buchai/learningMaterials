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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Framebuffer Objects FBO render to texture">
<meta name="description" content="Learn to render your scene to a taxture using a Frame Buffer Object (FBO).">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Frame Buffer Objects and Render to Texture</title>

<script src="../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
	<a href="../../SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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
    <h1 class="text-center">Frame Buffer Objects and Render to Texture</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Frame Buffer Objects and Render to Texture screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        The buffers on the screen aren't the only ones you can render to. You can also generate additional frame buffer objects, and use them for other rendering operations
like rendering to a texture.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//Rotating texture
LTexture gOpenGLTexture;
GLfloat gAngle = 0.f;

//Framebuffer
GLuint gFBO = NULL;
LTexture gFBOTexture;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this tutorial, we're going to render a scene using a texture and 4 quads and in the background we're going to have a rotating snap shot of the screen on a texture.<br/>
<br/>
First, we have the texture we're going to render and the rotation angle we're going to use. Then we have the variable "gFBO". Just like an VBO and IBO have integer names, an FBO
has an integer name. Lastly, we have the texture the FBO is going to render to.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool initGL()
{
    //Initialize GLEW
    GLenum glewError = glewInit();
    if( glewError != GLEW_OK )
    {
        printf( "Error initializing GLEW! %s\n", glewGetErrorString( glewError ) );
        return false;
    }

    //Make sure OpenGL 2.1 is supported
    if( !GLEW_VERSION_2_1 )
    {
        printf( "OpenGL 2.1 not supported!\n" );
        return false;
    }

    //Set the viewport
    glViewport( 0.f, 0.f, SCREEN_WIDTH, SCREEN_HEIGHT );

    //Initialize Projection Matrix
    glMatrixMode( GL_PROJECTION );
    glLoadIdentity();
    glOrtho( 0.0, SCREEN_WIDTH, SCREEN_HEIGHT, 0.0, 1.0, -1.0 );

    //Initialize Modelview Matrix
    glMatrixMode( GL_MODELVIEW );
    glLoadIdentity();

    //Initialize clear color
    glClearColor( 0.f, 0.f, 0.f, 1.f );

    //Enable texturing
    glEnable( GL_TEXTURE_2D );

    //Set blending
    glEnable( GL_BLEND );
    glDisable( GL_DEPTH_TEST );
    glBlendFunc( GL_SRC_ALPHA, GL_ONE_MINUS_SRC_ALPHA );

    //Generate framebuffer name
    glGenFramebuffers( 1, &gFBO );

    //Check for error
    GLenum error = glGetError();
    if( error != GL_NO_ERROR )
    {
        printf( "Error initializing OpenGL! %s\n", gluErrorString( error ) );
        return false;
    }

    //Initialize DevIL and DevILU
    ilInit();
    iluInit();
    ilClearColour( 255, 255, 255, 000 );

    //Check for error
    ILenum ilError = ilGetError();
    if( ilError != IL_NO_ERROR )
    {
        printf( "Error initializing DevIL! %s\n", iluErrorString( ilError ) );
        return false;
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In initGL(), we generate a FBO name using glGenFramebuffers().<br/>
<br/>
Now we're cheating a little bit here. Frame Buffer Objects didn't become part of the OpenGL core until version 3.0. They were a commonly available extension in version 2.1. As an
extension, the function glGenFramebuffers() is called glGenFramebuffersEXT(). When binding a FBO, you didn't use "GL_FRAMEBUFFER" but "GL_FRAMEBUFFER_EXT". Fortunately GLEW gives
us the non-extension names even with the OpenGL 2.1 context so we don't have to add EXT to all of our function calls.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Load texture
    if( !gOpenGLTexture.loadTextureFromFile32( "27_frame_buffer_objects_and_render_to_texture/opengl.png" ) )
    {
        printf( "Unable to load texture!\n" );
        return false;
    }

    return true;
}

void update()
{
    //Update rotation
    gAngle += 6.f;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In loadMedia() we load the texture and in update() we update the rotation angle.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void renderScene()
{
    //Render texture
    glLoadIdentity();
    glTranslatef( SCREEN_WIDTH / 2.f, SCREEN_HEIGHT / 2.f, 0.f );
    glRotatef( gAngle, 0.f, 0.f, 1.f );
    glTranslatef( gOpenGLTexture.imageWidth() / -2.f, gOpenGLTexture.imageHeight() / -2.f, 0.f );
    glColor3f( 1.f, 1.f, 1.f );
    gOpenGLTexture.render( 0.f, 0.f );

    //Unbind texture for geometry
    glBindTexture( GL_TEXTURE_2D, NULL );

    //Red quad
    glLoadIdentity();
    glTranslatef( SCREEN_WIDTH * 1.f / 4.f, SCREEN_HEIGHT * 1.f / 4.f, 0.f );
    glRotatef( gAngle, 0.f, 0.f, 1.f );
    glBegin( GL_QUADS );
        glColor3f( 1.f, 0.f, 0.f );
        glVertex2f( -SCREEN_WIDTH / 16.f, -SCREEN_HEIGHT / 16.f );
        glVertex2f(  SCREEN_WIDTH / 16.f, -SCREEN_HEIGHT / 16.f );
        glVertex2f(  SCREEN_WIDTH / 16.f,  SCREEN_HEIGHT / 16.f );
        glVertex2f( -SCREEN_WIDTH / 16.f,  SCREEN_HEIGHT / 16.f );
    glEnd();

    //Green quad
    glLoadIdentity();
    glTranslatef( SCREEN_WIDTH * 3.f / 4.f, SCREEN_HEIGHT * 1.f / 4.f, 0.f );
    glRotatef( gAngle, 0.f, 0.f, 1.f );
    glBegin( GL_QUADS );
        glColor3f( 0.f, 1.f, 0.f );
        glVertex2f( -SCREEN_WIDTH / 16.f, -SCREEN_HEIGHT / 16.f );
        glVertex2f(  SCREEN_WIDTH / 16.f, -SCREEN_HEIGHT / 16.f );
        glVertex2f(  SCREEN_WIDTH / 16.f,  SCREEN_HEIGHT / 16.f );
        glVertex2f( -SCREEN_WIDTH / 16.f,  SCREEN_HEIGHT / 16.f );
    glEnd();

    //Blue quad
    glLoadIdentity();
    glTranslatef( SCREEN_WIDTH * 1.f / 4.f, SCREEN_HEIGHT * 3.f / 4.f, 0.f );
    glRotatef( gAngle, 0.f, 0.f, 1.f );
    glBegin( GL_QUADS );
        glColor3f( 0.f, 0.f, 1.f );
        glVertex2f( -SCREEN_WIDTH / 16.f, -SCREEN_HEIGHT / 16.f );
        glVertex2f(  SCREEN_WIDTH / 16.f, -SCREEN_HEIGHT / 16.f );
        glVertex2f(  SCREEN_WIDTH / 16.f,  SCREEN_HEIGHT / 16.f );
        glVertex2f( -SCREEN_WIDTH / 16.f,  SCREEN_HEIGHT / 16.f );
    glEnd();

    //Yellow quad
    glLoadIdentity();
    glTranslatef( SCREEN_WIDTH * 3.f / 4.f, SCREEN_HEIGHT * 3.f / 4.f, 0.f );
    glRotatef( gAngle, 0.f, 0.f, 1.f );
    glBegin( GL_QUADS );
        glColor3f( 1.f, 1.f, 0.f );
        glVertex2f( -SCREEN_WIDTH / 16.f, -SCREEN_HEIGHT / 16.f );
        glVertex2f(  SCREEN_WIDTH / 16.f, -SCREEN_HEIGHT / 16.f );
        glVertex2f(  SCREEN_WIDTH / 16.f,  SCREEN_HEIGHT / 16.f );
        glVertex2f( -SCREEN_WIDTH / 16.f,  SCREEN_HEIGHT / 16.f );
    glEnd();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now we have a new function called renderScene() which renders the scene in a way that can be used by both the FBO and the screen. The only real difference is renderScene()
doesn't make a call to glutSwapBuffers().<br/>
<br/>
What this function renders is a rotating texture and 4 different colored quads. We'll be rendering this both to the screen and to the FBO.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void handleKeys( unsigned char key, int x, int y )
{
    //If the user presses q
    if( key == 'q' )
    {
        //Bind framebuffer for use
        glBindFramebuffer( GL_FRAMEBUFFER, gFBO );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In this tutorial, we're going to be rendering the to the FBO when the user presses 'q'. We're going to be taking a snapshot of the current scene and remdering to the texture.<br/>
<br/>
First thing we have to do is bind our frame buffer with glBindFramebuffer().
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">        //If FBO texture doesn't exist
        if( gFBOTexture.getTextureID() == 0 )
        {
            //Create it
            gFBOTexture.createPixels32( SCREEN_WIDTH, SCREEN_HEIGHT );
            gFBOTexture.padPixels32();
            gFBOTexture.loadTextureFromPixels32();
        }

        //Bind texture
        glFramebufferTexture2D( GL_FRAMEBUFFER, GL_COLOR_ATTACHMENT0, GL_TEXTURE_2D, gFBOTexture.getTextureID(), 0 );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In order for a FBO to render to a texture, the texture needs to be big enough to hold the screen's content. If "gFBOTexture" doesn't have a texture, we generate one big enough to
hold the screen.<br/>
<br/>
Then we have the FBO use the texture with glFramebufferTexture2D(). This function will render an FBO to the first color attachment "GL_COLOR_ATTACHMENT0" to a 2D texture using
"gFBOTexture".
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">        //Clear framebuffer
        glClear( GL_COLOR_BUFFER_BIT );

        //Render scene to framebuffer
        renderScene();

        //Unbind framebuffer
        glBindFramebuffer( GL_FRAMEBUFFER, NULL );
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">With our FBO bound using our texture, we clear it's color buffer. Remember since "gFBO" is bound, this call to glClear() operates on the FBO not the screen. With the FBO cleared
we render the scene to it. Then we unbind the FBO with glBindFramebuffer() so now our rendering calls will be done to the screen.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color and buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Render FBO texture
    if( gFBOTexture.getTextureID() != 0 )
    {
        glLoadIdentity();
        glTranslatef( SCREEN_WIDTH / 2.f, SCREEN_HEIGHT / 2.f, 0.f );
        glRotatef( -gAngle, 0.f, 0.f, 1.f );
        glTranslatef( gFBOTexture.imageWidth() / -2.f, gFBOTexture.imageHeight() / -2.f, 0.f );
        glColor3f( 1.f, 1.f, 1.f );
        gFBOTexture.render( 0.f, 0.f );
    }

    //Render scene
    renderScene();

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In render(), we clear the screen as usual and render the spinning snap shot of the screen if it exists. Then we render the scene normally on top of it.<br/>
<br/>
If you're wondering why the snap shot doesn't show up in next snap shot, it's because you shouldn't render with a texture you're rendering to.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="27_frame_buffer_objects_and_render_to_texture.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Frame Buffer Objects and Render to Texture">Back to Index</a>


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
	<a href="../../SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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