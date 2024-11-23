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
<div class="tutPreface"><h1 class="tutHead">Mouse Events</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 2/23/14</h6>
Time to learn to handle events from the mouse. This is a simple tutorial that will teach you to handle various
mouse events to make a simple button.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/17_mouse_events/index.php">Mouse events tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The button
class Button
{
    private:
    //The attributes of the button
    SDL_Rect box;
    
    //The part of the button sprite sheet that will be shown
    SDL_Rect* clip;
    
    public:
    //Initialize the variables
    Button( int x, int y, int w, int h );
    
    //Handles events and set the button's sprite region
    void handle_events();
    
    //Shows the button on the screen
    void show();
};
</div>

<div class="tutText">
Here's the Button class which we're going to interact with.<br>
<br>
We have a rectangle to define the position and dimensions of the Button.
We also have a pointer to the sprite from the sprite sheet being used by the Button.<br>
<br>
Then we have the constructor that sets the Button according to the attributes given in the arguments.
Then we have our handle_events() function which handles mouse motion and mouse button events.<br>
<br>
Then there's show() function which shows the button on the screen.
</div>

<div class="tutCode">void set_clips()
{
    //Clip the sprite sheet
    clips[ CLIP_MOUSEOVER ].x = 0;
    clips[ CLIP_MOUSEOVER ].y = 0;
    clips[ CLIP_MOUSEOVER ].w = 320;
    clips[ CLIP_MOUSEOVER ].h = 240;

    clips[ CLIP_MOUSEOUT ].x = 320;
    clips[ CLIP_MOUSEOUT ].y = 0;
    clips[ CLIP_MOUSEOUT ].w = 320;
    clips[ CLIP_MOUSEOUT ].h = 240;

    clips[ CLIP_MOUSEDOWN ].x = 0;
    clips[ CLIP_MOUSEDOWN ].y = 240;
    clips[ CLIP_MOUSEDOWN ].w = 320;
    clips[ CLIP_MOUSEDOWN ].h = 240;
    
    clips[ CLIP_MOUSEUP ].x = 320;
    clips[ CLIP_MOUSEUP ].y = 240;
    clips[ CLIP_MOUSEUP ].w = 320;
    clips[ CLIP_MOUSEUP ].h = 240;    
}
</div>

<div class="tutText">
Here's our function that clips the images from our sprite sheet:<br>
<div class="tutImg"><img src="button.png"></div>
As you can see we have a sprite for the various mouse events. So we have an array of four SDL_Rects that clip each
button sprite. Each button sprite has a constant associated with it.
</div>

<div class="tutCode">Button::Button( int x, int y, int w, int h )
{
    //Set the button's attributes
    box.x = x;
    box.y = y;
    box.w = w;
    box.h = h;
    
    //Set the default sprite
    clip = &clips[ CLIP_MOUSEOUT ];
}
</div>

<div class="tutText">
The constructor for the Button class is pretty straight forward.
It sets the x and y offsets of the button along with its width and height.<br>
<br>
It also sets the default sprite from the sprite sheet.
</div>

