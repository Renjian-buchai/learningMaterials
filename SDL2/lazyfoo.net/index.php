<!-- Get tutorial set -->


<!-- Tutorial root -->



    
    

                    

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
<meta name="keywords" content="Lazy Foo' Productions C++ SDL 2 Tutorial 2D Windows Linux Mac Game Programming Tutorials">
<meta name="description" content="A beginners guide for Game Programming.">

<link href="/assets/style.css" rel="stylesheet">
<script src="/assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - Beginning Game Programming v2.0</title>

<script src="/assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="/assets/external-link.svg"></a>
	<a href="/tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="/articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="/tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="/assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="/index.php" class="nav-item nav-link">News</a>
	<a href="/faq.php" class="nav-item nav-link">FAQs</a>
	<a href="/contact.php" class="nav-item nav-link">Contact</a>
	<a href="/donate.php" class="nav-item nav-link">Donations</a>
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
    <h1 class="text-center">Beginning Game Programming v2.0</h1>
    
    <p class="text-center"><b>Last Updated: Apr 26th, 2024</b></p>
    
        Greetings everyone, welcome to the ground up recoding of Beginning Game Programming with SDL. This time we will be coding with SDL 2 which has
been released on the <a class="tutLink" href="http://www.libsdl.org/">SDL website</a>.<br/>
<br/>
These tutorials were designed for C++ programmers who want to move from text based games to real time games with graphics. By the end of these tutorials, you'll know
the basics to make your first real video game!

    
    
