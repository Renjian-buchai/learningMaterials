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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Repeating Tiling Texture Mapping">
<meta name="description" content="Learn to tile textures in OpenGL.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Repeating Textures</title>

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
    <h1 class="text-center">Repeating Textures</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Repeating Textures screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Oct 4th, 2014</b></p>
    
        In this tutorial we're going to create a scrolling tiling effect by doing some tricks with texture coordinates.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">#include "LTexture.h"
#include &#060IL/il.h&#062
#include &#060IL/ilu.h&#062

GLenum DEFAULT_TEXTURE_WRAP = GL_REPEAT;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In addition to texture filtering, another parameter you can set for your texture is how the textures wraps.<br/>
<br/>
I know I've said in the past that texture coordinates go from 0.0 to 1.0, but this isn't necessarily true. You can give a texture coordinate of 2.0 which will cause the 200% of
texture to get mapped. This means the texture will get mapped twice along that axis.<br/>
<br/>
This assumes you have your texture wrap set to GL_REPEAT. This is the default texture wrap when creating an OpenGL texture, and now we're going to be setting it explicitly. At the
top of LTexture.cpp, we declare our default texture wrap. 
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">bool LTexture::loadTextureFromPixels32( GLuint* pixels, GLuint imgWidth, GLuint imgHeight, GLuint texWidth, GLuint texHeight )
{
    //Free texture if it exists
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

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In all our texture loading functions, we set texture wrap using glTexParameter(). We set texture wrap for both the s texture axis and t texture axis.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//Repeating image
LTexture gRepeatingTexture;

//Texture offset
GLfloat gTexX = 0.f, gTexY = 0.f;

//Texture wrap type
int gTextureWrapType = 0;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp we declare a few global variables, the first of which is the texture we're going to tile.<br/>
<br/>
Secondly there's the texture offsets we're going to use to scroll the texture. Lastly, the "gTextureWrapType" which controls how we wrap our texture.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Load texture
    if( !gRepeatingTexture.loadTextureFromFile( "14_repeating_textures/texture.png" ) )
    {
        printf( "Unable to load repeating texture!\n" );
        return false;
    }

    return true;
}

void update()
{
    //Scroll texture
    gTexX++;
    gTexY++;

    //Cap scrolling
    if( gTexX >= gRepeatingTexture.textureWidth() )
    {
        gTexX = 0.f;
    }
    if( gTexY >= gRepeatingTexture.textureHeight() )
    {
        gTexY = 0.f;
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As usual, loadMedia() loads our texture. This time the function update() updates our texture offset so our texture scrolls. We also cap the scrolling so every time the texture
goes too far, the respective coordinate resets allowing our scrolling to loop.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Calculate texture maxima
    GLfloat textureRight = (GLfloat)SCREEN_WIDTH / (GLfloat)gRepeatingTexture.textureWidth();
    GLfloat textureBottom = (GLfloat)SCREEN_HEIGHT / (GLfloat)gRepeatingTexture.textureHeight();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In render() after we clear the color buffer, we calculate the texture coordinates for the bottom right corner of the quad.<br/>
<br/>
Let's say the texture is 128 pixels wide and the screen is 256 pixels wide. What this would do is calculate the right coordinate as 256 / 128, or 2.0. So the texture would be
mapped 2 times along the x/s axis. Then we do the same for the y/t axis.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Use repeating texture
    glBindTexture( GL_TEXTURE_2D, gRepeatingTexture.getTextureID() );

    //Switch to texture matrix
    glMatrixMode( GL_TEXTURE );

    //Reset transformation
    glLoadIdentity();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now we want to use the texture we loaded so we bind it using glBindTexture(). Then we set the current matrix to be the texture matrix with glMatrixMode(). The texture matrix can
be used to transform texture coordinates much in the same way the modelview matrix can be used to transform vertex coordinates. Here we initialize the texture matrix to the
identity matrix.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Scroll texture
    glTranslatef( gTexX / gRepeatingTexture.textureWidth(), gTexY / gRepeatingTexture.textureHeight(), 0.f );

    //Render
    glBegin( GL_QUADS );
        glTexCoord2f(          0.f,           0.f ); glVertex2f(          0.f,           0.f );
        glTexCoord2f( textureRight,           0.f ); glVertex2f( SCREEN_WIDTH,           0.f );
        glTexCoord2f( textureRight, textureBottom ); glVertex2f( SCREEN_WIDTH, SCREEN_HEIGHT );
        glTexCoord2f(          0.f, textureBottom ); glVertex2f(          0.f, SCREEN_HEIGHT );
    glEnd();

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After initializing the texture matrix, we translate to the texture offset. Remembering that 1 equals one texture length and not one pixel, we divide each texture offset by the
length of the texture.<br/>
<br/>
Then finally we render a quad with the transformed texture coordinates.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void handleKeys( unsigned char key, int x, int y )
{
    //If q is pressed
    if( key == 'q' )
    {
        //Cycle through texture reptetitions
        gTextureWrapType++;
        if( gTextureWrapType >= 2 )
        {
            gTextureWrapType = 0;
        }

        //Set texture repetition
        glBindTexture( GL_TEXTURE_2D, gRepeatingTexture.getTextureID() );
        switch( gTextureWrapType )
        {
            case 0:
                glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, GL_REPEAT );
                glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, GL_REPEAT );
                printf( "%d: GL_REPEAT\n", gTextureWrapType );
            break;

            case 1:
                glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, GL_CLAMP );
                glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, GL_CLAMP );
                printf( "%d: GL_CLAMP\n", gTextureWrapType );
            break;
        }
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally when the user presses q, the texture's wrap toggles between GL_REPEAT and GL_CLAMP. If the texture's wrap is GL_REPEAT, when it encounters a texture coordinate beyond
0.0 and 1.0 it will just continue mapping the texture and repeat. If the texture's wrap is GL_CLAMP, the texture mapping will stop beyond 0.0 and 1.0. 
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="14_repeating_textures.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Repeating Textures">Back to Index</a>


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