<div class="tutCode">void Button::handle_events()
{
    //The mouse offsets
    int x = 0, y = 0;
    
    //If the mouse moved
    if( event.type == SDL_MOUSEMOTION )
    {
        //Get the mouse offsets
        x = event.motion.x;
        y = event.motion.y;
        
        //If the mouse is over the button
        if( ( x > box.x ) && ( x < box.x + box.w ) && ( y > box.y ) && ( y < box.y + box.h ) )
        {
            //Set the button sprite
            clip = &clips[ CLIP_MOUSEOVER ];    
        }
        //If not
        else
        {
            //Set the button sprite
            clip = &clips[ CLIP_MOUSEOUT ];
        }    
    }
</div>

<div class="tutText">
In the event handler, the first thing we check is if the mouse moved.
When the mouse moves, a SDL_MOUSEMOTION event occurs.<br>
<br>
If the mouse was moved, we get the mouse offsets from the event structure, then check if the mouse is over the Button.
If the mouse is over the Button, we set the Button's sprite to be the mouse over sprite, otherwise it is set to the mouse out sprite.
</div>

<div class="tutCode">    //If a mouse button was pressed
    if( event.type == SDL_MOUSEBUTTONDOWN )
    {
        //If the left mouse button was pressed
        if( event.button.button == SDL_BUTTON_LEFT )
        {
            //Get the mouse offsets
            x = event.button.x;
            y = event.button.y;
        
            //If the mouse is over the button
            if( ( x > box.x ) && ( x < box.x + box.w ) && ( y > box.y ) && ( y < box.y + box.h ) )
            {
                //Set the button sprite
                clip = &clips[ CLIP_MOUSEDOWN ];
            }
        }
    }
</div>

<div class="tutText">
Then we check if a mouse button was pressed.
When a mouse button is pressed, a SDL_MOUSEBUTTONDOWN event occurs.<br>
<br>
We only want the button to react to the left mouse button, so we check if the left mouse button was pressed.<br>
<br>
Then we check if the mouse button was pressed over the Button.
If it was we set the Button's sprite to be the mouse down sprite.<br>
</div>

<div class="tutCode">    //If a mouse button was released
    if( event.type == SDL_MOUSEBUTTONUP )
    {
        //If the left mouse button was released
        if( event.button.button == SDL_BUTTON_LEFT )
        { 
            //Get the mouse offsets
            x = event.button.x;
            y = event.button.y;
        
            //If the mouse is over the button
            if( ( x > box.x ) && ( x < box.x + box.w ) && ( y > box.y ) && ( y < box.y + box.h ) )
            {
                //Set the button sprite
                clip = &clips[ CLIP_MOUSEUP ];
            }
        }
    }
}
</div>

<div class="tutText">
Then we check if the mouse button was released over the button with a SDL_MOUSEBUTTONUP event.<br>
<br>
In this program we got the mouse offsets by getting them from the event structure.
It would have been more efficient to get the mouse offsets via SDL_GetMouseState(), but.... eh I'm too lazy to go back and change the code. 
</div>

<div class="tutCode">void Button::show()
{
    //Show the button
    apply_surface( box.x, box.y, buttonSheet, screen, clip );
}
</div>

<div class="tutText">
Then in the show function we show the button's sprite on the screen.
</div>

<div class="tutCode">    //Clip the sprite sheet
    set_clips();
    
    //Make the button
    Button myButton( 170, 120, 320, 240 );
    
</div>

<div class="tutText">
At the top of the main() function after we've initialized and loaded everything,
we set clip the sprite sheet and set our button.
</div>

<div class="tutCode">    //While the user hasn't quit
    while( quit == false )
    {
        //If there's events to handle
        if( SDL_PollEvent( &event ) )
        {
            //Handle button events
            myButton.handle_events();
            
            //If the user has Xed out the window
            if( event.type == SDL_QUIT )
            {
                //Quit the program
                quit = true;
            }    
        }

        //Fill the screen white
        SDL_FillRect( screen, &screen->clip_rect, SDL_MapRGB( screen->format, 0xFF, 0xFF, 0xFF ) );
        
        //Show the button
        myButton.show();
        
        //Update the screen
        if( SDL_Flip( screen ) == -1 )
        {
            return 1;    
        }
    }
</div>

<div class="tutText">
Here's the button class in action inside our main loop.<br>
<br>
First we handle events.
As you can see we use Button's event handler and we also check for a user quit.<br>
<br>
Typically a while loop is used to handle events but in this tutorial (and the previous one) we used "if".
This is so one event is handled per frame and it's easier to see the individual events.
In most real applications you use "while" because you want to handle all events on queue every frame.<br>
<br>
After the event is handled, we clear the screen by filling it white.
Then we show the button on the screen and update the screen.<br>
<br>
Then the main loop continues so we can render another frame until the user quits.
</div>

<div class="tutText">
For those of you on faster computers you may not see the CLIP_MOUSEUP sprite. This is because the program runs so
fast it only shows up for a split second. Fortunately there's a set of tutorials dealing with timing and
regulating frame rate coming up. If you slow the program down to 20 frames per second you should at least be able
to notice it.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson09.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson08/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson10/index.php">Next Tutorial</a><br>
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