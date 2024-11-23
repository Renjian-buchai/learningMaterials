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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Align Center Justify Bitmap TTF TrueType Font Text">
<meta name="description" content="Learn to align and center OpenGL text.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Text Alignment</title>

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
    <h1 class="text-center">Text Alignment</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Text Alignment screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        Up until now we're always been drawing left aligned text. Here we'll align text horizontally and vertically.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.h</div>


<pre class="border my-0 py-3">enum LFontTextAlignment
{
    LFONT_TEXT_ALIGN_LEFT = 1,
    LFONT_TEXT_ALIGN_CENTERED_H = 2,
    LFONT_TEXT_ALIGN_RIGHT = 4,
    LFONT_TEXT_ALIGN_TOP = 8,
    LFONT_TEXT_ALIGN_CENTERED_V = 16,
    LFONT_TEXT_ALIGN_BOTTOM = 32
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here are some enumerated constants to define how to align our text. You might have noticed that they are powers of two. It's because we're going to be doing bitwise operations
with them.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.h</div>


<pre class="border my-0 py-3">        void renderText( GLfloat x, GLfloat y, std::string text, LFRect* area = NULL, int align = LFONT_TEXT_ALIGN_LEFT );
        /*
        Pre Condition:
         -A loaded font
        Post Condition:
         -Renders text
         -If area is given, text is aligned within given area
        Side Effects:
         -Binds member texture and data buffers
        */

        GLfloat getLineHeight();
        /*
        Pre Condition:
         -A loaded font
        Post Condition:
         -Return height for a single line of text
        Side Effects:
         -None
        */

    private:
        GLfloat substringWidth( const char* substring );
        /*
        Pre Condition:
        -A loaded font
        Post Condition:
        -Returns the sprite width until it reached a '\n' or '\0'
        Side Effects:
         -None
        */

        GLfloat stringHeight( const char* thisString );
        /*
        Pre Condition:
        -A loaded font
        Post Condition:
        -Returns the pixel height required to render the font
        Side Effects:
         -None
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The function renderText() has been augmented to take in a alignment area and an alignment. The function getLineHeight() does what you'd expect it to do. The function
substringWidth() is going to be used for alignment. When you have some text like this:<br/>
<br/>
<b>
Here is some text<br/>
we might want to render<br/>
at some point<br/>
</b>
<br/>
Each line of text has a different width and in order to align it we need to get the width of each of the substrings.<br/>
<br/>
Lastly stringHeight() returns the height of a whole string in pixels.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">GLfloat LFont::getLineHeight()
{
    return mLineHeight;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The function getLineHeight() simply gets the line height we calculated in the font loading function.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">GLfloat LFont::stringHeight( const char* thisString )
{
    GLfloat height = mLineHeight;

    //Go through string
    for( int i = 0; thisString[ i ] != '\0'; ++i )
    {
        //Space
        if( thisString[ i ] == '\n' )
        {
            height += mLineHeight;
        }
    }

    return height;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">A single line of text has a pixel height of "mLineHeight". For every additional newline we find in the string we add on another line height.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">GLfloat LFont::substringWidth( const char* substring )
{
    GLfloat subWidth = 0.f;

    //Go through string
    for( int i = 0; i < substring[ i ] != '\0' && substring[ i ] != '\n' ; ++i )
    {
        //Space
        if( substring[ i ] == ' ' )
        {
            subWidth += mSpace;
        }
        //Character
        else
        {
            //Get ASCII
            GLuint ascii = (unsigned char)substring[ i ];
            subWidth += mClips[ ascii ].w;
        }
    }

    return subWidth;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">To find the width of a substring, we just keep adding on the width of each character or space until we reach a newline or the end of the string.
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
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of the renderText() function, we initialize the draw position in case there's no need to align.<br/>
<br/>
If an alignment area has been given, we make sure that the alignment constant isn't 0. If it is, we give it a default top left alignment.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">            //Handle horizontal alignment
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
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we set the horizontal text alignment. When we do the horizontal alignment calculations, we use the substring width because each line of text can have a different starting
draw position. 
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">            //Handle vertical alignment
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
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Depending on the height of the overall text, we're going to have a different starting y draw position.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">        //Move to draw position
        glTranslatef( dX, dY, 0.f );

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
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Continuing on with the renderText() function, we translate to the drawing point and bind our data as usual. Then we start iterating through the string as usual. What's going to
change about our string iteration is how we handle newlines.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">                //Newline
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
                    glTranslatef( targetX - dX, mNewLine, 0.f );
                    dY += mNewLine;
                    dX += targetX - dX;
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When we have a newline, we have to calculate at what x offset we want to start rendering at. We initialize "targetX" in case we don't have an alignment area. Then we align the
next line of text based off of the substring width.<br/>
<br/>
You may be wondering how that funky expression inside of substringWidth() works. The std string function c_str() returns a const char*. We then use the array index operator to
get the string starting at "i" + 1. "i" is the current character (which is '\n') in the string and we want to figure out what the width of the substring starting at the next line.
Lastly use the & operator to get the const char* pointer to the next line of text.<br/>
<br/>
When we calculated "targetX" we translate to it and go down one line. 
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LFont.cpp</div>


<pre class="border my-0 py-3">                //Character
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


    <div class="container border-start border-end border-bottom py-3 mb-3">The rest of renderText() works as it did before.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//Text renderer
LFont gFont;

//Alignment variables
LFontTextAlignment gAlignH = LFONT_TEXT_ALIGN_LEFT;
LFontTextAlignment gAlignV = LFONT_TEXT_ALIGN_TOP;
int gAlign = gAlignH | gAlignV;

//Screen area
LFRect gScreenArea = { 0.f, 0.f, SCREEN_WIDTH, SCREEN_HEIGHT };
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LFont.cpp we have a font object, variables for alignment, and rectangle to define the area of the screen.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Load font
	if( !gFont.loadFreeType( "24_text_alignment/lazy.ttf", 60 ) )
	{
	    printf( "Unable to load ttf font!\n" );
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

    //Render yellow text
    glColor3f( 1.f, 1.f, 0.f );
    gFont.renderText( 0.f, SCREEN_HEIGHT / 2.f, "Testing...\nAlignment...", &gScreenArea, gAlign );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we load the font and render the text aligned inside of the screen area.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void handleKeys( unsigned char key, int x, int y )
{
    if( key == 'a' )
    {
        switch( gAlignH )
        {
            case LFONT_TEXT_ALIGN_LEFT:
                gAlignH = LFONT_TEXT_ALIGN_RIGHT;
                break;
            case LFONT_TEXT_ALIGN_CENTERED_H:
                gAlignH = LFONT_TEXT_ALIGN_LEFT;
                break;
            case LFONT_TEXT_ALIGN_RIGHT:
                gAlignH = LFONT_TEXT_ALIGN_CENTERED_H;
                break;
        }
    }
    else if( key == 'd' )
    {
        switch( gAlignH )
        {
            case LFONT_TEXT_ALIGN_LEFT:
                gAlignH = LFONT_TEXT_ALIGN_CENTERED_H;
                break;
            case LFONT_TEXT_ALIGN_CENTERED_H:
                gAlignH = LFONT_TEXT_ALIGN_RIGHT;
                break;
            case LFONT_TEXT_ALIGN_RIGHT:
                gAlignH = LFONT_TEXT_ALIGN_LEFT;
                break;
        }
    }
    else if( key == 'w' )
    {
        switch( gAlignV )
        {
            case LFONT_TEXT_ALIGN_TOP:
                gAlignV = LFONT_TEXT_ALIGN_BOTTOM;
                break;
            case LFONT_TEXT_ALIGN_CENTERED_V:
                gAlignV = LFONT_TEXT_ALIGN_TOP;
                break;
            case LFONT_TEXT_ALIGN_BOTTOM:
                gAlignV = LFONT_TEXT_ALIGN_CENTERED_V;
                break;
        }
    }
    else if( key == 's' )
    {
        switch( gAlignV )
        {
            case LFONT_TEXT_ALIGN_TOP:
                gAlignV = LFONT_TEXT_ALIGN_CENTERED_V;
                break;
            case LFONT_TEXT_ALIGN_CENTERED_V:
                gAlignV = LFONT_TEXT_ALIGN_BOTTOM;
                break;
            case LFONT_TEXT_ALIGN_BOTTOM:
                gAlignV = LFONT_TEXT_ALIGN_TOP;
                break;
        }
    }

    //Set alignment
    gAlign = gAlignH | gAlignV;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally, you can cycle through the horizontal/vertical text alignments by pressing w/a/s/d.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="24_text_alignment.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Text Alignment">Back to Index</a>


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