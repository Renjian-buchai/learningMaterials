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
<div class="tutPreface"><h1 class="tutHead">Color Keying</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 1/1/14</h6>
Now you're going to learn how to color key. In English that means this lesson is going to teach you how to remove
the background color when applying a surface.<br>
<br>
The SDL_Surface structure has an element called the color key. The color key is the color you don't want to show
up when blitting the surface. It's what you use when you want to have transparent backgrounds.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/10_color_keying/index.php">Color Keying tutorial with SDL 2</a> is now available.
</div>

<div class="tutText">Say you wanted to apply this stick figure named "Foo":<br>
<div class="tutImg"><img src="foo.jpg"></div>
<br>
To this background:<br>
<div class="tutImg"><img src="background.jpg"></div>
<br>
But you didn't want this blue background from the stick figure to pop up:<br>
<div class="tutImg"><img src="nokey.jpg"></div>
<br>
In order for the blue background not to show up you have to set the background's color (which in this case is Red 0, Green FF, Blue FF) to be the surface's color key.<br>
<br>
The color key is typically set when the image is loaded.
</div>

<div class="tutCode">SDL_Surface *load_image( std::string filename ) 
{
    //The image that's loaded
    SDL_Surface* loadedImage = NULL;
    
    //The optimized image that will be used
    SDL_Surface* optimizedImage = NULL;
    
    //Load the image
    loadedImage = IMG_Load( filename.c_str() );
    
    //If the image loaded
    if( loadedImage != NULL )
    {
        //Create an optimized image
        optimizedImage = SDL_DisplayFormat( loadedImage );
        
        //Free the old image
        SDL_FreeSurface( loadedImage );
</div>

<div class="tutText">
So here's the image loading function we're going alter.<br>
<br>
First we load and optimize the image like before.
</div>

<div class="tutCode">        //If the image was optimized just fine
        if( optimizedImage != NULL )
        {
            //Map the color key
            Uint32 colorkey = SDL_MapRGB( optimizedImage->format, 0, 0xFF, 0xFF );
</div>

<div class="tutText">
Then we check if the image was optimized.<br>
<br>
If the image was optimized, we have to map the color we want to set as the color key.
We call SDL_MapRGB() to take the red, green, and blue values and give us the pixel value back in the same format as the surface.
You can learn more about pixels in <a class="tutLink" href="../../articles/article03/index.php">article 3</a>.
</div>

<div class="tutCode">            //Set all pixels of color R 0, G 0xFF, B 0xFF to be transparent
            SDL_SetColorKey( optimizedImage, SDL_SRCCOLORKEY, colorkey );
        }
</div>

<div class="tutText">
Now it's time to do the actual color keying.<br>
<br>
The first argument is the surface we want to set the color key to.<br>
<br>
The second argument holds the flags we want to place.
The SDL_SRCCOLORKEY flag makes sure that we use the color key when blitting this surface onto another surface.<br>
<br>
The third argument is the color we want to set as the color key.
As you see it's the color we mapped just a moment ago.<br>
</div>

<div class="tutCode">    //Return the optimized image
    return optimizedImage;
}
</div>

<div class="tutText">
Then the surface loading function returns the optimized and color keyed surface.
</div>

<div class="tutCode">    //Apply the surfaces to the screen
    apply_surface( 0, 0, background, screen );
    apply_surface( 240, 190, foo, screen );
    
    //Update the screen
    if( SDL_Flip( screen ) == -1 )
    {
        return 1;    
    }
</div>

<div class="tutText">
Now the background is blitted, then the color keyed stick figure image is blitted.<br>
<div class="tutImg"><img src="key.jpg"></div>
Now there's no blue background around the stick figure.<br>
<br>
For those of you using transparent PNGs, IMG_Load() will automatically handle transparency. Trying to color key an
image that already has a transparent background is going to cause funky results. You'll also lose the alpha
transparency if you use SDL_DisplayFormat() instead of SDL_DisplayFormatAlpha(). To retain transparency on the PNG
simply don't color key it. IMG_Load() will also handle alpha from TGA images. Look in the SDL documentation for
more detailed information on color keying.<br>
<br>
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson05.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson04/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson06/index.php">Next Tutorial</a><br>
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