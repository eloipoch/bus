<?php

namespace EloiPoch\Bus\Test;

use EloiPoch\Bus\CommandBus\Handler\CommandHandler;

final class CommandHandlerCallableWithoutArguments implements CommandHandler
{
    public function __invoke()
    {
    }
}
