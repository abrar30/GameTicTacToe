<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
/***
* Description: PHP 2 Player Tic Tac Toe 3x3
***/
require_once('inc/game.php');
require_once('inc/tictactoe.php');

//this will start the session and store session information
session_start();

//if Game not started, load one 
if ( !isset( $_SESSION['game']['tictactoe'] ) )
	$_SESSION['game']['tictactoe'] = new TicTacToe();

?>

<!--index.html-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tic Tac Toe</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    
    <link rel="stylesheet" type="text/css" href="Files/styles/style.css" />

    </head>
             
    <body>
        <div id="container">
            
            <div>
              <form name="tic-tac-toe" id="tic-tac-toe" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<?php $_SESSION['game']['tictactoe']->play_game( $_POST ); ?>
				</form>
		 
            </div>
            <div id="instruction">
                <p>Play Tic Tac Toe</p>
                <p>Press Take Turn to Switch turn</p>
            </div>
        
        </div>
        
        <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
		<script src="Files/scripts/main.js"></script>
    </body>
</html>

