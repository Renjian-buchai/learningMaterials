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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Matrix Rotate Scale Texture">
<meta name="description" content="Learn to transform your OpenGL texture mapped quads.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Matrix Transformations</title>

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
    <h1 class="text-center">Matrix Transformations</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Matrix Transformations screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        Up until now, we've done texture rotation and scaling in hackish ways. In this tutorial we'll combine matrix tranformations to transform a textured quad without changing
the original geometry.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">void LTexture::render( GLfloat x, GLfloat y, LFRect* clip )
{
    //If the texture exists
    if( mTextureID != 0 )
    {
        //Texture coordinates
        GLfloat texTop = 0.f;
        GLfloat texBottom = (GLfloat)mImageHeight / (GLfloat)mTextureHeight;
        GLfloat texLeft = 0.f;
        GLfloat texRight = (GLfloat)mImageWidth / (GLfloat)mTextureWidth;

        //Vertex coordinates
        GLfloat quadWidth = mImageWidth;
        GLfloat quadHeight = mImageHeight;

        //Handle clipping
        if( clip != NULL )
        {
            //Texture coordinates
            texLeft = clip->x / mTextureWidth;
            texRight = ( clip->x + clip->w ) / mTextureWidth;
            texTop = clip->y / mTextureHeight;
            texBottom = ( clip->y + clip->h ) / mTextureHeight;

            //Vertex coordinates
            quadWidth = clip->w;
            quadHeight = clip->h;
        }

        //Move to rendering point
        glTranslatef( x, y, 0.f );

        //Set texture ID
        glBindTexture( GL_TEXTURE_2D, mTextureID );

        //Render textured quad
        glBegin( GL_QUADS );
            glTexCoord2f(  texLeft,    texTop ); glVertex2f(       0.f,        0.f );
            glTexCoord2f( texRight,    texTop ); glVertex2f( quadWidth,        0.f );
            glTexCoord2f( texRight, texBottom ); glVertex2f( quadWidth, quadHeight );
            glTexCoord2f(  texLeft, texBottom ); glVertex2f(       0.f, quadHeight );
        glEnd();
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The LTexture render() function has returned to it's pre stretching/rotating state with the origin of the textured quad at the top left. What different this time is that there's no
call to glLoadIdentity() in this version of render(). If we did that, any transformations made before this call would be pointless.<br/>
<br/>
In modern OpenGL applications, vertex data is set in chunks (known as vertex buffers) to the GPU. It's inefficient to send different vertex data over and over again when we're
essentially rendering the same quad that's just transformed in different ways. So it's important to know how to get the results you need without sending redundant vertex data.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//OpenGL texture
LTexture gRotatingTexture;

//Rotation Angle
GLfloat gAngle = 0.f;

//Transformation state
int gTransformationCombo = 0;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp we have a couple global variables. We have our rotating texture, the angle at which it will rotate, and lastly the transformation state.<br/>
<br/>
In this tutorial, we'll be using different sets of matrix transformations. "gTransformationCombo" is just a variable to indicate which one we're using right now.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Load texture
    if( !gRotatingTexture.loadTextureFromFile( "13_matrix_transformations/texture.png" ) )
    {
        printf( "Unable to load OpenGL texture!\n" );
        return false;
    }

    return true;
}

void update()
{
    //Rotate
    gAngle += 360.f / SCREEN_FPS;

    //Cap angle
    if( gAngle > 360.f )
    {
        gAngle -= 360.f;
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As with last time, loadMedia() loads are texture and update() updates our angle of rotation.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Reset transformation
    glLoadIdentity();

    //Render current scene transformation
    switch( gTransformationCombo )
    {
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of our render() we clear the color buffer then load the identity matrix. Remember that the LTexture render() function no longer calls glLoadIdentity(), so now we have to
call it before we render our textured quad.<br/>
<br/>
Then, depending on which transformation combination is selected, we apply some tranformations to the modelview matrix.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">        case 0:
            glTranslatef( SCREEN_WIDTH / 2.f, SCREEN_HEIGHT / 2.f, 0.f );
            glRotatef( gAngle, 0.f, 0.f, 1.f );
            glScalef( 2.f, 2.f, 0.f );
            glTranslatef( gRotatingTexture.imageWidth() / -2.f, gRotatingTexture.imageHeight() / -2.f, 0.f );
        break;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the main transformation of the demo: making the double sized textured quad spin around it's center at the center of the screen. Let's step through this transformation to
see how it works. First here's our untransformed textured quad:<br/>
<div class="text-center"><img class="img-fluid" alt="step0" src="step0.png"></div>
<br/>
First thing we do is translate to the center of the screen:
<div class="text-center"><img class="img-fluid" alt="step1" src="step1.png"><br/>
Since the origin the quad is at the top left, the top left corner is touching the center of the screen.</div>
<br/>
Then we rotate the quad:
<div class="text-center"><img class="img-fluid" alt="step2" src="step2.png"><br/>
Remember: glRotate() rotates around the current point of rotation.
</div>
<br/>
Since we want our quad to be double in size, we scale it using glScale():
<div class="text-center"><img class="img-fluid" alt="step3" src="step3.png"><br/>
The arguments in this call for glScale() say that we want to double it in size along the x and y axis.
</div>
<br/>
We want the quad to rotate around its center, so we translate back half the span of the quad:
<div class="text-center"><img class="img-fluid" alt="step4" src="step4.png"></div>
<br/>
It's important to know when you apply a transformation, it transforms the transformations after it. Since we called glRotate before we translated half the span of the quad, the
translation was also rotated. Since we called glScale to stretch the quad, the translation of half the span of the quad was also scaled.<br/>
<br/>
A side note about order of operations: notice that the negation sign is by the float in gRotatingTexture.imageWidth() / -2.f. The function imageWidth() returns an unsigned int,
which with a negation sign produces undesired results.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">        case 1:
            glTranslatef( SCREEN_WIDTH / 2.f, SCREEN_HEIGHT / 2.f, 0.f );
            glRotatef( gAngle, 0.f, 0.f, 1.f );
            glTranslatef( gRotatingTexture.imageWidth() / -2.f, gRotatingTexture.imageHeight() / -2.f, 0.f );
            glScalef( 2.f, 2.f, 0.f );
        break;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In this combination, we call glScale() last. What this does is when we the translate of half the span of the quad, the translation isn't scaled so the quad rotation is off.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">        case 2:
            glScalef( 2.f, 2.f, 0.f );
            glTranslatef( SCREEN_WIDTH / 2.f, SCREEN_HEIGHT / 2.f, 0.f );
            glRotatef( gAngle, 0.f, 0.f, 1.f );
            glTranslatef( gRotatingTexture.imageWidth() / -2.f, gRotatingTexture.imageHeight() / -2.f, 0.f );
        break;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In this combination we call glScale() first, which causes the quad to spin around its center but since the initial translation to the center of the screen is also scaled, the quad
spins around its center at the bottom right corner of the screen.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">        case 3:
            glTranslatef( SCREEN_WIDTH / 2.f, SCREEN_HEIGHT / 2.f, 0.f );
            glRotatef( gAngle, 0.f, 0.f, 1.f );
            glScalef( 2.f, 2.f, 0.f );
        break;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In this combination, we don't translate of half the span of the quad which causes the quad to spin around its top left corner.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">        case 4:
            glRotatef( gAngle, 0.f, 0.f, 1.f );
            glTranslatef( SCREEN_WIDTH / 2.f, SCREEN_HEIGHT / 2.f, 0.f );
            glScalef( 2.f, 2.f, 0.f );
            glTranslatef( gRotatingTexture.imageWidth() / -2.f, gRotatingTexture.imageHeight() / -2.f, 0.f );
        break;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In this combination we rotate first, which cause the quad to rotate around the top left corner of the screen.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Render texture
    gRotatingTexture.render( 0.f, 0.f );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally after applying our transformations we render our transformed quad.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void handleKeys( unsigned char key, int x, int y )
{
    //If q is pressed
    if( key == 'q' )
    {
        //Reset rotation
        gAngle = 0.f;

        //Cycle through combinations
        gTransformationCombo++;
        if( gTransformationCombo > 4 )
        {
            gTransformationCombo = 0;
        }
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our key handler, when the user presses q we reset the angle of rotation and cycle through the transformation combinations.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="13_matrix_transformations.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Matrix Transformations">Back to Index</a>


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