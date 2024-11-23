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
<div class="tutPreface"><h1 class="tutHead">Frame Independent Movement</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 12/28/09</h6>
Before we had to cap the frame rate to keep the dot from moving too fast. Here we're going to make the dot move
based on time instead of frame rate so it moves the same no matter what the frame rate is.<br/>
<br/>
<a class="tutLink" href="../../tutorials/SDL/44_frame_independent_movement/index.php">Frame Independent Movement tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The attributes of the dot
const int DOT_WIDTH = 20;
const int DOT_HEIGHT = 20;
const int DOT_VEL = 200;
</div>

<div class="tutText">
Here we define the dot related constants of width, height, and velocity.<br>
<br>
Now that we're moving in relation to time instead of frame rate we have to change how we handle velocity.
Instead of basing velocity per frame we're going to base it per second.
In the original motion tutorial we had the dot travel 10 pixels every frame.
Since the program ran at 20 frames per second that meant the dot moved at a rate of 200 pixels per second.<br>
<br>
So now the dot's velocity is 200 pixels per second.
</div>

<div class="tutCode">//The dot
class Dot
{
    private:
    //The X and Y offsets of the dot
    float x, y;
    
    //The velocity of the dot
    float xVel, yVel;
    
    public:
    //Initializes the variables
    Dot();
    
    //Takes key presses and adjusts the dot's velocity
    void handle_input();
    
    //Moves the dot
    void move( Uint32 deltaTicks );
    
    //Shows the dot on the screen
    void show();
};
</div>

<div class="tutText">
Here we have yet another revision of our friend the dot class.<br>
<br>
Now the offsets and velocity are floating point numbers.
This is because there will be cases where the dot will move less than a pixel per frame.<br>
<br>
Say this program runs at 300 fps on a computer.
To move at 200 pps the dot would have to move at 2/3 of a pixel per frame.<br>
<br>
We also have a move() function that takes in a delta time.
For those of you who haven't taken physics, a delta time is a change in time.
We need the change in time since the last frame to determine how much the dot needs to move.<br>
<br>
And of course we have our video and input functions.
</div>

<div class="tutCode">void Dot::handle_input()
{
    //If a key was pressed
    if( event.type == SDL_KEYDOWN )
    {
        //Adjust the velocity
        switch( event.key.keysym.sym )
        {
            case SDLK_UP: yVel -= DOT_VEL; break;
            case SDLK_DOWN: yVel += DOT_VEL; break;
            case SDLK_LEFT: xVel -= DOT_VEL; break;
            case SDLK_RIGHT: xVel += DOT_VEL; break;    
        }
    }
    //If a key was released
    else if( event.type == SDL_KEYUP )
    {
        //Adjust the velocity
        switch( event.key.keysym.sym )
        {
            case SDLK_UP: yVel += DOT_VEL; break;
            case SDLK_DOWN: yVel -= DOT_VEL; break;
            case SDLK_LEFT: xVel += DOT_VEL; break;
            case SDLK_RIGHT: xVel -= DOT_VEL; break;    
        }        
    }
}
</div>

<div class="tutText">
As you can see the input handling is pretty much the same from last time.
</div>

<div class="tutCode">void Dot::move( Uint32 deltaTicks )
{
    //Move the dot left or right
    x += xVel * ( deltaTicks / 1000.f );
    
    //If the dot went too far to the left
    if( x < 0 )
    {
        //Move back
        x = 0;    
    }
    //or the right
    else if( x + DOT_WIDTH > SCREEN_WIDTH )
    {
        //Move back
        x = SCREEN_WIDTH - DOT_WIDTH;    
    }
    
    //Move the dot up or down
    y += yVel * ( deltaTicks / 1000.f );
    
    //If the dot went too far up
    if( y < 0 )
    {
        //Move back
        y = 0;    
    }
    //or down
    else if( y + DOT_HEIGHT > SCREEN_HEIGHT )
    {
        //Move back
        y = SCREEN_HEIGHT - DOT_HEIGHT;    
    }
}
</div>

<div class="tutText">
Here is where we do our movement.<br>
<br>
We take in the delta time which is going to tell us the change in time since the dot last moved.
If the program is running at 100 fps, the delta time will be 1/100 of a second.
If the program is running at 200 fps, the delta time will be 1/200 of a second.
If the program is running at 150 fps, the delta time will be 1/150 of a second, so on and so on.<br>
<br>
The formula to figure out how much we need to move is:
<h5>velocity in pixels per second * time since last frame in seconds.</h5>

So if the program runs at 200 frames per second:
<h5>200 pps * 1/200 seconds = 1 pixel </h5>

If the program runs at 100 frames per second:
<h5>200 pps * 1/100 seconds = 2 pixels</h5>
and so on and so on.<br>
<br>
Using the time based movement makes sure that the dot always moves at 200 pps.<br>
<br>
Also notice we changed our method to keep the dot in bounds.
Instead of using the undo motion method like before, here whenever the dot goes off the screen we pull it back in.
</div>

<div class="tutCode">void Dot::show()
{    
    //Show the dot
    apply_surface( (int)x, (int)y, dot, screen );
}
</div>

<div class="tutText">
Here you see the show() function is pretty much unchanged except for the fact that
we do have to type cast the float offsets to integers for blitting.
</div>

<div class="tutCode">    //Quit flag
    bool quit = false;
    
    //The dot that will be used
    Dot myDot;

    //Keeps track of time since last rendering
    Timer delta;
    
    //Initialize
    if( init() == false )
    {
        return 1;
    }
    
    //Load the files
    if( load_files() == false )
    {
        return 1;
    }
    
    //Start delta timer
    delta.start();
</div>

<div class="tutText">
Here's the top of our main() function.<br>
<br>
Along with our dot we make a timer object to measure the delta time between frames.
We start the timer before we enter our main loop.
</div>

<div class="tutCode">    //While the user hasn't quit
    while( quit == false )
    {   
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
        myDot.move( delta.get_ticks() );
        
        //Restart delta timer
        delta.start();
</div>

<div class="tutText">
At the top of our main loop we handle events and move the dot.<br>
<br>
After the dot is moved we restart the delta timer so we can keep track of how long it's been since we last moved.
</div>

<div class="tutCode">        //Fill the screen white
        SDL_FillRect( screen, &screen->clip_rect, SDL_MapRGB( screen->format, 0xFF, 0xFF, 0xFF ) );
        
        //Show the dot on the screen
        myDot.show();
        
        //Update the screen
        if( SDL_Flip( screen ) == -1 )
        {
            return 1;    
        }
    }
</div>

<div class="tutText">
Then we do our graphics as we do normally.<br>
<br>
As you can see we don't cap the frame rate, but since our movement is based on time it doesn't matter what the frame rate is.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson32.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson31/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson33/index.php">Next Tutorial</a><br>
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