<!-- Get tutorial set -->


<!-- Tutorial root -->



    <!-- Desktop tutorial set -->
    
        
    

                    

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

	<head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VP5RSQ168Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VP5RSQ168Y');
</script>



<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac motion moving objects">
<meta name="description" content="Make particle effects in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Particle Engines</title>

<script src="../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
	<a href="../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../donate.php" class="nav-item nav-link">Donations</a>
</nav>

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

<nav class="container">
		<script async src="https://cse.google.com/cse.js?cx=f01a79f66150b448d">
		</script>
		<div class="gcse-search"></div>
</nav>


</header>


		
		<main>
            <div class="container">
                
                    
                        <div class="container border py-3 my-3">
    <h1 class="text-center">Particle Engines</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Particle Engines screenshot"></div>
    
    <p class="text-center"><b>Last Updated: May 4th, 2014</b></p>
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    Particles are just mini-animations. What we're going to do is take these animations:
<div class="text-center"><img class="img-fluid" alt="red particle" src="red.gif"><img class="img-fluid" alt="green particle" src="green.gif"><img class="img-fluid" alt="blue particle" src="blue.gif"></div>
and spawn them around a dot to create a trail of colored shimmering particles.

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Particle count
const int TOTAL_PARTICLES = 20;

class Particle
{
    public:
        //Initialize position and animation
        Particle( int x, int y );

        //Shows the particle
        void render();

        //Checks if particle is dead
        bool isDead();

    private:
        //Offsets
        int mPosX, mPosY;

        //Current frame of animation
        int mFrame;

        //Type of particle
        LTexture *mTexture;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is a simple particle class. We have a constructor to set the position, a function to render it, and a function to tell if the particle is dead. In terms of data members we have a position, a frame of animation, and a
texture we'll render with.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//The dot that will move around on the screen
class Dot
{
    public:
        //The dimensions of the dot
        static const int DOT_WIDTH = 20;
        static const int DOT_HEIGHT = 20;

        //Maximum axis velocity of the dot
        static const int DOT_VEL = 10;

        //Initializes the variables and allocates particles
        Dot();

        //Deallocates particles
        ~Dot();

        //Takes key presses and adjusts the dot's velocity
        void handleEvent( SDL_Event& e );

        //Moves the dot
        void move();

        //Shows the dot on the screen
        void render();

    private:
        //The particles
        Particle* particles[ TOTAL_PARTICLES ];

        //Shows the particles
        void renderParticles();

        //The X and Y offsets of the dot
        int mPosX, mPosY;

        //The velocity of the dot
        int mVelX, mVelY;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our dot with an array of particles and a function to render the particles on the dot.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">Particle::Particle( int x, int y )
{
    //Set offsets
    mPosX = x - 5 + ( rand() % 25 );
    mPosY = y - 5 + ( rand() % 25 );

    //Initialize animation
    mFrame = rand() % 5;

    //Set type
    switch( rand() % 3 )
    {
        case 0: mTexture = &gRedTexture; break;
        case 1: mTexture = &gGreenTexture; break;
        case 2: mTexture = &gBlueTexture; break;
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For our particle constructor we initialize the position around the given position with some randomness to it. We then initialize the frame of animation with some randomness so the particles will have varying life. Finally we
pick the type of texture we'll use for the particle also at random.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void Particle::render()
{
    //Show image
    mTexture->render( mPosX, mPosY );

    //Show shimmer
    if( mFrame % 2 == 0 )
    {
        gShimmerTexture.render( mPosX, mPosY );
    }

    //Animate
    mFrame++;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the rendering function we render our texture selected in the constructor and then every other frame we render a semitransparent shimmer texture over it to make it look like the particle is shining. We then update the frame
of animation.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool Particle::isDead()
{
    return mFrame > 10;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Once the particle has rendered for a max of 10 frames, we mark it as dead.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">Dot::Dot()
{
    //Initialize the offsets
    mPosX = 0;
    mPosY = 0;

    //Initialize the velocity
    mVelX = 0;
    mVelY = 0;

    //Initialize particles
    for( int i = 0; i < TOTAL_PARTICLES; ++i )
    {
        particles[ i ] = new Particle( mPosX, mPosY );
    }
}

Dot::~Dot()
{
    //Delete particles
    for( int i = 0; i < TOTAL_PARTICLES; ++i )
    {
        delete particles[ i ];
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The constructor/destructor now have to allocate/deallocate the particles we render over the dot.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void Dot::render()
{
    //Show the dot
    gDotTexture.render( mPosX, mPosY );

    //Show particles on top of dot
    renderParticles();
}

void Dot::renderParticles()
{
    //Go through particles
    for( int i = 0; i < TOTAL_PARTICLES; ++i )
    {
        //Delete and replace dead particles
        if( particles[ i ]->isDead() )
        {
            delete particles[ i ];
            particles[ i ] = new Particle( mPosX, mPosY );
        }
    }

    //Show particles
    for( int i = 0; i < TOTAL_PARTICLES; ++i )
    {
        particles[ i ]->render();
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Our dot's rendering function now calls our particle rendering function. The particle rendering function checks if there are any particles that are dead and replaces them. After the dead particles are replaced we render all
the current particles to the screen.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool loadMedia()
{
    //Loading success flag
    bool success = true;

    //Load dot texture
    if( !gDotTexture.loadFromFile( "38_particle_engines/dot.bmp" ) )
    {
        printf( "Failed to load dot texture!\n" );
        success = false;
    }

    //Load red texture
    if( !gRedTexture.loadFromFile( "38_particle_engines/red.bmp" ) )
    {
        printf( "Failed to load red texture!\n" );
        success = false;
    }

    //Load green texture
    if( !gGreenTexture.loadFromFile( "38_particle_engines/green.bmp" ) )
    {
        printf( "Failed to load green texture!\n" );
        success = false;
    }

    //Load blue texture
    if( !gBlueTexture.loadFromFile( "38_particle_engines/blue.bmp" ) )
    {
        printf( "Failed to load blue texture!\n" );
        success = false;
    }

    //Load shimmer texture
    if( !gShimmerTexture.loadFromFile( "38_particle_engines/shimmer.bmp" ) )
    {
        printf( "Failed to load shimmer texture!\n" );
        success = false;
    }
    
    //Set texture transparency
    gRedTexture.setAlpha( 192 );
    gGreenTexture.setAlpha( 192 );
    gBlueTexture.setAlpha( 192 );
    gShimmerTexture.setAlpha( 192 );

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">To give our particles a semi transparent look we set their alpha to 192.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Main loop flag
            bool quit = false;

            //Event handler
            SDL_Event e;

            //The dot that will be moving around on the screen
            Dot dot;

            //While application is running
            while( !quit )
            {
                //Handle events on queue
                while( SDL_PollEvent( &e ) != 0 )
                {
                    //User requests quit
                    if( e.type == SDL_QUIT )
                    {
                        quit = true;
                    }

                    //Handle input for the dot
                    dot.handleEvent( e );
                }

                //Move the dot
                dot.move();

                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render objects
                dot.render();

                //Update screen
                SDL_RenderPresent( gRenderer );
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Again, since our code is well encapsulated the code in the main loop hardly changes.<br/>
<br/>
Now like most of the tutorials this is a super simplified example. In larger program there would be particles controlled by a particle emitter that's its own class, but for the sake of simplicity we're having the Dot class
function as a particle emitter.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="38_particle_engines.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Particle Engines">Back to Index</a>


</div>
                    
                
            </div>
		</main>
		
<footer class="my-3 py-3">
    
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

	<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
	<a href="../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>