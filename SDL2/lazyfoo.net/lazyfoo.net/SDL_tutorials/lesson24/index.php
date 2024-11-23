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
<div class="tutPreface"><h1 class="tutHead">Game Saves</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/28/10</h6>
Ever wanted to know how to save data from your game? Whether saving settings or progress in a game you need to
know file input/output. This program will save the background type and the dot's offsets. So when we start the
program up again the dot and background will be the same as when we closed the program.<br>
<br>
Here's yet another incarnation of the motion tutorial to show you how to get input and output from a file to
save/load game data.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/33_file_reading_and_writing/index.php">File Reading and Writing tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">#include "SDL/SDL.h"
#include "SDL/SDL_image.h"
#include &#060string&#062
#include &#060fstream&#062
</div>

<div class="tutText">
You need to include the fstream header to read/write a file.
It's a standard library and not part of SDL.
</div>

<div class="tutCode">//The dot
class Dot
{
    private:
    //The X and Y offsets of the dot
    int x, y;
    
    //The velocity of the dot
    int xVel, yVel;
    
    public:
    //Initializes the variables
    Dot();
    
    //Takes key presses and adjusts the dot's velocity
    void handle_input();
    
    //Moves the dot
    void move();
    
    //Shows the dot on the screen
    void show();
    
    //Set the dot's x/y offsets
    void set_x( int X );
    void set_y( int Y );
    
    //Get the dot's x/y offsets
    int get_x();
    int get_y();
};
</div>

<div class="tutText">
Here's the Dot class yet again.
The only real change here is that we added functions to get/set the x and y offsets.
</div>

<div class="tutCode">bool load_files( Dot &thisDot, Uint32 &bg )
{    
    //Load the dot image
    dot = load_image( "dot.png" );
    
    //If there was a problem in loading the dot
    if( dot == NULL )
    {
        return false;    
    }
    
    //Open a file for reading
    std::ifstream load( "game_save" );
</div>

<div class="tutText">
In the load_files() function after we load our image we create an ifstream object.<br>
<br>
ifstream allows you to get <b>i</b>nput from a <b>f</b>ile stream.
When you pass a file name to the constructor, it opens the file for reading.
</div>

<div class="tutCode">    //If the file loaded
    if( load != NULL )
    {
        //The offset
        int offset;
        
        //The level name
        std::string level;
        
        //Set the x offset
        load >> offset;
        thisDot.set_x( offset );
        
        //Set the y offset
        load >> offset;
        thisDot.set_y( offset );
</div>

<div class="tutText">
When there's a problem in loading the file, the ifstream object will be NULL.<br>
<br>
Here we check if the file loaded fine. If it loaded fine, we declare "offset" to retrieve the offsets and "level"
which we'll use to determine how to set the background.<br>
<br>
Then we get first integer from the file and set the x offset of the dot. Then we get another integer and use it to
set the y offset. As you can see, we get integers with ifstreams the same way we would with cin. That's because
they're both istreams (input streams).<br>
<br>
The contents of the "game_save" file will be something like this:<br>
<b>0 0<br>
White Level</b><br>
<br>
Seeing as the file and what we enter in console apps are just characters it makes sense to treat them almost the same.<br>
</div>

<div class="tutCode">        //If the x offset is invalid
        if( ( thisDot.get_x() < 0 ) || ( thisDot.get_x() > SCREEN_WIDTH - DOT_WIDTH ) )
        {
            return false;
        }
        
        //If the y offset is invalid
        if( ( thisDot.get_y() < 0 ) || ( thisDot.get_y() > SCREEN_HEIGHT - DOT_HEIGHT ) )
        {
            return false;
        }
</div>

<div class="tutText">
We also have to check if the offsets from the file are valid considering the user can easily alter the file.
</div>

<div class="tutCode">        //Skip past the end of the line
        load.ignore();
        
        //Get the next line
        getline( load, level );
        
        //If an error occurred while trying to load data
        if( load.fail() == true )
        {
            return false;    
        }
</div>

<div class="tutText">
Then we skip past the next character (which is a '\n') with the ignore() function.
Then we get the next line and store it with the getline() function.
getline() is a different from using >> in that it gets everything up until the end of the line.<br>
<br>
For you guys still using Visual C++ 6.0 you'll have to std::getline().<br>
<br>
Then we check if there was a problem in reading from the file.
The fail() function will return true when there's a problem.
</div>

<div class="tutCode">        //If the level was white
        if( level == "White Level" )
        {
            //Set the background color
            bg = SDL_MapRGB( screen->format, 0xFF, 0xFF, 0xFF );
        }
        //If the level was red
        else if( level == "Red Level" )
        {
            //Set the background color
            bg = SDL_MapRGB( screen->format, 0xFF, 0x00, 0x00 );
        }
        //If the level was green
        else if( level == "Green Level" )
        {
            //Set the background color
            bg = SDL_MapRGB( screen->format, 0x00, 0xFF, 0x00 );
        }
        //If the level was blue
        else if( level == "Blue Level" )
        {
            //Set the background color
            bg = SDL_MapRGB( screen->format, 0x00, 0x00, 0xFF );
        }
</div>

<div class="tutText">
Now that we have our level string, we set the background color accordingly.
</div>

<div class="tutCode">        //Close the file
        load.close();
    }

    //If everything loaded fine
    return true;
}
</div>

