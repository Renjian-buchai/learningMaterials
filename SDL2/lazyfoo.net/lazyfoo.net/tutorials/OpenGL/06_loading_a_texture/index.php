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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Texture Loading DevIL">
<meta name="description" content="Learn to load texture images using DevIL.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Loading a Texture</title>

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
    <h1 class="text-center">Loading a Texture</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Loading a Texture screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Oct 19th, 2014</b></p>
    
        Pixels are pixels whether you get them from a GLuint array or in this case a PNG. With the help of the Developers Image Library AKA DevIL, we're going to get pixel data
from a file and display it on the screen.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <h2>Setting up DevIL</h2>
As I mentioned before, OpenGL has no file loading capabilities. In this tutorial we'll use  <a href="http://openil.sourceforge.net/download.php">DevIL as our image file loader which you can download here</a>.
Windows users will want to download the Windows SDK (again, I'm assuming we're using
32bit binaries for this tutorial). Linux users you can use your package manager or install from source. OS X users you can also install DevIL the classic unix way of
downloading the source and running the 3 commands in the source directory of <code>./configure</code> -> <code>make</code> -> <code>sudo make install</code>.<br/>
<br/>
As with freeGLUT you need to make sure:
<ol>
    <li>Your compiler can find the header files</li>
    <li>Your compiler can find the library files</li>
    <li>You tell the linker to link against the library. In this case we need to link against <b>DevIL</b> and <b>ilu</b></li>
    <li>The library binaries are in a place where the OS can find them</li>
</ol>
<br/>
Since we're going to be loading files in this tutorial, it's important that the folder containing the media for this tutorial is in a place your exectuable can find it.
Usually, the exe looks for files in the same directory it runs in. If you're using Visual Studio and you run your executable from the IDE, it will look for files in
the same directory as your vcxproj file.

</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">#include "LTexture.h"
#include &#060IL/il.h&#062
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LTexture.cpp, we include il.h. DevIL was originally known as OpenIL, and the source files still follow the old naming convention.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">bool LTexture::loadTextureFromFile( std::string path )
{
    //Texture loading success
    bool textureLoaded = false;

    //Generate and set current image ID
    ILuint imgID = 0;
    ilGenImages( 1, &imgID );
    ilBindImage( imgID );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's our new function to load a texture from a file, which takes in the path for the file. At the top of our image loading function, we initialize our texture loading
flag.<br/>
<br/>
The next few lines of code should look familiar. DevIL has a similar state machine design as OpenGL. We declare an integer ID, generate an DevIL image ID and bind it as the
current image.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">    //Load image
    ILboolean success = ilLoadImage( path.c_str() );

    //Image loaded successfully
    if( success == IL_TRUE )
    {
        //Convert image to RGBA
        success = ilConvertImage( IL_RGBA, IL_UNSIGNED_BYTE );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After we bind our DevIL image ID, we load the image using ilLoadImage(). If the image loaded successfully, we call ilConvertImage() on the current loaded image to make sure the
pixel data is in RGBA format.<br/>
<br/>
Note: if you have Unicode enabled, this code is going to give you an error. ilConvertImage() will want wchar_t which are unicode characters. All you have to do is convert the
std::string into a wstring, and then get the wchar_t array from the wstring. You can Google how to convert string into wstrings.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.cpp</div>


<pre class="border my-0 py-3">        if( success == IL_TRUE )
        {
            //Create texture from file pixels
            textureLoaded = loadTextureFromPixels32( (GLuint*)ilGetData(), (GLuint)ilGetInteger( IL_IMAGE_WIDTH ), (GLuint)ilGetInteger( IL_IMAGE_HEIGHT ) );
        }

        //Delete file from memory
        ilDeleteImages( 1, &imgID );
    }

    //Report error
    if( !textureLoaded )
    {
        printf( "Unable to load %s\n", path.c_str() );
    }

    return textureLoaded;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After the image pixels are converted, we simply pass in the pixel data to our loadTextureFromPixels32() function to generate the texture. The function ilGetData() gets the pixel
data from the current DevIL image, and we use ilGetInteger() to get the current DevIL image width/height.<br/>
<br/>
With our texture image loaded into OpenGL memory, we delete it from DevIL memory using ilDeleteImages(). After that, we report any errors if needed and return our success flag.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">#include "LUtil.h"
#include &#060IL/il.h&#062
#include &#060IL/ilu.h&#062
#include "LTexture.h"

//File loaded texture
LTexture gLoadedTexture;

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

    //Initialize DevIL
    ilInit();
    ilClearColour( 255, 255, 255, 000 );

    //Check for error
    ILenum ilError = ilGetError();
    if( ilError != IL_NO_ERROR )
    {
        printf( "Error initializing DevIL! %s\n", iluErrorString( ilError ) );
        return false;
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp, we include il.h and ilu.h since we're going to be using DevIL utilities.<br/>
<br/>
In initGL() after we initialize OpenGL, we call ilInit() to initialize DevIL. Then ilClearColour() is called to set the DevIL clear color to transparent white. DevIL actually has
its own internal rendering fuctions which we'll be using in future tutorials.<br/>
<br/>
After initializing DevIL, we check for errors and return.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Load texture
    if( !gLoadedTexture.loadTextureFromFile( "06_loading_a_texture/texture.png" ) )
    {
        printf( "Unable to load file texture!\n" );
        return false;
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our loadMedia() function, we call loadTextureFromFile() to load our PNG file. Make sure that when you run this program that the "06_loading_a_texture" folder containing
"texture.png" is in the right place.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Calculate centered offsets
    GLfloat x = ( SCREEN_WIDTH - gLoadedTexture.textureWidth() ) / 2.f;
    GLfloat y = ( SCREEN_HEIGHT - gLoadedTexture.textureHeight() ) / 2.f;

    //Render texture
    gLoadedTexture.render( x, y );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally, in our render() function we render our PNG file the same way we rendered our texture we made from memory in the last tutorial.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="06_loading_a_texture.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Loading a Texture">Back to Index</a>


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