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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Stretch Texture Image">
<meta name="description" content="Learn to stretch and scale images with OpenGL.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Stretching and Filters</title>

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
    <h1 class="text-center">Stretching and Filters</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Stretching and Filters screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        There's nothing that requires us to have our vertex positions to be the same size as our texture. In this tutorial we'll give different quad sizes to stretch our
texture and use filtering to control how our texture looks when stretched.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">        void render( GLfloat x, GLfloat y, LFRect* clip = NULL, LFRect* stretch = NULL );
        /*
        Pre Condition:
         -A valid OpenGL context
         -Active modelview matrix
        Post Condition:
         -Translates to given position and renders the texture area mapped to a quad
         -If given texture clip is NULL, the full image is rendered
         -If a stretch area is given, texture area is scaled to the stretch area size
        Side Effects:
         -Binds member texture ID
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Our render() function now takes in an additional argument, a rectangle to define how much we want to stretch the rendered texture.<br/>
<br/>
We give it a default value of NULL in case we don't want to stretch our texture.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">void LTexture::render( GLfloat x, GLfloat y, LFRect* clip, LFRect* stretch )
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
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of our render() function, our texture coordinates work the same as they did before.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">        //Handle Stretching
        if( stretch != NULL )
        {
            quadWidth = stretch->w;
            quadHeight = stretch->h;
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


    <div class="container border-start border-end border-bottom py-3 mb-3">What we're doing differently is giving different vertex coordinates. If the function has a stretch rectangle, we have our quad dimensions to be equal to the size of the stretch
rectangle. Now when our textured quad renders, it will stretch the texture to fit the new quad size.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//Version: 011

#include "LUtil.h"
#include &#060IL/il.h&#062
#include &#060IL/ilu.h&#062
#include "LTexture.h"

//Stretched texture
LTexture gStretchedTexture;

//Stretch size
LFRect gStretchRect = { 0.f, 0.f, SCREEN_WIDTH, SCREEN_HEIGHT };

//Texture filtering
GLenum gFiltering = GL_LINEAR;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp we declare some global variables. "gStretchedTexture" is a texture that we're going to load that's 160x120 pixels in size. "gStretchRect" is the stretch
rectangle that we're going to use to stretch the texture to the size of the screen.<br/>
<br/>
"gFiltering" will control how our texture is filtered when rendered. The best way to explain how filtering works is through demonstration. We'll get to that in our key handler.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Load and color key texture
    if( !gStretchedTexture.loadTextureFromFile( "11_stretching_and_filters/mini_opengl.png" ) )
    {
        printf( "Unable to load mini texture!\n" );
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

    //Render texture stretched
    gStretchedTexture.render( 0.f, 0.f, NULL, &gStretchRect );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In loadMedia() we load our texture and in render() we stretch it to the size of the screen.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void handleKeys( unsigned char key, int x, int y )
{
    //If q is pressed
    if( key == 'q' )
    {
        //Bind texture for modification
        glBindTexture( GL_TEXTURE_2D, gStretchedTexture.getTextureID() );

        //Toggle linear/nearest filtering
        if( gFiltering != GL_LINEAR )
        {
            glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_LINEAR );
            glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_LINEAR );

            gFiltering = GL_LINEAR;
        }
        else
        {
            glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_NEAREST );
            glTexParameteri( GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_NEAREST );

            gFiltering = GL_NEAREST;
        }

        //Unbind texture
        glBindTexture( GL_TEXTURE_2D, NULL );
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In this tutorial we'll use key presses to toggle our texture filtering.<br/>
<br/>
When the user presses q, the texture we loaded is bound so we can do operations on it. Even though we're outside of the LTexture class, as long as we have the texture ID we can do
operations on the texture.<br/>
<br/>
Then we toggle and set the filtering for the texture. These function calls should look familiar because we call them in our texture loading function. "GL_TEXTURE_MAG_FILTER"
controls how the texture is filtered when the texture is stretched. The default we set when we load the texture is "GL_LINEAR". This means our texture blends the pixels when
stretching it which results in this (on an ATI card):
<div class="text-center"><img class="img-fluid" alt="linear" src="linear.png"></div>
<br/>
When "GL_TEXTURE_MAG_FILTER" is set to "GL_NEAREST", OpenGL just grabs the nearest texel value which results in a grainier look:
<div class="text-center"><img class="img-fluid" alt="nearest" src="nearest.png"></div>
<br/>
Note that we also set "GL_TEXTURE_MIN_FILTER" which controls how the texture is filtered when it's made smaller. "GL_TEXTURE_MAG_FILTER" and "GL_TEXTURE_MIN_FILTER" don't have to
be the same value if you want different filters applied in different situations.<br/>
<br/>
Finally after toggling the filtering, we unbind the texture.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="11_stretching_and_filters.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Stretching and Filters">Back to Index</a>


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