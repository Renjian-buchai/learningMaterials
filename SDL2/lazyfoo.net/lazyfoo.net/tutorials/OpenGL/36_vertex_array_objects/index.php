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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac Vertex Array Objects VAO">
<meta name="description" content="Learn to use Vertex Array Objects in this VAO Tutorial.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Vertex Array Objects</title>

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
    <h1 class="text-center">Vertex Array Objects</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Vertex Array Objects screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Oct 19th, 2014</b></p>
    
        So far we've only been setting vertex position pointers, texture coordinate pointers, and color pointers. In a full 3D OpenGL application, you could be setting vertex,
normal, color, texture, ambient material, diffuse material, multitexture, etc pointers. Having to set the individual data pointers every single time we draw can be
tedious and wasteful. Using vertex array objects, you set your vertex array attributes once and bind your VAO when you need it.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From main.cpp</div>


<pre class="border my-0 py-3">    //Create OpenGL 3.0 context
    glutInitContextVersion( 3, 0 );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">VAOs were promoted to the OpenGL core in version 3.0. If your GPU supports the ARB_vertex_array_object extension, you can still use it as an extension.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LDoubleMultiColorPolygonProgram2D.glvs</div>


<pre class="border my-0 py-3">#version 130

//Transformation Matrices
uniform mat4 LProjectionMatrix;
uniform mat4 LModelViewMatrix;

//Vertex position attribute
in vec2 LVertexPos2D;

//Multicolor attribute
in vec4 LMultiColor1;
in vec4 LMultiColor2;
out vec4 multiColor;

