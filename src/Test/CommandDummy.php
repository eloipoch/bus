<?php

namespace EloiPoch\Bus\Test;

use EloiPoch\Bus\CommandBus\Command;

final class CommandDummy implements Command
{
    public static function create()
    {
        return new static();
    }
}
