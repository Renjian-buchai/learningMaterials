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
<div class="tutPreface"><h1 class="tutHead">Joysticks</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 12/28/09</h6>
Here we'll learn to use get input from a joystick/gamepad. This program is basically the motion tutorial, only
this time a joystick will move around the dot instead of the keyboard.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/19_gamepads_and_joysticks/index.php">Game pads and joysticks tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The joystick that will be used
SDL_Joystick *stick = NULL;
</div>

<div class="tutText">
Joysticks have their own data type in SDL which is SDL_Joystick.<br>
<br>
In this program we declare our joystick as a global variable.
</div>

<div class="tutCode">//The dot
class Dot
{
    private:
    //The offsets of the dot
    int x, y;
    
    //The velocity of the dot
    int xVel, yVel;
    
    public:
    //Initializes
    Dot();
    
    //Handles joystick
    void handle_input();
    
    //Moves the dot
    void move();
    
    //Shows the dot
    void show();
};
</div>

<div class="tutText">
As you can see, the Dot class has pretty much stayed the same.
The only thing that has changed is how we handle the input.
</div>

<div class="tutCode">bool init()
{
    //Initialize all SDL subsystems
    if( SDL_Init( SDL_INIT_EVERYTHING ) == -1 )
    {
        return false;    
    }
    
    //Set up the screen
    screen = SDL_SetVideoMode( SCREEN_WIDTH, SCREEN_HEIGHT, SCREEN_BPP, SDL_SWSURFACE );
    
    //If there was an error in setting up the screen
    if( screen == NULL )
    {
        return false;    
    }
    
    //Check if there's any joysticks
    if( SDL_NumJoysticks() < 1 )
    {
        return false;    
    }
    
    //Open the joystick
    stick = SDL_JoystickOpen( 0 );
    
    //If there's a problem opening the joystick
    if( stick == NULL )
    {
        return false;
    }
    
    //Set the window caption
    SDL_WM_SetCaption( "Move the Dot", NULL );
    
    //If everything initialized fine
    return true;
}
</div>

<div class="tutText">
A key difference between using keys for input and using joysticks is that joysticks have to be initialized.<br>
<br>
In the initialization function we use SDL_NumJoysticks() to check how many joysticks are plugged in.
If at least 1 joystick is plugged in, we open the first joystick available using SDL_JoystickOpen().
The first available joystick is joystick 0 since in programming we always start counting at 0.
When there's problem in opening the joystick, SDL_JoystickOpen() returns NULL.
</div>

<div class="tutCode">void clean_up()
{
    //Free the surface
    SDL_FreeSurface( dot );
    
    //Close the joystick
    SDL_JoystickClose( stick );
    
    //Quit SDL
    SDL_Quit();
}
</div>

<div class="tutText">
In the clean up function, we have to call SDL_JoystickClose() to close the joystick that was opened.
</div>

<div class="tutCode">void Dot::handle_input()
{
    //If a axis was changed
    if( event.type == SDL_JOYAXISMOTION )
    {
        //If joystick 0 has moved
        if( event.jaxis.which == 0 )
        {
            //If the X axis changed
            if( event.jaxis.axis == 0 )
            {
                //If the X axis is neutral
                if( ( event.jaxis.value > -8000 ) && ( event.jaxis.value < 8000 ) )
                {
                    xVel = 0;
                }
                //If not
                else
                {
                    //Adjust the velocity
                    if( event.jaxis.value < 0 )
                    {
                        xVel = -DOT_WIDTH / 2;
                    }
                    else
                    {
                        xVel = DOT_WIDTH / 2;
                    }
                }    
            }
</div>

<div class="tutText">
When a joystick moves, a SDL_JOYAXISMOTION occurs.<br>
<br>
First we check if the joystick that has moved is joystick 0. It's kind of pointless in this program since the only
initialized joystick is joystick 0, but in real games you'll need to check multiple joysticks.<br>
<br>
Then we check which axis it has moved on.
On most modern joysticks, the X axis is 0, and the Y axis is 1.<br>
<br>
After that we check if the joystick X value is between -8000, and 8000.
If it is, it's neutral and the dot stays still.<br>
<br>
You may be thinking "how the hell is such a large range considered neutral?".
The thing is a joystick's axis have a range of -32768 to 32767.
You could have the joystick at 0 and if you sneezed on it, it would be at like 200.<br>
<br>
If the joystick is not in the neutral range, we set the X velocity accordingly.
</div>

<div class="tutCode">            //If the Y axis changed
            else if( event.jaxis.axis == 1 )
            {
                //If the Y axis is neutral
                if( ( event.jaxis.value > -8000 ) && ( event.jaxis.value < 8000 ) )
                {
                    yVel = 0;
                }
                //If not
                else
                {
                    //Adjust the velocity
                    if( event.jaxis.value < 0 )
                    {
                        yVel = -DOT_HEIGHT / 2;
                    }
                    else
                    {
                        yVel = DOT_HEIGHT / 2;
                    }
                }
            }
        }
    }
}
</div>

<div class="tutText">
Then pretty much the same thing is done to the Y axis.<br>
<br>
Handling SDL_JoyAxisEvent is the hardest event to handle when dealing with joysticks.
Handling other events like SDL_JoyBallEvent, SDL_JoyHatEvent, and SDL_JoyButtonEvent should be easy to figure out with a quick look at the SDL API documentation.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson25.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson24/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson26/index.php">Next Tutorial</a><br>
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