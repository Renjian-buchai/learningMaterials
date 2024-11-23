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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Texture Pixel Mapping">
<meta name="description" content="Learn to take pixels and turn them into OpenGL textures.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Texture Mapping and Pixel Manipulation</title>

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
    <h1 class="text-center">Texture Mapping and Pixel Manipulation</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Texture Mapping and Pixel Manipulation screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Oct 31st, 2014</b></p>
    
        In this tutorial, we're going to make a checkerboard texture in memory and then map it to a quad to render a 2D image.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">#ifndef LTEXTURE_H
#define LTEXTURE_H

#include "LOpenGL.h"
#include &#060stdio.h&#062

class LTexture
{
    public:
        LTexture();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Initializes member variables
        Side Effects:
         -None
        */

        ~LTexture();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Frees texture
        Side Effects:
         -None
        */

        bool loadTextureFromPixels32( GLuint* pixels, GLuint width, GLuint height );
        /*
        Pre Condition:
         -A valid OpenGL context
        Post Condition:
         -Creates a texture from the given pixels
         -Reports error to console if texture could not be created
        Side Effects:
         -Binds a NULL texture
        */

        void freeTexture();
        /*
        Pre Condition:
         -A valid OpenGL context
        Post Condition:
         -Deletes texture if it exists
         -Sets texture ID to 0
        Side Effects:
         -None
        */

        void render( GLfloat x, GLfloat y );
        /*
        Pre Condition:
         -A valid OpenGL context
         -Active modelview matrix
        Post Condition:
         -Translates to given position and renders textured quad
        Side Effects:
         -Binds member texture ID
        */

        GLuint getTextureID();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Returns texture name/ID
        Side Effects:
         -None
        */

        GLuint textureWidth();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Returns texture width
        Side Effects:
         -None
        */

        GLuint textureHeight();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Returns texture height
        Side Effects:
         -None
        */

    private:
        //Texture name
        GLuint mTextureID;

        //Texture dimensions
        GLuint mTextureWidth;
        GLuint mTextureHeight;
};

#endif
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the header for our LTexture class.<br/>
<br/>
First we have our constructor/destructor. Then we have loadTextureFromPixels32() which will take the pixel data and turn it into a texture. freeTexture() is our routine to
deallocate texture data. render() will take our texture and map it to a quad to render it. Lastly we have getTextureID(), textureWidth(), and textureHeight() to get information
about our texture.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">#include "LTexture.h"

LTexture::LTexture()
{
    //Initialize texture ID
    mTextureID = 0;

    //Initialize texture dimensions
    mTextureWidth = 0;
    mTextureHeight = 0;
}

