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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac alpha blending transparency">
<meta name="description" content="Render transparent textures with SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Alpha Blending</title>

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
    <h1 class="text-center">Alpha Blending</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Alpha Blending screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Jul 13th, 2014</b></p>
    
        Thanks to new hardware accelerated rendering, transparency is much faster in SDL 2.0. Here we'll use alpha modulation (which works much like
<a href="../12_color_modulation/index.php">color modulation</a>) to control the transparency of a texture.

    
    
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

        //Set color modulation
        void setColor( Uint8 red, Uint8 green, Uint8 blue );

        //Set blending
        void setBlendMode( SDL_BlendMode blending );

        //Set alpha modulation
        void setAlpha( Uint8 alpha );
        
        //Renders texture at given point
        void render( int x, int y, SDL_Rect* clip = NULL );

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


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we're going to add two functions to support alpha transparency on a texture. First there's setAlpha which will function much like setColor did in the color modulation tutorial. There's also setBlendMode which will
control how the texture is blended. In order to get blending to work properly, you must set the blend mode on the texture. We'll cover this in detail later.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool loadMedia()
{
    //Loading success flag
    bool success = true;

    //Load front alpha texture
    if( !gModulatedTexture.loadFromFile( "13_alpha_blending/fadeout.png" ) )
    {
        printf( "Failed to load front texture!\n" );
        success = false;
    }
    else
    {
        //Set standard alpha blending
        gModulatedTexture.setBlendMode( SDL_BLENDMODE_BLEND );
    }

    //Load background texture
    if( !gBackgroundTexture.loadFromFile( "13_alpha_blending/fadein.png" ) )
    {
        printf( "Failed to load background texture!\n" );
        success = false;
    }
    
    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here in the texture loading function we're loading the front texture we're going to alpha blend and a background texture. As the front texture gets more transparent, we'll be able to
see more of the back texture. As you can see in the code, after we load the front texture successfully we set the
<a href="http://wiki.libsdl.org/SDL_BlendMode">SDL BlendMode</a> to blend so blending is enabled. Since the background isn't going to be transparent, we don't
have to set the blending on it.<br/>
<br/>
Now how does alpha work? Alpha is opacity, and the lower the opacity the more we can see through it. Like red, green, or blue color components it goes from 0 to 255 when modulating
it. The best way to understand it is with some examples. Say if we had the front image on a white background.<br/>
<br/>
This is the front image at 255 (100% alpha):<br/>
<div class="text-center"><img class="img-fluid" alt="alpha 100%" src="alpha100.png"></div>
<br/>
This is the front image at 191 (75% alpha):<br/>
<div class="text-center"><img class="img-fluid" alt="alpha 75%" src="alpha075.png"></div>
<br/>
This is the front image at 127 (50% alpha):<br/>
<div class="text-center"><img class="img-fluid" alt="alpha 50%" src="alpha050.png"></div>
<br/>
This is the front image at 63 (25% alpha):<br/>
<div class="text-center"><img class="img-fluid" alt="alpha 25%" src="alpha025.png"></div>
<br/>
This is the front image at 0 (0% alpha):<br/>
<div class="text-center"><img class="img-fluid" alt="alpha 0%" src="alpha000.png"></div>
<br/>
As you can see, the lower the alpha the more transparent it is.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void LTexture::setBlendMode( SDL_BlendMode blending )
{
    //Set blending function
    SDL_SetTextureBlendMode( mTexture, blending );
}
        
void LTexture::setAlpha( Uint8 alpha )
{
    //Modulate texture alpha
    SDL_SetTextureAlphaMod( mTexture, alpha );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here are the actual SDL functions that do the actual work. <a href="http://wiki.libsdl.org/SDL_SetTextureBlendMode">SDL_SetTextureBlendMode</a> in setBlendMode allows us to enable blending and
<a href="http://wiki.libsdl.org/SDL_SetTextureAlphaMod">SDL_SetTextureAlphaMod</a> allows us to set the amount of alpha for the whole texture.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Main loop flag
            bool quit = false;

            //Event handler
            SDL_Event e;

            //Modulation component
            Uint8 a = 255;
            
            //While application is running
            while( !quit )
            {
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Right before entering the main loop, we declare a variable to control how much alpha the texture has. It is initialized to 255 so the front texture starts out completely opaque.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Handle events on queue
                while( SDL_PollEvent( &e ) != 0 )
                {
                    //User requests quit
                    if( e.type == SDL_QUIT )
                    {
                        quit = true;
                    }
                    //Handle key presses
                    else if( e.type == SDL_KEYDOWN )
                    {
                        //Increase alpha on w
                        if( e.key.keysym.sym == SDLK_w )
                        {
                            //Cap if over 255
                            if( a + 32 > 255 )
                            {
                                a = 255;
                            }
                            //Increment otherwise
                            else
                            {
                                a += 32;
                            }
                        }
                        //Decrease alpha on s
                        else if( e.key.keysym.sym == SDLK_s )
                        {
                            //Cap if below 0
                            if( a - 32 < 0 )
                            {
                                a = 0;
                            }
                            //Decrement otherwise
                            else
                            {
                                a -= 32;
                            }
                        }
                    }
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The event loop handles quit events and making the alpha value go up/down with the w/s keys.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render background
                gBackgroundTexture.render( 0, 0 );

                //Render front blended
                gModulatedTexture.setAlpha( a );
                gModulatedTexture.render( 0, 0 );

                //Update screen
                SDL_RenderPresent( gRenderer );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the end of the main loop we do our rendering. After clearing the screen we render the background first and then we render the front modulated texture over it. Right before rendering the front texture, we set its alpha
value. Try increasing/decreasing the alpha value to see how transparency affects the rendering.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="13_alpha_blending.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Alpha Blending">Back to Index</a>


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