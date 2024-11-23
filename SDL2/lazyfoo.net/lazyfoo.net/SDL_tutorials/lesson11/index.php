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
<div class="tutPreface"><h1 class="tutHead">Playing Sounds</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/24/14</h6>
Playing sound is another key concept of game programming. SDL's native sound functions can be quite confusing.
So you're going to learn to play sound effects and music using the extension library SDL_mixer. SDL_mixer is an
extension library that makes using sound braindead easy.<br>
<br>
You can get SDL_mixer from <a class="tutLink" href="http://www.libsdl.org/projects/SDL_mixer/release-1.2.html">here</a>. <br>
<br>
To install SDL_mixer just follow the <a class="tutLink" href="../lesson03/index.php">extension library tutorial</a>.
Installing SDL_mixer is done pretty much the way SDL_image is, so just replace where you see SDL_image with
SDL_mixer.<br>
<br>
This tutorial covers the basics playing music and sound effects using SDL_mixer to play sound effects and "music"
I made by tapping on my monitor.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/21_sound_effects_and_music/index.php">Sound Effects and Music tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The music that will be played
Mix_Music *music = NULL;

//The sound effects that will be used
Mix_Chunk *scratch = NULL;
Mix_Chunk *high = NULL;
Mix_Chunk *med = NULL;
Mix_Chunk *low = NULL;
</div>

<div class="tutText">
Here's the new data types we are going to be working with.<br>
<br>
Mix_Music is the data type we use for music, and Mix_Chunk is the data type used for sound effects.<br>
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
    
    //Initialize SDL_ttf
    if( TTF_Init() == -1 )
    {
        return false;    
    }
    
    //Initialize SDL_mixer
    if( Mix_OpenAudio( 22050, MIX_DEFAULT_FORMAT, 2, 4096 ) == -1 )
    {
        return false;    
    }
    
    //Set the window caption
    SDL_WM_SetCaption( "Monitor Music", NULL );
    
    //If everything initialized fine
    return true;
}
</div>

<div class="tutText">
In the initialization function, we call Mix_OpenAudio() to initialize SDL_mixer's audio functions.<br>
<br>
Mix_OpenAudio()'s first argument is the sound frequency we use, and in this case it's 22050 which is what's
recommended. The second argument is the sound format used which we set to the default. The third argument is how
many channels we plan to use. We set it to 2 so we have stereo sound, if it was set to one we'd have mono sound.
The last argument is the sample size, which is set to 4096.<br>
<br>
For those of you using OGG, MOD, or other sound formats other than WAV, look into using Mix_Init() to initialize
decoders and Mix_Quit() to close the decoders. We're only using WAV files here so let's not add more code for
something we're not going to use.
</div>

<div class="tutCode">bool load_files()
{
    //Load the background image
    background = load_image( "background.png" );
    
    //Open the font
    font = TTF_OpenFont( "lazy.ttf", 30 );
    
    //If there was a problem in loading the background
    if( background == NULL )
    {
        return false;    
    }
    
    //If there was an error in loading the font
    if( font == NULL )
    {
        return false;
    }
    
    //Load the music
    music = Mix_LoadMUS( "beat.wav" );
    
    //If there was a problem loading the music
    if( music == NULL )
    {
        return false;    
    }

    //Load the sound effects
    scratch = Mix_LoadWAV( "scratch.wav" );
    high = Mix_LoadWAV( "high.wav" );
    med = Mix_LoadWAV( "medium.wav" );
    low = Mix_LoadWAV( "low.wav" );
    
    //If there was a problem loading the sound effects
    if( ( scratch == NULL ) || ( high == NULL ) || ( med == NULL ) || ( low == NULL ) )
    {
        return false;    
    }
    
    //If everything loaded fine
    return true;    
}
</div>

<div class="tutText">
Here we have the file loading function.<br>
<br>
To load the music, we use Mix_LoadMUS().
Mix_LoadMUS() takes in the filename of the music file and returns the music data.
It return NULL if there's an error.<br>
<br>
To load sound effects, we use Mix_LoadWAV().
It loads the sound file of the given file name, and returns a Mix_Chunk or NULL if there was an error.
</div>

<div class="tutCode">void clean_up()
{
    //Free the surfaces
    SDL_FreeSurface( background );
    
    //Free the sound effects
    Mix_FreeChunk( scratch );
    Mix_FreeChunk( high );
    Mix_FreeChunk( med );
    Mix_FreeChunk( low );
    
    //Free the music
    Mix_FreeMusic( music );
    
    //Close the font
    TTF_CloseFont( font );
    
    //Quit SDL_mixer
    Mix_CloseAudio();
    
    //Quit SDL_ttf
    TTF_Quit();
    
    //Quit SDL
    SDL_Quit();
}
</div>

