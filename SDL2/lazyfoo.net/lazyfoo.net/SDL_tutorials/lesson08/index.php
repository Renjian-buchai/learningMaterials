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
<div class="tutPreface"><h1 class="tutHead">Key Presses</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 2/23/14</h6>
This lesson covers how to detect key presses. It's a simple program that shows which arrow key was pressed.
You've already done some simple event handling with SDL_QUIT, now this tutorial will teach you to detect when a
key is pressed, and how to check which key it was.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/04_key_presses/index.php">Key presses tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">    //Generate the message surfaces
    upMessage = TTF_RenderText_Solid( font, "Up was pressed.", textColor );
    downMessage = TTF_RenderText_Solid( font, "Down was pressed.", textColor );
    leftMessage = TTF_RenderText_Solid( font, "Left was pressed", textColor );
    rightMessage = TTF_RenderText_Solid( font, "Right was pressed", textColor );
</div>

<div class="tutText">
After everything is initialized and loaded, we generate all 4 message surfaces.<br>
<br>
I probably should have checked for errors when rendering the text but ....eh, less typing for me.
</div>

<div class="tutCode">        //If there's an event to handle
        if( SDL_PollEvent( &event ) )
        {
            //If a key was pressed
            if( event.type == SDL_KEYDOWN )
            {
</div>

<div class="tutText">
Now when we want to check when a key is pressed, we check for event type SDL_KEYDOWN.
</div>

<div class="tutCode">                //Set the proper message surface
                switch( event.key.keysym.sym )
                {
                    case SDLK_UP: message = upMessage; break;
                    case SDLK_DOWN: message = downMessage; break;
                    case SDLK_LEFT: message = leftMessage; break;
                    case SDLK_RIGHT: message = rightMessage; break;
                }
            }
            
            //If the user has Xed out the window
            else if( event.type == SDL_QUIT )
            {
                //Quit the program
                quit = true;
            }
        }
</div>

<div class="tutText">
Now if a key was pressed, we need to check which key it was.<br>
<br>
SDL_PollEvent() puts the SDL_KEYDOWN data in the event structure as a SDL_KeyboardEvent named "key":<br>
<div class="tutImg"><img src="keydown.jpg"></div>
and inside of "key" is a keysym structure:<br>
<div class="tutImg"><img src="keysym.jpg"></div>
and inside of the keysym is the SDL_Key named "sym", which is which key was pressed.<br>
<br>
If the up arrow was pressed, the sym will be SDLK_UP and we'll set the message to be up,
if the down arrow was pressed, the sym will be SDLK_DOWN and we'll set the message to be down, etc, etc.<br>
<br>
To see what all the SDL_Key definitions are, you can look it up in the SDL documentation.<br>
<br>
We also check if the user wants to X out the window, and handle it accordingly.<br>
<br>
Note: Some IDEs like Code::Blocks have the -Wall flag on by default. This will cause the compiler to complain if you don't have a case statement for all the key values. You can get the compiler to stop complaining by adding:
<h6>default : ;</h6>
to your switch block.
</div>

<div class="tutCode">        //If a message needs to be displayed
        if( message != NULL )
        {
            //Apply the images to the screen
            apply_surface( 0, 0, background, screen );
            apply_surface( ( SCREEN_WIDTH - message->w ) / 2, ( SCREEN_HEIGHT - message->h ) / 2, message, screen );
            
            //Null the surface pointer
            message = NULL;
        }
    
        //Update the screen
        if( SDL_Flip( screen ) == -1 )
        {
            return 1;    
        }
</div>

<div class="tutText">
When the message surface isn't pointing to anything it'll be NULL and nothing will be blitted.
When the message surface is pointing to something we'll apply the background, then apply the message surface centered on the screen.<br>
<br>
The way you center a surface is to first subtract the width/height from the width/height of the surface you're blitting to.
Since when surface is centered the padding on both sides is equal, you divide the remaining distance into two equal halves.<br>
<br>
After that we reset the message to NULL, then we update the screen.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson08.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson07/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson09/index.php">Next Tutorial</a><br>
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