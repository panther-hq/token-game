<?php
declare(strict_types=1);


namespace TokenGame\Domain;


final class Token
{


    /**
     * @var bool
     */
    private $winnerToken;

    /**
     * @var bool
     */
    private $discovered;

    /**
     * @var int
     */
    private $position;

    /**
     * @var int
     */
    private $vertical;

    /**
     * @var int
     */
    private $horizontal;

    /**
     * @var bool
     */
    private $active;

    public function __construct(int $position, int $vertical, int $horizontal)
    {
        $this->discovered = false;
        $this->active = true;
        $this->position = $position;
        $this->vertical = $vertical;
        $this->horizontal = $horizontal;
        $this->winnerToken = false;
    }

    public function isDiscovered(): bool
    {
        return $this->discovered;
    }

    public function isTokenWinner(): bool
    {
        return $this->winnerToken;
    }

    public function setWinnerToken(){
        $this->winnerToken = true;
    }

    public function isWinnerToken(): bool
    {
        return $this->winnerToken;
    }

    public function setDiscovered(): void
    {
        $this->discovered = true;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function deactiveToken(): void
    {
        $this->active = false;
    }

    public function position(): int
    {
        return $this->position;
    }





}