<?php
declare(strict_types=1);


namespace TokenGame\Domain;


use TokenGame\Domain\Exception\FinishGameException;
use TokenGame\Domain\Exception\TimeOutException;
use TokenGame\Domain\Exception\WonGameException;

class Game
{

    /**
     * @var Board
     */
    private $board;

    /**
     * @var int
     */
    private $numberMoves;

    public function __construct(Board $board, GameTime $gameTime, int $numberMoves)
    {
        $this->gameTime = $gameTime;
        $this->board = $board;
        $this->numberMoves = $numberMoves;
    }

    public function play()
    {
        $board = $this->board->completeBoards();
        $move = 1;
        while (true) {
            $usedToken = rand(1, $this->board->amountTokens());
            $this->finishGame($move);
            $this->gameTime->isTimeOut();
            foreach ($board as $position => $token) {
                $move = $this->isWonGame($token, $usedToken, $move);
            }
        }
    }

    public function isWonGame(Token $token, int $usedToken, int $move): int
    {
        if (!$token->isActive()){
            return $move;
        }

        if($usedToken !== $token->position()){
            return $move;
        }

        if($token->isDiscovered()){
            return $move;
        }

        $token->setDiscovered();
        if ($token->isWinnerToken()) {
            throw new WonGameException(sprintf('Won game: token from position %s in move %s', $token->position(), $move));
        }

        return $move+1;
    }

    public function finishGame(int $move)
    {
        if ($move > $this->numberMoves) {
            throw new FinishGameException('Lost game: too many moves');
        }
    }
}