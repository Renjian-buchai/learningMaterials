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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac Tiling Engines">
<meta name="description" content="Make levels with tiling engines in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Tiling</title>

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
    <h1 class="text-center">Tiling</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Tiling screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 19th, 2020</b></p>
    
        Tiling is a way of making levels out of uniformly sized reusable pieces. In this tutorial we'll be making a 1280x960 sized level of out only a 160x120 sized tile set.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    Say if we want to make a level like this:
<div class="text-center"><img class="img-fluid" alt="level" src="level.jpg"></div>
<br/>
We could make one huge level or we could create a tile set of 12 pieces:
<div class="text-center"><img class="img-fluid" alt="tiles" src="tiles.jpg"></div>
<br/>
And then create a level out of those pieces allowing us to save memory and save time by reusing pieces. This is why back in the early days of gaming tiling engines were so popular
on low resource systems and are still used today in some games.

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Using SDL, SDL_image, standard IO, strings, and file streams
#include &#60SDL.h&#62
#include &#60SDL_image.h&#62
#include &#60stdio.h&#62
#include &#60string&#62
#include &#60fstream&#62
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our previous tutorials we did our <a href="../33_file_reading_and_writing/index.php">file reading and writing with SDL RWOps</a>. Here we'll be using fstream which is part of the standard C++ library and is relatively easy
to use with text files.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Screen dimension constants
const int SCREEN_WIDTH = 640;
const int SCREEN_HEIGHT = 480;

//The dimensions of the level
const int LEVEL_WIDTH = 1280;
const int LEVEL_HEIGHT = 960;

//Tile constants
const int TILE_WIDTH = 80;
const int TILE_HEIGHT = 80;
const int TOTAL_TILES = 192;
const int TOTAL_TILE_SPRITES = 12;

//The different tile sprites
const int TILE_RED = 0;
const int TILE_GREEN = 1;
const int TILE_BLUE = 2;
const int TILE_CENTER = 3;
const int TILE_TOP = 4;
const int TILE_TOPRIGHT = 5;
const int TILE_RIGHT = 6;
const int TILE_BOTTOMRIGHT = 7;
const int TILE_BOTTOM = 8;
const int TILE_BOTTOMLEFT = 9;
const int TILE_LEFT = 10;
const int TILE_TOPLEFT = 11;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we're defining some constants. We'll be using <a href="../30_scrolling/index.php">scrolling</a> so we have constants for both the screen and the level. We'll also have constants to define the tiles and the tile types.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//The tile
class Tile
{
    public:
        //Initializes position and type
        Tile( int x, int y, int tileType );

        //Shows the tile
        void render( SDL_Rect& camera );

        //Get the tile type
        int getType();

        //Get the collision box
        SDL_Rect getBox();

    private:
        //The attributes of the tile
        SDL_Rect mBox;

        //The tile type
        int mType;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our tile class with a constructor that defines position and type, a renderer that uses a camera, and some accessors to get the tile's type and collision box. In terms of data members we have a collision box and type
indicator.<br/>
<br/>
Normally it's a good idea to have <a href="../27_collision_detection/index.php">position and collider separate when doing collision detection</a>, but for the sake of simplicity we're using the collider to hold position.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//The dot that will move around on the screen
class Dot
{
    public:
        //The dimensions of the dot
        static const int DOT_WIDTH = 20;
        static const int DOT_HEIGHT = 20;

        //Maximum axis velocity of the dot
        static const int DOT_VEL = 10;

        //Initializes the variables
        Dot();

        //Takes key presses and adjusts the dot's velocity
        void handleEvent( SDL_Event& e );

        //Moves the dot and check collision against tiles
        void move( Tile *tiles[] );

        //Centers the camera over the dot
        void setCamera( SDL_Rect& camera );

        //Shows the dot on the screen
        void render( SDL_Rect& camera );

    private:
        //Collision box of the dot
        SDL_Rect mBox;

