<?php

namespace spec\TokenGame\Domain;

use TokenGame\Domain\Exception\TimeOutException;
use TokenGame\Domain\GameTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin GameTime
 */
class GameTimeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(GameTime::class);
    }

    public function let()
    {
        $this->beConstructedWith((new \DateTimeImmutable())->setTimestamp(time() + 60));
    }

    public function it_should_throw_time_out_exception(){

        $this->beConstructedWith((new \DateTimeImmutable())->setTimestamp(time()-1));
        $this->shouldThrow(TimeOutException::class)->during('isTimeOut',[]);

    }
    public function it_should_not_throw_time_out_exception(){
        $this->shouldNotThrow(TimeOutException::class)->during('isTimeOut',[]);
    }
}
