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
<meta name="keywords" content="C++ 2D Windows Linux Mac level editors">
<meta name="description" content="Make level editors for your game.">

<link href="../../assets/style.css" rel="stylesheet">
<script src="../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Level Editors</title>

<script src="../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
	<a href="../../tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../index.php" class="nav-item nav-link">Articles</a>
	<a href="../../tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../index.php" class="nav-item nav-link">News</a>
	<a href="../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../donate.php" class="nav-item nav-link">Donations</a>
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
    <h1 class="text-center">Level Editors</h1>
    
    <p class="text-center"><b>Last Updated: Aug 10th, 2022</b></p>
    
        Having to hard code your levels is a pain. Fortunately you can make and save a level with a level editor. Here you'll get the basics on how to make one.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    In this article we're going to be using the tiling engine from the <a href="../../tutorials/SDL/39_tiling/index.php">Tiling tutorial</a>. This article assumes you've read it, so if you haven't already, you 
should read it now.<br/>
<br/>
When it comes to level editors, there's 3 basic things you need. To demonstrate the first two things, I've made this video:<br/>
<br/>
<div class="text-center">
This is a demo of the debug mode for Sonic the Hedgehog for the Sega Genesis:<br/>
<iframe width="560" height="315" src="https://www.youtube.com/embed/qe5DcNbehy8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br/>
The code to activate it is (at the title screen) press C, C, Up, Down, Left, Right, Hold A, Start and keep holding A 'til the first level appears.
</div>
<br/>
In this video I goof around with the debug mode. The debug mode is not a full level editor but it has two features you want to pay attention to: the ability to choose a game object and place it where you want. With our
level editor, we're going to be able to choose a tile and place it where we want on our tile map.<br/>
<br/>
Now what is this missing to be able to be a full fledged level editor? Simple, you can't save and load what you made. We already covered how to load a tile map in the tiling tutorial, and we'll cover saving in this article.<br/>
<br/>
Now let's get started with our level editor.

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//The different tile sprites
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

