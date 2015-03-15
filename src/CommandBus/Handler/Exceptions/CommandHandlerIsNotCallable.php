<?php

namespace EloiPoch\Bus\CommandBus\Handler\Exceptions;

use EloiPoch\Bus\CommandBus\Handler\CommandHandler;
use InvalidArgumentException;

final class CommandHandlerIsNotCallable extends InvalidArgumentException
{
    public function __construct(CommandHandler $commandHandler)
    {
        parent::__construct(
            sprintf(
                'Command handler <%s> should be callable (should implement the __invoke() method))',
                get_class($commandHandler)
            )
        );
    }
}
