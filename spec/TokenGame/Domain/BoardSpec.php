<?php

namespace spec\TokenGame\Domain;

use TokenGame\Domain\Board;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TokenGame\Domain\Token;

/**
 * @mixin Board
 */
class BoardSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Board::class);
    }

    public function let()
    {
        $this->beConstructedWith(20,4,5);
    }

    public function it_should_return_correct_ammount_tokens(){
        $this->amountTokens()->shouldBe(20);
    }

    public function it_should_return_correct_vertical_tokens(){
        $this->verticalTokens()->shouldBe(4);
    }

    public function it_should_return_correct_horizontal_tokens(){
        $this->horizontalTokens()->shouldBe(5);
    }





}
