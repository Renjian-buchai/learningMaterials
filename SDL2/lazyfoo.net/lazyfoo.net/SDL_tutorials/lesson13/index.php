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
<div class="tutPreface"><h1 class="tutHead">Advanced Timers</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/24/14</h6>
You've already learned to make a very basic timer. Here you're going to learn to make a timer class with start,
stop, and pause functions that you would need when programming a game.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/23_advanced_timers/index.php">Advanced Timers tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The timer
class Timer
{
    private:
    //The clock time when the timer started
    int startTicks;
    
    //The ticks stored when the timer was paused
    int pausedTicks;
    
    //The timer status
    bool paused;
    bool started;
    
    public:
    //Initializes variables
    Timer();
    
    //The various clock actions
    void start();
    void stop();
    void pause();
    void unpause();
    
    //Gets the timer's time
    int get_ticks();
    
    //Checks the status of the timer
    bool is_started();
    bool is_paused();    
};
</div>

<div class="tutText">
Here we have the rundown of the timer class.<br>
<br>
"startTicks" is the starting point of the timer, and "pausedTicks" is the time the timer had when it was paused.<br>
<br>
The constructor initializes the variables, and I'm pretty sure you can figure out what start(), stop(), pause(), and unpause() do.<br>
<br>
The function get_ticks() gets the timer's time in milliseconds. is_started() checks if the timer has started, and is_paused() checks if the timer is paused.   
</div>

<div class="tutCode">Timer::Timer()
{
    //Initialize the variables
    startTicks = 0;
    pausedTicks = 0;
    paused = false;
    started = false;    
}
</div>

<div class="tutText">
Here we have the constructor initializing the variables. Nothing much to explain here.
</div>

<div class="tutCode">void Timer::start()
{
    //Start the timer
    started = true;
    
    //Unpause the timer
    paused = false;
    
    //Get the current clock time
    startTicks = SDL_GetTicks();    
}
</div>

<div class="tutText">
Now when we start the timer, we set the started status to true, we unpause the timer, and we set our starting time to the current time using SDL_GetTicks().
</div>

<div class="tutCode">void Timer::stop()
{
    //Stop the timer
    started = false;
    
    //Unpause the timer
    paused = false;    
}
</div>

<div class="tutText">
When we stop it, we set the started status to false and we unpause the timer.
</div>

<div class="tutCode">int Timer::get_ticks()
{
    //If the timer is running
    if( started == true )
    {
        //If the timer is paused
        if( paused == true )
        {
            //Return the number of ticks when the timer was paused
            return pausedTicks;
        }
        else
        {
            //Return the current time minus the start time
            return SDL_GetTicks() - startTicks;
        }    
    }
    
    //If the timer isn't running
    return 0;    
}
</div>

<div class="tutText">
Here we have the function that gets the timer's time.<br>
<br>
First we check if the timer is running. If it is, we then check if the timer is paused.<br>
<br>
If the timer is paused, we return the time the timer had when it was paused.
We'll talk about pausing/unpausing later.<br>
<br>
If the timer isn't paused, we return the difference in the time from when the timer started and the current time.
As you can see it's the exact same formula from the last tutorial.<br>
<br>
If the timer was never running in the first place, the function returns 0.
</div>

<div class="tutCode">void Timer::pause()
{
    //If the timer is running and isn't already paused
    if( ( started == true ) && ( paused == false ) )
    {
        //Pause the timer
        paused = true;
    
        //Calculate the paused ticks
        pausedTicks = SDL_GetTicks() - startTicks;
    }
}
</div>

<div class="tutText">
Now when we want to pause the timer, first we check if the timer is running and if it's not already paused.
If we can pause the timer, we set the paused status to true, and store the timer's time in "pausedTicks".
</div>

<div class="tutCode">void Timer::unpause()
{
    //If the timer is paused
    if( paused == true )
    {
        //Unpause the timer
        paused = false;
    
        //Reset the starting ticks
        startTicks = SDL_GetTicks() - pausedTicks;
        
        //Reset the paused ticks
        pausedTicks = 0;
    }
}
</div>

<div class="tutText">
When we want to unpause the timer, we check if the timer is paused first.<br>
<br>
If it is, we set the paused status to false,
then set the start time to the current clock time minus the time the timer had when it was paused.<br>
<br>
Finally, we set "pausedTicks" to 0 for no real reason other than I don't like stray variables.
</div>

<div class="tutCode">bool Timer::is_started()
{
    return started;    
}

bool Timer::is_paused()
{
    return paused;    
}
</div>

<div class="tutText">
Here are the functions that check the timer's status. I'm pretty sure you can figure out what they do.
</div>

<div class="tutCode">    //Make the timer
    Timer myTimer;
    
    //Generate the message surfaces
    startStop = TTF_RenderText_Solid( font, "Press S to start or stop the timer", textColor );
    pauseMessage = TTF_RenderText_Solid( font, "Press P to pause or unpause the timer", textColor );
</div>

<div class="tutText">
Now in our main function after we do our initialization and file loading, we declare a timer object and render our message surfaces.
</div>

<div class="tutCode">    //Start the timer
    myTimer.start();
    
    //While the user hasn't quit
    while( quit == false )
    {
</div>

<div class="tutText">
Before we enter our main loop we start the timer.
</div>

<div class="tutCode">        //While there's an event to handle
        while( SDL_PollEvent( &event ) )
        {
            //If a key was pressed
            if( event.type == SDL_KEYDOWN )
            {
                //If s was pressed
                if( event.key.keysym.sym == SDLK_s )
                {
                    //If the timer is running
                    if( myTimer.is_started() == true )
                    {
                        //Stop the timer
                        myTimer.stop();    
                    }
                    else
                    {
                        //Start the timer
                        myTimer.start();    
                    }
                }
</div>

<div class="tutText">
This is where we handle our key presses. When "s" is pressed, if the timer is running it is stopped, otherwise the timer is started.
</div>

<div class="tutCode">                //If p was pressed
                if( event.key.keysym.sym == SDLK_p )
                {
                    //If the timer is paused
                    if( myTimer.is_paused() == true )
                    {
                        //Unpause the timer
                        myTimer.unpause();
                    }
                    else
                    {
                        //Pause the timer
                        myTimer.pause();
                    }
                }
            }
</div>

<div class="tutText">
Now when "p" is pressed, if the timer is paused we unpause it, otherwise we pause it. 
</div>

<div class="tutCode">        //The timer's time as a string
        std::stringstream time;
            
        //Convert the timer's time to a string
        time << "Timer: " << myTimer.get_ticks() / 1000.f;
        
        //Render the time surface
        seconds = TTF_RenderText_Solid( font, time.str().c_str(), textColor );
        
        //Apply the time surface
        apply_surface( ( SCREEN_WIDTH - seconds->w ) / 2, 0, seconds, screen );
 
        //Free the time surface
        SDL_FreeSurface( seconds );
               
        //Update the screen
        if( SDL_Flip( screen ) == -1 )
        {
            return 1;    
        }
    }
</div>

<div class="tutText">
After the events are handled and the background and message surfaces are blitted we show the timer's time on the screen.<br>
<br>
First we create a string stream object, and then we put the timer's time in the string stream.
Since we want the timer's time in seconds, we divide it by 1000 since there's 1000 milliseconds per second.<br>
<br>
Next, we create a surface from the string holding the timer's time.
Then the new surface showing the timer's time is blitted to the screen, then free since we're done with it.
After that the screen is updated and we continue the main loop.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson13.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson12/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson14/index.php">Next Tutorial</a><br>
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