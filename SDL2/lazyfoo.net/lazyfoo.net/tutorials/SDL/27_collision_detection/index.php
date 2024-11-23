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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac AABB collision box detection">
<meta name="description" content="Check for collision SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Collision Detection</title>

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
    <h1 class="text-center">Collision Detection</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Collision Detection screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 23rd, 2022</b></p>
    
        In games you often need to tell if two objects hit each other. For simple games, this is usually done with bounding box collision detection.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    Collision boxes are a standard way to check collision between two objects. Two polygons are in collision when they are not separated.<br/>
<br/>
Here we have two boxes that are not collided. As you can see, their x projections are on the bottom and their y projections are on the left:
<div class="text-center"><img class="img-fluid" alt="x/y separation" src="xy_separation.png"></div><br/>
<br/>
Here you see the boxes have collided along the y axis but they are separated on the x axis:
<div class="text-center"><img class="img-fluid" alt="x separation" src="x_separation.png"></div><br/>
<br/>
Here the boxes are collided on the x axis but they are separated on the y axis:
<div class="text-center"><img class="img-fluid" alt="y separation" src="y_separation.png"></div><br/>
<br/>
When there is no separation on any of the axes there is a collision:
<div class="text-center"><img class="img-fluid" alt="collision detected" src="collision.png"></div><br/>
<br/>
This form of collision detection where we try to find an axis where the objects are separated is called the separating axis test. If there is no separating axis, then the objects are colliding.

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

        //Initializes the variables
        Dot();

        //Takes key presses and adjusts the dot's velocity
        void handleEvent( SDL_Event& e );

        //Moves the dot and checks collision
        void move( SDL_Rect& wall );

        //Shows the dot on the screen
        void render();

    private:
        //The X and Y offsets of the dot
        int mPosX, mPosY;

        //The velocity of the dot
        int mVelX, mVelY;
        
        //Dot's collision box
        SDL_Rect mCollider;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is the dot from the <a href="../26_motion/index.php">motion tutorial</a> with some new features. The move function takes in a rectangle that is the collision box for the wall and the dot has a data member called
mCollider to represent the collision box.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Starts up SDL and creates window
bool init();

//Loads media
bool loadMedia();

//Frees media and shuts down SDL
void close();

