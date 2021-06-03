<?php

namespace spec\TokenGame\Domain;

use TokenGame\Domain\Token;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


/**
 * @mixin Token
 */
class TokenSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Token::class);
    }

    public function let()
    {
        $this->beConstructedWith(
            1,
            1,
            5
        );
    }

}
