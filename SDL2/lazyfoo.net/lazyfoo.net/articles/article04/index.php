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
<meta name="keywords" content="C++ 2D Windows Linux Mac starting game loops">
<meta name="description" content="Game loops make video games go 'round.">

<link href="../../assets/style.css" rel="stylesheet">
<script src="../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Game Loops</title>

<script src="../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
	<a href="../../tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../index.php" class="nav-item nav-link">Articles</a>
	<a href="../../tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../index.php" class="nav-item nav-link">News</a>
	<a href="../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../donate.php" class="nav-item nav-link">Donations</a>
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
    <h1 class="text-center">Game Loops</h1>
    
    <p class="text-center"><b>Last Updated: Nov 22nd, 2012</b></p>
    
        The game loop is a key concept in real time games or any game for that matter. When starting out it can be hard to wrap your mind around. This article is here to help break down the basics.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    A video game is at its heart an application that repeatedly renders to the screen. A game loop is the main loop
that takes in the user input and handles it accordingly to render to the screen. Like any program, things have
to happen in a certain order or the program won't run properly. If your game loop isn't structured properly, it is
going to lead to a lot of headaches.

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">while( gameIsRunning )
{
    //Events
    //Logic
    //Rendering
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here you see the basic structure to a game loop. First you take in the user input, then you do your logic
(motion/physics/AI/etc), and lastly you show everything on the screen. 
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Game Loop
    while( quit == false )
    {
        //Start the frame timer
        fps.start();<div style="background:#330000">        //Events
        while( SDL_PollEvent( &event ) )
        {
            myDot.handle_input();
            
            if( event.type == SDL_QUIT )
            {
                quit = true;
            }
        }
		</div><div style="background:#333333">        //Logic
        myDot.move();
		</div><div style="background:#003300">        //Rendering
        SDL_FillRect( screen, &screen->clip_rect, SDL_MapRGB( screen->format, 0xFF, 0xFF, 0xFF ) );
        
        myDot.show();
        
        if( SDL_Flip( screen ) == -1 )
        {
            return 1;    
        }</div>
        while( fps.get_ticks() < 1000 / FRAMES_PER_SECOND ){}
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is the game loop from the motion tutorial. I've colored the 3 modules to highlight how all event handling is
in one place, all logic is in next place and all the rendering is together is at the end. Keeping everything in
the right module is the key to a good main loop. Sounds easy enough, but there are a few things you want to be careful of when
making your game loop.<br/>
<br/>
First thing you have to remember is not to mix logic with event handling.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void Dot::handle_input()
{
    if( event.type == SDL_KEYDOWN )
    {
        switch( event.key.keysym.sym )
        {
            case SDLK_UP: yVel -= DOT_HEIGHT / 2; break;
            case SDLK_DOWN: yVel += DOT_HEIGHT / 2; break;
            case SDLK_LEFT: xVel -= DOT_WIDTH / 2; break;
            case SDLK_RIGHT: xVel += DOT_WIDTH / 2; break;    
        }
    }
    else if( event.type == SDL_KEYUP )
    {
        switch( event.key.keysym.sym )
        {
            case SDLK_UP: yVel += DOT_HEIGHT / 2; break;
            case SDLK_DOWN: yVel -= DOT_HEIGHT / 2; break;
            case SDLK_LEFT: xVel += DOT_WIDTH / 2; break;
            case SDLK_RIGHT: xVel -= DOT_WIDTH / 2; break;    
        }        
    }
	
    x += xVel;

    if( ( x < 0 ) || ( x + DOT_WIDTH > SCREEN_WIDTH ) )
    {
        x -= xVel;    
    }
    
    y += yVel;
    
    if( ( y < 0 ) || ( y + DOT_HEIGHT > SCREEN_HEIGHT ) )
    {
        y -= yVel;    
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">This right here will obviously not work. The reason is you don't know how many events are going to have to be
handled. If there are no events to handle the dot isn't going to move at all. Event handling is just supposed to set
variables properly so the logic section of the code knows the user's input and can act accordingly.<br/>
<br/>
The logic part of the game loop is the probably the hardest to structure. It contains so many things like AI,
collision detection, motion/physics, state changes, etc. The trick is to keep each section of the logic separated
from the others, but be careful on how you separate the logic.<br/>
<br/>
<div class="text-center"">Let's take this game of Super Street Fighter 2 Turbo for example:<br/>
<img class="img-fluid" alt="street fighter 2" src="ssf2t.png"></div><br/>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Player 1 logic
player1->handle_collision();
player1->set_status();
player1->move();

//Player 2 logic
player2->handle_collision();
player2->set_status();
player2->move();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Let's say we have our logic set up like this with the 1st player logic going first then the 2nd player logic
going after that. Sound good, right? Well let's see what happens when we run it.<br/>
<br/>
<div class="text-center"">Here our two fighters just hit each other.<br/>
<img class="img-fluid" alt="precollision" src="precollision.png"></div><br/>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Player 1 logic<div style="background:#BBBBBB; color: #000000">player1->handle_collision();</div>player1->set_status();
player1->move();

//Player 2 logic
player2->handle_collision();
player2->set_status();
player2->move();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3"><div class="text-center"">First we handle the collision for player one.<br/>
<img class="img-fluid" alt="1" src="a1.png"></div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Player 1 logic
player1->handle_collision();<div style="background:#BBBBBB; color: #000000">player1->set_status();</div>player1->move();

//Player 2 logic
player2->handle_collision();
player2->set_status();
player2->move();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3"><div class="text-center"">Since he got hit, player one is now stunned.<br/>
<img class="img-fluid" alt="" src="a2.png"></div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Player 1 logic
player1->handle_collision();
player1->set_status();<div style="background:#BBBBBB; color: #000000">player1->move();</div>

//Player 2 logic
player2->handle_collision();
player2->set_status();
player2->move();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3"><div class="text-center"">Now player one flies back.<br/>
<img class="img-fluid" alt="3" src="a3.png">
</div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Player 1 logic
player1->handle_collision();
player1->set_status();
player1->move();

//Player 2 logic<div style="background:#BBBBBB; color: #000000">player2->handle_collision();</div>player2->set_status();
player2->move();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3"><div class="text-center"">Now we check collision for player 2. Since player 1 is stunned no collision is detected<br/>
<img class="img-fluid" alt="4" src="a4.png">
</div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Player 1 logic
player1->handle_collision();
player1->set_status();
player1->move();

//Player 2 logic
player2->handle_collision();<div style="background:#BBBBBB; color: #000000">player2->set_status();
player2->move();</div>
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3"><div class="text-center"">Now player 2 will keep going. He will also hit player 1 again in the next frame.<br/>
<img class="img-fluid" alt="5" src="a5.png"><br/>
Now that the logic module is done, this is what gets shown on screen.
</div><br/>
So because of badly structured logic, instead of the hitting each other player 2 will score two hits. This is obviously not what is
wanted. 
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Handle collision
player1->handle_collision();
player2->handle_collision();

//Set status
player1->set_status();
player2->set_status();

//Move players
player1->move();
player2->move();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we have the logic organized by the type of logic it is. Now let's run the code.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Handle collision<div style="background:#BBBBBB; color: #000000">player1->handle_collision();</div>player2->handle_collision();

//Set status
player1->set_status();
player2->set_status();

//Move players
player1->move();
player2->move();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3"><div class="text-center"">First we check the collision for player one.<br/>
<img class="img-fluid" alt="1" src="a1.png">
</div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Handle collision
player1->handle_collision();<div style="background:#BBBBBB; color: #000000">player2->handle_collision();</div>
//Set status
player1->set_status();
player2->set_status();

//Move players
player1->move();
player2->move();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3"><div class="text-center"">Then we check the collision for player two.<br/>
<img class="img-fluid" alt="2" src="b2.png">
</div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Handle collision
player1->handle_collision();
player2->handle_collision();

//Set status<div style="background:#BBBBBB; color: #000000">player1->set_status();</div>player2->set_status();

//Move players
player1->move();
player2->move();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3"><div class="text-center"">Since we know 1st player got hit, we stun first player.<br/>
<img class="img-fluid" alt="2" src="a2.png">
</div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Handle collision
player1->handle_collision();
player2->handle_collision();

//Set status
player1->set_status();<div style="background:#BBBBBB; color: #000000">player2->set_status();</div>
//Move players
player1->move();
player2->move();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3"><div class="text-center"">Because we checked both players for collision before setting status, we know to stun second player also.<br/>
<img class="img-fluid" alt="4" src="b4.png">
</div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Handle collision
player1->handle_collision();
player2->handle_collision();

//Set status
player1->set_status();
player2->set_status();

//Move players<div style="background:#BBBBBB; color: #000000">player1->move();
player2->move();</div>
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3"><div class="text-center"">Now both players fly back as they should.<br/>
<img class="img-fluid" alt="5" src="b5.png">
</div>

So always remember to have all the collision detection in one place, all the motion together in its place, all
state change code in its place, etc, etc.<br/>
<br/>
Yes, I realize the health bars are off. You also might have noticed that it shows only one player playing against
the CPU and I never bothered putting an AI section in the logic. My photoshop skills are pretty limited so you'll
have to excuse my complete lack of artistic ability.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Render
clear_screen();
show_background();
show_objects();
update_screen();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Above you see what a typical rendering module looks like. Keeping the rendering part of your game loop modular shouldn't be too
hard. There are cases where rendering can be more complicated and things have to change rendering order. Just remember to keep
any rendering specific code modular and you should be fine.<br/>
<br/>
So just remember to keep everything in its proper place and you should be fine.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">




If you have any suggestions to improve this article, It would be great if you <a href="../../contact.php">contacted me</a> so I can improve this article.




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
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
	<a href="../../tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../index.php" class="nav-item nav-link">Articles</a>
	<a href="../../tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../index.php" class="nav-item nav-link">News</a>
	<a href="../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>