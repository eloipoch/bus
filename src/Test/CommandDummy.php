<?php

namespace EloiPoch\Bus\Test;

use EloiPoch\Bus\Message\Command;

final class CommandDummy implements Command
{
    public static function create()
    {
        return new static();
    }
}