void main()
{
    //Process color
    multiColor = LMultiColor1 * LMultiColor2;
    
    //Process vertex
    gl_Position = LProjectionMatrix * LModelViewMatrix * vec4( LVertexPos2D.x, LVertexPos2D.y, 0.0, 1.0 );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">We're creating a new shader program to test out VAOs. The double multicolor polygon program takes in a vertex position attribute and two color attributes per vertex. It takes the
two color attributes and component multiplies them to get the final color attribute to pass onto the fragment shader.<br/>
<br/>
We're also not bothering with GLSL 1.2 code. At the top of the shader source we use the version macro to specfy that we're using GLSL 1.3 for this source code.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LDoubleMultiColorPolygonProgram2D.glfs</div>


<pre class="border my-0 py-3">#version 130

//Multicolor attribute
in vec4 multiColor;

//Final color
out vec4 LFragment;

void main()
{
    //Set fragment
    LFragment = multiColor;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The fragment shader largely the same as before only now instead of using an old reserved word we declare "LFragment" to specify the color that goes out to the color buffer.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LDoubleMultiColorPolygonProgram2D.h</div>


<pre class="border my-0 py-3">        void setVertexPointer( GLsizei stride, const GLvoid* data );
        /*
        Pre Condition:
         -Bound LMultiColorPolygonProgram2D
        Post Condition:
         -Sets vertex position attribute pointer
        Side Effects:
         -None
        */

        void setColor1Pointer( GLsizei stride, const GLvoid* data );
        /*
        Pre Condition:
         -Bound LMultiColorPolygonProgram2D
        Post Condition:
         -Sets vertex color 1 attribute pointer
        Side Effects:
         -None
        */

        void setColor2Pointer( GLsizei stride, const GLvoid* data );
        /*
        Pre Condition:
         -Bound LMultiColorPolygonProgram2D
        Post Condition:
         -Sets vertex color 2 attribute pointer
        Side Effects:
         -None
        */

        void enableDataPointers();
        /*
        Pre Condition:
         -Bound LDoubleMultiColorPolygonProgram2D
        Post Condition:
         -Enables all attributes
        Side Effects:
         -None
        */

        void disableDataPointers();
        /*
        Pre Condition:
         -Bound LDoubleMultiColorPolygonProgram2D
        Post Condition:
         -Disables all attributes
        Side Effects:
         -None
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The shader program for our new shader is largely the same as before only now it has functions for two color attribute pointers. Also, instead of having a function to enable/disable
each individual attribute, we have one pair of functions to enable/disable them with one function call.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LDoubleMultiColorPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">    //Get variable locations
    mVertexPos2DLocation = glGetAttribLocation( mProgramID, "LVertexPos2D" );
    if( mVertexPos2DLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LVertexPos2D" );
    }

    mMultiColor1Location = glGetAttribLocation( mProgramID, "LMultiColor1" );
    if( mMultiColor1Location == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LMultiColor1" );
    }

    mMultiColor2Location = glGetAttribLocation( mProgramID, "LMultiColor2" );
    if( mMultiColor2Location == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LMultiColor2" );
    }

    mProjectionMatrixLocation = glGetUniformLocation( mProgramID, "LProjectionMatrix" );
    if( mProjectionMatrixLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LProjectionMatrix" );
    }

    mModelViewMatrixLocation = glGetUniformLocation( mProgramID, "LModelViewMatrix" );
    if( mModelViewMatrixLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LModelViewMatrix" );
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Loading this shader program is pretty much the same. We just got to remember to get the locations for all of our variables.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LDoubleMultiColorPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">void LDoubleMultiColorPolygonProgram2D::setVertexPointer( GLsizei stride, const GLvoid* data )
{
    glVertexAttribPointer( mVertexPos2DLocation, 2, GL_FLOAT, GL_FALSE, stride, data );
}

void LDoubleMultiColorPolygonProgram2D::setColor1Pointer( GLsizei stride, const GLvoid* data )
{
    glVertexAttribPointer( mMultiColor1Location, 4, GL_FLOAT, GL_FALSE, stride, data );
}

void LDoubleMultiColorPolygonProgram2D::setColor2Pointer( GLsizei stride, const GLvoid* data )
{
    glVertexAttribPointer( mMultiColor2Location, 4, GL_FLOAT, GL_FALSE, stride, data );
}

void LDoubleMultiColorPolygonProgram2D::enableDataPointers()
{
    glEnableVertexAttribArray( mVertexPos2DLocation );
    glEnableVertexAttribArray( mMultiColor1Location );
    glEnableVertexAttribArray( mMultiColor2Location );
}

void LDoubleMultiColorPolygonProgram2D::disableDataPointers()
{
    glDisableVertexAttribArray( mMultiColor2Location );
    glDisableVertexAttribArray( mMultiColor1Location );
    glDisableVertexAttribArray( mVertexPos2DLocation );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">All this should look familiar. This big difference here is that we have the all in one enable/disable attribute functions.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//Double Multicolor shader
LDoubleMultiColorPolygonProgram2D gDoubleMultiColorPolygonProgram2D;

//VBO names
GLuint gVertexVBO = NULL;
GLuint gRGBYVBO = NULL;
GLuint gCYMWVBO = NULL;
GLuint gGrayVBO = NULL;
GLuint gIBO = NULL;

//VAO Names
GLuint gLeftVAO = NULL;
GLuint gRightVAO = NULL;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp we have our shader program object like we usually do. This time around we have 4 vertex buffers.<br/>
<br/>
We have a vertex buffer of 4 vertex positions, a VBO for a red, green, blue and yellow colors, a VBO for cyan, yellow, magenta, and white colors, and a VBO for 4 shades of grey.
We also have our IBO like we did before.<br/>
<br/>
Next we have the VAO for the left quad and the VAO for the right quad. They have integer names just like textures, VBO, shaders, shader programs, and just about everything else
we've worked with.<br/>
<br/>
The quad on the left is going to have the vertex positions, RGBY colors, and the grey colors attribute pointers. The quad on the right is going to have the vertex positions, CYMW
colors, and the grey colors attribute pointers.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadGP()
{
    //Load double multicolor shader program
    if( !gDoubleMultiColorPolygonProgram2D.loadProgram() )
    {
        printf( "Unable to load double multicolor shader!\n" );
        return false;
    }

    //Bind double multicolor shader program
    gDoubleMultiColorPolygonProgram2D.bind();

    //Initialize projection
    gDoubleMultiColorPolygonProgram2D.setProjection( glm::ortho&#060GLfloat&#062( 0.0, SCREEN_WIDTH, SCREEN_HEIGHT, 0.0, 1.0, -1.0 ) );
    gDoubleMultiColorPolygonProgram2D.updateProjection();

    //Initialize modelview
    gDoubleMultiColorPolygonProgram2D.setModelView( glm::mat4() );
    gDoubleMultiColorPolygonProgram2D.updateModelView();

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we load our shader program like we usually do.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //VBO data
    LVertexPos2D quadPos[ 4 ];
    LColorRGBA quadColorRGBY[ 4 ];
    LColorRGBA quadColorCYMW[ 4 ];
    LColorRGBA quadColorGray[ 4 ];
    GLuint indices[ 4 ];

    //Set quad verticies
    quadPos[ 0 ].x = -50.f;
    quadPos[ 0 ].y = -50.f;

    quadPos[ 1 ].x =  50.f;
    quadPos[ 1 ].y = -50.f;

    quadPos[ 2 ].x =  50.f;
    quadPos[ 2 ].y =  50.f;

    quadPos[ 3 ].x = -50.f;
    quadPos[ 3 ].y =  50.f;

    quadColorRGBY[ 0 ].r = 1.f;
    quadColorRGBY[ 0 ].g = 0.f;
    quadColorRGBY[ 0 ].b = 0.f;
    quadColorRGBY[ 0 ].a = 1.f;

    quadColorRGBY[ 1 ].r = 1.f;
    quadColorRGBY[ 1 ].g = 1.f;
    quadColorRGBY[ 1 ].b = 0.f;
    quadColorRGBY[ 1 ].a = 1.f;

    quadColorRGBY[ 2 ].r = 0.f;
    quadColorRGBY[ 2 ].g = 1.f;
    quadColorRGBY[ 2 ].b = 0.f;
    quadColorRGBY[ 2 ].a = 1.f;

    quadColorRGBY[ 3 ].r = 0.f;
    quadColorRGBY[ 3 ].g = 0.f;
    quadColorRGBY[ 3 ].b = 1.f;
    quadColorRGBY[ 3 ].a = 1.f;

    quadColorCYMW[ 0 ].r = 0.f;
    quadColorCYMW[ 0 ].g = 1.f;
    quadColorCYMW[ 0 ].b = 1.f;
    quadColorCYMW[ 0 ].a = 1.f;

    quadColorCYMW[ 1 ].r = 1.f;
    quadColorCYMW[ 1 ].g = 1.f;
    quadColorCYMW[ 1 ].b = 0.f;
    quadColorCYMW[ 1 ].a = 1.f;

    quadColorCYMW[ 2 ].r = 1.f;
    quadColorCYMW[ 2 ].g = 0.f;
    quadColorCYMW[ 2 ].b = 1.f;
    quadColorCYMW[ 2 ].a = 1.f;

    quadColorCYMW[ 3 ].r = 1.f;
    quadColorCYMW[ 3 ].g = 1.f;
    quadColorCYMW[ 3 ].b = 1.f;
    quadColorCYMW[ 3 ].a = 1.f;

    quadColorGray[ 0 ].r = 0.75f;
    quadColorGray[ 0 ].g = 0.75f;
    quadColorGray[ 0 ].b = 0.75f;
    quadColorGray[ 0 ].a = 1.f;

    quadColorGray[ 1 ].r = 0.50f;
    quadColorGray[ 1 ].g = 0.50f;
    quadColorGray[ 1 ].b = 0.50f;
    quadColorGray[ 1 ].a = 0.50f;

    quadColorGray[ 2 ].r = 0.75f;
    quadColorGray[ 2 ].g = 0.75f;
    quadColorGray[ 2 ].b = 0.75f;
    quadColorGray[ 2 ].a = 1.f;

    quadColorGray[ 3 ].r = 0.50f;
    quadColorGray[ 3 ].g = 0.50f;
    quadColorGray[ 3 ].b = 0.50f;
    quadColorGray[ 3 ].a = 1.f;

    //Set rendering indices
    indices[ 0 ] = 0;
    indices[ 1 ] = 1;
    indices[ 2 ] = 2;
    indices[ 3 ] = 3;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we set the VBO data and IBO data.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Create VBOs
    glGenBuffers( 1, &gVertexVBO );
    glBindBuffer( GL_ARRAY_BUFFER, gVertexVBO );
    glBufferData( GL_ARRAY_BUFFER, 4 * sizeof(LVertexPos2D), quadPos, GL_STATIC_DRAW );

    glGenBuffers( 1, &gRGBYVBO );
    glBindBuffer( GL_ARRAY_BUFFER, gRGBYVBO );
    glBufferData( GL_ARRAY_BUFFER, 4 * sizeof(LColorRGBA), quadColorRGBY, GL_STATIC_DRAW );
    
    glGenBuffers( 1, &gCYMWVBO );
    glBindBuffer( GL_ARRAY_BUFFER, gCYMWVBO );
    glBufferData( GL_ARRAY_BUFFER, 4 * sizeof(LColorRGBA), quadColorCYMW, GL_STATIC_DRAW );
    
    glGenBuffers( 1, &gGrayVBO );
    glBindBuffer( GL_ARRAY_BUFFER, gGrayVBO );
    glBufferData( GL_ARRAY_BUFFER, 4 * sizeof(LColorRGBA), quadColorGray, GL_STATIC_DRAW );

    //Create IBO
    glGenBuffers( 1, &gIBO );
    glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, gIBO );
    glBufferData( GL_ELEMENT_ARRAY_BUFFER, 4 * sizeof(GLuint), indices, GL_STATIC_DRAW );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we create the VBOs for the vertex position, RGBY color, CYMW color, and gray color attributes. We also create the IBO.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Generate left quad VAO
    glGenVertexArrays( 1, &gLeftVAO );

    //Bind vertex array
    glBindVertexArray( gLeftVAO );

    //Enable vertex attributes
    gDoubleMultiColorPolygonProgram2D.enableDataPointers();

    //Set vertex data
    glBindBuffer( GL_ARRAY_BUFFER, gVertexVBO );
    gDoubleMultiColorPolygonProgram2D.setVertexPointer( 0, NULL );

    glBindBuffer( GL_ARRAY_BUFFER, gRGBYVBO );
    gDoubleMultiColorPolygonProgram2D.setColor1Pointer( 0, NULL );

    glBindBuffer( GL_ARRAY_BUFFER, gGrayVBO );
    gDoubleMultiColorPolygonProgram2D.setColor2Pointer( 0, NULL );

    glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, gIBO );

    //Unbind VAO
    glBindVertexArray( NULL );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now it's time to generate the VAO for the left quad using glGenVertexArrays(). After generating it we bind it using glBindVertexArray().<br/>
<br/>
When we have our VAO bound, any changes made to the vertex attribute state are made to the currently bound VAO. Here we're enabling all the data pointers for our shader program,
setting the vertex position data pointer, setting the two color pointers, and setting the IBO. Then we unbind the VAO by binding null.<br/>
<br/>
If we were to bind this VAO again, it would enable all the attributes that we enabled on here, set all the pointers we set here, and set the IBO we set here.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Generate right quad VAO
    glGenVertexArrays( 1, &gRightVAO );

    //Bind vertex array
    glBindVertexArray( gRightVAO );

    //Enable vertex attributes
    gDoubleMultiColorPolygonProgram2D.enableDataPointers();

    //Set vertex data
    glBindBuffer( GL_ARRAY_BUFFER, gVertexVBO );
    gDoubleMultiColorPolygonProgram2D.setVertexPointer( 0, NULL );

    glBindBuffer( GL_ARRAY_BUFFER, gCYMWVBO );
    gDoubleMultiColorPolygonProgram2D.setColor1Pointer( 0, NULL );

    glBindBuffer( GL_ARRAY_BUFFER, gGrayVBO );
    gDoubleMultiColorPolygonProgram2D.setColor2Pointer( 0, NULL );

    glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, gIBO );

    //Unbind VAO
    glBindVertexArray( NULL );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we create and set the VAO for the right quad much like we did left quad, only here we're using the CYMW color instead of the RGBY color that the left quad is using.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Multicolor quad on the left
    gDoubleMultiColorPolygonProgram2D.setModelView( glm::translate&#060GLfloat&#062( glm::vec3(SCREEN_WIDTH * 1.f / 4.f, SCREEN_HEIGHT / 2.f, 0.f ) ) );
    gDoubleMultiColorPolygonProgram2D.updateModelView();

    //Set left vertex array object
    glBindVertexArray( gLeftVAO );
    glDrawElements( GL_TRIANGLE_FAN, 4, GL_UNSIGNED_INT, NULL );

    //Multicolor quad on the right
    gDoubleMultiColorPolygonProgram2D.setModelView( glm::translate&#060GLfloat&#062( glm::vec3( SCREEN_WIDTH * 3.f / 4.f, SCREEN_HEIGHT / 2.f, 0.f ) ) );
    gDoubleMultiColorPolygonProgram2D.updateModelView();

    //Set right vertex array object
    glBindVertexArray( gRightVAO );
    glDrawElements( GL_TRIANGLE_FAN, 4, GL_UNSIGNED_INT, NULL );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now when drawing the left quad with glDrawElements() instead of making 1 function call to enable the attribute pointers, 3 more calls to set the attribute pointers, and one more to
set the IBO, we make one call to bind the VAO with all the attributes states set and draw.<br/>
<br/>
It's the same story with here when we render the right quad were we make one call to set the vertex states we need as opposed to 5. When used properly, VAOs can save you quite a
bit of hassle.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="36_vertex_array_objects.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Vertex Array Objects">Back to Index</a>


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