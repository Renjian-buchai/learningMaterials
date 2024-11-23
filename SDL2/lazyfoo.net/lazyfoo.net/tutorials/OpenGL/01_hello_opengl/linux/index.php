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
<meta name="keywords" content="freeGLUT glut C++ OpenGL Tutorial 2D Linux install freeGLUT">
<meta name="description" content="Install OpenGL freeGLUT on Linux.">

<link href="../../../../assets/style.css" rel="stylesheet">
<script src="../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up freeGLUT on Linux</title>

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
    <h1 class="text-center">Setting up freeGLUT on Linux</h1>
    
    <p class="text-center"><b>Last Updated: Sep 17th, 2022</b></p>
    
        Since there are so many flavors of Linux these tutorials might not work on your Linux set up. If you've tried everything and are still having problems,
<a href="../../../../contact.php" >contact me</a> and I'll try to add on a distro specific fix.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    In the age of packaging managers, a lot of the work is done for you when installing libraries. You'll need root privileges to install packages so make sure to use "su"
or "sudo" if you're not logged in as root.<br/>
<br/>
<a  name="1" href="index.php#1">1)</a>
For those of you who have Advanced Packaging Tool available (ie Ubuntu and Debian) you'll want to search the apt-get cache to find the current freeGLUT version to install.
You can search the apt-get available packages using the command: <code>apt-cache search freeglut</code><br/>
<br/>
You'll want to download the development version of freeGLUT. As of the last update of this tutorial, the development package of freeglut is <b>freeglut3-dev</b>. You can install
this package using the command <code>apt-get install freeglut3-dev</code><br/>
<br/>
<a  name="2" href="index.php#2">2)</a>
If you use the Yellow dog Updater, Modified (used in Fedora and CentOS) you can enter the command: <code>yum search freeglut</code><br/>
<br/>
To search for the freeGLUT developers package. As of the last update of this tutorial, the developer package for freeglut is <b>freeglut-devel</b>. You can install this package
using the command: <code>yum install freeglut-devel</code><br/>
<br/>
<a  name="3" href="index.php#3">3)</a>
If somehow you don't have a package manager, you can install from the source the classic Unix way. Download the latest source from the
<a  href="http://freeglut.sourceforge.net/">freeGLUT website</a>.
<div class="text-center"><img class="img-fluid" alt="download" src="download.png"></div>
<br/>
Extract the archive and cd to the folder that got extracted. Configure the installation using <code>./configure</code><br/>
<br/>
Compile the source using the make command <code>make all</code><br/>
<br/>
Finally, install the package using the make command <code>make install</code><br/>
<br/>
<a  name="4" href="index.php#4">4)</a>
Now that you've installed the development libraries, it's time to start up your IDE/compiler.

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
                    <a href="codeblocks/index.php" name="Setting up freeGLUT on Code::Blocks 10.05"><img alt="Setting up freeGLUT on Code::Blocks 10.05" src="codeblocks/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="codeblocks/index.php" name="Setting up freeGLUT on Code::Blocks 10.05">Setting up freeGLUT on Code::Blocks 10.05</a>
                </td>
            </tr>
        
            <tr>
                <td class="text-end">
                    <a href="cli/index.php" name="Setting up freeGLUT on g++"><img alt="Setting up freeGLUT on g++" src="cli/logo.png" ></a><br/>
                </td>
                <td class="text-start align-middle">
                    <a href="cli/index.php" name="Setting up freeGLUT on g++">Setting up freeGLUT on g++</a>
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