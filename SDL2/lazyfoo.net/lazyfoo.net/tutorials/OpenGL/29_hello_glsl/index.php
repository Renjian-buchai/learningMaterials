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
<meta name="keywords" content="C++ OpenGL 3.0 Tutorial 2D Windows Linux Mac GLSL shader">
<meta name="description" content="Learn to create GLSL shader programs.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Hello GLSL</title>

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
    <h1 class="text-center">Hello GLSL</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Hello GLSL screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
        Up until now we've been using the old Fixed Function Pipeline which did all our vertex operations (glTranslate(), glVertex(), glTexCoord(), etc) and fragment operations
(I'll show you those in a little bit) for us. This was nice when you're a beginner and you're not doing anything complicated, but when you need power and flexibility
the fixed function pipeline is constraining.<br/>
<br/>
Enter GLSL (Open<b>GL</b> <b>S</b>hading <b>L</b>anguage) and the Programmable Pipeline. With GLSL, you can give your OpenGL program executable shader programs which
control how your GPU handles the data you send it. The GLSL Programmable Pipeline can do everything the Fixed Function Pipeline can do and more which made the FFP obsolete.
With the release of OpenGL 3.0+, the fixed function pipeline is deprecated and if you want to do any rendering you need to tell the GPU how to handle your data with
GLSL.<br/>
<br/>
Why didn't the tutorial set start off with the Programmable Pipeline? Because as you're about to see it takes significantly more work to get a GLSL shader program going.
This tutorial will get you off the ground by creating your first GLSL shader program.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From main.cpp</div>


<pre class="border my-0 py-3">    //Do post window/context creation initialization
    if( !initGL() )
    {
        printf( "Unable to initialize graphics library!\n" );
        return 1;
    }

    //Load graphics programs
    if( !loadGP() )
    {
        printf( "Unable to load shader programs!\n" );
        return 1;
    }

    //Load media
    if( !loadMedia() )
    {
        printf( "Unable to load media!\n" );
        return 2;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In this tutorial and future ones we'll loading shader programs. Shader programs control how our OpenGL program operates, so they could be loaded in the initGL() function. In
future tutorials we'll be loading text shader files so they could be loaded in the loadMedia() function.<br/>
<br/>
Because graphics programs are so unique, they'll get their own loading function loadGP().
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LShaderProgram.h</div>


<pre class="border my-0 py-3">class LShaderProgram
{
    public:
        LShaderProgram();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Initializes variables
        Side Effects:
         -None
        */

        virtual ~LShaderProgram();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Frees shader program
        Side Effects:
         -None
        */

        virtual bool loadProgram() = 0;
        /*
        Pre Condition:
         -A valid OpenGL context
        Post Condition:
         -Loads shader program
        Side Effects:
         -None
        */

        virtual void freeProgram();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Frees shader program if it exists
        Side Effects:
         -None
        */

        bool bind();
        /*
        Pre Condition:
         -A loaded shader program
        Post Condition:
         -Sets this program as the current shader program
         -Reports to console if there was an error
        Side Effects:
         -None
        */

        void unbind();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Sets default shader program as current program
        Side Effects:
         -None
        */

        GLuint getProgramID();
        /*
        Pre Condition:
         -None
        Post Condition:
         -Returns program ID
        Side Effects:
         -None
        */

    protected:
        void printProgramLog( GLuint program );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Prints program log
         -Reports error is GLuint ID is not a shader program
        Side Effects:
         -None
        */

        void printShaderLog( GLuint shader );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Prints shader log
         -Reports error is GLuint ID is not a shader
        Side Effects:
         -None
        */

        //Program ID
        GLuint mProgramID;
};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the overview of the LShaderProgram class which will serve as the base class for all of our shader programs.<br/>
<br/>
Don't obsess with the details of the class too much for now, but take notice of the "mProgramID" member variable. Just like we bind texture IDs and VBO IDs to use them, we'll be
binding shader program IDs to use them.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LShaderProgram.cpp</div>


<pre class="border my-0 py-3">LShaderProgram::LShaderProgram()
{
    mProgramID = NULL;
}

LShaderProgram::~LShaderProgram()
{
    //Free program if it exists
    freeProgram();
}

void LShaderProgram::freeProgram()
{
    //Delete program
    glDeleteProgram( mProgramID );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The constructor for LShaderProgram just initializes the ID to 0. The destructor just calls freeProgram() which just calls glDeleteProgram() to delete the program much in the same
way we would call glDeleteTextures() to delete a texture.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LShaderProgram.cpp</div>


<pre class="border my-0 py-3">bool LShaderProgram::bind()
{
    //Use shader
    glUseProgram( mProgramID );

    //Check for error
    GLenum error = glGetError();
    if( error != GL_NO_ERROR )
    {
        printf( "Error binding shader! %s\n", gluErrorString( error ) );
        printProgramLog( mProgramID );
        return false;
    }

    return true;
}

void LShaderProgram::unbind()
{
    //Use default program
    glUseProgram( NULL );
}

GLuint LShaderProgram::getProgramID()
{
    return mProgramID;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">To bind a shader program for use, we call glUseProgram() on the program ID. To make sure the shader program bound successfully, we check if there were any errors using
glGetError(). If there were errors, we report them to the console. If there were no errors we return true.<br/>
<br/>
To unbind the current shader program, we just bind a null ID. On OpenGL 2.1, this will cause the old fixed function pipeline to be used. In the post OpenGL 3.0 world, binding a
NULL shader will cause nothing to be rendered because there's no fixed function pipeline.<br/>
<br/>
Lastly, we have a function to get the program ID.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LShaderProgram.cpp</div>


<pre class="border my-0 py-3">void LShaderProgram::printProgramLog( GLuint program )
{
    //Make sure name is shader
    if( glIsProgram( program ) )
    {
        //Program log length
        int infoLogLength = 0;
        int maxLength = infoLogLength;

        //Get info string length
        glGetProgramiv( program, GL_INFO_LOG_LENGTH, &maxLength );

        //Allocate string
        char* infoLog = new char[ maxLength ];

        //Get info log
        glGetProgramInfoLog( program, maxLength, &infoLogLength, infoLog );
        if( infoLogLength > 0 )
        {
            //Print Log
            printf( "%s\n", infoLog );
        }

        //Deallocate string
        delete[] infoLog;
    }
    else
    {
        printf( "Name %d is not a program\n", program );
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now getting a GLSL shader program working requires quite a bit of communication with the GPU and we need to be able to print the GLSL shader program logs to know if something goes
wrong. This information is vital when trying to debug your GLSL shader program.<br/>
<br/>
First we want to check if the ID we gave it was even a shader program using glIsProgram(). If it is, we check to find out how long the info log is in characters using glGetProgramiv().
Then we allocate the needed character string and get the actual program info log using glGetProgramInfoLog(). If the info log is longer than 0 characters (which means one actually
exists) we print it out to the console. After we'll done with the program log, we deallocate the string.<br/>
<br/>
Now if the ID was not even a program, we print an error to the console.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LShaderProgram.cpp</div>


<pre class="border my-0 py-3">void LShaderProgram::printShaderLog( GLuint shader )
{
    //Make sure name is shader
    if( glIsShader( shader ) )
    {
        //Shader log length
        int infoLogLength = 0;
        int maxLength = infoLogLength;

        //Get info string length
        glGetShaderiv( shader, GL_INFO_LOG_LENGTH, &maxLength );

        //Allocate string
        char* infoLog = new char[ maxLength ];

        //Get info log
        glGetShaderInfoLog( shader, maxLength, &infoLogLength, infoLog );
        if( infoLogLength > 0 )
        {
            //Print Log
            printf( "%s\n", infoLog );
        }

        //Deallocate string
        delete[] infoLog;
    }
    else
    {
        printf( "Name %d is not a shader\n", shader );
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we have printShaderLog() which prints out the log for a shader pretty much in the same way printProgramLog() prints out the info for a program.<br/>
<br/>
You're probably wondering what's the difference between a shader and a program. A shader controls part of your graphics pipeline. A vertex shader controls how to process vertex
data and a fragment shader controls fragment operations. The program has a vertex shader and a fragment shader attached to it (and maybe other shaders like a geometry shader).
With the shaders attached to it, the shader program controls how data is rendered.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.h</div>


<pre class="border my-0 py-3">#include "LShaderProgram.h"

class LPlainPolygonProgram2D : public LShaderProgram
{
    public:
        bool loadProgram();
        /*
        Pre Condition:
         -A valid OpenGL context
        Post Condition:
         -Loads plain polygon program
        Side Effects:
         -None
        */

    private:

};
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we have the LPlainPolygonProgram2D shader program class. The only current difference between the base class is that it has a function defined to load a shader program.<br/>
<br/>
Now that you seen the overall structure of these shader program classes, it's time to build your first shader.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">>bool LPlainPolygonProgram2D::loadProgram()
{
    //Success flag
    GLint programSuccess = GL_TRUE;

    //Generate program
    mProgramID = glCreateProgram();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of the loadProgram() function we allocate a shader program ID using glCreateProgram(). A shader program isn't very useful without some vertex or fragment operation
attached to it. So let's start attaching some shaders.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">    //Create vertex shader
    GLuint vertexShader = glCreateShader( GL_VERTEX_SHADER );

    //Get vertex source
    const GLchar* vertexShaderSource[] =
    {
        "void main() { gl_Position = gl_Vertex; }"
    };

    //Set vertex source
    glShaderSource( vertexShader, 1, vertexShaderSource, NULL );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Ok here we allocate a vertex shader ID using glCreateShader() with the GL_VERTEX_SHADER argument. Then we have some GLSL source code put directly into an array of strings named
"vertexShaderSource". We then set the source code for the vertex shader using glShaderSource().<br/>
<br/>
The first argument is the vertex shader ID. The second argument is how many source strings you're using. Caution: the GLSL compiler expects one long string per source file. Much
like in C++, you can have more than one source file per shader. However, it will treat each string in the array as a source file.<br/>
<br/>
The third argument is the pointer to the array of shader source strings. The last argument is the array of string lengths for each of the shader source strings. If this is null,
the GLSL source compiler assumes each string is null terminated.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">    //Compile vertex source
    glCompileShader( vertexShader );

    //Check vertex shader for errors
    GLint vShaderCompiled = GL_FALSE;
    glGetShaderiv( vertexShader, GL_COMPILE_STATUS, &vShaderCompiled );
    if( vShaderCompiled != GL_TRUE )
    {
        printf( "Unable to compile vertex shader %d!\n", vertexShader );
        printShaderLog( vertexShader );
        return false;
    }

    //Attach vertex shader to program
    glAttachShader( mProgramID, vertexShader );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">With the vertex shader source code set for the vertex shader, we compile the shader using glCompileShader().<br/>
<br/>
After compiling, we need to check if there were any errors in compilation. Using glGetShaderiv(), we get the GL_COMPILE_STATUS. If the shader failed to compile, we output the log
to use for debugging.<br/>
<br/>
If the vertex shader compiled successfully, we attach the vertex shader to our program.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">    //Create fragment shader
    GLuint fragmentShader = glCreateShader( GL_FRAGMENT_SHADER );

    //Get fragment source
    const GLchar* fragmentShaderSource[] =
    {
        "void main() { gl_FragColor = vec4( 1.0, 0.0, 0.0, 1.0 ); }"
    };

    //Set fragment source
    glShaderSource( fragmentShader, 1, fragmentShaderSource, NULL );

    //Compile fragment source
    glCompileShader( fragmentShader );

    //Check fragment shader for errors
    GLint fShaderCompiled = GL_FALSE;
    glGetShaderiv( fragmentShader, GL_COMPILE_STATUS, &fShaderCompiled );
    if( fShaderCompiled != GL_TRUE )
    {
        printf( "Unable to compile fragment shader %d!\n", fragmentShader );
        printShaderLog( fragmentShader );
        return false;
    }

    //Attach fragment shader to program
    glAttachShader( mProgramID, fragmentShader );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we compile and attach the fragment shader much in the same way we did with the vertex shader. Do make a note of the fact that the GLSL shader code is different for the
fragment shader. This is obviously because vertices and fragments are two different things that require different operations.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">    //Link program
    glLinkProgram( mProgramID );

    //Check for errors
    glGetProgramiv( mProgramID, GL_LINK_STATUS, &programSuccess );
    if( programSuccess != GL_TRUE )
    {
        printf( "Error linking program %d!\n", mProgramID );
        printProgramLog( mProgramID );
        return false;
    }

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">With both the vertex and fragment shaders attached to the shader program, we link the program. Vertex and fragment shaders typically have to have data sent between them so the
linking process makes sure the shaders play nice with each other.<br/>
<br/>
Like with compilation, we use glGetProgramiv() to make sure the program linked properly. If it did, it means our program is ready to be used.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LUtil.cpp</div>


<pre class="border my-0 py-3">//Basic shader
LPlainPolygonProgram2D gPlainPolygonProgram2D;

bool initGL()
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

    //Initialize Projection Matrix
    glMatrixMode( GL_PROJECTION );
    glLoadIdentity();
    glOrtho( 0.0, SCREEN_WIDTH, SCREEN_HEIGHT, 0.0, 1.0, -1.0 );

    //Initialize Modelview Matrix
    glMatrixMode( GL_MODELVIEW );
    glLoadIdentity();

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


    <div class="container border-start border-end border-bottom py-3 mb-3">At the top of LUtil.cpp we declare a shader object for us to use.<br/>
<br/>
Make sure to notice how initGL() is the same as it used to be. It'll be an important thing to know when we get to rendering.
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

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In the loadGP() function, we load the LPlainPolygonProgram2D and bind it for use.
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
    glBegin( GL_QUADS );
        glColor3f( 0.f, 1.f, 1.f );
        glVertex2f( -50.f, -50.f );
        glVertex2f(  50.f, -50.f );
        glVertex2f(  50.f,  50.f );
        glVertex2f( -50.f,  50.f );
    glEnd();

    //Update screen
    glutSwapBuffers();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our render function, we have the code to render a cyan quad in the center of the screen. Yet for some reason, when this demo program compiles and runs we get this:
<div class="text-center"><img class="img-fluid" alt="preview" src="preview.png"></div>
<br/>
Why? Let's look at the shader source code we gave the shaders.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Vertex Shader Source</div>


<pre class="border my-0 py-3">void main()
{
    gl_Position = gl_Vertex;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is the GLSL code for the vertex shader. Even if you've never seen the GLSL documentation, its C like syntax should be easy to pick up on the fly.<br/>
<br/>
Notice how the final position of the vertex is the same as the vertex we took in. We never multiplied against the projection or modelview matrices so glOrtho(), glTranslate(),
and our other OpenGL matrix calls have no effect and the quad we rendered uses untransformed matrix coordinates. This is what we mean by programmable pipeline because you program
how the GPU pipeline processes the data.<br/>
<br/>
So because the vertices are untransformed, the quad will consume the entire screen as opposed to being 100 pixels wide in the center.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From Fragment Shader Source</div>


<pre class="border my-0 py-3">void main()
{
   gl_FragColor = vec4( 1.0, 0.0, 0.0, 1.0 );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the fragment shader and the reason the quad is red as opposed to cyan. In the fragment shader we don't take into account the color attribute and just set the output fragment
to be red 1, green 0, blue 0, and alpha 1. While it appears strange how the OpenGL program behaved, it was only doing what we told it to do.<br/>
<br/>
This is the power of shaders. By giving control to the programmer how the graphics data is processed you can achieve the powerful effects you see in modern games, or something
completely pointless like untransformed red geometry =).
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="29_hello_glsl.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Hello GLSL">Back to Index</a>


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