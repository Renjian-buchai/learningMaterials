<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" 
"http://www.w3.org/TR/REC-html40/strict.dtd">
<html>

<head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VP5RSQ168Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VP5RSQ168Y');
</script>



<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">

<META NAME=KEYWORDS CONTENT="Lazy Foo' Productions C++ SDL Window Linux Mac Game Programming Tutorials">

<META NAME=DESCRIPTION CONTENT="Tutorials for those who want to start making video games.">

<title>Lazy Foo' Productions</title>

<link REL="stylesheet" TYPE="text/css" href="../lazy.css">
</head>

<body>

<div class="header">
<h1 style="margin-bottom:0px;padding-bottom:0px;border-bottom:0px;">Lazy Foo' Productions</h1>

<div class="nav">
Yes, I am keeping the old tutorial set in the old layout for the sake of having a nostalgic eater egg. It's not because I am too lazy to port this over to the data driven static site generator.<br/>
<br/>
<a class="nav" href="https://discourse.libsdl.org/">SDL Forums</a>
<a class="nav" href="../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../articles/index.php">Articles</a>
<a class="nav" href="../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../index.php">News</a>
<a class="nav" href="../../faq.php">FAQs</a>
<a class="nav" href="../../contact.php">Contact</a>
<a class="nav" href="../../donate.php">Donations</a><br/>
<br/>

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

</div>

</div>

<div class="content">
<div class="tutPreface"><h1 class="tutHead">Pixel Manipulation and Surface Flipping</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/28/10</h6>
SDL has no built in functions to flip surfaces. So we'll just have to flip surfaces ourselves by playing with the
pixels. In this tutorial we will read/write pixels to make our own surface flipping function.<br/>
<br/>
<a class="tutLink" href="../../tutorials/SDL/40_texture_manipulation/index.php">Texture Manipulation tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">bool load_files()
{
    //Load the image
    topLeft = load_image( "corner.png" );
    
    //If there was an problem loading the image
    if( topLeft == NULL )
    {
        return false;    
    }
    
    //If everything loaded fine
    return true;    
}
</div>

<div class="tutText">
In our loading function we only load one image:<br>
<div class="tutImg"><img src="corner.png"></div>
<br>
In order to show all four corners we will have to create them ourselves by flipping the image we loaded.
</div>

<div class="tutCode">Uint32 get_pixel32( SDL_Surface *surface, int x, int y )
{
    //Convert the pixels to 32 bit
    Uint32 *pixels = (Uint32 *)surface->pixels;
    
    //Get the requested pixel
    return pixels[ ( y * surface->w ) + x ];
}

void put_pixel32( SDL_Surface *surface, int x, int y, Uint32 pixel )
{
    //Convert the pixels to 32 bit
    Uint32 *pixels = (Uint32 *)surface->pixels;
    
    //Set the pixel
    pixels[ ( y * surface->w ) + x ] = pixel;
}
</div>

<div class="tutText">
Here's our functions to get and put pixels.
In case you missed the bitmap font tutorial, here's a quick review on how pixel access works:<br>
<br>
First thing we do is convert the pixel pointer from type void to 32bit integer so we can properly access them.
After all, a surface's pixels are nothing more than an array of 32bit integers.
Then we get or set the requested pixel.<br>
<br>
You maybe be wondering why I don't just go "return pixels[ x ][ y ]".<br>
<br>
The thing is the pixels aren't stored like this:<br>
<div class="tutImg"><img src="2d.jpg"></div>
<br>
They're stored like this:<br>
<div class="tutImg"><img src="1d.jpg"></div>
in a single dimensional array.
It's because different operating systems store 2D arrays differently (At least I think that's why).<br>
<br>
So to retrieve the red pixel from the array we multiply the y offset by the width and add the x offset.<br>
<br>
These functions only work for 32-bit surfaces.
You'll have to make one of your own if you're using a different format.<br>
<br>
You can learn more about pixels in <a class="tutLink" href="../../articles/article03/index.php">article 3</a>.
</div>

