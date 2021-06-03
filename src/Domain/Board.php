<?php
declare(strict_types=1);


namespace TokenGame\Domain;


class Board
{

    /**
     * @var int
     */
    private $amountTokens;

    /**
     * @var int
     */
    private $verticalTokens;

    /**
     * @var int
     */
    private $horizontalTokens;

    /**
     * @var array
     */
    private $board;

    public function __construct(int $amountTokens, int $verticalTokens, int $horizontalTokens)
    {
        $this->amountTokens = $amountTokens;
        $this->verticalTokens = $verticalTokens;
        $this->horizontalTokens = $horizontalTokens;
        $this->board = $this->generateBoard();
    }

    public function amountTokens(): int
    {
        return $this->amountTokens;
    }

    public function verticalTokens(): int
    {
        return $this->verticalTokens;
    }

    public function horizontalTokens(): int
    {
        return $this->horizontalTokens;
    }

    public function getBoard(): array
    {
        return $this->board;
    }


    private function generateBoard(): array
    {
        $board = [];
        $position = 1;
        for ($vertical = 1; $vertical <= $this->verticalTokens; $vertical++) {
            for ($horizontal = 1; $horizontal <= $this->horizontalTokens; $horizontal++) {
                $board[$position] = [
                    'position' => $position,
                    'vertical' => $vertical,
                    'horizontal' => $horizontal
                ];
                $position++;
            }
        }
        return $board;

    }

    /**
     * @return Token[];
     */
    public function completeBoards(): array
    {
        $board = array_map(function ($board) {
            return new Token(
                $board['position'],
                $board['vertical'],
                $board['horizontal']
            );
        }, $this->board);

        $amountRemoveToken = count($board) > $this->amountTokens ? count($board) - $this->amountTokens : 0;

        if ($amountRemoveToken > 0) {
            $board = $this->removeToken($board, $amountRemoveToken);
        }

        $board = $this->setPositionWinner($board);
        return $board;
    }


    /**
     * @return Token[]
     */

    private function setPositionWinner(array $board)
    {
        $randomPosition = rand(1,$this->amountTokens);
        foreach ($board as $poistion => $token) {
            if($token->isActive() && $randomPosition===$token->position()){
                $token->setWinnerToken();
            }
        }

        return $board;
    }

    /**
     * @return Token[]
     */
    private function removeToken(array $board, int $amountRemoveToken): array
    {
        foreach ($board as $poistion => $token) {
            if ($amountRemoveToken == 0) {
                continue;
            }
            $removePosition = rand(1, $this->amountTokens);
            if ($board[$removePosition]->isActive()) {
                $board[$removePosition]->deactiveToken();
                $amountRemoveToken--;
            }
        }

        return $board;
    }


}