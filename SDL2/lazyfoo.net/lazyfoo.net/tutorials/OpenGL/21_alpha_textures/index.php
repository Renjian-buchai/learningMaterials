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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Alpha Texture Blending Transparency">
<meta name="description" content="Learn to use 8bit alpha textures for transparency blending.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Alpha Textures</title>

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
    <h1 class="text-center">Alpha Textures</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Alpha Textures screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        In the Bitmap Font tutorial, we had an RGBA texture but we only cared about how bright each pixel is to use for alpha transparency. To save texture space, we'll add
the ability to render alpha textures that only have an alpha component. Using 8bit pixels will save 75% of the space used by 32bit pixels.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">        //Texture name
        GLuint mTextureID;

        //Current pixels
        GLuint* mPixels32;
        GLubyte* mPixels8;

        //Pixel format
        GLuint mPixelFormat;

        //Texture dimensions
        GLuint mTextureWidth;
        GLuint mTextureHeight;

        //Unpadded image dimensions
        GLuint mImageWidth;
        GLuint mImageHeight;

        //VBO IDs
        GLuint mVBOID;
        GLuint mIBOID;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the LTexture class, "mPixels" has been changes to "mPixels32" to distinguish it from "mPixels8" which is a pointer to 8bit pixels. Notice that "mPixels8" is a GLubyte pointer,
