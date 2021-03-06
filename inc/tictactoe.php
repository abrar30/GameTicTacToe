<?php

class TicTacToe extends Game {
    var $player = "X";          //whose turn is
    var $board = array();       //the tic tac toe board
    var $total_moves = 0;       //how many moves have been made so far      

   // default constructor
   
    function __construct() {
        /**
        * instantiate the parent game class so this class
        * inherits all of the game class's attributes 
        * and methods
        **/
        Game::start();
        $this->new_board();
    }
    
    // start a new tic tac toe game
   
    function new_game() {
        //setup the game
        $this->start();
        
        //reset the player
        $this->player = "X";
        $this->total_moves = 0;
        $this->new_board();
    }
    
    // create an empty board
   
    function new_board() {
    
        //clear out the board
        $this->board = array();
        
        //create the board array
        for ( $x = 0; $x <= 2; $x++ ) {
            for ( $y = 0; $y <= 2; $y++ ) {
                $this->board[$x][$y] = null;
            }
        }
    }
    
    // run the game until it's tied or someone has won
   
    function play_game( $data ) {
        if ( !$this->is_over() && isset( $data['move'] ) ) {
            $this->move( $data );
        }
            
        //player pressed the button to start a new game
        if ( isset( $data['newgame'] ) ) {
            $this->new_game();
        }
                
        //display the game
        $this->display_game();
    }
    
    // display the game interface
  
    function display_game() {
      
if ( !$this->is_over() ) {
        echo "<div class=\"alert player-turn\">It's player {$this->player}'s turn.</div>";
}
                //show game board
            echo "<table class=\"tic-tac-toe-board\">";
            
            for ( $x = 0; $x < 3; $x++ ) {

                echo "<tr class=\"form-row\">";

                for ( $y = 0; $y < 3; $y++ ) {
                    echo "<td class=\"board-cell form-group\">";
                    
                    //check to see if that position is already filled
                    //If it is, display disabled radio button field with value
                    if ( $this->board[$x][$y] ) {
                        echo "<label class=\"btn player-{$this->board[$x][$y]} disabled\"><input type=\"radio\" name=\"{$x}_{$y}\" value=\"{$this->board[$x][$y]}\" id=\"{$x}_{$y}\"><span>{$this->board[$x][$y]}</span></label>";
                    }
                    else {
                        //let them choose to put an x or o there
                        echo "<label class=\"btn player-{$this->player}\"><input type=\"radio\" name=\"{$x}_{$y}\" value=\"{$this->player}\" id=\"{$x}_{$y}\" onclick=\"console.log('clicked')\"><span>{$this->player}</span></label>";
                    }
                    
                    echo "</td>";
                }

                echo '</tr>';
                
            }
            
            echo "
            </table>
            <p>
            <input type=\"submit\" name=\"move\" value=\"Take Turn\" class=\"btn play-turn\" />
            </p>
            ";
        
            if($this->is_over()){
            //someone won the game or there was a tie
            if ( $this->is_over() != "Tie" )
                echo success_message( "Congratulations player " . $this->is_over() . ", you've won the game!" );
            else if ( $this->is_over() == "Tie" )
                echo error_message( "Whoops! Looks like you've had a tie game. Want to try again?" );
               
            
            session_destroy(); 
                
            echo "<p><input class=\"btn new-game\"  type=\"submit\" name=\"newgame\" value=\"New Game\" /></p>"; 
            }
        
    }
    
    // place an X or O on the board
    
    function move( $data ) {            

        if ( $this->is_over() )
            return;

        //remove duplicate entries on the board 
        $data = array_unique( $data );
        
        foreach ( $data as $key => $value ) {

            if ( $value == $this->player ) {    
                //update the board in that position with the player's X or O 
                $coords = explode( "_", $key );
                $this->board[$coords[0]][$coords[1]] = $this->player;

                //change the turn to the next player
                if ( $this->player == "X" )
                    $this->player = "O";
                else
                    $this->player = "X";
                    
                $this->total_moves++;
            }
        }
    
        if ( $this->is_over() )
            return;
    }
    
    //check a winner
  
    function is_over() {

        // top row
        // check first item has value && all values in row are the same
        // @return value of first item
        if( $this->board[0][0] && count( array_unique( $this->board[0] ) ) === 1 ) {
            return $this->board[0][0];
        }

        // middle row
        // check first item has value && all values in row are the same
        // @return value of first item
        if( $this->board[1][0] && count( array_unique( $this->board[1] ) ) === 1 ) {
            return $this->board[1][0];
        }

        // bottom row
        // check first item has value && all values in row are the same
        // @return value of first item
        if( $this->board[2][0] && count( array_unique( $this->board[2] ) ) === 1 ) {
            return $this->board[2][0];
        }
        
        // first column
        // check first item has value && all values in column are the same
        // @return value of first item
        if( $this->board[0][0] && count( array_unique( array( $this->board[0][0], $this->board[1][0], $this->board[2][0] ) ) ) === 1 ) {
            return $this->board[0][0];
        }

        // second column
        // check first item has value && all values in column are the same
        // @return value of first item
        if( $this->board[0][1] && count( array_unique( array( $this->board[0][1], $this->board[1][1], $this->board[2][1] ) ) ) === 1 ) {
            return $this->board[0][1];
        }

        // third column
        // check first item has value && all values in column are the same
        // @return value of first item
        if( $this->board[0][2] && count( array_unique( array( $this->board[0][2], $this->board[1][2], $this->board[2][2] ) ) ) === 1 ) {
            return $this->board[0][2];
        }

        //diagonal 1
        // check first item has value && all values diagonally are the same
        // @return value of first item
        if( $this->board[0][0] && count( array_unique( array( $this->board[0][0], $this->board[1][1], $this->board[2][2] ) ) ) === 1 ) {
            return $this->board[0][0];
        }

        //diagonal 2
        // check first item has value && all values diagonally are the same
        // @return value of first item
        if( $this->board[0][2] && count( array_unique( array( $this->board[0][2], $this->board[1][1], $this->board[2][0] ) ) ) === 1 ) {
            return $this->board[0][2];
        }
            
        if ( $this->total_moves >= 9 )
            return "Tie";
    }
}