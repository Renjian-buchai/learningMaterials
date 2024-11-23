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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Vertex Arrays">
<meta name="description" content="Learn to render OpenGL polygons using Vertex Arrays.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Vertex Arrays</title>

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
    <h1 class="text-center">Vertex Arrays</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Vertex Arrays screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Nov 22nd, 2012</b></p>
    
        When ever you make an OpenGL call, it gets put on the OpenGL command buffer. When you're dealing with models that have tons of polygons, it's wasteful to have a
call to glVertex() for each individual vertex. This is one of the reasons the function glVertex() was deprecated in OpenGL 3. Vertex arrays allow us to send vertex
data in sets instead of individually.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LVertexPos2D.h</div>


<pre class="border my-0 py-3">#ifndef LVERTEX_POS_2D_H
#define LVERTEX_POS_2D_H

#include "LOpenGL.h"

struct LVertexPos2D
{
    GLfloat x;
    GLfloat y;
};

#endif
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">We have a new file for our project for a new data type. LVertexPos2D defines a 2D vertex position. Having this data type will make it easier for us to define geometry.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">#include "LUtil.h"
#include &#060IL/il.h&#062
#include &#060IL/ilu.h&#062
#include "LVertexPos2D.h"

//Quad vertices
LVertexPos2D gQuadVertices[ 4 ];
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp, we declare the 4 vertex positions for our quad.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //Set quad verticies
    gQuadVertices[ 0 ].x = SCREEN_WIDTH * 1.f / 4.f;
    gQuadVertices[ 0 ].y = SCREEN_HEIGHT * 1.f / 4.f;

    gQuadVertices[ 1 ].x = SCREEN_WIDTH * 3.f / 4.f;
    gQuadVertices[ 1 ].y = SCREEN_HEIGHT * 1.f / 4.f;

    gQuadVertices[ 2 ].x = SCREEN_WIDTH * 3.f / 4.f;
    gQuadVertices[ 2 ].y = SCREEN_HEIGHT * 3.f / 4.f;

    gQuadVertices[ 3 ].x = SCREEN_WIDTH * 1.f / 4.f;
    gQuadVertices[ 3 ].y = SCREEN_HEIGHT * 3.f / 4.f;

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In loadMedia() we don't actually load any files, but we do define the vertices for our quad.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Enable vertex arrays
    glEnableClientState( GL_VERTEX_ARRAY );

        //Set vertex data
        glVertexPointer( 2, GL_FLOAT, 0, gQuadVertices );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of render(), we clear our screen as usual. Then we call glEnableClientState() to enable vertex arrays so we can start sending our vertex data.<br/>
<br/>
Then we call glVertexPointer() to define our vertex data. The first argument is how many coordinates per vertex there are, which is two in this case since we're doing 2D. The
second argument is the data type for each coordinate, which in this case we're using GLfloat. The third argument is stride, which the byte offset between vertices. We'll use this
in future tutorials, but for now we're setting it to zero.<br/>
<br/>
The last argument is the pointer to our array of floats. You may be thinking "We're giving it a pointer to an array of LVertexPos2D, not floats". Actually, if we want to we can
treat a LVertexPos2D like an array of floats.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">Sample code</div>


<pre class="border my-0 py-3">LVertexPos2D position;
GLfloat* components = (GLfloat*)&position;
components[ 0 ];//First member of the struct (x)
components[ 1 ];//Second member of the struct (y)
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">A struct is just a list of different variables which can be of different types. LVertexPos2D is a list of 2 GLfloats, so we can treat as an array of 2 GLfloats. Since we have
an array of 4 LVertexPos2D, we can treat the data like an array of 8 GLfloats.<br/>
<br/>
<b>There are exceptions</b> to treating a struct of floats like an array of floats. Some processor architectures can load arrays of structs faster if they are a certain size. 
Compilers for these architectures will then pad each element in the array to be a certain size. This means in between each structure of floats there will be a few stray bytes. In 
this case, you need to set the stride to be the sizeof(LVertexPos2D). So far, every compiler/processor combination I've used doesn't pad arrays of structs. In case your vertex
data seems garbeled try to see if your compiler pads the elements in your array.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">        //Draw quad using vertex data
        glDrawArrays( GL_QUADS, 0, 4 );

    //Disable vertex arrays
    glDisableClientState( GL_VERTEX_ARRAY );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now that the GPU has the address of our vertex data, we call glDrawArrays() to tell it to draw with the vertex data we sent it. The first argument is what type of geometry we want
to draw with the vertex data. The second argument is the index in the array of vertices you want to start drawing with, in this case it's 0 since we want to start drawing from the
beginning of the vertex data. The last argument is how many vertices you want to draw which in this case is obviously 4 since we want to draw a single quad. After we're done
drawing with our vertex data, we disable the sending of vertex data with glDisableClientState() after we're done rendering.<br/>
<br/>
Now the only thing that's changed here is how the vertex data is sent. The vertices themselves still functions the same way. Try making calls to glRotate() or some other
tranformation before drawing your vertex array and it will function the same as if you sent each vertex one by one using glVertex().
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="16_vertex_arrays.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Vertex Arrays">Back to Index</a>


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