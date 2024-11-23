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
<meta name="keywords" content="C++ 2D Windows Linux Mac OpenGL Vulkan math primer">
<meta name="description" content="A quick intro for vector and matrix math.">

<link href="../../assets/style.css" rel="stylesheet">
<script src="../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - OpenGL Math Primer</title>

<script src="../../assets/light-dark-loader.js"></script>


        <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      MathML: {
        extensions: ["content-mathml.js"]
      }
    });
    </script>
    
    <script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML"></script>

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
    <h1 class="text-center">OpenGL Math Primer</h1>
    
    <p class="text-center"><b>Last Updated: Jul 29th, 2020</b></p>
    
        OpenGL and 3D graphics in general is all based on vector and matrix math. Many institutions don't cover matrix math until after 3 levels of calculus which can be a huge
obstacle for beginning graphics programmers. This is especially bad consdering much of the linear algebra you need to get a basic understanding of matrix transformations
can be easily taught if you've taken high school level geometry.<br/>
<br/>
While this article won't cover all the math you need to become a proficient graphics programmer, it will give you flyover of linear algebra concepts so you have a
basic understanding of what geometry based rendering APIs do.<br/>
<br/>
Once you have a strong enough background in matrix math, go ahead and jump into the <a href="../../tutorials/OpenGL/index.php">OpenGL</a> tutorial set.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <h2>Vectors</h2>
Mathematical vectors (not to be confused with STL vectors) are a way to represent a value that has multiple components which can be used to represent something with a
magnitude and a direction. The best way to understand what this means is by looking at an example.<br/>
<br/>
<div class="text-center"><img class="img-fluid" alt="coordinate point" src="coordinate_point.png"></div>
Here we have a point x = 2, y = 3. How do would you represent this as a vector? Like this:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div>
<br/>
That's it really. A vector is really just a way to represent a value that has multiple components such as in this case where the position has an x and y component.<br/>
<h2>Polygons</h2>
Now how is this useful? See, in OpenGL (and most other 3D graphics APIs) pretty much everything this is rendered as a set of polygons. This begs the question
"How do you represent a polygon in a computer?". Let's take this triangle:<br/>
<div class="text-center"><img class="img-fluid" alt="triangle" src="triangle.png"></div><br/>
It can be represented as an array of points:
<div class="text-center"><img class="img-fluid" alt="triangle points" src="triangle_points.png"></div><br/>
Which can be represented as an array of vectors:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
Which can be used by OpenGL to create a polygon to render. This is important because in 3D graphics polygons are used to represent 3D objects:
<div class="text-center"><img class="img-fluid" alt="wireframe" src="wireframe.png"></div><br/>
A 3D model for a simple uncolored cube can just be a big array of numbers.<br/>
<br/>
<code><pre>const float cubeModel =
{
//Front
-1.f, -1.f,  1.f,
1.f, -1.f,  1.f,
1.f,  1.f,  1.f,
-1.f,  1.f,  1.f,

//Back
-1.f, -1.f, -1.f,
1.f, -1.f, -1.f,
1.f,  1.f, -1.f,
-1.f,  1.f, -1.f,

//Top
-1.f,  1.f,  1.f,
1.f,  1.f,  1.f,
1.f,  1.f, -1.f,
-1.f,  1.f, -1.f,

//Bottom
-1.f, -1.f,  1.f,
1.f, -1.f,  1.f,
1.f, -1.f, -1.f,
-1.f, -1.f, -1.f,

//Left
-1.f, -1.f, -1.f,
-1.f,  1.f, -1.f,
-1.f,  1.f,  1.f,
-1.f, -1.f,  1.f,

//Right
1.f, -1.f, -1.f,
1.f,  1.f, -1.f,
1.f,  1.f,  1.f,
1.f, -1.f,  1.f
};
</pre></code>
<br/>
The code you see above has been used to render a cube for a simple demo. Each triplet of numbers represents a vector point and every set of 4 vectors represents the 4 
corners of a side of a cube.<br/>
<br/>
<h2>3D Vectors</h2>
While you know what x/y coordinates in 2D space are, you may be wondering how 3D space works. In the code for the cube model above, the third number of every position
triplet is the z position. Where the X position goes left/right and the y position goes up/down, the z position goes forward/back.<br/>
<br/>
Another important thing to note is which way is positive for the x, y, and z directions. For x, right is positive and left is negative. Up is positive and down is
negative for the y axis. Finally for the z axis if you were staring at point
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>,
towards you is postive z and away from you is negative z. This is the most commonly used convention called the
<a href="http://en.wikipedia.org/wiki/Right-hand_rule">Right Hand Rule</a>.<br/>
<br/>
<h2>Vector Arithmetic</h2>
3D graphics is all about taking vectors from models and performing mathmatical operations on them to get them to render to the screen. It is possible add/subtract
vectors. All you have to do is add/subtract them component by component. For example:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
+
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>7</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>12</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>9</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math></div><br/>
<br/>
All we did here was take the first component from the first vector (5), then take the first component from the second vector (7), and add them together to get the
first component from the result vector (5 + 7 = 12). For the second component we take the second component from the first vector (8), then take the second
component from the second vector (1), and add them together to get the second component from the result vector (8 + 1 = 9). Finally for the third component, we take
the third component from the first vector (3), then take the third component from the second vector (2), and add them together to get the third component from the
result vector (3 + 2 = 5).<br/>
<br/>
For vector subtraction, all we do is component by component subtraction:
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
-
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>7</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>-2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>7</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math><br/>
<br/>
Multiplication is a bit more tricky as there's more than one way to do it. The first way is called scalar multiplication where you multiply the entire vector by a
single value. Say we wanted to double the length of a vector (or <b>scale</b> it to double the length), you would multiply the vector by two:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mi>2</mi>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>2 * 5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2 * 8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2 * 3</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>10</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>16</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>6</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
As you can see all we did was multiply each component in the vector by the scalar value.<br/>
<br/>
We can also multiply two vectors together in multiple ways. The first way is by the dot product where you multiply the two vectors together component by component
and then add the components together:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
.
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>7</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
= 5*7 + 8*1 + 3*2 = 35 + 8 + 6 = 49
</div><br/>
They also call the dot product the scalar product because it returns a single component value AKA a scalar. This calculation is useful in lighting calculations,
collision detection, and other game programming problems.<br/>
<br/>
Another way to multiply two vectors is the cross product. Assuming the first vector is A and the second vector is B then the cross product is:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>Ay*Bz - Az*By</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>Az*Bx - Ax*Bz</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>Ax*By - Ay*Bx</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math></div><br/>
Here's a super simple example:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
x
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>0*0 - 0*1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0*0 - 1*0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1*1 - 0*0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
The cross product gives you a vector perpendicular to both the vectors you multiplied. It's also important to note that AxB is not equal to BxA. BxA gives a vector
in the opposite direction of AxB.<br/>
<br/>
I wish we could spend more time covering how the dot and cross product are used, but this is just a quick fly over of the concepts. What we really want to get to is
matrix vector multiplication.<br/>
<br/>
<h2>Matrix/Vector Multiplication</h2>
At the center of graphics programming is the graphics pipeline. A pipeline is a machanism designed to process a stream of data and OpenGL pipelines are based
around multiplying a stream of vectors (like the vector positions in a 3D model) against a matrix or set of matrices.<br/>
<br/>
Here's a 4 row by 4 column matrix:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd><mtd><mi>5</mi></mtd><mtd><mi>8</mi></mtd><mtd><mi>4</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2</mi></mtd><mtd><mi>6</mi></mtd><mtd><mi>7</mi></mtd><mtd><mi>3</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd><mtd><mi>7</mi></mtd><mtd><mi>6</mi></mtd><mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>4</mi></mtd><mtd><mi>8</mi></mtd><mtd><mi>5</mi></mtd><mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
Now say we wanted to multiply this matrix against this vector:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd><mtd><mi>5</mi></mtd><mtd><mi>8</mi></mtd><mtd><mi>4</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2</mi></mtd><mtd><mi>6</mi></mtd><mtd><mi>7</mi></mtd><mtd><mi>3</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd><mtd><mi>7</mi></mtd><mtd><mi>6</mi></mtd><mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>4</mi></mtd><mtd><mi>8</mi></mtd><mtd><mi>5</mi></mtd><mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
x
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>4</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
What we would do is split up the matrix into 4 vectors:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>4</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>6</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>7</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>8</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>7</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>6</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>4</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
Take each of the components from the vector and scalar multiply them against the split matrix:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mi>2</mi>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>4</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mi>3</mi>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>6</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>7</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>8</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mi>4</mi>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>7</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>6</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mi>5</mi>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>4</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math><br/>
=<br/>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>4</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>6</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>8</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>15</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>18</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>21</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>24</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>32</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>28</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>24</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>20</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>20</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>15</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>10</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
And then add them across to get the result vector:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>2 + 15 + 32 + 20</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>4 + 18 + 28 + 15</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>6 + 21 + 24 + 10</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>8 + 24 + 20 + 5</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>69</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>65</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>61</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>57</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
<br/>

