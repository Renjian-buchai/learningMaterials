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
<meta name="keywords" content="C++ SDL 2 Tutorial 2D Windows Linux Mac copy paste clipboard text input">
<meta name="description" content="Use text input and the clipboard in SDL2.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Text Input And Clipboard Handling</title>

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
    <h1 class="text-center">Text Input And Clipboard Handling</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Text Input And Clipboard Handling screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Nov 26th, 2023</b></p>
    
        Getting text input from the keyboard is a common task in games. Here we'll be getting text using SDL 2's new text input and clipboard handling.

    
    
</div>
                    
                
                    
                        

<pre class="border my-0 py-3">            //Main loop flag
            bool quit = false;

            //Event handler
            SDL_Event e;

            //Set text color as black
            SDL_Color textColor = { 0, 0, 0, 0xFF };

            //The current input text.
            std::string inputText = "Some Text";
            gInputTextTexture.loadFromRenderedText( inputText.c_str(), textColor );

            //Enable text input
            SDL_StartTextInput();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Before we go into the main loop we declare a string to hold our text and render it to a texture. We then call  <a href="http://wiki.libsdl.org/SDL_StartTextInput">SDL_StartTextInput</a> so the SDL text input functionality is
enabled.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //While application is running
            while( !quit )
            {
                //The rerender text flag
                bool renderText = false;

                //Handle events on queue
                while( SDL_PollEvent( &e ) != 0 )
                {
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">We only want to update the input text texture when we need to so we have a flag that keeps track of whether we need to update the texture.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                    //Special key input
                    else if( e.type == SDL_KEYDOWN )
                    {
                        //Handle backspace
                        if( e.key.keysym.sym == SDLK_BACKSPACE && inputText.length() > 0 )
                        {
                            //lop off character
                            inputText.pop_back();
                            renderText = true;
                        }
                        //Handle copy
                        else if( e.key.keysym.sym == SDLK_c && SDL_GetModState() & KMOD_CTRL )
                        {
                            SDL_SetClipboardText( inputText.c_str() );
                        }
                        //Handle paste
                        else if( e.key.keysym.sym == SDLK_v && SDL_GetModState() & KMOD_CTRL )
                        {
                            //Copy text from temporary buffer
                            char* tempText = SDL_GetClipboardText();
                            inputText = tempText;
                            SDL_free( tempText );

                            renderText = true;
                        }
                    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">There are a couple special key presses we want to handle. When the user presses backspace we want to remove the last character from the string.<br/>
<br/>
When the user is holding control and presses c, we want to copy the current text to the clip board using <a href="http://wiki.libsdl.org/SDL_SetClipboardText">SDL_SetClipboardText</a>. You can check if the ctrl key is being
held using <a href="http://wiki.libsdl.org/SDL_GetModState">SDL_GetModState</a>.<br/>
<br/>
When the user does ctrl + v, we want to get the text from the clip board using <a href="http://wiki.libsdl.org/SDL_GetClipboardText">SDL_GetClipboardText</a>. This function returns a newly allocated string, so we should get this
string, copy it to our input text, then free it once we're done with it.<br/>
<br/>
Also notice that whenever we alter the contents of the string we set the text update flag.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                    //Special text input event
                    else if( e.type == SDL_TEXTINPUT )
                    {
                        //Not copy or pasting
                        if( !( SDL_GetModState() & KMOD_CTRL && ( e.text.text[ 0 ] == 'c' || e.text.text[ 0 ] == 'C' || e.text.text[ 0 ] == 'v' || e.text.text[ 0 ] == 'V' ) ) )
                        {
                            //Append character
                            inputText += e.text.text;
                            renderText = true;
                        }
                    }
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">With text input enabled, your key presses will also generate <a href="http://wiki.libsdl.org/SDL_TextInputEvent">SDL_TextInputEvent</a>s which simplifies things like shift key and caps lock. Here we first want to check that
we're not getting a ctrl and c/v event because we want to ignore those since they are already handled as keydown events. If it isn't a copy or paste event, we append the character to our input string.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Rerender text if needed
                if( renderText )
                {
                    //Text is not empty
                    if( inputText != "" )
                    {
                        //Render new text
                        gInputTextTexture.loadFromRenderedText( inputText.c_str(), textColor );
                    }
                    //Text is empty
                    else
                    {
                        //Render space texture
                        gInputTextTexture.loadFromRenderedText( " ", textColor );
                    }
                }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">If the text render update flag has been set, we rerender the texture. One little hack we have here is if we have an empty string, we render a space because SDL_ttf will not render an empty string.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">                //Clear screen
                SDL_SetRenderDrawColor( gRenderer, 0xFF, 0xFF, 0xFF, 0xFF );
                SDL_RenderClear( gRenderer );

                //Render text textures
                gPromptTextTexture.render( ( SCREEN_WIDTH - gPromptTextTexture.getWidth() ) / 2, 0 );
                gInputTextTexture.render( ( SCREEN_WIDTH - gInputTextTexture.getWidth() ) / 2, gPromptTextTexture.getHeight() );

                //Update screen
                SDL_RenderPresent( gRenderer );
            }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">At the end of the main loop we render the prompt text and the input text.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">            //Disable text input
            SDL_StopTextInput();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Once we're done with text input we disable it since enabling text input introduces some overhead.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">

<a href="32_text_input_and_clipboard_handling.zip">Download the media and source code for this demo here.</a><br/>
<br/>








<a href="../index.php#Text Input And Clipboard Handling">Back to Index</a>


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