//Box collision detector
bool checkCollision( SDL_Rect a, SDL_Rect b );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">We're also declaring a function to check collision between two boxes.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">Dot::Dot()
{
    //Initialize the offsets
    mPosX = 0;
    mPosY = 0;

    //Set collision box dimension
    mCollider.w = DOT_WIDTH;
    mCollider.h = DOT_HEIGHT;

    //Initialize the velocity
    mVelX = 0;
    mVelY = 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the constructor we should make sure the collider's dimensions are set.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void Dot::move( SDL_Rect& wall )
{
    //Move the dot left or right
    mPosX += mVelX;
    mCollider.x = mPosX;

    //If the dot collided or went too far to the left or right
    if( ( mPosX < 0 ) || ( mPosX + DOT_WIDTH > SCREEN_WIDTH ) || checkCollision( mCollider, wall ) )
    {
        //Move back
        mPosX -= mVelX;
        mCollider.x = mPosX;
    }

    //Move the dot up or down
    mPosY += mVelY;
    mCollider.y = mPosY;

    //If the dot collided or went too far up or down
    if( ( mPosY < 0 ) || ( mPosY + DOT_HEIGHT > SCREEN_HEIGHT ) || checkCollision( mCollider, wall ) )
    {
        //Move back
        mPosY -= mVelY;
        mCollider.y = mPosY;
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is the new moving function that now checks if we hit the wall. It works much like before only now it makes the dot move back if we go off the screen or hit the wall.<br/>
<br/>
First we move the dot along the x axis, but we also have to change the position of the collider. Whenever we change the dot's position, the collider's position has to follow. Then we check if the dot has gone off screen or hit
the wall. If it does we move the dot back along the x axis. Finally, we do this again for motion on the y axis.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool checkCollision( SDL_Rect a, SDL_Rect b )
{
    //The sides of the rectangles
    int leftA, leftB;
    int rightA, rightB;
    int topA, topB;
    int bottomA, bottomB;

    //Calculate the sides of rect A
    leftA = a.x;
    rightA = a.x + a.w;
    topA = a.y;
    bottomA = a.y + a.h;

    //Calculate the sides of rect B
    leftB = b.x;
    rightB = b.x + b.w;
    topB = b.y;
    bottomB = b.y + b.h;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is where the collision detection happens. This code calculates the top/bottom and left/right of each of the collison boxes.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //If any of the sides from A are outside of B
    if( bottomA <= topB )
    {
        return false;
    }

    if( topA >= bottomB )
    {
        return false;
    }

    if( rightA <= leftB )
    {
        return false;
    }

    if( leftA >= rightB )
    {
        return false;
    }

    //If none of the sides from A are outside B
    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is where we do our separating axis test. First we check the top and bottom of the boxes to see if they are separated along the y axis. Then we check the left/right to see if they are separated on the x axis. If there is
any separation, then there is no collision and we return false. If we cannot find any separation, then there is a collision and we return true.<br/>
<br/>
Note: SDL does have some <a href="https://wiki.libsdl.org/CategoryRect">built in collision detection functions</a>, but for this tutorial set we'll be hand rolling our own. Mainly because it's important to know how these work
and secondly because if you can roll your own you can use your collision detection with SDL rendering, OpenGL, Direct3D, Mantle, Metal, or any other rendering API.<br/>
<br/>
Also remember that SDL uses a y axis that points down as opposed to the cartesian coordinate which points upward. This means our bottom/top comparisons are also going to be inverted.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Main loop flag
            bool quit = false;

            //Event handler
            SDL_Event e;

            //The dot that will be moving around on the screen
            Dot dot;

            //Set the wall
            SDL_Rect wall;
            wall.x = 300;
            wall.y = 40;
            wall.w = 40;
            wall.h = 400;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Before we enter the main loop, we declare the dot and define the postion and dimensions of the wall.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //While application is running
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

                //Move the dot and check collision
                dot.move( wall );

                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render wall
                SDL_SetRenderDrawColor( gRenderer, 0x00, 0x00, 0x00, 0xFF );        
                SDL_RenderDrawRect( gRenderer, &wall );
                
                //Render dot
                dot.render();

                //Update screen
                SDL_RenderPresent( gRenderer );
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our main loop with the dot handling events, moving while checking for collision against the wall and finally rendering the wall and the dot onto the screen.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">
    These next two sections are for future reference. Odds are if you're reading this tutorial, you're a beginner and this stuff is way too advanced. This is more for down the road when you need to use more advanced collision
detection.<br/>
<br/>
Now when you're starting out and just want to make something simple like tetris, this sort of collision detection is fine. For something like a physics simulator things get much more complicated.<br/>
<br/>
For something like a rigid body simulator, we have our logic do this every frame:<br/>
1) Apply all the forces to all the objects in the scene (gravity, wind, propulsion, etc).<br/>
<br/>
2) Move the objects by applying the acceleration and velocity to the position.<br/>
<br/>
3) Check collisions for all of the objects and create a set of contacts. A contact is a data structure that typically contains pointers to the two objects that are colliding, a normal vector from the first to the second
object, and the amount the objects are penetrating.<br/>
<br/>
4) Take the set of generated contacts and resolve the collisions. This typically involves checking for contacts again (within a limit) and resolving them.<br/>
<br/>
Now if you're barely learning collision detection, this is out of your league for now. This would take an entire tutorial set (that I currently do not have time to make) to explain it. Not only that it involves vector math
and physics which is beyond the scope of these tutorials. Just keep this in mind later on when you need games that have large amounts of colliding objects and are wondering how the over all structure for a physics engine
works.<br/>

</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    Another thing is that the boxes we have here are AABBs or axis aligned bounding boxes. This means they have sides that are aligned with the x and y axis. If you want to have boxes that are rotated, you can still use the
separating axis test on OBBs (oriented bounding boxes). Instead of projecting the corners on the x and y axis, you project all of the corners of the boxes on the I and J axis for each of the boxes. You then check if the boxes
are separated along each axis. You can extend this further for any type of polygon by projecting all of the corners of each axis along each of the polygon's axis to see if there is any separation. This all involves vector math
and this as mentioned before is beyond the scope of this tutorial set.

</div>
                    
                
                    
                        <div class="container border py-3 my-3">

<a href="27_collision_detection.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Collision Detection">Back to Index</a>


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