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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac audio sound effects music">
<meta name="description" content="Play sound with SDL2 and SDL_mixer.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Sound Effects and Music</title>

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
    <h1 class="text-center">Sound Effects and Music</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Sound Effects and Music screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Nov 26th, 2023</b></p>
    
        Up until now we've only been dealing with video and input. Most games made require some sort of sound and here we'll be using SDL_mixer to play audio for us.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Using SDL, SDL_image, SDL_mixer, standard IO, and strings
#include &#60SDL.h&#62
#include &#60SDL_image.h&#62
#include &#60SDL_mixer.h&#62
#include &#60stdio.h&#62
#include &#60string&#62
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3"><a href="https://github.com/libsdl-org/SDL_mixer/releases">SDL_mixer</a> is a library we use to make audio playing easier (because it can get <a href="http://wiki.libsdl.org/CategoryAudio">complicated</a>). We have to set it
up just like we <a href="../06_extension_libraries_and_loading_other_image_formats/index.php">set up SDL_image</a>. Like before, it's just a matter of having the headers files, library files, and binary files in the right
place with your compiler configured to use them.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//The music that will be played
Mix_Music* gMusic = NULL;

//The sound effects that will be used
Mix_Chunk* gScratch = NULL;
Mix_Chunk* gHigh = NULL;
Mix_Chunk* gMedium = NULL;
Mix_Chunk* gLow = NULL;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The SDL_mixer data type for music is Mix_Music and one for short sounds is Mix_Chunk. Here we declare pointers for the music and sound effects we'll be using.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Initialize SDL
    if( SDL_Init( SDL_INIT_VIDEO | SDL_INIT_AUDIO ) < 0 )
    {
        printf( "SDL could not initialize! SDL Error: %s\n", SDL_GetError() );
        success = false;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Since we're using music and sound effects, we need to initialize audio along with video for this demo.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Initialize PNG loading
                int imgFlags = IMG_INIT_PNG;
                if( !( IMG_Init( imgFlags ) & imgFlags ) )
                {
                    printf( "SDL_image could not initialize! SDL_image Error: %s\n", IMG_GetError() );
                    success = false;
                }

                 //Initialize SDL_mixer
                if( Mix_OpenAudio( 44100, MIX_DEFAULT_FORMAT, 2, 2048 ) < 0 )
                {
                    printf( "SDL_mixer could not initialize! SDL_mixer Error: %s\n", Mix_GetError() );
                    success = false;
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">To initialize SDL_mixer we need to call <a href="https://wiki.libsdl.org/SDL2_mixer/Mix_OpenAudio">Mix_OpenAudio</a>. The first argument sets the  sound frequency, and 44100 is a standard frequency that works on
most systems. The second argument determines the sample format, which again here we're using the default. The third argument is the number of hardware channels, and here we're using 2 channels for stereo. The last argument is
the sample size, which determines the size of the chunks we use when playing sound. 2048 bytes (AKA 2 kilobyes) worked fine for me, but you may have to experiment with this value to minimize lag when playing sounds.<br/>
<br/>
If there's any errors with SDL_mixer, they're reported with Mix_GetError.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool loadMedia()
{
    //Loading success flag
    bool success = true;

    //Load prompt texture
    if( !gPromptTexture.loadFromFile( "21_sound_effects_and_music/prompt.png" ) )
    {
        printf( "Failed to load prompt texture!\n" );
        success = false;
    }

    //Load music
    gMusic = Mix_LoadMUS( "21_sound_effects_and_music/beat.wav" );
    if( gMusic == NULL )
    {
        printf( "Failed to load beat music! SDL_mixer Error: %s\n", Mix_GetError() );
        success = false;
    }
    
    //Load sound effects
    gScratch = Mix_LoadWAV( "21_sound_effects_and_music/scratch.wav" );
    if( gScratch == NULL )
    {
        printf( "Failed to load scratch sound effect! SDL_mixer Error: %s\n", Mix_GetError() );
        success = false;
    }
    
    gHigh = Mix_LoadWAV( "21_sound_effects_and_music/high.wav" );
    if( gHigh == NULL )
    {
        printf( "Failed to load high sound effect! SDL_mixer Error: %s\n", Mix_GetError() );
        success = false;
    }

    gMedium = Mix_LoadWAV( "21_sound_effects_and_music/medium.wav" );
    if( gMedium == NULL )
    {
        printf( "Failed to load medium sound effect! SDL_mixer Error: %s\n", Mix_GetError() );
        success = false;
    }

    gLow = Mix_LoadWAV( "21_sound_effects_and_music/low.wav" );
    if( gLow == NULL )
    {
        printf( "Failed to load low sound effect! SDL_mixer Error: %s\n", Mix_GetError() );
        success = false;
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we load our splash texture and sound.<br/>
<br/>
To load music we call <a href="https://wiki.libsdl.org/SDL2_mixer/Mix_LoadMUS">Mix_LoadMUS</a> and to load sound effect we call
<a href="https://wiki.libsdl.org/SDL2_mixer/Mix_LoadWAV">Mix_LoadWAV</a>.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void close()
{
    //Free loaded images
    gPromptTexture.free();

    //Free the sound effects
    Mix_FreeChunk( gScratch );
    Mix_FreeChunk( gHigh );
    Mix_FreeChunk( gMedium );
    Mix_FreeChunk( gLow );
    gScratch = NULL;
    gHigh = NULL;
    gMedium = NULL;
    gLow = NULL;
    
    //Free the music
    Mix_FreeMusic( gMusic );
    gMusic = NULL;

    //Destroy window    
    SDL_DestroyRenderer( gRenderer );
    SDL_DestroyWindow( gWindow );
    gWindow = NULL;
    gRenderer = NULL;

    //Quit SDL subsystems
    Mix_Quit();
    IMG_Quit();
    SDL_Quit();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When we're done with audio and want to free it, we call <a href="https://wiki.libsdl.org/SDL2_mixer/Mix_FreeMusic">Mix_FreeMusic</a> to free music and
<a href="https://wiki.libsdl.org/SDL2_mixer/Mix_FreeChunk">Mix_FreeChunk</a> to free a sound effect. We call <a href="https://wiki.libsdl.org/SDL2_mixer/Mix_Quit">Mix_Quit</a> to close down
SDL_mixer.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                    //Handle key press
                    else if( e.type == SDL_KEYDOWN )
                    {
                        switch( e.key.keysym.sym )
                        {
                            //Play high sound effect
                            case SDLK_1:
                            Mix_PlayChannel( -1, gHigh, 0 );
                            break;
                            
                            //Play medium sound effect
                            case SDLK_2:
                            Mix_PlayChannel( -1, gMedium, 0 );
                            break;
                            
                            //Play low sound effect
                            case SDLK_3:
                            Mix_PlayChannel( -1, gLow, 0 );
                            break;
                            
                            //Play scratch sound effect
                            case SDLK_4:
                            Mix_PlayChannel( -1, gScratch, 0 );
                            break;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the event loop, we play a sound effect when the 1, 2, 3, or 4 keys are pressed. The way to play a Mix_Chunk is by calling <a href="https://wiki.libsdl.org/SDL2_mixer/Mix_PlayChannel">Mix_PlayChannel</a>. The
first argument is the channel you want to use to play it. Since we don't care which channel it comes out of, we set the channel to negative 1 which will use the nearest available channel. The second argument is the sound
effect and last argument is the number of times to repeat the effect. We only want it to play once per button press, so we have it repeat 0 times.<br/>
<br/>
A channel in this case is not the same as a hardware channel that can represent the left and right channel of a stereo system. Every sound effect that's played has a channel associated with it. When you want to pause or stop
an effect that is playing, you can halt its channel.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                            case SDLK_9:
                            //If there is no music playing
                            if( Mix_PlayingMusic() == 0 )
                            {
                                //Play the music
                                Mix_PlayMusic( gMusic, -1 );
                            }
                            //If music is being played
                            else
                            {
                                //If the music is paused
                                if( Mix_PausedMusic() == 1 )
                                {
                                    //Resume the music
                                    Mix_ResumeMusic();
                                }
                                //If the music is playing
                                else
                                {
                                    //Pause the music
                                    Mix_PauseMusic();
                                }
                            }
                            break;
                            
                            case SDLK_0:
                            //Stop the music
                            Mix_HaltMusic();
                            break;
                        }
                    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this demo, we want to play/pause the music on a 9 keypress and stop the music on a 0 keypress.<br/>
<br/>
When the 9 key pressed we first check if the music is not playing with   <a href="https://wiki.libsdl.org/SDL2_mixer/Mix_PlayingMusic">Mix_PlayingMusic</a>. If it isn't, we start the music with
<a href="https://wiki.libsdl.org/SDL2_mixer/Mix_PlayMusic">Mix_PlayMusic</a>. The first argument is the music we want to play and the last argument is the number of times to repeat it. Negative 1 is a special
value saying we want to loop it until it is stopped.<br/>
<br/>
If there is music playing, we check if the music is paused using <a href="https://wiki.libsdl.org/SDL2_mixer/Mix_PausedMusic">Mix_PausedMusic</a>. If the music is paused, we resume it using
<a href="https://wiki.libsdl.org/SDL2_mixer/Mix_ResumeMusic">Mix_ResumeMusic</a>. If the music is not paused we pause it using
<a href="https://wiki.libsdl.org/SDL2_mixer/Mix_PauseMusic">Mix_PauseMusic</a>.<br/>
<br/>
When 0 is pressed, we stop music if it's playing using <a href="https://wiki.libsdl.org/SDL2_mixer/Mix_HaltMusic">Mix_HaltMusic</a>.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="21_sound_effects_and_music.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Sound Effects and Music">Back to Index</a>


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