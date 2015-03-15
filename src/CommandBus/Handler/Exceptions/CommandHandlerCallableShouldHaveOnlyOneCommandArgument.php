<?php

namespace EloiPoch\Bus\CommandBus\Handler\Exceptions;

use EloiPoch\Bus\CommandBus\Command;
use EloiPoch\Bus\CommandBus\Handler\CommandHandler;
use InvalidArgumentException;

final class CommandHandlerCallableShouldHaveOnlyOneCommandArgument extends InvalidArgumentException
{
    public function __construct(CommandHandler $commandHandler)
    {
        parent::__construct(
            sprintf(
                'Command handler <%s> should have only one required argument of the type <%s>',
                get_class($commandHandler),
                Command::class
            )
        );
    }
}
