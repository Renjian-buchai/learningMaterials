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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Sprite Sheets">
<meta name="description" content="Learn to use multiple images per OpenGL texture using VBO sprite sheets.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Sprite Sheets</title>

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
    <h1 class="text-center">Sprite Sheets</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Sprite Sheets screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        In the previous tutorial, we were updating the vertex data in our VBO every frame despite the fact that our vertex data didn't change from frame to frame.
If you have a set of sprite images that you reuse every frame, you can just preallocate your vertex data. 

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">        virtual ~LTexture();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Frees texture
        Side Effects:
         -None
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In this tutorial we're going to have a class that inherits from LTexture. To make sure our base class destructor gets called, we make it virtual.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LTexture.h</div>


<pre class="border my-0 py-3">        virtual void freeTexture();
        /*
        Pre Condition:
         -A valid OpenGL context
        Post Condition:
         -Deletes texture if it exists
         -Deletes member pixels if they exist
         -Sets texture ID to 0
        Side Effects:
         -None
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">We're also going to override how textures are freed in the child class.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.h</div>


<pre class="border my-0 py-3">class LSpriteSheet : public LTexture
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

        bool generateDataBuffer();
        /*
        Pre Condition:
         -A loaded base LTexture
         -Clipping rectangles in clip array
        Post Condition:
         -Generates VBO and IBO to render sprites with
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


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the LSpriteSheet class, which inherits from the LTexture class. A sprite sheet in our case is a texture with a specialized use.<br/>
<br/>
At the top we have the constructor and destructor like we usually do. Then we have addClipSprite(), which adds a clip rectangle for a sprite to the member array. The function
getClip() gets a clip from the member array.<br/>
<br/>
Once we have all the clip rectangles set, we'll call generateDataBuffer() to use our clip rectangles to generate our VBO and IBOs. Where we're done with our clip rectangles, we'll
call freeSheet() to deallocate our clipping data.<br/>
<br/>
LTexture is inherited publicly, so all the public base functions can still be accessed. We're going to make some changes to freeTexture() as you'll see later in the tutorial.
Lastly, we have renderSprite() which of course renders a sprite.<br/>
<br/>
In terms of new variables, we have "mClips" which is representing our array of clip rectangles. Then we have "mVertexDataBuffer" which we'll use to hold the vertex data for all of
our sprites in one big VBO. Lastly we have "mIndexBuffers" which will be an array of IBOs. For this implementation of a sprite sheet, we'll have on big VBO and an IBO for each
individual sprite.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.cpp</div>


<pre class="border my-0 py-3">LSpriteSheet::LSpriteSheet()
{
    //Initialize vertex buffer data
    mVertexDataBuffer = NULL;
    mIndexBuffers = NULL;
}

LSpriteSheet::~LSpriteSheet()
{
    //Clear sprite sheet data
    freeSheet();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The constructor initializes member variables and the destructor deallocates sprite sheet data. Remember that the LTexture destructor is virtual so the base LTexture gets
deallocated after the LSpriteSheet gets deallocated.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.cpp</div>


<pre class="border my-0 py-3">int LSpriteSheet::addClipSprite( LFRect& newClip )
{
    //Add clip and return index
    mClips.push_back( newClip );
    return mClips.size() - 1;
}

LFRect LSpriteSheet::getClip( int index )
{
    return mClips[ index ];
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The function addClipSprite() simply adds on the clipping rectangle at the end of the STL vector and returns the index of the last element. getClip() returns the requested
clip rectangle. We don't check for array bounds because getting sprite dimensions can be used heavily during rendering, a performance critical part of the program.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.cpp</div>


<pre class="border my-0 py-3">bool LSpriteSheet::generateDataBuffer()
{
    //If there is a texture loaded and clips to make vertex data from
    if( getTextureID() != 0 && mClips.size() > 0 )
    {
        //Allocate vertex buffer data
        int totalSprites = mClips.size();
        LVertexData2D* vertexData = new LVertexData2D[ totalSprites * 4 ];
        mIndexBuffers = new GLuint[ totalSprites ];
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After we loaded our texture and added all the clip rectangles for the sprites we want to render, it's time to generate our VBO data.<br/>
<br/>
After making sure there's a base texture to render with and clip rectangles to generate data from, we allocate our vertex data (with 4 vertices per sprite) and an IBO per sprite. 
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.cpp</div>


<pre class="border my-0 py-3">        //Allocate vertex data buffer name
        glGenBuffers( 1, &mVertexDataBuffer );

        //Allocate index buffers names
        glGenBuffers( totalSprites, mIndexBuffers );

        //Go through clips
        GLfloat tW = textureWidth();
        GLfloat tH = textureHeight();
        GLuint spriteIndices[ 4 ] = { 0, 0, 0, 0 };

        for( int i = 0; i < totalSprites; ++i )
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Next we generate our big VBO and the IBOs for each sprite.<br/>
<br/>
Then we get the texture width/height so we can map our texture coordinates. After that we declare some sprite indices we'll use for our IBOs.<br/>
<br/>
Now we're ready to go through the clip rectangles and set our index/vertex data.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.cpp</div>


<pre class="border my-0 py-3">        {
            //Initialize indices
            spriteIndices[ 0 ] = i * 4 + 0;
            spriteIndices[ 1 ] = i * 4 + 1;
            spriteIndices[ 2 ] = i * 4 + 2;
            spriteIndices[ 3 ] = i * 4 + 3;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of our for loop we set our index data for current sprite.<br/>
<br/>
If you're wondering how these indices are calculated, think of it this way:<br/>
<br/>
If you have 3 sprites with 4 vertices each, you're going to have a total of 12 vertices with indices going from from 0 to 11. The first sprite will have indices 0, 1, 2, and 3.
The second sprite will have indices 4, 5, 6, and 7. The third sprite will be 8, 9, 10, and 11.<br/>
<br/>
Now let's take the third sprite which will have a clip index of 2 because arrays start counting from 0. This gives us:
<ul>
    <li>2 * 4 + 0 = 8</li>
    <li>2 * 4 + 1 = 9</li>
    <li>2 * 4 + 2 = 10</li>
    <li>2 * 4 + 3 = 11</li>
</ul>
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.cpp</div>


<pre class="border my-0 py-3">            //Top left
            vertexData[ spriteIndices[ 0 ] ].position.x = -mClips[ i ].w / 2.f;
            vertexData[ spriteIndices[ 0 ] ].position.y = -mClips[ i ].h / 2.f;

            vertexData[ spriteIndices[ 0 ] ].texCoord.s =  (mClips[ i ].x) / tW;
            vertexData[ spriteIndices[ 0 ] ].texCoord.t =  (mClips[ i ].y) / tH;

            //Top right
            vertexData[ spriteIndices[ 1 ] ].position.x =  mClips[ i ].w / 2.f;
            vertexData[ spriteIndices[ 1 ] ].position.y = -mClips[ i ].h / 2.f;

            vertexData[ spriteIndices[ 1 ] ].texCoord.s =  (mClips[ i ].x + mClips[ i ].w) / tW;
            vertexData[ spriteIndices[ 1 ] ].texCoord.t =  (mClips[ i ].y) / tH;

            //Bottom right
            vertexData[ spriteIndices[ 2 ] ].position.x =  mClips[ i ].w / 2.f;
            vertexData[ spriteIndices[ 2 ] ].position.y =  mClips[ i ].h / 2.f;

            vertexData[ spriteIndices[ 2 ] ].texCoord.s =  (mClips[ i ].x + mClips[ i ].w) / tW;
            vertexData[ spriteIndices[ 2 ] ].texCoord.t =  (mClips[ i ].y + mClips[ i ].h) / tH;

            //Bottom left
            vertexData[ spriteIndices[ 3 ] ].position.x = -mClips[ i ].w / 2.f;
            vertexData[ spriteIndices[ 3 ] ].position.y =  mClips[ i ].h / 2.f;

            vertexData[ spriteIndices[ 3 ] ].texCoord.s =  (mClips[ i ].x) / tW;
            vertexData[ spriteIndices[ 3 ] ].texCoord.t =  (mClips[ i ].y + mClips[ i ].h) / tH;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After setting our indices for the current sprite, we set the vertex data for the current sprite. This time around the sprite's origin is at the center of the sprite.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.cpp</div>


<pre class="border my-0 py-3">            //Bind sprite index buffer data
            glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, mIndexBuffers[ i ] );
            glBufferData( GL_ELEMENT_ARRAY_BUFFER, 4 * sizeof(GLuint), spriteIndices, GL_STATIC_DRAW );
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the bottom of the for loop for the current sprite, we want to set the IBO data for the current sprite.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.cpp</div>


<pre class="border my-0 py-3">        //Bind vertex data
        glBindBuffer( GL_ARRAY_BUFFER, mVertexDataBuffer );
        glBufferData( GL_ARRAY_BUFFER, totalSprites * 4 * sizeof(LVertexData2D), vertexData, GL_STATIC_DRAW );

        //Deallocate vertex data
        delete[] vertexData;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After we're done with going through the sprites with the for loop, we set the VBO data for our whole sprite sheet.<br/>
<br/>
Remember that the vertex data was dynamically allocated. It's already on the GPU, so we can delete it on the client side.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.cpp</div>


<pre class="border my-0 py-3">    //Error
    else
    {
        if( getTextureID() == 0 )
        {
            printf( "No texture to render with!\n" );
        }

        if( mClips.size() <= 0 )
        {
            printf( "No clips to generate vertex data from!\n" );
        }

        return false;
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the bottom of the generateDataBuffer() function we report any errors if we need to and return the success of the function.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.cpp</div>


<pre class="border my-0 py-3">void LSpriteSheet::freeSheet()
{
    //Clear vertex buffer
    if( mVertexDataBuffer != NULL )
    {
        glDeleteBuffers( 1, &mVertexDataBuffer );
        mVertexDataBuffer = NULL;
    }

    //Clear index buffers
    if( mIndexBuffers != NULL )
    {
        glDeleteBuffers( mClips.size(), mIndexBuffers );
        delete[] mIndexBuffers;
        mIndexBuffers = NULL;
    }

    //Clear clips
    mClips.clear();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In freeSheet(), all we do is deallocate the sprite sheet data since we may want to reuse the base LTexture. Notice how "mIndexBuffers" is deleted because the IBO names we
dynamically allocated.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LSpriteSheet.cpp</div>


<pre class="border my-0 py-3">void LSpriteSheet::freeTexture()
{
    //Get rid of sprite sheet data
    freeSheet();

    //Free texture
    LTexture::freeTexture();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the reason we made freeTexture() function in LTexture virtual. Because LSpriteSheet inherits LTexture publicly, all the base public functions are exposed. We don't want it
to happen where there's vertex data with no texture. With this overidden function, the LSpriteSheet will deallocate both the sprite sheet data and the base texture.
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
        glEnableClientState( GL_VERTEX_ARRAY );
        glEnableClientState( GL_TEXTURE_COORD_ARRAY );

            //Bind vertex data
            glBindBuffer( GL_ARRAY_BUFFER, mVertexDataBuffer );

            //Set texture coordinate data
            glTexCoordPointer( 2, GL_FLOAT, sizeof(LVertexData2D), (GLvoid*) offsetof( LVertexData2D, texCoord ) );

            //Set vertex data
            glVertexPointer( 2, GL_FLOAT, sizeof(LVertexData2D), (GLvoid*) offsetof( LVertexData2D, position ) );

            //Draw quad using vertex data and index data
            glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, mIndexBuffers[ index ] );
            glDrawElements( GL_QUADS, 4, GL_UNSIGNED_INT, NULL );

        //Disable vertex and texture coordinate arrays
        glDisableClientState( GL_TEXTURE_COORD_ARRAY );
        glDisableClientState( GL_VERTEX_ARRAY );
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally in our renderSprite() function, we bind our monolothic VBO with our vertex and texture coordinates and render using the sprite's specific IBO.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">#include "LUtil.h"
#include &#060IL/il.h&#062
#include &#060IL/ilu.h&#062
#include "LSpriteSheet.h"

//Sprite sheet
LSpriteSheet gArrowSprites;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp, we declare our sprite sheet.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Load texture
    if( !gArrowSprites.loadTextureFromFile( "19_sprite_sheets/arrows.png" ) )
    {
        printf( "Unable to load sprite sheet!\n" );
        return false;
    }

    //Set clips
    LFRect clip = { 0.f, 0.f, 128.f, 128.f };

    //Top left
    clip.x = 0.f;
    clip.y = 0.f;
    gArrowSprites.addClipSprite( clip );

    //Top right
    clip.x = 128.f;
    clip.y = 0.f;
    gArrowSprites.addClipSprite( clip );

    //Bottom left
    clip.x = 0.f;
    clip.y = 128.f;
    gArrowSprites.addClipSprite( clip );

    //Bottom right
    clip.x = 128.f;
    clip.y = 128.f;
    gArrowSprites.addClipSprite( clip );

    //Generate VBO
    if( !gArrowSprites.generateDataBuffer() )
    {
        printf( "Unable to clip sprite sheet!\n" );
        return false;
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In loadMedia(), we load our sprite sheet texture as we would with a plain LTexture. Then we the clip rectangles from each sprite. Lastly, we generate the data buffers from the
clip rectangles.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Render top left arrow
    glLoadIdentity();
    glTranslatef( 64.f, 64.f, 0.f );
    gArrowSprites.renderSprite( 0 );

    //Render top right arrow
    glLoadIdentity();
    glTranslatef( SCREEN_WIDTH - 64.f, 64.f, 0.f );
    gArrowSprites.renderSprite( 1 );

    //Render bottom left arrow
    glLoadIdentity();
    glTranslatef( 64.f, SCREEN_HEIGHT - 64.f, 0.f );
    gArrowSprites.renderSprite( 2 );

    //Render bottom right arrow
    glLoadIdentity();
    glTranslatef( SCREEN_WIDTH - 64.f, SCREEN_HEIGHT - 64.f, 0.f );
    gArrowSprites.renderSprite( 3 );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally in the render() function, we render each of the sprites in the 4 corners.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="19_sprite_sheets.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Sprite Sheets">Back to Index</a>


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