<?php


class Game {

	
	var $over;		// show game over

	var $won;		// show game won


// setting up game environment variables
	
	
	function start() {
		$this->over = false;
		$this->won = false;
	}
	
	
	// end the game
	
	function end() {
		$this->over = true;
	}
	
	
	// return bool to indiciate whether or not the game is over
	
	function is_over() {
		if ( $this->won )
			return true;
			
		if ( $this->over )
			return true;
			
	if ( $this->health < 0 ) 
			return true;
			
		return false;
	}

} //end game class


// display a formatted debug message

function debug( $object = NULL, $msg = "" ) {
	if ( isset( $object ) || isset( $msg ) ) {
		echo "<pre>";
		
		if ( isset( $object ) )
			print_r( $object );
			
		if ( isset( $msg ) )
			echo "\n\t$msg\n";
		
		echo "\n</pre>";
	}
}

// return a formatted error message

function error_message( $msg ) {
	return "<div class=\"alert error-message\">$msg</div>";
}

//return a formatted success message

function success_message( $msg ) {
	return "<div class=\"alert success-message\">$msg</div>";
} 
?>