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
<div class="tutPreface"><h1 class="tutHead">Per Pixel Collision</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/30/14</h6>
You've already learned how to check collision with rectangles. Of course not everything in video games is a
rectangle and there's often a loss of accuracy when dealing with non rectangular shapes. Here you'll learn to get
collision accuracy down to the pixel.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/28_per-pixel_collision_detection/index.php">Per-Pixel Collision Detection tutorial with SDL 2</a> is now available.
</div>

<div class="tutText">
Everything is made out of rectangles, even this circle:<br>
<div class="tutImg"><img src="normal.jpg"></div>
<br>
Don't see it? Let's magnify it:<br>
<div class="tutImg"><img src="big.jpg"></div>
<br>
Still don't see it? How about now:<br>
<div class="tutImg"><img src="highlight.jpg"></div>
<br>
Every image on a computer is made out of pixels, and pixels are squares which happen to be rectangles.
So when you're checking collision between any shapes, you check if the two groups of rectangles have collided.
</div>

<div class="tutCode">#include "SDL/SDL.h"
#include "SDL/SDL_image.h"
#include &#060string&#062
#include &#060vector&#062
</div>

<div class="tutText">
In this program we include the vector library along with our other standard ones.
Vectors are kind of like arrays that are easier to manage. 
</div>

<div class="tutCode">//The dot
class Dot
{
    private:
    //The offsets of the dot
    int x, y;
    
    //The collision boxes of the dot
    std::vector&#060SDL_Rect&#062 box;
    
    //The velocity of the dot
    int xVel, yVel;
    
    //Moves the collision boxes relative to the dot's offset
    void shift_boxes();
    
    public:
    //Initializes the variables
    Dot( int X, int Y );
    
    //Takes key presses and adjusts the dot's velocity
    void handle_input();
    
