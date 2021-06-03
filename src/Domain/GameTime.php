<?php
declare(strict_types=1);


namespace TokenGame\Domain;


use TokenGame\Domain\Exception\TimeOutException;

class GameTime
{


    /**
     * @var \DateTimeImmutable
     */
    private $plannedEnding;


    public function __construct(\DateTimeImmutable $finishGame)
    {
        $this->plannedEnding = $finishGame;
    }

    public function isTimeOut(): void
    {
        if($this->plannedEnding->getTimestamp() < time()){
            throw new TimeOutException('Time out');
        };
    }


}