<?php

namespace EloiPoch\Bus\Bus;

use EloiPoch\Bus\Message\Command;

final class SimpleCommandBus implements CommandBus
{
    private $resolver;

    public function __construct(CommandHandlerResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    public function handle(Command $command)
    {
        $commandHandler = $this->resolver->resolve($command);

        $commandHandler($command);
    }
}
