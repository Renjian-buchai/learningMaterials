<!-- Get tutorial set -->


<!-- Tutorial root -->



    <!-- Desktop tutorial set -->
    
        
    <!-- Mobile tutorial set -->
    

                    

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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Windows freeGLUT setup">
<meta name="description" content="Install OpenGL freeGLUT on Microsoft Windows.">

<link href="../../../../assets/style.css" rel="stylesheet">
<script src="../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up freeGLUT on Windows</title>

<script src="../../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
	<a href="../../../SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../../donate.php" class="nav-item nav-link">Donations</a>
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
    <h1 class="text-center">Setting up freeGLUT on Windows</h1>
    
    <p class="text-center"><b>Last Updated: Aug 9th, 2012</b></p>
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <b>An important note for Microsoft Windows developers:</b><br/>
<br/>
As part of your set up process, you are going to have to place the dll file some place where your program can link with it during runtime. You can either put the dll
file in the same directory as your executable, or put it in the system directory. C:\WINDOWS\SYSTEM32 is the 32bit windows system directory and C:\Windows\SysWOW64 is
the 64bit system directory of 32bit applications.<br/>
<br/>
The advantages of placing the dll file in the system directory are:<br/>
<ol>
    <li>Your operating system will always be able to find the library on your system, so you can compile and run dynamically linked applications anywhere on your system</li>
    <li>You won't have to place a copy of the dll file with every single application you develop</li>
</ol>
With that in mind, when distributing your application you should never mess with the user's system directory. The user could have applications that require freeGLUT
version ABC in the system directory and you could be overwriting it with freeglut version XYZ. Your distribution version should have the dll files in the same
directory as the executable.

</div>
                    
                
                    
                        <table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="2" class="text-center">Select Your Compiler/IDE</th>
        </tr>
    </thead>
    <tbody>
        
            <tr>
                <td class="text-end">
                    <a href="msvsnet2010u/index.php" name="Setting up freeGLUT on Visual Studio 2010 Ultimate"><img alt="Setting up freeGLUT on Visual Studio 2010 Ultimate" src="msvsnet2010u/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="msvsnet2010u/index.php" name="Setting up freeGLUT on Visual Studio 2010 Ultimate">Setting up freeGLUT on Visual Studio 2010 Ultimate</a>
                </td>
            </tr>
        
            <tr>
                <td class="text-end">
                    <a href="codeblocks/index.php" name="Setting up freeGLUT on Code::Blocks 10.05"><img alt="Setting up freeGLUT on Code::Blocks 10.05" src="codeblocks/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="codeblocks/index.php" name="Setting up freeGLUT on Code::Blocks 10.05">Setting up freeGLUT on Code::Blocks 10.05</a>
                </td>
            </tr>
        
            <tr>
                <td class="text-end">
                    <a href="mingw/index.php" name="Setting up freeGLUT on MinGW"><img alt="Setting up freeGLUT on MinGW" src="mingw/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="mingw/index.php" name="Setting up freeGLUT on MinGW">Setting up freeGLUT on MinGW</a>
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
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
	<a href="../../../SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="../../../../index.php" class="nav-item nav-link">News</a>
	<a href="../../../../faq.php" class="nav-item nav-link">FAQs</a>
	<a href="../../../../contact.php" class="nav-item nav-link">Contact</a>
	<a href="../../../../donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="../../../../assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>