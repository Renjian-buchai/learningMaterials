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
<meta name="keywords" content="C++ 2D Windows Linux Mac starting pixels">
<meta name="description" content="Find out what little pixels are made out of.">

<link href="../../assets/style.css" rel="stylesheet">
<script src="../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - What is a Pixel?</title>

<script src="../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
	<a href="../../tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../index.php" class="nav-item nav-link">Articles</a>
	<a href="../../tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../index.php" class="nav-item nav-link">News</a>
	<a href="../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../donate.php" class="nav-item nav-link">Donations</a>
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
    <h1 class="text-center">What is a Pixel?</h1>
    
    <p class="text-center"><b>Last Updated: Dec 15th, 2009</b></p>
    
        As you probably know images are made out of pixels, but what are pixels made out of?

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">            //Map the color key
            Uint32 colorkey = SDL_MapRGB( optimizedImage->format, 0, 0xFF, 0xFF );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we have a line of code from the color keying tutorial. I say SDL_MapRGB() returns a pixel but how is a
"Uint32" a pixel?<br/>
<br/>
Uint32 is a:<br/>
<br/>
<b>U</b>nsigned<br/>
<b>int</b>eger that is<br/>
<b>32</b> bits in size.<br/>
<br/>
Now how can a number be a pixel? Well odds are you know some HTML and you know you set your colors by combining
3 numbers from 0 to 255.<br/>
<br/>
<code>&#060span style="color: rgb(Red,Green,Blue)"&#062Text&#060/span&#062</code><br/>
<br/>
Above you see the HTML/CSS code I use here to change the text's color.
Combining Red, Green, and Blue values can get you any color your computer can show you.
For example:<br/>
<br/>
<span style="color: rgb(255,255,255)">This</span> is made with Red 255, Green 255, and Blue 255.<br/>
<span style="color: rgb(255,0,0)">This</span> is made with Red 255, Green 0, and Blue 0.<br/>
<span style="color: rgb(0,0,255)">This</span> is made with Red 0, Green 0, and Blue 255.<br/>
<span style="color: rgb(0,0,0)">This</span> is made with Red 0, Green 0, and Blue 0.<br/>
<span style="color: rgb(192,192,0)">This</span> is made with Red 192, Green 192, and Blue 0.<br/>
<span style="color: rgb(0,255,255)">This</span> is made with Red 0, Green 255, and Blue 255.<br/>
<span style="color: rgb(192,128,64)">This</span> is made with Red 192, Green 128, and Blue 64.<br/>
<span style="color: rgb(186,3,207)">This</span> is made with Red 186, Green 3, and Blue 207.<br/>
<br/>
I'm sure you get the picture.<br/>
<br/>
Well a Uint32 is only one number. If pixels are made by a set of numbers shouldn't it be an array?<br/>
<br/>
Actually, it is.<br/>
<br/>
The red, green, and blue values that make up a pixel can be a number from 0 to 255. Remember 0 is a number too and
in programming we always start counting from 0. That means there's up to 256 values you can have. 256 is 2 to the
8th power so that means each of the values that make up the color can be represented by 8 bit numbers.<br/>
<br/>
A Uint32 is just all those bits stuck together one after the other into one number. In memory your pixel
essentially looks like this:<br/>
<span style="color: rgb(255,0,0)">10101011</span><span style="color: rgb(0,255,0)">00101011</span><span style="color: rgb(0,0,255)">01011011</span><br/>
<br/>
Since it's just an array of 8 bit numbers, all you have to do to get the individual colors is type cast from one
big 32 bit number to an array of 8 bit numbers.<br/>
<br/>
<code><pre>//Get the address of the pixel
Uint8 *colors = (Uint8*)&pixel;

//Get the individual colors
red = colors[ 0 ];
green = colors[ 1 ];
blue = colors[ 2 ];
</pre></code>
But you should generally never do this. To get the individual colors of a pixel you should use SDL_GetRGB(). I'll
tell you why in a little bit.<br/>
<br/>
There's probably something bugging you right now. 8 bits per color * 3 colors = 24 bits. What are the last 8 bits?
Those last 8 bits make up the alpha of the pixel.<br/>
<br/>
Alpha controls the transparency of the pixel. 255 means the pixel is completely opaque and 0 means it's completely
transparent. Here are some examples of an image blitted on a white background. Each time the image has a different
alpha value.<br/>
<br/>
<div class="text-center">Here the alpha is 255 so the image just displays normally.<br/><img class="img-fluid" alt="255" src="255.jpg"></div><br/>
<div class="text-center">Here the alpha is 192. You can see that the white background is starting to show through.<br/><img class="img-fluid" alt="192" src="192.jpg"></div><br/>
<div class="text-center">Here the alpha is 128. This is about 50% transparency.<br/><img class="img-fluid" alt="128" src="128.jpg"></div><br/>
<div class="text-center">Here the alpha is 0 and the image is completely invisible.<br/><img class="img-fluid" alt="0" src="0.jpg"></div><br/>
<br/>
So that's what a 32 bit RGBA pixel is made out of, but not all pixels are built the same.<br/>
<br/>
There are different pixel formats. The colors can be in different order, like BGRA has it's colors in blue, green,
red, alpha. ABGR is pretty much the same thing only the alpha is the first byte. Pixels can also have different
sizes, like a 24 bit BGR bitmap. There's also 16 bit color which can have 5 bits red, 5 bits green, 5 bits blue,
and 1 bit alpha.<br/>
<br/>
There's many more formats out there and I won't go into detail, but having all these pixel formats is why you have to
pass a SDL_PixelFormat to SDL_MapRGB() and SDL_GetRGB() so the functions know how work with pixels. It's also why
it's not a good idea to mess with the bytes directly unless you know for sure which pixel format you're going to get.<br/>
<br/>
The different formats is also why you can't blit two surfaces of a different format together. If you copy ABGR
pixels into a RGBA surface the colors are going to be all wrong. SDL can convert the pixels on the fly, but pixel
conversion eats up CPU. This is why all surfaces are converted to the screen's format when we load them in our
load_image() function.<br/>
<br/>
There's much more to pixels like how pixel conversion works, but that's something you don't bother with unless
you're working at a really low level. For now, you know all the basics about the building blocks of images.<br/>
<br/>
Just as some food for thought, because all RGB pixels are a combination of 3 numbers, isn't it possible to count
through all of them to show every possible color? And if images are combinations of pixels, isn't it possible to
count through every possible combination of pixels and show you every image that could possibly exist?<br/>
<br/>
Trippy, aint it? =)
</div>



                    
                
                    
                        <div class="container border py-3 my-3">




If you have any suggestions to improve this article, It would be great if you <a href="../../contact.php">contacted me</a> so I can improve this article.




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
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
	<a href="../../tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../index.php" class="nav-item nav-link">Articles</a>
	<a href="../../tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../index.php" class="nav-item nav-link">News</a>
	<a href="../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>