which stands for <b>GL u</b>nsigned <b>b</b>yte.<br/>
<br/>
We also have "mPixelFormat" which keeps track of what kind of pixel data we're using.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">        bool loadTextureFromFile32( std::string path );
        /*
        Pre Condition:
         -A valid OpenGL context
         -Initialized DevIL
        Post Condition:
         -Creates RGBA texture from the given file
         -Pads image to have power-of-two dimensions
         -Reports error to console if texture could not be created
        Side Effects:
         -Binds a NULL texture
        */

        bool loadPixelsFromFile32( std::string path );
        /*
        Pre Condition:
         -Initialized DevIL
        Post Condition:
         -Loads member 32bit pixels from the given file
         -Pads image to have power-of-two dimensions
         -Reports error to console if pixels could not be loaded
        Side Effects:
         -None
        */

        bool loadTextureFromFileWithColorKey32( std::string path, GLubyte r, GLubyte g, GLubyte b, GLubyte a = 000 );
        /*
        Pre Condition:
         -A valid OpenGL context
         -Initialized DevIL
        Post Condition:
         -Creates RGBA texture from the given file
         -Pads image to have power-of-two dimensions
         -Sets given RGBA value to RFFGFFBFFA00 in pixel data
         -If A = 0, only RGB components are compared
         -Reports error to console if texture could not be created
        Side Effects:
         -Binds a NULL texture
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Our texture loading functions have been renamed to specify that they load 32bit pixel data.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">        bool loadPixelsFromFile8( std::string path );
        /*
        Pre Condition:
         -Initialized DevIL
        Post Condition:
         -Loads member 8bit pixels from the given file
         -Pads image to have power-of-two dimensions
         -Reports error to console if pixels could not be loaded
        Side Effects:
         -None
        */

        bool loadTextureFromPixels8();
        /*
        Pre Condition:
         -A valid OpenGL context
         -Valid member pixels
        Post Condition:
         -Creates alpha texture from the 8bit member pixels
         -Deletes member pixels on success
         -Reports error to console if texture could not be created
        Side Effects:
         -Binds a NULL texture
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">We now have 8bit versions of pixel loading and texture generating functions.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">        GLubyte* getPixelData8();
        /*
        Pre Condition:
         -Available 8bit member pixels
        Post Condition:
         -Returns 8bit member pixels
        Side Effects:
         -None
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">We also have an 8bit pixel data accessor.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">        GLubyte getPixel8( GLuint x, GLuint y );
        /*
        Pre Condition:
         -Available 8bit member pixels
        Post Condition:
         -Returns pixel at given position
         -Function will segfault if the texture is not locked.
        Side Effects:
         -None
        */

        void setPixel8( GLuint x, GLuint y, GLubyte pixel );
        /*
        Pre Condition:
         -Available 8bit member pixels
        Post Condition:
         -Sets pixel at given position
         -Function will segfault if the texture is not locked.
        Side Effects:
         -None
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">And of course we have our 8 bit pixel manipulators.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">LTexture::LTexture()
{
    //Initialize texture ID and pixels
    mTextureID = 0;
    mPixels32 = NULL;
    mPixels8 = NULL;
    mPixelFormat = NULL;

    //Initialize image dimensions
    mImageWidth = 0;
    mImageHeight = 0;

    //Initialize texture dimensions
    mTextureWidth = 0;
    mTextureHeight = 0;

    //Initialize VBO
    mVBOID = 0;
    mIBOID = 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As always, never forget to initialize your pointers.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From lTexture.cpp</div>


<pre class="border my-0 py-3">bool LTexture::loadTextureFromPixels32( GLuint* pixels, GLuint imgWidth, GLuint imgHeight, GLuint texWidth, GLuint texHeight )
{
    //Free texture data if needed
    freeTexture();

    //Get image dimensions
    mImageWidth = imgWidth;
    mImageHeight = imgHeight;
    mTextureWidth = texWidth;
    mTextureHeight = texHeight;

    //Generate texture ID
    glGenTextures( 1, &mTextureID );

    //Bind texture ID
    glBindTexture( GL_TEXTURE_2D, mTextureID );

    //Generate texture
    glTexImage2D( GL_TEXTURE_2D, 0, GL_RGBA, mTextureWidth, mTextureHeight, 0, GL_RGBA, GL_UNSIGNED_BYTE, pixels );

    //Set texture parameters
    glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_LINEAR );
    glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_LINEAR );
    glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, DEFAULT_TEXTURE_WRAP );
    glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, DEFAULT_TEXTURE_WRAP );

    //Unbind texture
    glBindTexture( GL_TEXTURE_2D, NULL );

    //Check for error
    GLenum error = glGetError();
    if( error != GL_NO_ERROR )
    {
        printf( "Error loading texture from %p pixels! %s\n", pixels, gluErrorString( error ) );
        return false;
    }

    //Generate VBO
    initVBO();

    //Set pixel format
    mPixelFormat = GL_RGBA;

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">All of our 32bit pixel/texture loading functions (which we're not going to go through individually) now also specify what the pixel format for the data is.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">bool LTexture::loadPixelsFromFile8( std::string path )
{
    //Free texture data if needed
    freeTexture();

    //Texture loading success
    bool pixelsLoaded = false;

    //Generate and set current image ID
    ILuint imgID = 0;
    ilGenImages( 1, &imgID );
    ilBindImage( imgID );

    //Load image
    ILboolean success = ilLoadImage( path.c_str() );

    //Image loaded successfully
    if( success == IL_TRUE )
    {
        //Convert image to grey scale
        success = ilConvertImage( IL_LUMINANCE, IL_UNSIGNED_BYTE );
        if( success == IL_TRUE )
        {
            //Initialize dimensions
            GLuint imgWidth = (GLuint)ilGetInteger( IL_IMAGE_WIDTH );
            GLuint imgHeight = (GLuint)ilGetInteger( IL_IMAGE_HEIGHT );

            //Calculate required texture dimensions
            GLuint texWidth = powerOfTwo( imgWidth );
            GLuint texHeight = powerOfTwo( imgHeight );

            //Texture is the wrong size
            if( imgWidth != texWidth || imgHeight != texHeight )
            {
                //Place image at upper left
                iluImageParameter( ILU_PLACEMENT, ILU_UPPER_LEFT );

                //Resize image
                iluEnlargeCanvas( (int)texWidth, (int)texHeight, 1 );
            }

            //Allocate memory for texture data
            GLuint size = texWidth * texHeight;
            mPixels8 = new GLubyte[ size ];

            //Get image dimensions
            mImageWidth = imgWidth;
            mImageHeight = imgHeight;
            mTextureWidth = texWidth;
            mTextureHeight = texHeight;

            //Copy pixels
            memcpy( mPixels8, ilGetData(), size );
            pixelsLoaded = true;
        }

        //Delete file from memory
        ilDeleteImages( 1, &imgID );

        //Set pixel format
        mPixelFormat = GL_ALPHA;
    }

    //Report error
    if( !pixelsLoaded )
    {
        printf( "Unable to load %s\m", path.c_str() );
    }

    return pixelsLoaded;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The loadPixelsFromFile8() function is largely the same as our old loadPixelsFromFile32() function with a few key differences. It allocates an array of GLubytes (remember we're
dealing with 8bit data here) to the "mPixel8" pointer and sets the pixel format as "GL_ALPHA". When it copies the pixels with memcpy(), it's only one byte per pixel so we don't
multiply the size by four like with did with RGBA data.<br/>
<br/>
What also changes is how DevIL loads the pixel data. Before ilConvertImage() converted the pixel to RGBA. Now it converts the pixels to luminance. Luminance pixels have a single
byte that says how bright they are. Like in the original Bitmap Font tutorial, we're going to use the brightness of the pixels to smooth blend the text.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">bool LTexture::loadTextureFromPixels8()
{
    //Loading flag
    bool success = true;

    //There is loaded pixels
    if( mTextureID == 0 && mPixels8 != NULL )
    {
        //Generate texture ID
        glGenTextures( 1, &mTextureID );

        //Bind texture ID
        glBindTexture( GL_TEXTURE_2D, mTextureID );

        //Generate texture
        glTexImage2D( GL_TEXTURE_2D, 0, GL_ALPHA, mTextureWidth, mTextureHeight, 0, GL_ALPHA, GL_UNSIGNED_BYTE, mPixels8 );

        //Set texture parameters
        glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_LINEAR );
        glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_LINEAR );
        glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, DEFAULT_TEXTURE_WRAP );
        glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, DEFAULT_TEXTURE_WRAP );

        //Unbind texture
        glBindTexture( GL_TEXTURE_2D, NULL );

        //Check for error
        GLenum error = glGetError();
        if( error != GL_NO_ERROR )
        {
            printf( "Error loading texture from %p pixels! %s\n", mPixels8, gluErrorString( error ) );
            success = false;
        }
        else
        {
            //Release pixels
            delete[] mPixels8;
            mPixels8 = NULL;

            //Generate VBO
            initVBO();

            //Set pixel format
            mPixelFormat = GL_ALPHA;
        }
    }
    //Error
    else
    {
        printf( "Cannot load texture from current pixels! " );

        //Texture already exists
        if( mTextureID != 0 )
        {
            printf( "A texture is already loaded!\n" );
        }
        //No pixel loaded
        else if( mPixels8 == NULL )
        {
            printf( "No pixels to create texture from!\n" );
        }
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When creating an alpha texture, you have to set the pixel format as "GL_ALPHA" instead of "GL_RGBA" we sending pixels with glTexImage2D().
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

    //Delete 32bit pixels
    if( mPixels32 != NULL )
    {
        delete[] mPixels32;
        mPixels32 = NULL;
    }

    //Delete 8bit pixels
    if( mPixels8 != NULL )
    {
        delete[] mPixels8;
        mPixels8 = NULL;
    }

    mImageWidth = 0;
    mImageHeight = 0;
    mTextureWidth = 0;
    mTextureHeight = 0;

    //Set pixel format
    mPixelFormat = NULL;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When freeing textures, we have to get rid of 8bit pixel data too.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">bool LTexture::lock()
{
    //If texture is not locked and a texture exists
    if( mPixels32 == NULL && mPixels8 == NULL && mTextureID != 0 )
    {
        //Allocate memory for texture data
        GLuint size = mTextureWidth * mTextureHeight;
        if( mPixelFormat == GL_RGBA )
        {
            mPixels32 = new GLuint[ size ];
        }
        else if( mPixelFormat == GL_ALPHA )
        {
            mPixels8 = new GLubyte[ size ];
        }

        //Set current texture
        glBindTexture( GL_TEXTURE_2D, mTextureID );

        //Get pixels
        glGetTexImage( GL_TEXTURE_2D, 0, mPixelFormat, GL_UNSIGNED_BYTE, mPixels32 );

        //Unbind texture
        glBindTexture( GL_TEXTURE_2D, NULL );

        return true;
    }

    return false;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When locking the texture for updating we make sure that the texture isn't already locked. Then we allocate the proper pixel memory and get the pixel data from the texture. This
time glGetTexImage() takes in the pixel format to get the proper pixels.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">bool LTexture::unlock()
{
    //If texture is locked and a texture exists
    if( ( mPixels32 != NULL || mPixels8 != NULL ) && mTextureID != 0 )
    {
        //Set current texture
        glBindTexture( GL_TEXTURE_2D, mTextureID );

        //Update texture
        void* pixels = ( mPixelFormat == GL_RGBA ) ? (void*)mPixels32 : (void*)mPixels8;
        glTexSubImage2D( GL_TEXTURE_2D, 0, 0, 0, mTextureWidth, mTextureHeight, mPixelFormat, GL_UNSIGNED_BYTE, pixels );

        //Delete pixels
        if( mPixels32 != NULL )
        {
            delete[] mPixels32;
            mPixels32 = NULL;
        }
        if( mPixels8 != NULL )
        {
            delete[] mPixels8;
            mPixels8 = NULL;
        }

        //Unbind texture
        glBindTexture( GL_TEXTURE_2D, NULL );

        return true;
    }

    return false;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When updating the texture, we want to make sure have pixels to update with and a texture to update. Then we bind the texture and select which pixels to send with the ternary
operator.<br/>
<br/>
For those of you unfimiliar with the ternary operator, it's a fancy way to stick an if/else statement in one line. In a nutshell, it works like this:<br/>
(condition) ? return this if true : return this if false.<br/>
<br/>
So if the pixel format is RGBA, get the 32bit pixels and if it's not get the 8bit pixels.<br/>
<br/>
After updating the pixels with glTexSubImage2D(), we deallocate the pixel data and unbind the texture.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">GLuint* LTexture::getPixelData32()
{
    return mPixels32;
}

GLubyte* LTexture::getPixelData8()
{
    return mPixels8;
}

GLuint LTexture::getPixel32( GLuint x, GLuint y )
{
    return mPixels32[ y * mTextureWidth + x ];
}

void LTexture::setPixel32( GLuint x, GLuint y, GLuint pixel )
{
    mPixels32[ y * mTextureWidth + x ] = pixel;
}

GLubyte LTexture::getPixel8( GLuint x, GLuint y )
{
    return mPixels8[ y * mTextureWidth + x ];
}

void LTexture::setPixel8( GLuint x, GLuint y, GLubyte pixel )
{
    mPixels8[ y * mTextureWidth + x ] = pixel;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Our pixel manipulating functions work pretty much the same. The only difference is which pointer they use.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">bool LFont::loadBitmap( std::string path )
{
    //Loading flag
    bool success = true;

    //Background pixel
    const GLubyte BLACK_PIXEL = 0x00;

    //Get rid of the font if it exists
    freeFont();

    //Image pixels loaded
    if( loadPixelsFromFile8( path ) )
    {
        //Get cell dimensions
        GLfloat cellW = imageWidth() / 16.f;
        GLfloat cellH = imageHeight() / 16.f;

        //Get letter top and bottom
        GLuint top = cellH;
        GLuint bottom = 0;
        GLuint aBottom = 0;

        //Current pixel coordinates
        int pX = 0;
        int pY = 0;

        //Base cell offsets
        int bX = 0;
        int bY = 0;

        //Begin parsing bitmap font
        GLuint currentChar = 0;
        LFRect nextClip = { 0.f, 0.f, cellW, cellH };

        //Go through cell rows
        for( unsigned int rows = 0; rows < 16; ++rows )
        {
            //Go through each cell column in the row
            for( unsigned int cols = 0; cols < 16; ++cols )
            {
                //Begin cell parsing

                //Set base offsets
                bX = cellW * cols;
                bY = cellH * rows;

                //Initialize clip
                nextClip.x = cellW * cols;
                nextClip.y = cellH * rows;

                nextClip.w = cellW;
                nextClip.h = cellH;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">With the LTexture class updated to handle 8bit textures, loadBitmap() can use this to save a lot memory when loading bitmap fonts.<br/>
<br/>
The top of the function looks pretty much the same with a few difference. With 8bit luminence pixels, color black is just a 0 byte. Obviously, we also change the pixel loading
function to loadPixelsFromFile8() to load the 8bit pixels.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">                //Find left side of character
                for( int pCol = 0; pCol < cellW; ++pCol )
                {
                    for( int pRow = 0; pRow < cellH; ++pRow )
                    {
                        //Set pixel offset
                        pX = bX + pCol;
                        pY = bY + pRow;

                        //Non-background pixel found
                        if( getPixel8( pX, pY ) != BLACK_PIXEL )
                        {
                            //Set sprite's x offset
                            nextClip.x = pX;

                            //Break the loops
                            pCol = cellW;
                            pRow = cellH;
                        }
                    }
                }

                //Right side
                for( int pCol_w = cellW - 1; pCol_w >= 0; pCol_w-- )
                {
                    for( int pRow_w = 0; pRow_w < cellH; pRow_w++ )
                    {
                        //Set pixel offset
                        pX = bX + pCol_w;
                        pY = bY + pRow_w;

                        //Non-background pixel found
                        if( getPixel8( pX, pY ) != BLACK_PIXEL )
                        {
                            //Set sprite's width
                            nextClip.w = ( pX - nextClip.x ) + 1;

                            //Break the loops
                            pCol_w = -1;
                            pRow_w = cellH;
                        }
                    }
                }

                //Find Top
                for( int pRow = 0; pRow < cellH; ++pRow )
                {
                    for( int pCol = 0; pCol < cellW; ++pCol )
                    {
                        //Set pixel offset
                        pX = bX + pCol;
                        pY = bY + pRow;

                        //Non-background pixel found
                        if( getPixel8( pX, pY ) != BLACK_PIXEL )
                        {
                            //New Top Found
                            if( pRow < top )
                            {
                                top = pRow;
                            }

                            //Break the loops
                            pCol = cellW;
                            pRow = cellH;
                        }
                    }
                }

                //Find Bottom
                for( int pRow_b = cellH - 1; pRow_b >= 0; --pRow_b )
                {
                    for( int pCol_b = 0; pCol_b < cellW; ++pCol_b )
                    {
                        //Set pixel offset
                        pX = bX + pCol_b;
                        pY = bY + pRow_b;

                        //Non-background pixel found
                        if( getPixel8( pX, pY ) != BLACK_PIXEL )
                        {
                            //Set BaseLine
                            if( currentChar == 'A' )
                            {
                                aBottom = pRow_b;
                            }

                            //New bottom Found
                            if( pRow_b > bottom )
                            {
                                bottom = pRow_b;
                            }

                            //Break the loops
                            pCol_b = cellW;
                            pRow_b = -1;
                        }
                    }
                }

                //Go to the next character
                mClips.push_back( nextClip );
                ++currentChar;
            }
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Parsing each of the sprite cells works pretty much the same, only now we're getting and comparing 8bit pixels.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">        //Set Top
        for( int t = 0; t < 256; ++t )
        {
            mClips[ t ].y += top;
            mClips[ t ].h -= top;
        }

        //Create texture from parsed pixels
        if( loadTextureFromPixels8() )
        {
            //Build vertex buffer from sprite sheet data
            if( !generateDataBuffer( LSPRITE_ORIGIN_TOP_LEFT ) )
            {
                printf( "Unable to create vertex buffer for bitmap font!\n" );
                success = false;
            }
        }
        else
        {
            printf( "Unable to create texture from bitmap font pixels!\n" );
            success = false;
        }

        //Set texture wrap
        glBindTexture( GL_TEXTURE_2D, getTextureID() );
        glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, GL_CLAMP_TO_BORDER );
        glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, GL_CLAMP_TO_BORDER );
            
        //Set spacing variables
        mSpace = cellW / 2;
        mNewLine = aBottom - top;
        mLineHeight = bottom - top;
    }
    else
    {
        printf( "Could not load bitmap font image: %s!\n", path.c_str() );
        success = false;
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After parsing all of the cells, the rest of the code should look pretty familiar. The tops of the sprites are set, the texture is loaded (this time in 8bit), generate the VBO data
the same as before, set font texure wrap, and set the spacing variables.<br/>
<br/>
This time we skipped the blending of the pixels since we don't need to blend pixels that are already in alpha format.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">void LFont::renderText( GLfloat x, GLfloat y, std::string text )
{
    //If there is a texture to render from
    if( getTextureID() != 0 )
    {
        //Draw positions
        GLfloat dX = x;
        GLfloat dY = y;

        //Move to draw position
        glTranslatef( x, y, 0.f );

        //Set texture
        glBindTexture( GL_TEXTURE_2D, getTextureID() );

        //Enable vertex and texture coordinate arrays
        glEnableClientState( GL_VERTEX_ARRAY );
        glEnableClientState( GL_TEXTURE_COORD_ARRAY );

        //Bind vertex data
        glBindBuffer( GL_ARRAY_BUFFER, mVertexDataBuffer );

        //Set texture coordinate data
        glTexCoordPointer( 2, GL_FLOAT, sizeof(LVertexData2D), (GLvoid*) offsetof( LVertexData2D, texCoord ) );

        //Set vertex data
        glVertexPointer( 2, GL_FLOAT, sizeof(LVertexData2D), (GLvoid*) offsetof( LVertexData2D, position ) );

            //Go through string
            for( int i = 0; i < text.length(); ++i )
            {
                //Space
                if( text[ i ] == ' ' )
                {
                    glTranslatef( mSpace, 0.f, 0.f );
                    dX += mSpace;
                }
                //Newline
                else if( text[ i ] == '\n' )
                {
                    glTranslatef( x - dX, mNewLine, 0.f );
                    dY += mNewLine;
                    dX += x - dX;
                }
                //Character
                else
                {
                    //Get ASCII
                    GLuint ascii = (unsigned char)text[ i ];

                    //Draw quad using vertex data and index data
                    glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, mIndexBuffers[ ascii ] );
                    glDrawElements( GL_QUADS, 4, GL_UNSIGNED_INT, NULL );

                    //Move over
                    glTranslatef( mClips[ ascii ].w, 0.f, 0.f );
                    dX += mClips[ ascii ].w;
                }
            }

        //Disable vertex and texture coordinate arrays
        glDisableClientState( GL_TEXTURE_COORD_ARRAY );
        glDisableClientState( GL_VERTEX_ARRAY );
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As you can see, the rendering of the text works exactly the same. A different pixel format just means the color is handled a little differently.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Load Font
    if( !gFont.loadBitmap( "21_alpha_textures/lazy_font.png" ) )
    {
        printf( "Unable to load bitmap font!\n" );
        return false;
    }

    return true;
}

void update()
{

}

void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );
    glLoadIdentity();

    //Render green text
    glColor3f( 0.f, 1.f, 0.f );
    gFont.renderText( 0.f, 0.f, "The quick brown fox jumps\nover the lazy dog, again!" );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">From the outside, the bitmap font seems to work exactly the same, even though it uses much less texture memory than it used to.<br/>
<br/>
You may be wondering "If all we have is the alpha value, what are the RGB values?". When using an alpha texture, the RGB values are set to white. This rendering of text will
produce green text much in the same way the bitmap font produced red text in the previous tutorial.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="21_alpha_textures.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Alpha Textures">Back to Index</a>


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