LTexture::~LTexture()
{
    //Free texture data if needed
    freeTexture();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LTexture.cpp we have our constructor and destructor. Our constructor doesn't do much of anything, just initializes our member variables. Our destuctor just has
freeTexture() do all the work.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">bool LTexture::loadTextureFromPixels32( GLuint* pixels, GLuint width, GLuint height )
{
    //Free texture if it exists
    freeTexture();

    //Get texture dimensions
    mTextureWidth = width;
    mTextureHeight = height;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's our function that turns pixel data into a texture. It takes in a pointer to pixel data and the dimensions of the texture.<br/>
<br/>
Before we start loading the pixel data, we have the remember that it's possible to load pixels twice on the same LTexture, so we free any existing pixel data first to make sure we
are dealing with an empty texture.<br/>
<br/>
After that, we assign the object's dimensions.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">    //Generate texture ID
    glGenTextures( 1, &mTextureID );

    //Bind texture ID
    glBindTexture( GL_TEXTURE_2D, mTextureID );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Next, we call glGenTextures() which ironically doesn't actually generate a texture.<br/>
<br/>
If you paid attention in the LTexture class definition, you would have seen that "mTextureID" is a GLuint (<b>GL u</b>nsigned <b>int</b>eger). What glGenTextures() does is create
a texture name in the form an integer to use as an ID for the texture. With this call to glGenTextures(), we're generating 1 texture ID and putting the data inside of
"mTextureID".<br/>
<br/>
Having generated the texture ID, we bind it using glBindTexture(). With our new texture ID bound as the current texture ID, we can start doing operations on it.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">    //Generate texture
    glTexImage2D( GL_TEXTURE_2D, 0, GL_RGBA, width, height, 0, GL_RGBA, GL_UNSIGNED_BYTE, pixels );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">
With glTexImage2D(), we assign pixels to our texture ID to generate the texture.<br/>
<br/>
What the function arguments mean from left to right:<br/>
<ol>
	<li>GL_TEXTURE_2D - texture target or the type of texture we're assigning the pixels to</li>
	<li>0 - the mipmap level. Don't worry about this for now</li>
	<li>GL_RGBA - the pixel format of how the texture is stored. OpenGL takes this as a suggestion, not an order</li>
	<li>width - texture width</li>
	<li>height - texture height</li>
	<li>0 - texture border width</li>
	<li>GL_RGBA - the format of the pixel data you're assigning</li>
	<li>GL_UNSIGNED_BYTE - the data type for the pixel data you're assigning</li>
	<li>pixels - the pointer address of the pixel data you're assigning</li>
</ol>
<br/>
After this call to glTexImage2D(), our pixel data should now be sitting comfortably in the GPU.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">    //Set texture parameters
    glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_LINEAR );
    glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_LINEAR );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now that the pixels are assigned to the texture, we need to set some attributes of the texture with glTexParameter().<br/>
