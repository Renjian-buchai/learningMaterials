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
<meta name="keywords" content="C++ OpenGL 3.0 Tutorial 2D Windows Linux Mac GLSL vertex attributes">
<meta name="description" content="Learn to use GLSL attributes in a shader program.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Multi-Color Polygons and Attributes</title>

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
    <h1 class="text-center">Multi-Color Polygons and Attributes</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Multi-Color Polygons and Attributes screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Oct 19th, 2014</b></p>
    
        In the old fixed function pipeline, they had built in attributes for vertex positions, vertex color, vertex normals, vertex texture coordinates, etc. When GLSL
rolled in they let the user define their own custom attributes. When the big API clean up with OpenGL 3.0+ came around, the designers realized that all the built
in attributes were just vectors, so they could just have the user define the features that they needed.<br/>
<br/>
For this tutorial, we could have used the built in glColorPointer() function from OpenGL 2.1 to render a multicolor polygon. Instead we're going to define our own
vertex position and vertex color attributes so the code is forward compatible with OpenGL 3.0+.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LMultiColorPolygonProgram2D.glvs</div>


<pre class="border my-0 py-3">//Transformation Matrices
uniform mat4 LProjectionMatrix;
uniform mat4 LModelViewMatrix;

#if __VERSION__ >= 130

//Vertex position attribute
in vec2 LVertexPos2D;

//Multicolor attribute
in vec3 LMultiColor;
out vec4 multiColor;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of our vertex shader, we have our uniform variables from the plain polygon shader. Then we use the "#if" preprocessor to check which version of GLSL we have available
to us. The reason is if the GLSL version is 1.30 or greater we want to compile the code you see above, otherwise we want to compile with the code you'll see next.<br/>
<br/>
What you see above is the declaration of GLSL attribute variables done in the modern OpenGL 3.0+ way. We have a 2D vector we take <b>in</b> named "LVertexPos2D". This variable will
define the position of the vertex. The built in "gl_Vertex" attribute from GLSL version 1.20 was deprecated in the OpenGL 3.0 release.<br/>
<br/>
We also take <b>in</b> a 4 dimensional vector "LMultiColor" which represents the r, g, b, a values of a vertex color. Finally we send <b>out</b> a "multiColor" attribute for every
vertex we process. Where does it go out to? The fragment shader because we need to know the color of the vertex to properly color the fragments.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LMultiColorPolygonProgram2D.glvs</div>


<pre class="border my-0 py-3">#else

//Vertex position attribute
attribute vec2 LVertexPos2D;

//Multicolor attribute
attribute vec3 LMultiColor;
varying vec4 multiColor;

#endif
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">What you see here is pretty much the same as the previous chunk of code only it's done with OpenGL 2 style attribute declaration. "attribute" variables are attributes that go into
the vertex shader. "varying" variables go out from the vertex shader into the fragment shader.<br/>
<br/>
If you're making a large scale program it's probably best to have your C++/C/Java/Python/whatever OpenGL program detect at runtime what GLSL version your GPU supports and then load
a GLSL shader file that has the code for the particular version of GLSL want to support. For the sake of not having to distribute multiple shader files with this tutorial, I put
the shader source in one file and used preprocessors to have it compile differently based on the GLSL version. 
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LMultiColorPolygonProgram2D.glvs</div>


