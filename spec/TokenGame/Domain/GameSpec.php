<?php

namespace spec\TokenGame\Domain;

use TokenGame\Domain\Board;
use TokenGame\Domain\Exception\FinishGameException;
use TokenGame\Domain\Exception\WonGameException;
use TokenGame\Domain\Game;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TokenGame\Domain\GameTime;
use TokenGame\Domain\Token;


/**
 * @mixin Game
 */
class GameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Game::class);
    }

    public function let()
    {
        $this->beConstructedWith(
            new Board(20, 5, 5),
            new GameTime((new \DateTimeImmutable())->setTimestamp(time() + 60)),
            5
        );
    }

    public function it_should_throw_won_game_exception(){
        $token = new Token(1,1,1);
        $token->setWinnerToken();
        $this->shouldThrow(WonGameException::class)->during('isWonGame',[
            $token,
            1,
            1
        ]);
    }

    public function it_should_throw_finish_game_exception_to_many_move(){
        $this->shouldThrow(FinishGameException::class)->during('finishGame',[6]);
    }

}
