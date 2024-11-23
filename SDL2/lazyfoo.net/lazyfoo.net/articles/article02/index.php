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
<meta name="keywords" content="C++ 2D Windows Linux Mac writing readable code">
<meta name="description" content="It's important to have code that doesn't hurt your eyes.">

<link href="../../assets/style.css" rel="stylesheet">
<script src="../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Writing Readable Code</title>

<script src="../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
	<a href="../../tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../index.php" class="nav-item nav-link">Articles</a>
	<a href="../../tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../index.php" class="nav-item nav-link">News</a>
	<a href="../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../donate.php" class="nav-item nav-link">Donations</a>
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
    <h1 class="text-center">Writing Readable Code</h1>
    
    <p class="text-center"><b>Last Updated: Jul 31st, 2020</b></p>
    
        It may not seem important, but any good programmer needs to know how to make readable code.
Here you'll get some basic tips to make your code easy on the eyes.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    In your intro to C++ class you probably never bothered with it, but making your code readable is important.
Besides the fact that when you get into the real world you're going to have other people use your code, having
your source code be neat and organized greatly increases your ability to debug your code.<br/>
<br/>
It may not seem like it now, but when dealing with programs that have thousands of lines of code
(ie: Video Games), having your code be a cluttered mess is going to be a pain when trying to fix something wrong
with your code. Also when asking for help with your code, people tend to be less willing to assist you if your code
makes them dizzy.<br/>
<br/>
There's 4 major points to having neat code:

</div>
                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3"><h3>1) Properly indent and space your code</h3></div>


