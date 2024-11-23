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
<meta name="keywords" content="Lazy Foo' Productions freeGLUT glut C++ OpenGL Tutorial 2D 3D Windows Linux Mac Game Programming Tutorials">
<meta name="description" content="A beginners guide for OpenGL.">

<link href="../../assets/style.css" rel="stylesheet">
<script src="../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - OpenGL Tutorials</title>

<script src="../../assets/light-dark-loader.js"></script>


	</head>
	
	<body>

	    
<header>

<h1 class="text-center">Lazy Foo' Productions</h1>

<nav class="nav justify-content-center">
	<a href="https://discourse.libsdl.org/" class="nav-item nav-link">SDL Forums <img alt="external link" src="../../assets/external-link.svg"></a>
	<a href="../SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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
    <h1 class="text-center">OpenGL Tutorials</h1>
    
    <p class="text-center"><b>Last Updated: Oct 19th, 2014</b></p>
    
        OpenGL is a powerful cross platform graphics API. With OpenGL, you can get hardware accelerated 2D and 3D rendering. This tutorial set was made to give beginners a
head start by going through the basics of OpenGL usage.<br/>
<br/>
For this tutorial we'll be starting using the OpenGL 2.1 era code to get started with the basics. Then we'll transition to
<a href="index.php#Hello GLSL">modern OpenGL 3.0+</a> shader based programs.<br/>
<br/>
Make sure to check out the <a href="../../faq.php">Frequently Asked OpenGL Tutorial Questions</a>. If you're having trouble with vector math, check
out my <a href="../../articles/article10/index.php">OpenGL Math Primer</a>.

    
    
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
                    <a href="00_introduction/index.php" name="The Introduction to Introduction to OpenGL">The Introduction to Introduction to OpenGL</a><br>
                </td>
                <td class="text-start">
                    What we will be covering in this OpenGL Tutorial.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="01_hello_opengl/index.php" name="Hello OpenGL">Hello OpenGL</a><br>
                </td>
                <td class="text-start">
                    Render your first polygon with OpenGL.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="02_matrices_and_coloring_polygons/index.php" name="Matrices and Coloring Polygons">Matrices and Coloring Polygons</a><br>
                </td>
                <td class="text-start">
                    Learn to add color to your OpenGL polygons.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="03_the_viewport/index.php" name="The Viewport">The Viewport</a><br>
                </td>
                <td class="text-start">
                    Learn to control rendering in your OpenGL Window using the viewport.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="04_scrolling_and_the_matrix_stack/index.php" name="Scrolling and the Matrix Stack">Scrolling and the Matrix Stack</a><br>
                </td>
                <td class="text-start">
                    Learn to scroll your scene using matrices.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="05_texture_mapping_and_pixel_manipulation/index.php" name="Texture Mapping and Pixel Manipulation">Texture Mapping and Pixel Manipulation</a><br>
                </td>
                <td class="text-start">
                    Learn to take pixels and turn them into OpenGL textures.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="06_loading_a_texture/index.php" name="Loading a Texture">Loading a Texture</a><br>
                </td>
                <td class="text-start">
                    Learn to load texture images using DevIL.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="07_clipping_textures/index.php" name="Clipping Textures">Clipping Textures</a><br>
                </td>
                <td class="text-start">
                    Learn to clip portions of an OpenGL texture.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="08_non_power_of_2_textures/index.php" name="Non-Power-of-Two Textures">Non-Power-of-Two Textures</a><br>
                </td>
                <td class="text-start">
                    Learn to render OpenGL textures of any size.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="09_updating_textures/index.php" name="Updating Textures">Updating Textures</a><br>
                </td>
                <td class="text-start">
                    Learn to update texture pixels.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="10_color_keying_and_blending/index.php" name="Color Keying and Blending">Color Keying and Blending</a><br>
                </td>
                <td class="text-start">
                    Learn to make images transparent using blending.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="11_stretching_and_filters/index.php" name="Stretching and Filters">Stretching and Filters</a><br>
                </td>
                <td class="text-start">
                    Learn to stretch and scale images with OpenGL.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="12_rotation/index.php" name="Rotation">Rotation</a><br>
                </td>
                <td class="text-start">
                    Learn to rotate images with OpenGL.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="13_matrix_transformations/index.php" name="Matrix Transformations">Matrix Transformations</a><br>
                </td>
                <td class="text-start">
                    Learn to transform your OpenGL texture mapped quads.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="14_repeating_textures/index.php" name="Repeating Textures">Repeating Textures</a><br>
                </td>
                <td class="text-start">
                    Learn to tile textures in OpenGL.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="15_extensions_and_glew/index.php" name="Extensions and GLEW">Extensions and GLEW</a><br>
                </td>
                <td class="text-start">
                    Learn to use extended OpenGL using GLEW.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="16_vertex_arrays/index.php" name="Vertex Arrays">Vertex Arrays</a><br>
                </td>
                <td class="text-start">
                    Learn to render OpenGL polygons using Vertex Arrays.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="17_vertex_buffer_objects/index.php" name="Vertex Buffer Objects">Vertex Buffer Objects</a><br>
                </td>
                <td class="text-start">
                    Learn to render a polygon using modern OpenGL vertex buffer objects.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="18_textured_vertex_buffers/index.php" name="Textured Vertex Buffers">Textured Vertex Buffers</a><br>
                </td>
                <td class="text-start">
                    Learn to render an OpenGL texture using modern VBO.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="19_sprite_sheets/index.php" name="Sprite Sheets">Sprite Sheets</a><br>
                </td>
                <td class="text-start">
                    Learn to use multiple images per OpenGL texture using VBO sprite sheets.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="20_bitmap_fonts/index.php" name="Bitmap Fonts">Bitmap Fonts</a><br>
                </td>
                <td class="text-start">
                    Learn to load and render an OpenGL bitmap font.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="21_alpha_textures/index.php" name="Alpha Textures">Alpha Textures</a><br>
                </td>
                <td class="text-start">
                    Learn to use 8bit alpha textures for transparency blending.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="22_texture_blitting_and_texture_padding/index.php" name="Texture Blitting and Texture Padding">Texture Blitting and Texture Padding</a><br>
                </td>
                <td class="text-start">
                    Learn to blit one OpenGL texture onto another.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="23_freetype_fonts/index.php" name="FreeType Fonts">FreeType Fonts</a><br>
                </td>
                <td class="text-start">
                    Learn to render FreeType fonts using OpenGL.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="24_text_alignment/index.php" name="Text Alignment">Text Alignment</a><br>
                </td>
                <td class="text-start">
                    Learn to align and center OpenGL text.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="25_transforming_text/index.php" name="Transforming Text">Transforming Text</a><br>
                </td>
                <td class="text-start">
                    Learn to rotate and scale OpenGL text.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="26_the_stencil_buffer/index.php" name="The Stencil Buffer">The Stencil Buffer</a><br>
                </td>
                <td class="text-start">
                    Learn to stencil your scene using the OpenGL stencil buffer.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="27_frame_buffer_objects_and_render_to_texture/index.php" name="Frame Buffer Objects and Render to Texture">Frame Buffer Objects and Render to Texture</a><br>
                </td>
                <td class="text-start">
                    Learn to render your scene to a taxture using a Frame Buffer Object (FBO).
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="28_antialiasing_and_multisampling/index.php" name="Antialiasing and Multisampling">Antialiasing and Multisampling</a><br>
                </td>
                <td class="text-start">
                    Learn to render smooth polygons in OpenGL.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="29_hello_glsl/index.php" name="Hello GLSL">Hello GLSL</a><br>
                </td>
                <td class="text-start">
                    Learn to create GLSL shader programs.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="30_loading_text_file_shaders/index.php" name="Loading Text File Shaders">Loading Text File Shaders</a><br>
                </td>
                <td class="text-start">
                    Learn to load GLSL shaders from a text file.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="31_glsl_matrices_color_and_uniforms/index.php" name="GLSL Matrices, Color, and Uniforms">GLSL Matrices, Color, and Uniforms</a><br>
                </td>
                <td class="text-start">
                    Learn to set uniform variables to give polygons color.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="32_glm_matrices/index.php" name="GLM Matrices">GLM Matrices</a><br>
                </td>
                <td class="text-start">
                    Learn to use GLM matrices with GLSL.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="33_multi-color_polygons_and_attributes/index.php" name="Multi-Color Polygons and Attributes">Multi-Color Polygons and Attributes</a><br>
                </td>
                <td class="text-start">
                    Learn to use GLSL attributes in a shader program.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="34_glsl_texturing/index.php" name="GLSL Texturing">GLSL Texturing</a><br>
                </td>
                <td class="text-start">
                    Learn to render a texture using OpenGL 3.0 GLSL.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="35_glsl_font/index.php" name="GLSL Font">GLSL Font</a><br>
                </td>
                <td class="text-start">
                    Learn to render a OpenGL Font using OpenGL 3.0 GLSL methods.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="36_vertex_array_objects/index.php" name="Vertex Array Objects">Vertex Array Objects</a><br>
                </td>
                <td class="text-start">
                    Learn to use Vertex Array Objects in this VAO Tutorial.
                </td>
            </tr>
            
        
            
            <tr>
                <td class="text-end">
                    <a href="99_conclusion/index.php" name="Conclusion to Introduction to OpenGL">Conclusion to Introduction to OpenGL</a><br>
                </td>
                <td class="text-start">
                    The OpenGL Tutorial conclusion. Thanks for visiting!
                </td>
            </tr>
            
        
            
        
    </tbody>
 </table>
                    
                
                    
                        <div class="container border py-3 my-3">




I am not claiming to know everything there is to know about programming/C++/OpenGL, but I have gained knowledge from the OpenGL projects I've worked on. These
tutorials are made to pass on the knowledge I gained to those just starting out and to make OpenGL much less intimidating to beginners. I try to keep my code and
tutorials as bug free as possible. If you find any errors please report them to me. Suggestions are also welcome.<br/>
<br/>
So if you have any suggestions, comments, questions, bugs reports, typos, or anything else you want to say about the tutorials, feel free to
<a href="../../contact.php">contact me</a>.




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
	<a href="../SDL/index.php" class="nav-item nav-link">SDL Tutorials</a>
	<a href="../../articles/index.php" class="nav-item nav-link">Articles</a>
	<a href="index.php" class="nav-item nav-link">OpenGL Tutorials</a>
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