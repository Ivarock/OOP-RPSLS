<?php

class Game
{
    const ROCK = 0;
    const PAPER = 1;
    const SCISSORS = 2;
    const LIZARD = 3;
    const SPOCK = 4;
    const DYNAMITE = 5;

    private array $conditions;
    private array $choiceMap;

    public function __construct()
    {
        $this->conditions = [
            self::ROCK => [self::SCISSORS, self::LIZARD],
            self::PAPER => [self::ROCK, self::SPOCK],
            self::SCISSORS => [self::PAPER, self::LIZARD],
            self::LIZARD => [self::SPOCK, self::PAPER],
            self::SPOCK => [self::ROCK, self::SCISSORS],
            self::DYNAMITE => [self::ROCK, self::PAPER, self::SCISSORS, self::LIZARD, self::SPOCK]
        ];

        $this->choiceMap = [
            "rock" => self::ROCK,
            "paper" => self::PAPER,
            "scissors" => self::SCISSORS,
            "lizard" => self::LIZARD,
            "spock" => self::SPOCK,
            "dynamite" => self::DYNAMITE
        ];
    }

    private function getComputerChoice(): int
    {
        return array_rand($this->conditions);
    }

    private function getPlayerChoice(): int
    {
        while (true) {
            $playerChoice = strtolower(readline("Enter your choice: "));
            if (array_key_exists($playerChoice, $this->choiceMap)) {
                return $this->choiceMap[$playerChoice];
            }
            echo "Invalid choice! Please choose Rock, Paper, Scissors, Lizard, Spock or Dynamite \n";
        }
    }

    private function getChoiceName(int $choice): string
    {
        return array_search($choice, $this->choiceMap);
    }

    public function play(): void
    {
        echo "Let's play rock, paper, scissors, lizard, spock, dynamite\n";

        $playerChoice = $this->getPlayerChoice();
        $computerChoice = $this->getComputerChoice();

        echo "Computer chose: " . $this->getChoiceName($computerChoice) . "\n";
        $this->determineWinner($playerChoice, $computerChoice);

        $playAgain = strtolower(readline("Would you like to play again? (y/n) "));
        if ($playAgain === "y") {
            $this->play();
        }

    }

    private function determineWinner(int $playerChoice, int $computerChoice): void
    {
        if (in_array($computerChoice, $this->conditions[$playerChoice])) {
            echo "Player wins!\n";
        } elseif (in_array($playerChoice, $this->conditions[$computerChoice])) {
            echo "Computer wins!\n";
        } else {
            echo "It's a tie\n";
        }
    }
}

$game = new Game();
$game->play();
