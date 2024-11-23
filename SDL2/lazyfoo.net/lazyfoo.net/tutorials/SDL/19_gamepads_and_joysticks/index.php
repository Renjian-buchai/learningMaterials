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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac joystick gamepads game controllers">
<meta name="description" content="Use gamepads and joysticks with SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Gamepads and Joysticks</title>

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
    <h1 class="text-center">Gamepads and Joysticks</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Gamepads and Joysticks screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Mar 6th, 2022</b></p>
    
        Just like with <a href="../17_mouse_events/index.php">mouse input</a> and <a href="../04_key_presses/index.php">keyboard input</a>, SDL has the ability to read input from a joystick/gamepad/game controller. In this tutorial
we'll be making an arrow rotate based on the input of a joystick.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Analog joystick dead zone
const int JOYSTICK_DEAD_ZONE = 8000;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The way SDL handles analog sticks on a game controller is that it converts its position into a number between -32768 and 32767. This means a light tap could report a position of 1000+. We want to ignore light taps, so we want
to create a dead zone where input from the joystick is ignored. This is why we define this constant and we'll see how it works later.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Game Controller 1 handler
SDL_Joystick* gGameController = NULL;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The data type for a game controller is <a href="http://wiki.libsdl.org/CategoryJoystick">SDL_Joystick</a>. Here we declare the global joystick handle we'll use to interact with the joystick.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool init()
{
    //Initialization flag
    bool success = true;

    //Initialize SDL
    if( SDL_Init( SDL_INIT_VIDEO | SDL_INIT_JOYSTICK ) < 0 )
    {
        printf( "SDL could not initialize! SDL Error: %s\n", SDL_GetError() );
        success = false;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">This is important.<br/>
<br/>
Up until now, we've been only initializing video so we can render to the screen. Now we need to initialize the joystick subsystem or reading from joystick won't work.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Set texture filtering to linear
        if( !SDL_SetHint( SDL_HINT_RENDER_SCALE_QUALITY, "1" ) )
        {
            printf( "Warning: Linear texture filtering not enabled!" );
        }

        //Check for joysticks
        if( SDL_NumJoysticks() < 1 )
        {
            printf( "Warning: No joysticks connected!\n" );
        }
        else
        {
            //Load joystick
            gGameController = SDL_JoystickOpen( 0 );
            if( gGameController == NULL )
            {
                printf( "Warning: Unable to open game controller! SDL Error: %s\n", SDL_GetError() );
            }
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After initializing the joystick subsystem, we want to open our joystick. First we call <a href="http://wiki.libsdl.org/SDL_NumJoysticks">SDL_NumJoysticks</a> to check if there is at least one joystick connected. If there is,
we call <a href="http://wiki.libsdl.org/SDL_JoystickOpen">SDL_JoystickOpen</a> to open the joystick at index 0. After the joystick is open, it will now report events to the SDL event queue.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void close()
{
    //Free loaded images
    gArrowTexture.free();

    //Close game controller
    SDL_JoystickClose( gGameController );
    gGameController = NULL;

    //Destroy window    
    SDL_DestroyRenderer( gRenderer );
    SDL_DestroyWindow( gWindow );
    gWindow = NULL;
    gRenderer = NULL;

    //Quit SDL subsystems
    IMG_Quit();
    SDL_Quit();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After we're done with the joystick, we close it with <a href="http://wiki.libsdl.org/SDL_JoystickClose">SDL_JoystickClose</a>.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Main loop flag
            bool quit = false;

            //Event handler
            SDL_Event e;

            //Normalized direction
            int xDir = 0;
            int yDir = 0;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this demo, we want to keep track of the x and y direction. If the x equals -1, the joystick's x position is pointing left. If it is +1, the x position is pointing right.
The y position for joysticks has positive being up and negative being down, so y = +1 is up and y = -1 is down. If x or y is 0, that means it's in the dead zone and is in the center.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Handle events on queue
                while( SDL_PollEvent( &e ) != 0 )
                {
                    //User requests quit
                    if( e.type == SDL_QUIT )
                    {
                        quit = true;
                    }
                    else if( e.type == SDL_JOYAXISMOTION )
                    {
                        //Motion on controller 0
                        if( e.jaxis.which == 0 )
                        {                        
                            //X axis motion
                            if( e.jaxis.axis == 0 )
                            {
                                //Left of dead zone
                                if( e.jaxis.value < -JOYSTICK_DEAD_ZONE )
                                {
                                    xDir = -1;
                                }
                                //Right of dead zone
                                else if( e.jaxis.value > JOYSTICK_DEAD_ZONE )
                                {
                                    xDir =  1;
                                }
                                else
                                {
                                    xDir = 0;
                                }
                            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our event loop, we check if the joystick has moved by checking for a <a href="http://wiki.libsdl.org/SDL_JoyAxisEvent">SDL_JoyAxisEvent</a>. The "which" variable says which controller the axis motion came from, and here we
check that the event came from joystick 0.<br/>
<br/>
Next we want to check whether it was a motion in the x direction or y direction, which the "axis" variable indicates. Typically, axis 0 is the x axis.<br/>
<br/>
The "value" variable says what position the analog stick has on the axis. If the x position is less than the dead zone, the direction is set to negative. If the position is greater than the dead zone, the direction is set to
positive. If it's in the dead zone, the direction is set to 0.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                            //Y axis motion
                            else if( e.jaxis.axis == 1 )
                            {
                                //Below of dead zone
                                if( e.jaxis.value < -JOYSTICK_DEAD_ZONE )
                                {
                                    yDir = -1;
                                }
                                //Above of dead zone
                                else if( e.jaxis.value > JOYSTICK_DEAD_ZONE )
                                {
                                    yDir =  1;
                                }
                                else
                                {
                                    yDir = 0;
                                }
                            }
                        }
                    }
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we do the same thing again with the y axis, which is identified with the axis ID 1.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Calculate angle
                double joystickAngle = atan2( (double)yDir, (double)xDir ) * ( 180.0 / M_PI );
                
                //Correct angle
                if( xDir == 0 && yDir == 0 )
                {
                    joystickAngle = 0;
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Before we render the arrow which will point in the direction the analog stick is pushed, we need to calculate the angle. We do this using the cmath function atan2, which stands for arc tangent 2, AKA inverse tangent 2.<br/>
<br/>
For those of you familiar with trigonometry, this is basically the inverse tangent function with some additional code inside that takes into account the which quadrant the values are coming from.<br/>
<br/>
For those of you only familiar with geometry, just know you give it the y position and x position and it will give you the angle in radians. SDL wants rotation angles in degrees, so we have to convert the radians to degrees by
multiplying it by 180 over Pi.<br/>
<br/>
When both the x and y position are 0, we could get a garbage angle, so we correct the value to equal 0.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Render joystick 8 way angle
                gArrowTexture.render( ( SCREEN_WIDTH - gArrowTexture.getWidth() ) / 2, ( SCREEN_HEIGHT - gArrowTexture.getHeight() ) / 2, NULL, joystickAngle );

                //Update screen
                SDL_RenderPresent( gRenderer );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally we render the arrow rotated on the screen.<br/>
<br/>
There are other joystick events like <a href="http://wiki.libsdl.org/SDL_JoyButtonEvent">button presses</a>, <a href="http://wiki.libsdl.org/SDL_JoyHatEvent">pov hats</a>, and
<a href="http://wiki.libsdl.org/SDL_JoyDeviceEvent">plugging in or removing a controller</a>. They are fairly simple and you should be able to pick them up with some look at the documentation and experimentation.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="19_gamepads_and_joysticks.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Gamepads and Joysticks">Back to Index</a>


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