<?php

namespace EloiPoch\Bus\Bus;

use EloiPoch\Bus\Message\Command;

interface CommandHandlerResolver
{
    /**
     * @param Command $command
     *
     * @return callable
     */
    public function resolve(Command $command);
}
