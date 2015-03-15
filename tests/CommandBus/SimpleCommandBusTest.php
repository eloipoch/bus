<?php

namespace EloiPoch\Bus\Tests\CommandBus;

use EloiPoch\Bus\CommandBus\Handler\CommandHandler;
use EloiPoch\Bus\CommandBus\Handler\Exceptions\CommandHandlerCallableShouldHaveOnlyOneCommandArgument;
use EloiPoch\Bus\CommandBus\Handler\Exceptions\CommandHandlerIsNotCallable;
use EloiPoch\Bus\CommandBus\Handler\Exceptions\CommandHandlerNotRegisteredForCommand;
use EloiPoch\Bus\CommandBus\SimpleCommandBus;
use EloiPoch\Bus\Test\CommandDummy;
use EloiPoch\Bus\Test\CommandHandlerCallableWithoutATypeHintedArgument;
use EloiPoch\Bus\Test\CommandHandlerCallableWithoutArguments;
use EloiPoch\Bus\Test\CommandHandlerNotCallable;
use EloiPoch\Bus\Test\CommandHandlerSpyForCommandDummy;
use PHPUnit_Framework_TestCase;

final class SimpleCommandBusTest extends PHPUnit_Framework_TestCase
{
    /** @var SimpleCommandBus */
    private $commandBus;

    protected function setUp()
    {
        parent::setUp();

        $this->commandBus = new SimpleCommandBus();
    }

    /** @test */
    public function it_should_call_the_command_handler_registered_for_the_received_command()
    {
        $command        = CommandDummy::create();
        $commandHandler = CommandHandlerSpyForCommandDummy::create();

        $this->commandBus->register($commandHandler);
        $this->commandBus->handle($command);

        $commandHandler->assertHasBeenCalled();
    }

    /** @test */
    public function it_should_throw_an_exception_if_there_is_no_command_handler_registered_for_the_received_command()
    {
        $this->setExpectedException(CommandHandlerNotRegisteredForCommand::class);

        $command = CommandDummy::create();

        $this->commandBus->handle($command);
    }

    /**
     * @test
     * @dataProvider getInvalidCommandHandlers
     */
    public function it_should_throw_an_exception_if_the_command_handler_is_not_valid(
        $expectedException,
        CommandHandler $handler
    ) {
        $this->setExpectedException($expectedException);

        $this->commandBus->register($handler);
    }

    public function getInvalidCommandHandlers()
    {
        return [
            'not_callable'                        => [
                'expectedException' => CommandHandlerIsNotCallable::class,
                'handler'           => new CommandHandlerNotCallable(),
            ],
            'callable_without_arguments'          => [
                'expectedException' => CommandHandlerCallableShouldHaveOnlyOneCommandArgument::class,
                'handler'           => new CommandHandlerCallableWithoutArguments(),
            ],
            'callable_without_a_type_hinted_argument' => [
                'expectedException' => CommandHandlerCallableShouldHaveOnlyOneCommandArgument::class,
                'handler'           => new CommandHandlerCallableWithoutATypeHintedArgument(),
            ],
        ];
    }
}
