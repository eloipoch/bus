<?php

namespace EloiPoch\Bus\Bus;

use EloiPoch\Bus\Message\Command;

interface CommandBus
{
    /**
     * @param Command $command
     *
     * @return void
     */
    public function handle(Command $command);
}
