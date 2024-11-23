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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac texture coloring modulation">
<meta name="description" content="Change your texture's color using color modulation.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Color Modulation</title>

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
    <h1 class="text-center">Color Modulation</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Color Modulation screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Nov 26th, 2023</b></p>
    
        Color modulation allows you to alter the color of your rendered textures. Here we're going to modulate a texture using various colors.

    
    
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


    <div class="container border-start border-end border-bottom py-3 mb-3">We're adding a function to the texture wrapper class that will allow the texture modulation to be set. All it does is take in a red, green, and blue color components.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void LTexture::setColor( Uint8 red, Uint8 green, Uint8 blue )
{
    //Modulate texture
    SDL_SetTextureColorMod( mTexture, red, green, blue );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">And setting texture modulation is as easy as making a call to <a href="http://wiki.libsdl.org/SDL_SetTextureColorMod">SDL_SetTextureColorMod</a>. You just pass in the texture you want to modulate and the color you want to
modulate with.<br/>
<br/>
Now how does color modulation work? Let's say you have this texture:<br/>
<div class="text-center"><img class="img-fluid" alt="full green" src="full.png"></div><br/>
<br/>
And you modulate it with red 255, green 128, and blue 255. You'll end up with this:<br/>
<div class="text-center"><img class="img-fluid" alt="half green" src="half_green.png"></div><br/>
<br/>
You may have noticed that SDL_SetTextureColorMod accepts Uint8 as arguments for the color components. An <b>U</b>int<b>8</b> is just an integer that is <b>U</b>nsigned and <b>8</b>bit. This means it goes from 0 to 255. 128 is
about halfway between 0 and 255, so when you modulate green to 128 it halves the green component for any pixel on the texture.<br/>
<br/>
The red and blue squares don't get affected because they have no green in them, but the green becomes half as bright and the white turns a light magenta (magenta is red 255, green 0, blue 255). Color modulation is just a way
to multiply a color throughout the whole texture.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//The window we'll be rendering to
SDL_Window* gWindow = NULL;

//The window renderer
SDL_Renderer* gRenderer = NULL;

//Scene texture
LTexture gModulatedTexture;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is the texture we're going to modulate after loading it in our file loading function.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Main loop flag
            bool quit = false;

            //Event handler
            SDL_Event e;

            //Modulation components
            Uint8 r = 255;
            Uint8 g = 255;
            Uint8 b = 255;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we are right before the main loop. For this demo we're going to modulate the individual color components using key presses. To do that we'll need to keep track of the values for the color components.
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
                    //On keypress change rgb values
                    else if( e.type == SDL_KEYDOWN )
                    {
                        switch( e.key.keysym.sym )
                        {
                            //Increase red
                            case SDLK_q:
                            r += 32;
                            break;
                            
                            //Increase green
                            case SDLK_w:
                            g += 32;
                            break;
                            
                            //Increase blue
                            case SDLK_e:
                            b += 32;
                            break;
                            
                            //Decrease red
                            case SDLK_a:
                            r -= 32;
                            break;
                            
                            //Decrease green
                            case SDLK_s:
                            g -= 32;
                            break;
                            
                            //Decrease blue
                            case SDLK_d:
                            b -= 32;
                            break;
                        }
                    }
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our event loop we'll have the q, w, and e keys increase the red, green, and blue components and we'll have the a, s, and d key decrease the red, green, and blue components. They increase/decrease the components by 32 so
it's noticable with every key press.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Modulate and render texture
                gModulatedTexture.setColor( r, g, b );
                gModulatedTexture.render( 0, 0 );

                //Update screen
                SDL_RenderPresent( gRenderer );
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">And here we are setting the texture modulation and rendering the texture.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="12_color_modulation.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Color Modulation">Back to Index</a>


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