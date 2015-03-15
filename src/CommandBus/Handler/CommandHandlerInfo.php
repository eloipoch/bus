<?php

namespace EloiPoch\Bus\CommandBus\Handler;

use EloiPoch\Bus\CommandBus\Command;
use EloiPoch\Bus\CommandBus\Handler\Exceptions\CommandHandlerCallableShouldHaveOnlyOneCommandArgument;
use ReflectionClass;
use ReflectionMethod;

final class CommandHandlerInfo
{
    private $handler;

    public function __construct(CommandHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @throws CommandHandlerCallableShouldHaveOnlyOneCommandArgument
     *
     * @return string
     */
    public function getCommandToSubscribe()
    {
        return $this->getClassOfTheArgumentOfTheInvokeMethod();
    }

    private function getClassOfTheArgumentOfTheInvokeMethod()
    {
        $invoke = $this->getInvokeMethod();

        $this->guardOnlyOneArgument($invoke);

        $argumentClass = $this->getArgumentClass($invoke);

        $this->guardCommandArgument($argumentClass);

        return $argumentClass->getName();
    }

    private function getInvokeMethod()
    {
        $refClass = new ReflectionClass($this->handler);

        return $refClass->getMethod('__invoke');
    }

    private function guardOnlyOneArgument(ReflectionMethod $invoke)
    {
        if (1 !== $invoke->getNumberOfRequiredParameters()) {
            throw new CommandHandlerCallableShouldHaveOnlyOneCommandArgument($this->handler);
        }
    }

    private function getArgumentClass(ReflectionMethod $invoke)
    {
        return $invoke->getParameters()[0]->getClass();
    }

    private function guardCommandArgument(ReflectionClass $commandClass = null)
    {
        if (null === $commandClass || !$commandClass->implementsInterface(Command::class)) {
            throw new CommandHandlerCallableShouldHaveOnlyOneCommandArgument($this->handler);
        }
    }
}
