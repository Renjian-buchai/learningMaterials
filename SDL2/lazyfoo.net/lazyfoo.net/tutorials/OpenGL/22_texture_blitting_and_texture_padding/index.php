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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Texture Blitting Padding">
<meta name="description" content="Learn to blit one OpenGL texture onto another.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Texture Blitting and Texture Padding</title>

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
    <h1 class="text-center">Texture Blitting and Texture Padding</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Texture Blitting and Texture Padding screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Oct 4th, 2014</b></p>
    
        Blitting is the process of copying pixels from one image to another. In this tutorial, we're going to two halves of an image and combine them by blitting the
pixel data. We'll also have to manually pad the pixel, since DevIL can't do it for us this time.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">        void createPixels32( GLuint imgWidth, GLuint imgHeight );
        /*
        Pre Condition:
         -A valid OpenGL context
        Post Condition:
         -Frees existing texture data
         -Allocates 32bit pixel data for member pixels
        Side Effects:
         -None
        */

        void copyPixels32( GLuint* pixels, GLuint imgWidth, GLuint imgHeight );
        /*
        Pre Condition:
         -A valid OpenGL context
        Post Condition:
         -Copies given pixel data into member pixels
        Side Effects:
         -None
        */

        void padPixels32();
        /*
        Pre Condition:
         -Valid 32bit member pixels
        Post Condition:
         -Takes current member pixel data and gives it power of two dimensions
        Side Effects:
         -None
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here are some new 32bit functions to do some new pixel operations. createPixels32() creates a blank set of pixels for us to use, copyPixels32() copies a set of external pixels, and
padPixels32() pads the member pixels to be power of two.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">        void createPixels8( GLuint imgWidth, GLuint imgHeight );
        /*
        Pre Condition:
         -A valid OpenGL context
        Post Condition:
         -Frees existing texture data
         -Allocates 8bit pixel data for member pixels
        Side Effects:
         -None
        */

        void copyPixels8( GLubyte* pixels, GLuint imgWidth, GLuint imgHeight );
        /*
        Pre Condition:
         -A valid OpenGL context
        Post Condition:
         -Copies given pixel data into member pixels
        Side Effects:
         -None
        */

        void padPixels8();
        /*
        Pre Condition:
         -Valid 8bit member pixels
        Post Condition:
         -Takes current member pixel data and gives it power of two dimensions
        Side Effects:
         -None
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the 8bit versions of the previously mention functions.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">        void blitPixels32( GLuint x, GLuint y, LTexture& destination );
        /*
        Pre Condition:
         -Available 32bit member and destination pixels
         -Valid blitting coordinates
        Post Condition:
         -Copies member pixels to destination member pixels at given location
         -Function will misbehave if invalid blitting coordinate or image dimensions
         are used
        Side Effects:
         -None
        */

        void blitPixels8( GLuint x, GLuint y, LTexture& destination );
        /*
        Pre Condition:
         -Available 8bit member and destination pixels
         -Valid blitting coordinates
        Post Condition:
         -Copies member pixels to destination member pixels at given location
         -Function will misbehave if invalid blitting coordinate or image dimensions
         are used
        Side Effects:
         -None
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here are the 32bit and 8bit pixel blitting functions. They copy the image from the member pixels onto the destination LTexture's member pixels.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">void LTexture::createPixels32( GLuint imgWidth, GLuint imgHeight )
{
    //Valid dimensions
    if( imgWidth > 0 && imgHeight > 0 )
    {
        //Get rid of any current texture data
        freeTexture();

        //Create pixels
        GLuint size = imgWidth * imgHeight;
        mPixels32 = new GLuint[ size ];

        //Copy pixel data
        mImageWidth = imgWidth;
        mImageHeight = imgHeight;
        mTextureWidth = mImageWidth;
        mTextureHeight = mImageWidth;

        //Set pixel formal
        mPixelFormat = GL_RGBA;
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The function createPixels32() is pretty simple. First it makes sure that a valid set of image dimensions were given. Then it frees any existing texture data because we don't want
to create a conflict between new and previous texture data.<br/>
<br/>
After that, we allocate the pixel data and set the LTexture attributes.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">void LTexture::copyPixels32( GLuint* pixels, GLuint imgWidth, GLuint imgHeight )
{
    //Pixels have valid dimensions
    if( imgWidth > 0 && imgHeight > 0 )
    {
        //Get rid of any current texture data
        freeTexture();

        //Copy pixels
        GLuint size = imgWidth * imgHeight;
        mPixels32 = new GLuint[ size ];
        memcpy( mPixels32, pixels, size * 4 );

        //Copy pixel data
        mImageWidth = imgWidth;
        mImageHeight = imgHeight;
        mTextureWidth = mImageWidth;
        mTextureHeight = mImageWidth;

        //Set pixel format
        mPixelFormat = GL_RGBA;
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">copyPixels32() works similarly to createPixels32() only it does a memcpy() on an external pixel pointer. Since this is RGBA pixel data with 4 bytes per pixel, the size of the
memory being copied is number of pixels times four.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">void LTexture::blitPixels32( GLuint x, GLuint y, LTexture& destination )
{
    //There are pixels to blit
    if( mPixels32 != NULL && destination.mPixels32 != NULL )
    {
        //Copy pixels rows
        GLuint* dPixels = destination.mPixels32;
        GLuint* sPixels = mPixels32;
        for( int i = 0; i < mImageHeight; ++i )
        {
            memcpy( &dPixels[ ( i + y ) * destination.mTextureWidth + x ], &sPixels[ i * mTextureWidth ], mImageWidth * 4 );
        }
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Before we go over padPixels32(), let's go over blitPixels32() and how pixel blitting works at a byte level.<br/>
<br/>
First we make sure there are pixels to blit with. After that we have a call to memcpy() that copies "sPixels" (source pixels) to "dPixels" (destination pixels) row by row.<br/>
<br/>
Now how do the equations in memcpy() work? Let's say we wanted to copy the pixels on the left to the pixels on the right at the bottom right corner:
<div class="text-center"><img class="img-fluid" alt="pixels" src="pixels3.png"> <img class="img-fluid" alt="pixels" src="pixels4.png"></div>
<br/>
We're blitting the pixels in the top left corner so the offset is x = 1, y = 1. For the first iteration of the loop "i" will equal 0. This means for the first loop we'll get:<br/>
dPixels[ ( 0 + 1 ) * 4 + 1 ] and sPixels[ 0 * 3 ]<br/>
<br/>
So the first row of 3 sPixels gets copied starting at dPixels[ 5 ] which is what you would expect.<br/>
<br/>
For the second iteration of the loop i = 1, x = 1, and y = 1. This gives us:<br/>
dPixels[ ( 1 + 1 ) * 4 + 1 ] and sPixels[ 1 * 3 ]<br/>
<br/>
So source pixels starts copying at 3 to destination pixels at 9. I'm sure you could figure out the last row.<br/>
<br/>
Two things to note: 1) Remember that since it's 32bit pixels, we copy imageWidth * 4 bytes per pixels when copying pixel rows. 2) Also it's the texture width not the image width
that we use to calculate how many pixels there are per row.<br/>
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">void LTexture::padPixels32()
{
    //If there are pixels to pad
    if( mPixels32 != NULL )
    {
        //Old texture attributes
        GLuint oTextureWidth = mTextureWidth;
        GLuint oTextureHeight = mTextureHeight;

        //Calculate power of two dimensions
        mTextureWidth = powerOfTwo( mImageWidth );
        mTextureHeight = powerOfTwo( mImageHeight );

        //The bitmap needs to change
        if( mTextureWidth != mImageWidth || mTextureHeight != mImageHeight )
        {
            //Allocate pixels
            GLuint size = mTextureWidth * mTextureHeight;
            GLuint* pixels = new GLuint[ size ];

            //Copy pixels rows
            for( int i = 0; i < mImageHeight; ++i )
            {
                memcpy( &pixels[ i * mTextureWidth ], &mPixels32[ i * oTextureWidth ], mImageWidth * 4 );
            }

            //Change pixels
            delete[] mPixels32;
            mPixels32 = pixels;
        }
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For padPixels32(), all we do is create 32bit pixel data that is power of two, blit the current pixel data onto the new pixel data, delete the old data and swap the pointers.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">void LTexture::createPixels8( GLuint imgWidth, GLuint imgHeight )
{
    //Valid dimensions
    if( imgWidth > 0 && imgHeight > 0 )
    {
        //Get rid of any current texture data
        freeTexture();

        //Create pixels
        GLuint size = imgWidth * imgHeight;
        mPixels8 = new GLubyte[ size ];

        //Copy pixel data
        mImageWidth = imgWidth;
        mImageHeight = imgHeight;
        mTextureWidth = mImageWidth;
        mTextureHeight = mImageWidth;

        //Set pixel format
        mPixelFormat = GL_ALPHA;
    }
}

void LTexture::copyPixels8( GLubyte* pixels, GLuint imgWidth, GLuint imgHeight )
{
    //Pixels have valid dimensions
    if( imgWidth > 0 && imgHeight > 0 )
    {
        //Get rid of any current texture data
        freeTexture();

        //Copy pixels
        GLuint size = imgWidth * imgHeight;
        mPixels8 = new GLubyte[ size ];
        memcpy( mPixels8, pixels, size );

        //Copy pixel data
        mImageWidth = imgWidth;
        mImageHeight = imgHeight;
        mTextureWidth = mImageWidth;
        mTextureHeight = mImageWidth;

        //Set pixel format
        mPixelFormat = GL_ALPHA;
    }
}

void LTexture::padPixels8()
{
    //If there are pixels to pad
    if( mPixels8 != NULL )
    {
        //Old texture attributes
        GLuint oTextureWidth = mTextureWidth;
        GLuint oTextureHeight = mTextureHeight;

        //Calculate power of two dimensions
        mTextureWidth = powerOfTwo( mImageWidth );
        mTextureHeight = powerOfTwo( mImageHeight );

        //The bitmap needs to change
        if( mTextureWidth != mImageWidth || mTextureHeight != mImageHeight )
        {
            //Allocate pixels
            GLuint size = mTextureWidth * mTextureHeight;
            GLubyte* pixels = new GLubyte[ size ];

            //Copy pixels rows
            for( int i = 0; i < mImageHeight; ++i )
            {
                memcpy( &pixels[ i * mTextureWidth ], &mPixels8[ i * oTextureWidth ], mImageWidth );
            }

            //Change pixels
            delete[] mPixels8;
            mPixels8 = pixels;
        }
    }
}

void LTexture::blitPixels8( GLuint x, GLuint y, LTexture& destination )
{
    //There are pixels to blit
    if( mPixels8 != NULL && destination.mPixels8 != NULL )
    {
        //Copy pixels rows
        GLubyte* dPixels = destination.mPixels8;
        GLubyte* sPixels = mPixels8;
        for( int i = 0; i < mImageHeight; ++i )
        {
            memcpy( &dPixels[ ( i + y ) * destination.mTextureWidth + x ], &sPixels[ i * mTextureWidth ], mImageWidth );
        }
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The 8bit versions of these functions work the same except we're using 8bit pointers and memcopy() only copies one byte per pixel.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">//Loaded textures
LTexture gLeft;
LTexture gRight;

//Generated combined texture
LTexture gCombined;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp we declare the two textures we're going to load and the texture we're going to blit them to.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Load left texture
    if( !gLeft.loadPixelsFromFile32( "22_texture_blitting_and_texture_padding/left.png" ) )
    {
        printf( "Unable to load left texture!\n" );
        return false;
    }

    //Load right texture
    if( !gRight.loadPixelsFromFile32( "22_texture_blitting_and_texture_padding/right.png" ) )
    {
        printf( "Unable to load right texture!\n" );
        return false;
    }

    //Create blank pixels
    gCombined.createPixels32( gLeft.imageWidth() + gRight.imageWidth(), gLeft.imageHeight() );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In loadMedia(), we load the two images as pixels and allocate pixel data large enough to hold both of them.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Blit images
    gLeft.blitPixels32( 0, 0, gCombined );
    gRight.blitPixels32( gLeft.imageWidth(), 0, gCombined );

    //Pad and create texture
    gCombined.padPixels32();
    gCombined.loadTextureFromPixels32();

    //Get rid of old textures
    gLeft.freeTexture();
    gRight.freeTexture();

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Then we blit the two images onto the blank pixels, pad the pixels so they're power of two, and create the texture.<br/>
<br/>
With both the images blitted onto a new texture, we free the old images.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );
    glLoadIdentity();

    //Render combined texture
    gCombined.render( ( SCREEN_WIDTH - gCombined.imageWidth() ) / 2.f, ( SCREEN_HEIGHT - gCombined.imageHeight() ) / 2.f );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">And finally, we render the generated texture.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="22_texture_blitting_and_texture_padding.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Texture Blitting and Texture Padding">Back to Index</a>


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