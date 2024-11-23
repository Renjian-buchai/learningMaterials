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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac circle collision detection">
<meta name="description" content="Check for collision with circles in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Circular Collision Detection</title>

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
    <h1 class="text-center">Circular Collision Detection</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Circular Collision Detection screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jun 19th, 2019</b></p>
    
        Along with collision boxes, circles are the most common form of collider. Here we'll be checking collision between two circles and a circle and a box.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    Checking collision between two circles is easy. All you have to do is check whether the distance between the center of each circle is less than the sum of their radii (radii is the plural for radius).<br/>
<br/>
For box/circle collision, you have to find the point on the collision box that is closest to the center of the circle. If that point is less than the radius of the circle, there is a collision.

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//A circle stucture
struct Circle
{
    int x, y;
    int r;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">SDL has a built in rectangle structure, but we have to make our own circle structure with a position and radius.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//The dot that will move around on the screen
class Dot
{
    public:
        //The dimensions of the dot
        static const int DOT_WIDTH = 20;
        static const int DOT_HEIGHT = 20;

        //Maximum axis velocity of the dot
        static const int DOT_VEL = 1;

        //Initializes the variables
        Dot( int x, int y );

        //Takes key presses and adjusts the dot's velocity
        void handleEvent( SDL_Event& e );

        //Moves the dot and checks collision
        void move( SDL_Rect& square, Circle& circle );

        //Shows the dot on the screen
        void render();

        //Gets collision circle
        Circle& getCollider();

    private:
        //The X and Y offsets of the dot
        int mPosX, mPosY;

        //The velocity of the dot
        int mVelX, mVelY;
        
        //Dot's collision circle
        Circle mCollider;

