<?php

namespace EloiPoch\Bus\CommandBus;

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
