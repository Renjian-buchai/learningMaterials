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
<meta name="keywords" content="C++ 2D Windows Linux Mac artificial intelligence">
<meta name="description" content="Learn the basics of how to make your game think.">

<link href="../../assets/style.css" rel="stylesheet">
<script src="../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>

<title>Lazy Foo' Productions - What is AI?</title>

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
    <h1 class="text-center">What is AI?</h1>
    
    <p class="text-center"><b>Last Updated: Nov 19th, 2011</b></p>
    
        Artificial Intelligence is a complex subject. There are volumes upon volumes written the subject and they can't
all be covered in a single article. What this article is here to do is give you a starting point and give you some
basics so you can implement some AI in your game.

    
    
</div>
                    
                
                    
                        <div class="container border py-3 my-3">
    Artificial Intelligence is about modeling a problem in such a way that a computer can complete a task.<br/>
<br/>
What does that mean? Let's jump right in with an example.<br/>
<br/>
Tic Tac Toe is a common beginner game to make. Most people who make tic tac toe have little problem making the
grid show, handling user input, and checking for wins. A lot of the time though, they'll have trouble making the
AI for the game.<br/>
<br/>
What you could do is give the computer opponent some sort of pattern to follow.

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">     //If the space is empty
    if( grid[ TOP_LEFT ] == GRID_EMPTY )
    {
        //Fill the space with the CPU's character
        grid[ TOP_LEFT ] = AIChar;
    }
    else if( grid[ TOP_CENTER ] == GRID_EMPTY )
    {
        //Fill the space with the CPU's character
        grid[ TOP_CENTER ] = AIChar;
    }
    else if( grid[ TOP_RIGHT ] == GRID_EMPTY )
    {
        //Fill the space with the CPU's character
        grid[ TOP_RIGHT ] = AIChar;
    }
    else if( grid[ MID_LEFT ] == GRID_EMPTY )
    {
        //Fill the space with the CPU's character
        grid[ MID_LEFT ] = AIChar;
    }
    else if( grid[ MID_CENTER ] == GRID_EMPTY )
    {
        //Fill the space with the CPU's character
        grid[ MID_CENTER ] = AIChar;
    }
    else if( grid[ MID_RIGHT ] == GRID_EMPTY )
    {
        //Fill the space with the CPU's character
        grid[ MID_RIGHT ] = AIChar;
    }
    else if( grid[ BOTTOM_LEFT ] == GRID_EMPTY )
    {
        //Fill the space with the CPU's character
        grid[ BOTTOM_LEFT ] = AIChar;
    }
    else if( grid[ BOTTOM_CENTER ] == GRID_EMPTY )
    {
        //Fill the space with the CPU's character
        grid[ BOTTOM_CENTER ] = AIChar;
    }
    else if( grid[ BOTTOM_RIGHT ] == GRID_EMPTY )
    {
        //Fill the space with the CPU's character
        grid[ BOTTOM_RIGHT ] = AIChar;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here the computer just makes a (pretty dumb) set sequence of moves. The problem with this is that the player will
quickly pick up on this pattern and easily defeat the computer. Well how do we give the computer some Artificial
Intelligence to make it somewhat smart?<br/>
<br/>
Artificial Intelligence in the most basic sense is a set of instructions the computer has to handle a situation. In
this case, the computer has to win a game of tic tac toe against a human player. Now the question is how do
you make computer make the move?<br/>
<br/>
Well the most basic type of AI you can make for tic tac toe is an opponent that makes moves at random. Let's take
a look of what the AI of an opponent that makes moves at random would look like.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//While a move hasn't been made
while( moveMade == false )
{
    //Pick a random space
    int space = rand() % GRID_SPACES;
	
    //If the space is empty
    if( grid[ space ] == GRID_EMPTY )
    {
        //Fill the space with the CPU's character
        grid[ space ] = AIChar;
        moveMade = true;
    }
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">First, this chunk of code selects a space at random. Then we have to check if it's a empty space. If the move is
a valid one, we fill the space with the computer's character (X or O). If the move is invalid, we keep picking a
new space until we find an empty one.<br/>
<br/>
However, for artificial intelligence, this isn't all that intelligent. Real AI has some sort of logic that understands
the situation it has deal with. Since the goal of the game is to get 3 in a row, we need to give the computer the ability
to complete rows.<br/>
<br/>
<div class="text-center">In tic tac toe there are 8 rows you can make:<br/>
<img class="img-fluid" alt="tic tac toe" src="row1.jpg"><img class="img-fluid" alt="tic tac toe" src="row2.jpg"><img class="img-fluid" alt="tic tac toe" src="row3.jpg"><img class="img-fluid" alt="tic tac toe" src="row4.jpg"><br/>
<img class="img-fluid" alt="tic tac toe" src="row5.jpg"><img class="img-fluid" alt="tic tac toe" src="row6.jpg"><img class="img-fluid" alt="tic tac toe" src="row7.jpg"><img class="img-fluid" alt="tic tac toe" src="row8.jpg">
</div>
<br/>
<div class="text-center">For each row there are 3 ways to complete it:<br/>
<img class="img-fluid" alt="tic tac toe" src="complete1.jpg"><img class="img-fluid" alt="tic tac toe" src="complete2.jpg"><img class="img-fluid" alt="tic tac toe" src="complete3.jpg">
</div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Complete the top row
    if( ( grid[ TOP_LEFT ] == GRID_EMPTY ) && ( grid[ TOP_CENTER ] == AIChar ) && ( grid[ TOP_RIGHT ] == AIChar ) )
    {
        //Fill the space with the CPU's character
        grid[ TOP_LEFT ] = AIChar;
        moveMade = true;
    }
    else if( ( grid[ TOP_LEFT ] == AIChar ) && ( grid[ TOP_CENTER ] == GRID_EMPTY ) && ( grid[ TOP_RIGHT ] == AIChar ) )
    {
        //Fill the space with the CPU's character
        grid[ TOP_CENTER ] = AIChar;
        moveMade = true;
    }
    else if( ( grid[ TOP_LEFT ] == AIChar ) && ( grid[ TOP_CENTER ] == AIChar ) && ( grid[ TOP_RIGHT ] == GRID_EMPTY ) )
    {
        //Fill the space with the CPU's character
        grid[ TOP_RIGHT ] = AIChar;
        moveMade = true;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">The code to complete the top row would look something like this. The computer now knows how to complete the top
row to win. Then you would do the same for the other 7 rows. If you can do the code for one row, you can do it for
any of them.<br/>
<br/>
Now that the computer has some basic offense, we should give it some defensive strategy. We'll do this by giving
it the ability to block the user's rows.<br/>
<br/>
<div class="text-center">Much like completing a row, there are 3 ways to block a row:<br/>
<img class="img-fluid" alt="tic tac toe" src="block1.jpg"><img class="img-fluid" alt="tic tac toe" src="block2.jpg"><img class="img-fluid" alt="tic tac toe" src="block3.jpg">
</div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Block the top row
    if( ( grid[ TOP_LEFT ] == GRID_EMPTY ) && ( grid[ TOP_CENTER ] == playerChar ) && ( grid[ TOP_RIGHT ] == playerChar ) )
    {
        //Fill the space with the CPU's character
        grid[ TOP_LEFT ] = AIChar;
        moveMade = true;
    }
    else if( ( grid[ TOP_LEFT ] == playerChar ) && ( grid[ TOP_CENTER ] == GRID_EMPTY ) && ( grid[ TOP_RIGHT ] == playerChar ) )
    {
        //Fill the space with the CPU's character
        grid[ TOP_CENTER ] = AIChar;
        moveMade = true;
    }
    else if( ( grid[ TOP_LEFT ] == playerChar ) && ( grid[ TOP_CENTER ] == playerChar ) && ( grid[ TOP_RIGHT ] == GRID_EMPTY ) )
    {
        //Fill the space with the CPU's character
        grid[ TOP_RIGHT ] = AIChar;
        moveMade = true;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">So it only makes sense that the code to block a row looks almost exactly the same as the
code to complete a row. In fact you could with the proper tweaks make a function that both completes and blocks
row depending on the arguments.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void CPUOpponent::make_move()
{     
    block_row();
    complete_row();
    rand_move();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's what an AI function for a tic tac toe game might look like. It's simple AI that first tries to block a
user victory, then tries complete any rows. If there's nothing to complete or block, it just makes a random move.<br/>
<br/>
However, there is something seriously wrong with how this works. You don't see it? Well let's see how it would run.<br/>
<br/>
<div class="text-center">Say the user just did something like this:<br/>
<img class="img-fluid" alt="dumb" src="dumb.jpg"><br/>
This is a sure victory for the computer right?
</div>
<br/>
<div class="text-center">This is what the AI is going to do:<br/>
<img class="img-fluid" alt="dumber" src="dumber.jpg"><br/>
</div><br/>
<br/>
Like with game loops, the AI has to do things in the right order to work properly. Blocking has higher priority,
so even if the computer can win in this move, it's going to try to block the user first. This means the
complete_row() function should go before the block_row() function. It doesn't matter how nice your AI algorthims
look, if they don't happen in the right order they aren't going to work. So be careful how you prioritize your AI
actions.<br/>
<br/>
Now that your AI has basic offensive and defensive abilities, you probably want to put some higher level strategy.
We'll do this by adding in some traps. The best way to explain a trap is by example.<br/>
<br/>
<div class="text-center">Let's say the player does this:<br/>
<img class="img-fluid" alt="trap" src="pretrap.jpg"><br/>
</div>
<br/>
<div class="text-center">If the computer makes this trap:<br/>
<img class="img-fluid" alt="trap" src="trap.jpg"><br/>
</div>
<br/>
<div class="text-center">No matter what the player does, the computer will win:<br/>
<img class="img-fluid" alt="trap" src="win1.jpg"><img class="img-fluid" alt="trap" src="win2.jpg"><br/>
</div>
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">    //Set trap
    if( ( grid[ BOTTOM_LEFT ] == AIChar ) && ( grid[ MID_CENTER ] == AIChar )
    && ( grid[ TOP_LEFT ] == GRID_EMPTY ) && ( grid[ BOTTOM_CENTER ] == GRID_EMPTY ) && ( grid[ BOTTOM_RIGHT ] == GRID_EMPTY ) )
    {
        //Fill the space with the CPU's character
        grid[ BOTTOM_RIGHT ] = AIChar;
        moveMade = true;
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's what the code of this trap would look like. The AI checks that the right spaces are empty and that the
right spaces have the AI's character and then it sets the trap.<br/>
<br/>
How many traps are there? Each trap requires two rows that share a space.<br/>
<br/>
<div class="text-center">In this example it was these two:<br/>
<img class="img-fluid" alt="tic tac toe" src="row3.jpg"><img class="img-fluid" alt="tic tac toe" src="row8.jpg"><br/>
</div>
<br/>
This means there are is a set of traps for each unique pair of rows. For each of those pairs, there must be 3
spaces with the AI's character, one being the space they share.<br/>
<br/>
<div class="text-center">Here are all the traps for this pair of rows:<br/>
<img class="img-fluid" alt="tic tac toe" src="trapset1.jpg"><img class="img-fluid" alt="tic tac toe" src="trapset2.jpg"><img class="img-fluid" alt="tic tac toe" src="trapset3.jpg"><img class="img-fluid" alt="tic tac toe" src="trapset4.jpg"><br/>
</div>
<br/>
<div class="text-center">For each trap there 3 ways to complete it:<br/>
<img class="img-fluid" alt="tic tac toe" src="trapcomplete1.jpg"><img class="img-fluid" alt="tic tac toe" src="trapcomplete2.jpg"><img class="img-fluid" alt="tic tac toe" src="trapcomplete3.jpg"><br/>
</div>
<br/>
So now you know how to make every single possible trap. Blocking a trap is almost exactly like completing a trap.
As with blocking rows you simply detect a possible trap by the player, then you put the AI's character in the
place that would complete the player's trap.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void CPUOpponent::make_move()
{ 
    complete_row();
    block_row();
    set_trap();
    block_trap();
    rand_move();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">This is what an AI function with all the actions we talked about would look like. Again notice how the actions are
prioritized. We have the move fundamental actions of completing and blocking rows go first. Then we have higher
level strategies of setting and blocking traps. Lastly, we have a function to make a move at random so if
there isn't any important actions to do, the AI will not just sit there and do nothing.<br/>
<br/>
<b>If you skipped past the most of the article because tic tac toe is boring, resume reading here.</b><br/>
<br/>
This may seem boring, but all these fundamental AI concepts apply to many different types of games. First we
talked about giving the computer some patterns to follow. This can work in situations where AI isn't important
like shoot 'em ups or generic enemies in a platformer.<br/>
<br/>
Then we covered making sure that the AI makes a valid move. In an RPG for example, you can have an enemy cast
a magic spell against the player, but you have to design the AI so it can't use the spell if it doesn't have enough
magic points or if it isn't at a high enough level to use it.<br/>
<br/>
After that, we talked about giving the AI the basic action it needs to win and defend itself against the player.
In a shooter, you should have the AI shoot at an enemy when they see one and pick up a nearby health pack when
they're low on health. You should also have the AI properly prioritize these actions. If there's a health pack
nearby and the AI encountered an enemy, it should be able to judge whether its primary concern is going for the
health or finishing the enemy.<br/>
<br/>
Then there's higher level strategy like in a war simulation. You can make the fighters have different formations to
maximize the damage they can do as a team. When you have different levels of strategy you have to properly layer
them. Let's say you have a set of fighters trying to surround an enemy, but some of those fighters are being
attacked by other enemies. Those units should know to try to stay alive because they're no good in surrounding an
enemy if they're dead. <br/>
<br/>
When we covered making the AI for all this, we had to think about what were the possible situations the AI could
run into. So when you make your AI, you have to think "what moves can be used by the player", "what obstacles
could I run into?", "what weapons can I use?", etc, etc.<br/>
<br/>
Lastly we talked about implementing some sort of idle fail safe. In the tic tac toe game, if there's nothing to
set up or block, we have it pick a move at random. This sort of concept applies to other games, too. At the start
of a round in a game, since there's nothing to shoot at, no items to pick up, or no enemies to surround, the
computer is just going to stand there.<br/>
<br/>
When coming up with AI, it's a waste of time coming up with an action for
every single possible specific situation. So if the AI has nothing to do, you can have it pick an action or
strategy at random and have it follow through with that. You can have it take the high way, the low way, the side
way, or you can have it pick a location and camp it. It's much better than having it do nothing. 
</div>



                    
                
                    
                        <div class="container border py-3 my-3">
    Obviously most video games are more complicated than tic tac toe. The only moves a player can make is putting a
character in an empty space. What about all the other games that have objects moving all over the place and
doing all their various actions? Let's jump right into an example with Street Fighter 3: 3rd Strike.<br/>
<br/>
<div class="text-center">When player gets in close enough, we'll have the AI punch them:<br/>
<img class="img-fluid" alt="street fighter" src="range.png"><img class="img-fluid" alt="street fighter" src="punch.png">
</div>

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">void CPUOpponent::make_move()
{
    if( opponent->is_in_punch_range() )
    {
        punch(); 
    }
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's some over simplified psuedo AI code that hits the opponent if they're nearby. Any of you that played the
game know there's a problem with this code.<br/>
<br/>
<div class="text-center">If the AI tries to punch the opponent while they're doing a super, they're going to get hit:<br/>
<img class="img-fluid" alt="street fighter" src="super.png"><img class="img-fluid" alt="street fighter" src="hit.png">
</div>
<br/>
How do we take into account all the actions the opponent can do? We can do it with a state machine.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">switch( opponent->state() )
{
    case STATE_STANDING:
    dash_toward_opponent();
    break;
    
    case STATE_JUMPING:
    jump_and_attack();
    break;
    
    case STATE_SWEEPING:
    punch();
    break;
    
    case STATE_SUPER:
    block();
    break;
    
    case STATE_PUNCHING:
    parry();
    break;
    
    case STATE_KICKING:
    do_this();
    break;
    
    case STATE_WALKING:
    do_that();
    break;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's some more over simplified psuedo AI code, but this time it uses a state machine. Now the AI will know to
block when the opponent is doing a super even if they're within punch range.<br/>
<br/>
State based AI has the computer take action depending what the opponent is doing, so it can take a counter
measure. State based AI applies to just about any game:
<ul>
<li>If the player is shooting at the AI player, head towards cover.</li>
<li>If the player threw a fire ball, try to dodge it.</li>
<li>If the player has poisoned the AI player, cast a healing spell.</li>
<li>If the player is about to catch the ball, try to intercept it.</li>
<li>If the player is attacking the base, go and defend it.</li>
</ul>
So when you design you AI, think about the various actions the player can take and have a set of actions for
each of those situations.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">
    Another thing to watch out for when designing AI is making the AI "too smart". Computers can
make thousand upon thousands of calculations per second. They can in an instant calculate the precise angle to aim
at the player to kill them instantly with a head shot. The reaction time of a computer is a tiny fraction of a
second so it will notice you doing a move before your action is rendered to the screen. It can calculate the
range of a collision box down to a pixel. It can also instantly find out the location of anything in the game.
If you make your AI too hard, people won't want to play your game.<br/>
<br/>
Let's do some pong AI for example.

</div>
                    
                
                    
                        

<pre class="border my-0 py-3">//Set paddle offset
paddle.y = ball.get_y();
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">With this code, the paddle will always line up with the ball and it will never miss. This means the AI will never
lose.<br/>
<br/>
In order to give your AI a more human like feel, you have to give it some inaccuracy.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Try to hit the ball
if( paddle.y < ball.get_y() )
{
    paddle.y += speed;
}
else if( paddle.y > ball.get_y() )
{
    paddle.y -= speed;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Now this AI is more playable. Instead of always lining up with the ball, it moves toward it at a varying speed.
This mean it could not get to the ball on time or it could over shoot the ball. Now a human has a chance of
beating AI.<br/>
<br/>
A human can't instantly react to something, so your AI should wait a reasonable amount of time before reacting.
A human can't instantly find out what "player.x" and "player.y" are so the AI should have to look for the opponent.
So when you design your AI make sure to ask yourself "Can a human do this?".<br/>
<br/>
This brings me to my next topic of varying difficulty. It's a common feature for video games to have multiple
difficulty settings. This is so people new to the game don't get frustrated because it's too hard and people who
already have experience with the game don't get bored because it's become too easy. It's also good game design to
have the difficulty of the game to steadily increase as you progress so it doesn't become repetitive.
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">//Set paddle speed
speed = level * 10;

//Try to hit the ball
if( paddle.y < ball.get_y() )
{
    paddle.y += speed;
}
else if( paddle.y > ball.get_y() )
{
    paddle.y -= speed;
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's the pong AI once again.
Now as the difficulty level increases, the paddle moves faster so it becomes harder to defeat.<br/>
<br/>
The key to having variable difficulty is to have different actions depending on the difficulty setting. The harder
the difficulty the more aggressive, skilled, and intelligent the AI should be. For the easier difficulties, the AI
should just use the most basic actions, and maybe you could lower it's ability to aim or react. 
</div>



                    
                
                    
                        

<pre class="border my-0 py-3">void CPUOpponent::make_move()
{
    if( difficulty >= EASY )
    {
        complete_row();
        block_row();
    }
    if( difficulty >= NORMAL ) 
    {
        set_trap();
    }
    if( difficulty == HARD )
    {
        block_trap();
    }
    
    rand_move();
}
</pre>


    <div class="container border-start border-end border-bottom py-3 mb-3">Here's another example of variable AI with tic tac toe.<br/>
<br/>
On the easy difficulty the AI will just do the minimum of completing and blocking rows. On normal it will try to
trap you when it can. On hard it will also try to block your traps. So as the difficulty increases, the AI uses
better tactics to defeat the player.<br/>
<br/>
We've only scratched the surface of what AI is. I tried to cover the basic concepts that can be applied to most
games. There's so much more that goes into AI like knowledge of geometry, linear algebra, statistics, path finding algorithms,
constraint satisfaction problems, and even psychology. Hopefully now you at least have enough to get started.
</div>



                    
                
                    
                        <div class="container border py-3 my-3">




If you have any suggestions to improve this article, It would be great if you <a href="../../contact.php">contacted me</a> so I can improve this article.



<a href="../index.php#What is AI">Back to Index</a>


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