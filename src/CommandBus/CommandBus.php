<?php

namespace EloiPoch\Bus\CommandBus;

use EloiPoch\Bus\CommandBus\Handler\CommandHandler;
use EloiPoch\Bus\CommandBus\Handler\Exceptions\CommandHandlerNotRegisteredForCommand;

interface CommandBus
{
    /**
     * @param CommandHandler $handler
     *
     * @return void
     */
    public function register(CommandHandler $handler);

    /**
     * @param Command $command
     *
     * @throws CommandHandlerNotRegisteredForCommand
     *
     * @return void
     */
    public function handle(Command $command);
}
