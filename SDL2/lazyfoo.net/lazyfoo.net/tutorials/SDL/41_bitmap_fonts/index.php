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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac Bitmap fonts">
<meta name="description" content="Render bitmap fonts in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Bitmap Fonts</title>

<script src="../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
	<a href="../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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
    <h1 class="text-center">Bitmap Fonts</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Bitmap Fonts screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 10th, 2024</b></p>
    
        Sometimes TTF fonts aren't flexible enough. Since rendering text is just rendering images of characters, we can use bitmap fonts to render text.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3"></pre>




                    
                
                    
                        

<pre class="border my-0 py-3">//Texture wrapper class
class LTexture
{
public:
    //Initializes variables
    LTexture();

    //Deallocates memory
    ~LTexture();

    //Loads image at specified path
    bool loadFromFile( std::string path );

    //Loads image into pixel buffer
    bool loadPixelsFromFile( std::string path );

    //Creates image from preloaded pixels
    bool loadFromPixels();

#if defined(SDL_TTF_MAJOR_VERSION)
    //Creates image from font string
    bool loadFromRenderedText( std::string textureText, SDL_Color textColor );
#endif

    //Deallocates texture
    void free();

    //Set color modulation
    void setColor( Uint8 red, Uint8 green, Uint8 blue );

    //Set blending
    void setBlendMode( SDL_BlendMode blending );

    //Set alpha modulation
    void setAlpha( Uint8 alpha );

    //Renders texture at given point
    void render( int x, int y, SDL_Rect* clip = NULL, double angle = 0.0, SDL_Point* center = NULL, SDL_RendererFlip flip = SDL_FLIP_NONE );

    //Gets image dimensions
    int getWidth();
    int getHeight();

    //Pixel accessors
    Uint32* getPixels32();
    Uint32 getPixel32( Uint32 x, Uint32 y );
    Uint32 getPitch32();
    Uint32 mapRGBA( Uint8 r, Uint8 g, Uint8 b, Uint8 a );

private:
    //The actual hardware texture
    SDL_Texture* mTexture;

    //Surface pixels
    SDL_Surface* mSurfacePixels;

    //Image dimensions
    int mWidth;
    int mHeight;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In previous tutorials when we did <a href="../40_texture_manipulation/index.php">texture pixel manipulation</a>, we didn't care which pixel we got since we wanted to grab all the pixels. Here we need to get pixels at exact
x/y coordinates which is why we're adding a getPixel32 function. This function works specifically for 32bit pixels.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Our bitmap font
class LBitmapFont
{
    public:
        //The default constructor
        LBitmapFont();

        //Generates the font
        bool buildFont( std::string path );

        //Deallocates font
        void free();

        //Shows the text
        void renderText( int x, int y, std::string text );

    private:
        //The font texture
        LTexture mFontTexture;

        //The individual characters in the surface
        SDL_Rect mChars[ 256 ];