<h2>Transformation Matrices</h2>
Now how is this all useful? Recall that 3D models can be represented as an array of vectors. Using a matrix you can multiply the vectors to transform the 3D model.
Say we have these 4 vectors used to represent a square:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>-1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>-1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>-1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>-1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>

Say we then multiply these vectors against this matrix:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>2</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>2</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>2</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math><br/>
<br/>
</div><br/>
This means we get
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>2</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>2</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>2</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>-1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>-2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math><br/>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>2</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>2</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>2</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math><br/>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>2</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>2</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>2</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>-1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>-2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math><br/>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>2</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>2</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>2</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>-1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>-1</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>-2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>-2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
As you probably noticed, multiplying the vectors of the square against this matrix scaled it to double the size. This is why this matrix is known as the Scaling Matrix.
If you look in the OpenGL documentation, you'll find out that the function <a "href="http://www.opengl.org/sdk/docs/man2/xhtml/glScale.xml">glScale()</a>
uses a 4 row, 4 column version of this matrix.<br/>
<br/>
And this is the key point of this article: OpenGL uses matrices to transform the vectors of 3D objects to render them to the screen. Now let's look at another matrix:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>1</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math><br/>
<br/>
</div><br/>
Watch what happens when we multiply this variable vector against it:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>1</mi></mtd><mtd><mi>0</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>x</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>y</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>z</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>x</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>y</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>z</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
Whatever you multiply against this matrix, you get right back. When you have a square matrix with all zeros except for 1 going against the diagonal, this is called the
Identity Matrix. It's used in graphics programming whenever you want to reset the transformation matrix.<br/>
<br/>
Say if you wanted to shift a vector 5 to the right, 2 up, and 3 forward. There's a matrix for that:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>1</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>1</mi></mtd><mtd><mi>-3</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math><br/>
<br/>
</div><br/>
Multiplying this through we get:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>1</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>1</mi></mtd><mtd><mi>-3</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>0</mi></mtd><mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>x</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>y</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>z</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>x + 5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>y + 2</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>z - 3</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
This matrix that shifts vectors in a linear direction is called the Translation Matrix. Sure enough it's what OpenGL uses in the
<a "href="http://www.opengl.org/sdk/docs/man2/xhtml/glTranslate.xml">glTranslate()</a> function. You may be wondering where that 4th value in the vector
came from. Sometimes it's called the w values, sometimes it's called the s value. Just know that it's usually set to 1 and that it's useful in cases like multiplying
against the transformation matrix.<br/>
<br/>
There are other useful matrices like the rotation matrix. You can look up how those function in the OpenGL 2.1 documentation.<br/>
<br/>