//The reflected tile types
const char* TILE_NAMES[] =
{
    "TILE_RED",
    "TILE_GREEN",
    "TILE_BLUE",
    "TILE_CENTER",
    "TILE_TOP",
    "TILE_TOPRIGHT",
    "TILE_RIGHT",
    "TILE_BOTTOMRIGHT",
    "TILE_BOTTOM",
    "TILE_BOTTOMLEFT",
    "TILE_LEFT",
    "TILE_TOPLEFT"
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">We'll be defining human readable versions of our tile constants for later.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Level camera/cursor
            SDL_Rect camera = { 0, 0, SCREEN_WIDTH, SCREEN_HEIGHT };
            SDL_Point cursor = { SCREEN_WIDTH / 2, SCREEN_HEIGHT / 2 };

            //Current tile type
            int curTileType = TILE_RED;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Instead of moving around the level with a keyboard controlled dot, we'll moving around a cursor with the mouse. We'll also need to keep track of the current type of tile we're placing, so we'll need variables
for both of these in addition to the camera.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                    //Move cursor with mouse
                    else if( e.type == SDL_MOUSEMOTION )
                    {
                        cursor.x = e.motion.x;
                        cursor.y = e.motion.y;
                    }
                    //Cycle through tile types with mouse wheel
                    else if( e.type == SDL_MOUSEWHEEL )
                    {
                        //Wheel up
                        if( e.wheel.y > 0 )
                        {
                            --curTileType;
                            if( curTileType < TILE_RED )
                            {
                                curTileType = TILE_TOPLEFT;
                            }

                            SDL_SetWindowTitle( gWindow, TILE_NAMES[ curTileType ] );
                        }
                        //Wheel down
                        else
                        {
                            ++curTileType;
                            if( curTileType > TILE_TOPLEFT )
                            {
                                curTileType = TILE_RED;
                            }

                            SDL_SetWindowTitle( gWindow, TILE_NAMES[ curTileType ] );
                        }
                    }
                    //Place tile on click
                    else if( e.type == SDL_MOUSEBUTTONDOWN )
                    {
                        SDL_SetWindowTitle( gWindow, TILE_NAMES[ curTileType ] );
                        putTile( tileSet, cursor, camera, curTileType );
                    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When we move the mouse we update the cursor position, when we scroll the mouse wheel we cycle through the tile types, and when we click the mouse we place a tile (we'll cover how this function works in a bit).
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Move camera towards cursor
                if( cursor.x < SCREEN_WIDTH / 4 )
                {
                    camera.x -= CURSOR_VEL;
                }
                if( cursor.x > SCREEN_WIDTH * 3 / 4 )
                {
                    camera.x += CURSOR_VEL;
                }
                if( cursor.y < SCREEN_HEIGHT / 4 )
                {
                    camera.y -= CURSOR_VEL;
                }
                if( cursor.y > SCREEN_HEIGHT * 3 / 4 )
                {
                    camera.y += CURSOR_VEL;
                }

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
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When the cursor goes in the top/bottom/right/left quarter of the screen, we scroll the camera to catch up to the cursor. After moving the camera, we should make sure to keep it in bounds.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render level
                for( int i = 0; i < TOTAL_TILES; ++i )
                {
                    tileSet[ i ]->render( camera );
                }

                //Render dot like cursor
                gDotTexture.render( cursor.x - gDotTexture.getWidth() / 2, cursor.y - gDotTexture.getHeight() / 2 );

                //Update screen
                SDL_RenderPresent( gRenderer );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Lastly for our rendering, we render the tiles and then the cursor on top of it.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void putTile( Tile *tiles[], SDL_Point cursor, SDL_Rect camera, int tileType )
{
    //Offset cursor by camera
    SDL_Rect box = { cursor.x + camera.x, cursor.y + camera.y, 0, 0 };

    //Go through the tiles
    for( int i = 0; i < TOTAL_TILES; ++i )
    {
        //If the collision box touches this tile
        if( checkCollision( box, tiles[ i ]->getBox() ) )
        {
            //Set tile
            tiles[ i ]->setType( tileType );
            break;
        }
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Placing tiles is fairly simple. We calculate a collision point by taking the cursor and offsetting it by the camera, and then checking which tile the cursor is touching.<br/>
<br/>
When we find tile the cursor collides with, we set it to be the type we want.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void saveTiles( Tile *tiles[] )
{
    //Open the map
    std::ofstream map( "09_level_editors/lazy.map" );

    //Go through the tiles
    for( int t = 0; t < TOTAL_TILES; t++ )
    {
        //Write tile type to file
        map << tiles[ t ]->getType() << " ";
    }

    //Close the file
    map.close();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Lastly, our map saving function just writes out the tile values to the text file. I didn't bother going over the file loading because it is literally copy/pasted from the tiling tutorial.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">
    So that's it for the level editor made for this article. The next section of the article assumes you have a good handle on inheritance and polymorphism. As I said in the state machines article, if you don't know these OOP
concepts already you should learn them if you want to make anything complex in C++.<br/>
<br/>
The tiling engine we use here is a simple one. We only have tile objects and their only difference is their sprite and being a floor or a wall type. What about more complex level engines?<br/>
<br/>
A common way to organize your different level object classes is to have a base class and have your different classes inherit from it.

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">class GameObject
{
    //Stuff
};

class Wall : public GameObject
{
    //Stuff
};

class Door : public GameObject
{
    //Stuff
};

class ThisThing : public GameObject
{
    //Stuff
};

class ThatThing : public GameObject
{
    //Stuff
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">This would be a way to organize your classes for your game. We have a base game object class and we have our game objects inherit from it. 
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void putObject( std::vector&#060GameObject*&#062 &level, int objectType )
{
    //Mouse offsets
    int x = 0, y = 0;
    
    //Get mouse offsets
    SDL_GetMouseState( &x, &y );
    
    //Adjust to camera
    x += camera.x;
    y += camera.y;

    //Place object
    switch( objectType )
    {
        case LVLOBJ_THIS:
        level.push_back( new ThisThing( x, y ) );    
        break;
        
        case LVLOBJ_THAT:
        level.push_back( new ThatThing( x, y ) );    
        break;   
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's what a placement function might look like. It simply adds in a new game object to the level at the place the user specified.<br/>
<br/>
Well placing new objects in the level was easy enough but how do you save the objects?
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void ThisThing::write_info( std::ofstream &save )
{
    //Write type
    save << LVLOBJ_THIS << " "; 
    
    //Write attributes
    save << x << " ";
    save << y << " ";
    save << maxHealthPoints << " ";
    save << weapon << " ";
    save << etc << " ";   
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">What you can do is have a save function that goes through the level objects, then give your objects a function that writes their attributes to a file.<br/>
<br/>
Here we have a function that takes in a reference to a save file. First we write the object type to the file, and after that we write the various attributes to the file.<br/>
<br/>
Writing the level objects was easy enough, but what about reading them?
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Go through file
        while( file.eof()! )
        {
            //Determines what kind of object will be made
            int objectType = -1;
    
            //Read level object type from level file
            file >> objectType;
        
            //If there was a problem in reading the level file
            if( map.fail() == true )
            {
                //Stop loading level
                map.close();
                return false;
            }
        
            //Place object
            switch( objectType )
            {
                case LVLOBJ_THIS:
                level.push_back( new ThisThing( file ) );    
                break;
        
                case LVLOBJ_THAT:
                level.push_back( new ThatThing( file ) );    
                break;   
            }
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When we wrote the level object to the file, we had each object write a set of attributes to a file. The first thing in each of the sets was the type of object.<br/>
<br/>
When reading in objects we would read the first character to determine what kind of object the attribute set belongs to. Then we add the proper object to the level and pass a reference of the file to the constructor of the
new object.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">ThisThing::ThisThing( std::ifstream &load )
{
    //Get attributes
    load >> x;
    load >> y;
    load >> maxHealthPoints;
    load >> weapon;
    load >> etc;   
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now the constructor can continue reading the file and get its attributes. Once this object is constructed, the loading function will continue reading more objects.<br/>
<br/>
Now what if you want to edit objects while in the editor?
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        while( SDL_PollEvent( &event ) )
        {
            //When the user clicks
            if( event.type == SDL_MOUSEBUTTONDOWN )
            {
                //On left mouse click
                if( event.button.button == SDL_BUTTON_LEFT )
                {
                    //Select an object
                    select_level_object( level, selectedObject );
                }
            }
            
            //Edit level object
            if( selectedObject != NULL )
            {
                selectedObject->handle_edit();
            }
        }
</pre>




                    
                
                    
                        

<pre class="border my-0 py-3">        //Show edit interface
        if( selectedObject != NULL )
        {
            selectedObject->show_edit();
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">You could give your game objects functions that allow you to edit their attributes.<br/>
<br/>
You would need something to select the game objects, a function to handle events to edit the object's attributes,
and a function that shows the attribute editor.<br/>
<br/>
The above two segments of psuedo code show what these might look like.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void select_level_object( std::vector<GameObject*> &level, GameObject* &selected )
{
    //Mouse offsets
    int x = 0, y = 0;
    
    //Get mouse offsets
    SDL_GetMouseState( &x, &y );
    
    //Adjust to camera
    x += camera.x;
    y += camera.y;

    //Don't want to point to old selected object.
    selected = NULL;

    //Go through level objects
    for( int o = 0; o < level.size(); o++ )
    {
        //If the mouse touches a level object
        if( mouse_touches( level[ o ] ) == true )
        {
            selected = level[ o ];
        }
    }
}

void ThisThing::handle_edit()
{
    //Handle GUI Objects
    hpEditor.handle_events();
    weaponEditor.handle_events();
    etcEditor.handle_events();
}

void ThisThing::show_edit()
{
    //Show GUI Objects
    hpEditor.show();
    weaponEditor.show();
    etcEditor.show();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">This is what the object selecting and attribute editing functions might look like. Now that we're getting to into GUIs, I would recommend using a GUI library if you're going to do any complex GUIs. You could roll your own GUIs
like in this psuedo code, but some people think it's like pulling teeth. It's your level designer so it's up to you.<br/>
<br/>
There is other stuff we could cover, like using binary file IO as opposed to ASCII like we did here, file selectors, or adding all sort of other features, but you have the fundamentals. The hardest part is getting off the
ground, so the rest you should be able to figure out with a little creative thinking and googling.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">



<a href="09_level_editors.zip">Download the media and source code for this demo here.</a><br/>
<br/>





<a href="../index.php#Level Editors">Back to Index</a>


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
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
	<a href="../../tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../index.php" class="nav-item nav-link">Articles</a>
	<a href="../../tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../index.php" class="nav-item nav-link">News</a>
	<a href="../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>