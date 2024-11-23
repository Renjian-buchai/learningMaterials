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
<div class="tutPreface"><h1 class="tutHead">Animation</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 2/15/14</h6>
Up until this point we've pretty much have just been working with still images. This tutorial makes a stick
figure walk across the screen to teach the basics of animating sprites.<br/>
<br/>
An <a class="tutLink" href="../../tutorials/SDL/14_animated_sprites_and_vsync/index.php">Animated Sprites and VSync tutorial with SDL 2</a> is now available.
</div>

<div class="tutText">
The basic concept of animation is to take a series of images like the ones in this sprite sheet:<br>
<div class="tutImg"><img src="foosprites.jpg"></div>
<br>
Then show one right after the other to create the illusion of movement:<br>
<div class="tutImg"><img src="foowalk.gif"></div>
<br>
So when you're animating in SDL, you're showing a sequence of SDL_Surfaces.
</div>

<div class="tutCode">//The stick figure
class Foo
{
    private:
    //The offset
    int offSet;
    
    //Its rate of movement
    int velocity;
    
    //Its current frame
    int frame;
    
    //Its animation status
    int status;

    public:
    //Initializes the variables
    Foo();
    
    //Handles input
    void handle_events();
    
    //Moves the stick figure
    void move();    
    
    //Shows the stick figure
    void show();    
};

</div>

<div class="tutText">
Here's the class of the stick figure that we're going to move across the screen.<br>
<br>
First we have the "offSet" and "velocity" variables.
Since we're only moving the stick figure right or left, we only keep track of the x offset and velocity.<br>
<br>
Then we have the "frame" and "status" variables. "frame" keeps track of which frame in the animation to show.
"status" keeps track of which animation to show, either the animation of the Foo walking left or the animation of Foo walking right.<br>
<br>
Then of course we have the constructor, the event handler, and the functions that move and show the stick figure.
</div>

<div class="tutCode">void set_clips()
{
    //Clip the sprites
    clipsRight[ 0 ].x = 0;
    clipsRight[ 0 ].y = 0;
    clipsRight[ 0 ].w = FOO_WIDTH;
    clipsRight[ 0 ].h = FOO_HEIGHT;
    
    clipsRight[ 1 ].x = FOO_WIDTH;
    clipsRight[ 1 ].y = 0;
    clipsRight[ 1 ].w = FOO_WIDTH;
    clipsRight[ 1 ].h = FOO_HEIGHT;
    
    clipsRight[ 2 ].x = FOO_WIDTH * 2;
    clipsRight[ 2 ].y = 0;
    clipsRight[ 2 ].w = FOO_WIDTH;
    clipsRight[ 2 ].h = FOO_HEIGHT;
    
    clipsRight[ 3 ].x = FOO_WIDTH * 3;
    clipsRight[ 3 ].y = 0;
    clipsRight[ 3 ].w = FOO_WIDTH;
    clipsRight[ 3 ].h = FOO_HEIGHT;
    
    clipsLeft[ 0 ].x = 0;
    clipsLeft[ 0 ].y = FOO_HEIGHT;
    clipsLeft[ 0 ].w = FOO_WIDTH;
    clipsLeft[ 0 ].h = FOO_HEIGHT;
    
    clipsLeft[ 1 ].x = FOO_WIDTH;
    clipsLeft[ 1 ].y = FOO_HEIGHT;
    clipsLeft[ 1 ].w = FOO_WIDTH;
    clipsLeft[ 1 ].h = FOO_HEIGHT;
    
    clipsLeft[ 2 ].x = FOO_WIDTH * 2;
    clipsLeft[ 2 ].y = FOO_HEIGHT;
    clipsLeft[ 2 ].w = FOO_WIDTH;
    clipsLeft[ 2 ].h = FOO_HEIGHT;
    
    clipsLeft[ 3 ].x = FOO_WIDTH * 3;
    clipsLeft[ 3 ].y = FOO_HEIGHT;
    clipsLeft[ 3 ].w = FOO_WIDTH;
    clipsLeft[ 3 ].h = FOO_HEIGHT;
}
</div>

<div class="tutText">
Here's the function that sets the clips for the individual sprites in the sprite sheet.<br>
<br>
We have two sets of sprites, the sprites clipped by clipsRight which are frames of the animation of Foo walking right and
the sprites clipped by clipsLeft which are frames of the animation of Foo walking left.
</div>

