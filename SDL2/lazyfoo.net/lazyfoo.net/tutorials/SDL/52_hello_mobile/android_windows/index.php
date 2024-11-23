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
<meta name="keywords" content="SDL 2 C++ Tutorial 2D Windows Install SDL 2 Android Studio">
<meta name="description" content="Install SDL 2 on Windows Android Studio.">

<link href="../../../../assets/style.css" rel="stylesheet">
<script src="../../../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Setting up SDL 2 on Windows Android Studio 3.0.1</title>

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
    <h1 class="text-center">Setting up SDL 2 on Windows Android Studio 3.0.1</h1>
    
    <p class="text-center"><b>Last Updated: Jun 10th, 2019</b></p>
    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    <a name="1" href="index.php#1">1)</a> Get ready to download. A lot. Like over a gigabyte of data. If you have a limited connection, I'm sorry the android SDK is huge and it's just the way things are. I recommend having a movie or TV
show to watch ready if a gigabyte takes a long time for you to download.<br/>
<br/>
First, download the Java Development Kit (JDK) on <a href="http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html">this page</a>. I am assuming you're running 64bit windows, so download the
64bit version:<br/>
<div class="text-center"><img class="img-fluid" alt="download jdk" src="download_jdk.png"></div>
<br/>
<a name="2" href="index.php#2">2)</a> Download Android Studio on <a href="https://developer.android.com/studio/index.html">this page</a>.<br/>
<div class="text-center"><img class="img-fluid" alt="download android studio" src="download_android_studio.png"></div>
<br/>
<a name="3" href="index.php#3">3)</a> Download the SDL2 source. Not just the development libraries you use for desktop development, the full source. You can find the full
source on <a href="https://www.libsdl.org/download-2.0.php">this page</a>.
<div class="text-center"><img class="img-fluid" alt="download sdl source" src="download_sdl_source.png"></div>
<br/>
<a name="4" href="index.php#4">4)</a> Install the JDK. This should be a simple next, next, next,... finish installation.<br/>
<br/>
<a name="5" href="index.php#5">5)</a> Install the Android Studio. It's mostly a next, next, and finish installation but make sure to change a couple things. In the
configurations setting menu make sure to set the android sdk path to some place accessible. For this tutorial we are placing it at <code>C:\androidsdk</code>.
<div class="text-center"><img class="img-fluid" alt="android sdk location" src="android_sdk_location.png"></div>
<br/>
<a name="6" href="index.php#6">6)</a> Start Android Studio. The first time you start Android Studio it will run a set up wizard. Make sure to select the Custom Install.
<div class="text-center"><img class="img-fluid" alt="custom install" src="custom_install_type.png"></div>
<br/>
In the SDK Components Setup, make sure it pointed to the sdk directory we set when installing (which was at <code>C:\androidsdk</code>).
<div class="text-center"><img class="img-fluid" alt="sdk components" src="sdk_components_setup.png"></div>
Keep going through the installation and hit finish so it can start downloading.<br/>
<br/>
<a name="7" href="index.php#7">7)</a> Starting Android Studio again, open up the sdk manager:
<div class="text-center"><img class="img-fluid" alt="configure sdk manager" src="configure_sdk_manager.png"></div>
<br/>
Check Show Package Details, select Android version 16, and hit Apply to install:
<div class="text-center"><img class="img-fluid" alt="install android 16" src="install_android_16.png"></div>
<br/>
<a name="8" href="index.php#8">8)</a> Click on SDK Tools and make sure to install:
<ul>
<li>CMake</li>
<li>Google USB Driver</li>
<li>NDK</li>
</ul>
<div class="text-center"><img class="img-fluid" alt="sdk tools" src="sdk_tools.png"></div>
<br/>
<a name="9" href="index.php#9">9)</a> Extract the SDL2 source code to some accessable directory that is ideally dedicated to containing Android libraries. For this tutorial
we will put them in the directory <code>C:\androidlib</code>. After extracting the SDL2 source code you should have an Android makefile at <code>C:\androidlib\SDL2-2.0.5\Android.mk</code>. Depending on
your version of SDL, it could be at <code>C:\androidlib\SDL2-2.0.4\Android.mk</code> or <code>C:\androidlib\SDL2-2.0.6\Android.mk</code> and so on.<br/>
<br/>
<a name="10" href="index.php#10">10)</a> Start up Android Studio again and import the android project from the SDL2 source code which should be at <code>C:\androidlib\SDL2-2.0.5\android-project</code>
<div class="text-center"><img class="img-fluid" alt="import project" src="import_project.png"></div>
<br/>
<a name="11" href="index.php#11">11)</a> Set the destination to a new folder inside of some accessable directory that is ideally dedicated to containing Android projects. For this tutorial we will put the project in
<code>C:\androidprojects\SDL</code>.
<div class="text-center"><img class="img-fluid" alt="project destination" src="project_destination.png"></div>
Select the directory and import the project with the default settings.<br/>
<br/>
<a name="12" href="index.php#12">12)</a> If you try to hit Build -> Make Project you'll get the following error: <code>Minimum supported Gradle version is 4.1. Current version is 2.14.1.</code><br/>
<br/>
This means our project is set to use the wrong version of Gradle. To fix this, set the Project window to project mode, open <code>C:\androidprojects\SDL\gradle\wrapper\gradle-wrapper.properties</code> and change
<code>distributionUrl=https\://services.gradle.org/distributions/gradle-2.14.1-all.zip</code> to <code>distributionUrl=https\://services.gradle.org/distributions/gradle-4.1-all.zip</code><br/>
<br/>
Make project again (it may take a while to download Gradle 4.1) and you'll get a new error: <code>cannot find symbol class Objects</code><br/>
<br/>
<a name="13" href="index.php#13">13)</a> That error was due to the fact that Android Studio cannot find the Java Objects class. It can't find it because it is pointed at an old JDK. To make sure it compiles against the latest
version of Java, go to File -> Project Structure.
<div class="text-center"><img class="img-fluid" alt="project structure" src="project_structure.png"></div>
<br/>
Select app under Modules and the set the Source/Target Compatibility to the latest version (currently 1.8): 
<div class="text-center"><img class="img-fluid" alt="compatibility" src="compatibility.png"></div>
<br/>
Build again and you should get a new error.<br/>
<br/>
<a name="14" href="index.php#14">14)</a> The new error will say:<br/>
<code>Error:Execution failed for task ':app:compileDebugNdk'.
> Error: Your project contains C++ files but it is not using a supported native build system.
Consider using CMake or ndk-build integration with the stable Android Gradle plugin:
https://developer.android.com/studio/projects/add-native-code.html
or use the experimental plugin:
https://developer.android.com/studio/build/experimental-plugin.html.</code><br/>
<br/>
This is complaining that the NDK setup is broken for our project.<br/>
<br/>
Let's back up a bit and talk about how SDL 2 on Android works. Android development is mostly Java based and SDL is a C based library. The <b>N</b>ative <b>D</b>evelopment <b>K</b>it that allows Java to interface with native
C/C++ code using the <b>J</b>ava <b>N</b>ative <b>I</b>nterface. With the NDK, we'll build SDL2 as a <b>s</b>hared <b>o</b>bject that will interface with Java, and we'll build our game as another shared object that will
interface with SDL 2.<br/>
<br/>
What we need to do is tell gradle (the build tool used by Android Studio) to use the Android make file for our project. Open up the project window, right click on app and select
"Link C++ with Gradle".
<div class="text-center"><img class="img-fluid" alt="link with gradle" src="link_cpp_with_gradle.png"></div>
<br/>
Set the Build System to ndk-build and set the project path to point to the Android make file which should be at <code>C:\androidprojects\SDL\app\src\main\jni\Android.mk</code>.
<div class="text-center"><img class="img-fluid" alt="select android mk" src="select_android_mk.png"></div>
Hit Build -> Make Project and you'll get a bunch of new errors saying something like <code>Error:(688) Android NDK: Module main depends on undefined modules: SDL2</code><br/>
<br/>
<a name="15" href="index.php#15">15)</a> What the previous error was complaining about was that it can't find the SDL 2 module. What we need to do is set up a symbolic link to
the SDL 2 source we extracted.<br/>
<br/>
Next, go to the start menu and run cmd as administrator:
<div class="text-center"><img class="img-fluid" alt="cmd as admin" src="run_cmd_as_admin.png"></div>
<br/>
Go to the JNI directory inside the project using this command: <code>cd "C:\androidprojects\SDL\app\src\main\jni"</code><br/>
<br/>
And create a symbolic link directory to the SDL 2 source directory we extracted (<b>REMEMBER: This path will vary depending on your version of SDL 2</b>): <code>mklink /D SDL2 C:\androidlib\SDL2-2.0.5</code><br/>
<br/>
You should get the following message back <code>symbolic link created for SDL2 <<===>> C:\androidlib\SDL2-2.0.5</code><br/>
<br/>
Try to rebuild the project. You'll new a new error:<br/>
<code>Error:A problem occurred configuring project ':app'.
> executing external native build for ndkBuild C:\androidprojects\SDL\app\src\main\jni\Android.mk</code><br/>
<br/>
but at least now you'll see symbolic link in the project:
<div class="text-center"><img class="img-fluid" alt="symlink" src="symbolic_link_in_project.png"></div>
<br/>
<a name="16" href="index.php#16">16)</a> That gradle error didn't tell us much so we'll have to open up the gradle console:
<div class="text-center"><img class="img-fluid" alt="open gradle console" src="open_gradle_console.png"></div>
Scroll up a bit and you'll see some errors from the ndk-build:
<code>`C:/androidprojects/SDL/app/src/main/jni/src/YourSourceHere.c', needed by `C:/androidprojects/SDL/app/build/intermediates/ndkBuild/debug/obj/local/armeabi/objs-debug/main/YourSourceHere.o'.  Stop.</code><br/>
<br/>
In this case, the error "No rule to make target" actually means it can't find the file you're asking to compile. It's trying to compile <code>C:/androidprojects/SDL/app/src/main/jni/src/YourSourceHere.c</code> but can't find
it which makes sense because it doesn't exist. YourSourceHere.c is a place holder for our  application source file so we need to replace it with ours.<br/>
<br/>
Download the <a href="../52_hello_mobile.zip">source for lesson 52</a> and place 52_hello_mobile.cpp at
<code>C:\androidprojects\SDL\app\src\main\jni\src\52_hello_mobile.cpp</code>. Open up <code>C:\androidprojects\SDL\app\src\main\jni\src\Android.mk</code> and change <code>YourSourceHere.c</code> to
<code>52_hello_mobile.cpp</code>. Build and you should get a new error in the gradle build menu.<br/>
<br/>
<a name="17" href="index.php#17">17)</a> The error <code>Error:(7, 10) fatal error: 'string' file not found</code> is due to the fact that the project is not set up to use the standard C++ library. To fix this, open up
<code>C:\androidprojects\SDL\app\src\main\jni\Application.mk</code> and change <code># APP_STL := stlport_static</code> to <code>APP_STL := stlport_static</code> so it's no longer commmented out. Build again and you should get
no errors.<br/>
<br/>
<a name="18" href="index.php#18">18)</a> Open <code>C:\androidprojects\SDL\app\src\main\res\values\strings.xml</code> and change <code>&lt;string name="app_name"&gt;SDL App&lt;/string&gt;</code> to
<code>&lt;string name="app_name"&gt;SDL Tutorial&lt;/string&gt;</code><br/>
<br/>
This will change the name under the App's icon from "SDL App" to "SDL Tutorial".<br/>
<br/>
<a name="19" href="index.php#19">19)</a> At this point the app will run our code but it will fail because it can't load the media files for the tutorial. Media files go in
the asset directory. Create a folder called <code>assets</code> at <code>C:\androidprojects\SDL\app\src\main\assets</code>. Copy the directory inside of the zip we downloaded and place it in the assets
directory. If the application needs to open <code>52_hello_mobile\hello.bmp</code>, it needs to be at <code>C:\androidprojects\SDL\app\src\main\assets\52_hello_mobile\hello.bmp</code> when building.<br/>
<br/>
<a name="20" href="index.php#20">20)</a> Our SDL application is ready to build and run, but first we need to set up our device. You can use an Android emulator, but the
emulator is can be really, really slow so I recommend getting an Android device if you can.<br/>
<br/>
First you'll need to enable USB debugging on your device. That is version/device specific which is why I won't go over it here. Google search "android enable usb debugging" with your device name and they'll show you how to
do it.<br/>
<br/>
Make sure you have the device drivers installed on your Windows machine. The driver you downloaded from Android Studio should be located at <code>C:\androidsdk\extras\google\usb_driver</code> which may work with your device or
your device may require a driver from the manufacturer. Either way, make sure to check in the Windows Device Manager that your device has its drivers installed. Without the drivers, ADB (Android Debug Bridge) won't connect
and you won't be able to deploy and debug on your device.<br/>
<br/>
After you set up your Android device, go to Run -> run App.
<div class="text-center"><img class="img-fluid" alt="run app" src="run_app.png"></div>
<br/>
If you want to see the console output of the app, you can see it in the Android Monitor:
<br/>
<div class="text-center"><img class="img-fluid" alt="android monitor" src="android_monitor.png"></div>
The Android Monitor can also show you if there are any ADB errors.<br/> 
<br/>
Now that you have SDL 2 running on your device, it's time to go onto part 2 of the tutorial.

</div>
                    
                
                    
                        <div class="container border py-3 my-3">




<a href="../index2.php">Hello Mobile Part 2: Your First Mobile SDL 2 App</a><br/>




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