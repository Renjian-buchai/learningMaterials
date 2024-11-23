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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac texture clipping">
<meta name="description" content="Learn to clip portions of an OpenGL texture.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Clipping Textures</title>

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
    <h1 class="text-center">Clipping Textures</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Clipping Textures screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        In the last tutorial we just mapped the entire texture. Here we're going to map portions of a texture to render images from a sprite sheet.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFRect.h</div>


<pre class="border my-0 py-3">#include "LOpenGL.h"

struct LFRect
{
    GLfloat x;
    GLfloat y;
    GLfloat w;
    GLfloat h;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the new LFRect.h file, we define a rectangle data type. We'll use this to define the region in the sprite sheet we want to render.<br/>
<br/>
The reason this is called a float rectangle is because you may at some point want an integer rectangle because of floating point errors. 
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">Sample Code</div>


<pre class="border my-0 py-3">float sum = 0.f;
for( int i = 0; i < 10; ++i )
{
    sum += 0.1f;
}

if( sum == 1.f )
{
    printf( "sum is equal to 1\n" );
}
else
{
    printf( "sum is not equal to 1\n" );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">You may be asking "What are floating point errors?". The float data type has limits to what numbers it can represent. Computers can't hold an infinite amount of data, so the a float
can only represent a limited amount of numbers.<br/>
<br/>
For example, this sample code would actually output "sum is not equal to 1". The variable "sum" will actually equal 0.9999something. If you need consistent integer
representation, you may need a integer rectangle.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">        void render( GLfloat x, GLfloat y, LFRect* clip = NULL );
        /*
        Pre Condition:
         -A valid OpenGL context
         -Active modelview matrix
        Post Condition:
         -Translates to given position and renders the texture area mapped to a quad
         -If given texture clip is NULL, the full texture is rendered
        Side Effects:
         -Binds member texture ID
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In LTexture.h, we're going to make modifications to our render() function. It needs to take in a rectangle to define the texture area we want to render.<br/>
<br/>
We also gave it a default argument of NULL, in case we want to render the full texture without defining the area.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">void LTexture::render( GLfloat x, GLfloat y, LFRect* clip )
{
    //If the texture exists
    if( mTextureID != 0 )
    {
        //Remove any previous transformations
        glLoadIdentity();

        //Texture coordinates
        GLfloat texTop = 0.f;
        GLfloat texBottom = 1.f;
        GLfloat texLeft = 0.f;
        GLfloat texRight = 1.f;

        //Vertex coordinates
        GLfloat quadWidth = mTextureWidth;
        GLfloat quadHeight = mTextureHeight;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Near the top of our modified render() function, we set our default texture coordinates and quad width/height for our vertex coordinates.<br/>
<br/>
Since we don't know if this function is going to be rendering the entire or part of the texture, we need variables to calculate the texture/vertex coordinates.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">        //Handle clipping
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
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now if the function gets a clip rectangle, we have to adjust our texture and vertex coordinates accordingly. Vertex coordinates are fairly easy, just get the width/height of the
clip rectangle.<br/>
<br/>
The texture coordinates however are a bit trickier since they go from 0 to 1. Say we want to define the x position of the clip rectangle for the bottom right arrow:
<div class="text-center">
<img class="img-fluid" alt="clip" src="clip.png"><br/>
Note: the position for the clip rextangle is the upper left corner
</div>
<br/>
In pixel coordinates, the x position is 128 on a 256 pixel wide texture. 128/256 is 0.5. So to turn pixel coordinates into texture mapping coordinates, take the position and divide
by the pixel width (or height for the vertical position).
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">        //Move to rendering point
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


    <div class="container border-start border-end border-bottom py-3 mb-3">With our texture coordinates and our sprite dimensions calculated, we render our textured quad.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">#include "LUtil.h"
#include &#060IL/il.h&#062
#include &#060IL/ilu.h&#062
#include "LTexture.h"

//Sprite texture
LTexture gArrowTexture;

//Sprite area
LFRect gArrowClips[ 4 ];
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp, we declare our sprite sheet and clip rectangles.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Set clip rectangles
    gArrowClips[ 0 ].x = 0.f;
    gArrowClips[ 0 ].y = 0.f;
    gArrowClips[ 0 ].w = 128.f;
    gArrowClips[ 0 ].h = 128.f;

    gArrowClips[ 1 ].x = 128.f;
    gArrowClips[ 1 ].y = 0.f;
    gArrowClips[ 1 ].w = 128.f;
    gArrowClips[ 1 ].h = 128.f;

    gArrowClips[ 2 ].x = 0.f;
    gArrowClips[ 2 ].y = 128.f;
    gArrowClips[ 2 ].w = 128.f;
    gArrowClips[ 2 ].h = 128.f;

    gArrowClips[ 3 ].x = 128.f;
    gArrowClips[ 3 ].y = 128.f;
    gArrowClips[ 3 ].w = 128.f;
    gArrowClips[ 3 ].h = 128.f;

    //Load texture
    if( !gArrowTexture.loadTextureFromFile( "07_clipping_textures/arrows.png" ) )
    {
        printf( "Unable to load arrow texture!\n" );
        return false;
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our loadMedia() function, we define our clip rectangles and load our texture.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Render arrows
    gArrowTexture.render( 0.f, 0.f, &gArrowClips[ 0 ] );
    gArrowTexture.render( SCREEN_WIDTH - gArrowClips[ 1 ].w, 0.f, &gArrowClips[ 1 ] );
    gArrowTexture.render( 0.f, SCREEN_HEIGHT - gArrowClips[ 2 ].h, &gArrowClips[ 2 ] );
    gArrowTexture.render( SCREEN_WIDTH - gArrowClips[ 3 ].w, SCREEN_HEIGHT - gArrowClips[ 3 ].h, &gArrowClips[ 3 ] );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally in our render function, we render the individual arrow sprites on each corner of the screen.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="07_clipping_textures.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Clipping Textures">Back to Index</a>


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