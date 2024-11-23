<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" 
"http://www.w3.org/TR/REC-html40/strict.dtd">
<html>

<head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VP5RSQ168Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VP5RSQ168Y');
</script>



<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">

<META NAME=KEYWORDS CONTENT="Lazy Foo' Productions C++ SDL Window Linux Mac Game Programming Tutorials">

<META NAME=DESCRIPTION CONTENT="Tutorials for those who want to start making video games.">

<title>Lazy Foo' Productions</title>

<link REL="stylesheet" TYPE="text/css" href="../lazy.css">
</head>

<body>

<div class="header">
<h1 style="margin-bottom:0px;padding-bottom:0px;border-bottom:0px;">Lazy Foo' Productions</h1>

<div class="nav">
Yes, I am keeping the old tutorial set in the old layout for the sake of having a nostalgic eater egg. It's not because I am too lazy to port this over to the data driven static site generator.<br/>
<br/>
<a class="nav" href="https://discourse.libsdl.org/">SDL Forums</a>
<a class="nav" href="../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../articles/index.php">Articles</a>
<a class="nav" href="../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../index.php">News</a>
<a class="nav" href="../../faq.php">FAQs</a>
<a class="nav" href="../../contact.php">Contact</a>
<a class="nav" href="../../donate.php">Donations</a><br/>
<br/>

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

</div>

</div>

<div class="content">
<div class="tutPreface"><h1 class="tutHead">Getting String Input</h1>
<div class="tutImg"><img src="preview.jpg"></div>
<h6>Last Updated 3/28/10</h6>
Here we need to get the player's name after they got a high score. Back in your early days, you used cin to get
string input. Since SDL has no built in ways of getting the user's name, we'll make our own function to handle
keypresses to get string input.<br/>
<br/>
A <a class="tutLink" href="../../tutorials/SDL/32_text_input_and_clipboard_handling/index.php">Text Input and Clipboard Handling tutorial with SDL 2</a> is now available.
</div>

<div class="tutCode">//The key press interpreter
class StringInput
{
    private:
    //The storage string
    std::string str;
    
    //The text surface
    SDL_Surface *text;
    
    public:
    //Initializes variables
    StringInput();
    
    //Does clean up
    ~StringInput();
    
    //Handles input
    void handle_input();
    
    //Shows the message on screen
    void show_centered();    
};
</div>

<div class="tutText">
Here's is our class used to manage string input.<br>
<br>
In terms of variables we have a string for the actual string data and a surface to render the text to.<br>
<br>
Then we have our constructors and destructors, the function handle_input() to deal with user input, and
show_centered() to make the string appear on the screen.
</div>

<div class="tutCode">StringInput::StringInput()
{
    //Initialize the string
    str = "";
    
    //Initialize the surface
    text = NULL;
    
    //Enable Unicode
    SDL_EnableUNICODE( SDL_ENABLE );    
}

StringInput::~StringInput()
{
    //Free text surface
    SDL_FreeSurface( text );
    
    //Disable Unicode
    SDL_EnableUNICODE( SDL_DISABLE );  
}
</div>

<div class="tutText">
In the constructor along with a variable initialization, we enable unicode with SDL_EnableUNICODE().
This will make getting string input much easier as you'll see later.<br>
<br>
In the destructor we free our text surface and disable unicode.
While enabling unicode makes string input easier, it does add a bit of overhead.
It should be turned off when you're not using it.
</div>

