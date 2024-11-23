<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" 
"http://www.w3.org/TR/REC-html40/strict.dtd">
<html>

<head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VP5RSQ168Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VP5RSQ168Y');
</script>



<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">

<META NAME=KEYWORDS CONTENT="Lazy Foo' Productions C++ SDL Window Linux Mac Game Programming Tutorials">

<META NAME=DESCRIPTION CONTENT="Tutorials for those who want to start making video games.">

<title>Lazy Foo' Productions</title>

<link REL="stylesheet" TYPE="text/css" href="../lazy.css">
</head>

<body>

<div class="header">
<h1 style="margin-bottom:0px;padding-bottom:0px;border-bottom:0px;">Lazy Foo' Productions</h1>

<div class="nav">
Yes, I am keeping the old tutorial set in the old layout for the sake of having a nostalgic eater egg. It's not because I am too lazy to port this over to the data driven static site generator.<br/>
<br/>
<a class="nav" href="https://discourse.libsdl.org/">SDL Forums</a>
<a class="nav" href="../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../articles/index.php">Articles</a>
<a class="nav" href="../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../index.php">News</a>
<a class="nav" href="../../faq.php">FAQs</a>
<a class="nav" href="../../contact.php">Contact</a>
<a class="nav" href="../../donate.php">Donations</a><br/>
<br/>

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

</div>

</div>

<div class="content">
<div class="tutPreface"><h1 class="tutHead">Bitmap Fonts</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 6/09/12</h6>
Good fonting programs can be expensive, and sometimes font APIs (like SDL_ttf) are simply not flexible enough.
While time consuming, making your own bitmap font engine can be useful. This tutorial will teach you to make a
common style bitmap font.<br/>
<br/>
<a class="tutLink" href="../../tutorials/SDL/41_bitmap_fonts/index.php">Bitmap Fonts tutorial with SDL 2</a> is now available.
</div>

<div class="tutText">
A bitmap font is simply a sprite sheet.<br>
<br>
If we wanted to make "HELLO" show on the screen we would do this:<br>
<div class="tutImg"><img src="sprites.jpg"></div>
We would take the "H" sprite, the "E" sprite, two of the "L" sprite, and finally the "O" sprite
and then show them on the screen one after the other.<br>
<br>
Now that you know the basic concept, it's time to make a bitmap fonting engine.
</div>

<div class="tutCode">//Our bitmap font
class BitmapFont
{
    private:
    //The font surface
    SDL_Surface *bitmap;

    //The individual characters in the surface
    SDL_Rect chars[ 256 ];

    //Spacing Variables
    int newLine, space;

    public:
    //The default constructor
    BitmapFont();

    //Generates the font when the object is made
    BitmapFont( SDL_Surface *surface );

    //Generates the font
    void build_font( SDL_Surface *surface );

    //Shows the text
    void show_text( int x, int y, std::string text, SDL_Surface *surface );
};
</div>

<div class="tutText">
Here is our bitmap font class.<br>
<br>
First thing we have is the surface of the bitmap font. Then we have to have an array of rectangles to clip the 
letters from the bitmap font. We have 256 of them, one for each of the extended ASCII characters. We have two
integers, "newLine" and "space" that determine the distance between lines of text and the distance between two
words.<br>
<br>
Then we have our constructors.
We also have a build_font() to initialize the font.
Finally, we have show_text() to show text on the screen.
</div>

<div class="tutCode">Uint32 get_pixel32( int x, int y, SDL_Surface *surface )
{
    //Convert the pixels to 32 bit
    Uint32 *pixels = (Uint32 *)surface->pixels;
    
    //Get the pixel requested
    return pixels[ ( y * surface->w ) + x ];
}
</div>

