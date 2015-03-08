<?php

namespace EloiPoch\Bus\Bus\Tests;

use EloiPoch\Bus\Bus\CommandHandler;
use EloiPoch\Bus\Bus\CommandHandlerResolver;
use EloiPoch\Bus\Bus\SimpleCommandBus;
use EloiPoch\Bus\Message\Command;
use EloiPoch\Bus\Test\CommandDummy;
use EloiPoch\Bus\Test\CommandHandlerMock;
use Mockery as m;
use Mockery\MockInterface;
use PHPUnit_Framework_TestCase;

final class SimpleCommandBusTest extends PHPUnit_Framework_TestCase
{
    /** @var SimpleCommandBus */
    private $commandBus;
    /** @var CommandHandlerResolver|MockInterface */
    private $commandHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->commandBus = new SimpleCommandBus($this->getResolver());
    }

    /** @test */
    public function it_should_execute_the_command_handler_resolved_with_the_command_received()
    {
        $command        = CommandDummy::create();
        $commandHandler = CommandHandlerMock::create();

        $this->resolverShouldResolve($command, $commandHandler);
        $this->handlerShouldBeCalled($commandHandler, $command);

        $this->commandBus->handle($command);
    }

    /** @return CommandHandlerResolver|MockInterface */
    private function getResolver()
    {
        return $this->commandHandler = $this->commandHandler ?: m::mock(CommandHandlerResolver::class);
    }

    private function resolverShouldResolve(Command $command, CommandHandler $commandHandler)
    {
        $this->getResolver()
            ->shouldReceive('resolve')
            ->once()
            ->with(m::mustBe($command))
            ->andReturn($commandHandler);
    }

    private function handlerShouldBeCalled(CommandHandlerMock $commandHandler, Command $command)
    {
        return $commandHandler->shouldBeCalled()->once()->with(m::mustBe($command))->andReturnNull();
    }
}
