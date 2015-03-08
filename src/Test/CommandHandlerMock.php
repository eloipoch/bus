<?php

namespace EloiPoch\Bus\Test;

use EloiPoch\Bus\Bus\CommandHandler;
use Mockery as m;
use Mockery\MockInterface;

final class CommandHandlerMock implements CommandHandler
{
    /** @var Callable|MockInterface */
    private $mock;

    public function __construct()
    {
        $this->mock = m::mock($this);
    }

    public static function create()
    {
        return new static();
    }

    public function shouldBeCalled()
    {
        return $this->mock->shouldReceive('__invoke');
    }

    public function __invoke()
    {
        return call_user_func_array($this->mock, func_get_args());
    }
}