<div class="tutCode">Foo::Foo()
{
    //Initialize movement variables
    offSet = 0;
    velocity = 0;
    
    //Initialize animation variables
    frame = 0;
    status = FOO_RIGHT;
}
</div>

<div class="tutText">
In the constructor for the Foo class, first we initialize the offset and velocity.<br>
<br>
Then we set the animation to be frame 0, and we set the status to FOO_RIGHT so that the default animation is that of the stick figure walking right.
</div>

<div class="tutCode">void Foo::move()
{
    //Move
    offSet += velocity;
    
    //Keep the stick figure in bounds
    if( ( offSet < 0 ) || ( offSet + FOO_WIDTH > SCREEN_WIDTH ) )
    {
        offSet -= velocity;    
    }
}
</div>

<div class="tutText">
Now in move(), we first move the stick figure and keep it in bounds like always.
</div>
    
<div class="tutCode">void Foo::show()
{
    //If Foo is moving left
    if( velocity < 0 )
    {
        //Set the animation to left
        status = FOO_LEFT;
        
        //Move to the next frame in the animation
        frame++;
    }
    //If Foo is moving right
    else if( velocity > 0 )
    {
        //Set the animation to right
        status = FOO_RIGHT;
        
        //Move to the next frame in the animation
        frame++;
    }
    //If Foo standing
    else
    {
        //Restart the animation
        frame = 0;    
    }
</div>

<div class="tutText">
After the stick figure is moved, it's time to do the actual animation.
First we check which way it's moving.<br>
<br>
If it's moving left, we set the status to FOO_LEFT, then increment the frame counter so the next sprite in the animation is shown.<br>
<br>
If it's moving right, we set the status to FOO_RIGHT, then increment the frame counter so the next sprite in the animation is shown.<br>
<br>
If the figure is still, we set the frame to 0 to restart the animation.
This is so the stick figure doesn't look like it's in mid-step when it's standing still.<br>
</div>

<div class="tutCode">    //Loop the animation
    if( frame >= 4 )
    {
        frame = 0;
    }
</div>

<div class="tutText">
After that we check if the frame counter already went past the fourth frame, since there's only 4 frames in the animation.
If the frame counter has gone too far, we restart the animation so it will keep looping while the stick figure is moving.
</div>
    
<div class="tutCode">    //Show the stick figure
    if( status == FOO_RIGHT )
    {
        apply_surface( offSet, SCREEN_HEIGHT - FOO_HEIGHT, foo, screen, &clipsRight[ frame ] );
    }
    else if( status == FOO_LEFT )
    {
        apply_surface( offSet, SCREEN_HEIGHT - FOO_HEIGHT, foo, screen, &clipsLeft[ frame ] );
    }
}
</div>

<div class="tutText">
Lastly, we show the proper sprite on the screen.<br>
<br>
If the stick figure is moving right we apply the proper sprite from the walking right animation,
if the stick figure is moving left we apply the proper sprite from the walking left animation.
</div>

<div class="tutCode">    //Set the sprite sheet clips
    set_clips();

    //The frame rate regulator
    Timer fps;
    
    //Make the stick figure
    Foo walk;
</div>

<div class="tutText">
In our main function after the initialization and file loading, we set the clips for the sprite sheet, then declare a FPS timer, then declare the stick figure object.
</div>

<div class="tutCode">    //While the user hasn't quit
    while( quit == false )
    {
        //Start the frame timer
        fps.start();
    
        //While there's events to handle
        while( SDL_PollEvent( &event ) )
        {
            //Handle events for the stick figure
            walk.handle_events();
            
            //If the user has Xed out the window
            if( event.type == SDL_QUIT )
            {
                //Quit the program
                quit = true;
            }
        }
        
        //Move the stick figure
        walk.move();
        
        //Fill the screen white
        SDL_FillRect( screen, &screen->clip_rect, SDL_MapRGB( screen->format, 0xFF, 0xFF, 0xFF ) );
        
        //Show the stick figure on the screen
        walk.show();
        
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
Here we have the main loop. It's pretty much the same story as before with our Dot class from previous lessons.<br>
<br>
So as you can see for an animation engine, all you have to do is keep track of which animation you're using and which frame you're blitting.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson20.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson19/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson21/index.php">Next Tutorial</a><br>
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