<div class="tutCode">void StringInput::handle_input()
{
    //If a key was pressed
    if( event.type == SDL_KEYDOWN )
    {
        //Keep a copy of the current version of the string
        std::string temp = str;
        
        //If the string less than maximum size
        if( str.length() <= 16 )
        {
</div>

<div class="tutText">
Now it's time to handle the user's input.<br>
<br>
When the user presses a key, we first store a copy of the current string.
I'll tell you why later.<br>
<br>
Then we check that the string isn't at maximum length.
Here I set it as 16, but you can set it to be whatever you want.
</div>

<div class="tutCode">            //If the key is a space
            if( event.key.keysym.unicode == (Uint16)' ' )
            {
                //Append the character
                str += (char)event.key.keysym.unicode;    
            }
</div>

<div class="tutText">
The basic concept of string input is when the user presses 'A' add on a 'A',
when the user presses 'B' add on a 'B', etc, etc.<br>
<br>
Because the SDLKey definitions don't match up with their ASCII/Unicode values,
we enable unicode so the "unicode" member of the Keysym structure matches the unicode value of character pressed.
Enabling unicode also automatically handles shift and caps lock when you want capital letters and symbols.<br>
<br>
If you don't know what unicode is, it's just an extension of ASCII.
Instead of being 8bit, it's 16bit so it can hold all the international characters.<br>
<br>
Here if the key pressed has the unicode value of the space character, we append it the string.
Since a standard string only uses 8bit ASCII characters, we have to convert it to a char when appending it.
</div>

<div class="tutCode">            //If the key is a number
            else if( ( event.key.keysym.unicode >= (Uint16)'0' ) && ( event.key.keysym.unicode <= (Uint16)'9' ) )
            {
                //Append the character
                str += (char)event.key.keysym.unicode;
            }
            //If the key is a uppercase letter
            else if( ( event.key.keysym.unicode >= (Uint16)'A' ) && ( event.key.keysym.unicode <= (Uint16)'Z' ) )
            {
                //Append the character
                str += (char)event.key.keysym.unicode;
            }
            //If the key is a lowercase letter
            else if( ( event.key.keysym.unicode >= (Uint16)'a' ) && ( event.key.keysym.unicode <= (Uint16)'z' ) )
            {
                //Append the character
                str += (char)event.key.keysym.unicode;
            }
        }
</div>

<div class="tutText">
In this program we only want spaces (ASCII/Unicode 32), numbers (48-57), uppercase (65-90), and lowercase (97-122) letters to appear.
So here we limit the numbers allowed to be appended to the string.
</div>

<div class="tutCode">        //If backspace was pressed and the string isn't blank
        if( ( event.key.keysym.sym == SDLK_BACKSPACE ) && ( str.length() != 0 ) )
        {
            //Remove a character from the end
            str.erase( str.length() - 1 );
        }
</div>

<div class="tutText">
Here we deal with when the user presses backspace.<br>
<br>
We simply check if the string is empty, and if it's not we lop off the last character of the string.
</div>

<div class="tutCode">        //If the string was changed
        if( str != temp )
        {
            //Free the old surface
            SDL_FreeSurface( text );
        
            //Render a new text surface
            text = TTF_RenderText_Solid( font, str.c_str(), textColor );
        }
    }
}
</div>

<div class="tutText">
Lastly, we check if string was altered by comparing it to the copy we made earlier.<br>
<br>
If the string has changed, we free the old text surface, and render a new one.
</div>

<div class="tutCode">void StringInput::show_centered()  
{
    //If the surface isn't blank
    if( text != NULL )
    {
        //Show the name
        apply_surface( ( SCREEN_WIDTH - text->w ) / 2, ( SCREEN_HEIGHT - text->h ) / 2, text, screen );
    }
}
</div>

<div class="tutText">
In our show_centered() function we apply the text surface centered on the screen.<br>
<br>
In this program we check if the name surface is NULL 
because when you try to render a surface from a blank string ( that-> "" ),
SDL_ttf returns NULL. Which makes sense because it was given nothing to render.<br>
</div>

