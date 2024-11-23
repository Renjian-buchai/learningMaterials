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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Texture Image Rotation">
<meta name="description" content="Learn to rotate images with OpenGL.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Rotation</title>

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
    <h1 class="text-center">Rotation</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Rotation screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        We're not actually going to rotate the texture in this tutorial. We're going to rotate the quad it's attached to.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">>void LTexture::render( GLfloat x, GLfloat y, LFRect* clip, LFRect* stretch, GLfloat degrees )
{
    //If the texture exists
    if( mTextureID != 0 )
    {
        //Remove any previous transformations
        glLoadIdentity();

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

        //Handle Stretching
        if( stretch != NULL )
        {
            quadWidth = stretch->w;
            quadHeight = stretch->h;
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The LTexture render() function now takes in another argument which specifies how many degrees you want to rotate your quad.<br/>
<br/>
The first part of our rendering function is largely the same in terms of texture and vertex points.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">        //Move to rendering point
        glTranslatef( x + quadWidth / 2.f, y + quadHeight / 2.f, 0.f );

        //Rotate around rendering point
        glRotatef( degrees, 0.f, 0.f, 1.f );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In this tutorial, we want to rotate the image around its center. We'll rotate the quad using glRotate(), but before we do that we want our rotation point to be the center of the
image.<br/>
<br/>
The function glRotate() will rotate around the current point of translation. In the above code, we translate to the center of the image by adding the given offset plus half the span
of the quad so our total translation looks like this:
<div class="text-center"><img class="img-fluid" alt="origin" src="origin.png"></div>
<br/>
Then after that we rotate the quad using glRotate(). The first argument is how many degrees you want to rotate. The next three arguments are the x/y/z components of the vector you
want to rotate around. Here we're rotating around the positive z axis (which is a vector going out of the screen and towards you). glRotate() expects a normalized vector, but it
should normalize any vector you give it.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">        //Set texture ID
        glBindTexture( GL_TEXTURE_2D, mTextureID );

        //Render textured quad
        glBegin( GL_QUADS );
            glTexCoord2f(  texLeft,    texTop ); glVertex2f( -quadWidth / 2.f, -quadHeight / 2.f );
            glTexCoord2f( texRight,    texTop ); glVertex2f(  quadWidth / 2.f, -quadHeight / 2.f );
            glTexCoord2f( texRight, texBottom ); glVertex2f(  quadWidth / 2.f,  quadHeight / 2.f );
            glTexCoord2f(  texLeft, texBottom ); glVertex2f( -quadWidth / 2.f,  quadHeight / 2.f );
        glEnd();
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Since we're rendering our textured quad with the origin at the center, we're going to have our vertex data sent like this:
<div class="text-center"><img class="img-fluid" alt="center origin" src="center_origin.png"></div>
<br/>
Notice how our texture coordinates are the same. Remember that the only thing we're rotating here is the vertices the texture is getting mapped to.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Load texture
    if( !gRotatingTexture.loadTextureFromFile( "12_rotation/arrow.png" ) )
    {
        printf( "Unable to load arrow texture!\n" );
        return false;
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Our loadMedia() function loads our texture as usual.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void update()
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


    <div class="container border-start border-end border-bottom py-3 mb-3">Now our update() function actually does something!<br/>
<br/>
In this tutorial we want the image to rotate every second. So we add to the angle of rotation 360 degrees / the number of frames per second.<br/>
<br/>
Because our angle value can't go on forever, we cap the value between 0 and 360.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Render arrow
    gRotatingTexture.render( ( SCREEN_WIDTH - gRotatingTexture.imageWidth() ) / 2.f, ( SCREEN_HEIGHT - gRotatingTexture.imageHeight() ) / 2.f, NULL, NULL, gAngle );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Lastly in our render() function we render our rotated texture.<br/>
<br/>
You may be wondering why we didn't do the rotation calculation in render(). In a proper game loop rendering should not update any objects, just render them as they currently are.
If you never call update(), render() should always render the same thing.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="12_rotation.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Rotation">Back to Index</a>


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