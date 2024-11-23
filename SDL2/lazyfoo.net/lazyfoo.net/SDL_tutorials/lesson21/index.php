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
<div class="tutPreface"><h1 class="tutHead">Scrolling</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 4/09/14</h6>
Up until now, you've been working with environments that were 640 x 480. In this lesson we're going to redo the
motion tutorial only this time we're going to be able to move around an area of any size thanks to scrolling.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/30_scrolling/index.php">Scrolling tutorial with SDL 2</a> is now available.
</div>

<div class="tutText">
When you have a game that requires scrolling, the only real difference is that there has to be a camera.<br>
<br>
Since you can't show the entire level on the screen you have to take the part you want to see:<br>
<div class="tutImg"><img src="camera.jpg"></div>
<br>
and cut it out and show it on the screen:<br>
<div class="tutImg"><img src="screen.jpg"></div>
<br>
It does take some more work since you have to move the camera around to show what you want to.
In this program, the camera will follow the dot we move around.
</div>

<div class="tutCode">//Screen attributes
const int SCREEN_WIDTH = 640;
const int SCREEN_HEIGHT = 480;
const int SCREEN_BPP = 32;

//The frame rate
const int FRAMES_PER_SECOND = 20;

//The dot dimensions
const int DOT_WIDTH = 20;
const int DOT_HEIGHT = 20;

//The dimensions of the level
const int LEVEL_WIDTH = 1280;
const int LEVEL_HEIGHT = 960;

//The surfaces
SDL_Surface *dot = NULL;
SDL_Surface *background = NULL;
SDL_Surface *screen = NULL;

//The event structure
SDL_Event event;

//The camera
SDL_Rect camera = { 0, 0, SCREEN_WIDTH, SCREEN_HEIGHT };
</div>

<div class="tutText">
Here we have our global variables.<br>
<br>
We have our standard constants, surfaces, event structure and all that good stuff,
but this time we have 2 new constants defining the level width and height.
Since we can scroll, we don't confine everything inside of the screen, but now we confine the dot within a level.<br>
<br>
As I mentioned before, we need a camera to define what part of the level we will show on the screen.
Since the screen is a rectangular area, the camera is a SDL_Rect.
Here we initialize the camera in the top left corner and set the width and height to be that of the screen.
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
    
    //Sets the camera over the dot
    void set_camera();
};
</div>

<div class="tutText">
Here we have the definition of the dot class.<br>
<br>
It's pretty much the same as from previous lessons, but this time we have a function that centers the camera over
the dot.
</div>

<div class="tutCode">void Dot::move()
{
    //Move the dot left or right
    x += xVel;
    
    //If the dot went too far to the left or right
    if( ( x < 0 ) || ( x + DOT_WIDTH > LEVEL_WIDTH ) )
    {
        //move back
        x -= xVel;    
    }
    
    //Move the dot up or down
    y += yVel;
    
    //If the dot went too far up or down
    if( ( y < 0 ) || ( y + DOT_HEIGHT > LEVEL_HEIGHT ) )
    {
        //move back
        y -= yVel;    
    }    
}
</div>

<div class="tutText">
The move function is pretty much the same but there is one key difference.
We no longer keep the dot inside the screen, but now keep it inside of the boundaries of the level.
</div>

<div class="tutCode">void Dot::set_camera()
{
    //Center the camera over the dot
    camera.x = ( x + DOT_WIDTH / 2 ) - SCREEN_WIDTH / 2;
    camera.y = ( y + DOT_HEIGHT / 2 ) - SCREEN_HEIGHT / 2;
    
    //Keep the camera in bounds.
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
</div>

<div class="tutText">
When we set the camera, we first center it over the dot.<br>
<br>
Since we don't want to show anything outside of the level, we have to keep the camera in bounds after we center it over the dot.<br>
<br>
We check if the camera is inside the level, and if any part of it is outside the level, we push it back inside.
</div>

<div class="tutCode">void Dot::show()
{    
    //Show the dot
    apply_surface( x - camera.x, y - camera.y, dot, screen );
}
</div>

<div class="tutText">
The show function now blits the dot on the screen relative to the camera to make sure it matches up with the background.
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
        myDot.move();
        
        //Set the camera
        myDot.set_camera();
        
        //Show the background
        apply_surface( 0, 0, background, screen, &camera );
        
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
Now here's the program's main loop.<br>
<br>
We handle events, move the dot, set the camera, apply the part of the background inside of the camera, show the dot, update the screen and cap the frame rate.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson21.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson20/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson22/index.php">Next Tutorial</a><br>
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