<br/>
Here we're setting the GL_TEXTURE_MAG_FILTER and GL_TEXTURE_MIN_FILTER which control how the texture is shown when it is magnified and minified respectively. I'll go into more
detail about texture filtering in future tutorials, but for now just know the we're setting both these attributes to GL_LINEAR which gives us nice results.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">    //Unbind texture
    glBindTexture( GL_TEXTURE_2D, NULL );

    //Check for error
    GLenum error = glGetError();
    if( error != GL_NO_ERROR )
    {
        printf( "Error loading texture from %p pixels! %s\n", pixels, gluErrorString( error ) );
        return false;
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After we're done loading our texture, we bind a NULL texture which essentially unbinds our texture. This is important because if we just left our texture bound, when we want to
render plain geometry afterward it would texture with the current texture data because the texture is still bound.<br/>
<br/>
With our texture loaded, we check for error and return.
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

    mTextureWidth = 0;
    mTextureHeight = 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the freeTexture() function which calls glDeleteTextures() on our texture data if any exists.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">void LTexture::render( GLfloat x, GLfloat y )
{
    //If the texture exists
    if( mTextureID != 0 )
    {
        //Remove any previous transformations
        glLoadIdentity();

        //Move to rendering point
        glTranslatef( x, y, 0.f );

        //Set texture ID
        glBindTexture( GL_TEXTURE_2D, mTextureID );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of our rendering function for our texture, we check if a texture even exists. If it does, we move to the rendering position and bind the texture so we can texture our
quad with it.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">        //Render textured quad
        glBegin( GL_QUADS );
            glTexCoord2f( 0.f, 0.f ); glVertex2f(           0.f,            0.f );
            glTexCoord2f( 1.f, 0.f ); glVertex2f( mTextureWidth,            0.f );
            glTexCoord2f( 1.f, 1.f ); glVertex2f( mTextureWidth, mTextureHeight );
            glTexCoord2f( 0.f, 1.f ); glVertex2f(           0.f, mTextureHeight );
        glEnd();
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">With our texture bound, it's time to texture our quad. When we wanted to color our geometry, we called glColor() before each vertex. When we want to texture it, we assign each
vertex a texture coordinate with glTexCoord(). What glTexCoord does is attach a point on your texture to a vertex. So when your quad is rendered, a texture will be mapped to it.<br/>
<br/>
Before we go over how texture coordinates work, I wanted to point out that we're rendering our quad differently this time. Up until now, we've been rendering our quads with the
origin at the center:
<div class="text-center">
<img class="img-fluid" alt="center origin" src="center_origin.png"><br/>
Note: blue dot indicates origin
</div>
<br/>
If you look at our glVertex() call, the quad is now draw with the origin at the top left, the way most 2D pixel based graphics APIs do:
<div class="text-center"><img class="img-fluid" alt="top left origin" src="top_left_origin.png"></div>
<br/>
Now texture coordinates work a little bit differently than vertex coordinates. Instead of using x/y/z coordinates, they use the s axis to represent the horizontal coordinate and
the t axis to represent the vertical texture coordinate. So if this image was a texture, this is how its coordinate system would look:
<div class="text-center"><img class="img-fluid" alt="texture coordinates" src="texture_coordinates.png"></div>
<br/>
As you can also see, each axis goes from 0 to 1. So if you want to map the texture from the left edge, you map s = 0. If you want map to bottom edge, you map t = 1. Even if the
texture is 1024 texels (a texture pixel is called a texel) width, the right edge is still s = 1.<br/>
<br/>
So in the above code, we just map each corner of the texture to each corner of the quad.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">GLuint LTexture::getTextureID()
{
    return mTextureID;
}

GLuint LTexture::textureWidth()
{
    return mTextureWidth;
}

GLuint LTexture::textureHeight()
{
    return mTextureHeight;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Lastly for our LTexture class, we have functions to access our member variables.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.h</div>


<pre class="border my-0 py-3">bool initGL();
/*
Pre Condition:
 -A valid OpenGL context
Post Condition:
 -Initializes viewport, matrices, and clear color
 -Reports to console if there was an OpenGL error
 -Returns false if there was an error in initialization
Side Effects:
 -Sets viewport to the fill rendering area
 -Projection matrix is set to an orthographic matrix
 -Modelview matrix is set to identity matrix
 -Matrix mode is set to modelview
 -Clear color is set to black
 -Texturing is enabled
*/

bool loadMedia();
/*
Pre Condition:
 -A valid OpenGL context
Post Condition:
 -Loads media to use in the program
 -Reports to console if there was an error in loading the media
 -Returns true if the media loaded successfully
Side Effects:
 -None
*/

void update();
/*
Pre Condition:
 -None
Post Condition:
 -Does per frame logic
Side Effects:
 -None
*/

void render();
/*
Pre Condition:
 -A valid OpenGL context
 -Active modelview matrix
Post Condition:
 -Renders the scene
Side Effects:
 -Clears the color buffer
 -Swaps the front/back buffer
*/
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Our LUtil.h has a new addition: the loadMedia() function. This is the function we're going to use to load the pixels for our texture.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//Version: 005

#include "LUtil.h"
#include "LTexture.h"

//Checkerboard texture
LTexture gCheckerBoardTexture;

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

    //Initialize clear color
    glClearColor( 0.f, 0.f, 0.f, 1.f );

    //Enable texturing
    glEnable( GL_TEXTURE_2D );

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


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of our LUtil.cpp file, we declare the LTexture we're going to be rendering.<br/>
<br/>
Our initGL() has something important to note: a call to glEnable() to enable 2D texturing. Make sure not to forget to enable texturing in your program, otherwise none of your
texturing calls will do anything.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Checkerboard pixels
    const int CHECKERBOARD_WIDTH = 128;
    const int CHECKERBOARD_HEIGHT = 128;
    const int CHECKERBOARD_PIXEL_COUNT = CHECKERBOARD_WIDTH * CHECKERBOARD_HEIGHT;
    GLuint checkerBoard[ CHECKERBOARD_PIXEL_COUNT ];
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this tutorial, we want to make a 128x128 checkerboard image. To do that we're going to allocate 128 rows of 128 pixels. So we allocate a GLuint array that's 128*128 in length.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Go through pixels
    for( int i = 0; i < CHECKERBOARD_PIXEL_COUNT; ++i )
    {
        //Get the individual color components
        GLubyte* colors = (GLubyte*)&checkerBoard[ i ];
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">So now we're going to go through the pixels to give them color.<br/>
<br/>
You may be wondering, how is a GLuint a pixel? If you've ever messed with HTML, you know color can be represented with giving a 0-255 value for red, giving a 0-255 value for
green, and giving a 0-255 value for blue. The computer then mixes the red, green, and blue to get you your color.<br/>
<br/>
So colors can be represented with numbers. A GLuint is 32 bits in size. You can represent the numbers 0-255 with an 8 bit unsigned integer. You can get the individual color
components by getting the address of the 32bit integer and treating it like an array of bytes, which the above code does for every pixel.<br/>
<br/>
Oh and some of you may be thinking "RGB is three components, 3 * 8 bits is 24 bits. What are the last 8 bits?". The last 8 bits are Alpha, which control how opaque or transparent a
pixel is. This is why the pixel format for glTexImage2D was GL_RGBA.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">        //If the 5th bit of the x and y offsets of the pixel do not match
        if( i / 128 & 16 ^ i % 128 & 16 )
        {
            //Set pixel to white
            colors[ 0 ] = 0xFF;
            colors[ 1 ] = 0xFF;
            colors[ 2 ] = 0xFF;
            colors[ 3 ] = 0xFF;
        }
        else
        {
            //Set pixel to red
            colors[ 0 ] = 0xFF;
            colors[ 1 ] = 0x00;
            colors[ 2 ] = 0x00;
            colors[ 3 ] = 0xFF;
        }
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Don't worry too much about what's in the if statement. It's just some bitwise mumbo jumbo that creates the checkerboard image. Just know that if it's true it sets the pixel to white
and if it's false it sets it to red.<br/>
<br/>
When we set the pixel to be white, we set all the color components to be FF (which is hex for 255). When we set the pixel to be red, we set the first color component (red) to be 255,
the second color component (green) to be 0, the third color component (blue) to be 0, and the last color component (alpha) to be 255. For alpha, 255 is completely opaque and 0
is completely transparent. 
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Load texture
    if( !gCheckerBoardTexture.loadTextureFromPixels32( checkerBoard, CHECKERBOARD_WIDTH, CHECKERBOARD_HEIGHT ) )
    {
        printf( "Unable to load checkerboard texture!\n" );
        return false;
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After we've gone through all the pixels to make our checkerboard image, we pass the pixels onto the texture to load them. If there was an error, it returns false.<br/>
<br/>
An important note: unless you know otherwise, you should assume the OpenGL implementation you're working on requires that texture width/height be a power of two. So your texture
can be 64x64, or 128x32 but not 256x200. We'll cover how to get around this in future tutorials.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Calculate centered offsets
    GLfloat x = ( SCREEN_WIDTH - gCheckerBoardTexture.textureWidth() ) / 2.f;
    GLfloat y = ( SCREEN_HEIGHT - gCheckerBoardTexture.textureHeight() ) / 2.f;

    //Render checkerboard texture
    gCheckerBoardTexture.render( x, y );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Lastly in our render() function, we render our checkboard texture in the center of the screen.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From main.cpp</div>


<pre class="border my-0 py-3">int main( int argc, char* args[] )
{
    //Initialize FreeGLUT
    glutInit( &argc, args );

    //Create OpenGL 2.1 context
    glutInitContextVersion( 2, 1 );

    //Create Double Buffered Window
    glutInitDisplayMode( GLUT_DOUBLE );
    glutInitWindowSize( SCREEN_WIDTH, SCREEN_HEIGHT );
    glutCreateWindow( "OpenGL" );

    //Do post window/context creation initialization
    if( !initGL() )
    {
        printf( "Unable to initialize graphics library!\n" );
        return 1;
    }

    //Load media
    if( !loadMedia() )
    {
        printf( "Unable to load media!\n" );
        return 2;
    }

    //Set rendering function
    glutDisplayFunc( render );

    //Set main loop
    glutTimerFunc( 1000 / SCREEN_FPS, runMainLoop, 0 );

    //Start GLUT main loop
    glutMainLoop();

    return 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">And in our main() function, we load our media right after our initialization.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="05_texture_mapping_and_pixel_manipulation.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Texture Mapping and Pixel Manipulation">Back to Index</a>


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