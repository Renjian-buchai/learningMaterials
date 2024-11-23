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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Vertex Buffer Objects VBO Index Buffer Objects IBO">
<meta name="description" content="Learn to render a polygon using modern OpenGL vertex buffer objects.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Vertex Buffer Objects</title>

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
    <h1 class="text-center">Vertex Buffer Objects</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Vertex Buffer Objects screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        Vertex arrays are more efficient than sending vertices one by one. What's even more efficient is sending your vertex data into a vertex buffer object, which is what is
used by modern OpenGL implementations. With vertex buffer objects you can send your vertex data once (as opposed to every time you have a new set of data to draw) and
just have it stored on the GPU when you need to use it.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//Quad vertices
LVertexPos2D gQuadVertices[ 4 ];

//Vertex Indices
GLuint gIndices[ 4 ];

//Vertex buffer
GLuint gVertexBuffer = 0;

//Index buffer
GLuint gIndexBuffer = 0;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp, we define our quad vertices like before. This time we also have index data to define.<br/>
<br/>
In the Vertex Arrays tutorial, we called glDrawArrays() to draw our vertex data. glDrawArrays() just took our vertex data and drew each vertex in order. In this tutorial we're
going to use a drawing function that can draw vertex data in any order. It can even render the same vertex twice. In order to use this function, we need a set of indices to
specify how to draw the vertex data. This is what the array "gIndices" is for.<br/>
<br/>
Now that we have our vertex data and our index data, we need to store them onto the GPU. Once we have them on the GPU, we need to be able to indentify them. Much like how textures
have GLuint IDs, vertex buffer objects have GLuint IDs. As you can see, "gVertexBuffer" is our vertex buffer ID and "gIndexBuffer" index buffer ID.
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

    //Set rendering indices
    gIndices[ 0 ] = 0;
    gIndices[ 1 ] = 1;
    gIndices[ 2 ] = 2;
    gIndices[ 3 ] = 3;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In loadMedia(), we define our vertex data much like we did with vertex array. After that we set our rendering indices. What our rendering function glDrawElements() will do is take
in the array of indices, look at the first element in the index array (which is gIndices[ 0 ]) look at it's value (which is 0) and draw the vertex at index 0. Then it will second
element in the index array (which is gIndices[ 1 ]) look at it's value (which is 1) and draw the vertex at index 1. I'm sure you can see the way we set up our indices, we're telling
glDrawElements() vertices 0 - 3 in order.<br/>
<br/>
Why are we doing this? Imagine we were drawing a cube. It has 6 faces with 4 vertices each which results in 24 vertices. But a cube only has 8 corners. To optimize it, we only give
the vertex positions for the corners, and use indices to draw the corners as we need them.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Create VBO
    glGenBuffers( 1, &gVertexBuffer );
    glBindBuffer( GL_ARRAY_BUFFER, gVertexBuffer );
    glBufferData( GL_ARRAY_BUFFER, 4 * sizeof(LVertexPos2D), gQuadVertices, GL_STATIC_DRAW );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now that we have the vertex and index data defined, we need to send them to the GPU inside of a buffer. First we generate a buffer name using glGenBuffers(), then we bind the
buffer using glBindBuffer(). We want to specify that we're binding an array of vertex data with "GL_ARRAY_BUFFER".<br/>
<br/>
After binding our vertex buffer object (or VBO) we want to send our vertex data for our VBO. We do this with glBufferData(). This first argument is what type of buffer data we're sending.
The second argument is the size of our buffer data in bytes. Since we're sending 4 LVertexPos2Ds, the size is 4 times the size of a LVertexPos2D. The third argument is the address
of our vertex data. The last argument is how the data is expected to be handled so the driver can act accordingly. Since we're sending the data once and draw with it multiple times,
we set it to "GL_STATIC_DRAW".<br/>
<br/>
Now that our vertex data is in a buffer on the GPU, let's do the same with the index data.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Create IBO
    glGenBuffers( 1, &gIndexBuffer );
    glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, gIndexBuffer );
    glBufferData( GL_ELEMENT_ARRAY_BUFFER, 4 * sizeof(GLuint), gIndices, GL_STATIC_DRAW );

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As you can see, creating an index buffer object (or IBO) works pretty much the same as creating a VBO. However, since we're dealing with index data instead of vertex data, we
want to specify this using "GL_ELEMENT_ARRAY_BUFFER".
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Enable vertex arrays
    glEnableClientState( GL_VERTEX_ARRAY );

        //Set vertex data
        glBindBuffer( GL_ARRAY_BUFFER, gVertexBuffer );
        glVertexPointer( 2, GL_FLOAT, 0, NULL );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of our rendering function, we clear the screen and enable vertex arrays like before. This time we're going to use the vertex data from our VBO, so we bind the VBO using
glBindBuffer(). Now when we call glVertexPointer() to set our vertex data, it will get it from the memory of our VBO. Since we want it to get the vertex data from the start of the
VBO, we give it an address of NULL (which is equal to 0).
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">        //Draw quad using vertex data and index data
        glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, gIndexBuffer );
        glDrawElements( GL_QUADS, 4, GL_UNSIGNED_INT, NULL );

    //Disable vertex arrays
    glDisableClientState( GL_VERTEX_ARRAY );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After setting our current vertex data, we want to set our current index data with glBindBuffer(). Again, since in index data and not vertex data, we specify "GL_ELEMENT_ARRAY_BUFFER"
for our buffer.<br/>
<br/>
After our VBO and IBO are bound, we draw with them using glDrawElements(). The first argument is what kind of geometry you want to draw. The second is how many elements you want to
draw, and because we have it 4 indices in our IBO we want to draw 4. The third argument is the data type for our indices, and the last the address of our index data. Remember that
because we have an IBO currently bound, the address we give glDrawElements() will be from IBO memory. Like with our VBO, we want glDrawElements() to read it from the beginning so we
give it an address of NULL.<br/>
<br/>
Alternatively, you could not bind an IBO and just give glDrawElements() the pointer to our index data. This has the same pitfalls as using straight vertex arrays where you have
to send the index data to the GPU every time you have a new set of indices. That and straight vertex arrays are deprecated in OpenGL 3.0+.<br/>
<br/>
After we're done drawing our VBO, we disable vertex arrays and update the screen.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="17_vertex_buffer_objects.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Vertex Buffer Objects">Back to Index</a>


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