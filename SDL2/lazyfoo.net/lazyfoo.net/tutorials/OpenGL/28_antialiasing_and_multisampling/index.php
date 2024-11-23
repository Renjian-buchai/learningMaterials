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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Anti Aliasing Multisampling Jaggies Smooth Polygons">
<meta name="description" content="Learn to render smooth polygons in OpenGL.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Antialiasing and Multisampling</title>

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
    <h1 class="text-center">Antialiasing and Multisampling</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Antialiasing and Multisampling screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        Using OpenGL's built antialiasing and multisampling functionality, you can smooth out the edges of your polygon when they rasterize.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From main.cpp</div>


<pre class="border my-0 py-3">    //Create Double Buffered Window with multisampled buffer
    glutInitDisplayMode( GLUT_DOUBLE | GLUT_MULTISAMPLE );
    glutInitWindowSize( SCREEN_WIDTH, SCREEN_HEIGHT );
    glutCreateWindow( "OpenGL" );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In order to use multisampling, you have to request a multisampled buffer from your windowing API. For freeGLUT, that means passing in GLUT_MULTISAMPLE to glutInitDisplayMode().
For other windowing APIs, look in your documentation on how to request a multisampled buffer.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.h</div>


<pre class="border my-0 py-3">//Aliasing methods
enum AliasMode
{
    ALIAS_MODE_ALIASED,
    ALIAS_MODE_ANTIALIASED,
    ALIAS_MODE_MULTISAMPLE
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In this tutorial there's 3 ways we're going to render the triangle on the screen. Aliased means we're going to render the triangle with plain rasterization which leads to aliasing
(the technical term for jaggies). Antialiased means OpenGL will smooth out the edges of the triangle. Multisampling is another type of antialiasing where we render with multiple
samples per pixel. 
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//Aliasing
AliasMode gMode = ALIAS_MODE_ALIASED;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp, we have a global variable that controls how we're rendering the triangle.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Set blending
    glEnable( GL_BLEND );
    glDisable( GL_DEPTH_TEST );
    glBlendFunc( GL_SRC_ALPHA, GL_ONE_MINUS_SRC_ALPHA );

    //Set antialiasing/multisampling
    glHint( GL_LINE_SMOOTH_HINT, GL_NICEST );
    glHint( GL_POLYGON_SMOOTH_HINT, GL_NICEST );
    glDisable( GL_LINE_SMOOTH );
    glDisable( GL_POLYGON_SMOOTH );
    glDisable( GL_MULTISAMPLE );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In order to use antialiasing and multisampling, you have to enable blending. This isn't much of an issue because we've been using blending for a while now.<br/>
<br/>
Using glHint() we can tell the OpenGL driver how to do polygon smoothing antialiasing. Here we're telling the OpenGL driver to use the nicest line and polygon smoothing. Whether
the driver will listen to our request is all up to the card vendor's (AMD, nVidia, Intel, etc) driver implementation.<br/>
<br/>
Finally, we disable line/polygon smoothing and multisampling in our initGL() function. For this demo we want aliased polygons to be our default behavior.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    return true;
}

void update()
{

}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Since we're rendering a plain polygon, the loadMedia() and update() functions don't do much.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color
    glClear( GL_COLOR_BUFFER_BIT );

    //Start alias mode
    switch( gMode )
    {
        case ALIAS_MODE_ALIASED:
            glDisable( GL_LINE_SMOOTH );
            glDisable( GL_POLYGON_SMOOTH );
            glDisable( GL_MULTISAMPLE );
            break;

        case ALIAS_MODE_ANTIALIASED:
            glEnable( GL_LINE_SMOOTH );
            glEnable( GL_POLYGON_SMOOTH );
            glDisable( GL_MULTISAMPLE );
            break;

        case ALIAS_MODE_MULTISAMPLE:
            glDisable( GL_LINE_SMOOTH );
            glDisable( GL_POLYGON_SMOOTH );
            glEnable( GL_MULTISAMPLE );
            break;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of the render() function, we clear the screen as usual and then set the aliasing mode.<br/>
<br/>
If we want the polygon to be aliased, smoothing and multisampling are disabled. If we want the polygon to be smoothed, we enable smoothing and disable multisampling. If we want to
render things multisampled, we disable smoothing and enable multisampling.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Render Triangle
    glColor3f( 1.f, 1.f, 1.f );
    glBegin( GL_TRIANGLES );
     glVertex2f( SCREEN_WIDTH, 0.f );
     glVertex2f( SCREEN_WIDTH, SCREEN_HEIGHT );
     glVertex2f( 0.f, SCREEN_HEIGHT );
    glEnd();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For the sake of simplicity, we're using the slow immediate mode to render the triangle.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //End alias mode
    switch( gMode )
    {
        case ALIAS_MODE_ANTIALIASED:
            glDisable( GL_LINE_SMOOTH );
            glDisable( GL_POLYGON_SMOOTH );
            break;
            
        case ALIAS_MODE_MULTISAMPLE:
            glDisable( GL_MULTISAMPLE );
            break;
    }

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After we're done rendering the triangle, we disable whatever smoothing/multisampling was used.<br/>
<br/>
Finally, we swap the buffers to update the screen.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void handleKeys( unsigned char key, int x, int y )
{
    //If the user presses q
    if( key == 'q' )
    {
        //Cycle alias mode
        switch( gMode )
        {
            case ALIAS_MODE_ALIASED:
                printf( "Antialiased\n" );
                gMode = ALIAS_MODE_ANTIALIASED;
                break;

            case ALIAS_MODE_ANTIALIASED:
                printf( "Multisampled\n" );
                gMode = ALIAS_MODE_MULTISAMPLE;
                break;

            case ALIAS_MODE_MULTISAMPLE:
                printf( "Aliased\n" );
                gMode = ALIAS_MODE_ALIASED;
                break;
        }
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">And in our handleKeys() function we cycle through the different aliasing modes.<br/>
<br/>
When you run the program, you can zoom in to see how your OpenGL driver handles the polygon rendering.<br/>
<br/>
<div class="text-center">
<img class="img-fluid" alt="aliased" src="aliased.png"><br/>
This is rendering with aliased edges.
</div>
<br/>
<div class="text-center">
<img class="img-fluid" alt="multisampled" src="multisampled.png"><br/>
This is rendering with multisampled buffer.
</div><br/>
<br/>
If you're wondering how using polygon smoothing looks, that's.... something I would like to know too. See, antialiasing via polygon smoothing was one of the earlier methods of 
antialiasing in OpenGL. Then multisampling came along. While it's part of the OpenGL spec, polygon smoothing isn't always there and my home rig doesn't support it. When we make a
call with glHint, it's handled as a request, not an order.<br/>
<br/>
These days, it's generally not a good idea to rely on polygon smoothing for antialiasing. If you want antialiasing done for you, you can use multisampling. Many
developers today don't rely on API level multisampling and use their own methods via shaders. One method I've seen is using a gaussian blur on edges.<br/>
<br/>
Start looking up image processing is you want to use your own method for antialiasing.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="28_antialiasing_and_multisampling.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Antialiasing and Multisampling">Back to Index</a>


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