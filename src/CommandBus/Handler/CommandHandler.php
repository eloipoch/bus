<?php

namespace EloiPoch\Bus\CommandBus\Handler;

/**
 * Command Handler interface
 *
 * This interface does not require implement any function to allow the inheritors do an specific typehint
 * of the command to be handled. Allowing this the CommandHandlerRegister is capable of, doing a little bit
 * of reflection, inspect the __invoke method of the handler and know to which Command should register it
 */
interface CommandHandler
{
}
