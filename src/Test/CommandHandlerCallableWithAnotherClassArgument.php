<?php

namespace EloiPoch\Bus\Test;

use EloiPoch\Bus\CommandBus\Handler\CommandHandler;
use stdClass;

final class CommandHandlerCallableWithAnotherClassArgument implements CommandHandler
{
    public function __invoke(stdClass $argument)
    {
    }
}
