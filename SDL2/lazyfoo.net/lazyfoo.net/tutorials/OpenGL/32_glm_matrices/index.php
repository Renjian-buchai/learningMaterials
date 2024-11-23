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
<meta name="keywords" content="C++ OpenGL 3.0 Tutorial 2D Windows Linux Mac Color GLM Matrix Uniform GLSL">
<meta name="description" content="Learn to use GLM matrices with GLSL.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - GLM Matrices</title>

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
    <h1 class="text-center">GLM Matrices</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="GLM Matrices screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Oct 19th, 2014</b></p>
    
        In OpenGL 3.0+, the built in OpenGL matrix functions from OpenGL 2.1 are deprecated. Since modern OpenGL implementations want you to roll your own matrix functionality,
we'll be using the GL math library to use our own custom matrix operations for our GLSL shader.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <h2>Setting up GLM</h2>
<br/>
If you know linear algebra (and you should if you're reading this tutorial), you could create your own matrix classes in an afternoon. Since we're strapped for time
and we don't want to spend effort on reinventing the wheel, we'll be using the tried and tested open source library GL Math. 
<a href="http://sourceforge.net/projects/ogl-math/files/">You can download the library here</a>.<br/>
<br/>
Unlike freeGLUT or even freetype, GLM is a header only library. To set it up, just extract the archive and make sure your compiler/IDE is looking at the directory
from the archive.

</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.glvs</div>


<pre class="border my-0 py-3">//Transformation Matrices
uniform mat4 LProjectionMatrix;
uniform mat4 LModelViewMatrix;

void main()
{
    //Process vertex
    gl_Position = LProjectionMatrix * LModelViewMatrix * gl_Vertex;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">As you can see in our updated vertex shader, we have our own custom 4x4 matrices replacing the old built in ones. Glancing at the main function, you'll see they function the same
as the old ones did.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.h</div>


<pre class="border my-0 py-3">#include "LShaderProgram.h"
#include &#060glm/glm.hpp&#062

class LPlainPolygonProgram2D : public LShaderProgram
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
         -Updates uniform color used for rendering
        Side Effects:
         -None
        */

        void setProjection( glm::mat4 matrix );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Sets member projection matrix
        Side Effects:
         -None
        */

        void setModelView( glm::mat4 matrix );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Sets member modelview matrix
        Side Effects:
         -None
        */

        void leftMultProjection( glm::mat4 matrix );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Left multiplies member projection matrix
        Side Effects:
         -None
        */

        void leftMultModelView( glm::mat4 matrix );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Left multiplies member modelview matrix
        Side Effects:
         -None
        */

        void updateProjection();
        /*
        Pre Condition:
         -Bound LPlainPolygonProgram2D
        Post Condition:
         -Updates shader program projection matrix with member projection matrix
        Side Effects:
         -None
        */

        void updateModelView();
        /*
        Pre Condition:
         -Bound LPlainPolygonProgram2D
        Post Condition:
         -Updates shader program modelview matrix with member modelview matrix
        Side Effects:
         -None
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of the LPlainPolygonProgram2D class header we include the glm library header. We also have a bunch of new functions for the new matrices we added to the shader program.
We'll go over those in the cpp file.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.h</div>


<pre class="border my-0 py-3">    private:
        //Color uniform location
        GLint mPolygonColorLocation;

        //Projection matrix
        glm::mat4 mProjectionMatrix;
        GLint mProjectionMatrixLocation;

        //Modelview matrix
        glm::mat4 mModelViewMatrix;
        GLint mModelViewMatrixLocation;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the new variables added for the new matrix functionality. The mat4 data type from the glm library is the 4x4 matrix we'll be using the replace the old fixed function
matrices. We have one for the projection and modelview matrix. We also have location variables for each of the matrices so we can update them in the GLSL shader program.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">#include "LPlainPolygonProgram2D.h"
#include &#060glm/gtc/type_ptr.hpp&#062

LPlainPolygonProgram2D::LPlainPolygonProgram2D()
{
    mPolygonColorLocation = 0;
    mProjectionMatrixLocation = 0;
    mModelViewMatrixLocation = 0;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LPlainPolygonProgram2D.cpp we include the type pointer header from GLM so we'll be able to get the data pointer from the mat4 matrices to update them in the GLSL
shader.<br/>
<br/>
In the updated constructor for the LPlainPolygonProgram2D class we initialize the location variables. If you're wondering what the mat4 objects initialize to, the default
constructor for the class has them initialize to the identity matrix.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">bool LPlainPolygonProgram2D::loadProgram()
{
    //Generate program
    mProgramID = glCreateProgram();

    //Load vertex shader
    GLuint vertexShader = loadShaderFromFile( "32_glm_matrices/LPlainPolygonProgram2D.glvs", GL_VERTEX_SHADER );

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
    GLuint fragmentShader = loadShaderFromFile( "32_glm_matrices/LPlainPolygonProgram2D.glfs", GL_FRAGMENT_SHADER );

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

    //Get variable locations
    mPolygonColorLocation = glGetUniformLocation( mProgramID, "LPolygonColor" );
    if( mPolygonColorLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LPolygonColor" );
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


    <div class="container border-start border-end border-bottom py-3 mb-3">The loading function for this shader is pretty much the same as before, only now it gets the locations for the new uniform variables.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">void LPlainPolygonProgram2D::setProjection( glm::mat4 matrix )
{
    mProjectionMatrix = matrix;
}

void LPlainPolygonProgram2D::setModelView( glm::mat4 matrix )
{
    mModelViewMatrix = matrix;
}

void LPlainPolygonProgram2D::leftMultProjection( glm::mat4 matrix )
{
    mProjectionMatrix = matrix * mProjectionMatrix;
}

void LPlainPolygonProgram2D::leftMultModelView( glm::mat4 matrix )
{
    mModelViewMatrix = matrix * mModelViewMatrix;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here are the functions to assign values to or left multiply the projection/modelview matrices for our shader program.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">void LPlainPolygonProgram2D::updateProjection()
{
    glUniformMatrix4fv( mProjectionMatrixLocation, 1, GL_FALSE, glm::value_ptr( mProjectionMatrix ) );
}

void LPlainPolygonProgram2D::updateModelView()
{
    glUniformMatrix4fv( mModelViewMatrixLocation, 1, GL_FALSE, glm::value_ptr( mModelViewMatrix ) );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When you're done with your matrix operations and you want to start rendering, we have these functions that update the matrix variables in the shader. Matrix uniforms have the
special function glUniformMatrix4() to update them. The first argument is the variable location, the second is how many matrices we're going to be updating, the third is
whether we want to transpose the matrix data we're sending and the fourth argument is the pointer to the 16 GLfloat array that represents the matrix.<br/>
<br/>
If you want to roll your own matrix library, know that glUniformMatrix4() accepts the matrix array in column major order:<br/>
<code><pre>00 04 08 12
01 05 09 13
02 06 10 14
03 07 11 15
</pre></code>
You may be wondering why we don't just call glUniformMatrix4() after each matrix operation. It doesn't really make sense to send each operation to the GPU if we're only going to
use the final form of the matrix to multiply against vertex data. The rule of thumb is do all the matrix operation client side and when you're ready to process vertex data update
the uniform in the shader.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">#include "LUtil.h"
#include &#060IL/il.h&#062
#include &#060IL/ilu.h&#062
#include "LPlainPolygonProgram2D.h"
#include "LVertexPos2D.h"
#include &#060glm/glm.hpp&#062
#include &#060glm/gtx/transform.hpp&#062

//Basic shader
LPlainPolygonProgram2D gPlainPolygonProgram2D;

//VBO names
GLuint gVBO = NULL;
GLuint gIBO = NULL;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp we include the transformation header from GLM. GLM has functionality built in to replace the old OpenGL matrix operation which we'll be using in a little
bit.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool initGL()
{
    //Initialize GLEW
    GLenum glewError = glewInit();
    if( glewError != GLEW_OK )
    {
        printf( "Error initializing GLEW! %s\n", glewGetErrorString( glewError ) );
        return false;
    }

    //Make sure OpenGL 2.1 is supported
    if( !GLEW_VERSION_2_1 )
    {
        printf( "OpenGL 2.1 not supported!\n" );
        return false;
    }

    //Set the viewport
    glViewport( 0.f, 0.f, SCREEN_WIDTH, SCREEN_HEIGHT );

    //Initialize clear color
    glClearColor( 0.f, 0.f, 0.f, 1.f );

    //Enable texturing
    glEnable( GL_TEXTURE_2D );

    //Set blending
    glEnable( GL_BLEND );
    glDisable( GL_DEPTH_TEST );
    glBlendFunc( GL_SRC_ALPHA, GL_ONE_MINUS_SRC_ALPHA );

    //Check for error
    GLenum error = glGetError();
    if( error != GL_NO_ERROR )
    {
        printf( "Error initializing OpenGL! %s\n", gluErrorString( error ) );
        return false;
    }

    //Initialize DevIL and DevILU
    ilInit();
    iluInit();
    ilClearColour( 255, 255, 255, 000 );

    //Check for error
    ILenum ilError = ilGetError();
    if( ilError != IL_NO_ERROR )
    {
        printf( "Error initializing DevIL! %s\n", iluErrorString( ilError ) );
        return false;
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Since we're no longer using the built in matrices from the OpenGL 2.1 days, we removed the deprecated matrix function calls from our initGL() function.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadGP()
{
    //Load basic shader program
    if( !gPlainPolygonProgram2D.loadProgram() )
    {
        printf( "Unable to load basic shader!\n" );
        return false;
    }

    //Bind basic shader program
    gPlainPolygonProgram2D.bind();

    //Initialize projection
    gPlainPolygonProgram2D.setProjection( glm::ortho&#060GLfloat&#062( 0.0, SCREEN_WIDTH, SCREEN_HEIGHT, 0.0, 1.0, -1.0 ) );
    gPlainPolygonProgram2D.updateProjection();

    //Initialize modelview
    gPlainPolygonProgram2D.setModelView( glm::mat4() );
    gPlainPolygonProgram2D.updateModelView();

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the loadGP() function we load and bind our shader program as usual. Then we set the projection matrix in our shader program using the ortho() function in the GLM library. This
function returns a mat4 matrix that's the same as the orthgraphic matrix used by the old glOrtho() function call. We then update the projection matrix in the shader program.<br/>
<br/>
Then we set the modelview matrix. Since the mat4 class constructs the identity matrix by default, passing in a mat4 object will set the modelview matrix to the identity matrix.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Solid cyan quad in the center
    gPlainPolygonProgram2D.setModelView( glm::translate&#060GLfloat&#062( glm::vec3( SCREEN_WIDTH / 2.f, SCREEN_HEIGHT / 2.f, 0.f ) ) );
    gPlainPolygonProgram2D.updateModelView();
    gPlainPolygonProgram2D.setColor( 0.f, 1.f, 1.f );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When we render, we want to translate the quad to the center of the screen. Fortunately, the GLM library also replaced the glTranslate() function. All we have to do is pass in the
x/y/z translation as a vector.<br/>
<br/>
Next we update the modelview matrix and set the rendering color in the shader program.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">    //Enable vertex arrays
    glEnableClientState( GL_VERTEX_ARRAY );

        //Set vertex data
        glBindBuffer( GL_ARRAY_BUFFER, gVBO );
        glVertexPointer( 2, GL_FLOAT, 0, NULL );

        //Draw quad using vertex data and index data
        glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, gIBO );
        glDrawElements( GL_TRIANGLE_FAN, 4, GL_UNSIGNED_INT, NULL );

    //Disable vertex arrays
    glDisableClientState( GL_VERTEX_ARRAY );

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally here we render the quad. There's just one problem: GL_QUAD primitives are also deprecated in OpenGL 3.0+. Fortunately we can use triangle fans to render a quad as two
triangles like this:
<div class="text-center"><img class="img-fluid" alt="triangle fan" src="triangle_fan.png"></div>
<br/>
You can look up more on how triangle fans work in the OpenGL documentation. For now, just know they're a quick way to replace the old GL_QUADs.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="32_glm_matrices.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#GLM Matrices">Back to Index</a>


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