    //Moves the dot
    void move( std::vector&#060SDL_Rect&#062 &rects );
    
    //Shows the dot on the screen
    void show();
    
    //Gets the collision boxes
    std::vector&#060SDL_Rect&#062 &get_rects();
};
</div>

<div class="tutText">
Here we have a revised version of the dot class.<br>
<br>
We have the offsets and velocities from before, and now we have a vector of SDL_Rects to hold the dot's collision boxes.<br>
<br>
In terms of functions, we now have shift_boxes() which moves the boxes in relation to the offset.
I'll explain what that means later.<br>
<br>
There's also the constructor which sets the dot at the offsets in the arguments and we have our event handler, 
move() and show() functions from before. We also have get_rects() which gets the dot's collision boxes.
</div>

<div class="tutCode">bool check_collision( std::vector&#060SDL_Rect&#062 &A, std::vector&#060SDL_Rect&#062 &B )
{
    //The sides of the rectangles
    int leftA, leftB;
    int rightA, rightB;
    int topA, topB;
    int bottomA, bottomB;

    //Go through the A boxes
    for( int Abox = 0; Abox < A.size(); Abox++ )
    {
        //Calculate the sides of rect A
        leftA = A[ Abox ].x;
        rightA = A[ Abox ].x + A[ Abox ].w;
        topA = A[ Abox ].y;
        bottomA = A[ Abox ].y + A[ Abox ].h;
        
        //Go through the B boxes    
        for( int Bbox = 0; Bbox < B.size(); Bbox++ )
        {
            //Calculate the sides of rect B
            leftB = B[ Bbox ].x;
            rightB = B[ Bbox ].x + B[ Bbox ].w;
            topB = B[ Bbox ].y;
            bottomB = B[ Bbox ].y + B[ Bbox ].h;
            
            //If no sides from A are outside of B
            if( ( ( bottomA <= topB ) || ( topA >= bottomB ) || ( rightA <= leftB ) || ( leftA >= rightB ) ) == false )
            {
                //A collision is detected
                return true;
            }
        }
    }
    
    //If neither set of collision boxes touched
    return false;
}
</div>

<div class="tutText">
Here we have our collision detection function.<br>
<br>
In takes in two vectors of SDL_rects, then checks collision between the two sets of rectangles.<br>
<br>
This function gets a rectangle from vector A, then checks if it collides with any rectangles from vector B,
then gets another rectangle from vector A, then checks if it collides with any rectangles from vector B and so on until either a collision is found or all the rectangles have been checked.<br>
<br>
So when the function is checking for collision it would operate like this:<br>
<div class="tutImg"><img src="scan.gif"></div>
<br>
Like from last time, the function returns true if there's a collision and false if there is no collision.
</div>

<div class="tutCode">Dot::Dot( int X, int Y )
{
    //Initialize the offsets
    x = X;
    y = Y;
    
    //Initialize the velocity
    xVel = 0;
    yVel = 0;
    
    //Create the necessary SDL_Rects
    box.resize( 11 );
    
    //Initialize the collision boxes' width and height
    box[ 0 ].w = 6;
    box[ 0 ].h = 1;
    
    box[ 1 ].w = 10;
    box[ 1 ].h = 1;
    
    box[ 2 ].w = 14;
    box[ 2 ].h = 1;
    
    box[ 3 ].w = 16;
    box[ 3 ].h = 2;
    
    box[ 4 ].w = 18;
    box[ 4 ].h = 2;
    
    box[ 5 ].w = 20;
    box[ 5 ].h = 6;
    
    box[ 6 ].w = 18;
    box[ 6 ].h = 2;
    
    box[ 7 ].w = 16;
    box[ 7 ].h = 2;
    
    box[ 8 ].w = 14;
    box[ 8 ].h = 1;
    
    box[ 9 ].w = 10;
    box[ 9 ].h = 1;
    
    box[ 10 ].w = 6;
    box[ 10 ].h = 1;
    
    //Move the collision boxes to their proper spot
    shift_boxes();
}
</div>

<div class="tutText">
Now here's the dot's constructor.<br>
<br>
It sets the dot's offsets to the arguments given, and initializes the velocity of the dot.<br>
<br>
Then we create 11 collision boxes in the vector and set them like this:<br>
<div class="tutImg"><img src="highlight.jpg"></div>
<br>
At the end we set the boxes relative to the dot's offset.
</div>

<div class="tutCode">void Dot::shift_boxes()
{
    //The row offset
    int r = 0;
    
    //Go through the dot's collision boxes
    for( int set = 0; set < box.size(); set++ )
    {
        //Center the collision box
        box[ set ].x = x + ( DOT_WIDTH - box[ set ].w ) / 2;
        
        //Set the collision box at its row offset
        box[ set ].y = y + r;
        
        //Move the row offset down the height of the collision box
        r += box[ set ].h;    
    }
}
</div>

<div class="tutText">
You may be asking yourself what I mean by "Setting the boxes relative to the dot's offset".<br>
<br>
Say if you move the dot 100 pixels over, but when it goes over the other dot it doesn't detect the collision.<br>
<br>
The reason for this is that when you move the dot, you have to move collision boxes along with it and that's what this function does.<br>
<br>
Don't worry how I did it, it was just a fancy way of doing:<br>
box[ 0 ].x = x + 7;<br>
box[ 0 ].y = y;<br>
<br>
box[ 1 ].x = x + 5;<br>
box[ 1 ].y = y + 1;<br>
<br>
and so on.
</div>

<div class="tutCode">void Dot::handle_input()
{
    //If a key was pressed
    if( event.type == SDL_KEYDOWN )
    {
        //Adjust the velocity
        switch( event.key.keysym.sym )
        {
            case SDLK_UP: yVel -= 1; break;
            case SDLK_DOWN: yVel += 1; break;
            case SDLK_LEFT: xVel -= 1; break;
            case SDLK_RIGHT: xVel += 1; break;    
        }
    }
    //If a key was released
    else if( event.type == SDL_KEYUP )
    {
        //Adjust the velocity
        switch( event.key.keysym.sym )
        {
            case SDLK_UP: yVel += 1; break;
            case SDLK_DOWN: yVel -= 1; break;
            case SDLK_LEFT: xVel += 1; break;
            case SDLK_RIGHT: xVel -= 1; break;    
        }        
    }
}
</div>

<div class="tutText">
Here's the dot's event handler.
As you can see the dot's velocity is only one pixel per frame so if you notice it's going slow just know its intentional.
If you can only move one pixel at a time you can better see the per pixel collision. 
</div>

<div class="tutCode">void Dot::move( std::vector&#060SDL_Rect&#062 &rects )
{
    //Move the dot left or right
    x += xVel;
    
    //Move the collision boxes
    shift_boxes();
    
    //If the dot went too far to the left or right or has collided with the other dot
    if( ( x < 0 ) || ( x + DOT_WIDTH > SCREEN_WIDTH ) || ( check_collision( box, rects ) ) )
    {
        //Move back
        x -= xVel;
        shift_boxes();    
    }
    
    //Move the dot up or down
    y += yVel;
    
    //Move the collision boxes
    shift_boxes();
    
    //If the dot went too far up or down or has collided with the other dot
    if( ( y < 0 ) || ( y + DOT_HEIGHT > SCREEN_HEIGHT ) || ( check_collision( box, rects ) ) )
    {
        //Move back
        y -= yVel;
        shift_boxes();
    }   
}
</div>

<div class="tutText">
Here's the dot's move function that we separated from the show function.<br>
<br>
Its pretty much the same story as before.
We move the dot, and if the dot went off the screen or over the vector of rectangles, move back.
There is one key difference however.<br>
<br>
Whenever we move the dot, we call shift_boxes() to move the collision boxes along with the dot.
The collision boxes will do no good if they do not go along with the dot.
</div>

<div class="tutCode">void Dot::show()
{
    //Show the dot
    apply_surface( x, y, dot, screen );
}
</div>

<div class="tutText">
Here's our show function that applies the dot to the screen.
</div>

<div class="tutCode">std::vector&#060SDL_Rect&#062 &Dot::get_rects()
{
    //Retrieve the collision boxes
    return box;    
}
</div>

<div class="tutText">
Here's the function that gets the dot's collision boxes.
</div>

<div class="tutCode">    //Make the dots
    Dot myDot( 0, 0 ), otherDot( 20, 20 );
</div>

<div class="tutText">
In our main function we generate two Dot objects, "myDot" which is the dot we're moving and "otherDot" which is the dot that's sitting still.
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
            
            //If the user has Xed out the window
            if( event.type == SDL_QUIT )
            {
                //Quit the program
                quit = true;
            }
        }
        
        //Move the dot
        myDot.move( otherDot.get_rects() );
		
        //Fill the screen white
        SDL_FillRect( screen, &screen->clip_rect, SDL_MapRGB( screen->format, 0xFF, 0xFF, 0xFF ) );
            
        //Show the dots on the screen
        otherDot.show();
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
We handle events, move the dot, fill the screen white, show the dots, update the screen, and cap the frame rate.
Now you can check collision with whatever you want.
</div>

<div class="tutText">
There is one note I want to make about per pixel collision.
Even though you can check for collision down the the pixel, 99% of the time you don't have to.<br>
<br>
The perfect example of this is super street fighter 2 turbo.<br>
If you have the GBA version, when you activate the akuma glitch you can see the corners of the collision boxes:<br>
<div class="tutImg"><img src="sf1.jpg"><img src="sf2.jpg"></div>
<div class="tutImg"><img src="sf3.jpg"><img src="sf4.jpg"></div>
<br>
As you can see the collision detection is not down to the pixel.<br>
<br>
When it comes to collision detection, down to the pixel accuracy isn't always needed.
In many cases it's a waste of CPU power to check collision down to the pixel.
There is such thing as accurate enough. It's up to you to decide how much accuracy you need.<br>
<br>
The multiple collision box method should cover any type of overlap you can think of. For those of you that need
even more advanced collision detection such as objects going at high velocities that don't overlap neatly, look up
the "sweep tests" if you're comfortable with vector math.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson18.zip">here</a>.<br>
<br>
Visual Studio users might encounter a problem compiling the source. There's 2 ways to fix it:<br>
1) Change "Runtime Library" from "Multithreaded DLL" to "Multithreaded Debug DLL".<br>
2) Compile in release mode. When you switch from Debug to Release make sure to put "SDL.lib SDLmain.lib" and all
the other libraries you used in the additional dependencies field again.<br>
<br>
<a class="leftNav" href="../lesson17/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson19/index.php">Next Tutorial</a><br>
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