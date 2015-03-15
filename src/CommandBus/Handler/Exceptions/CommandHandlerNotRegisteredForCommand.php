<?php

namespace EloiPoch\Bus\CommandBus\Handler\Exceptions;

use LogicException;

final class CommandHandlerNotRegisteredForCommand extends LogicException
{
    public function __construct($commandName)
    {
        parent::__construct(sprintf('Command handler not found for command <%s>', $commandName));
    }
}
