<!-- Get tutorial set -->


<!-- Tutorial root -->



    <!-- Desktop tutorial set -->
    
        
        
        
    <!-- Normal tutorial set -->
    

                    

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
<meta name="keywords" content="SDL 2 C++ Tutorial 2D Windows Install SDL_image SDL_ttf SDL_mixer Android">
<meta name="description" content="Install SDL2_image/SDL2_ttf/SDL2_mixer on Windows Android.">

<link href="../../../../assets/style.css" rel="stylesheet">
<script src="../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL_image on Windows Android Studio 3.0.1</title>

<script src="../../../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
	<a href="../../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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
    <h1 class="text-center">Setting up SDL_image on Windows Android Studio 3.0.1</h1>
    
    <p class="text-center"><b>Last Updated: Jan 6th, 2018</b></p>
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <a name="1" href="index.php#1">1)</a> First, download the SDL_image source on <a href="https://www.libsdl.org/projects/SDL_image/">this page</a>. 
<div class="text-center"><img class="img-fluid" alt="download src" src="download.png"></div>
Extract the source code so it's at <code>C:\androidlib\SDL2_image-2.0.2</code>.<br/>
<br/>

<a name="2" href="index.php#2">2)</a> Download the <a href="../53_extensions_and_changing_orientation.zip">demo source/assets</a>. Copy the directory inside to
<code>C:\androidprojects\SDL\app\src\main\assets\</code>. Remember: if the application needs to load <code>53_extensions_and_changing_orientation/portrait.png</code> it needs to be at
<code>C:\androidprojects\SDL\app\src\main\assets\53_extensions_and_changing_orientation\portrait.png</code> when building.<br/>
<br/>

<a name="3" href="index.php#3">3)</a> Copy demo source to <code>C:\androidprojects\SDL\app\src\main\jni\src\53_extensions_and_changing_orientation.cpp</code>. Open the game make file at
<code>C:\androidprojects\SDL\app\src\main\jni\src\Android.mk</code> and change local source files to include the new demo source file:<br/>
<code>LOCAL_SRC_FILES := 53_extensions_and_changing_orientation.cpp</code><br/>
<br/>
Open up Android Studio and try to build. You'll get an error:
<code>Error:(6, 10) fatal error: 'SDL_image.h' file not found</code><br/>
<br/>
This error means that our game source file can't find SDL_image.h which makes sense since we haven't set it up yet.<br/>
<br/>			

<a name="4" href="index.php#4">4)</a> SDL_image is just another shared object library that needs to be built along SDL 2 and our C++ application. So that means we need to create a symbolic link to the SDL_image source code. Go to the
start menu and run cmd as administrator:
<div class="text-center"><img class="img-fluid" alt="run cmd as admin" src="run_cmd_as_admin.png"></div>
<br/>
Go to the JNI directory inside the project using this command: <code>cd C:\androidprojects\SDL\app\src\main\jni</code><br/>
<br/>
And create a hard symbolic link directory to the SDL2_image source directory we extracted (<b>REMEMBER: This path will vary depending on your version of SDL_image</b>):<br/>
<code>mklink /D SDL2_image C:\androidlib\SDL2_image-2.0.2</code><br/>
<br/>
You should get the following message back: <code>symbolic link created for SDL2_image <<===>> C:\androidlib\SDL2_image-2.0.2</code><br/>
<br/>
Build again, you'll get the same error but at least SDL2_image has a symbolic link in the project now.<br/>
<br/>

<a name="5" href="index.php#5">5)</a> There may be a symbolic link to SDL_image in the JNI folder but our demo application doesn't know where it is. To fix this error open up
<code>C:\androidprojects\SDL\app\src\main\jni\src\Android.mk</code> and change:<br/>
<code>LOCAL_C_INCLUDES := $(LOCAL_PATH)/$(SDL_PATH)/include</code><br/>
to<br/>
<code>LOCAL_C_INCLUDES := $(LOCAL_PATH)/$(SDL_PATH)/include $(LOCAL_PATH)/../SDL2_image/</code><br/>
<br/>
So now our demo application can find the SDL_image headers. Build again and you'll get a new error:<br/>
<br/>
<code><pre>Error:(120) undefined reference to `IMG_Load'
Error:(432) undefined reference to `IMG_Init'
Error:(477) undefined reference to `IMG_Quit'
</pre></code>
<br/>

<a name="6" href="index.php#6">6)</a> Those last errors were linker errors. While SDL_image managed to compile and our game managed to compile, we didn't tell the NDK to link our game against SDL_image. In
<code>C:\androidprojects\SDL\app\src\main\jni\src\Android.mk</code> change<br/>
<code>LOCAL_SHARED_LIBRARIES := SDL2</code><br/>
to<br/>
<code>LOCAL_SHARED_LIBRARIES := SDL2 SDL2_image</code>.<br/>
<br/>
Build again. Hopefully you should get the application to build, but you may get an error.<br/>
<br/>

<a name="7" href="index.php#7">7)</a> You may have gotten a No rule to make target error for IMG_WIC.c. This is the webp library being a pain in the butt. We're just going to yank it out. Open up
<code>C:\androidlib\SDL2_image-2.0.2\Android.mk</code> and change: <code>SUPPORT_WEBP ?= true</code> to <code>SUPPORT_WEBP ?= false</code>.<br/>
<br/>
Delete the line that says <code>IMG_WIC.c       \</code> and just straight up delete the <code>C:\androidlib\SDL2_image-2.0.2\external\libwebp-0.6.0</code> directory.<br/>
<br/>
Build again and you should get no errors.<br/>
<br/>

<a name="8" href="index.php#8">8)</a> The application should now build but <b>IT WILL NOT WORK</b>. We need to get our Java activity load the SDL extension library. Open 
<code>C:\androidprojects\SDL\app\src\main\java\org\libsdl\app\SDLActivity.java</code> and look for this section:<br/>
<br/>
<code><pre>    protected String[] getLibraries() {
        return new String[] {
            "SDL2",
            // "SDL2_image",
            // "SDL2_mixer",
            // "SDL2_net",
            // "SDL2_ttf",
            "main"
        };
    }
</pre></code>
<br/>
Uncomment the libraries you'll be using so they'll be loaded.<br/>
<br/>
<a name="9" href="index.php#9">9)</a> Build and run. The application should run and rotate. Now that the application built, it's time to go over the source code.

</div>
                    
                
                    
                        <div class="container border py-3 my-3">




<a href="../index2.php">Extensions and Changing Orientation Part 2 - Handling Orientation Changes</a><br/>




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
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../../../assets/external-link.svg"></a>
	<a href="../../index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="../../../OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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