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
<meta name="keywords" content="Lazy Foo' Productions SDL 2 C++ Tutorial 2D Windows Linux Mac">
<meta name="description" content="Get started making games with your first SDL App.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Hello SDL</title>

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
    <h1 class="text-center">Hello SDL</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Hello SDL screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Apr 26th, 2024</b></p>
    
        So you learned the basics of C++, but you're sick of making little text based programs. In order to use things like graphics, sound, keyboards, joysticks, etc you
need an API (Application Programmer's Interface) that takes all those hardware features and turns it into something C++ can interact with.<br/>
<br/>
That's what SDL does. It takes the Windows/Linux/Mac/Android/iOS/etc tools and wraps them in a way that you can code something in SDL and compile it to what ever
platform it supports. In order to use it, you need to install it.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    These set up tutorials are a supplement to assist you in setting up SDL. Certain companies (that shall remain nameless) keep changing their user interfaces for their IDEs with every release,
so the set up procedure may have changed since the tutorial was made. In case the IDE's interface has changed since the tutorial was last updated, you can check out the 
<a href="https://github.com/libsdl-org/SDL/tree/main/docs">documentation on the SDL github</a> between now and when the tutorial is updated.<br/>
<br/>
SDL as a dynamically linked library. A dynamically linked library has 3 parts:<br/>
<ul>
    <li>The header files (Library.h)</li>
    <li>The library files (Library.lib for windows or libLibrary.a for *nix)</li>
    <li>The binary files (Library.dll for windows or Library.so for *nix)</li>
</ul>
Your compiler needs to be able to find the header files when compiling so it knows what SDL_Init() and the other SDL functions and structures are. You can
either configure your compiler to search in an additional directory where the SDL header files are located, or put the header files in with the rest of header
files that your compiler comes with. If the compiler complains that it can't find SDL.h, it means the header files aren't in a place that the compiler looks
for header files.<br/>
<br/>
After your compiler compiles all your source files it has to link them together. In order for the program to link properly, it needs to know the addresses of all your
functions including the ones for SDL. For a dynamically linked library, these addresses are in the library file. The library file has the Import Address Table
so your program can import the functions at runtime. Like with header files, You can either configure your compiler to search in an additional directory where the
SDL library files are located, or put the library files in with the rest of library files that your compiler comes with. You also have to tell the linker to
link against the library file in the linker. If the linker complains that it can't find -lSDL2 or SDL2.lib, it means the library files aren't in a place that the 
linker looks for library files. If the linker complains about an undefined reference, it probably means it was never told to link the library.<br/>
<br/>
After your program is compiled and linked, you need to be able to link against the library when you run it. In order to run a dynamically linked application, you
need to be able to import the library binaries at runtime. Your operating system needs to be able to find the library binary when you run your program. You can
either put the library binaries in the same directory as your executable, a directory that your operating system keeps library binary files, or tell the operating system to look
in a custom directory that has the binary files via the PATH variable.<br/>
<br/>
After you set up SDL, we'll cover <a href="index2.php">how to create an SDL 2 window</a>.

</div>
                    
                
                    
                        <table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="2" class="text-center">Select Your Operating System</th>
        </tr>
    </thead>
    <tbody>
        
            <tr>
                <td class="text-end">
                    <a href="windows/index.php" name="Setting up SDL on Windows"><img alt="Setting up SDL on Windows" src="windows/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="windows/index.php" name="Setting up SDL on Windows">Setting up SDL on Windows</a>
                </td>
            </tr>
        
            <tr>
                <td class="text-end">
                    <a href="linux/index.php" name="Setting up SDL 2 on Linux"><img alt="Setting up SDL 2 on Linux" src="linux/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="linux/index.php" name="Setting up SDL 2 on Linux">Setting up SDL 2 on Linux</a>
                </td>
            </tr>
        
            <tr>
                <td class="text-end">
                    <a href="mac/index.php" name="Setting up SDL 2 on Mac OS X Sonoma"><img alt="Setting up SDL 2 on Mac OS X Sonoma" src="mac/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="mac/index.php" name="Setting up SDL 2 on Mac OS X Sonoma">Setting up SDL 2 on Mac OS X Sonoma</a>
                </td>
            </tr>
        
    </tbody>
 </table>
                    
                
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