<div class="tutText">
After we're done reading from the file we close it.
</div>

<div class="tutCode">void clean_up( Dot &thisDot, Uint32 &bg )
{
    //Free the surface
    SDL_FreeSurface( dot );
    
    //Open a file for writing
    std::ofstream save( "game_save" );
    
    //Write offsets to the file
    save << thisDot.get_x();
    save << " ";
    save << thisDot.get_y();
    save << "\n";
</div>

<div class="tutText">
In the clean_up() function, we create a ofstream to write to a file.
ofstream allows you to <b>o</b>utput to a <b>f</b>ile stream.<br>
<br>
Since ifstream was similar to cin, it makes sense that ofstream is similar to cout.<br>
<br>
In this piece of code we write the dot's offsets to a file.
</div>

<div class="tutCode">    //The RGB values from the background
    Uint8 r, g, b;
    
    //Get RGB values from the background color
    SDL_GetRGB( bg, screen->format, &r, &g, &b );
</div>

<div class="tutText">
Then we get the individual R, G and B values from the background using SDL_GetRGB().
</div>

<div class="tutCode">    //If the background was white
    if( ( r == 0xFF ) && ( g == 0xFF ) && ( b == 0xFF ) )
    {
        //Write level type to the file
        save << "White Level";
    }
    //If the background was red
    else if( r == 0xFF )
    {
        //Write level type to the file
        save << "Red Level";
    }
    //If the background was green
    else if( g == 0xFF )
    {
        //Write level type to the file
        save << "Green Level";
    }
    //If the background was blue
    else if( b == 0xFF )
    {
        //Write level type to the file
        save << "Blue Level";
    }
</div>

<div class="tutText">
After that, we write the level type.
</div>

<div class="tutCode">    //Close the file
    save.close();
    
    //Quit SDL
    SDL_Quit();
}
</div>

<div class="tutText">
Lastly, we close the file.
</div>

<div class="tutCode">    //Quit flag
    bool quit = false;
    
    //Initialize
    if( init() == false )
    {
        return 1;
    }
    
    //The dot
    Dot myDot;

    //The background color
    Uint32 background = SDL_MapRGB( screen->format, 0xFF, 0xFF, 0xFF );
        
    //The frame rate regulator
    Timer fps;
    
    //Load the files
    if( load_files( myDot, background ) == false )
    {
        return 1;
    }
</div>

<div class="tutText">
Here you see how we use our load_files() function.
</div>

<div class="tutCode">    //While the user hasn't quit
    while( quit == false )
    {
        //Start the frame timer
        fps.start();
        
        //While there's events to handle
        while( SDL_PollEvent( &event ) )
        {
            //Handle events for the dot
            myDot.handle_input();
            
            //If the user has pressed at key
            if( event.type == SDL_KEYDOWN )
            {
                //Change background according to key press
                switch( event.key.keysym.sym )
                {
                    case SDLK_1: background = SDL_MapRGB( screen->format, 0xFF, 0xFF, 0xFF ); break;
                    case SDLK_2: background = SDL_MapRGB( screen->format, 0xFF, 0x00, 0x00 ); break;
                    case SDLK_3: background = SDL_MapRGB( screen->format, 0x00, 0xFF, 0x00 ); break; 
                    case SDLK_4: background = SDL_MapRGB( screen->format, 0x00, 0x00, 0xFF ); break;     
                }
            }
            
            //If the user has Xed out the window
            if( event.type == SDL_QUIT )
            {
                //Quit the program
                quit = true;
            }
        }
        
        //Move the dot
        myDot.move();
        
        //Fill the background
        SDL_FillRect( screen, &screen->clip_rect, background );
        
        //Show the dot on the screen
        myDot.show();
        
        //Update the screen
        if( SDL_Flip( screen ) == -1 )
        {
            return 1;    
        }
        
        //Cap the frame rate
        if( fps.get_ticks() < 1000 / FRAMES_PER_SECOND )
        {
            SDL_Delay( ( 1000 / FRAMES_PER_SECOND ) - fps.get_ticks() );
        }
    }
</div>

<div class="tutText">
Here's the main loop.
To change the background, you press 1,2,3 or 4.
When you start the program up again the dot and the background will be the same as you left it.
</div>

<div class="tutCode">    //Clean up and save
    clean_up( myDot, background );
}
</div>

<div class="tutText">
Lastly, we call our clean_up() function to clean and save the data.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson24.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson23/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson25/index.php">Next Tutorial</a><br>
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