<pre class="border my-0 py-3">void main()
{
    //Process color
    multiColor = LMultiColor;
    
    //Process vertex
    gl_Position = LProjectionMatrix * LModelViewMatrix * vec4( LVertexPos2D.x, LVertexPos2D.y, 0.0, 1.0 );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">There the main function that gets called on every vertex we process.<br/>
<br/>
For "LMultiColor", we just pass it through to "multiColor". If we wanted to, we could do matrix tranformations on the color (it is a vector after all) to do effects like greyscale
or sephia tone.<br/>
<br/>
Calculating the vertex position pretty much works the same as before only now we're not using the built in vertex attribute and we're converting the 2D positions into a 4D vector.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LMultiColorPolygonProgram2D.glfs</div>


<pre class="border my-0 py-3">#if __VERSION__ >= 130

//Multicolor attribute
in vec4 multiColor;

//Final color
out vec4 gl_FragColor;

#else

//Multicolor attribute
varying vec4 multiColor;

#endif
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the top of the fragment shader with some more voodoo to get this to compile with both GLSL 1.3 and 1.2.<br/>
<br/>
With the GLSL 1.3 code, we take in the "multicolor" variable from the vertex shader and we declare "gl_FragColor" to send out to the color buffer.<br/>
<br/>
With the GLSL 1.2 code, we declare the varying "multicolor". If you're passing one variable from one shader to another it should have the same name in both shaders no matter which
version of GLSL you're using.<br/>
<br/>
If you're wondering why I don't declare "gl_FragColor" in the GLSL 1.2 code, it's because it's already built into GLSL 1.2 as the color that goes out to the color buffer.
If this shader source was only designed to support GLSL 1.3, I would have probably have named the out variable for the color buffer something besides a reserved word from GLSL 1.2.<br/>
<br/>
This is another case of me trying to support GLSL 1.2 and 1.3+ with the same source file.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LMultiColorPolygonProgram2D.glfs</div>


<pre class="border my-0 py-3">void main()
{
    //Set fragment
    LFragment = multiColor;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For the fragment shader, we have the "multiColor" taken in from the vertex shader and a fragment color we're going to be sending out to be used for rasterization. For this
shader all we do is use the color from the vertex shader and send it out to the rasterizer to color to polygon.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LColorRGBA.h</div>


<pre class="border my-0 py-3">#include "LOpenGL.h"

struct LColorRGBA
{
    GLfloat r;
    GLfloat g;
    GLfloat b;
    GLfloat a;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the data type we're going to be using to define a RGBA color.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LMultiColorVertex2D.h</div>


<pre class="border my-0 py-3">#include "LVertexPos2D.h"
#include "LColorRGBA.h"

struct LMultiColorVertex2D
{
    LVertexPos2D pos;
    LColorRGBA rgba;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">And here's the data type that defines the data for a colored vertex.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LMultiColorPolygonProgram2D.h</div>


<pre class="border my-0 py-3">#include "LShaderProgram.h"
#include &#060glm/glm.hpp&#062

class LMultiColorPolygonProgram2D : public LShaderProgram
{
    public:
        LMultiColorPolygonProgram2D();
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
         -Loads multicolor polygon program
        Side Effects:
         -None
        */

        void setVertexPointer( GLsizei stride, const GLvoid* data );
        /*
        Pre Condition:
         -Bound LMultiColorPolygonProgram2D
        Post Condition:
         -Sets vertex position attribute pointer
        Side Effects:
         -None
        */

        void setColorPointer( GLsizei stride, const GLvoid* data );
        /*
        Pre Condition:
         -Bound LMultiColorPolygonProgram2D
        Post Condition:
         -Sets vertex color attribute pointer
        Side Effects:
         -None
        */

        void enableVertexPointer();
        /*
        Pre Condition:
         -Bound LMultiColorPolygonProgram2D
        Post Condition:
         -Enables vertex position attribute
        Side Effects:
         -None
        */

        void disableVertexPointer();
        /*
        Pre Condition:
         -Bound LMultiColorPolygonProgram2D
        Post Condition:
         -Disables vertex position attribute
        Side Effects:
         -None
        */

        void enableColorPointer();
        /*
        Pre Condition:
         -Bound LMultiColorPolygonProgram2D
        Post Condition:
         -Enables vertex color attribute
        Side Effects:
         -None
        */

        void disableColorPointer();
        /*
        Pre Condition:
         -Bound LMultiColorPolygonProgram2D
        Post Condition:
         -Disables vertex color attribute
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
         -Bound LMultiColorPolygonProgram2D
        Post Condition:
         -Updates shader program projection matrix with member projection matrix
        Side Effects:
         -None
        */

        void updateModelView();
        /*
        Pre Condition:
         -Bound LMultiColorPolygonProgram2D
        Post Condition:
         -Updates shader program modelview matrix with member modelview matrix
        Side Effects:
         -None
        */

    private:
        //Attribute locations
        GLint mVertexPos2DLocation;
        GLint mMultiColorLocation;

        //Projection matrix
        glm::mat4 mProjectionMatrix;
        GLint mProjectionMatrixLocation;

        //Modelview matrix
        glm::mat4 mModelViewMatrix;
        GLint mModelViewMatrixLocation;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The new LMultiColorPolygonProgram2D should largely familiar, only now it has new functions to handle the custom attributes which we'll go over in detail in their implementations.<br/>
<br/>
As with uniform variables, attributes have locations that we use to set them in the shader program. "mVertexPos2DLocation" and "mMultiColorLocation" will specify the location of
our attributes in the shader.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LMultiColorPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">bool LMultiColorPolygonProgram2D::loadProgram()
{
    //Generate program
    mProgramID = glCreateProgram();

    //Load vertex shader
    GLuint vertexShader = loadShaderFromFile( "33_multi-color_polygons_and_attributes/LMultiColorPolygonProgram2D.glvs", GL_VERTEX_SHADER );

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
    GLuint fragmentShader = loadShaderFromFile( "33_multi-color_polygons_and_attributes/LMultiColorPolygonProgram2D.glfs", GL_FRAGMENT_SHADER );

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
    mVertexPos2DLocation = glGetAttribLocation( mProgramID, "LVertexPos2D" );
    if( mVertexPos2DLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LVertexPos2D" );
    }

    mMultiColorLocation = glGetAttribLocation( mProgramID, "LMultiColor" );
    if( mMultiColorLocation == -1 )
    {
        printf( "%s is not a valid glsl program variable!\n", "LMultiColor" );
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


    <div class="container border-start border-end border-bottom py-3 mb-3">Our shader program loading code is mostly the same only now we use glGetAttribLocation() to get the location of our attributes from the shader much in the same way we used
glGetUniformLocation() to get the location of our uniform variables.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LMultiColorPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">void LMultiColorPolygonProgram2D::setVertexPointer( GLsizei stride, const GLvoid* data )
{
    glVertexAttribPointer( mVertexPos2DLocation, 2, GL_FLOAT, GL_FALSE, stride, data );
}

void LMultiColorPolygonProgram2D::setColorPointer( GLsizei stride, const GLvoid* data )
{
    glVertexAttribPointer( mMultiColorLocation, 4, GL_FLOAT, GL_FALSE, stride, data );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The function glVertexAttribPointer() allows us to set the data for an array of attributes, much in the same way we did with glVertexPointer() and glTexCoordPointer(). This generic
function is what we'll use to send our custom vertex attribute data.<br/>
<br/>
The first argument is the location for the attribute you want to set data for. The second argument is how many elements per attributes there are. For the 2D vertex position
there's two elements and for the RGBA color there are 4 elements. The third argument is the data type. The fourth argument says whether you want to normalize the vector data you're
sending. The fifth argument is the stride (which as you'll remember is the space in bytes between each attribute), and the last argument is the address the data pointer is pointing
to.<br/>
<br/>
Our shader program has the wrapper functions setVertexPointer() and setColorPointer() to prevent us from having to write a lot of redundant code.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LMultiColorPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">void LMultiColorPolygonProgram2D::enableVertexPointer()
{
    glEnableVertexAttribArray( mVertexPos2DLocation );
}

void LMultiColorPolygonProgram2D::disableVertexPointer()
{
    glDisableVertexAttribArray( mVertexPos2DLocation );
}

void LMultiColorPolygonProgram2D::enableColorPointer()
{
    glEnableVertexAttribArray( mMultiColorLocation );
}

void LMultiColorPolygonProgram2D::disableColorPointer()
{
    glDisableVertexAttribArray( mMultiColorLocation );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Just like how glVertexPointer() and glTexCoordPointer() had glEnableClientState() and glDisableClientState(), the custom vertex attributes have glEnableVertexAttribArray() and 
glDisableVertexAttribArray() to enable/disable the attributes.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LMultiColorPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">void LMultiColorPolygonProgram2D::setProjection( glm::mat4 matrix )
{
    mProjectionMatrix = matrix;
}

void LMultiColorPolygonProgram2D::setModelView( glm::mat4 matrix )
{
    mModelViewMatrix = matrix;
}

void LMultiColorPolygonProgram2D::leftMultProjection( glm::mat4 matrix )
{
    mProjectionMatrix = matrix * mProjectionMatrix;
}

void LMultiColorPolygonProgram2D::leftMultModelView( glm::mat4 matrix )
{
    mModelViewMatrix = matrix * mModelViewMatrix;
}

void LMultiColorPolygonProgram2D::updateProjection()
{
    glUniformMatrix4fv( mProjectionMatrixLocation, 1, GL_FALSE, glm::value_ptr( mProjectionMatrix ) );
}

void LMultiColorPolygonProgram2D::updateModelView()
{
    glUniformMatrix4fv( mModelViewMatrixLocation, 1, GL_FALSE, glm::value_ptr( mModelViewMatrix ) );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">And the rest of these matrix functions should all look familiar.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">bool loadMedia()
{
    //VBO data
    LMultiColorVertex2D quadVertices[ 4 ];
    GLuint indices[ 4 ];

    //Set quad verticies
    quadVertices[ 0 ].pos.x = -50.f;
    quadVertices[ 0 ].pos.y = -50.f;
    quadVertices[ 0 ].rgba.r = 1.f;
    quadVertices[ 0 ].rgba.g = 0.f;
    quadVertices[ 0 ].rgba.b = 0.f;
    quadVertices[ 0 ].rgba.a = 1.f;

    quadVertices[ 1 ].pos.x =  50.f;
    quadVertices[ 1 ].pos.y = -50.f;
    quadVertices[ 1 ].rgba.r = 1.f;
    quadVertices[ 1 ].rgba.g = 1.f;
    quadVertices[ 1 ].rgba.b = 0.f;
    quadVertices[ 1 ].rgba.a = 1.f;

    quadVertices[ 2 ].pos.x =  50.f;
    quadVertices[ 2 ].pos.y =  50.f;
    quadVertices[ 2 ].rgba.r = 0.f;
    quadVertices[ 2 ].rgba.g = 1.f;
    quadVertices[ 2 ].rgba.b = 0.f;
    quadVertices[ 2 ].rgba.a = 1.f;

    quadVertices[ 3 ].pos.x = -50.f;
    quadVertices[ 3 ].pos.y =  50.f;
    quadVertices[ 3 ].rgba.r = 0.f;
    quadVertices[ 3 ].rgba.g = 0.f;
    quadVertices[ 3 ].rgba.b = 1.f;
    quadVertices[ 3 ].rgba.a = 1.f;

    //Set rendering indices
    indices[ 0 ] = 0;
    indices[ 1 ] = 1;
    indices[ 2 ] = 2;
    indices[ 3 ] = 3;

    //Create VBO
    glGenBuffers( 1, &gVBO );
    glBindBuffer( GL_ARRAY_BUFFER, gVBO );
    glBufferData( GL_ARRAY_BUFFER, 4 * sizeof(LMultiColorVertex2D), quadVertices, GL_STATIC_DRAW );

    //Create IBO
    glGenBuffers( 1, &gIBO );
    glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, gIBO );
    glBufferData( GL_ELEMENT_ARRAY_BUFFER, 4 * sizeof(GLuint), indices, GL_STATIC_DRAW );

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our loadMedia() function we set the vertex position and vertex color attribute data and create the VBO from it.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );

    //Multicolor quad in the center
    gMultiColorPolygonProgram2D.setModelView( glm::translate<GLfloat>( glm::vec3( SCREEN_WIDTH / 2.f, SCREEN_HEIGHT / 2.f, 0.f ) ) );
    gMultiColorPolygonProgram2D.updateModelView();

    //Enable vertex attributes
    gMultiColorPolygonProgram2D.enableVertexPointer();
    gMultiColorPolygonProgram2D.enableColorPointer();

        //Set vertex data
        glBindBuffer( GL_ARRAY_BUFFER, gVBO );
        gMultiColorPolygonProgram2D.setVertexPointer( sizeof(LMultiColorVertex2D), (GLvoid*)offsetof( LMultiColorVertex2D, pos ) );
        gMultiColorPolygonProgram2D.setColorPointer( sizeof(LMultiColorVertex2D), (GLvoid*)offsetof( LMultiColorVertex2D, rgba ) );

        //Draw quad using vertex data and index data
        glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, gIBO );
        glDrawElements( GL_TRIANGLE_FAN, 4, GL_UNSIGNED_INT, NULL );

    //Disable vertex attributes
    gMultiColorPolygonProgram2D.disableVertexPointer();
    gMultiColorPolygonProgram2D.disableColorPointer();

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Finally in the render() function we translate to the center of the screen, enable our attributes for drawing, bind the VBO, set the data pointers in the VBO, draw the quad (using
a triangle fan) and disable the attributes after we're done drawing.<br/>
<br/>
Setting attribute arrays work largely the same as using the fixed function attributes only now you have to specify a location in the shader.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From main.cpp</div>


<pre class="border my-0 py-3">    //Create OpenGL 2.1 context
    glutInitContextVersion( 2, 1 );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Remember this old code snipped that set your OpenGL context version? If your computer supports it, try changing it to 3.1 instead of 2.1. OpenGL 3.1 is when all the old deprecated
functionality was removed from OpenGL. Since our code no longer uses deprecated functionality, it should run the same.<br/>
<br/>
Congratuations, you are now using 100% programmable OpenGL code.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="33_multi-color_polygons_and_attributes.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Multi-Color Polygons and Attributes">Back to Index</a>


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