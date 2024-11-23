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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac game controller rumble force feedback haptics">
<meta name="description" content="Make your controllers rumble with SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Force Feedback</title>

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
    <h1 class="text-center">Force Feedback</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Force Feedback screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Mar 6th, 2022</b></p>
    
        Now that we know how to <a href="../19_gamepads_and_joysticks/index.php">how to use joysticks with SDL</a>, we can use either the old haptics API or the new game controller API to make our controller rumble.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Game controller handler with force feedback
SDL_GameController* gGameController = NULL;

//Joystick handler with haptic
SDL_Joystick* gJoystick = NULL;
SDL_Haptic* gJoyHaptic = NULL;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Ok so this is a bit confusing so bear with me for a bit.<br/>
<br/>
Say you are trying to use an Xbox controller in your application. Back in the SDL 1.x days, you used the joystick API we used in the previous tutorial. When SDL 2.0 rolled around, we got the new SDL_Haptic API. A haptic device
is something that gives some sort of physical feedback. In this case, it makes the controller rumble but there is also rumble for devices like mice.<br/>
<br/>
Then in more recent versions of SDL, there is the new game controller API. SDL is a wrapper for native APIs and the API for controllers like the Xbox is different from the old school joystick APIs. For this tutorial we are 
going to use both APIs to make the controller rumble depending on what is supported.<br/>
<br/>
First we have the SDL_GameController which is an all in one controller/rumble interface. Then we have the SDL joystick and haptic to support older APIs.<br/>
<br/>
Oh and please make sure you're on the latest version of SDL. I don't want to get a bunch of e-mail complaining how this code doesn't work because the game controller API is a relatively recent addition.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Initialize SDL
    if( SDL_Init( SDL_INIT_VIDEO | SDL_INIT_JOYSTICK | SDL_INIT_HAPTIC | SDL_INIT_GAMECONTROLLER ) < 0 )
    {
        printf( "SDL could not initialize! SDL Error: %s\n", SDL_GetError() );
        success = false;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Like with the joysticks subsystem, you need to make sure to initialize the haptic and game controller specific subsystems in order to use them.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Check for joysticks
        if( SDL_NumJoysticks() < 1 )
        {
            printf( "Warning: No joysticks connected!\n" );
        }
        else
        {
            //Check if first joystick is game controller interface compatible
            if( !SDL_IsGameController( 0 ) )
            {
                printf( "Warning: Joystick is not game controller interface compatible! SDL Error: %s\n", SDL_GetError() );
            }
            else
            {
                //Open game controller and check if it supports rumble
                gGameController = SDL_GameControllerOpen( 0 );
                if( !SDL_GameControllerHasRumble( gGameController ) )
                {
                    printf( "Warning: Game controller does not have rumble! SDL Error: %s\n", SDL_GetError() );
                }
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">First we're going to attempt to open the joystick as a game controller by checking if it is compatible with the game controller interface with SDL_IsGameController. If it is, we open it with SDL_GameControllerOpen and
check if it has rumble with SDL_GameControllerHasRumble.<br/>
<br/>
And no, I did not forget to link to the documentation for the SDL controller API calls. The API is so new, it is not fully documented on the SDL website as of this writing. Fortunately, if you look in the headers, things
are documented. Get used to it because in the industry, documentation is often a luxury and learning to figure out what undocumented code does is an important skill.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Load joystick if game controller could not be loaded
            if( gGameController == NULL )
            {
                //Open first joystick
                gJoystick = SDL_JoystickOpen( 0 );
                if( gJoystick == NULL )
                {
                    printf( "Warning: Unable to open joystick! SDL Error: %s\n", SDL_GetError() );
                }
                else
                {
                    //Check if joystick supports haptic
                    if( !SDL_JoystickIsHaptic( gJoystick ) )
                    {
                        printf( "Warning: Controller does not support haptics! SDL Error: %s\n", SDL_GetError() );
                    }
                    else
                    {
                        //Get joystick haptic device
                        gJoyHaptic = SDL_HapticOpenFromJoystick( gJoystick );
                        if( gJoyHaptic == NULL )
                        {
                            printf( "Warning: Unable to get joystick haptics! SDL Error: %s\n", SDL_GetError() );
                        }
                        else
                        {
                            //Initialize rumble
                            if( SDL_HapticRumbleInit( gJoyHaptic ) < 0 )
                            {
                                printf( "Warning: Unable to initialize haptic rumble! SDL Error: %s\n", SDL_GetError() );
                            }
                        }
                    }
                }
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">If the joystick is not game controller interface compatible, we load it as a plain old joystick.<br/>
<br/>
After we open the joystick, we need to get the haptics device from the joystick using <a href="http://wiki.libsdl.org/SDL_HapticOpenFromJoystick">SDL_HapticOpenFromJoystick</a> on an opened joystick. If we
manage to get the haptic device from controller we have to initialize the rumble using <a href="http://wiki.libsdl.org/SDL_HapticRumbleInit">SDL_HapticRumbleInit</a>.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void close()
{
    //Free loaded images
    gSplashTexture.free();

    //Close game controller or joystick with haptics
    if( gGameController != NULL )
    {
        SDL_GameControllerClose( gGameController );
    }
    if( gJoyHaptic != NULL )
    {
        SDL_HapticClose( gJoyHaptic );
    }
    if( gJoystick != NULL )
    {
        SDL_JoystickClose( gJoystick );
    }
    gGameController = NULL;
    gJoystick = NULL;
    gJoyHaptic = NULL;

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


    <div class="container border-start border-end border-bottom py-3 mb-3">Once we're done with a game controller or joystick/haptic device, we should call the corresponding functions to close them.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                    //Joystick button press
                    else if( e.type == SDL_JOYBUTTONDOWN )
                    {
                        //Use game controller
                        if( gGameController != NULL )
                        {
                            //Play rumble at 75% strength for 500 milliseconds
                            if( SDL_GameControllerRumble( gGameController, 0xFFFF * 3 / 4, 0xFFFF * 3 / 4, 500 ) != 0 )
                            {
                                printf( "Warning: Unable to play game contoller rumble! %s\n", SDL_GetError() );
                            }
                        }
                        //Use haptics
                        else if( gJoyHaptic != NULL )
                        {
                            //Play rumble at 75% strength for 500 milliseconds
                            if( SDL_HapticRumblePlay( gJoyHaptic, 0.75, 500 ) != 0 )
                            {
                                printf( "Warning: Unable to play haptic rumble! %s\n", SDL_GetError() );
                            }
                        }
                    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this application, we'll make the controller shake when a button is pressed.<br/>
<br/>
First we check if the game controller interface was loaded. If it is, we make the controller rumble at 75% strength for 500 milliseconds. Strength goes from 0 to 0xFFFF hex. Again, this is all documented in the headers.<br/>
<br/>
If the haptic was loaded instead, we call <a href="http://wiki.libsdl.org/SDL_HapticRumblePlay">SDL_HapticRumblePlay</a>, which takes in the haptic device, strength in percentage, and duration of the rumble.
Here we make the controller rumble at 75% strength for half a second whenever a <a href="http://wiki.libsdl.org/SDL_JoyButtonEvent">SDL_JoyButtonEvent</a> happens.<br/>
<br/>
Now the SDL 2 game controller and haptics API has many more features not covered here including making custom effects, handling multi rumble devices, and handling haptic mice. You can check them out
in the <a href="http://wiki.libsdl.org/CategoryForceFeedback">SDL 2 force feedback documentation</a> or dig into the header files for the game controller documentation.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="20_force_feedback.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Force Feedback">Back to Index</a>


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