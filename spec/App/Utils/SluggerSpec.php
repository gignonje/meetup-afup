<?php

namespace spec\App\Utils;

use App\Utils\Slugger;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SluggerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Slugger::class);
    }

    function it_should_lowercase_text()
    {
        $this->slugify('LoremIpsum')->shouldReturn('loremipsum');
    }

    function it_should_replace_spaces_with_dashes()
    {
        $this->slugify('Lorem Ipsum')->shouldReturn('lorem-ipsum');
    }
}