<div class="tutText">
First off we need to make a function that gets an individual pixel from a surface.
Why the SDL API doesn't have one built in I'll never know.<br>
<br>
First thing we do is convert the pixel pointer from type void to 32bit integer so we can properly access them.
After all, a surface's pixels are nothing more than an array of 32bit integers.
Then we get or set the requested pixel.<br>
<br>
You maybe be wondering why I don't just go "return pixels[ x ][ y ]".<br>
<br>
The thing is the pixels aren't stored like this:<br>
<div class="tutImg"><img src="2d.jpg"></div>
<br>
They're stored like this:<br>
<div class="tutImg"><img src="1d.jpg"></div>
in a single dimensional array.
Its because different operating systems store 2D arrays differently (At least I think that's why).<br>
<br>
So to retrieve the red pixel from the array we multiply the y offset by the width and add the x offset.<br>
<br>
These functions only work for 32-bit surfaces.
You'll have to make one of your own if you're using a different format.
</div>

<div class="tutCode">BitmapFont::BitmapFont()
{
    //Initialize variables
    bitmap = NULL;
    newLine = 0;
    space = 0;
}

BitmapFont::BitmapFont( SDL_Surface *surface )
{
    //Build the font
    build_font( surface );
}
</div>

<div class="tutText">
Here are our constructors.<br>
<br>
The first one simply initializes our variables to 0. The second one creates the object and builds the font with
the given variables.
</div>

<div class="tutCode">void BitmapFont::build_font( SDL_Surface *surface )
{
    //If surface is NULL
    if( surface == NULL )
    {
        return;
    }
    
    //Get the bitmap
    bitmap = surface;
    
    //Set the background color
    Uint32 bgColor = SDL_MapRGB( bitmap->format, 0, 0xFF, 0xFF );
</div>

<div class="tutText">
Now it's time to build our font. We have to first check that a valid surface was given to us.<br>
<br>
Then we get the actual bitmap font surface from the given argument. Then we set the background color.
</div>

<div class="tutCode">    //Set the cell dimensions
    int cellW = bitmap->w / 16;
    int cellH = bitmap->h / 16;

    //New line variables
    int top = cellH;
    int baseA = cellH;
</div>

<div class="tutText">
Here we calculate the cell width and height. What are cells? Cells are used to arrange the letters on our bitmap
to make it easy to get the individual characters.<br>
<br>
A typical bitmap font has the 256 characters in ASCII order. Each of the letters are in a uniformly sized cell and
are laid out in 16 columns and 16 rows. It looks like this:<br>
<div class="tutImg"><img src="cells.jpg"></div>
The lines lining the cell don't have to be there, they're just there to show how the cells look. To calculate cell
width, divide the image width by 16 since there are 16 equal columns. The same thing is done with the height.<br>
<br>
The variables "top" and "baseA" are going to be used to calculate how much space we need between lines. You'll
see how we use them later.<br>
<br>
Now that we've got our bitmap and set the cells, it's time to clip the individual letters.
<br>

</div>

<div class="tutCode">    //The current character we're setting
    int currentChar = 0;
    
    //Go through the cell rows
    for( int rows = 0; rows < 16; rows++ )
    {
        //Go through the cell columns
        for( int cols = 0; cols < 16; cols++ )
        {
</div>

<div class="tutText">
First off, we make an integer to keep track of which character we're setting. Then we go through the rows of the
cells, then through each individual column.
</div>

<div class="tutCode">            //Set the character offset
            chars[ currentChar ].x = cellW * cols;
            chars[ currentChar ].y = cellH * rows;
            
            //Set the dimensions of the character
            chars[ currentChar ].w = cellW;
            chars[ currentChar ].h = cellH;
</div>

<div class="tutText">
Then we set the default offsets and dimensions of the current character which are the offsets and dimensions of
the cell. Certain ASCII values have no character assigned to them so the default values will never change.<br>
<br>
However, most characters will not all have the same x offsets or widths. So we go through the each of the cells to
set the unique clip rectangles of each character.
</div>

<div class="tutCode">            //Find Left Side
            //Go through pixel columns
            for( int pCol = 0; pCol < cellW; pCol++ )
            {
                //Go through pixel rows
                for( int pRow = 0; pRow < cellH; pRow++ )
                {
                    //Get the pixel offsets
                    int pX = ( cellW * cols ) + pCol;
                    int pY = ( cellH * rows ) + pRow;
</div>

<div class="tutText">
Now we go through the pixels in the cell. Notice how our nested for loops are structured. We go through each
column, then we go through the column top to bottom.<br>
<br>
We calculate the offset by adding the relative pixel offset to the cell's offset.
</div>

<div class="tutCode">                    //If a non colorkey pixel is found
                    if( get_pixel32( pX, pY, bitmap ) != bgColor )
                    {
                        //Set the x offset
                        chars[ currentChar ].x = pX;
                        
                        //Break the loops
                        pCol = cellW;
                        pRow = cellH;
                    }
                }
            }
</div>

<div class="tutText">
As we're going through the pixels in the cell, we scan for a pixel that is not of the background color like so:<br>
<div class="tutImg"><img src="fishing.gif"></div>
When a non background pixel is found that means we found the x offset of the character. We set the x offset of the
sprite then crudely break the loop.
</div>

<div class="tutCode">            //Find Right Side
            //Go through pixel columns
            for( int pCol_w = cellW - 1; pCol_w >= 0; pCol_w-- )
                //Go through pixel rows
            {
                for( int pRow_w = 0; pRow_w < cellH; pRow_w++ )
                {
                    //Get the pixel offsets
                    int pX = ( cellW * cols ) + pCol_w;
                    int pY = ( cellH * rows ) + pRow_w;

                    //If a non colorkey pixel is found
                    if( get_pixel32( pX, pY, bitmap ) != bgColor )
                    {
                        //Set the width
                        chars[ currentChar ].w = ( pX - chars[ currentChar ].x ) + 1;

                        //Break the loops
                        pCol_w = -1;
                        pRow_w = cellH;
                    }
                }
            }
</div>

<div class="tutText">
Then we do pretty much the same thing for the width. However, this time we start from the right and move left.
When we find a pixel of the character, the width is calculated by subtracting the x offset from the offset of the
pixel we found and adding one.
</div>

<div class="tutCode">            //Find Top
            //Go through pixel rows
            for( int pRow = 0; pRow < cellH; pRow++ )
            {
                //Go through pixel columns
                for( int pCol = 0; pCol < cellW; pCol++ )
                {
                    //Get the pixel offsets
                    int pX = ( cellW * cols ) + pCol;
                    int pY = ( cellH * rows ) + pRow;

                    //If a non colorkey pixel is found
                    if( get_pixel32( pX, pY, bitmap ) != bgColor )
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
</div>

<div class="tutText">
Here we scan the cell pixels from top to bottom instead of side to side like before. What we're trying to find is
what's the tallest character in our bitmap font.<br>
<br>
We use the "pRow" variable because we want the offset relative to the cell. "pY" is the offset relative to the
bitmap surface.
</div>

<div class="tutCode">            //Find Bottom of A
            if( currentChar == 'A' )
            {
                //Go through pixel rows
                for( int pRow = cellH - 1; pRow >= 0; pRow-- )
                {
                    //Go through pixel columns
                    for( int pCol = 0; pCol < cellW; pCol++ )
                    {
                        //Get the pixel offsets
                        int pX = ( cellW * cols ) + pCol;
                        int pY = ( cellH * rows ) + pRow;

                        //If a non colorkey pixel is found
                        if( get_pixel32( pX, pY, bitmap ) != bgColor )
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
            currentChar++;
        }
    }
</div>

<div class="tutText">
If the current cell we're scanning belongs to capitial A, we're going to find the bottom of A relative to cell.
We're going to use this as our baseline. Certain characters like g, j, and y have their character image go below
the baseline. You'll see how we use the baseline later.<br>
<br>
Once we're done setting the current character, we increment the counter to move onto the next character.<br>
<br>
Remember, in order for this function to work properly the bitmap font has to have the 256 characters in ASCII
order and laid out in 16 columns and 16 rows. Any other way would require you to create your own building
function.<br>
</div>

<div class="tutCode">    //Calculate space
    space = cellW / 2;

    //Calculate new line
    newLine = baseA - top;

    //Lop off excess top pixels
    for( int t = 0; t < 256; t++ )
    {
        chars[ t ].y += top;
        chars[ t ].h -= top;
    }
}
</div>

<div class="tutText">
After we're done going through all the cells, we do some extra things to properly space the text.<br>
<br>
We set the space to be half the cell width. "newLine" which is how much space is between lines of text. It's set
to be the baseline minus highest known character height.<br>
<br>
At the end of font loading function, we go through the character clip rectangles and cut off the extra pixels on
top. 
</div>

<div class="tutCode">void BitmapFont::show_text( int x, int y, std::string text, SDL_Surface *surface )
{
    //Temp offsets
    int X = x, Y = y;
</div>

<div class="tutText">
Now here's the function that actually shows the text.<br>
<br>
First thing we do is get the given offsets and store them in the temp offsets. The offsets given in the arguments
serve as base offsets, the temp offsets are where the next sprite will be blitted.
</div>

<div class="tutCode">    //If the font has been built
    if( bitmap != NULL )
    {
        //Go through the text
        for( int show = 0; show < text.length(); show++ )
        {
</div>

<div class="tutText">
Then we check if a bitmap was given for us to use. If there is one, we go through the characters in the string.
</div>

<div class="tutCode">            //If the current character is a space
            if( text[ show ] == ' ' )
            {
                //Move over
                X += space;
            }
            //If the current character is a newline
            else if( text[ show ] == '\n' )
            {
                //Move down
                Y += newLine;

                //Move back
                X = x;
            }
</div>

<div class="tutText">
First thing we do here is check if the current character is a space or a newline.<br>
<br>
If the character is a space, we move over the space assigned in the build_font() function. If the character is a
newline the temp offset goes down the cell height, and then moves back to the base x offset.<br>
</div>

<div class="tutCode">            else
            {
                //Get the ASCII value of the character
                int ascii = (unsigned char)text[ show ];
                
                //Show the character
                apply_surface( X, Y, bitmap, surface, &chars[ ascii ] );
                
                //Move over the width of the character with one pixel of padding
                X += chars[ ascii ].w + 1;
            }
        }
    }
}
</div>

<div class="tutText">
If the current character is not one of our special characters we apply the character's sprite on the screen.<br>
<br>
To show the character first we have to get the ASCII value by type casting the character to an integer. Then we
apply the sprite onto the screen. This is easily done since the sprites are in ASCII order.<br>
<br>
Then the temp offset is moved over the width of the sprite plus one. That way the next sprite will be applied next
to the previous sprite with one pixel of padding.<br>
<br>
We keep looping through this until all the characters are shown.
</div>

<div class="tutCode">    //Create our font
    BitmapFont font( bitmapFont );
    
    //Fill the screen white
    SDL_FillRect( screen, &screen->clip_rect, SDL_MapRGB( screen->format, 0xFF, 0xFF, 0xFF ) );
    
    //Show the text
    font.show_text( 100, 100, "Bitmap Font:\nABDCEFGHIJKLMNOPQRSTUVWXYZ\nabcdefghijklmnopqrstuvwxyz\n0123456789", screen );
    
    //Update the screen
    if( SDL_Flip( screen ) == -1 )
    {
        return 1;    
    }
</div>

<div class="tutText">
Here's a basic demonstration of our bitmap class that we do in the main() function.<br>
<br>
All we do is create a font object, fill screen white, apply some text, and update the screen.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson30.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson29/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson31/index.php">Next Tutorial</a><br>
</div>

</div>

<div class="footer">


<div class="nav">

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
<br/>
<a class="nav" href="https://discourse.libsdl.org/">SDL Forums</a>
<a class="nav" href="../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../articles/index.php">Articles</a>
<a class="nav" href="../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../index.php">News</a>
<a class="nav" href="../../faq.php">FAQs</a>
<a class="nav" href="../../contact.php">Contact</a>
<a class="nav" href="../../donate.php">Donations</a>
</div>

<h6>Copyright Lazy Foo' Productions 2004-2024</h6>
</div>

</body>
</html>