<h2>Matrix/Matrix Multiplication</h2>
Another important matrix math operation is multiplying two matrices together. Say we want to multiply these two matrices together:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd><mtd><mi>2</mi></mtd><mtd><mi>3</mi></mtd><mtd><mi>4</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>5</mi></mtd><mtd><mi>6</mi></mtd><mtd><mi>7</mi></mtd><mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>9</mi></mtd><mtd><mi>10</mi></mtd><mtd><mi>11</mi></mtd><mtd><mi>12</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>13</mi></mtd><mtd><mi>14</mi></mtd><mtd><mi>15</mi></mtd><mtd><mi>16</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>16</mi></mtd><mtd><mi>15</mi></mtd><mtd><mi>14</mi></mtd><mtd><mi>13</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>12</mi></mtd><mtd><mi>11</mi></mtd><mtd><mi>10</mi></mtd><mtd><mi>9</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>8</mi></mtd><mtd><mi>7</mi></mtd><mtd><mi>6</mi></mtd><mtd><mi>5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>4</mi></mtd><mtd><mi>3</mi></mtd><mtd><mi>2</mi></mtd><mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
To multiply them take the matrix on the right and split it into vectors:
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>16</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>12</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>4</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>15</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>11</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>7</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>14</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>10</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>6</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>13</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>9</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
And then take each of these column vectors and multiply them against the matrix on the left
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd><mtd><mi>2</mi></mtd><mtd><mi>3</mi></mtd><mtd><mi>4</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>5</mi></mtd><mtd><mi>6</mi></mtd><mtd><mi>7</mi></mtd><mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>9</mi></mtd><mtd><mi>10</mi></mtd><mtd><mi>11</mi></mtd><mtd><mi>12</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>13</mi></mtd><mtd><mi>14</mi></mtd><mtd><mi>15</mi></mtd><mtd><mi>16</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>16</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>12</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>4</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>80</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>240</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>400</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>560</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math><br/>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd><mtd><mi>2</mi></mtd><mtd><mi>3</mi></mtd><mtd><mi>4</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>5</mi></mtd><mtd><mi>6</mi></mtd><mtd><mi>7</mi></mtd><mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>9</mi></mtd><mtd><mi>10</mi></mtd><mtd><mi>11</mi></mtd><mtd><mi>12</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>13</mi></mtd><mtd><mi>14</mi></mtd><mtd><mi>15</mi></mtd><mtd><mi>16</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>15</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>11</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>7</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>3</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>70</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>214</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>358</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>502</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math><br/>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd><mtd><mi>2</mi></mtd><mtd><mi>3</mi></mtd><mtd><mi>4</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>5</mi></mtd><mtd><mi>6</mi></mtd><mtd><mi>7</mi></mtd><mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>9</mi></mtd><mtd><mi>10</mi></mtd><mtd><mi>11</mi></mtd><mtd><mi>12</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>13</mi></mtd><mtd><mi>14</mi></mtd><mtd><mi>15</mi></mtd><mtd><mi>16</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>14</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>10</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>6</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>2</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>60</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>188</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>316</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>444</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math><br/>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd><mtd><mi>2</mi></mtd><mtd><mi>3</mi></mtd><mtd><mi>4</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>5</mi></mtd><mtd><mi>6</mi></mtd><mtd><mi>7</mi></mtd><mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>9</mi></mtd><mtd><mi>10</mi></mtd><mtd><mi>11</mi></mtd><mtd><mi>12</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>13</mi></mtd><mtd><mi>14</mi></mtd><mtd><mi>15</mi></mtd><mtd><mi>16</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>13</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>9</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>50</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>162</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>274</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>386</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math><br/>
</div><br/>
Finally, put all the vectors back together and you'll get the resulting matrix.
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>80</mi></mtd><mtd><mi>70</mi></mtd><mtd><mi>60</mi></mtd><mtd><mi>50</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>240</mi></mtd><mtd><mi>214</mi></mtd><mtd><mi>188</mi></mtd><mtd><mi>162</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>400</mi></mtd><mtd><mi>358</mi></mtd><mtd><mi>316</mi></mtd><mtd><mi>274</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>560</mi></mtd><mtd><mi>502</mi></mtd><mtd><mi>444</mi></mtd><mtd><mi>386</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
An important thing to note is that matrix multiplication is not communitive. In algebra, x * y = y * x, but in matrix multiplication that isn't true. Watch what happens
when we switch the order of the matrices.
<div class="text-center">
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>16</mi></mtd><mtd><mi>15</mi></mtd><mtd><mi>14</mi></mtd><mtd><mi>13</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>12</mi></mtd><mtd><mi>11</mi></mtd><mtd><mi>10</mi></mtd><mtd><mi>9</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>8</mi></mtd><mtd><mi>7</mi></mtd><mtd><mi>6</mi></mtd><mtd><mi>5</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>4</mi></mtd><mtd><mi>3</mi></mtd><mtd><mi>2</mi></mtd><mtd><mi>1</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>1</mi></mtd><mtd><mi>2</mi></mtd><mtd><mi>3</mi></mtd><mtd><mi>4</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>5</mi></mtd><mtd><mi>6</mi></mtd><mtd><mi>7</mi></mtd><mtd><mi>8</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>9</mi></mtd><mtd><mi>10</mi></mtd><mtd><mi>11</mi></mtd><mtd><mi>12</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>13</mi></mtd><mtd><mi>14</mi></mtd><mtd><mi>15</mi></mtd><mtd><mi>16</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
=
<math xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
        <mfenced open="[" close="]">
            <mrow>
                <mtable>
                    <mtr>
                    <mtd><mi>386</mi></mtd><mtd><mi>444</mi></mtd><mtd><mi>502</mi></mtd><mtd><mi>560</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>274</mi></mtd><mtd><mi>316</mi></mtd><mtd><mi>358</mi></mtd><mtd><mi>400</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>162</mi></mtd><mtd><mi>188</mi></mtd><mtd><mi>214</mi></mtd><mtd><mi>240</mi></mtd>
                    </mtr>
                    <mtr>
                    <mtd><mi>50</mi></mtd><mtd><mi>60</mi></mtd><mtd><mi>70</mi></mtd><mtd><mi>80</mi></mtd>
                    </mtr>
                </mtable>
            </mrow>
        </mfenced>
    </mrow>