<pre class="border my-0 py-3">void Dot::handle_input()
{
//If a axis was changed
if(event.type==SDL_JOYAXISMOTION)
   {
  //If joystick 0 has moved
 if(event.jaxis.which==0)
  {
 //If the X axis changed
 if(event.jaxis.axis==0)
 {
  //If the X axis is neutral
  if((event.jaxis.value>-8000)&&(event.jaxis.value<8000))
 xVel=0;
 //If not
else
  {
//Adjust the velocity
if(event.jaxis.value<0)
xVel=-DOT_WIDTH/2;
else
xVel=DOT_WIDTH/2;
 }    
 }
 //If the Y axis changed
 else if(event.jaxis.axis==1)
 {
//If the Y axis is neutral
if((event.jaxis.value>-8000)&&(event.jaxis.value<8000))
  yVel=0;
  //If not
  else
   {
  //Adjust the velocity
  if(event.jaxis.value<0)
  yVel=-DOT_HEIGHT/2;
else
yVel=DOT_HEIGHT/2;
}
}
}
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">This is the input handling code from my Joystick tutorial only with different spacing.
It's missing a bracket for it to compile. How long does it take you to find it?<br/>
<br/>
Now here's the same chunk of code with the same missing bracket. How long does it take for you to find it here?
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void Dot::handle_input()
{
    //If a axis was changed
    if( event.type == SDL_JOYAXISMOTION )
    {
        //If joystick 0 has moved
        if( event.jaxis.which == 0 )
        {
            //If the X axis changed
            if( event.jaxis.axis == 0 )
            {
                //If the X axis is neutral
                if( ( event.jaxis.value > -8000 ) && ( event.jaxis.value < 8000 ) )
                {
                    xVel = 0;
                }
                //If not
                else
                {
                    //Adjust the velocity
                    if( event.jaxis.value < 0 )
                    {
                        xVel = -DOT_WIDTH / 2;
                    }
                    else
                    {
                        xVel = DOT_WIDTH / 2;
                    }
                }    
            }
            //If the Y axis changed
            else if( event.jaxis.axis == 1 )
            {
                //If the Y axis is neutral
                if( ( event.jaxis.value > -8000 ) && ( event.jaxis.value < 8000 ) )
                {
                    yVel = 0;
                }
                //If not
                else
                {
                    //Adjust the velocity
                    if( event.jaxis.value < 0 )
                    {
                        yVel = -DOT_HEIGHT / 2;
                    }
                    else
                    {
                        yVel = DOT_HEIGHT / 2;
                    }
                }
				
        }
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">I'm sure the difference is clear. Having everything inside the function indented allows you to clearly see where
the function begins and ends. Having the statements and conditions neatly spaced allows them to be more readable.
Having if/while statement with properly placed brackets and indenting the statements inside allows to
clearly see the structure of the program.<br/>
<br/>
There are no official rules for spacing in C++. You're free to use what ever rules you're comfortable with. Make
sure to not only have everything clearly spaced, but make sure you're consistent.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //If not
    else
    {
        //Adjust the velocity
        if( event.jaxis.value < 0 )
        {
            yVel = -DOT_HEIGHT / 2;
        }
        else
        {yVel=DOT_HEIGHT / 2;}
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">So don't do this where your spacing scheme changes from line to line. Spacing standards don't do you any good
if you don't follow them.
</div>



                    
                
                    
                        
    <div class="container border-start border-end border-top py-3 mt-3"><h3>2) Give your variables/objects/classes/functions/etc descriptive names</h3></div>


<pre class="border my-0 py-3">//Some variables
int pH = 0;
int pP = 0;
int pS = 0;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Can you tell me what these variables are just by looking at them?
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Some variables
int playerHealth = 0;
int playerPower = 0;
int playerScore = 0;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">How about these? I'm sure it's pretty obvious.<br/>
<br/>
Using descriptive names allows you to see what something is quickly. This means not having to constantly
reference variables/objects/classes/functions/etc names which saves you time.<br/>
<br/>
When you have large projects, you're not going to be able to memorize every
variable/object/class/function/whatever.
Naming every one properly is going to help out a lot as your projects get larger.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">
    <h3>3) Develop a naming standard</h3>
Naming standards are rules on how to name variables, functions, classes, constants, etc. Having standardized naming
allows you to quickly identify whether something is a class/constant/variable/etc.<br/>
<br/>
Here's the basics of my naming convention for example:

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//I name my constants in all caps with words separated by underscores
const int MY_CONSTANT = 0;

//My variables are named in lower camel case.
int myVar;

//My functions are names in lower case with underscores separating the words.
void my_function();

//I name classes using capital camel case.
class MyClass;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Like spacing, there's no language wide C++ standard for naming. So you're free to create your own.<br/>
<br/>
I'd also like to mention that some people also use prefixes to help them identify variable types. I personally
don't do this but some of you might find this useful so I'll throw some examples out there.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//The "ptr_" prefix can be used to identify pointers
int* ptr_myPointer = NULL;

//Some people use prefix to identify the scope of a variable.
//"g_" can be used for global variables
int g_myGlobalVar = 0;

//"l_" can be used for local variables
int l_myLocalVar = 0;

//"m_" can be used for class member variables
int m_myMemberVar = 0;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Again it's up to you to develop a naming standard that works for you.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">
    <h3>4) Properly comment your code</h3>

Commenting is also something that doesn't seem too important, but as your projects grow it will prove to be
useful. They come in handy when working on a project with multiple programmers. They'll also help you remember
what a piece of code does or how it works, which is useful when you don't see a piece of code for a while.
Considering some programs can take a while to finish, it can happen where you forget what a piece of your 
code does. You'll be glad you commented your code when that happens.<br/>
<br/>
When I say properly comment your code, remember there is such a thing as over commenting.

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Initialize x
int x = 0;

//Initialize y
int y = 0;

//Add 10 to x
x += 10;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">This is some pretty bad over commenting. I can tell that x and y are being initialized and I don't need comments
to tell me that. It's also obvious that 10 is being added to x in the 3rd statement.<br/>
<br/>
Commenting like this is just a waste of your time.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//The offsets
int x = 0;
int y = 0;

//Move to the right
x += 10;
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">This is much better. The comments tell us what x and y actually are and what adding 10 to x does. Also notice that
the initialization of x and y aren't individually commented. You don't need to comment every line of you code.
Only comment what needs to be commented.<br/>
<br/>
I have to admit that even this and the code I make for the articles and tutorials is over commented. The reason is
that the code isn't "real" software, it's learning material and its purpose to help people learn. The commenting
style is made to help explain the code to people who are fairly new to programming and SDL. When you're in the
field, you and the people you work with will (hopefully) be experienced and know what they're doing. Over
commenting can get fairly annoying for other people that read your code.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">SDL_Surface *load_image( std::string filename ) 
{
    //The image that's loaded
    SDL_Surface* loadedImage = NULL;
    
    //The optimized surface that will be used
    SDL_Surface* optimizedImage = NULL;
    
    //Load the image
    loadedImage = IMG_Load( filename.c_str() );
    
    //If the image loaded
    if( loadedImage != NULL )
    {
        //Create an optimized surface
        optimizedImage = SDL_DisplayFormat( loadedImage );
        
        //Free the old surface
        SDL_FreeSurface( loadedImage );
        
        //If the surface was optimized
        if( optimizedImage != NULL )
        {
            //Color key surface
            SDL_SetColorKey( optimizedImage, SDL_SRCCOLORKEY, SDL_MapRGB( optimizedImage->format, 0, 0xFF, 0xFF ) );
        }
    }
    
    //Return the optimized surface
    return optimizedImage;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here is some over commented code that you know as the surface loader used on the site. Now how much commenting
should go into something like this?
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Loads, optimizes and color keys image from the given path
SDL_Surface *load_image( std::string filename ) 
{
    SDL_Surface* loadedImage = NULL;
    SDL_Surface* optimizedImage = NULL;
    
    loadedImage = IMG_Load( filename.c_str() );
    
    if( loadedImage != NULL )
    {
        optimizedImage = SDL_DisplayFormat( loadedImage );
        SDL_FreeSurface( loadedImage );
        
        if( optimizedImage != NULL )
        {
            SDL_SetColorKey( optimizedImage, SDL_SRCCOLORKEY, SDL_MapRGB( optimizedImage->format, 0, 0xFF, 0xFF ) );
        }
    }
    
    return optimizedImage;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Your comments should just summarize what going in the code like this. Because everything is given a descriptive
name and is properly spaced, a programmer who's never seen this piece of code should easily be able to figure out
how it works with a little help from the documentation. If there was a complex or fairly large algorithm here, you
might need additional comments, but always remember that comments should summarize not try to give statement by
statement documentation.<br/>
<br/>
Worrying about all this stuff may sound like a waste of time, but eventually this stuff will come naturally. You
can either learn the importance of neat code the easy way or the hard way.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">




If you have any suggestions to improve this article, It would be great if you <a href="../../contact.php">contacted me</a> so I can improve this article.




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
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
	<a href="../../tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../index.php" class="nav-item nav-link">Articles</a>
	<a href="../../tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../index.php" class="nav-item nav-link">News</a>
	<a href="../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>