</div>
                    
                
                    
                        <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th colspan="2" class="text-center">Table of Contents</th>
        </tr>
    </thead>
    <tbody>
        
            
            <tr>
                <td class="text-end">
                    <a href="01_hello_SDL/index.php" name="Hello SDL">Hello SDL</a><br>
                </td>
                <td class="text-start">
                    Get started making games with your first SDL App.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="02_getting_an_image_on_the_screen/index.php" name="Getting an Image on the Screen">Getting an Image on the Screen</a><br>
                </td>
                <td class="text-start">
                    Show images on the screen with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="03_event_driven_programming/index.php" name="Event Driven Programming">Event Driven Programming</a><br>
                </td>
                <td class="text-start">
                    Handle events with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="04_key_presses/index.php" name="Key Presses">Key Presses</a><br>
                </td>
                <td class="text-start">
                    Handle keys with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="05_optimized_surface_loading_and_soft_stretching/index.php" name="Optimized Surface Loading and Soft Stretching">Optimized Surface Loading and Soft Stretching</a><br>
                </td>
                <td class="text-start">
                    Optimize your loaded surfaces and stretch them with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="06_extension_libraries_and_loading_other_image_formats/index.php" name="Extension Libraries and Loading Other Image Formats">Extension Libraries and Loading Other Image Formats</a><br>
                </td>
                <td class="text-start">
                    Use SDL extension libraries like SDL_image, SDL_ttf, and SDL_mixer to add functionality to SDL.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="07_texture_loading_and_rendering/index.php" name="Texture Loading and Rendering">Texture Loading and Rendering</a><br>
                </td>
                <td class="text-start">
                    Render Hardware Accelerated Textures With SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="08_geometry_rendering/index.php" name="Geometry Rendering">Geometry Rendering</a><br>
                </td>
                <td class="text-start">
                    Render hardware accelerated shapes with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="09_the_viewport/index.php" name="The Viewport">The Viewport</a><br>
                </td>
                <td class="text-start">
                    Control your SDL rendering area with the viewport.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="10_color_keying/index.php" name="Color Keying">Color Keying</a><br>
                </td>
                <td class="text-start">
                    Render images with transparent backgrounds using color keying.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="11_clip_rendering_and_sprite_sheets/index.php" name="Clip Rendering and Sprite Sheets">Clip Rendering and Sprite Sheets</a><br>
                </td>
                <td class="text-start">
                    Render parts of textures to use sprite sheets.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="12_color_modulation/index.php" name="Color Modulation">Color Modulation</a><br>
                </td>
                <td class="text-start">
                    Change your texture's color using color modulation.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="13_alpha_blending/index.php" name="Alpha Blending">Alpha Blending</a><br>
                </td>
                <td class="text-start">
                    Render transparent textures with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="14_animated_sprites_and_vsync/index.php" name="Animated Sprites and VSync">Animated Sprites and VSync</a><br>
                </td>
                <td class="text-start">
                    Render animations in sync with the monitor refresh rate with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="15_rotation_and_flipping/index.php" name="Rotation and Flipping">Rotation and Flipping</a><br>
                </td>
                <td class="text-start">
                    Rotate and flip your textures in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="16_true_type_fonts/index.php" name="True Type Fonts">True Type Fonts</a><br>
                </td>
                <td class="text-start">
                    Render text with TTF fonts in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="17_mouse_events/index.php" name="Mouse Events">Mouse Events</a><br>
                </td>
                <td class="text-start">
                    Handle mouse input with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="18_key_states/index.php" name="Key States">Key States</a><br>
                </td>
                <td class="text-start">
                    Query current key state with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="19_gamepads_and_joysticks/index.php" name="Gamepads and Joysticks">Gamepads and Joysticks</a><br>
                </td>
                <td class="text-start">
                    Use gamepads and joysticks with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="20_force_feedback/index.php" name="Force Feedback">Force Feedback</a><br>
                </td>
                <td class="text-start">
                    Make your controllers rumble with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="21_sound_effects_and_music/index.php" name="Sound Effects and Music">Sound Effects and Music</a><br>
                </td>
                <td class="text-start">
                    Play sound with SDL2 and SDL_mixer.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="22_timing/index.php" name="Timing">Timing</a><br>
                </td>
                <td class="text-start">
                    Use time with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="23_advanced_timers/index.php" name="Advanced Timers">Advanced Timers</a><br>
                </td>
                <td class="text-start">
                    Start, stop, pause, and unpause timers with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="24_calculating_frame_rate/index.php" name="Calculating Frame Rate">Calculating Frame Rate</a><br>
                </td>
                <td class="text-start">
                    Calculate the frame rate for your SDL 2 applications.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="25_capping_frame_rate/index.php" name="Capping Frame Rate">Capping Frame Rate</a><br>
                </td>
                <td class="text-start">
                    Manually keep a constant frame rate with SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="26_motion/index.php" name="Motion">Motion</a><br>
                </td>
                <td class="text-start">
                    Move around game objects in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="27_collision_detection/index.php" name="Collision Detection">Collision Detection</a><br>
                </td>
                <td class="text-start">
                    Check for collision SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="28_per-pixel_collision_detection/index.php" name="Per-Pixel Collision Detection">Per-Pixel Collision Detection</a><br>
                </td>
                <td class="text-start">
                    Check collision with any image in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="29_circular_collision_detection/index.php" name="Circular Collision Detection">Circular Collision Detection</a><br>
                </td>
                <td class="text-start">
                    Check for collision with circles in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="30_scrolling/index.php" name="Scrolling">Scrolling</a><br>
                </td>
                <td class="text-start">
                    Scroll through levels with a camera in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="31_scrolling_backgrounds/index.php" name="Scrolling Backgrounds">Scrolling Backgrounds</a><br>
                </td>
                <td class="text-start">
                    Make infinite scrolling backgrounds in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="32_text_input_and_clipboard_handling/index.php" name="Text Input And Clipboard Handling">Text Input And Clipboard Handling</a><br>
                </td>
                <td class="text-start">
                    Use text input and the clipboard in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="33_file_reading_and_writing/index.php" name="File Reading and Writing">File Reading and Writing</a><br>
                </td>
                <td class="text-start">
                    Load and save binary files in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="34_audio_recording/index.php" name="Audio Recording">Audio Recording</a><br>
                </td>
                <td class="text-start">
                    Record and playback audio in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="35_window_events/index.php" name="Window Events">Window Events</a><br>
                </td>
                <td class="text-start">
                    Handle resizable windows in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="36_multiple_windows/index.php" name="Multiple Windows">Multiple Windows</a><br>
                </td>
                <td class="text-start">
                    Handle multiple windows in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="37_multiple_displays/index.php" name="Multiple Displays">Multiple Displays</a><br>
                </td>
                <td class="text-start">
                    Handle multiple monitors in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="38_particle_engines/index.php" name="Particle Engines">Particle Engines</a><br>
                </td>
                <td class="text-start">
                    Make particle effects in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="39_tiling/index.php" name="Tiling">Tiling</a><br>
                </td>
                <td class="text-start">
                    Make levels with tiling engines in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="40_texture_manipulation/index.php" name="Texture Manipulation">Texture Manipulation</a><br>
                </td>
                <td class="text-start">
                    Get and modify texture pixel data in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="41_bitmap_fonts/index.php" name="Bitmap Fonts">Bitmap Fonts</a><br>
                </td>
                <td class="text-start">
                    Render bitmap fonts in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="42_texture_streaming/index.php" name="Texture Streaming">Texture Streaming</a><br>
                </td>
                <td class="text-start">
                    Stream to textures in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="43_render_to_texture/index.php" name="Render to Texture">Render to Texture</a><br>
                </td>
                <td class="text-start">
                    Render to a texture in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="44_frame_independent_movement/index.php" name="Frame Independent Movement">Frame Independent Movement</a><br>
                </td>
                <td class="text-start">
                    Move around at any frame rate in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="45_timer_callbacks/index.php" name="Timer Callbacks">Timer Callbacks</a><br>
                </td>
                <td class="text-start">
                    Run timer callbacks in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="46_multithreading/index.php" name="Multithreading">Multithreading</a><br>
                </td>
                <td class="text-start">
                    Run multithreaded applications in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="47_semaphores/index.php" name="Semaphores">Semaphores</a><br>
                </td>
                <td class="text-start">
                    Lock data between threads in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="48_atomic_operations/index.php" name="Atomic Operations">Atomic Operations</a><br>
                </td>
                <td class="text-start">
                    Synchronize your threads at a CPU level in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="49_mutexes_and_conditions/index.php" name="Mutexes and Conditions">Mutexes and Conditions</a><br>
                </td>
                <td class="text-start">
                    Synchronize threads with signaling in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="50_SDL_and_opengl_2/index.php" name="SDL and OpenGL 2">SDL and OpenGL 2</a><br>
                </td>
                <td class="text-start">
                    Support Legacy OpenGL in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="51_SDL_and_modern_opengl/index.php" name="SDL and Modern OpenGL">SDL and Modern OpenGL</a><br>
                </td>
                <td class="text-start">
                    Make modern shader based OpenGL programs in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="52_hello_mobile/index.php" name="Hello Mobile">Hello Mobile</a><br>
                </td>
                <td class="text-start">
                    Port your Windows/Linux/MacOS games to Android/iOS.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="53_extensions_and_changing_orientation/index.php" name="Extensions and Changing Orientation">Extensions and Changing Orientation</a><br>
                </td>
                <td class="text-start">
                    Use SDL_image/SDL_ttf/SDL_mixer and handle orientation on Android/iOS.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="54_touches/index.php" name="Touches">Touches</a><br>
                </td>
                <td class="text-start">
                    Learn how to handle touch input from an Android/iOS device in SDL2.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="55_multitouch/index.php" name="Multi Touch">Multi Touch</a><br>
                </td>
                <td class="text-start">
                    Learn how to handle multi touch gestures on Android/iOS with SDL2.
                </td>
            </tr>
            
        
            
        
    </tbody>
 </table>
                    
                
                    
                        <div class="container border py-3 my-3">