        //The velocity of the dot
        int mVelX, mVelY;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is the dot class yet again, now with the ability to check for collision against the tiles when moving.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Starts up SDL and creates window
bool init();

//Loads media
bool loadMedia( Tile* tiles[] );

//Frees media and shuts down SDL
void close( Tile* tiles[] );

//Box collision detector
bool checkCollision( SDL_Rect a, SDL_Rect b );

//Checks collision box against set of tiles
bool touchesWall( SDL_Rect box, Tile* tiles[] );

//Sets tiles from tile map
bool setTiles( Tile *tiles[] );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Our media loading function will also be initializing tiles so it needs to take them in as an argument.<br/>
<br/>
We also have the touchesWall function that checks a collision box against every wall in a tile set which will be used when we need to check the dot against the whole tile set. Finally the setTiles function loads and sets the
tiles.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">Tile::Tile( int x, int y, int tileType )
{
    //Get the offsets
    mBox.x = x;
    mBox.y = y;

    //Set the collision box
    mBox.w = TILE_WIDTH;
    mBox.h = TILE_HEIGHT;

    //Get the tile type
    mType = tileType;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The tile constructor initializes position, dimensions, and type.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void Tile::render( SDL_Rect& camera )
{
    //If the tile is on screen
    if( checkCollision( camera, mBox ) )
    {
        //Show the tile
        gTileTexture.render( mBox.x - camera.x, mBox.y - camera.y, &gTileClips[ mType ] );
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When we render we only want to show tiles that are in the camera's sight:
<div class="text-center"><img class="img-fluid" alt="show tiles" src="shown.jpg"></div>
<br/>
So we check if the tile collides with the camera before rendering it. Notice also that we render the tile relative to the camera.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">int Tile::getType()
{
    return mType;
}

SDL_Rect Tile::getBox()
{
    return mBox;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">And here are the accessors to get the tile's type and collision box.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void Dot::move( Tile *tiles[] )
{
    //Move the dot left or right
    mBox.x += mVelX;

    //If the dot went too far to the left or right or touched a wall
    if( ( mBox.x < 0 ) || ( mBox.x + DOT_WIDTH > LEVEL_WIDTH ) || touchesWall( mBox, tiles ) )
    {
        //move back
        mBox.x -= mVelX;
    }

    //Move the dot up or down
    mBox.y += mVelY;

    //If the dot went too far up or down or touched a wall
    if( ( mBox.y < 0 ) || ( mBox.y + DOT_HEIGHT > LEVEL_HEIGHT ) || touchesWall( mBox, tiles ) )
    {
        //move back
        mBox.y -= mVelY;
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When we move the dot we check if it goes off the level or hits a wall tile. If it does we correct it.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void Dot::setCamera( SDL_Rect& camera )
{
    //Center the camera over the dot
    camera.x = ( mBox.x + DOT_WIDTH / 2 ) - SCREEN_WIDTH / 2;
    camera.y = ( mBox.y + DOT_HEIGHT / 2 ) - SCREEN_HEIGHT / 2;

    //Keep the camera in bounds
    if( camera.x < 0 )
    { 
        camera.x = 0;
    }
    if( camera.y < 0 )
    {
        camera.y = 0;
    }
    if( camera.x > LEVEL_WIDTH - camera.w )
    {
        camera.x = LEVEL_WIDTH - camera.w;
    }
    if( camera.y > LEVEL_HEIGHT - camera.h )
    {
        camera.y = LEVEL_HEIGHT - camera.h;
    }
}

void Dot::render( SDL_Rect& camera )
{
    //Show the dot
    gDotTexture.render( mBox.x - camera.x, mBox.y - camera.y );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is the rendering code largely lifted from the scrolling/camera tutorial.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool loadMedia( Tile* tiles[] )
{
    //Loading success flag
    bool success = true;

    //Load dot texture
    if( !gDotTexture.loadFromFile( "39_tiling/dot.bmp" ) )
    {
        printf( "Failed to load dot texture!\n" );
        success = false;
    }

    //Load tile texture
    if( !gTileTexture.loadFromFile( "39_tiling/tiles.png" ) )
    {
        printf( "Failed to load tile set texture!\n" );
        success = false;
    }

    //Load tile map
    if( !setTiles( tiles ) )
    {
        printf( "Failed to load tile set!\n" );
        success = false;
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our loading function we not only load the textures but also the tile set.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool setTiles( Tile* tiles[] )
{
    //Success flag
    bool tilesLoaded = true;

    //The tile offsets
    int x = 0, y = 0;

    //Open the map
    std::ifstream map( "39_tiling/lazy.map" );

    //If the map couldn't be loaded
    if( map.fail() )
    {
        printf( "Unable to load map file!\n" );
        tilesLoaded = false;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Near the top of the setTiles function we declare x/y offsets that define where we'll be placing the tiles. As we load in more tiles we'll be shifting the x/y position left to right and
top to bottom.<br/>
<br/>
We then open the lazy.map file which is just a text file with the following contents:<br/>
<b><pre>
00 01 02 00 01 02 00 01 02 00 01 02 00 01 02 00 
01 02 00 01 02 00 01 02 00 01 02 00 01 02 00 01 
02 00 11 04 04 04 04 04 04 04 04 04 04 05 01 02 
00 01 10 03 03 03 03 03 03 03 03 03 03 06 02 00 
01 02 10 03 08 08 08 08 08 08 08 03 03 06 00 01 
02 00 10 06 00 01 02 00 01 02 00 10 03 06 01 02 
00 01 10 06 01 11 05 01 02 00 01 10 03 06 02 00 
01 02 10 06 02 09 07 02 00 01 02 10 03 06 00 01 
02 00 10 06 00 01 02 00 01 02 00 10 03 06 01 02 
00 01 10 03 04 04 04 05 02 00 01 09 08 07 02 00 
01 02 09 08 08 08 08 07 00 01 02 00 01 02 00 01 
02 00 01 02 00 01 02 00 01 02 00 01 02 00 01 02 
</pre></b>
Using fstream we can read text from a file much like we would read keyboard input with iostream. Before we can continue we have to check if the map loaded correctly. If it failed we abort and if not we continue loading the
file.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    else
    {
        //Initialize the tiles
        for( int i = 0; i < TOTAL_TILES; ++i )
        {
            //Determines what kind of tile will be made
            int tileType = -1;

            //Read tile from map file
            map >> tileType;

            //If the was a problem in reading the map
            if( map.fail() )
            {
                //Stop loading map
                printf( "Error loading map: Unexpected end of file!\n" );
                tilesLoaded = false;
                break;
            }

            //If the number is a valid tile number
            if( ( tileType >= 0 ) && ( tileType < TOTAL_TILE_SPRITES ) )
            {
                tiles[ i ] = new Tile( x, y, tileType );
            }
            //If we don't recognize the tile type
            else
            {
                //Stop loading map
                printf( "Error loading map: Invalid tile type at %d!\n", i );
                tilesLoaded = false;
                break;
            }

</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">If the file loaded successfully we have a for loop that reads in all the numbers from the text file. We read a number into the tileType variable and then check if the read failed. If the read failed, we abort.<br/>
<br/>
If not we then check if the tile type number is valid. If it is valid we create a new tile of the given type, if not we print an error and stop loading tiles.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Move to next tile spot
            x += TILE_WIDTH;

            //If we've gone too far
            if( x >= LEVEL_WIDTH )
            {
                //Move back
                x = 0;

                //Move to the next row
                y += TILE_HEIGHT;
            }
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After loading a tile we move to the text tile position to the right. If we reached the end of a line of tiles, we move down to the next row.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Clip the sprite sheet
        if( tilesLoaded )
        {
            gTileClips[ TILE_RED ].x = 0;
            gTileClips[ TILE_RED ].y = 0;
            gTileClips[ TILE_RED ].w = TILE_WIDTH;
            gTileClips[ TILE_RED ].h = TILE_HEIGHT;

            gTileClips[ TILE_GREEN ].x = 0;
            gTileClips[ TILE_GREEN ].y = 80;
            gTileClips[ TILE_GREEN ].w = TILE_WIDTH;
            gTileClips[ TILE_GREEN ].h = TILE_HEIGHT;

            gTileClips[ TILE_BLUE ].x = 0;
            gTileClips[ TILE_BLUE ].y = 160;
            gTileClips[ TILE_BLUE ].w = TILE_WIDTH;
            gTileClips[ TILE_BLUE ].h = TILE_HEIGHT;

            gTileClips[ TILE_TOPLEFT ].x = 80;
            gTileClips[ TILE_TOPLEFT ].y = 0;
            gTileClips[ TILE_TOPLEFT ].w = TILE_WIDTH;
            gTileClips[ TILE_TOPLEFT ].h = TILE_HEIGHT;

            gTileClips[ TILE_LEFT ].x = 80;
            gTileClips[ TILE_LEFT ].y = 80;
            gTileClips[ TILE_LEFT ].w = TILE_WIDTH;
            gTileClips[ TILE_LEFT ].h = TILE_HEIGHT;

            gTileClips[ TILE_BOTTOMLEFT ].x = 80;
            gTileClips[ TILE_BOTTOMLEFT ].y = 160;
            gTileClips[ TILE_BOTTOMLEFT ].w = TILE_WIDTH;
            gTileClips[ TILE_BOTTOMLEFT ].h = TILE_HEIGHT;

            gTileClips[ TILE_TOP ].x = 160;
            gTileClips[ TILE_TOP ].y = 0;
            gTileClips[ TILE_TOP ].w = TILE_WIDTH;
            gTileClips[ TILE_TOP ].h = TILE_HEIGHT;

            gTileClips[ TILE_CENTER ].x = 160;
            gTileClips[ TILE_CENTER ].y = 80;
            gTileClips[ TILE_CENTER ].w = TILE_WIDTH;
            gTileClips[ TILE_CENTER ].h = TILE_HEIGHT;

            gTileClips[ TILE_BOTTOM ].x = 160;
            gTileClips[ TILE_BOTTOM ].y = 160;
            gTileClips[ TILE_BOTTOM ].w = TILE_WIDTH;
            gTileClips[ TILE_BOTTOM ].h = TILE_HEIGHT;

            gTileClips[ TILE_TOPRIGHT ].x = 240;
            gTileClips[ TILE_TOPRIGHT ].y = 0;
            gTileClips[ TILE_TOPRIGHT ].w = TILE_WIDTH;
            gTileClips[ TILE_TOPRIGHT ].h = TILE_HEIGHT;

            gTileClips[ TILE_RIGHT ].x = 240;
            gTileClips[ TILE_RIGHT ].y = 80;
            gTileClips[ TILE_RIGHT ].w = TILE_WIDTH;
            gTileClips[ TILE_RIGHT ].h = TILE_HEIGHT;

            gTileClips[ TILE_BOTTOMRIGHT ].x = 240;
            gTileClips[ TILE_BOTTOMRIGHT ].y = 160;
            gTileClips[ TILE_BOTTOMRIGHT ].w = TILE_WIDTH;
            gTileClips[ TILE_BOTTOMRIGHT ].h = TILE_HEIGHT;
        }
    }

    //Close the file
    map.close();

    //If the map was loaded fine
    return tilesLoaded;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After all the tiles are loaded we set the clip rectangles for the tile sprites. Finally we close the map file and return.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool touchesWall( SDL_Rect box, Tile* tiles[] )
{
    //Go through the tiles
    for( int i = 0; i < TOTAL_TILES; ++i )
    {
        //If the tile is a wall type tile
        if( ( tiles[ i ]->getType() >= TILE_CENTER ) && ( tiles[ i ]->getType() <= TILE_TOPLEFT ) )
        {
            //If the collision box touches the wall tile
            if( checkCollision( box, tiles[ i ]->getBox() ) )
            {
                return true;
            }
        }
    }

    //If no wall tiles were touched
    return false;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The touchesWall function checks a given collision box against tiles of type TILE_CENTER, TILE_TOP, TILE_TOPRIGHT, TILE_RIGHT, TILE_BOTTOMRIGHT, TILE_BOTTOM, TILE_BOTTOMLEFT, TILE_LEFT, and TILE_TOPLEFT which are all wall
tiles. If you check back when we defined these constants, you'll see that these are numbered right next to each other so all we have to do is check if the type is between TILE_CENTER and TILE_TOPLEFT.<br/>
<br/>
If the given collision box collides with any tile that is a wall this function returns true.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //The level tiles
        Tile* tileSet[ TOTAL_TILES ];

        //Load media
        if( !loadMedia( tileSet ) )
        {
            printf( "Failed to load media!\n" );
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the main function right before we load the media we declare our array of tile pointers.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //While application is running
            while( !quit )
            {
                //Handle events on queue
                while( SDL_PollEvent( &e ) != 0 )
                {
                    //User requests quit
                    if( e.type == SDL_QUIT )
                    {
                        quit = true;
                    }

                    //Handle input for the dot
                    dot.handleEvent( e );
                }

                //Move the dot
                dot.move( tileSet );
                dot.setCamera( camera );

                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render level
                for( int i = 0; i < TOTAL_TILES; ++i )
                {
                    tileSet[ i ]->render( camera );
                }

                //Render dot
                dot.render( camera );

                //Update screen
                SDL_RenderPresent( gRenderer );
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Our main loop is pretty much the same with some adjustments. When we move the dot we pass in the tile set and then set the camera over the dot after it moved. We then render the tile set and finally render the dot over the
level. 
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="39_tiling.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Tiling">Back to Index</a>


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