        //Spacing Variables
        int mNewLine, mSpace;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our bitmap font which functions as a wrapper for a sprite sheet of glyphs. It has a constructor to initialize internal variables, a function to build the font, and a function to render the text.<br/>
<br/>
When the bitmap font is built we go through the texture and find all the character sprites for the 256 characters (that are stored in the mChars array) and calculate the distance for a new line and a space.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">Uint32 LTexture::getPixel32( Uint32 x, Uint32 y )
{
    //Convert the pixels to 32 bit
    Uint32* pixels = static_cast<Uint32*>( mSurfacePixels->pixels );

    //Get the pixel requested
    return pixels[ ( y * getPitch32() ) + x ];
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our function to get a pixel at a specific offset.<br/>
<br/>
The important thing to know is that even though we have a 2 dimensional texture image like this:
<div class="text-center"><img class="img-fluid" alt="2D pixels" src="2d.jpg"></div>
<br/>
Pixels are stored in one dimension like this:
<div class="text-center"><img class="img-fluid" alt="1D pixels" src="1d.jpg"></div>
<br/>
So if you wanted to get the blue pixel in row 1, column 1 (the first row/column is row/column 0), you would have to calculate the offset like this:<br/>
<code>Y Offset * Pitch + X Offset</code><br/>
<br/>
Which comes out to:<br/>
<code>1 * 5 + 1 = 6</code><br/>
<br/>
And as you can see, the pixel at index 6 on the 1 dimensional pixels is the same as the one on row 1 column 1 on the 2 dimensional pixels.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">LBitmapFont::LBitmapFont()
{
    //Initialize variables
    mNewLine = 0;
    mSpace = 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here in the constructor we initialize the internals.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool LBitmapFont::buildFont( std::string path )
{
    //Get rid of preexisting texture
    free();

    //Load bitmap image
    bool success = true;
    if( !mFontTexture.loadPixelsFromFile( path ) )
    {
        printf( "Unable to load bitmap font surface!\n" );
        success = false;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now we're entering the function that's going to go through the bitmap font and define all the clip rectangles for all the sprites. To do that we'll have to load the bitmap font pixels.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Get the background color
        Uint32 bgColor = mFontTexture.getPixel32( 0, 0 );

        //Set the cell dimensions
        int cellW = mFontTexture.getWidth() / 16;
        int cellH = mFontTexture.getHeight() / 16;

        //New line variables
        int top = cellH;
        int baseA = cellH;

        //The current character we're setting
        int currentChar = 0;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In order for this bitmap font loading to work, the character glyphs need to be arranged in cells:
<div class="text-center"><img class="img-fluid" alt="glyph cells" src="cells.jpg"></div>
<br/>
The cells all need to all have the same width and height, arranged in 16 columns and 16 rows, and need to be in ASCII order. The bitmap font loader is going to go through each of the cells, find the sides of the glyph sprites
and set the clip rectangle for the sprite.<br/>
<br/>
First we get the background color which we'll need to find the edges of the glyph sprites. Then we calculate the cell width and height. We have the variable called top which we will keep track of the top of the tallest glyph
in the sprite sheet. The variable baseA will keep track of the offset of the bottom of the capital A glyph which will use as a base line for rendering characters.<br/>
<br/>
Lastly we have the currentChar which keeps track of the current character glyph we're looking for.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Go through the cell rows
        for( int rows = 0; rows < 16; ++rows )
        {
            //Go through the cell columns
            for( int cols = 0; cols < 16; ++cols )
            {
                //Set the character offset
                mChars[ currentChar ].x = cellW * cols;
                mChars[ currentChar ].y = cellH * rows;

                //Set the dimensions of the character
                mChars[ currentChar ].w = cellW;
                mChars[ currentChar ].h = cellH;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">These two nested for loops are for going through the cell rows/columns.<br/>
<br/>
At the top of per cell loop, we initialize the glyph sprite positon at the top of the cell and the sprite dimensions to be the cell dimensions. This means by default the glyph sprite is the full cell.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Find Left Side
                //Go through pixel columns
                for( int pCol = 0; pCol < cellW; ++pCol )
                {
                    //Go through pixel rows
                    for( int pRow = 0; pRow < cellH; ++pRow )
                    {
                        //Get the pixel offsets
                        int pX = ( cellW * cols ) + pCol;
                        int pY = ( cellH * rows ) + pRow;

                        //If a non colorkey pixel is found
                        if( mFontTexture.getPixel32( pX, pY ) != bgColor )
                        {
                            //Set the x offset
                            mChars[ currentChar ].x = pX;

                            //Break the loops
                            pCol = cellW;
                            pRow = cellH;
                        }
                    }
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For each cell we need to go through all the pixels in the cell to find the edge of the glyph sprite. In this loop we go through each column from top to bottom and look for the first pixel that is not the background color. Once
we find a pixel that is not the background color it means we found the left edge of the sprite:
<div class="text-center"><img class="img-fluid" alt="pixel fishing" src="fishing.gif"></div>
<br/>
When we find the left side of the glyph we set it as x position of the sprite and then break the loops.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Find Right Side
                //Go through pixel columns
                for( int pColW = cellW - 1; pColW >= 0; --pColW )
                {
                    //Go through pixel rows
                    for( int pRowW = 0; pRowW < cellH; ++pRowW )
                    {
                        //Get the pixel offsets
                        int pX = ( cellW * cols ) + pColW;
                        int pY = ( cellH * rows ) + pRowW;

                        //If a non colorkey pixel is found
                        if( bitmap->getPixel32( pX, pY ) != bgColor )
                        {
                            //Set the width
                            mChars[ currentChar ].w = ( pX - mChars[ currentChar ].x ) + 1;

                            //Break the loops
                            pColW = -1;
                            pRowW = cellH;
                        }
                    }
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we're looking for the pixel on the right side. It works pretty much the same as finding the left side, only now we're moving from right to left instead of left to right.<br/>
<br/>
When we find the right pixel, we use it to set the width. Since the pixel array starts at 0, we need to add 1 to the width.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Find Top
                //Go through pixel rows
                for( int pRow = 0; pRow < cellH; ++pRow )
                {
                    //Go through pixel columns
                    for( int pCol = 0; pCol < cellW; ++pCol )
                    {
                        //Get the pixel offsets
                        int pX = ( cellW * cols ) + pCol;
                        int pY = ( cellH * rows ) + pRow;

                        //If a non colorkey pixel is found
                        if( mFontTexture.getPixel32( pX, pY ) != bgColor )
                        {
                            //If new top is found
                            if( pRow < top )
                            {
                                top = pRow;
                            }

                            //Break the loops
                            pCol = cellW;
                            pRow = cellH;
                        }
                    }
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is the code to find the top of the sprite. When we find a top that is higher than the current highest top, we set it as the new top.<br/>
<br/>
Note that since the y axis is inverted, the highest top actually has the lowest y offset.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Find Bottom of A
                if( currentChar == 'A' )
                {
                    //Go through pixel rows
                    for( int pRow = cellH - 1; pRow >= 0; --pRow )
                    {
                        //Go through pixel columns
                        for( int pCol = 0; pCol < cellW; ++pCol )
                        {
                            //Get the pixel offsets
                            int pX = ( cellW * cols ) + pCol;
                            int pY = ( cellH * rows ) + pRow;

                            //If a non colorkey pixel is found
                            if( mFontTexture.getPixel32( pX, pY ) != bgColor )
                            {
                                //Bottom of a is found
                                baseA = pRow;

                                //Break the loops
                                pCol = cellW;
                                pRow = -1;
                            }
                        }
                    }
                }

                //Go to the next character
                ++currentChar;
            }
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In terms of looking for the bottom of the glyphs, the only one we care about is the capital A. For this bitmap font builder we're going to use the bottom of the A glyph sprite as the base line so characters like
"g", "j", "y", etc that hang below the baseline don't define the bottom. You don't have to do it this way, but it's given me good results before.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Calculate space
        mSpace = cellW / 2;

        //Calculate new line
        mNewLine = baseA - top;

        //Lop off excess top pixels
        for( int i = 0; i < 256; ++i )
        {
            mChars[ i ].y += top;
            mChars[ i ].h -= top;
        }

        //Create final texture
        if( !mFontTexture.loadFromPixels() )
        {
            printf( "Unable to create font texture!\n" );
            success = false;
        }
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After we're done defining all the sprites, we have some post processing to do. First we calculate how long a space is. Here we're defining it as half a cell width. We then calculate the height of a new line by using the
baseline and the highest sprite top.<br/>
<br/>
We then lop off the extra space at the top of each glyph to prevent there from being too much space between lines. Finally we finish loading the texture for the bitmap font.<br/>
<br/>
Now the way we constructed the bitmap font isn't the only way to do it. You can define spaces, new lines, and base lines another way. You use an XML/JSON/YML file to define the positions of the sprites instead of using cells.
I decided to go with this method because it's a common one and it has worked for me.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void LBitmapFont::renderText( int x, int y, std::string text )
{
    //If the font has been built
    if( mFontTexture.getWidth() > 0 )
    {
        //Temp offsets
        int curX = x, curY = y;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now that we have all the glyph sprites defined, it's time to render them to the screen. First we check that there is a bitmap to render with (which should be at least one pixel wide), then we declare x/y offsets that we'll
be using to render the current glyph sprite.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Go through the text
        for( int i = 0; i < text.length(); ++i )
        {
            //If the current character is a space
            if( text[ i ] == ' ' )
            {
                //Move over
                curX += mSpace;
            }
            //If the current character is a newline
            else if( text[ i ] == '\n' )
            {
                //Move down
                curY += mNewLine;

                //Move back
                curX = x;
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is the for loop that goes through the string to render each glyph sprite. However there are two ASCII values we're not actually going to render anything for. When we have a space, all we have to do is move over the space
width. When we have a new line we move down a new line and back to the base x offset.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            else
            {
                //Get the ASCII value of the character
                int ascii = (unsigned char)text[ i ];

                //Show the character
                mBitmap->render( curX, curY, &mChars[ ascii ] );

                //Move over the width of the character with one pixel of padding
                curX += mChars[ ascii ].w + 1;
            }
        }
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For nonspecial characters, we render the sprite. As you can see, it's as simple as getting the ASCII value, rendering the sprite associated with the ASCII value and then moving over the width of the sprite.<br/>
<br/>
The for loop will then keep going through all the characters and rendering the sprite for each of them one after the other.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="41_bitmap_fonts.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Bitmap Fonts">Back to Index</a>


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
	<a href="../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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