If you find any bugs or typos in the tutorials please <a href="../../contact.php">contact me</a>.




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
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="/assets/external-link.svg"></a>
	<a href="/tutorials/SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="/articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="/tutorials/OpenGL/index.php" class="nav-item nav-link">OpenGL Tutorials</a>
	<a href="https://www.opengl.org/discussion_boards/forum.php" class="nav-item nav-link">OpenGL Forums <img alt="external link" src="/assets/external-link.svg"></a>
</nav>

<nav class="nav justify-content-center">
	<a href="https://www.facebook.com/lazyfooproductions/" class="nav-item nav-link">Follow Facebook</a>
	<a href="https://twitter.com/lazyfoo_net" class="nav-item nav-link">Follow Twitter</a>
</nav>

<nav class="nav justify-content-center">
	<a href="/index.php" class="nav-item nav-link">News</a>
	<a href="/faq.php" class="nav-item nav-link">FAQs</a>
	<a href="/contact.php" class="nav-item nav-link">Contact</a>
	<a href="/donate.php" class="nav-item nav-link">Donations</a>
</nav>
	<aside class="text-center">
    Copyright Lazy Foo' Productions 2004-2024<br/>
    <br/>
    <button type="button" class="btn btn-light my-10" id="btnToggle">Light Mode</button>
    </aside>

<script src="/assets/light-dark-toggle.js"></script>

</footer>

	</body>
</html>