<div class="tutCode">int main( int argc, char* args[] )
{
    //Quit flag
    bool quit = false;
    
    //Keep track if whether or not the user has entered their name
    bool nameEntered = false;
    
    //Initialize
    if( init() == false )
    {
        return 1;
    }
    
    //The gets the user's name
    StringInput name;
    
    //Load the files
    if( load_files() == false )
    {
        return 1;
    }
    
    //Set the message
    message = TTF_RenderText_Solid( font, "New High Score! Enter Name:", textColor );
</div>

<div class="tutText">
At the top of our main() function we have two new variables. "nameEntered" is a flag that tells whether or not the
user has entered their name which we obviously initialize to false. "name" is, of course, an object of the class we
made used to get the user's name.<br>
<br>
We have our typical initialization and loading but we also render the message surface before we go into the main loop.
</div>

<div class="tutCode">    //While the user hasn't quit
    while( quit == false )
    {
        //While there's events to handle
        while( SDL_PollEvent( &event ) )
        {
            //If the user hasn't entered their name yet
            if( nameEntered == false )
            {
                //Get user input
                name.handle_input();
                
                //If the enter key was pressed
                if( ( event.type == SDL_KEYDOWN ) && ( event.key.keysym.sym == SDLK_RETURN ) )
                {
                    //Change the flag
                    nameEntered = true;
                        
                    //Free the old message surface
                    SDL_FreeSurface( message );
                        
                    //Change the message
                    message = TTF_RenderText_Solid( font, "Rank: 1st", textColor );
                }
            }
            
            //If the user has Xed out the window
            if( event.type == SDL_QUIT )
            {
                //Quit the program
                quit = true;
            }
        }
</div>

<div class="tutText">
Here's the event handling part of our main loop.<br>
<br>
First we check if the user is still entering their name.
If they are we call handle_input() on our StringInput object and let it do its thing.<br>
<br>
When the user presses enter, it means the user has finished so we set the "nameEntered" flag to true.
Then we free the old message surface and render a new one.<br>
<br>
and of course we also check if the user wants to X out.
</div>

<div class="tutCode">        //Apply the background
        apply_surface( 0, 0, background, screen );

        //Show the message
        apply_surface( ( SCREEN_WIDTH - message->w ) / 2, ( ( SCREEN_HEIGHT / 2 ) - message->h ) / 2, message, screen );
        
        //Show the name on the screen
        name.show_centered();
        
        //Update the screen
        if( SDL_Flip( screen ) == -1 )
        {
            return 1;    
        }
    }
</div>

<div class="tutText">
Now here's the rendering part of our main loop.<br>
<br>
Nothing really new here, we just apply the background, then message surface and show our text input.<br>
<br>
In this tutorial we only handled string input, but getting integers isn't much harder. The
<a class="tutLink" href="http://www.cppreference.com/stdstring/index.html">string header</a> has the function
atoi() that gets an integer from a string. There's other functions that'll do floating point numbers. Look
'em up.
</div>

<div class="tutFooter">
Download the media and source code for this tutorial <a class="tutLink" href="lesson23.zip">here</a>.<br>
<br>
<a class="leftNav" href="../lesson22/index.php">Previous Tutorial</a><a class="rightNav" href="../lesson24/index.php">Next Tutorial</a><br>
</div>
</div>

<div class="footer">


<div class="nav">

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
<br/>
<a class="nav" href="https://discourse.libsdl.org/">SDL Forums</a>
<a class="nav" href="../../tutorials/SDL/index.php">SDL Tutorials</a>
<a class="nav" href="../../articles/index.php">Articles</a>
<a class="nav" href="../../tutorials/OpenGL/index.php">OpenGL Tutorials</a>
<a class="nav" href="https://www.opengl.org/discussion_boards/forum.php">OpenGL Forums</a>
<br/>
<a class="nav" href="../../index.php">News</a>
<a class="nav" href="../../faq.php">FAQs</a>
<a class="nav" href="../../contact.php">Contact</a>
<a class="nav" href="../../donate.php">Donations</a>
</div>

<h6>Copyright Lazy Foo' Productions 2004-2024</h6>
</div>

</body>
</html>