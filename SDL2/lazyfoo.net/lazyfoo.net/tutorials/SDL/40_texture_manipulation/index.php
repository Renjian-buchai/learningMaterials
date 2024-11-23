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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac Texture pixel manipulation">
<meta name="description" content="Get and modify texture pixel data in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Texture Manipulation</title>

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
    <h1 class="text-center">Texture Manipulation</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Texture Manipulation screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jan 10th, 2024</b></p>
    
        To do graphics effects often requires pixel access. In this tutorial we'll be altering an image's pixels to white out the background.

    
    
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
        
        //Loads image into pixel buffer
        bool loadPixelsFromFile( std::string path );

        //Creates image from preloaded pixels
        bool loadFromPixels();

        #if defined(SDL_TTF_MAJOR_VERSION)
        //Creates image from font string
        bool loadFromRenderedText( std::string textureText, SDL_Color textColor );
        #endif

        //Deallocates texture
        void free();

        //Set color modulation
        void setColor( Uint8 red, Uint8 green, Uint8 blue );

        //Set blending
        void setBlendMode( SDL_BlendMode blending );

        //Set alpha modulation
        void setAlpha( Uint8 alpha );
        
        //Renders texture at given point
        void render( int x, int y, SDL_Rect* clip = NULL, double angle = 0.0, SDL_Point* center = NULL, SDL_RendererFlip flip = SDL_FLIP_NONE );

        //Gets image dimensions
        int getWidth();
        int getHeight();

        //Pixel accessors
        Uint32* getPixels32();
        Uint32 getPitch32();
        Uint32 mapRGBA( Uint8 r, Uint8 g, Uint8 b, Uint8 a );

    private:
        //The actual hardware texture
        SDL_Texture* mTexture;

        //Surface pixels
        SDL_Surface* mSurfacePixels;
        
        //Image dimensions
        int mWidth;
        int mHeight;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we're adding new functionality to the texture class. We want to be able to manipulate a surface's pixels before turning it into a texture, so we separate function loadPixelsFromFile() to load the pixels and then
