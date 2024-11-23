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
<div class="tutPreface"><h1 class="tutHead">Collision Detection</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/30/14</h6>
Here's one of the most important concepts of gaming.<br>
<br>
We have a square and wall. We want to make sure that the square doesn't go through the wall.
In order for that to happen we have to check if the square and wall have collided.<br>
<br>
This tutorial covers a basic way to check collision between two objects.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/27_collision_detection/index.php">Collision Detection tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The wall
SDL_Rect wall;
</div>

<div class="tutText">
Here we have the wall that the square is going to interact with. Nothing much to explain here.
</div>

<div class="tutCode">//The square
class Square
{
    private:
    //The collision box of the square
    SDL_Rect box;
    
    //The velocity of the square
    int xVel, yVel;
    
    public:
    //Initializes the variables
    Square();
    
    //Takes key presses and adjusts the square's velocity
    void handle_input();
    
    //Moves the square
    void move();
    
    //Shows the square on the screen
    void show();
};
</div>

<div class="tutText">
Now here's the square class we're going to use.
As you'll probably notice it's almost identical to the Dot class from the motion tutorial.<br>
<br>
The only real difference in the variables is the fact that the square's X and Y coordinates are held inside of a
SDL_Rect which also happens to hold the dimensions of the square.
Otherwise it's pretty much the same.
</div>

<div class="tutCode">bool check_collision( SDL_Rect A, SDL_Rect B )
{
    //The sides of the rectangles
    int leftA, leftB;
    int rightA, rightB;
    int topA, topB;
    int bottomA, bottomB;

    //Calculate the sides of rect A
    leftA = A.x;
    rightA = A.x + A.w;
    topA = A.y;
    bottomA = A.y + A.h;
        
    //Calculate the sides of rect B
    leftB = B.x;
    rightB = B.x + B.w;
    topB = B.y;
    bottomB = B.y + B.h;
</div>

<div class="tutText">
Here we have the actual function that checks for a collision.<br>
<br>
First thing the function does is take in the SDL_Rects and calculate their sides.
</div>

<div class="tutCode">    //If any of the sides from A are outside of B
    if( bottomA <= topB )
    {
        return false;
    }
    
    if( topA >= bottomB )
    {
        return false;
    }
    
    if( rightA <= leftB )
    {
        return false;
    }
    
    if( leftA >= rightB )
    {
        return false;
    }
    
    //If none of the sides from A are outside B
    return true;
}
</div>

<div class="tutText">
Now it's time for collision.<br>
<br>
The basic principle of rectangular collision is that we check whether the sides from one rectangle are outside the
sides of the other rectangle.<br>
<br>
Think about it, it's impossible for two rectangles to collide if their sides have to be outside each other, just look:<br>
<div class="tutImg"><img src="nocollision.jpg"></div>
Every single time all the sides from B are outside of A.<br>
<br>
Now notice when there is a collision:<br>
<div class="tutImg"><img src="collision.jpg"></div>
At least one side from B is inside A.<br>
<br>
So we go through and make sure none of the sides from B are inside A. If there's no collision we return false, if there is we return true.<br>
<br>
Notice that I use greater than or equal to and less than or equal to.
This means in order for a collision to happen the rectangles have to overlap.
If you use greater than and less than, the rectangles in this picture:<br>
<div class="tutImg"><img src="nocollision.jpg"></div>
would count as collisions because they're next to each other.<br>
<br>
Use which ever method best suits your needs.
</div>

<div class="tutCode">Square::Square()
{
    //Initialize the offsets
    box.x = 0;
    box.y = 0;
    
    //Set the square's dimensions
    box.w = SQUARE_WIDTH;
    box.h = SQUARE_HEIGHT;
    
    //Initialize the velocity
    xVel = 0;
    yVel = 0;
}
</div>

<div class="tutText">
In the square's constructor we initialize the square's offsets, dimensions, and velocity like before.
</div>

<div class="tutCode">void Square::move()
{
    //Move the square left or right
    box.x += xVel;
       
    //If the square went too far to the left or right or has collided with the wall
    if( ( box.x < 0 ) || ( box.x + SQUARE_WIDTH > SCREEN_WIDTH ) || ( check_collision( box, wall ) ) )
    {
        //Move back
        box.x -= xVel;
    }
    
    //Move the square up or down
    box.y += yVel;
    
    //If the square went too far up or down or has collided with the wall
    if( ( box.y < 0 ) || ( box.y + SQUARE_HEIGHT > SCREEN_HEIGHT ) || ( check_collision( box, wall ) ) )
    {
        //Move back
        box.y -= yVel;
    }   
}
</div>

<div class="tutText">
Now in the move() function we move the square, then check whether the square went outside the screen and whether
the square overlaps the wall.
If the square does go out of bounds we move it back.
</div>

<div class="tutCode">    //Set the wall
    wall.x = 300;
    wall.y = 40;
    wall.w = 40;
    wall.h = 400;
</div>

<div class="tutText">In our main function after we initialize and load everything, we set the attributes of the wall.
</div>

<div class="tutCode">    //While the user hasn't quit
    while( quit == false )
    {
        //Start the frame timer
        fps.start();
        
        //While there's events to handle
        while( SDL_PollEvent( &event ) )
        {
            //Handle events for the square
            mySquare.handle_input();
            
            //If the user has Xed out the window
            if( event.type == SDL_QUIT )
            {
                //Quit the program
                quit = true;
            }
        }
        
        //Move the square
        mySquare.move();
        
        //Fill the screen white
        SDL_FillRect( screen, &screen->clip_rect, SDL_MapRGB( screen->format, 0xFF, 0xFF, 0xFF ) );
        
        //Show the wall
        SDL_FillRect( screen, &wall, SDL_MapRGB( screen->format, 0x77, 0x77, 0x77 ) );
            
        //Show the square on the screen
        mySquare.show();
        
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
Then we have our main loop. We simply handle events, move the square, fill the background,
fill the region of the wall, and show the square, then update the screen and cap the frame rate.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson17.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson16/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson18/index.php">Next Tutorial</a><br>
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