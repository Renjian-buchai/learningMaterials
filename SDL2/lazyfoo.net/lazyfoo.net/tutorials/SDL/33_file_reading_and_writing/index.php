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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac binary file reading writing game saves">
<meta name="description" content="Load and save binary files in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - File Reading and Writing</title>

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
    <h1 class="text-center">File Reading and Writing</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="File Reading and Writing screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Apr 10th, 2022</b></p>
    
        Being able to save and load data is needed to keep data between play sessions. SDL_RWops file handling allows us to do cross platform file IO to save data.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Data points
Sint32 gData[ TOTAL_DATA ];
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here we're declaring an array of <b>S</b>igned <b>int</b>egers that are <b>32</b> bits long. This will be the data we will be loading and saving. For this demo this array will be of length 10.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Open file for reading in binary
    SDL_RWops* file = SDL_RWFromFile( "33_file_reading_and_writing/nums.bin", "r+b" );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">In our media loading function we're opening the save file for reading using <a href="http://wiki.libsdl.org/SDL_RWFromFile">SDL_RWFromFile</a>. The first argument is the path to the file and the second argument defines how we
will be opening it. "r+b" means it is being opened for reading in binary.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //File does not exist
    if( file == NULL )
    {
        printf( "Warning: Unable to open file! SDL Error: %s\n", SDL_GetError() );
        
        //Create file for writing
        file = SDL_RWFromFile( "33_file_reading_and_writing/nums.bin", "w+b" );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now if the file does not exist that doesn't exactly mean an error. It could mean this is the first time the program has run and the file has not been created yet. If the file does not exist we prompt a warning and create a
file by opening a file with "w+b". This will open a new file for writing in binary.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">        if( file != NULL )
        {
            printf( "New file created!\n" );

            //Initialize data
            for( int i = 0; i < TOTAL_DATA; ++i )
            {
                gData[ i ] = 0;    
                SDL_RWwrite( file, &gData[ i ], sizeof(Sint32), 1 );
            }
            
            //Close file handler
            SDL_RWclose( file );
        }
        else
        {
            printf( "Error: Unable to create file! SDL Error: %s\n", SDL_GetError() );
            success = false;
        }
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">If a new file was created successfully we then start writing the initialized data to it using <a href="http://wiki.libsdl.org/SDL_RWwrite">SDL_RWwrite</a>. The first argument is the file we're writing to, the second argument
is the address of the objects in memory we're writing, the third argument is the number of bytes per object we're writing, and the last one is the number of objects we're writing. After we're done writing out all the objects,
we close the file for writing using <a href="http://wiki.libsdl.org/SDL_RWclose">SDL_RWclose</a>.<br/>
<br/>
If the file was never created in the first place, we report an error to the console and set the success flag to false.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //File exists
    else
    {
        //Load data
        printf( "Reading file...!\n" );
        for( int i = 0; i < TOTAL_DATA; ++i )
        {
            SDL_RWread( file, &gData[ i ], sizeof(Sint32), 1 );
        }

        //Close file handler
        SDL_RWclose( file );
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now if our file loaded successfully on the first try, all we have to do is reading in the data using <a href="http://wiki.libsdl.org/SDL_RWread">SDL_RWread</a>, which basically functions like SDL_RWwrite but in reverse.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Initialize data textures
    gDataTextures[ 0 ].loadFromRenderedText( std::to_string( gData[ 0 ] ), highlightColor );
    for( int i = 1; i < TOTAL_DATA; ++i )
    {
        gDataTextures[ i ].loadFromRenderedText( std::to_string( gData[ i ] ), textColor );
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">After the file is loaded we render the text textures that correspond with each of our data numbers. Our <a href="../16_true_type_fonts/index.php">loadFromRenderedText</a> function only accepts strings so we have to convert the
integers to strings.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void close()
{
    //Open data for writing
    SDL_RWops* file = SDL_RWFromFile( "33_file_reading_and_writing/nums.bin", "w+b" );
    if( file != NULL )
    {
        //Save data
        for( int i = 0; i < TOTAL_DATA; ++i )
        {
            SDL_RWwrite( file, &gData[ i ], sizeof(Sint32), 1 );
        }

        //Close file handler
        SDL_RWclose( file );
    }
    else
    {
        printf( "Error: Unable to save file! %s\n", SDL_GetError() );
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When we close the program, we open up the file again for writing and write out all the data.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Main loop flag
            bool quit = false;

            //Event handler
            SDL_Event e;

            //Text rendering color
            SDL_Color textColor = { 0, 0, 0, 0xFF };
            SDL_Color highlightColor = { 0xFF, 0, 0, 0xFF };

            //Current input point
            int currentData = 0;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Before we go into the main loop we declare currentData to keep track of which of our data integers we're altering. We also declare a plain text color and a highlight color for rendering text.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                    else if( e.type == SDL_KEYDOWN )
                    {
                        switch( e.key.keysym.sym )
                        {
                            //Previous data entry
                            case SDLK_UP:
                            //Rerender previous entry input point
                            gDataTextures[ currentData ].loadFromRenderedText( std::to_string( gData[ currentData ] ), textColor );
                            --currentData;
                            if( currentData < 0 )
                            {
                                currentData = TOTAL_DATA - 1;
                            }
                            
                            //Rerender current entry input point
                            gDataTextures[ currentData ].loadFromRenderedText( std::to_string( gData[ currentData ] ), highlightColor );
                            break;
                            
                            //Next data entry
                            case SDLK_DOWN:
                            //Rerender previous entry input point
                            gDataTextures[ currentData ].loadFromRenderedText( std::to_string( gData[ currentData ] ), textColor );
                            ++currentData;
                            if( currentData == TOTAL_DATA )
                            {
                                currentData = 0;
                            }
                            
                            //Rerender current entry input point
                            gDataTextures[ currentData ].loadFromRenderedText( std::to_string( gData[ currentData ] ), highlightColor );
                            break;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When we press up or down we want to rerender the the old current data in plain color, move to the next data point (with some bounds checking), and rerender the new current data in the highlight color.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                            //Decrement input point
                            case SDLK_LEFT:
                            --gData[ currentData ];
                            gDataTextures[ currentData ].loadFromRenderedText( std::to_string( gData[ currentData ] ), highlightColor );
                            break;
                            
                            //Increment input point
                            case SDLK_RIGHT:
                            ++gData[ currentData ];
                            gDataTextures[ currentData ].loadFromRenderedText( std::to_string( gData[ currentData ] ), highlightColor );
                            break;
                        }
                    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">When we press left or right we decrement or increment the current data and rerender the texture associated with it.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render text textures
                gPromptTextTexture.render( ( SCREEN_WIDTH - gPromptTextTexture.getWidth() ) / 2, 0 );
                for( int i = 0; i < TOTAL_DATA; ++i )
                {
                    gDataTextures[ i ].render( ( SCREEN_WIDTH - gDataTextures[ i ].getWidth() ) / 2, gPromptTextTexture.getHeight() + gDataTextures[ 0 ].getHeight() * i );
                }

                //Update screen
                SDL_RenderPresent( gRenderer );
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the end of the main loop we render all the textures to the screen.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="33_file_reading_and_writing.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#File Reading and Writing">Back to Index</a>


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