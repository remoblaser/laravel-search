<?php

namespace spec\Remoblaser\Search;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SearchSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Remoblaser\Search\Search');
    }
}
