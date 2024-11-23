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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac GLSL shader text txt">
<meta name="description" content="Learn to load GLSL shaders from a text file.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Loading Text File Shaders</title>

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
    <h1 class="text-center">Loading Text File Shaders</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Loading Text File Shaders screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Oct 19th, 2014</b></p>
    
        In the last tutorial we hard coded the GLSL shader code in our OpenGL application for the sake of simplicity. But when you're trying to develop a shader program,
having to recompile your application each time to make changes gets to be a pain. In this tutorial, our OpenGL application will load the GLSL source code on the fly.

    
    
</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LShaderProgram.h</div>


<pre class="border my-0 py-3">        GLuint loadShaderFromFile( std::string path, GLenum shaderType );
        /*
        Pre Condition:
         -None
        Post Condition:
         -Returns the ID of a compiled shader of the specified type from the specified file
         -Reports error to console if file could not be found or compiled
        Side Effects:
         -None
        */
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The base shader class gets a new function to load a text GLSL source file and compile it to the type of shader you want (vertex, fragment, geometry, etc).
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LShaderProgram.cpp</div>


<pre class="border my-0 py-3">GLuint LShaderProgram::loadShaderFromFile( std::string path, GLenum shaderType )
{
    //Open file
    GLuint shaderID = 0;
    std::string shaderString;
    std::ifstream sourceFile( path.c_str() );

    //Source file loaded
    if( sourceFile )
    {
        //Get shader source
        shaderString.assign( ( std::istreambuf_iterator< char >( sourceFile ) ), std::istreambuf_iterator< char >() );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">To compile a text source file at runtime, you need to get the text from the file as a single string. After opening the file as an ifstream, we can use the input stream buffer
iterator to read it in as one line.<br/>
<br/>
The standard string function assign() just gives the string a value. The first argument tells it to start reading the source file from the beginning. The second argument tells it
to keep reading the source file until it encounters a null character.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LShaderProgram.cpp</div>


<pre class="border my-0 py-3">        //Create shader ID
        shaderID = glCreateShader( shaderType );

        //Set shader source
        const GLchar* shaderSource = shaderString.c_str();
        glShaderSource( shaderID, 1, (const GLchar**)&shaderSource, NULL );

        //Compile shader source
        glCompileShader( shaderID );

        //Check shader for errors
        GLint shaderCompiled = GL_FALSE;
        glGetShaderiv( shaderID, GL_COMPILE_STATUS, &shaderCompiled );
        if( shaderCompiled != GL_TRUE )
        {
            printf( "Unable to compile shader %d!\n\nSource:\n%s\n", shaderID, shaderSource );
            printShaderLog( shaderID );
            glDeleteShader( shaderID );
            shaderID = 0;
        }
    }
    else
    {
        printf( "Unable to open file %s\n", path.c_str() );
    }

    return shaderID;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The rest of this function should all look familiar because it's a generalized version of the vertex/fragment shader compilation code from the last tutorial.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.cpp</div>


<pre class="border my-0 py-3">bool LPlainPolygonProgram2D::loadProgram()
{
    //Generate program
    mProgramID = glCreateProgram();

    //Load vertex shader
    GLuint vertexShader = loadShaderFromFile( "30_loading_text_file_shaders/LPlainPolygonProgram2D.glvs", GL_VERTEX_SHADER );

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
    GLuint fragmentShader = loadShaderFromFile( "30_loading_text_file_shaders/LPlainPolygonProgram2D.glfs", GL_FRAGMENT_SHADER );

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

    return true;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we have the shader program loading code with our new condensed vertex shader loading function.<br/>
<br/>
You'll see that source file for the vertex shader is LPlainPolygonProgram2D.glvs. The source file has the matching file name LPlainPolygonProgram2D.glvs because it makes it easier
to keep track of the files. The extensions glvs and glfs correspond to the vertex and fragment shader also because it makes the files easier to manage. The file name and extension
don't mean anything to the program because it just assumes they're ASCII text anyways.<br/>
<br/>
About the calls to glDeleteShader(): you'll notice that if the fragment shader load fails we delete the vertex shader because it's useless to us if the fragment shader doesn't 
compile. We delete the vertex and the fragment shader if they fail to link because if they don't link they're useless on their own. What you may think is strange is that we delete
the vertex and fragment shader if the program links successfully. Don't worry, all we're deleting when we delete a shader from an existing program is the spare references to the
shaders. The OpenGL context is smart enough to know that if a shader program is using the shader to not delete it. 
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

bool loadMedia()
{
    return true;
}

void update()
{

}

void render()
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


    <div class="container border-start border-end border-bottom py-3 mb-3">As you can see our main functions haven't changed much yet we get this when we run the program:
<div class="text-center"><img class="img-fluid" alt="preview" src="preview.png"></div>
<br/>
Let's look at our GLSL source files to see why.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.glvs</div>


<pre class="border my-0 py-3">void main()
{
    //Process vertex
    gl_Position = gl_Vertex;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">So it looks like we're still using untranformed vertices to render.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3">From LPlainPolygonProgram2D.glfs</div>


<pre class="border my-0 py-3">void main()
{
    //Set fragment
    gl_FragColor = vec4( 0.0, 1.0, 0.0, 1.0 );
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">And the reason it's green now is because all fragments are getting the value red 0, green 1, blue 0, and alpha 1. Fortunately now we can mess with the GLSL code without a recompile.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="30_loading_text_file_shaders.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Loading Text File Shaders">Back to Index</a>


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