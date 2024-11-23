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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac modern OpenGL 3 4">
<meta name="description" content="Make modern shader based OpenGL programs in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - SDL and Modern OpenGL</title>

<script src="../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../assets/external-link.svg"></a>
	<a href="../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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
    <h1 class="text-center">SDL and Modern OpenGL</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="SDL and Modern OpenGL screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Oct 13th, 2022</b></p>
    
        With OpenGL 3 there was a massive overhaul that made everything shader based. In this tutorial we'll be rendering a quad using core modern OpenGL.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Using SDL, SDL OpenGL, GLEW, standard IO, and strings
#include &#60SDL.h&#62
#include &#60gl\glew.h&#62
#include &#60SDL_opengl.h&#62
#include &#60gl\glu.h&#62
#include &#60stdio.h&#62
#include &#60string&#62
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">For this tutorial we'll be using the <a href="http://glew.sourceforge.net/">Open<b>GL</b> <b>E</b>xtension <b>W</b>rangler</a>. Certain operating systems like windows only support a limited amount of OpenGL by default. Using
GLEW you can get the latest functionality. If you use GLEW, make sure to include the GLEW header before any OpenGL headers.<br/>
<br/>
GLEW is an extension library and if you can set up any of the SDL extension libraries you can set up GLEW.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Shader loading utility programs
void printProgramLog( GLuint program );
void printShaderLog( GLuint shader );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here are some custom functions we're making to report any errors when making our shader programs.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Graphics program
GLuint gProgramID = 0;
GLint gVertexPos2DLocation = -1;
GLuint gVBO = 0;
GLuint gIBO = 0;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The way modern OpenGL works is that we create shader programs (gProgramID) that process vertex attributes like positions (gVertexPos2DLocation). We put vertices in
<b>V</b>ertex <b>B</b>uffer <b>O</b>bjects (gVBO) and specify the order in which to draw them using <b>I</b>ndex <b>B</b>uffer <b>O</b>bjects.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        //Use OpenGL 3.1 core
        SDL_GL_SetAttribute( SDL_GL_CONTEXT_MAJOR_VERSION, 3 );
        SDL_GL_SetAttribute( SDL_GL_CONTEXT_MINOR_VERSION, 1 );
        SDL_GL_SetAttribute( SDL_GL_CONTEXT_PROFILE_MASK, SDL_GL_CONTEXT_PROFILE_CORE );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we're initializing for a version 3.1 core context. 3.1 core gets rid of all the old functionality. We specify the major and minor version like before and make it a core context by setting the profile mask to core.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Create context
            gContext = SDL_GL_CreateContext( gWindow );
            if( gContext == NULL )
            {
                printf( "OpenGL context could not be created! SDL Error: %s\n", SDL_GetError() );
                success = false;
            }
            else
            {
                //Initialize GLEW
                glewExperimental = GL_TRUE; 
                GLenum glewError = glewInit();
                if( glewError != GLEW_OK )
                {
                    printf( "Error initializing GLEW! %s\n", glewGetErrorString( glewError ) );
                }

                //Use Vsync
                if( SDL_GL_SetSwapInterval( 1 ) < 0 )
                {
                    printf( "Warning: Unable to set VSync! SDL Error: %s\n", SDL_GetError() );
                }

                //Initialize OpenGL
                if( !initGL() )
                {
                    printf( "Unable to initialize OpenGL!\n" );
                    success = false;
                }
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After we create our context we initialize GLEW. Since we want the latest features, we have to set glewExperimental to true. After that we call glewInit() to initialize GLEW.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">bool initGL()
{
    //Success flag
    bool success = true;

    //Generate program
    gProgramID = glCreateProgram();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our initialization function we're going to create our shader program to render with along with the VBO and IBO data.<br/>
<br/>
If you've never worked with OpenGL shaders, this function is probably going to go over your head. It's OK because this tutorial is about how to use SDL's 3.0+ context controls, not
so much the detail about how OpenGL 3.0+ works. Just try to get a general idea on how a shader works.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Create vertex shader
    GLuint vertexShader = glCreateShader( GL_VERTEX_SHADER );

    //Get vertex source
    const GLchar* vertexShaderSource[] =
    {
        "#version 140\nin vec2 LVertexPos2D; void main() { gl_Position = vec4( LVertexPos2D.x, LVertexPos2D.y, 0, 1 ); }"
    };

    //Set vertex source
    glShaderSource( vertexShader, 1, vertexShaderSource, NULL );

    //Compile vertex source
    glCompileShader( vertexShader );

    //Check vertex shader for errors
    GLint vShaderCompiled = GL_FALSE;
    glGetShaderiv( vertexShader, GL_COMPILE_STATUS, &vShaderCompiled );
    if( vShaderCompiled != GL_TRUE )
    {
        printf( "Unable to compile vertex shader %d!\n", vertexShader );
        printShaderLog( vertexShader );
        success = false;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we are loading a vertex shader from an in code source. If the vertex shader failed to load and compile we use our log printing function to spit out the error.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    else
    {
        //Attach vertex shader to program
        glAttachShader( gProgramID, vertexShader );


        //Create fragment shader
        GLuint fragmentShader = glCreateShader( GL_FRAGMENT_SHADER );

        //Get fragment source
        const GLchar* fragmentShaderSource[] =
        {
            "#version 140\nout vec4 LFragment; void main() { LFragment = vec4( 1.0, 1.0, 1.0, 1.0 ); }"
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
            success = false;
        }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">If the vertex shader loaded successfully we attach it to the program and then compile the fragment shader.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        else
        {
            //Attach fragment shader to program
            glAttachShader( gProgramID, fragmentShader );


            //Link program
            glLinkProgram( gProgramID );

            //Check for errors
            GLint programSuccess = GL_TRUE;
            glGetProgramiv( gProgramID, GL_LINK_STATUS, &programSuccess );
            if( programSuccess != GL_TRUE )
            {
                printf( "Error linking program %d!\n", gProgramID );
                printProgramLog( gProgramID );
                success = false;
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">If the fragment shader compiled, we attach it to the shader program and link it.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            else
            {
                //Get vertex attribute location
                gVertexPos2DLocation = glGetAttribLocation( gProgramID, "LVertexPos2D" );
                if( gVertexPos2DLocation == -1 )
                {
                    printf( "LVertexPos2D is not a valid glsl program variable!\n" );
                    success = false;
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">If the program linked successfully we then get the attribute from the shader program so we can send it vertex data.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                else
                {
                    //Initialize clear color
                    glClearColor( 0.f, 0.f, 0.f, 1.f );

                    //VBO data
                    GLfloat vertexData[] =
                    {
                        -0.5f, -0.5f,
                         0.5f, -0.5f,
                         0.5f,  0.5f,
                        -0.5f,  0.5f
                    };

                    //IBO data
                    GLuint indexData[] = { 0, 1, 2, 3 };

                    //Create VBO
                    glGenBuffers( 1, &gVBO );
                    glBindBuffer( GL_ARRAY_BUFFER, gVBO );
                    glBufferData( GL_ARRAY_BUFFER, 2 * 4 * sizeof(GLfloat), vertexData, GL_STATIC_DRAW );

                    //Create IBO
                    glGenBuffers( 1, &gIBO );
                    glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, gIBO );
                    glBufferData( GL_ELEMENT_ARRAY_BUFFER, 4 * sizeof(GLuint), indexData, GL_STATIC_DRAW );
                }
            }
        }
    }
    
    return success;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After we get the shader program working, we create the VBO and IBO. As you can see, the VBO has the same positions as the quad from the last tutorial.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void printProgramLog( GLuint program )
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

void printShaderLog( GLuint shader )
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


    <div class="container border-start border-end border-bottom py-3 mb-3">Here are our log printing functions. These grab the shader log from the given shader or program and spit it out to the console.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void render()
{
    //Clear color buffer
    glClear( GL_COLOR_BUFFER_BIT );
    
    //Render quad
    if( gRenderQuad )
    {
        //Bind program
        glUseProgram( gProgramID );

        //Enable vertex position
        glEnableVertexAttribArray( gVertexPos2DLocation );

        //Set vertex data
        glBindBuffer( GL_ARRAY_BUFFER, gVBO );
        glVertexAttribPointer( gVertexPos2DLocation, 2, GL_FLOAT, GL_FALSE, 2 * sizeof(GLfloat), NULL );

        //Set index data and render
        glBindBuffer( GL_ELEMENT_ARRAY_BUFFER, gIBO );
        glDrawElements( GL_TRIANGLE_FAN, 4, GL_UNSIGNED_INT, NULL );

        //Disable vertex position
        glDisableVertexAttribArray( gVertexPos2DLocation );

        //Unbind program
        glUseProgram( NULL );
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our rendering function, we bind our shader program, enable vertex positions, bind the VBO, set the data offset, bind the IBO, and draw the quad as a triangle fan. Once we're done we disable the vertex attribute and unbind
the program.<br/>
<br/>
Again this tutorial is more for people with some OpenGL experience that want to know how to switch over to core functionality. The fact is that this code will work with an OpenGL 2.1 context as well as a 3.0 context (Well,
except for the shader code because OpenGL 2.1 only supports up to #version 120). Core OpenGL just removes OpenGL calls that don't reflect modern hardware.<br/>
<br/>
If you want to learn more about modern opengl, I have <a href="../../OpenGL/index.php#Hello GLSL">OpenGL shader tutorials</a> too.<br/>
<br/>
Also, I get e-mails of how this code is broken because if you set the version to 3.2+ it won't work because it doesn't use vertex array objects (or VAOs). The thing is this code works fine for version 3.1 core, which it is
designed to be. However, OpenGL 3.2+ requires you create a VAO. Fortunately I cover VAOs in the OpenGL tutorial.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="51_SDL_and_modern_opengl.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#SDL and Modern OpenGL">Back to Index</a>


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
	<a href="../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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