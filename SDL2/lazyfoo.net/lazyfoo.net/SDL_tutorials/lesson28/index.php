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
<div class="tutPreface"><h1 class="tutHead">Particle Engines</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/28/10</h6>
Particle engines are ways to create effects like fire, smoke, or in this case a trail of sparks. Here we're going
to make a very simple particle engine to surround the dot in sparks.An <br/>
<br/>
<a class="tutLink" href="../../tutorials/SDL/38_particle_engines/index.php">Particle Engines tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">class Particle
{
    private:
    //Offsets
    int x, y;
    
    //Current frame of animation
    int frame;
    
    //Type of particle
    SDL_Surface *type;
    
    public:
    //Constructor
    Particle( int X, int Y );
    
    //Shows the particle
    void show();

    //Checks if particle is dead
    bool is_dead();
};
</div>

<div class="tutText">
Particles are just little animations.
We want to surround the dot with a bunch of little flashing sparks that look like this:<br>
<div class="tutImg"><img src="red.gif"><img src="green.gif"><img src="blue.gif"></div>
<div class="tutImg"><img src="green.gif"><img src="blue.gif"><img src="red.gif"></div>
<div class="tutImg"><img src="blue.gif"><img src="red.gif"><img src="green.gif"></div>
So we'll create a particle class and give the dot a bunch of particles.<br>
<br>
These spark particles are real simple.
They have offsets, a frame of animation and a surface.<br>
<br>
In terms of functions they have a constructor, a function to show the spark and a function to check if the spark is still active.
</div>

<div class="tutCode">//The dot
class Dot
{
    private:
    //The offsets
    int x, y;
    
    //The velocity of the dot
    int xVel, yVel;
    
    //The particles
    Particle *particles[ TOTAL_PARTICLES ];
    
    public:
    //Initializes
    Dot();
    
    //Cleans up particles
    ~Dot();
    
    //Handles keypresses
    void handle_input();
    
    //Moves the dot
    void move();
    
    //Shows the particles
    void show_particles();
    
    //Shows the dot
    void show();
};
</div>

<div class="tutText">
Here we have our good friend the dot class revised to include the particles.
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
    
    //Set the window caption
    SDL_WM_SetCaption( "Particle Test", NULL );
    
    //Seed random
    srand( SDL_GetTicks() );
    
    //If everything initialized fine
    return true;
}
</div>

<div class="tutText">
Because we're going to need random numbers for our particle engine,
we seed random with the current time (which is a common way to do it) in our initialization function.
</div>

<div class="tutCode">Particle::Particle( int X, int Y )
{
    //Set offsets
    x = X - 5 + ( rand() % 25 );
    y = Y - 5 + ( rand() % 25 );
    
    //Initialize animation
    frame = rand() % 5;
    
    //Set type
    switch( rand() % 3 )
    {
        case 0: type = red; break;
        case 1: type = green; break;
        case 2: type = blue; break;
    }
}
</div>

<div class="tutText">
Here's the constructor for our particle class.<br>
<br>
The "X" and "Y" arguments are going to be the offsets of the dot.
We take the arguments and put the particle in a random place around the dot.<br>
<br>
Then we initialize the animation a random number from 0 to 4.
This is because we want the particles to animate asynchronously.<br>
<br>
Then we set the surface type to be the red, green, or blue particle surface.
This is also done at random.
</div>

<div class="tutCode">void Particle::show()
{
    //Show image
    apply_surface( x, y, type, screen );
    
    //Show shimmer
    if( frame % 2 == 0 )
    {
        apply_surface( x, y, shimmer, screen );    
    }
    
    //Animate
    frame++;
}
</div>

<div class="tutText">
Here is the show() function for our sparks.<br>
<br>
All we do is show our surface then if the frame is divisible by 2 we show the shimmer surface on top of red, green or blue surface.
The shimmer surface is just semitransparent white surface.
The result will have the particles doing a flashing animation.
</div>

<div class="tutCode">bool Particle::is_dead()
{
    if( frame > 10 )
    {
        return true;    
    }
    
    return false;
}
</div>

<div class="tutText">
Here we have a function to check if a particle is dead or not.<br>
<br>
A particle is considered dead after it animates for 10 frames.
</div>

<div class="tutCode">Dot::Dot()
{
    //Initialize the offsets
    x = 0;
    y = 0;
    
    //Initialize the velocity
    xVel = 0;
    yVel = 0;
    
    //Initialize particles
    for( int p = 0; p < TOTAL_PARTICLES; p++ )
    {
        particles[ p ] = new Particle( x, y );
    }
}

Dot::~Dot()
{
    //Delete particles
    for( int p = 0; p < TOTAL_PARTICLES; p++ )
    {
        delete particles[ p ];
    }
}
</div>

<div class="tutText">
Here are the dot's constructor and destructor.
The only changes to the dot class made here is that we generate particles in the constructor
and get rid of them in the destructor.
</div>

<div class="tutCode">void Dot::show()
{
    //Show the dot
    apply_surface( x, y, dot, screen );
    
    //Show the particles
    show_particles();
}
</div>

<div class="tutText">
Here you can see we altered the dot's show() function to show the particles.
</div>

<div class="tutCode">void Dot::show_particles()
{
    //Go through particles
    for( int p = 0; p < TOTAL_PARTICLES; p++ )
    {
        //Delete and replace dead particles
        if( particles[ p ]->is_dead() == true )
        {
            delete particles[ p ];
            
            particles[ p ] = new Particle( x, y );
        }
    }
    
    //Show particles
    for( int p = 0; p < TOTAL_PARTICLES; p++ )
    {
        particles[ p ]->show();
    }
}
</div>

<div class="tutText">
When we show the particles we first go through them and remove and replace any dead particles.<br>
<br>
After any dead particles are replaced we show the particles on top of the dot.
</div>

<div class="tutText">
This is a pretty minimalistic example of a particle engine but the basics are there.
You can make more advanced and better looking particles by making more detailed animations,
adding properties like velocity, acceleration, and rotation, or even have the particles interact with each other.<br>
<br>
Experiment and see what effects you can create.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson28.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson27/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson29/index.php">Next Tutorial</a><br>
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