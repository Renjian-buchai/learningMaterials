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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac SDL Render Primitive Geometry">
<meta name="description" content="Render hardware accelerated shapes with SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Geometry Rendering</title>

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
    <h1 class="text-center">Geometry Rendering</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Geometry Rendering screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 7th, 2018</b></p>
    
        Along with the new texturing API, SDL has new primitive rendering calls as part of its <a href="http://wiki.libsdl.org/CategoryRender">rendering API</a>. So if you need some basic shapes rendered and you don't want to create
additional graphics for them, SDL can save you the effort.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">bool loadMedia()
{
    //Loading success flag
    bool success = true;

    //Nothing to load
    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">So as you can see in our media loading function, we load no media. SDL's primitive rendering allows you to render shapes without loading special graphics.
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
                }

                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of the main loop we handle the quit event like before and clear the screen. Also notice that we're setting the clearing color to white with SDL_SetRenderDrawColor every frame as opposed to setting it once in the
initialization function. We'll cover why this happens when we get to the end of the main loop.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Render red filled quad
                SDL_Rect fillRect = { SCREEN_WIDTH / 4, SCREEN_HEIGHT / 4, SCREEN_WIDTH / 2, SCREEN_HEIGHT / 2 };
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0x00, 0x00, 0xFF );        
                SDL_RenderFillRect( gRenderer, &fillRect );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The first primitive we're going to draw is a fill rectangle, which is a solid rectangle.<br/>
<br/>
First we define a rectangle to define the area we want to fill with color. If you never seen a struct initialized like this, know that the member variables that make up an SDL rect are x, y, w, and h for the x position,
y position, width, and height respectively. You can initialize a struct by giving it an array of variables in the order they are in the struct. Here we're setting the rectangle one quarter of the screen width in the x
direction, one quarter of the screen height in the y direction, and with half the screen's width/height.<br/>
<br/>
After defining the rectangle area, we set the rendering color with SDL_SetRenderDrawColor. This function takes in the renderer for the window we're using and the RGBA values for the color we want to render with. R is the red
component, G is green, B is blue, and A is alpha. Alpha controls how opaque something is and we'll cover that in the transparency tutorial. These values go from 0 to 255 (or FF hex as you see above) and are mixed together to
create all the colors you see on your screen. This call to SDL_SetRenderDrawColor sets the drawing color to opaque red.<br/>
<br/>
After the rectangle and color have been set, <a href="http://wiki.libsdl.org/SDL_RenderFillRect">SDL_RenderFillRect</a> is called to draw the rectangle.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Render green outlined quad
                SDL_Rect outlineRect = { SCREEN_WIDTH / 6, SCREEN_HEIGHT / 6, SCREEN_WIDTH * 2 / 3, SCREEN_HEIGHT * 2 / 3 };
                SDL_SetRenderDrawColor( gRenderer, 0x00, 0xFF, 0x00, 0xFF );        
                SDL_RenderDrawRect( gRenderer, &outlineRect );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">You can also draw a rectangle outline with an empty center using <a href="http://wiki.libsdl.org/SDL_RenderDrawRect">SDL_RenderDrawRect</a>. As you can see it pretty much works the same as a solid filled rectangle as this
piece of code is almost the same as the one above it. The major difference is that this rectangle is 2 thirds of the screen in size and that the color we're using here is green.<br/>
<br/>
Also if you mess with the position of the rectangle, you may notice something strange about the y coordinate. Making the y coordinate larger makes it go down and making the y coordinate smaller makes it go up. This is because
SDL and many 2D rendering APIs use a different coordinate system.<br/>
<br/>
<div class="text-center">
Back in your algebra class, you probably learned about the Cartesian coordinate system:<br/>
<img class="img-fluid" alt="cartesian coordinates" src="cart_coords.png"><br/>
Where the x axis points to the right, the y axis points up, and the origin is in the bottom left corner.
</div>
<br/>
<div class="text-center">
SDL uses a different coordinate system:<br/>
<img class="img-fluid" alt="SDL coordinates" src="sdl_coords.png"><br/>
The x axis still points to the right, but the y axis points down and the origin is in the top left. 
</div>
<br/>
<div class="text-center">
So when we rendered the solid rectangle, the coordinate system functioned like this:<br/>
<img class="img-fluid" alt="rectangle coordinates" src="rect_coords.png"><br/>
Also one thing to know is that SDL renders rectangles, surfaces, and textures from the top left corner.
</div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Draw blue horizontal line
                SDL_SetRenderDrawColor( gRenderer, 0x00, 0x00, 0xFF, 0xFF );        
                SDL_RenderDrawLine( gRenderer, 0, SCREEN_HEIGHT / 2, SCREEN_WIDTH, SCREEN_HEIGHT / 2 );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is the code to draw a pixel thin line using <a href="http://wiki.libsdl.org/SDL_RenderDrawLine">SDL_RenderDrawLine</a>. First we set the color to blue, and then give the rendering calls the starting x/y position and
ending x/y position. These positions cause it to go horizontally straight across the screen.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Draw vertical line of yellow dots
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0x00, 0xFF );
                for( int i = 0; i < SCREEN_HEIGHT; i += 4 )
                {
                    SDL_RenderDrawPoint( gRenderer, SCREEN_WIDTH / 2, i );
                }

                //Update screen
                SDL_RenderPresent( gRenderer );
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The last bit of geometry we render is a sequence of dots using <a href="http://wiki.libsdl.org/SDL_RenderDrawPoint">SDL_RenderDrawPoint</a>. We're just taking a set
of points and drawing them from top to bottom. Again notice the y coordinate and the inverted y axis. After we're finished drawing all our geometry, we update the screen.<br/>
<br/>
Notice the call to SDL_SetRenderDrawColor. We're using 255 red and 255 green which combine together to make yellow. Remember that call to SDL_SetRenderDrawColor at the top of the
loop? If that wasn't there, the screen would be cleared with whatever color was last set with SDL_SetRenderDrawColor, resulting in a yellow background in this case.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="08_geometry_rendering.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Geometry Rendering">Back to Index</a>


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