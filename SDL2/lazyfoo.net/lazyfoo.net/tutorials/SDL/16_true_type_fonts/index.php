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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac render font text">
<meta name="description" content="Render text with TTF fonts in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - True Type Fonts</title>

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
    <h1 class="text-center">True Type Fonts</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="True Type Fonts screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Nov 26th, 2023</b></p>
    
        One way to render text with SDL is with the extension library SDL_ttf. SDL_ttf allows you to create images from TrueType fonts which we'll use here to create textures from font text.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Using SDL, SDL_image, SDL_ttf, standard IO, math, and strings
#include &#60SDL.h&#62
#include &#60SDL_image.h&#62
#include &#60SDL_ttf.h&#62
#include &#60stdio.h&#62
#include &#60string&#62
#include &#60cmath&#62
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">To use SDL_ttf, you have to set up <a href="https://github.com/libsdl-org/SDL_ttf/releases">the SDL_ttf extension library</a> just like you would
<a href="../06_extension_libraries_and_loading_other_image_formats/index.php">set up SDL_image</a>. Like before, it's just a matter of having the headers files, library files, and binary files in the right place with your
compiler configured to use them.
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
        
        //Creates image from font string
        bool loadFromRenderedText( std::string textureText, SDL_Color textColor );

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

    private:
        //The actual hardware texture
        SDL_Texture* mTexture;

        //Image dimensions
        int mWidth;
        int mHeight;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we're adding another function to the <a href="../10_color_keying/index.php">texture class</a> called loadFromRenderedText. The way SDL_ttf works is that you create a new image from a font and color. For our texture class
all that means is that we're going to be loading our image from text rendered by SDL_ttf instead of a file.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//The window we'll be rendering to
SDL_Window* gWindow = NULL;

//The window renderer
SDL_Renderer* gRenderer = NULL;

//Globally used font
TTF_Font* gFont = NULL;

//Rendered texture
LTexture gTextTexture;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this and future tutorials, we'll be using a global font for our text rendering. In SDL_ttf, the data type for fonts is TTF_Font.<br/>
<br/>
We also have a texture which will be generated from the font.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool LTexture::loadFromRenderedText( std::string textureText, SDL_Color textColor )
{
    //Get rid of preexisting texture
    free();

    //Render text surface
    SDL_Surface* textSurface = TTF_RenderText_Solid( gFont, textureText.c_str(), textColor );
    if( textSurface == NULL )
    {
        printf( "Unable to render text surface! SDL_ttf Error: %s\n", TTF_GetError() );
    }
    else
    {
        //Create texture from surface pixels
        mTexture = SDL_CreateTextureFromSurface( gRenderer, textSurface );
        if( mTexture == NULL )
        {
            printf( "Unable to create texture from rendered text! SDL Error: %s\n", SDL_GetError() );
        }
        else
        {
            //Get image dimensions
            mWidth = textSurface->w;
            mHeight = textSurface->h;
        }

        //Get rid of old surface
        SDL_FreeSurface( textSurface );
    }
    
    //Return success
    return mTexture != NULL;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is where we actually create the text texture we're going to render from the font. This function takes in the string of text we want to render and the color we want to use to render it. After that, this function pretty
much works like loading from a file does, only this time we're using a SDL_Surface created by SDL_ttf instead of a file.<br/>
<br/>
After freeing any preexisting textures, we load a surface using <a href="https://wiki.libsdl.org/SDL2_ttf/TTF_RenderText_Solid">TTF_RenderText_Solid</a>. This creates a solid color surface from the font, text, and color
given. If the surface was created successfully, <a href="../07_texture_loading_and_rendering/index.php">we create a texture out of it</a> just like we did before when loading a surface from a file. After the text texture is
created, we can render with it just like any other texture.<br/>
<br/>
There are other ways to render text that are smoother or blended. Experiment with the different types of rendering outlined in the <a href="https://wiki.libsdl.org/SDL2_ttf/CategoryAPI">SDL_ttf documentation</a>. Shaded/Blended
rendering might work better for different text sizes.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Initialize PNG loading
                int imgFlags = IMG_INIT_PNG;
                if( !( IMG_Init( imgFlags ) & imgFlags ) )
                {
                    printf( "SDL_image could not initialize! SDL_image Error: %s\n", IMG_GetError() );
                    success = false;
                }

                 //Initialize SDL_ttf
                if( TTF_Init() == -1 )
                {
                    printf( "SDL_ttf could not initialize! SDL_ttf Error: %s\n", TTF_GetError() );
                    success = false;
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Just like SDL_image, we have to initialize it or the font loading and rendering functions won't work properly. We start up SDL_ttf using <a href="https://wiki.libsdl.org/SDL2_ttf/TTF_Init">TTF_Init</a>. We can
check for errors using TTF_GetError().
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool loadMedia()
{
    //Loading success flag
    bool success = true;

    //Open the font
    gFont = TTF_OpenFont( "16_true_type_fonts/lazy.ttf", 28 );
    if( gFont == NULL )
    {
        printf( "Failed to load lazy font! SDL_ttf Error: %s\n", TTF_GetError() );
        success = false;
    }
    else
    {
        //Render text
        SDL_Color textColor = { 0, 0, 0 };
        if( !gTextTexture.loadFromRenderedText( "The quick brown fox jumps over the lazy dog", textColor ) )
        {
            printf( "Failed to render text texture!\n" );
            success = false;
        }
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our loading function, we load our font using <a href="https://wiki.libsdl.org/SDL2_ttf/TTF_OpenFont">TTF_OpenFont</a>. This takes in the path to the font file and the point size we want to render at.<br/>
<br/>
If the font loaded successfully, we want to load a text texture using our loading method. As a general rule, you want to minimize the number of time you render text. Only rerender it when you need to and since we're using the
same text surface for this whole program, we only want to render once.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void close()
{
    //Free loaded images
    gTextTexture.free();

    //Free global font
    TTF_CloseFont( gFont );
    gFont = NULL;

    //Destroy window    
    SDL_DestroyRenderer( gRenderer );
    SDL_DestroyWindow( gWindow );
    gWindow = NULL;
    gRenderer = NULL;

    //Quit SDL subsystems
    TTF_Quit();
    IMG_Quit();
    SDL_Quit();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our clean up function, we want to free the font using <a href="https://wiki.libsdl.org/SDL2_ttf/TTF_CloseFont">TTF_CloseFont</a>. We also want to quit the SDL_ttf library with
<a href="https://wiki.libsdl.org/SDL2_ttf/TTF_Quit">TTF_Quit</a> to complete the clean up.
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

                //Render current frame
                gTextTexture.render( ( SCREEN_WIDTH - gTextTexture.getWidth() ) / 2, ( SCREEN_HEIGHT - gTextTexture.getHeight() ) / 2 );

                //Update screen
                SDL_RenderPresent( gRenderer );
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As you can see, after we render the text texture we can render it just like any other texture.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="16_true_type_fonts.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#True Type Fonts">Back to Index</a>


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