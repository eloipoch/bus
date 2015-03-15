<?php

namespace EloiPoch\Bus\CommandBus\Handler;

use EloiPoch\Bus\CommandBus\Command;
use EloiPoch\Bus\CommandBus\Handler\Exceptions\CommandHandlerCallableShouldHaveOnlyOneCommandArgument;
use EloiPoch\Bus\CommandBus\Handler\Exceptions\CommandHandlerIsNotCallable;
use EloiPoch\Bus\CommandBus\Handler\Exceptions\CommandHandlerNotRegisteredForCommand;

final class CommandHandlerRegister
{
    private $handlers = [];

    /**
     * @param CommandHandler $handler
     *
     * @throws CommandHandlerIsNotCallable
     * @throws CommandHandlerCallableShouldHaveOnlyOneCommandArgument
     *
     * @return void
     */
    public function add(CommandHandler $handler)
    {
        $this->guardCommandHandlerIsCallable($handler);

        $commandClass = $this->getCommandToSubscribe($handler);

        $this->handlers[$commandClass] = $handler;
    }

    /**
     * @param Command $command
     *
     * @throws CommandHandlerNotRegisteredForCommand
     *
     * @return callable
     */
    public function get(Command $command)
    {
        $commandClass = get_class($command);

        $this->guardCommandHandlerExists($commandClass);

        return $this->handlers[$commandClass];
    }

    private function guardCommandHandlerExists($commandClass)
    {
        if (!array_key_exists($commandClass, $this->handlers)) {
            throw new CommandHandlerNotRegisteredForCommand($commandClass);
        }
    }

    private function guardCommandHandlerIsCallable(CommandHandler $handler)
    {
        if (!is_callable($handler)) {
            throw new CommandHandlerIsNotCallable($handler);
        }
    }

    private function getCommandToSubscribe(CommandHandler $handler)
    {
        $info = new CommandHandlerInfo($handler);

        return $info->getCommandToSubscribe();
    }
}
