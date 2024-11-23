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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac load PNGs">
<meta name="description" content="Load PNGs with SDL_image.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Loading PNGs with SDL_image</title>

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
    <h1 class="text-center">Loading PNGs with SDL_image</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Loading PNGs with SDL_image screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Nov 26th, 2023</b></p>
    
        Now that the library is all set up, let's load some PNGs.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Using SDL, SDL_image, standard IO, and strings
#include &#060SDL.h&#062
#include &#060SDL_image.h&#062
#include &#060stdio.h&#062
#include &#060string&#062
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">To use any SDL_image function or data types, we need to include the SDL_image header. We'd have to do the same for SDL_ttf, or SDL_mixer.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool init()
{
    //Initialization flag
    bool success = true;

    //Initialize SDL
    if( SDL_Init( SDL_INIT_VIDEO ) < 0 )
    {
        printf( "SDL could not initialize! SDL Error: %s\n", SDL_GetError() );
        success = false;
    }
    else
    {
        //Create window
        gWindow = SDL_CreateWindow( "SDL Tutorial", SDL_WINDOWPOS_UNDEFINED, SDL_WINDOWPOS_UNDEFINED, SCREEN_WIDTH, SCREEN_HEIGHT, SDL_WINDOW_SHOWN );
        if( gWindow == NULL )
        {
            printf( "Window could not be created! SDL Error: %s\n", SDL_GetError() );
            success = false;
        }
        else
        {
            //Initialize PNG loading
            int imgFlags = IMG_INIT_PNG;
            if( !( IMG_Init( imgFlags ) & imgFlags ) )
            {
                printf( "SDL_image could not initialize! SDL_image Error: %s\n", IMG_GetError() );
                success = false;
            }
            else
            {
                //Get window surface
                gScreenSurface = SDL_GetWindowSurface( gWindow );
            }
        }
    }

    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now that we're using SDL_image, we need to initialize it. Here we want to initialize SDL_image with PNG loading, so we pass in the PNG loading flags into IMG_Init. IMG_Init returns
the flags that loaded successfully. If the flags that are returned do not contain the flags we requested, that means there's an error.<br/>
<br/>
When there's an error with SDL_image, you get error string with IMG_GetError as opposed to SDL_GetError.<br/>
<br/>
Also:<br/>
<b>STOP E-MAILING ME TELLING ME THAT THAT CALL TO IMG_Init IS A BUG!</b><br/>
<b>STOP E-MAILING ME TELLING ME THAT THAT CALL TO IMG_Init IS A BUG!</b><br/>
<b>STOP E-MAILING ME TELLING ME THAT THAT CALL TO IMG_Init IS A BUG!</b><br/>
<b>STOP E-MAILING ME TELLING ME THAT THAT CALL TO IMG_Init IS A BUG!</b><br/>
<b>STOP E-MAILING ME TELLING ME THAT THAT CALL TO IMG_Init IS A BUG!</b><br/>
<br/>
It's not. IMG_INIT_PNG is 2. If you init with IMG_INIT_PNG and get back IMG_INIT_PNG you get 2 & 2 which is 2. 2 will evaluate to true, the ! will negate it which means it will evaluate to false which will cause the 
SDL_GetWindowSurface line to execute.<br/>
<br/>
If you were to get back 4 back from IMG_Init when you wanted 2, 4 & 2 is 0, which evaluates to false, which is negated by the ! to evaluate to true which will cause the error printing code to execute.<br/>
<br/>
If you were to get back 6 back from IMG_Init (both the 4 and 2 bit) when you wanted 2, 6 & 2 is 2, which evaluates to true, which is negated by the ! to evaluate to false which will cause SDL_GetWindowSurface line to
execute.<br/>
<br/>
The reason the code is like that is because we only care about the PNG loading bit. If we get that, that means we can continue. In other cases this code would be different, but we're not dealing with that here.<br/>
<br/>
So make sure to brush up on your binary math and <b>STOP E-MAILING ME TELLING ME THAT THAT CALL TO IMG_Init IS A BUG!</b>. Seriously it's like 25% of the bug reports I get.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">SDL_Surface* loadSurface( std::string path )
{
    //The final optimized image
    SDL_Surface* optimizedSurface = NULL;

    //Load image at specified path
    SDL_Surface* loadedSurface = IMG_Load( path.c_str() );
    if( loadedSurface == NULL )
    {
        printf( "Unable to load image %s! SDL_image Error: %s\n", path.c_str(), IMG_GetError() );
    }
    else
    {
        //Convert surface to screen format
        optimizedSurface = SDL_ConvertSurface( loadedSurface, gScreenSurface->format, 0 );
        if( optimizedSurface == NULL )
        {
            printf( "Unable to optimize image %s! SDL Error: %s\n", path.c_str(), SDL_GetError() );
        }

        //Get rid of old loaded surface
        SDL_FreeSurface( loadedSurface );
    }

    return optimizedSurface;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Our image loading function is pretty much the same as before, only now it uses IMG_Load as opposed to SDL_LoadBMP. IMG_Load can load many different types of format which you can find
out about in the <a href="https://wiki.libsdl.org/SDL2_image/CategoryAPI">SDL_image documentation</a>. Like with IMG_Init, when there's an error with IMG_Load, we call
IMG_GetError to get the error string.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="06_extension_libraries_and_loading_other_image_formats.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Extension Libraries and Loading Other Image Formats">Back to Index</a>


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