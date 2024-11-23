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
<div class="tutPreface"><h1 class="tutHead">Motion</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/24/14</h6>
Now it's the moment you've been waiting for, it's time to move a dot around on the screen. It can be more difficult
than it sounds. It requires a good understanding of key events. Here you're going to get walked through the basic
concepts of moving an object around on the screen.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/26_motion/index.php">Motion tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The dot that will move around on the screen
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
};
</div>

<div class="tutText">
Here we have the rundown of our dot class.<br>
<br>
"x" and "y" are the offsets of the dot. "xVel" and "yVel" are the dot's velocity or rate of movement.<br>
<br>
The constructor initializes the dot's variables,
handle_input() handles events,
move() moves the dot,
and show() shows it on the screen.
</div>

<div class="tutCode">Dot::Dot()
{
    //Initialize the offsets
    x = 0;
    y = 0;
    
    //Initialize the velocity
    xVel = 0;
    yVel = 0;
}
</div>

<div class="tutText">As you see all the constructor does is put the dot to the upper left corner
and makes sure the dot is still when a Dot object is made.
</div>

<div class="tutCode">void Dot::handle_input()
{
    //If a key was pressed
    if( event.type == SDL_KEYDOWN )
    {
        //Adjust the velocity
        switch( event.key.keysym.sym )
        {
            case SDLK_UP: yVel -= DOT_HEIGHT / 2; break;
            case SDLK_DOWN: yVel += DOT_HEIGHT / 2; break;
            case SDLK_LEFT: xVel -= DOT_WIDTH / 2; break;
            case SDLK_RIGHT: xVel += DOT_WIDTH / 2; break;    
        }
    }
</div>

<div class="tutText">Here's our event handler for the dot.<br>
<br>
Now you may be thinking that there's no need for all this.
That all you need to do is x++/-- or y++/-- when there's a keydown event.<br>
<br>
The problem with that is the dot will only move when there's a keydown event.
That means you'll have to press the key, release the key, then press it again so it will continue moving.<br>
<br>
So what we do instead is set the dot's velocity.
The dot has two velocities, the rate it moves along the X axis and the rate it moves along the Y axis.
When the right arrow is pressed, we increase the X velocity by half the dot's width (which is 10) so it increases its X offset by 10 every frame.
When the left arrow is pressed, we decrease the X velocity by 10 so it decreases its X offset by 10 every frame.
The same principle is applied to the Y offset.<br>
<br>
Remember that the Y axis doesn't work like this:<br>
<div class="tutImg"><img src="cartesian.jpg"></div>
<br>
It works like this:<br>
<div class="tutImg"><img src="sdlcoord.jpg"></div>
<br>
So increasing the Y offset causes the dot to go down, and decreasing it causes it to go up.
</div>

<div class="tutCode">    //If a key was released
    else if( event.type == SDL_KEYUP )
    {
        //Adjust the velocity
        switch( event.key.keysym.sym )
        {
            case SDLK_UP: yVel += DOT_HEIGHT / 2; break;
            case SDLK_DOWN: yVel -= DOT_HEIGHT / 2; break;
            case SDLK_LEFT: xVel += DOT_WIDTH / 2; break;
            case SDLK_RIGHT: xVel -= DOT_WIDTH / 2; break;   
        }        
    }
}
</div>

<div class="tutText">
Now we also have to handle when a key is released.
When a key is released, a SDL_KEYUP event will happen.<br>
<br>
Now when you release a key, you basically undo the change in velocity when you pressed it.
When you pressed right, you increased the x velocity by 10 so when you release right you decrease it by 10.
</div>

<div class="tutCode">void Dot::move()
{
    //Move the dot left or right
    x += xVel;
    
    //If the dot went too far to the left or right
    if( ( x < 0 ) || ( x + DOT_WIDTH > SCREEN_WIDTH ) )
    {
        //move back
        x -= xVel;    
    }
    
    //Move the dot up or down
    y += yVel;
    
    //If the dot went too far up or down
    if( ( y < 0 ) || ( y + DOT_HEIGHT > SCREEN_HEIGHT ) )
    {
        //move back
        y -= yVel;    
    }
}
</div>

<div class="tutText">
Now it's time to move the dot.<br>
<br>
First we move the dot by adding its velocity to its offset,
then we check if the dot went off the screen.
If it did we undo the movement by subtracting its velocity from its offset.
We do this so the dot doesn't go off the screen.<br>
<br>
I'll admit this is a pretty sloppy way to do this because you might get something like this:<br>
<div class="tutImg"><img src="oops.jpg"></div>
where the dot seems to get stuck if you set the velocity to something that's not divisible by the screen's dimensions.
That's because the dot isn't moving to the wall, it's only moving to its position before it went off the screen.<br>
<br>
A better way is to set the dot's offset to the screen's dimension minus the dot's dimension when you go off the screen, but I can't spoon feed you everything.
That and I'm too lazy to go back and change the code.
</div>

<div class="tutCode">void Dot::show()
{
    //Show the dot
    apply_surface( x, y, dot, screen );
}
</div>

<div class="tutText">
Here in the show() function we blit the dot surface on the screen.
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
        
        //Fill the screen white
        SDL_FillRect( screen, &screen->clip_rect, SDL_MapRGB( screen->format, 0xFF, 0xFF, 0xFF ) );
        
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
Now we have our main loop.<br>
<br>
First we check for events then handle the key events for the dot then check for a user quit.
Then we move the dot, clear the screen by filling it white and then we blit the dot on the screen.
After that we update the screen, then the frame rate is capped.<br>
<br>
Now that you're doing things that are real time, you're going to need to know how to properly structure your code flow.
In <a class="tutLink" href="../../articles/article04/index.php">article 4</a> I cover how to make a proper game
loop. I recommend you take a look at it.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson16.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson15/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson17/index.php">Next Tutorial</a><br>
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