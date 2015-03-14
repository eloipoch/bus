<?php

namespace EloiPoch\Bus\CommandBus;

use ReflectionMethod;

final class SimpleCommandBus implements CommandBus
{
    private $handlers = [];

    public function handle(Command $command)
    {
        if (!array_key_exists(get_class($command), $this->handlers)) {
            throw new CommandHandlerNotRegisteredForCommand($command);
        }

        $commandHandler = $this->handlers[get_class($command)];

        $commandHandler($command);
    }

    /**
     * @todo check $commandHandler is callable (is_callable($commandHandler))
     * @todo check $commandHandler __invoke method only have one argument
     * @todo check $commandHandler __invoke argument is a Command:
     *       $invoke = new ReflectionMethod($commandHandler, '__invoke')
     *       $arguments[0]->getClass()->implementsInterface(Command::class)
     */
    public function register(CommandHandler $commandHandler)
    {
        $invoke = new ReflectionMethod($commandHandler, '__invoke');

        $commandClass = $invoke->getParameters()[0]->getClass()->name;

        $this->handlers[$commandClass] = $commandHandler;
    }
}
