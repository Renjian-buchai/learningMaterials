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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Bitmap TrueType Font GLSL">
<meta name="description" content="Learn to render a OpenGL Font using OpenGL 3.0 GLSL methods.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - GLSL Font</title>

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
    <h1 class="text-center">GLSL Font</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="GLSL Font screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Oct 19th, 2014</b></p>
    
        Before we used alpha textures to render our fonts, but OpenGL 3.0+ does not support alpha textures. Using some GLSL trickery, we can treat a single color channel
texture as like an alpha texture.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFontProgram2D.glvs</div>


<pre class="border my-0 py-3">//Transformation Matrices
uniform mat4 LProjectionMatrix;
uniform mat4 LModelViewMatrix;

#if __VERSION__ >= 130

//Vertex position attribute
in vec2 LVertexPos2D;

//Texture coordinate attribute
in vec2 LTexCoord;
out vec4 texCoord;

#else

//Vertex position attribute
attribute vec2 LVertexPos2D;

//Texture coordinate attribute
attribute vec2 LTexCoord;
varying vec4 texCoord;

#endif

void main()
{
    //Process texCoord
    texCoord = vec4( LTexCoord.s, LTexCoord.t, 0.0, 1.0 );
    
    //Process vertex
    gl_Position = LProjectionMatrix * LModelViewMatrix * vec4( LVertexPos2D.x, LVertexPos2D.y, 0.0, 1.0 );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Our vertex shader for our GLSL font render is pretty much the same as with the textured polygon program. This makes sense since when we render text we're still rendering textured
quads.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFontProgram2D.glfs</div>


<pre class="border my-0 py-3">//Texture Color
uniform vec4 LTextColor;
uniform sampler2D LTextureUnit;

#if __VERSION__ >= 130

//Texture coordinate
in vec4 texCoord;

//Final color
out vec4 gl_FragColor;

#else

//Texture coordinate
varying vec4 texCoord;

#endif

void main()
{
    //Get red texture color
    vec4 red = texture( LTextureUnit, texCoord.st );
    
    //Set alpha fragment
    gl_FragColor = vec4( 1.0, 1.0, 1.0, red.r ) * LTextColor;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">While alpha textures are not supported, 8bit textures of pure red, green, and blue are. So what we're going to do is load the alpha texture as a red texture, and then in the
fragment shader you see here we'll be using the red component to set the alpha value of the fragment.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFontProgram2D.h</div>


<pre class="border my-0 py-3">        void setTextColor( LColorRGBA color );
        /*
        Pre Condition:
         -Bound LFontProgram2D
        Post Condition:
         -Updates shader program textured polygon color
        Side Effects:
         -None
        */

        void setTextureUnit( GLuint unit );
        /*
        Pre Condition:
         -Bound LFontProgram2D
        Post Condition:
         -Updates shader program multitexture unit
        Side Effects:
         -None
        */

    private:
        //Attribute locations
        GLint mVertexPos2DLocation;
        GLint mTexCoordLocation;

        //Coloring location
        GLint mTextColorLocation;

        //Texture unit location
        GLint mTextureUnitLocation;

        //Projection matrix
        glm::mat4 mProjectionMatrix;
        GLint mProjectionMatrixLocation;

        //Modelview matrix
        glm::mat4 mModelViewMatrix;
        GLint mModelViewMatrixLocation;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The LFontProgram2D class pretty much functions the same as the textured polygon shader. For the sake of avoiding typos, note that this class has a setTextColor() function as
opposed to a setTextureColor() function.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFontProgram2D.cpp</div>


<pre class="border my-0 py-3">bool LFontProgram2D::loadProgram()
{
    //Generate program
    mProgramID = glCreateProgram();

    //Load vertex shader
    GLuint vertexShader = loadShaderFromFile( "35_glsl_font/LFontProgram2D.glvs", GL_VERTEX_SHADER );

    //Check for errors
    if( vertexShader == 0 )
    {
        glDeleteProgram( mProgramID );
        mProgramID = 0;
        return false;
    }

    //Attach vertex shader to program
    glAttachShader( mProgramID, vertexShader );


    //Create fragment shader
    GLuint fragmentShader = loadShaderFromFile( "35_glsl_font/LFontProgram2D.glfs", GL_FRAGMENT_SHADER );

    //Check for errors
    if( fragmentShader == 0 )
    {
        glDeleteShader( vertexShader );
        glDeleteProgram( mProgramID );
        mProgramID = 0;
        return false;
    }

    //Attach fragment shader to program
    glAttachShader( mProgramID, fragmentShader );

    //Link program
    glLinkProgram( mProgramID );

    //Check for errors
    GLint programSuccess = GL_TRUE;
    glGetProgramiv( mProgramID, GL_LINK_STATUS, &programSuccess );
    if( programSuccess != GL_TRUE )
    {
        printf( "Error linking program %d!\n", mProgramID );
        printProgramLog( mProgramID );
        glDeleteShader( vertexShader );
        glDeleteShader( fragmentShader );
        glDeleteProgram( mProgramID );
        mProgramID = 0;
        return false;
    }

    //Clean up excess shader references
    glDeleteShader( vertexShader );
    glDeleteShader( fragmentShader );

    //Get variable locations
    mVertexPos2DLocation = glGetAttribLocation( mProgramID, "LVertexPos2D" );
    if( mVertexPos2DLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LVertexPos2D" );
    }
    
    mTexCoordLocation = glGetAttribLocation( mProgramID, "LTexCoord" );
    if( mTexCoordLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LTexCoord" );
    }

    mTextColorLocation = glGetUniformLocation( mProgramID, "LTextColor" );
    if( mTextColorLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LTextColor" );
    }

    mTextureUnitLocation = glGetUniformLocation( mProgramID, "LTextureUnit" );
    if( mTextureUnitLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LTextureUnit" );
    }

    mProjectionMatrixLocation = glGetUniformLocation( mProgramID, "LProjectionMatrix" );
    if( mProjectionMatrixLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LProjectionMatrix" );
    }

    mModelViewMatrixLocation = glGetUniformLocation( mProgramID, "LModelViewMatrix" );
    if( mModelViewMatrixLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LModelViewMatrix" );
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As you can see not much has changed. Most of the work is done in the fragment shader.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">    protected:
        static LTexturedPolygonProgram2D* mTexturedPolygonProgram2D;

        GLuint powerOfTwo( GLuint num );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Returns nearest power of two integer that is greater
        Side Effects:
         -None
        */

        void initVBO();
        /*
        Pre Condition:
         -A valid OpenGL context
         -A loaded member texture
        Post Condition:
         -Generates VBO and IBO to use for rendering
        Side Effects:
         -Binds NULL VBO and IBO
        */

        void freeVBO();
        /*
        Pre Condition:
         -A generated VBO
        Post Condition:
         -Frees VBO and IBO
        Side Effects:
         -None
        */

        //Texture name
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


    <div class="container border-start border-end border-bottom py-3 mb-3">On the outside, the LTexture class looks largely the same as before.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">bool LTexture::loadTextureFromFile32( std::string path )
{
    //Texture loading success
    bool textureLoaded = false;

    //Generate and set current image ID
    ILuint imgID = 0;
    ilGenImages( 1, &imgID );
    ilBindImage( imgID );

    //Load image
    ILboolean success = ilLoadImage( path.c_str() );

    //Image loaded successfully
    if( success == IL_TRUE )
    {
        //Convert image to RGBA
        success = ilConvertImage( IL_RGBA, IL_UNSIGNED_BYTE );
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

            //Create texture from file pixels
            textureLoaded = loadTextureFromPixels32( (GLuint*)ilGetData(), imgWidth, imgHeight, texWidth, texHeight );
        }

        //Delete file from memory
        ilDeleteImages( 1, &imgID );

        //Set pixel format
        mPixelFormat = GL_RGBA;
    }

    //Report error
    if( !textureLoaded )
    {
        printf( "Unable to load %s\n", path.c_str() );
    }

    return textureLoaded;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Naturally, RGBA texture loading hasn't changed.
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
        mPixelFormat = GL_RED;
    }

    //Report error
    if( !pixelsLoaded )
    {
        printf( "Unable to load %s\m", path.c_str() );
    }

    return pixelsLoaded;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As you can see, alpha texture loading hasn't changed much either. We just set the pixel format to red as opposed to alpha.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.h</div>


<pre class="border my-0 py-3">//Sprite drawing origin
enum LSpriteOrigin
{
    LSPRITE_ORIGIN_CENTER,
    LSPRITE_ORIGIN_TOP_LEFT,
    LSPRITE_ORIGIN_BOTTOM_LEFT,
    LSPRITE_ORIGIN_TOP_RIGHT,
    LSPRITE_ORIGIN_BOTTOM_RIGHT
};

class LSpriteSheet : public LTexture
{
    public:
        LSpriteSheet();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Initializes buffer ID
        Side Effects:
         -None
        */

        ~LSpriteSheet();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Deallocates sprite sheet data
        Side Effects:
         -None
        */

        int addClipSprite( LFRect& newClip );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Adds clipping rectangle to clip array
         -Returns index of clipping rectangle within clip array
        Side Effects:
         -None
        */

        LFRect getClip( int index );
        /*
        Pre Condition:
         -A valid index
        Post Condition:
         -Returns clipping clipping rectangle at given index
        Side Effects:
         -None
        */

        bool generateDataBuffer( LSpriteOrigin origin = LSPRITE_ORIGIN_CENTER );
        /*
        Pre Condition:
         -A loaded base LTexture
         -Clipping rectangles in clip array
        Post Condition:
         -Generates VBO and IBO to render sprites with
         -Sets given origin for each sprite
         -Returns true on success
         -Reports to console is an error occured
        Side Effects:
         -Member buffers are bound
        */

        void freeSheet();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Deallocates member VBO, IBO, and clip array
        Side Effects:
         -None
        */

        void freeTexture();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Frees sprite sheet and base LTexture
        Side Effects:
         -None
        */

        void renderSprite( int index );
        /*
        Pre Condition:
         -Loaded base LTexture
         -Generated VBO
        Post Condition:
         -Renders sprite at given index
        Side Effects:
         -Base LTexture is bound
         -Member buffers are bound
        */

    protected:
        //Sprite clips
        std::vector&#060LFRect&#062 mClips;

        //VBO data
        GLuint mVertexDataBuffer;
        GLuint* mIndexBuffers;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The LSpriteSheet class is back and on the outside it hasn't changed much.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.cpp</div>


<pre class="border my-0 py-3">void LSpriteSheet::renderSprite( int index )
{
    //Sprite sheet data exists
    if( mVertexDataBuffer != NULL )
    {
        //Set texture
        glBindTexture( GL_TEXTURE_2D, getTextureID() );

        //Enable vertex and texture coordinate arrays
        mTexturedPolygonProgram2D->enableVertexPointer();
        mTexturedPolygonProgram2D->enableTexCoordPointer();

            //Bind vertex data
            glBindBuffer( GL_ARRAY_BUFFER, mVertexDataBuffer );

            //Set texture coordinate data
            mTexturedPolygonProgram2D->setTexCoordPointer( sizeof(LTexturedVertex2D), (GLvoid*)offsetof( LTexturedVertex2D, texCoord ) );

            //Set vertex data
            mTexturedPolygonProgram2D->setVertexPointer( sizeof(LTexturedVertex2D), (GLvoid*)offsetof( LTexturedVertex2D, position ) );

            //Draw quad using vertex data and index data
            glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, mIndexBuffers[ index ] );
            glDrawElements( GL_QUADS, 4, GL_UNSIGNED_INT, NULL );

        //Disable vertex and texture coordinate arrays
        mTexturedPolygonProgram2D->disableVertexPointer();
        mTexturedPolygonProgram2D->disableTexCoordPointer();
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Again since we're doing 100% shader based rendering, the sprite sheet class uses the textured polygon shader. This is easy to do since a LSpriteSheet is an LTexture through
inheritance.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.h</div>


<pre class="border my-0 py-3">        //Class wide program
        static LFontProgram2D* mFontProgram2D;

        //Font TTF library
        static FT_Library mLibrary;

        //Spacing variables
        GLfloat mSpace;
        GLfloat mLineHeight;
        GLfloat mNewLine;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The LFont class now has a class wide shader object it uses.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">//LFont library
FT_Library LFont::mLibrary;

//Class wide program
LFontProgram2D* LFont::mFontProgram2D = NULL;

bool LFont::initFreeType()
{
    //Init FreeType for single threaded applications
    #ifndef __FREEGLUT_H__
        FT_Error error = FT_Init_FreeType( &mLibrary );
        if( error )
        {
            printf( "FreeType error:%X", error );
            return false;
        }
    #endif

    return true;
}

void LFont::setFontProgram2D( LFontProgram2D* fontProgram2D )
{
    //Set rendering program
    mFontProgram2D = fontProgram2D;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">And of course it needs a function to set the class wide object.
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

                //Find left side of character
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

        //Set Top
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


    <div class="container border-start border-end border-bottom py-3 mb-3">Font loading hasn't changed much, which makes sense since shader programs handle rendering.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">void LFont::renderText( GLfloat x, GLfloat y, std::string text, LFRect* area, int align )
{
    //If there is a texture to render from
    if( getTextureID() != 0 )
    {
        //Draw positions
        GLfloat dX = x;
        GLfloat dY = y;

        //If the text needs to be aligned
        if( area != NULL )
        {
            //Correct empty alignment
            if( align == 0 )
            {
                align = LFONT_TEXT_ALIGN_LEFT | LFONT_TEXT_ALIGN_TOP;
            }

            //Handle horizontal alignment
            if( align & LFONT_TEXT_ALIGN_LEFT )
            {
                dX = area->x;
            }
            else if( align & LFONT_TEXT_ALIGN_CENTERED_H )
            {
                dX = area->x + ( area->w - substringWidth( text.c_str() ) ) / 2.f;
            }
            else if( align & LFONT_TEXT_ALIGN_RIGHT )
            {
                dX = area->x + ( area->w - substringWidth( text.c_str() ) );
            }

            //Handle vertical alignment
            if( align & LFONT_TEXT_ALIGN_TOP )
            {
                dY = area->y;
            }
            else if( align & LFONT_TEXT_ALIGN_CENTERED_V )
            {
                dY = area->y + ( area->h - stringHeight( text.c_str() ) ) / 2.f;
            }
            else if( align & LFONT_TEXT_ALIGN_BOTTOM )
            {
                dY = area->y + ( area->h - stringHeight( text.c_str() ) );
            }
        }

        //Move to draw position
        mFontProgram2D->leftMultModelView( glm::translate&#060GLfloat&#062( glm::mat4(), glm::vec3( dX, dY, 0.f ) ) );

        //Set texture
        glBindTexture( GL_TEXTURE_2D, getTextureID() );

        //Enable vertex and texture coordinate arrays
        mFontProgram2D->enableVertexPointer();
        mFontProgram2D->enableTexCoordPointer();

        //Bind vertex data
        glBindBuffer( GL_ARRAY_BUFFER, mVertexDataBuffer );

        //Set texture coordinate data
        mFontProgram2D->setTexCoordPointer( sizeof(LTexturedVertex2D), (GLvoid*)offsetof( LTexturedVertex2D, texCoord ) );

        //Set vertex data
        mFontProgram2D->setVertexPointer( sizeof(LTexturedVertex2D), (GLvoid*)offsetof( LTexturedVertex2D, position ) );

            //Go through string
            for( int i = 0; i < text.length(); ++i )
            {
                //Space
                if( text[ i ] == ' ' )
                {
                    mFontProgram2D->leftMultModelView( glm::translate&#060GLfloat&#062( glm::mat4(), glm::vec3( mSpace, 0.f, 0.f ) ) );
                    mFontProgram2D->updateModelView();

                    dX += mSpace;
                }
                //Newline
                else if( text[ i ] == '\n' )
                {
                    //Handle horizontal alignment
                    GLfloat targetX = x;
                    if( area != NULL )
                    {
                        if( align & LFONT_TEXT_ALIGN_LEFT )
                        {
                            targetX = area->x;
                        }
                        else if( align & LFONT_TEXT_ALIGN_CENTERED_H )
                        {
                            targetX = area->x + ( area->w - substringWidth( &text.c_str()[ i + 1 ] ) ) / 2.f;
                        }
                        else if( align & LFONT_TEXT_ALIGN_RIGHT )
                        {
                            targetX = area->x + ( area->w - substringWidth( &text.c_str()[ i + 1 ] ) );
                        }
                    }

                    //Move to target point
                    mFontProgram2D->leftMultModelView( glm::translate&#060GLfloat&#062( glm::mat4(), glm::vec3( targetX - dX, mNewLine, 0.f ) ) );
                    mFontProgram2D->updateModelView();

                    dY += mNewLine;
                    dX += targetX - dX;
                }
                //Character
                else
                {
                    //Get ASCII
                    GLuint ascii = (unsigned char)text[ i ];

                    //Update position matrix in program
                    mFontProgram2D->updateModelView();

                    //Draw quad using vertex data and index data
                    glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, mIndexBuffers[ ascii ] );
                    glDrawElements( GL_QUADS, 4, GL_UNSIGNED_INT, NULL );

                    //Move over
                    mFontProgram2D->leftMultModelView( glm::translate&#060GLfloat&#062( glm::mat4(), glm::vec3( mClips[ ascii ].w, 0.f, 0.f ) ) );
                    mFontProgram2D->updateModelView();
                    dX += mClips[ ascii ].w;
                }
            }

        //Disable vertex and texture coordinate arrays
        mFontProgram2D->disableVertexPointer();
        mFontProgram2D->disableTexCoordPointer();
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Even in the font rendering function, all were doing is switching from sending the data to the fixed function pipeline to our own shader program.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//Screen dimensions
LFRect gScreenArea = { 0.f, 0.f, SCREEN_WIDTH, SCREEN_HEIGHT };

//Textured polygon shader
LTexturedPolygonProgram2D gTexturedPolygonProgram2D;

//Loaded texture
LTexture gOpenGLTexture;
LColorRGBA gImgColor = { 0.5f, 0.5f, 0.5f, 1.f };

//Font shader
LFontProgram2D gFontProgram2D;

//Loaded font
LFont gFont;
LColorRGBA gTextColor = { 1.f, 0.5f, 1.f, 1.f };
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp, we declare our shader and media objects.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadGP()
{
    //Load textured shader program
    if( !gTexturedPolygonProgram2D.loadProgram() )
    {
        printf( "Unable to load textured polygon program!\n" );
        return false;
    }

    //Bind textured shader program
    gTexturedPolygonProgram2D.bind();

    //Initialize projection
    gTexturedPolygonProgram2D.setProjection( glm::ortho&#060GLfloat&#062( 0.0, SCREEN_WIDTH, SCREEN_HEIGHT, 0.0, 1.0, -1.0 ) );
    gTexturedPolygonProgram2D.updateProjection();

    //Initialize modelview
    gTexturedPolygonProgram2D.setModelView( glm::mat4() );
    gTexturedPolygonProgram2D.updateModelView();

    //Set texture unit
    gTexturedPolygonProgram2D.setTextureUnit( 0 );

    //Set program for texture
    LTexture::setTexturedPolygonProgram2D( &gTexturedPolygonProgram2D );

    //Load font shader program
    if( !gFontProgram2D.loadProgram() )
    {
        printf( "Unable to load font rendering program!\n" );
        return false;
    }

    //Bind font shader program
    gFontProgram2D.bind();

    //Initialize projection
    gFontProgram2D.setProjection( glm::ortho&#060GLfloat&#062( 0.0, SCREEN_WIDTH, SCREEN_HEIGHT, 0.0, 1.0, -1.0 ) );
    gFontProgram2D.updateProjection();

    //Initialize modelview
    gFontProgram2D.setModelView( glm::mat4() );
    gFontProgram2D.updateModelView();

    //Set texture unit
    gFontProgram2D.setTextureUnit( 0 );

    //Set program for font rendering
    LFont::setFontProgram2D( &gFontProgram2D );

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we're loading our two shader programs. Remember that in order to update a program's variables, it has to be currently bound.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Bind texture rendering program
    gTexturedPolygonProgram2D.bind();

    //Reset transformations
    gTexturedPolygonProgram2D.setModelView( glm::mat4() );

    //Render texture centered
    gTexturedPolygonProgram2D.setTextureColor( gImgColor );
    gOpenGLTexture.render( ( SCREEN_WIDTH - gOpenGLTexture.imageWidth() ) / 2.f, ( SCREEN_HEIGHT - gOpenGLTexture.imageHeight() ) / 2.f );

    //Bind font rendering program
    gFontProgram2D.bind();

    //Reset transformations
    gFontProgram2D.setModelView( glm::mat4() );

    //Render text centered
    gFontProgram2D.setTextColor( gTextColor );
    gFont.renderText( 0.f, 0.f, "GLSL Text Rendering!", &gScreenArea, LFONT_TEXT_ALIGN_CENTERED_H | LFONT_TEXT_ALIGN_CENTERED_V );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the render() function we bind the textured polygon shader, set its modelview matrix and then render the texture.<br/>
<br/>
Then we bind the font shader, update its modelview matrix (even though they have the same names in their shaders, they are seperate programs), and render the text.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="35_glsl_font.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#GLSL Font">Back to Index</a>


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