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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Update Texture Mapping">
<meta name="description" content="Learn to update texture pixels.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Updating Textures</title>

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
    <h1 class="text-center">Updating Textures</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Updating Textures screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Dec 31st, 2012</b></p>
    
        After creating a texture, it's possible to retrieve and send data from your existing texture. Here we'll get a circle image, black out its background and make a
diagonal stripe pattern on it.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">    private:
        GLuint powerOfTwo( GLuint num );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Returns nearest power of two integer that is greater
        Side Effects:
         -None
        */

        //Texture name
        GLuint mTextureID;

        //Current pixels
        GLuint* mPixels;

        //Texture dimensions
        GLuint mTextureWidth;
        GLuint mTextureHeight;

        //Unpadded image dimensions
        GLuint mImageWidth;
        GLuint mImageHeight;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The LTexture class has a new member variable "mPixels" to hold the pixel data from the texture that we're going to manipulate.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">        bool lock();
        /*
        Pre Condition:
         -An existing unlocked texture
        Post Condition:
         -Gets member pixels from texture data
         -Returns true if texture pixels were retrieved
        Side Effects:
         -Binds a NULL texture
        */

        bool unlock();
        /*
        Pre Condition:
         -A locked texture
        Post Condition:
         -Updates texture with member pixels
         -Returns true if texture pixels were updated
        Side Effects:
         -Binds a NULL texture
        */

        GLuint* getPixelData32();
        /*
        Pre Condition:
         -Available member pixels
        Post Condition:
         -Returns member pixels
        Side Effects:
         -None
        */

        GLuint getPixel32( GLuint x, GLuint y );
        /*
        Pre Condition:
         -Available member pixels
        Post Condition:
         -Returns pixel at given position
         -Function will segfault if the texture is not locked.
        Side Effects:
         -None
        */

        void setPixel32( GLuint x, GLuint y, GLuint pixel );
        /*
        Pre Condition:
         -Available member pixels
        Post Condition:
         -Sets pixel at given position
         -Function will segfault if the texture is not locked.
        Side Effects:
         -None
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">And here's the new set of functions that we'll use to manipulate the pixels. The function lock() gets the pixels from the texture so we can do stuff with them, and unlock() sends
the pixel data back to the texture. getPixelData32() gets a pointer to the entire pixel array and getPixel32()/setPixel32() get/set individual pixels.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">LTexture::LTexture()
{
    //Initialize texture ID and pixels
    mTextureID = 0;
    mPixels = NULL;

    //Initialize image dimensions
    mImageWidth = 0;
    mImageHeight = 0;

    //Initialize texture dimensions
    mTextureWidth = 0;
    mTextureHeight = 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As always, you should be initializing your variables but you should especially make sure to initialize pointers.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">void LTexture::freeTexture()
{
    //Delete texture
    if( mTextureID != 0 )
    {
        glDeleteTextures( 1, &mTextureID );
        mTextureID = 0;
    }

    //Delete pixels
    if( mPixels != NULL )
    {
        delete[] mPixels;
        mPixels = NULL;
    }

    mImageWidth = 0;
    mImageHeight = 0;
    mTextureWidth = 0;
    mTextureHeight = 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In freeTexture(), we now also have to check if we have any pixel data that needs to be freed.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">bool LTexture::lock()
{
    //If texture is not locked and a texture exists
    if( mPixels == NULL && mTextureID != 0 )
    {
        //Allocate memory for texture data
        GLuint size = mTextureWidth * mTextureHeight;
        mPixels = new GLuint[ size ];

        //Set current texture
        glBindTexture( GL_TEXTURE_2D, mTextureID );

        //Get pixels
        glGetTexImage( GL_TEXTURE_2D, 0, GL_RGBA, GL_UNSIGNED_BYTE, mPixels );

        //Unbind texture
        glBindTexture( GL_TEXTURE_2D, NULL );

        return true;
    }

    return false;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">To lock the texture for pixel manipulation, we have to check if there are no member pixels (because having member pixels here would mean the texture is already locked) and that a
texture to get pixels from exists. After that, we allocate memory for the pixel data to copy into.<br/>
<br/>
Finally, we bind the texture we want to get the pixel data from, get the data with glGetTexImage(), and unbind the texture.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">bool LTexture::unlock()
{
    //If texture is locked and a texture exists
    if( mPixels != NULL && mTextureID != 0 )
    {
        //Set current texture
        glBindTexture( GL_TEXTURE_2D, mTextureID );

        //Update texture
        glTexSubImage2D( GL_TEXTURE_2D, 0, 0, 0, mTextureWidth, mTextureHeight, GL_RGBA, GL_UNSIGNED_BYTE, mPixels );

        //Delete pixels
        delete[] mPixels;
        mPixels = NULL;

        //Unbind texture
        glBindTexture( GL_TEXTURE_2D, NULL );

        return true;
    }

    return false;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After we're done with our pixel operations, we want to send the pixel data back to the texture. We do this using glTexSubImage2D(). It's more efficent to do this as opposed to just
destroying the texture and making another call to glTexImage2D().<br/>
<br/>
In this piece of code we check if there are member pixels and that there's a texture to update (which means the the texture is locked). After that we bind the texture we want to
update and update the texture pixels with glTexSubImage2D().<br/>
<br/>
You may have noticed that glTexSubImage2D() has more arguments than glGetTexImage() or glTexImage2D(). The 3rd/4th/5th/6th arguments represent the portion of the texture you
want to update by defining the x offset/y offset/width/height of the area you want to update. Here we're updating the entire texture.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">GLuint* LTexture::getPixelData32()
{
    return mPixels;
}

GLuint LTexture::getPixel32( GLuint x, GLuint y )
{
    return mPixels[ y * mTextureWidth + x ];
}

void LTexture::setPixel32( GLuint x, GLuint y, GLuint pixel )
{
    mPixels[ y * mTextureWidth + x ] = pixel;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now here are our functions to perform operations on our pixel data.<br/>
<br/>
You may be wondering what the equation "y * mTextureWidth + x" in getPixel32() and setPixel32() does. The thing to know here is that the image pixels aren't stored like this in
2D:
<div class="text-center"><img class="img-fluid" alt="2d pixels" src="pixels_2D.png"></div>
<br/>
They're stored in a 1 dimensional array like this:
<div class="text-center"><img class="img-fluid" alt="1d pixels" src="pixels_1D.png"></div>
<br/>
So you when you want to get a specific pixel you have to turn the 2D coordinate into a 1D array index. Say we wanted to get pixel number 06 ( which is at x = 2, y = 1) from the 2D
image above. With a texture width of 4, y * mTextureWidth + x get us 1 * 4 + 2 which is equal to array index 6.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Load texture
    if( !gCircleTexture.loadTextureFromFile( "09_updating_textures/circle.png" ) )
    {
        printf( "Unable to load circle texture!\n" );
        return false;
    }

    //Lock texture for modification
    gCircleTexture.lock();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now in loadMedia() we load our texture as usual. Then we lock it so we can mess with the pixels.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Calculate target color
    GLuint targetColor;
    GLubyte* colors = (GLubyte*)&targetColor;
    colors[ 0 ] = 000;
    colors[ 1 ] = 255;
    colors[ 2 ] = 255;
    colors[ 3 ] = 255;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Our circle has a cyan background (r000g255b255a255), that we want to make black. Here we're calculating the pixel value of that color.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Replace target color with transparent black
    GLuint* pixels = gCircleTexture.getPixelData32();
    GLuint pixelCount = gCircleTexture.textureWidth() * gCircleTexture.textureHeight();
    for( int i = 0; i < pixelCount; ++i )
    {
        if( pixels[ i ] == targetColor )
        {
            pixels[ i ] = 0;
        }
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we're going through all the pixels. If any of them are equal to our target color, we set it be transparent black.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Diagonal Lines
    for( int y = 0; y < gCircleTexture.imageHeight(); ++y )
    {
        for( int x = 0; x < gCircleTexture.imageWidth(); ++x )
        {
            if( y % 10 != x % 10 )
            {
                gCircleTexture.setPixel32( x, y, 0 );
            }
        }
    }

    //Update texture
    gCircleTexture.unlock();

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After blacking out the cyan background, we go through the pixels row by row and column by column to black out certain pixels to make a diagonal line pattern.<br/>
<br/>
After doing that, we unlock the texture so it has our updated pixel data.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Render circle
    gCircleTexture.render( ( SCREEN_WIDTH - gCircleTexture.imageWidth() ) / 2.f, ( SCREEN_HEIGHT - gCircleTexture.imageHeight() ) / 2.f );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally, we render our pixel processed circle
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="09_updating_textures.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Updating Textures">Back to Index</a>


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