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
<div class="tutPreface"><h1 class="tutHead">Circular Collision Detection</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 4/09/14</h6>
Besides rectangles, the most common shape you'll have to deal with is a circle. In the last tutorial we had to use
11 collision boxes for a circle. This tutorial will teach you a more efficient way to handle circles and collision
detection.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/29_circular_collision_detection/index.php">Circular Collision Detection tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">#include "SDL/SDL.h"
#include "SDL/SDL_image.h"
#include &#060string&#062
#include &#060vector&#062
#include &#060cmath&#062
</div>

<div class="tutText">
This tutorial is going to require the distance formula so we include a header for math.
</div>

<div class="tutCode">//A circle stucture
struct Circle
{
    int x, y;
    int r;    
};
</div>

<div class="tutText">
We have to create our own circle structure for this program. "x" and "y" are the offsets of the center of the
circle. "r" is the radius.
</div>

<div class="tutCode">//The dot
class Dot
{
    private:
    //The area of the dot
    Circle c;
    
    //The velocity of the dot
    int xVel, yVel;
    
    public:
    //Initializes the variables
    Dot();
    
    //Takes key presses and adjusts the dot's velocity
    void handle_input();
    
    //Moves the dot
    void move( std::vector&#060SDL_Rect&#062 &rects, Circle &circle );
    
    //Shows the dot on the screen
    void show();
};
</div>

<div class="tutText">
Here's yet another revision of the Dot class.<br>
<br>
Everything is pretty much the same except for two differences. This time we have a Circle structure instead of a
vector of SDL_Rects. Also, in the move() function we check collision with a vector of SDL_Rects and a Circle.
</div>

<div class="tutCode">double distance( int x1, int y1, int x2, int y2 )
{
    //Return the distance between the two points
    return sqrt( pow( x2 - x1, 2 ) + pow( y2 - y1, 2 ) );
}
</div>

<div class="tutText">
This function we made gives us the distance between given 2 points. This is pretty much the only real math used in
this program.<br>
<br>
For those of you using visual studio you may need to type cast those integers to doubles.
</div>

<div class="tutCode">bool check_collision( Circle &A, Circle &B )
{
    //If the distance between the centers of the circles is less than the sum of their radii
    if( distance( A.x, A.y, B.x, B.y ) < ( A.r + B.r ) )
    {
        //The circles have collided
        return true;
    }
    
    //If not
    return false;    
}
</div>

<div class="tutText">
Checking collision between two circles is pretty easy. All you have to do is check whether or not the distance
between the centers of the circles is less than the sum of their radii.<br>
<br>
If it is less, a collision has happened, otherwise there's no collision.
</div>

<div class="tutCode">bool check_collision( Circle &A, std::vector&#060SDL_Rect&#062 &B )
{
    //Closest point on collision box
    int cX, cY;

    //Go through the B boxes
    for( int Bbox = 0; Bbox < B.size(); Bbox++ )
    {
</div>

<div class="tutText">
This function checks collision between a circle and a vector of rectangles. Checking for collision between a circle
and a rectangle gets a bit tricky. To check if there's a collision between a circle and a collision box, you must
find the point on the collision box closest to the center of the circle.
</div>

<div class="tutCode">        //Find closest x offset
        if( A.x < B[ Bbox ].x )
        {
            cX = B[ Bbox ].x;
        }
</div>

<div class="tutText">
If the center of the circle is to the left of the box, then the x offset of the closest point is equal to the x
offset of the collision box.<br>
<div class="tutImg"><img src="less.jpg"></div>
</div>

<div class="tutCode">        else if( A.x > B[ Bbox ].x + B[ Bbox ].w )
        {
            cX = B[ Bbox ].x + B[ Bbox ].w;
        }
</div>

<div class="tutText">
If the center of the circle is to the right of the box, then the x offset of the closest point is equal to the x
offset of the right side of the collision box.<br>
<div class="tutImg"><img src="greater.jpg"></div>
</div>

<div class="tutCode">        else
        {
            cX = A.x;
        }
</div>

<div class="tutText">
If the x offset of the center of the circle is not to the left or the right of the collision box, then the x
offset is inside the collision box.<br>
<div class="tutImg"><img src="equal.jpg"></div>
</div>

<div class="tutCode">        //Find closest y offset
        if( A.y < B[ Bbox ].y )
        {
            cY = B[ Bbox ].y;
        }
        else if( A.y > B[ Bbox ].y + B[ Bbox ].h )
        {
            cY = B[ Bbox ].y + B[ Bbox ].h;
        }
        else
        {
            cY = A.y;
        }
</div>

<div class="tutText">
Then we do the same as above to find the closest y offset.
</div>

<div class="tutCode">        //If the closest point is inside the circle
        if( distance( A.x, A.y, cX, cY ) < A.r )
        {
            //This box and the circle have collided
            return true;
        }
    }

    //If the shapes have not collided
    return false;
}
</div>

<div class="tutText">
If the point on the collision box closest to the circle is inside the circle, then the circle and the collision
box are overlapped. Here we keep going through all the collision boxes until we find a collision or all of the
boxes have been checked and there is no collision.
</div>

<div class="tutCode">    //Make the shapes
    std::vector&#060SDL_Rect&#062 box( 1 );
    Circle otherDot;
    
    //Set the shapes' attributes
    box[ 0 ].x = 60;
    box[ 0 ].y = 60;
    box[ 0 ].w = 40;
    box[ 0 ].h = 40;
    
    otherDot.x = 30;
    otherDot.y = 30;
    otherDot.r = DOT_WIDTH / 2;
</div>

<div class="tutText">
In the main() function we create the 2 shapes the Dot is going to interact with.
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
        myDot.move( box, otherDot );
		
        //Fill the screen white
        SDL_FillRect( screen, &screen->clip_rect, SDL_MapRGB( screen->format, 0xFF, 0xFF, 0xFF ) );
        
        //Show the box
        SDL_FillRect( screen, &box[ 0 ], SDL_MapRGB( screen->format, 0x00, 0x00, 0x00 ) );
        
        //Show the other dot
        apply_surface( otherDot.x - otherDot.r, otherDot.y - otherDot.r, dot, screen );
        
        //Show our dot
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
Here's the main loop, pretty much everything is the same story as before.
I would like to point one thing out.<br>
<br>
When we show the other dot, we don't blit the image at its offset.
The offset is the center of the circle, so we have to blit the dot image at the upper-left corner.
We do this by subtracting the radius from the offset.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson19.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson18/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson20/index.php">Next Tutorial</a><br>
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