        //Moves the collision circle relative to the dot's offset
        void shiftColliders();
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is the dot class from previous <a href="../27_collision_detection/index.php">collision detection tutorials</a> with some more additons. The move function takes in a circle and a rectangle to check collision against when
moving. We also now have a circle collider instead of a rectangle collider.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Circle/Circle collision detector
bool checkCollision( Circle& a, Circle& b );

//Circle/Box collision detector
bool checkCollision( Circle& a, SDL_Rect& b );

//Calculates distance squared between two points
double distanceSquared( int x1, int y1, int x2, int y2 );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this tutorial we have our collision detection functions for circle/circle and circle/rectangle collisions. We also have a function that calculates the distance between two points squared.<br/>
<br/>
Using the distance squared instead of the distance is an optimization we'll go into more detail later.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">Dot::Dot( int x, int y )
{
    //Initialize the offsets
    mPosX = x;
    mPosY = y;

    //Set collision circle size
    mCollider.r = DOT_WIDTH / 2;

    //Initialize the velocity
    mVelX = 0;
    mVelY = 0;

    //Move collider relative to the circle
    shiftColliders();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The constructor takes in a position and initializes the colliders and velocity.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void Dot::move( SDL_Rect& square, Circle& circle )
{
    //Move the dot left or right
    mPosX += mVelX;
    shiftColliders();

    //If the dot collided or went too far to the left or right
    if( ( mPosX - mCollider.r < 0 ) || ( mPosX + mCollider.r > SCREEN_WIDTH ) || checkCollision( mCollider, square ) || checkCollision( mCollider, circle ) )
    {
        //Move back
        mPosX -= mVelX;
        shiftColliders();
    }

    //Move the dot up or down
    mPosY += mVelY;
    shiftColliders();

    //If the dot collided or went too far up or down
    if( ( mPosY - mCollider.r < 0 ) || ( mPosY + mCollider.r > SCREEN_HEIGHT ) || checkCollision( mCollider, square ) || checkCollision( mCollider, circle ) )
    {
        //Move back
        mPosY -= mVelY;
        shiftColliders();
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Like in previous <a href="../28_per-pixel_collision_detection/index.php">collision detection tutorials</a>, we move along the x axis, check collision against the edges of the screen, and check against the other scene objects.
If the dot hits something we move back. As always, whenever the dot moves its colliders move with it.<br/>
<br/>
Then we do this again for the y axis.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void Dot::render()
{
    //Show the dot
    gDotTexture.render( mPosX - mCollider.r, mPosY - mCollider.r );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The rendering code is a little different. SDL_Rects have their position at the top left where our circle structure has the position at the center. This means we need to offset the render position to the top left of the circle
by subtracting the radius from the x and y position.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool checkCollision( Circle& a, Circle& b )
{
    //Calculate total radius squared
    int totalRadiusSquared = a.r + b.r;
    totalRadiusSquared = totalRadiusSquared * totalRadiusSquared;

    //If the distance between the centers of the circles is less than the sum of their radii
    if( distanceSquared( a.x, a.y, b.x, b.y ) < ( totalRadiusSquared ) )
    {
        //The circles have collided
        return true;
    }

    //If not
    return false;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is our circle to circle collision detector. It simply checks if the distance squared between the centers is less than the sum of the radii squared. If it is, there is a collison.<br/>
<br/>
Why are we using the distance squared as opposed to the plain distance? Because to calculate the distance involves a square root and calculating a square root is a relatively expensive operation. Fortunately if x > y then
x^2 > y^2, so we can save a square root operation by just comparing the distance squared.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool checkCollision( Circle& a, SDL_Rect& b )
{
    //Closest point on collision box
    int cX, cY;

    //Find closest x offset
    if( a.x < b.x )
    {
        cX = b.x;
    }
    else if( a.x > b.x + b.w )
    {
        cX = b.x + b.w;
    }
    else
    {
        cX = a.x;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">To check if a box and circle collided we need to find the closest point on the box.<br/>
<br/>
If the circle's center is to the left of the box, the x position of the closest point is on the left side of the box.
<div class="text-center"><img class="img-fluid" alt="less" src="less.jpg"></div>
<br/>
If the circle's center is to the right of the box, the x position of the closest point is on the right side of the box.
<div class="text-center"><img class="img-fluid" alt="greater" src="greater.jpg"></div>
<br/>
If the circle's center is inside of the box, the x position of the closest point is the same as the x position of the circle.
<div class="text-center"><img class="img-fluid" alt="equal" src="equal.jpg"></div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Find closest y offset
    if( a.y < b.y )
    {
        cY = b.y;
    }
    else if( a.y > b.y + b.h )
    {
        cY = b.y + b.h;
    }
    else
    {
        cY = a.y;
    }

    //If the closest point is inside the circle
    if( distanceSquared( a.x, a.y, cX, cY ) < a.r * a.r )
    {
        //This box and the circle have collided
        return true;
    }

    //If the shapes have not collided
    return false;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we find the closest y position much like we did the x position. If the distance squared between the closest point on the box and the center of the circle is less than the circle's radius squared, then there is a
collision.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">double distanceSquared( int x1, int y1, int x2, int y2 )
{
    int deltaX = x2 - x1;
    int deltaY = y2 - y1;
    return deltaX*deltaX + deltaY*deltaY;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is the distance squared function. It's just a distance calculation ( squareRoot( x^2 + y^2 ) ) without the square root.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //The dot that will be moving around on the screen
            Dot dot( Dot::DOT_WIDTH / 2, Dot::DOT_HEIGHT / 2 );
            Dot otherDot( SCREEN_WIDTH / 4, SCREEN_HEIGHT / 4 );

            //Set the wall
            SDL_Rect wall;
            wall.x = 300;
            wall.y = 40;
            wall.w = 40;
            wall.h = 400;

</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Before we enter the main loop we define the scene objects.
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
                dot.move( wall, otherDot.getCollider() );

                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render wall
                SDL_SetRenderDrawColor( gRenderer, 0x00, 0x00, 0x00, 0xFF );        
                SDL_RenderDrawRect( gRenderer, &wall );
                
                //Render dots
                dot.render();
                otherDot.render();

                //Update screen
                SDL_RenderPresent( gRenderer );
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally in our main loop we handle input, move the dot with collision check and render the scene objects to the screen.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="29_circular_collision_detection.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Circular Collision Detection">Back to Index</a>


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