loadFromPixels() to turn the texture into pixels.<br/>
<br/>
We have a function to get the raw pixels and a function to get the pitch. The pitch is basically the width of the texture in memory. On some older and mobile hardware, there are limitations of what size texture you can have. If
you create a texture with a width of 100 pixels, it may get padded to 128 pixels wide (the next power of two). Using the pitch, we know how the image is in memory.<br/>
<br/>
Next we have the mapRGBA() which takes in a set of red, green, blue, and alpha in 8 bits and gives us back a single 32bit pixel in the format of the internal SDL_Surface.<br/>
<br/>
In terms of data members we have a pointer to the surface that holds our pixels.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool LTexture::loadPixelsFromFile( std::string path )
{
    //Free preexisting assets
    free();

    //Load image at specified path
    SDL_Surface* loadedSurface = IMG_Load( path.c_str() );
    if( loadedSurface == NULL )
    {
        printf( "Unable to load image %s! SDL_image Error: %s\n", path.c_str(), IMG_GetError() );
    }
    else
    {
        //Convert surface to display format
        mSurfacePixels = SDL_ConvertSurfaceFormat( loadedSurface, SDL_GetWindowPixelFormat( gWindow ), 0 );
        if( mSurfacePixels == NULL )
        {
            printf( "Unable to convert loaded surface to display format! SDL Error: %s\n", SDL_GetError() );
        }
        else
        {
            //Get image dimensions
            mWidth = mSurfacePixels->w;
            mHeight = mSurfacePixels->h;
        }

        //Get rid of old loaded surface
        SDL_FreeSurface( loadedSurface );
    }

    return mSurfacePixels != NULL;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">This function should look fairly familiar. It loads an SDL surface in a way that's similar to the way we used to in loadFromFile(), minus the texture creation.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool LTexture::loadFromPixels()
{
    //Only load if pixels exist
    if( mSurfacePixels == NULL )
    {
        printf( "No pixels loaded!" );
    }
    else
    {
        //Color key image
        SDL_SetColorKey( mSurfacePixels, SDL_TRUE, SDL_MapRGB( mSurfacePixels->format, 0, 0xFF, 0xFF ) );

        //Create texture from surface pixels
        mTexture = SDL_CreateTextureFromSurface( gRenderer, mSurfacePixels );
        if( mTexture == NULL )
        {
            printf( "Unable to create texture from loaded pixels! SDL Error: %s\n", SDL_GetError() );
        }
        else
        {
            //Get image dimensions
            mWidth = mSurfacePixels->w;
            mHeight = mSurfacePixels->h;
        }

        //Get rid of old loaded surface
        SDL_FreeSurface( mSurfacePixels );
        mSurfacePixels = NULL;
    }

    //Return success
    return mTexture != NULL;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">And here's the other half of our old texture loading function that actually loads the texture.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool LTexture::loadFromFile( std::string path )
{
    //Load pixels
    if( !loadPixelsFromFile( path ) )
    {
        printf( "Failed to load pixels for %s!\n", path.c_str() );
    }
    else
    {
        //Load texture from pixels
        if( !loadFromPixels() )
        {
            printf( "Failed to texture from pixels from %s!\n", path.c_str() );
        }
    }

    //Return success
    return mTexture != NULL;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally here's the old loadFromFile() function refactored to use our separated loading functions.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">Uint32* LTexture::getPixels32()
{
    Uint32* pixels = NULL;

    if( mSurfacePixels != NULL )
    {
        pixels =  static_cast<Uint32*>( mSurfacePixels->pixels );
    }

    return pixels;
}

Uint32 LTexture::getPitch32()
{
    Uint32 pitch = 0;

    if( mSurfacePixels != NULL )
    {
        pitch = mSurfacePixels->pitch / 4;
    }

    return pitch;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here are the accessors to get the pixels and pitch from the surface. You may be wondering why we are dividing the pitch by 4. Pitch is expressed in bytes and since we want the pitch in pixels and there are 32bits/4bytes
per pixel, we can get the pixel per pitch by dividing the 4 bytes per pixel.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">Uint32 LTexture::mapRGBA( Uint8 r, Uint8 g, Uint8 b, Uint8 a )
{
    Uint32 pixel = 0;

    if( mSurfacePixels != NULL )
    {
        pixel = SDL_MapRGBA( mSurfacePixels->format, r, g, b, a );
    }

    return pixel;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As you can see, our mapRGBA is just a wrapper for SDL_MapRGBA() that maps the pixel in the format of the internal surface.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool loadMedia()
{
    //Loading success flag
    bool success = true;

    //Load Foo' texture pixel
    if( !gFooTexture.loadPixelsFromFile( "40_texture_manipulation/foo.png" ) )
    {
        printf( "Unable to load Foo' texture!\n" );
        success = false;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our media loading function we load the pixels for the texture.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    else
    {
        //Get pixel data
        Uint32* pixels = gFooTexture.getPixels32();
        int pixelCount = gFooTexture.getPitch32() * gFooTexture.getHeight();

        //Map colors
        Uint32 colorKey = gFooTexture.mapRGBA( 0xFF, 0x00, 0xFF, 0xFF );
        Uint32 transparent = gFooTexture.mapRGBA( 0xFF, 0xFF, 0xFF, 0x00 );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After the pixels are loaded, we're going to go through the pixels and make all the background pixels transparent. What we're doing is essentially manually color keying the image.<br/>
<br/>
First we want to get a pointer to the pixels and get the number of pixels we're going to traverse. Then we want to map the color key (in this case we're using magenta), and the transparent color.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Color key pixels
        for( int i = 0; i < pixelCount; ++i )
        {
            if( pixels[ i ] == colorKey )
            {
                pixels[ i ] = transparent;
            }
        }

        //Create texture from manually color keyed pixels
        if( !gFooTexture.loadFromPixels() )
        {
            printf( "Unable to load Foo' texture from surface!\n" );
        }
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">What we're going to do is find all the pixels that are the color key color and then replace them with transparent pixels.<br/>
<br/>
After we're done going through the pixels we load the texture from the pixels we manipulated.
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

    //Free surface if it exists
    if( mSurfacePixels != NULL )
    {
        SDL_FreeSurface( mSurfacePixels );
        mSurfacePixels = NULL;
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Don't forget, whenever you allocate memory always make sure to have a matching free.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="40_texture_manipulation.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Texture Manipulation">Back to Index</a>


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