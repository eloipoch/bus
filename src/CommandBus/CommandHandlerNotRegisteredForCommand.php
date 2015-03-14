<?php

namespace EloiPoch\Bus\CommandBus;

use LogicException;

final class CommandHandlerNotRegisteredForCommand extends LogicException
{
    public function __construct(Command $command)
    {
        parent::__construct(sprintf('Command handler not found for command <$s>', get_class($command)));
    }
}
