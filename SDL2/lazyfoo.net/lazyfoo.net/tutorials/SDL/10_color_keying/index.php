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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac SDL color keying transparent backgrounds">
<meta name="description" content="Render images with transparent backgrounds using color keying.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Color Keying</title>

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
    <h1 class="text-center">Color Keying</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Color Keying screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jun 11th, 2019</b></p>
    
        When rendering multiple images on the screen, having images with transparent backgrounds is usually necessary. Fortunately SDL provides an easy way to do this using color keying.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Texture wrapper class
class LTexture
{
    public:
        //Initializes variables
        LTexture();

        //Deallocates memory
        ~LTexture();

        //Loads image at specified path
        bool loadFromFile( std::string path );

        //Deallocates texture
        void free();

        //Renders texture at given point
        void render( int x, int y );

        //Gets image dimensions
        int getWidth();
        int getHeight();

    private:
        //The actual hardware texture
        SDL_Texture* mTexture;

        //Image dimensions
        int mWidth;
        int mHeight;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this tutorial we're going to wrap the SDL_Texture in a class to make some things easier. For example, if you want to get certain information about the texture such as its width or height you would have to use some SDL
functions to query the information for the texture. Instead what we're going to do is use a class to wrap and store the information about the texture.<br/>
<br/>
It's a fairly straight forward class in terms of design. It has a constructor/destructor pair, a file loader, a deallocator, a renderer that takes in a position, and functions to get the texture's dimensions. For member
variables, it has the texture we're going to wrap, and variables to store the width/height.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//The window we'll be rendering to
SDL_Window* gWindow = NULL;

//The window renderer
SDL_Renderer* gRenderer = NULL;

//Scene textures
LTexture gFooTexture;
LTexture gBackgroundTexture;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this scene there's two textures we're going to load here declared as "gFooTexture" and "gBackgroundTexture". We're going to take this foo' texture:
<div class="text-center"><img class="img-fluid" alt="foo" src="foo.png"></div>
<br/>
Color key the cyan (light blue) colored background and render it on top of this background:<br/>
<div class="text-center"><img class="img-fluid" alt="background" src="background.png"></div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">LTexture::LTexture()
{
    //Initialize
    mTexture = NULL;
    mWidth = 0;
    mHeight = 0;
}

LTexture::~LTexture()
{
    //Deallocate
    free();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The constructor initializes variables and the destructor calls the deallocator which we'll cover later. 
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool LTexture::loadFromFile( std::string path )
{
    //Get rid of preexisting texture
    free();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The texture loading function pretty much works like it did in the <a href="../07_texture_loading_and_rendering/index.php">texture loading tutorial</a> but with some small but important tweaks. First off we deallocate the
texture in case there's one that's already loaded.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //The final texture
    SDL_Texture* newTexture = NULL;

    //Load image at specified path
    SDL_Surface* loadedSurface = IMG_Load( path.c_str() );
    if( loadedSurface == NULL )
    {
        printf( "Unable to load image %s! SDL_image Error: %s\n", path.c_str(), IMG_GetError() );
    }
    else
    {
        //Color key image
        SDL_SetColorKey( loadedSurface, SDL_TRUE, SDL_MapRGB( loadedSurface->format, 0, 0xFF, 0xFF ) );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Next, we color key the image with <a href="http://wiki.libsdl.org/SDL_SetColorKey">SDL_SetColorKey</a> before creating a texture from it. The first argument is the surface we want to color key, the second argument covers
whether we want to enable color keying, and the last argument is the pixel we want to color key with.<br/>
<br/>
The most cross platform way to create a pixel from RGB color is with <a href="http://wiki.libsdl.org/SDL_MapRGB">SDL_MapRGB</a>. The first argument is the format we want the pixel in. Fortunately the loaded surface has a
format member variable. The last three variables are the red, green, and blue components for color you want to map. Here we're mapping cyan which is red 0, green 255, blue 255.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Create texture from surface pixels
        newTexture = SDL_CreateTextureFromSurface( gRenderer, loadedSurface );
        if( newTexture == NULL )
        {
            printf( "Unable to create texture from %s! SDL Error: %s\n", path.c_str(), SDL_GetError() );
        }
        else
        {
            //Get image dimensions
            mWidth = loadedSurface->w;
            mHeight = loadedSurface->h;
        }

        //Get rid of old loaded surface
        SDL_FreeSurface( loadedSurface );
    }

    //Return success
    mTexture = newTexture;
    return mTexture != NULL;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After color keying the loaded surface, we create a texture from the loaded and color keyed surface. If the texture was created successfully, we store the width/height of the texture and return whether the texture loaded
successfully.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void LTexture::free()
{
    //Free texture if it exists
    if( mTexture != NULL )
    {
        SDL_DestroyTexture( mTexture );
        mTexture = NULL;
        mWidth = 0;
        mHeight = 0;
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The deallocator simply checks if a texture exists, destroys it, and reinitializes the member variables.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void LTexture::render( int x, int y )
{
    //Set rendering space and render to screen
    SDL_Rect renderQuad = { x, y, mWidth, mHeight };
    SDL_RenderCopy( gRenderer, mTexture, NULL, &renderQuad );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here you see why we needed a wrapper class. Up until now, we have been pretty much been rendering full screen images so we didn't need to specify position. Because we didn't need to specify position, we just called
SDL_RenderCopy with the last two arguments as NULL.<br/>
<br/>
When rendering a texture in a certain place, you need to specify a destination rectangle that sets the x/y position and width/height. We can't specify the width/height without knowing the original image's dimensions. So here
when we render our texture we create a rectangle with the position arguments and the member width/height, and pass in this rectangle to SDL_RenderCopy.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">int LTexture::getWidth()
{
    return mWidth;
}

int LTexture::getHeight()
{
    return mHeight;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">These last member functions allow us to get the width/height when we need them.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool loadMedia()
{
    //Loading success flag
    bool success = true;

    //Load Foo' texture
    if( !gFooTexture.loadFromFile( "10_color_keying/foo.png" ) )
    {
        printf( "Failed to load Foo' texture image!\n" );
        success = false;
    }
    
    //Load background texture
    if( !gBackgroundTexture.loadFromFile( "10_color_keying/background.png" ) )
    {
        printf( "Failed to load background texture image!\n" );
        success = false;
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here are the image loading functions in action.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void close()
{
    //Free loaded images
    gFooTexture.free();
    gBackgroundTexture.free();

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


    <div class="container border-start border-end border-bottom py-3 mb-3">And here are the deallocators.
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

                //Render background texture to screen
                gBackgroundTexture.render( 0, 0 );

                //Render Foo' to the screen
                gFooTexture.render( 240, 190 );

                //Update screen
                SDL_RenderPresent( gRenderer );
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is the main loop with our textures rendering. It's a basic loop that handles events, clears the screen, renders the background, renders the stick figure on top of it, and updates the screen.<br/>
<br/>
An important thing to note is that order matters when you're rendering multiple things to the screen every frame. If we render the stick figure first, the background will render over it and you won't be able to see the stick
figure.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="10_color_keying.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Color Keying">Back to Index</a>


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