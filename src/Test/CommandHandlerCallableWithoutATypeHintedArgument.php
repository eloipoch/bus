<?php

namespace EloiPoch\Bus\Test;

use EloiPoch\Bus\CommandBus\Handler\CommandHandler;

final class CommandHandlerCallableWithoutATypeHintedArgument implements CommandHandler
{
    public function __invoke($argument)
    {
    }
}
