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
<meta name="keywords" content="C++ OpenGL 3.0 Tutorial 2D Windows Linux Mac GLSL color uniforms">
<meta name="description" content="Learn to set uniform variables to give polygons color.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - GLSL Matrices, Color, and Uniforms</title>

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
    <h1 class="text-center">GLSL Matrices, Color, and Uniforms</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="GLSL Matrices, Color, and Uniforms screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Oct 19th, 2014</b></p>
    
        Up until now our shaders have pretty much just been doing their own thing once we give them the vertex data. With uniform variables, you can set variables for each
batch of vertices you process.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.glvs</div>


<pre class="border my-0 py-3">void main()
{
    //Process vertex
    gl_Position = gl_ProjectionMatrix * gl_ModelViewMatrix * gl_Vertex;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now our vertex shader does something interesting. It processes the vertex much in the same way it did in our old fixed function pipeline programs by multiplying the vertices by
the modelview matrix and then the projection matrix to get the coordinates for rasterization.<br/>
<br/>
The "gl_ProjectionMatrix" and "gl_ModelViewMatrix" are uniform variables that stay the same (or stay uniform) for every vertex batch that goes through the pipeline. These uniform
variables are built into OpenGL 2.1 GLSL and you can mess with them using the OpenGL matrix functions (glOrtho(), glScale(), glRotate(), etc).<br/>
<br/>
Since this is the programmable pipeline, we can not only say how to use the existing variables in the pipeline but also create our own.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.glfs</div>


<pre class="border my-0 py-3">//Plain polygon color
uniform vec4 LPolygonColor = vec4( 1.0, 1.0, 1.0, 1.0 );

void main()
{
    //Set fragment
    gl_FragColor = LPolygonColor;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's our fragment shader with our own uniform variable "LPolygonColor". In our shader program "LPolygonColor" has a default color of white. As you can see in the shader,
whatever we set our uniform to be, that's the color that gets rasterized.<br/>
<br/>
Unlike with "gl_ProjectionMatrix" and "gl_ModelViewMatrix", our uniform variable doesn't have any OpenGL functions dedicated to it. Fortunately, OpenGL provides us with
functionality to interface with our shader.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.h</div>


<pre class="border my-0 py-3">class LPlainPolygonProgram2D : public LShaderProgram
{
    public:
        LPlainPolygonProgram2D();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Initializes variables
        Side Effects:
         -None
        */

        bool loadProgram();
        /*
        Pre Condition:
         -A valid OpenGL context
        Post Condition:
         -Loads plain polygon program
        Side Effects:
         -None
        */

        void setColor( GLfloat r, GLfloat g, GLfloat b, GLfloat a = 1.f );
        /*
        Pre Condition:
         -Bound LPlainPolygonProgram2D
        Post Condition:
         -Update uniform color used for rendering
        Side Effects:
         -None
        */

    private:
        //Color uniform location
        GLint mPolygonColorLocation;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The LPlainPolygonProgram2D now has a new variable "mPolygonColorLocation". In order to set a variable in our shader, we need it's location in the shader program. As you can see the
class has new functions and we'll go over those next.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">LPlainPolygonProgram2D::LPlainPolygonProgram2D()
{
    mPolygonColorLocation = 0;
}

bool LPlainPolygonProgram2D::loadProgram()
{
    //Generate program
    mProgramID = glCreateProgram();

    //Load vertex shader
    GLuint vertexShader = loadShaderFromFile( "31_glsl_matrices_color_and_uniforms/LPlainPolygonProgram2D.glvs", GL_VERTEX_SHADER );

    //Check for errors
    if( vertexShader == 0 )
    {
        glDeleteProgram( mProgramID );
        mProgramID = 0;
        return false;
    }

    //Attach vertex shader to program
    glAttachShader( mProgramID, vertexShader );


    //Create fragment shader
    GLuint fragmentShader = loadShaderFromFile( "31_glsl_matrices_color_and_uniforms/LPlainPolygonProgram2D.glfs", GL_FRAGMENT_SHADER );

    //Check for errors
    if( fragmentShader == 0 )
    {
        glDeleteShader( vertexShader );
        glDeleteProgram( mProgramID );
        mProgramID = 0;
        return false;
    }

    //Attach fragment shader to program
    glAttachShader( mProgramID, fragmentShader );

    //Link program
    glLinkProgram( mProgramID );

    //Check for errors
    GLint programSuccess = GL_TRUE;
    glGetProgramiv( mProgramID, GL_LINK_STATUS, &programSuccess );
    if( programSuccess != GL_TRUE )
    {
        printf( "Error linking program %d!\n", mProgramID );
        printProgramLog( mProgramID );
        glDeleteShader( vertexShader );
        glDeleteShader( fragmentShader );
        glDeleteProgram( mProgramID );
        mProgramID = 0;
        return false;
    }

    //Clean up excess shader references
    glDeleteShader( vertexShader );
    glDeleteShader( fragmentShader );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The new constructor just initializes the variable location, and the program loading routine is largely the same as before only now it has to get the variable location from the
shader program.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">    //Get variable location
    mPolygonColorLocation = glGetUniformLocation( mProgramID, "LPolygonColor" );
    if( mPolygonColorLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LPolygonColor" );
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Using glGetUniformLocation(), we can get the location of a uniform from a compiled and linked shader program. The first argument is the ID of the program and the second argument
is the name of the variable. If the variable can't be found, the location returned will be -1.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">void LPlainPolygonProgram2D::setColor( GLfloat r, GLfloat g, GLfloat b, GLfloat a )
{
    //Update color in shader
    glUniform4f( mPolygonColorLocation, r, g, b, a );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After getting the variable location, we can set the uniform variable's value using glUniform(). The first argument is the location of the variable is it's location in the shader
program. The following arguments are the values we're assigning to the uniform in the shader program.<br/>
<br/>
In the shader "LPolygonColor" was a vec4, so we use glUniform4f() to assign the 4 components of the vector.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//Basic shader
LPlainPolygonProgram2D gPlainPolygonProgram2D;

//VBO names
GLuint gVBO = NULL;
GLuint gIBO = NULL;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">This time around we're using more modern VBO rendering to render the quad.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //VBO data
    LVertexPos2D quadVertices[ 4 ];
    GLuint indices[ 4 ];

    //Set quad vertices
    quadVertices[ 0 ].x = -50.f;
    quadVertices[ 0 ].y = -50.f;

    quadVertices[ 1 ].x =  50.f;
    quadVertices[ 1 ].y = -50.f;

    quadVertices[ 2 ].x =  50.f;
    quadVertices[ 2 ].y =  50.f;

    quadVertices[ 3 ].x = -50.f;
    quadVertices[ 3 ].y =  50.f;

    //Set rendering indices
    indices[ 0 ] = 0;
    indices[ 1 ] = 1;
    indices[ 2 ] = 2;
    indices[ 3 ] = 3;

    //Create VBO
    glGenBuffers( 1, &gVBO );
    glBindBuffer( GL_ARRAY_BUFFER, gVBO );
    glBufferData( GL_ARRAY_BUFFER, 4 * sizeof(LVertexPos2D), quadVertices, GL_STATIC_DRAW );

    //Create IBO
    glGenBuffers( 1, &gIBO );
    glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, gIBO );
    glBufferData( GL_ELEMENT_ARRAY_BUFFER, 4 * sizeof(GLuint), indices, GL_STATIC_DRAW );

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we set the vertices for a 100x100 quad centered at the origin.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Reset transformations
    glLoadIdentity();

    //Solid cyan quad in the center
    glTranslatef( SCREEN_WIDTH / 2.f, SCREEN_HEIGHT / 2.f, 0.f );
    gPlainPolygonProgram2D.setColor( 0.f, 1.f, 1.f );

    //Enable vertex arrays
    glEnableClientState( GL_VERTEX_ARRAY );

        //Set vertex data
        glBindBuffer( GL_ARRAY_BUFFER, gVBO );
        glVertexPointer( 2, GL_FLOAT, 0, NULL );

        //Draw quad using vertex data and index data
        glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, gIBO );
        glDrawElements( GL_QUADS, 4, GL_UNSIGNED_INT, NULL );

    //Disable vertex arrays
    glDisableClientState( GL_VERTEX_ARRAY );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we render the VBO using the shader program. As you can see, we call our function to update the polygon color uniform to set the color to cyan. Now the OpenGL code we wrote to
render a cyan quad will actually work thanks to the proper GLSL code.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="31_glsl_matrices_color_and_uniforms.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#GLSL Matrices, Color, and Uniforms">Back to Index</a>


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