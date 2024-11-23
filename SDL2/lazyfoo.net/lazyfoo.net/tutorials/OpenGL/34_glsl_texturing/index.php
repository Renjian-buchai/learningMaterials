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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Texture Mapping GLSL">
<meta name="description" content="Learn to render a texture using OpenGL 3.0 GLSL.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - GLSL Texturing</title>

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
    <h1 class="text-center">GLSL Texturing</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="GLSL Texturing screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Oct 19th, 2014</b></p>
    
        So we already know how to handle vertex data in shaders. Now it's time to use our texture to render our geometry.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexturedPolygonProgram2D.glvs</div>


<pre class="border my-0 py-3">//Transformation Matrices
uniform mat4 LProjectionMatrix;
uniform mat4 LModelViewMatrix;

#if __VERSION__ >= 130

//Vertex position attribute
in vec2 LVertexPos2D;

//Texture coordinate attribute
in vec2 LTexCoord;
out vec2 texCoord;

#else

//Vertex position attribute
attribute vec2 LVertexPos2D;

//Texture coordinate attribute
attribute vec2 LTexCoord;
varying vec2 texCoord;

#endif

void main()
{
    //Process texCoord
    texCoord = LTexCoord;
    
    //Process vertex
    gl_Position = LProjectionMatrix * LModelViewMatrix * vec4( LVertexPos2D.x, LVertexPos2D.y, 0.0, 1.0 );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the textured polygon vertex shader, we just want to pass the texture coordinates on to the fragment shader and apply the tranformation matrices to the vertex position.<br/>
<br/>
Texture look up is a fragment operation so you'll be doing the actual texturing in the fragment shader.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexturedPolygonProgram2D.glfs</div>


<pre class="border my-0 py-3">//Texture Color
uniform vec4 LTextureColor;

//Texture Unit
uniform sampler2D LTextureUnit;

#if __VERSION__ >= 130

//Texture coordinate
in vec2 texCoord;

//Final color
out vec4 gl_FragColor;

#else

//Texture coordinate
varying vec2 texCoord;

#endif
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The fragment shader has a texture color (a color that's applied to all the texels), texture coordinates passed in from the vertex shader, an output fragment color, and something new.<br/>
<br/>
A sampler is something we use the ID (in this case) a 2D texture. OpenGL has multitexturing capabilities, but since we're only using the first texture we're just going to use
texture unit 0. 
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexturedPolygonProgram2D.glfs</div>


<pre class="border my-0 py-3">void main()
{
    //Set fragment
    gl_FragColor = texture( LTextureUnit, texCoord ) * LTextureColor;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">To use our texture for rendering, we need to grab a fragment from the texture using the GLSL texture function. The first argument is the sampler ID which will be zero since we're
only using one texture. The second argument is the texture coordinate from where to grab texels to make fragments.<br/>
<br/>
We take the vec4 vector the returned from texture function and multiply it (as a dot product) against the uniform texture color to get the final fragment color.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexturedPolygonProgram2D.h</div>


<pre class="border my-0 py-3">#include "LShaderProgram.h"
#include &#062glm/glm.hpp&#062
#include "LColorRGBA.h"

class LTexturedPolygonProgram2D : public LShaderProgram
{
    public:
        LTexturedPolygonProgram2D();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Initializes variables
        Side Effects:
         -None
        */

        bool loadProgram();
        /*
        Pre Condition:
         -A valid OpenGL context
        Post Condition:
         -Loads textured polygon program
        Side Effects:
         -None
        */

        void setVertexPointer( GLsizei stride, const GLvoid* data );
        /*
        Pre Condition:
         -Bound LTexturedPolygonProgram2D
        Post Condition:
         -Sets vertex position attribute pointer
        Side Effects:
         -None
        */

        void setTexCoordPointer( GLsizei stride, const GLvoid* data );
        /*
        Pre Condition:
         -Bound LTexturedPolygonProgram2D
        Post Condition:
         -Sets texture coordinate attribute pointer
        Side Effects:
         -None
        */

        void enableVertexPointer();
        /*
        Pre Condition:
         -Bound LTexturedPolygonProgram2D
        Post Condition:
         -Enables vertex position attribute
        Side Effects:
         -None
        */

        void disableVertexPointer();
        /*
        Pre Condition:
         -Bound LTexturedPolygonProgram2D
        Post Condition:
         -Disables vertex position attribute
        Side Effects:
         -None
        */

        void enableTexCoordPointer();
        /*
        Pre Condition:
         -Bound LTexturedPolygonProgram2D
        Post Condition:
         -Enables texture coordinate attribute
        Side Effects:
         -None
        */

        void disableTexCoordPointer();
        /*
        Pre Condition:
         -Bound LTexturedPolygonProgram2D
        Post Condition:
         -Enables texture coordinate attribute
        Side Effects:
         -None
        */

        void setProjection( glm::mat4 matrix );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Sets member projection matrix
        Side Effects:
         -None
        */

        void setModelView( glm::mat4 matrix );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Sets member modelview matrix
        Side Effects:
         -None
        */

        void leftMultProjection( glm::mat4 matrix );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Left multiplies member projection matrix
        Side Effects:
         -None
        */

        void leftMultModelView( glm::mat4 matrix );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Left multiplies member modelview matrix
        Side Effects:
         -None
        */

        void updateProjection();
        /*
        Pre Condition:
         -Bound LTexturedPolygonProgram2D
        Post Condition:
         -Updates shader program projection matrix with member projection matrix
        Side Effects:
         -None
        */

        void updateModelView();
        /*
        Pre Condition:
         -Bound LTexturedPolygonProgram2D
        Post Condition:
         -Updates shader program modelview matrix with member modelview matrix
        Side Effects:
         -None
        */

        void setTextureColor( LColorRGBA color );
        /*
        Pre Condition:
         -Bound LTexturedPolygonProgram2D
        Post Condition:
         -Updates shader program textured polygon color
        Side Effects:
         -None
        */

        void setTextureUnit( GLuint unit );
        /*
        Pre Condition:
         -Bound LTexturedPolygonProgram2D
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
        GLint mTextureColorLocation;

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


    <div class="container border-start border-end border-bottom py-3 mb-3">As usual, we also have to create the OpenGL code to interface with the GLSL shader.<br/>
<br/>
Focusing on the variables for now, you notice that we have a vertex position location, texture coordinate location, texture unit location, and matrix locations.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexturedPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">#include "LTexturedPolygonProgram2D.h"
#include &#060glm/gtc/type_ptr.hpp&#062

LTexturedPolygonProgram2D::LTexturedPolygonProgram2D()
{
    mVertexPos2DLocation = 0;
    mTexCoordLocation = 0;

    mProjectionMatrixLocation = 0;
    mModelViewMatrixLocation = 0;
    mTextureColorLocation = 0;
    mTextureUnitLocation = 0;
}

bool LTexturedPolygonProgram2D::loadProgram()
{
    //Generate program
    mProgramID = glCreateProgram();

    //Load vertex shader
    GLuint vertexShader = loadShaderFromFile( "34_glsl_texturing/LTexturedPolygonProgram2D.glvs", GL_VERTEX_SHADER );

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
    GLuint fragmentShader = loadShaderFromFile( "34_glsl_texturing/LTexturedPolygonProgram2D.glfs", GL_FRAGMENT_SHADER );

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

    mTextureColorLocation = glGetUniformLocation( mProgramID, "LTextureColor" );
    if( mTextureColorLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LTextureColor" );
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


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we initialize and load the shader much like we did in our previous shader programs. The thing to look for here is that the sampler2D "LTextureUnit" is a uniform.
This makes sense because we don't change our texture for every individual vertex we render.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexturedPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">void LTexturedPolygonProgram2D::setVertexPointer( GLsizei stride, const GLvoid* data )
{
    glVertexAttribPointer( mVertexPos2DLocation, 2, GL_FLOAT, GL_FALSE, stride, data );
}

void LTexturedPolygonProgram2D::setTexCoordPointer( GLsizei stride, const GLvoid* data )
{
    glVertexAttribPointer( mTexCoordLocation, 2, GL_FLOAT, GL_FALSE, stride, data );
}

void LTexturedPolygonProgram2D::enableVertexPointer()
{
    glEnableVertexAttribArray( mVertexPos2DLocation );
}

void LTexturedPolygonProgram2D::disableVertexPointer()
{
    glDisableVertexAttribArray( mVertexPos2DLocation );
}

void LTexturedPolygonProgram2D::enableTexCoordPointer()
{
    glEnableVertexAttribArray( mTexCoordLocation );
}

void LTexturedPolygonProgram2D::disableTexCoordPointer()
{
    glDisableVertexAttribArray( mTexCoordLocation );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we handle vertex/texture coordinates much in the same way we did with glTexCoordPointer().
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexturedPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">void LTexturedPolygonProgram2D::setProjection( glm::mat4 matrix )
{
    mProjectionMatrix = matrix;
}

void LTexturedPolygonProgram2D::setModelView( glm::mat4 matrix )
{
    mModelViewMatrix = matrix;
}

void LTexturedPolygonProgram2D::leftMultProjection( glm::mat4 matrix )
{
    mProjectionMatrix = matrix * mProjectionMatrix;
}

void LTexturedPolygonProgram2D::leftMultModelView( glm::mat4 matrix )
{
    mModelViewMatrix = matrix * mModelViewMatrix;
}

void LTexturedPolygonProgram2D::updateProjection()
{
    glUniformMatrix4fv( mProjectionMatrixLocation, 1, GL_FALSE, glm::value_ptr( mProjectionMatrix ) );
}

void LTexturedPolygonProgram2D::updateModelView()
{
    glUniformMatrix4fv( mModelViewMatrixLocation, 1, GL_FALSE, glm::value_ptr( mModelViewMatrix ) );
}

void LTexturedPolygonProgram2D::setTextureColor( LColorRGBA color )
{
    glUniform4fv( mTextureColorLocation, 4, (const GLfloat*)&color );
}

void LTexturedPolygonProgram2D::setTextureUnit( GLuint unit )
{
    glUniform1i( mTextureUnitLocation, unit );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Matrix operations are pretty much the same as they were with the previous shader programs.<br/>
<br/>
Notice when we set the texture unit we use glUniform1i() because we're updating a single int in the shader.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">    protected:
        //Rendering program
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


    <div class="container border-start border-end border-bottom py-3 mb-3">We want our texture class to be able to use the textured polygon shader to render, so we gave the class the static member "mTexturedPolygonProgram2D" to point to a global
shader program for all texture objects to use.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">//Initialize class variables
GLenum DEFAULT_TEXTURE_WRAP = GL_REPEAT;
LTexturedPolygonProgram2D* LTexture::mTexturedPolygonProgram2D = NULL;

void LTexture::setTexturedPolygonProgram2D( LTexturedPolygonProgram2D* program )
{
    //Set class rendering program
    mTexturedPolygonProgram2D = program;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the static function that sets the program pointer for us to use in rendering.
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


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's one of our texture loading functions. It hasn't changed because how we load data hasn't changed, only how we're sending the vertex data.
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
        mTexturedPolygonProgram2D->leftMultModelView( glm::translate( glm::vec3( x, y, 0.f ) ) );
        mTexturedPolygonProgram2D->updateModelView();

        //Set vertex data
        LTexturedVertex2D vData[ 4 ];

        //Texture coordinates
        vData[ 0 ].texCoord.s =  texLeft; vData[ 0 ].texCoord.t =    texTop;
        vData[ 1 ].texCoord.s = texRight; vData[ 1 ].texCoord.t =    texTop;
        vData[ 2 ].texCoord.s = texRight; vData[ 2 ].texCoord.t = texBottom;
        vData[ 3 ].texCoord.s =  texLeft; vData[ 3 ].texCoord.t = texBottom;

        //Vertex positions
        vData[ 0 ].position.x =       0.f; vData[ 0 ].position.y =        0.f;
        vData[ 1 ].position.x = quadWidth; vData[ 1 ].position.y =        0.f;
        vData[ 2 ].position.x = quadWidth; vData[ 2 ].position.y = quadHeight;
        vData[ 3 ].position.x =       0.f; vData[ 3 ].position.y = quadHeight;

        //Set texture ID
        glBindTexture( GL_TEXTURE_2D, mTextureID );

        //Enable vertex and texture coordinate arrays
        mTexturedPolygonProgram2D->enableVertexPointer();
        mTexturedPolygonProgram2D->enableTexCoordPointer();

            //Bind vertex buffer
            glBindBuffer( GL_ARRAY_BUFFER, mVBOID );

            //Update vertex buffer data
            glBufferSubData( GL_ARRAY_BUFFER, 0, 4 * sizeof(LTexturedVertex2D), vData );

            //Set texture coordinate data
            mTexturedPolygonProgram2D->setTexCoordPointer( sizeof(LTexturedVertex2D), (GLvoid*)offsetof( LTexturedVertex2D, texCoord ) );

            //Set vertex data
            mTexturedPolygonProgram2D->setVertexPointer( sizeof(LTexturedVertex2D), (GLvoid*)offsetof( LTexturedVertex2D, position ) );

            //Draw quad using vertex data and index data
            glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, mIBOID );
            glDrawElements( GL_TRIANGLE_FAN, 4, GL_UNSIGNED_INT, NULL );

        //Disable vertex and texture coordinate arrays
        mTexturedPolygonProgram2D->disableVertexPointer();
        mTexturedPolygonProgram2D->disableTexCoordPointer();
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As you can see, texture rendering hasn't changed all that much. Instead of sending the data to the old fixed function pipeline, we send it to the shader program in pretty
much the same way.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//Textured polygon shader
LTexturedPolygonProgram2D gTexturedPolygonProgram2D;

//Loaded texture
LTexture gOpenGLTexture;
LColorRGBA gTextureColor = { 1.f, 1.f, 1.f, 0.75f };
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp, we have our shader program object, the texture we're going to load, and the color we're going to give it. We're going to make the rendered textured polygon
semitransparent.
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

    return true;
}

bool loadMedia()
{
    //Load texture
    if( !gOpenGLTexture.loadTextureFromFile32( "34_glsl_texturing/opengl.png" ) )
    {
        printf( "Unable to load texture!\n" );
        return false;
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">We load the shader program and the texture much in the same way as before. This time we set initialize the texture unit to the first one (index 0), and also set the class wide
shader program for the LTexture class.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Reset transformations
    gTexturedPolygonProgram2D.setModelView( glm::mat4() );

    //Render texture centered
    gTexturedPolygonProgram2D.setTextureColor( gTextureColor );
    gOpenGLTexture.render( ( SCREEN_WIDTH - gOpenGLTexture.imageWidth() ) / 2.f, ( SCREEN_HEIGHT - gOpenGLTexture.imageHeight() ) / 2.f );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally, we render our texture with the shader program.<br/>
<br/>
Now, in this tutorial we actually broke our OpenGL 3.0+ compatibility. In OpenGL 3.0+, GL_ALPHA is not a supported texture format, even though GL_RED, GL_GREEN, GL_BLUE are
supported. Fortunately using GLSL shaders there are ways to get around that so you can render fonts.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="34_glsl_texturing.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#GLSL Texturing">Back to Index</a>


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