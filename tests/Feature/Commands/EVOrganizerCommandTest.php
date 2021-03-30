<?php

declare(strict_types=1);

namespace Kata\Tests\Commands;

use Kata\Commands\EVOrganizerCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;
use \PHPUnit\Framework\TestCase;

class EVOrganizerCommandTest extends TestCase
{
    /**
     * @var Application
     */
    public $application;

    /**
     * @var Command
     */
    public $command;

    /**
     * @var CommandTester
     */
    public $tester;

    public function setUp(): void
    {
        $this->application=new Application();
        $this->application->add(new EVOrganizerCommand());

        $this->command=$this->application->find('ev-organizer');
        $this->tester=new CommandTester($this->command);
    }

    public function testExecutionWithInvalidInputShouldBreakWithError()
    {
        $this->tester->setInputs(['0 3']);
        $this->tester->execute(['command'=>$this->command->getName()]);

        # This should be the output of the command
        $output=$this->tester->getDisplay();
        $this->assertContains("Type in the integer X, Y separated by a space, (e.g. 1 2), to define the city upper limits: The command could not be executed. Reason: The provided upper right coordinate pair is invalid.\r\n",[$output]);
    }

    public function testExecutionWithSingleEV()
    {
        $this->tester->setInputs(['5 5','1 2 N','LMLMLMLMM','no']);
        $this->tester->execute(['command'=>$this->command->getName()]);

        # This should be the output of the command
        $output=$this->tester->getDisplay();
        $this->assertContains("Type in the integer X, Y separated by a space, (e.g. 1 2), to define the city upper limits: Type in the EV coordinates and orientation, each separated with a space between, (e.g. 1 2 N): Type in the EV command string without any space separating them, (e.g. LMLMLMLMM): Do you want to add another EV? (yes|no) 1 3 N\r\n",[$output]);
    }

    public function testExecutionWithTwoEVs()
    {
        $this->tester->setInputs(['5 5','1 2 N','LMLMLMLMM','yes','3 3 E','MMRMMRMRRM','no']);
        $this->tester->execute(['command'=>$this->command->getName()]);

        # This should be the output of the command
        $output=$this->tester->getDisplay();
        $this->assertContains("Type in the integer X, Y separated by a space, (e.g. 1 2), to define the city upper limits: Type in the EV coordinates and orientation, each separated with a space between, (e.g. 1 2 N): Type in the EV command string without any space separating them, (e.g. LMLMLMLMM): Do you want to add another EV? (yes|no) Type in the EV coordinates and orientation, each separated with a space between, (e.g. 1 2 N): Type in the EV command string without any space separating them, (e.g. LMLMLMLMM): Do you want to add another EV? (yes|no) 1 3 N\r\n5 1 E\r\n",[$output]);
    }

    public function testExecutionWithTwoEVsWithSamePositionAsInput()
    {
        $this->tester->setInputs(['5 5','1 2 N','LMLMLMLMM','yes','1 2 N',]);
        $this->tester->execute(['command'=>$this->command->getName()]);

        # This should be the output of the command
        $output=$this->tester->getDisplay();
        $this->assertStringContainsString("Type in the integer X, Y separated by a space, (e.g. 1 2), to define the city upper limits: Type in the EV coordinates and orientation, each separated with a space between, (e.g. 1 2 N): Type in the EV command string without any space separating them, (e.g. LMLMLMLMM): Do you want to add another EV? (yes|no) Type in the EV coordinates and orientation, each separated with a space between, (e.g. 1 2 N): Error: The position 1 2 is already taken by another EV. Please try another coordinates pair inside the given area.\r\nType in the EV coordinates and orientation, each separated with a space between, (e.g. 1 2 N): ",$output);
    }
}