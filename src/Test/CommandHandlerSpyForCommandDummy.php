<?php

namespace EloiPoch\Bus\Test;

use EloiPoch\Bus\CommandBus\CommandHandler;
use LogicException;

final class CommandHandlerSpyForCommandDummy implements CommandHandler
{
    private $called = false;

    public static function create()
    {
        return new static();
    }

    public function __invoke(CommandDummy $command)
    {
        $this->called = true;
    }

    public function assertHasBeenCalled()
    {
        if (!$this->called) {
            throw new LogicException(sprintf('Handler <%s> has not been called', static::class));
        }
    }
}