</math>
</div><br/>
When multiplying matrices, order matters. This is why left multiplying and right multiplying get you different results.<br/>
<br/>
Multiplying two matrices together can be used combine tranformation effects. Say you wanted to take an object and translate 200 pixels right/down and then rotate it
around it's center. You would create the matrix for this by taking a translation matrix and right multiplying the rotation matrix to get this result:
<div class="text-center">
<img class="img-fluid" alt="translate rotate" src="translate_rotate.png">
</div><br/>
However if you were to take a rotation matrix first and then right multiply the translation matrix, you'd get a different result. Since you rotated first, when you
multiply the translation matrix its coordinate will be rotated:
<div class="text-center">
<img class="img-fluid" alt="rotate translate" src="rotate_translate.png">
</div><br/>

In OpenGL 2.1 there are built in matrix operations like glTranslate(), glRotate(), etc. The operations right multiply your current matrix, so make sure you watch the
order you do your multiplication or you'll get undesired results.<br/>
<br/>

<h2>3D Objects to 2D Images</h2>
You may be wondering how we take these vectors of a model and turn them into 2D images we can see on the screen. Say we have this cube
<div class="text-center"><img class="img-fluid" alt="t cube" src="transformed_cube.png"></div>
<br/>
Remember back to high school art class and those perspective scenes they made you do?
<div class="text-center"><img class="img-fluid" alt="perspective" src="perspective.png"></div>
<br/>
What OpenGL does is take a projection matrix and multiply the vector points from your polygon  to transform them into perspective coordinates that
OpenGL can use. Here we're taking the top part of the cube and transforming the square into perspective:
<div class="text-center"><img class="img-fluid" alt="dot" src="dots.png"></div>
<br/>
Then OpenGL connects your polygon vectors
<div class="text-center"><img class="img-fluid" alt="connect the dots" src="connect_the_dots.png"></div>
<br/>
And starts filling in the pixels (this is called rasterization)
<div class="text-center"><img class="img-fluid" alt="fill" src="fill04.png"><img class="img-fluid" alt="fill" src="fill05.png"><img class="img-fluid" alt="fill" src="fill06.png"></div>
<br/>
Obviously, there's more to the OpenGL pipeline with things to control texturing, coloring, lighting, etc. In terms of how we get from geometry to pixels, all OpenGL
does is take vector coorindates and multiplies them against a perspective matrix.<br/>
<br/>

<h2>Conclusion</h2>
There is a lot more to the math it takes to understand 3D graphics. There's even more math required to make 3D games. Hopefully at least now those of you stuck taking
Algebra II can get started using OpenGL and not be totally confused when we talk about vectors and matrices.<br/>
<br/>
If you managed to understand this article, I recommend picking up a book on Linear Algebra to make sure you have a strong foundation in matrix math. You'll need it
if you plan to be a graphics programmer.

</div>
                    
                
                    
                        <div class="container border py-3 my-3">




I encourage peer review of this article. If you have any suggestions, corrections or criticisms feel free to
contact me.<br/>



<a href="../index.php#OpenGL Math Primer">Back to Index</a>


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