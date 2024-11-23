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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows Linux Mac freeGLUT window">
<meta name="description" content="Render your first polygon with OpenGL.">

<link href="../../../assets/style.css" rel="stylesheet">
<script src="../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Hello OpenGL</title>

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
    <h1 class="text-center">Hello OpenGL</h1>
    
        <div class="text-center"><img class="img-fluid" src="preview.png" alt="Hello OpenGL screenshot"></div>
    
    <p class="text-center"><b>Last Updated: Sep 8th, 2012</b></p>
    
        OpenGL is a pure graphics rendering API. It'll render anything you tell it to, but it has no commands to process files or handle windowing. Fortunately, there are
support libraries like freeGLUT that can create OpenGL windows.<br/>
<br/>
freeGLUT is a completely open source alternative to the OpenGL Utility Toolkit (GLUT) library. While it's not the most versatile OpenGL windowing API, it's great
for doing quick OpenGL demos. In order to use it, you need to install it.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    We're using freeGLUT as a dynamically linked library. A dynamically linked library has 3 parts:<br/>
<ul>
    <li>The header files (Library.h)</li>
    <li>The library files (Library.lib for windows or libLibrary.a for *nix)</li>
    <li>The binary files (Library.dll for windows or Library.so for *nix)</li>
</ul>
Your compiler needs to be able to find the header files when compiling so it knows what glutMainLoop() and the other freeGLUT functions and variables are. You can
either configure your compiler to search in an additional directory where the freeGLUT header files are located, or put the header files in with the rest of header
files that your compiler comes with. If the compiler complains that it can't find freeglut.h, it means the header files aren't in a place that the compiler looks
for header files.<br/>
<br/>
After your compiler compiles all your source files it has to link them together. In order to program to link properly, it needs to know the addresses of all your
functions including the ones for freeGLUT. For a dynamically linked library, these addresses are in the library file. The library file has the Import Address Table
so your program can import the functions at runtime. Like with header files, You can either configure your compiler to search in an additional directory where the
freeGLUT library files are located, or put the library files in with the rest of library files that your compiler comes with. You also have to tell the linker to
link against the library file. If the linker complains that it can't find -lfreeglut or freeglut.lib, it means the library files aren't in a place that the linker
looks for library files. If the linker complains about an undefined reference, it probably means it was never told to link the library.<br/>
<br/>
After your program is compiled and linked, you need to be able to link against the library when you run it. In order to run a dynamically linked application, you
need to be able to import the library binaries at runtime. Your operating system needs to be able to find the library binary when you run your program. You can
either put the library binaries in the same directory as your executable, or a directory that your operating system keeps library binary files.<br/>
<br/>
After you set up freeGLUT, we'll cover <a href="index2.php">how to render your first polygon using OpenGL</a>.

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
                    <a href="windows/index.php" name="Setting up freeGLUT on Windows"><img alt="Setting up freeGLUT on Windows" src="windows/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="windows/index.php" name="Setting up freeGLUT on Windows">Setting up freeGLUT on Windows</a>
                </td>
            </tr>
        
            <tr>
                <td class="text-end">
                    <a href="linux/index.php" name="Setting up freeGLUT on Linux"><img alt="Setting up freeGLUT on Linux" src="linux/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="linux/index.php" name="Setting up freeGLUT on Linux">Setting up freeGLUT on Linux</a>
                </td>
            </tr>
        
            <tr>
                <td class="text-end">
                    <a href="mac/index.php" name="Setting up freeGLUT in Mac OS X Lion"><img alt="Setting up freeGLUT in Mac OS X Lion" src="mac/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="mac/index.php" name="Setting up freeGLUT in Mac OS X Lion">Setting up freeGLUT in Mac OS X Lion</a>
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