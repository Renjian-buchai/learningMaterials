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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac scrolling matrices">
<meta name="description" content="Learn to scroll your scene using matrices.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Scrolling and the Matrix Stack</title>

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
    <h1 class="text-center">Scrolling and the Matrix Stack</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Scrolling and the Matrix Stack screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Dec 21st, 2012</b></p>
    
        When dealing with large environments, you need some sort of camera to define the area you're rendering. Here we'll save transformations to the modelview matrix to
do that.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">#include "LUtil.h"

//Camera position
GLfloat gCameraX = 0.f, gCameraY = 0.f;

bool initGL()
{
    //Set the viewport
    glViewport( 0.f, 0.f, SCREEN_WIDTH, SCREEN_HEIGHT );

    //Initialize Projection Matrix
    glMatrixMode( GL_PROJECTION );
    glLoadIdentity();
    glOrtho( 0.0, SCREEN_WIDTH, SCREEN_HEIGHT, 0.0, 1.0, -1.0 );

    //Initialize Modelview Matrix
    glMatrixMode( GL_MODELVIEW );
    glLoadIdentity();

    //Save the default modelview matrix
    glPushMatrix();

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
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of our LUtil.cpp file, we define x/y coordinates for our camera. The initGL() function is pretty much the same, only now there's a call to glPushMatrix().<br/>
<br/>
In OpenGL 2.1, there's the projection and modelview matrices (along with two others you can learn about in the documentation). Each of these matrix types have a stack associated
with them. You can push a copy of the current matrix onto the stack to save it for later.<br/>
<br/>
In this tutorial, we are going to be applying translation tranformations to the modelview matrix to scroll the environment. This time however, instead of calling glLoadIdentity()
and glOrtho() every time like we did in the Matrices and Coloring Polygons tutorial, we're going to push a copy of initial modelview matrix scrolled to the camera position onto
the stack to save it for when we need to apply transformations to it. It's also considered to be a bad habit to apply camera transformations to the projection matrix as it interferes
with fog and lighting calculations. We only did it in the last tutorial for the sake of simplicity.<br/>
<br/>
Note: the matrix stack isn't infinitely deep. Push too many matrices onto the stack and you'll get GL_STACK_OVERFLOW from glGetError().
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void handleKeys( unsigned char key, int x, int y )
{
    //If the user pressed w/a/s/d, change camera position
    if( key == 'w' )
    {
        gCameraY -= 16.f;
    }
    else if( key == 's' )
    {
        gCameraY += 16.f;
    }
    else if( key == 'a' )
    {
        gCameraX -= 16.f;
    }
    else if( key == 'd' )
    {
        gCameraX += 16.f;
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of our handleKeys() function, we set the camera position for rendering when the user presses w/a/s/d.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Take saved matrix off the stack and reset it
    glMatrixMode( GL_MODELVIEW );
    glPopMatrix();
    glLoadIdentity();

    //Move camera to position
    glTranslatef( -gCameraX, -gCameraY, 0.f );

    //Save default matrix again with camera translation
    glPushMatrix();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Since we changed the camera position when the user pressed a key, we need to change our default camera matrix.<br/>
<br/>
First we pop the old default matrix off the stack into the current matrix with glPopMatrix(). We then load the identity matrix into the current modelview matrix. After that we
translate the modelview matrix by the camera's offsets so everything will render relative to the camera.<br/>
<br/>
Because we took the default matrix off the stack, we need to put our new one back on the top of the stack so we can save it for later.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Pop default matrix onto current matrix
    glMatrixMode( GL_MODELVIEW );
    glPopMatrix();

    //Save default matrix again
    glPushMatrix();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Rather than using glLoadIdentity() to reset the modelview matrix, we'll use glPopMatrix() to load the matrix we saved with the camera translation. Because we need this default
modelview matrix the next frame, we immediately push it back onto the stack to save it for later.<br/>
<br/>
Now that the modelview matrix renders everything relative to the camera, we can start rendering our geometry
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Move to center of the screen
    glTranslatef( SCREEN_WIDTH / 2.f, SCREEN_HEIGHT / 2.f, 0.f );

    //Red quad
    glBegin( GL_QUADS );
        glColor3f( 1.f, 0.f, 0.f );
        glVertex2f( -SCREEN_WIDTH / 4.f, -SCREEN_HEIGHT / 4.f );
        glVertex2f(  SCREEN_WIDTH / 4.f, -SCREEN_HEIGHT / 4.f );
        glVertex2f(  SCREEN_WIDTH / 4.f,  SCREEN_HEIGHT / 4.f );
        glVertex2f( -SCREEN_WIDTH / 4.f,  SCREEN_HEIGHT / 4.f );
    glEnd();

    //Move to the right of the screen
    glTranslatef( SCREEN_WIDTH, 0.f, 0.f );

    //Green quad
    glBegin( GL_QUADS );
        glColor3f( 0.f, 1.f, 0.f );
        glVertex2f( -SCREEN_WIDTH / 4.f, -SCREEN_HEIGHT / 4.f );
        glVertex2f(  SCREEN_WIDTH / 4.f, -SCREEN_HEIGHT / 4.f );
        glVertex2f(  SCREEN_WIDTH / 4.f,  SCREEN_HEIGHT / 4.f );
        glVertex2f( -SCREEN_WIDTH / 4.f,  SCREEN_HEIGHT / 4.f );
    glEnd();

    //Move to the lower right of the screen
    glTranslatef( 0.f, SCREEN_HEIGHT, 0.f );

    //Blue quad
    glBegin( GL_QUADS );
        glColor3f( 0.f, 0.f, 1.f );
        glVertex2f( -SCREEN_WIDTH / 4.f, -SCREEN_HEIGHT / 4.f );
        glVertex2f(  SCREEN_WIDTH / 4.f, -SCREEN_HEIGHT / 4.f );
        glVertex2f(  SCREEN_WIDTH / 4.f,  SCREEN_HEIGHT / 4.f );
        glVertex2f( -SCREEN_WIDTH / 4.f,  SCREEN_HEIGHT / 4.f );
    glEnd();

    //Move below the screen
    glTranslatef( -SCREEN_WIDTH, 0.f, 0.f );

    //Yellow quad
    glBegin( GL_QUADS );
        glColor3f( 1.f, 1.f, 0.f );
        glVertex2f( -SCREEN_WIDTH / 4.f, -SCREEN_HEIGHT / 4.f );
        glVertex2f(  SCREEN_WIDTH / 4.f, -SCREEN_HEIGHT / 4.f );
        glVertex2f(  SCREEN_WIDTH / 4.f,  SCREEN_HEIGHT / 4.f );
        glVertex2f( -SCREEN_WIDTH / 4.f,  SCREEN_HEIGHT / 4.f );
    glEnd();

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we render a scene twice the width/height of the screen. Our geometry never changes position, only the camera changes throughout our demo.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">
    In this tutorial, the only tranformation we applied is translation with glTranslate(). If you want to zoom in/out, you can scale the matrix
using glScale(). If you would like to rotate the camera, you can use glRotate(). If you want to see how these functions work, check out the OpenGL documentation.<br/>
<br/>
Another thing to point out is that it wastes GPU time to render something that isn't even on screen. Testing whether something is on screen is called an Occlusion Test. For 2D, you
can check if an object is on screen if it collides with the bounding box of camera using collision detection.  
<a class="tutLink" href="../../../SDL_tutorials/lesson17/index.php">I have a tutorial written on collision detection using SDL here</a>, and it shouldn't be difficult to implement this in OpenGL.

</div>
                    
                
                    
                        <div class="container border py-3 my-3">

<a href="04_scrolling_and_the_matrix_stack.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Scrolling and the Matrix Stack">Back to Index</a>


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