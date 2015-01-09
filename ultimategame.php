<?php
//	Author: 		Tim Habersack / tim.habersack@gmail.com
//	Date:			01-07-2015
//	Name:			Ultimate Game
//  Description: 	Command-line game that plays Rock,Paper,Scissors, Lizard, Spock
//					(See: http://en.wikipedia.org/wiki/Rock-paper-scissors#Additional_weapons)
//	Usage:			On the command line, run: 'php ultimategame.php rock' and see what happens!


class UltimateGame {

	var $player_weapon;
	var $comp_weapon;
	var $options;
	
	function __construct($player_weapon)
	{
		$this->options = array(	'human','tree','wolf','sponge','paper','air',
								'water','dragon','devil','lightning','gun',
								'rock','fire','scissors','snake');

		// Get keys for player and comp weapons
		$this->player_weapon = array_search(strtolower($player_weapon), $this->options);
		$this->comp_weapon = array_rand($this->options);

		if($this->player_weapon === false) $this->print_message('bad_entry');
		else
		{
			$this->game();
		}
	}

	private function game()
	{
		// Show both choices and rattle sabers
		$this->print_message('begin');
		
		if($this->player_weapon == $this->comp_weapon) // Is a tie?
		{
			$this->print_message('tie');
		}
		elseif($this->is_victory($this->player_weapon,$this->comp_weapon)) // did player win?
		{
			$this->print_message('player_won');
		}
		else
		{
			$this->print_message('comp_won');
		}
	}

	private function is_victory($attacker,$target)
	{
		if(($attacker < 7))
		{
			if(($attacker < $target) && ($target < $attacker+7)) return true;
		}
		else
		{
			if($attacker < $target) // attacker and target are in top section
			{
				return true;
			}
			elseif(((15-$attacker) + $target) < 7) return true; // target is within range of attacker; think rock vs human
			else return false;

		}

	}

	private function print_message($flag)
	{
		switch ($flag) 
		{
			case 'bad_entry':
				echo 'That weapon isn\'t in your arsenal, please choose one of: '.implode(', ', $this->options)."\n";
				break;
			case 'begin':
				echo 'Player chose:      '.$this->options[$this->player_weapon]."\n".'Hostile AI chose:  '.$this->options[$this->comp_weapon]."\n";
				break;
			case 'player_won':
				echo ucfirst($this->options[$this->player_weapon]).' beats '.$this->options[$this->comp_weapon].'; player wins! Humanity is saved!'."\n";
				break;
			case 'comp_won':
				echo ucfirst($this->options[$this->comp_weapon]).' beats '.$this->options[$this->player_weapon]."\n" . 'Hostile AI wins.. Humanity is doomed.'."\n";
				break;
			case 'tie':
				echo 'Player and Hostile AI chose the same weapon; humanity survives another few seconds'."\n";
				break;
			
			default:
				echo 'There is something amiss; where did I put that data again?!'."\n";
				break;
		}
	}

}

// It all begins here!

$chosen = $argv[1];

$game = new UltimateGame($chosen);