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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D">
<meta name="description" content="What we will be covering in this OpenGL Tutorial.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - The Introduction to Introduction to OpenGL</title>

<script src="../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
	<a href="../../SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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
    <h1 class="text-center">The Introduction to Introduction to OpenGL</h1>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        Welcome to Introduction to OpenGL, a tutorial set designed to getting newbie programmers started with OpenGL.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    
<h2>What we'll be covering</h2>
In OpenGL, pretty much all rendering is done by rendering polygons. In this tutorial, we'll  be
<ul>
<li>Rendering polygons in 2D.</li>
<li>Texturing the polygons to render bitmaps.</li>
<li>Applying transformations like scaling and rotation to the polygons.</li>
<li>Rendering fonts using textured polygons.</li>
<li>Using OpenGL buffers to render.</li>
<li>Using programmable shader programs to render.</li>
<li>Transitioning from the old fixed function pipeline rendering to the modern OpenGL programmable pipeline.</li>
</ul>

<h2>What we won't be covering</h2>
This tutorial set was designed to get OpenGL programmers with 2D concepts. We will not be covering 3D rendering. To make a decent 3D tutorial set, I would have to make the tutorial
set roughly 3 times as big which is something I just don't currently have time for.<br/>
<br/>
Whether rendering in 2D or 3D, OpenGL still renders with polygons. To move over to 3D rendering, just using a perspective matrix as opposed to an orthographic matrix. If you didn't
understand that last sentence, you'll find out later in the tutorial set it isn't that hard to do.<br/>
<br/>

<h2>What is fixed function pipeline?</h2>
A pipeline is just a set of functionality to process data. For the first part of this tutorial, we use fixed function pipeline calls. Back in the early days of OpenGL, the API
had calls built in to handle things like matrix transformations and lighting. It made it easy to start rendering things, but you were limited to the built in functionality
(hence "Fixed Function Pipeline").<br/>
<br/>
Then programmable pipelines came along which allowed programmers to make their own GPU pipelines.  Eventually, fixed function pipelines became obsolete because programmable
pipelines could do everything they could and far more. Hardware today actually almost always uses programmable pipelines, even to do fixed function stuff.<br/>
<br/>
<h2>Why are you using fixed function if it's so outdated?</h2>
In the initial versions of the tutorials, I was going to use programmable pipelines from the beginning. Then I started testing the tutorials on people new to graphics programming.
This is where I found out if you want to create a sea of blank stares, talk about vertex shaders and fragment shaders to people who have never rendered a polygon.<br/>
<br/>
I then thought of making a wrapper framework to abstract the low level programmable pipeline calls. At that point I realized that if I used my own framework, I'm still teaching new
programmers non-standard code that they are probably never going to use. As far as I saw, if I wanted to make the tutorials accessible to new OpenGL programmers I might as well just
 use the old easier to use fixed function calls and then transition them to modern programmable pipelines.<br/>
<br/>
Just compare <a href="../02_matrices_and_coloring_polygons/index.php">tutorial 2</a> and <a href="../33_multi-color_polygons_and_attributes/index.php">tutorial 33</a>,
both of which do the simple task of rendering a multicolored quad. Contrast the amount of things that could go wrong in either one of them. I would rather allow the new programmer
to get their hands dirty with simpler code than be overwhelmed with complex code which they can't mess with for fear that they'll break something.<br/>
<br/>
Besides, as much as OpenGL programmers bemoan the existence of legacy OpenGL, it's going to be sticking around for a while. There's lots of old systems that still use it, and as
recently as 2011 I worked with systems that only had OpenGL 1.3. Their knowledge of old OpenGL may prove useful at some point. Considering during the protyping stage for these
tutorials I had users with GPUs that didn't support OpenGL 2.0, legacy OpenGL is still alive and kicking.<br/>
<br/>
As I see it, by the end of the tutorial set they're using OpenGL 3.0+ code anyway so they are learning what they should be learning. When they see the power that modern OpenGL
offers and they learn how to use it, I doubt new programmers will ever want to go back to the old ways.

</div>
                    
                
                    
                        <div class="container border py-3 my-3">




<a href="../01_hello_opengl/index.php">Now let's get started with OpenGL</a>.




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
	<a href="../../SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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