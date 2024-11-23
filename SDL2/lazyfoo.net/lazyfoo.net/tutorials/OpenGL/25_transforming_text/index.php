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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Scaling Rotating Font Bitmap TrueType Text">
<meta name="description" content="Learn to rotate and scale OpenGL text.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Transforming Text</title>

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
    <h1 class="text-center">Transforming Text</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Transforming Text screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        Text as far as we're concerned is just a set of textured quads. If we treat a rendered string as one big quad, we can transform it just like any quad.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">        LFRect getStringArea( std::string text );
        /*
        Pre Condition:
         -A loaded font
        Post Condition:
         -Returns area for given text
        Side Effects:
         -None
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The new LFont function getStringArea() gives us the rendering area for an entire string.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">LFRect LFont::getStringArea( std::string text )
{
    //Initialize area
    GLfloat subWidth = 0.f;
    LFRect area = { 0.f, 0.f, subWidth, mLineHeight };

    //Go through string
    for( int i = 0; i < text.length(); ++i )
    {
        //Space
        if( text[ i ] == ' ' )
        {
            subWidth += mSpace;
        }
        //Newline
        else if( text[ i ] == '\n' )
        {
            //Add another line
            area.h += mLineHeight;

            //Check for max width
            if( subWidth > area.w )
            {
                area.w = subWidth;
                subWidth = 0.f;
            }
        }
        //Character
        else
        {
            //Get ASCII
            GLuint ascii = (unsigned char)text[ i ];
            subWidth += mClips[ ascii ].w;
        }
    }

    //Check for max width
    if( subWidth > area.w )
    {
        area.w = subWidth;
    }

    return area;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The way this function calculates area is simple. For every newline, it adds on a line height to the area height. To calculate how wide the text area is, we need to find the line
of text with the greatest width.<br/>
<br/>
To do that, we go through the string adding the character/space width for each character to "subWidth". When we reach a newline or the end of the whole string, we check if this
line of text has a greater width than the current text area width. If it is, it means we found the greatest line width for the string.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//Font
LFont gFont;

//Text areas
LFRect gScaledArea = { 0.f, 0.f, 0.f, 0.f };
LFRect gPivotArea = { 0.f, 0.f, 0.f, 0.f };
LFRect gCirclingArea = { 0.f, 0.f, 0.f, 0.f };

//Transformation variables
GLfloat gBigTextScale = 3.f;
GLfloat gPivotAngle = 0.f;
GLfloat gCirclingAngle = 0.f;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp we declare the font, the text areas for the text we're going to render, and various transformation variables.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Load text
    if( !gFont.loadFreeType( "25_transforming_text/lazy.ttf", 60 ) )
    {
        printf( "Unable to load ttf font!\n" );
        return false;
    }

    //Calculate rendering areas
    gScaledArea = gFont.getStringArea( "Big Text!" );
    gPivotArea = gFont.getStringArea( "Pivot" );
    gCirclingArea = gFont.getStringArea( "Wheee!" );

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After we load the text, we precalculate the render areas for all of the strings so we don't calculate them every time we render.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void update()
{
    //Update angles
    gPivotAngle += -1.f;
    gCirclingAngle += +2.f;

    //Scale
    gBigTextScale += 0.1f;
    if( gBigTextScale >= 3.f )
    {
        gBigTextScale = 0.f;
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the update function() we update rotation angles and text scaling.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );


    //Big upper middle text
    glLoadIdentity();
    glColor3f( 1.f, 0.f, 0.f );

    //Move to render point
    glTranslatef( ( SCREEN_WIDTH - gScaledArea.w * gBigTextScale ) / 2.f, ( SCREEN_HEIGHT - gScaledArea.h * gBigTextScale ) / 4.f, 0.f );

    //Scale and render
    glScalef( gBigTextScale, gBigTextScale, gBigTextScale );
    gFont.renderText( 0.f, 0.f, "Big Text!" , &gScaledArea, LFONT_TEXT_ALIGN_CENTERED_H );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">First we render some red text that pops out at the user. First we want to translate the text to the center of the top half of the screen. Since we're translating a scaled
quad (we're treating the text area like a single quad) in unscaled coordinates, we scale the text area in the call to glTranslate().<br/>
<br/>
Then we call glScale() and render the scaled text.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Lower pivoting text
    glLoadIdentity();
    glColor3f( 0.f, 1.f, 0.f );

    //Move to render point
    glTranslatef( ( SCREEN_WIDTH - gPivotArea.w * 1.5f ) / 2.f, ( SCREEN_HEIGHT - gPivotArea.h * 1.5f ) * 3.f / 4.f, 0.f );

    //Scale and move to pivot point
    glScalef( 1.5f, 1.5f, 1.5f );
    glTranslatef( gPivotArea.w / 2.f, gPivotArea.h / 2.f, 0.f );

    //Rotate around pivot
    glRotatef( gPivotAngle, 0.f, 0.f, 1.f );

    //Move back to render point and render
    glTranslatef( -gPivotArea.w / 2.f, -gPivotArea.h / 2.f, 0.f );
    gFont.renderText( 0.f, 0.f, "Pivot", &gPivotArea, LFONT_TEXT_ALIGN_CENTERED_H );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we have rotating green text that rotates around it's center at the bottom half of the screen.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Circling text
    glLoadIdentity();
    glColor3f( 0.f, 0.f, 1.f );

    //Move to center of screen
    glTranslatef( SCREEN_WIDTH / 2.f, SCREEN_HEIGHT / 2.f, 0.f );

    //Rotate around center
    glRotatef( gCirclingAngle, 0.f, 0.f, 1.f );

    //Move to arm position
    glTranslatef( 0.f, -SCREEN_HEIGHT / 2.f, 0.f );

    //Center on arm
    glTranslatef( -gCirclingArea.w / 2.f, 0.f, 0.f );

    //Render
    gFont.renderText( 0.f, 0.f, "Wheee!", &gCirclingArea, LFONT_TEXT_ALIGN_CENTERED_H );


    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally we render text that circles around the screen. It works by rotating around the center of the screen.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="25_transforming_text.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Transforming Text">Back to Index</a>


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