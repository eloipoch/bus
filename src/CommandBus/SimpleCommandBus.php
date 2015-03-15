<?php

namespace EloiPoch\Bus\CommandBus;

use EloiPoch\Bus\CommandBus\Handler\CommandHandler;
use EloiPoch\Bus\CommandBus\Handler\CommandHandlerRegister;

final class SimpleCommandBus implements CommandBus
{
    private $register;

    public function __construct()
    {
        $this->register = new CommandHandlerRegister();
    }

    public function handle(Command $command)
    {
        $commandHandler = $this->register->get($command);

        $commandHandler($command);
    }

    public function register(CommandHandler $commandHandler)
    {
        $this->register->add($commandHandler);
    }
}