<div class="tutText">
In the clean up function, we call Mix_FreeChunk() to get rid of the sound effects and Mix_FreeMusic() to free the music.<br>
<br>
Then after we're done using SDL_mixer, Mix_CloseAudio() is called.
</div>

<div class="tutCode">    //While the user hasn't quit
    while( quit == false )
    {
        //While there's events to handle
        while( SDL_PollEvent( &event ) )
        {
            //If a key was pressed
            if( event.type == SDL_KEYDOWN )
            {
</div>

<div class="tutText">
In our main function after the initialization, file loading and background and messages have been blitted, we enter
our main loop. Then we start handling events, starting with key presses.
</div>

<div class="tutCode">                //If 1 was pressed
                if( event.key.keysym.sym == SDLK_1 )
                {
                    //Play the scratch effect
                    if( Mix_PlayChannel( -1, scratch, 0 ) == -1 )
                    {
                        return 1;    
                    }
                }
                //If 2 was pressed
                else if( event.key.keysym.sym == SDLK_2 )
                {
                    //Play the high hit effect
                    if( Mix_PlayChannel( -1, high, 0 ) == -1 )
                    {
                        return 1;    
                    }
                }
                //If 3 was pressed
                else if( event.key.keysym.sym == SDLK_3 )
                {
                    //Play the medium hit effect
                    if( Mix_PlayChannel( -1, med, 0 ) == -1 )
                    {
                        return 1;    
                    }
                }
                //If 4 was pressed
                else if( event.key.keysym.sym == SDLK_4 )
                {
                    //Play the low hit effect
                    if( Mix_PlayChannel( -1, low, 0 ) == -1 )
                    {
                        return 1;    
                    }
                }
</div>

<div class="tutText">
When checking the key presses, first we check if 1, 2, 3, or 4 have been pressed.
These are the keys that play the sound effects.<br>
<br>
If one of the these keys have been pressed, we call Mix_PlayChannel() to play the key's associated sound effect.<br>
<br>
Mix_PlayChannel()'s first argument is which mixing channel we're going to play the sound in.
Since it's set to -1, Mix_PlayChannel() just looks for the first channel that's available and plays the sound.<br>
<br>
The second argument in the Mix_Chunk that's going to be played.
The third is how many times the sound effect is going to loop. Since it's set to 0, it will only play once.<br>
<br>
When there's a problem playing the sound, Mix_PlayChannel() will return -1.
</div>

<div class="tutCode">                //If 9 was pressed
                else if( event.key.keysym.sym == SDLK_9 )
                {
                    //If there is no music playing
                    if( Mix_PlayingMusic() == 0 )
                    {
                        //Play the music
                        if( Mix_PlayMusic( music, -1 ) == -1 )
                        {
                            return 1;
                        }    
                    }
</div>

<div class="tutText">
Next we handle when 9 is pressed, which is supposed to play/pause the music.<br>
<br>
First we check if the music is playing with Mix_PlayingMusic().
If no music is playing we call Mix_PlayMusic() to play the music.<br>
<br>
The first argument of Mix_PlayMusic() is the music we're going to play.
The second argument is how many times it will loop the music.
Since it's set to -1, it will loop until it is manually stopped.<br>
<br>
If there's a problem in playing the music Mix_PlayMusic() will return -1.
</div>

<div class="tutCode">                    //If music is being played
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
                }
</div>

<div class="tutText">
Now if music was playing when the user pressed 9, we either pause or unpause the music.<br>
<br>
First we check if the music is playing using Mix_PausedMusic().
If it is, we unpause the music using Mix_ResumeMusic().
If the music is not paused, we pause it using Mix_PauseMusic()
</div>

<div class="tutCode">                //If 0 was pressed
                else if( event.key.keysym.sym == SDLK_0 )
                {
                    //Stop the music
                    Mix_HaltMusic();
                }
            }
</div>

<div class="tutText">
Lastly, We check if the user presses 0.<br>
<br>
If the user presses 0, the music is stopped using Mix_HaltMusic().
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson11.zip">here</a>.<br>
<br>
I highly recommend that you download the <a class="tutLink" href="http://jcatki.no-ip.org:8080/SDL_mixer/SDL_mixer_html.zip">SDL_mixer documentation</a>, and keep it around for reference.<br>
<br>
<a class="leftNav" href="../lesson10/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson12/index.php">Next Tutorial</a><br>
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