<div class="tutCode">SDL_Surface *flip_surface( SDL_Surface *surface, int flags )
{
    //Pointer to the soon to be flipped surface
    SDL_Surface *flipped = NULL;
    
    //If the image is color keyed
    if( surface->flags & SDL_SRCCOLORKEY )
    {
        flipped = SDL_CreateRGBSurface( SDL_SWSURFACE, surface->w, surface->h, surface->format->BitsPerPixel, surface->format->Rmask, surface->format->Gmask, surface->format->Bmask, 0 );
    }
    //Otherwise
    else
    {
        flipped = SDL_CreateRGBSurface( SDL_SWSURFACE, surface->w, surface->h, surface->format->BitsPerPixel, surface->format->Rmask, surface->format->Gmask, surface->format->Bmask, surface->format->Amask );
    }
</div>

<div class="tutText">
Now here's our surface flipping function.<br>
<br>
At the top we create a blank surface using SDL_CreateRGBSurface().
It may look complicated, but ultimately we're just creating a surface of the same size and format as the surface
we are given.<br>
<br>
Before we can create the blank surface, we have to check if the surface is color keyed. If it is, we set the alpha
mask to 0 on the new blank surface. The reason is if the alpha mask is anything but 0, the color key gets ignored.
If the source surface is not color keyed, we just copy its alpha mask to the new blank surface.<br>
<br>
Take a look at the SDL Documentation to see how SDL_CreateRGBSurface() works.
</div>

<div class="tutCode">    //If the surface must be locked
    if( SDL_MUSTLOCK( surface ) )
    {
        //Lock the surface
        SDL_LockSurface( surface );
    }
</div>

<div class="tutText">
Before we can start altering pixels we have to check if the surface has to be locked before accessing the pixels
using SDL_MUSTLOCK(). If SDL_MUSTLOCK() says we have to lock the surface, we use SDL_LockSurface() to lock the
surface.<br>
<br>
Now that the surface is locked it's time to mess with the pixels.
</div>

<div class="tutCode">    //Go through columns
    for( int x = 0, rx = flipped->w - 1; x < flipped->w; x++, rx-- )
    {
        //Go through rows
        for( int y = 0, ry = flipped->h - 1; y < flipped->h; y++, ry-- )
        {
</div>

<div class="tutText">
Here is our nested loops used for going through the pixels.
You may be wondering why we declare 2 integers in our for loops.
The reason is that when you flip pixels, you have to read them in one direction and write them in reverse.<br>
<br>
In the x loop, we declare "x" and "rx".
"x" is initialized to 0, and "rx" (which stands for reverse x) is initialized to the width minus 1 which is the end of the surface.<br>
<br>
Then in the middle the condition is normal.
At the end "x" is incremented and "rx" is decremented.
"x" will start at the beginning and go forward, "rx" starts at the end and goes backward.<br>
<br>
So if the surface's width was 10, the for loop will cycle like so:<br>
"x"&nbsp : 0 1 2 3 4 5 6 7 8 9<br>
"rx" : 9 8 7 6 5 4 3 2 1 0<br>
<br>
I'm pretty sure you can now figure out what "y" and "ry" do.
</div>

<div class="tutCode">            //Get pixel
            Uint32 pixel = get_pixel32( surface, x, y );
            
            //Copy pixel
            if( ( flags & FLIP_VERTICAL ) && ( flags & FLIP_HORIZONTAL ) )
            {
                put_pixel32( flipped, rx, ry, pixel );
            }
            else if( flags & FLIP_HORIZONTAL )
            {
                put_pixel32( flipped, rx, y, pixel );
            }
            else if( flags & FLIP_VERTICAL )
            {
                put_pixel32( flipped, x, ry, pixel );
            }
        }    
    }
</div>

<div class="tutText">
Here's the middle of the nested loops.<br>
<br>
First we read in a pixel from the source surface.
Then if the user passed in the FLIP_VERTICAL and the FLIP_HORIZONTAL flags, we write the pixels to the blank surface right to left, bottom to top.<br>
<br>
If the user just passed the FLIP_VERTICAL flag, we write the pixels to the blank surface left to right, bottom to top.<br>
<br>
If the user just passed the FLIP_HORIZONTAL flag, we write the pixels to the blank surface right to left, top to bottom.<br>
<br>
If you're wondering what the flag values are, they're near the top of the source.
</div>

<div class="tutCode">    //Unlock surface
    if( SDL_MUSTLOCK( surface ) )
    {
        SDL_UnlockSurface( surface );
    }
    
    //Copy color key
    if( surface->flags & SDL_SRCCOLORKEY )
    {
        SDL_SetColorKey( flipped, SDL_RLEACCEL | SDL_SRCCOLORKEY, surface->format->colorkey );
    }
	
    //Return flipped surface
    return flipped;
}
</div>

<div class="tutText">
At the end of our surface flipping function, we check if the surface had to be locked.
If it did, we unlock it using SDL_UnlockSurface().<br>
<br>
Then if the surface we had to flip was color keyed, we copy the color key from the original surface to the new
flipped surface we made.<br>
<br>
Lastly we return a pointer to our newly created flipped surface.
</div>

<div class="tutCode">    //Flip surfaces
    topRight = flip_surface( topLeft, FLIP_HORIZONTAL );
    bottomLeft = flip_surface( topLeft, FLIP_VERTICAL );
    bottomRight = flip_surface( topLeft, FLIP_HORIZONTAL | FLIP_VERTICAL );
    
    //Apply the images to the screen
    apply_surface( 0, 0, topLeft, screen );
    apply_surface( 320, 0, topRight, screen );
    apply_surface( 0, 240, bottomLeft, screen );
    apply_surface( 320, 240, bottomRight, screen );
        
    //Update the screen
    if( SDL_Flip( screen ) == -1 )
    {
        return 1;    
    }
    
</div>

<div class="tutText">
and here's the surface flipping function in action.
Then the surfaces are applied and the screen is updated to show the diamond pattern.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson31.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson30/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson32/index.php">Next Tutorial</a><br>
</div>

</div>

<div class="footer">


<div class="nav">

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
<br/>
<a class="nav" href="https://discourse.libsdl.org/">SDL Forums</a>
<a class="nav" href="../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../articles/index.php">Articles</a>
<a class="nav" href="../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../index.php">News</a>
<a class="nav" href="../../faq.php">FAQs</a>
<a class="nav" href="../../contact.php">Contact</a>
<a class="nav" href="../../donate.php">Donations</a>
</div>

<h6>Copyright Lazy Foo' Productions 2004-2024</h6>
</div>

</body>
</html>