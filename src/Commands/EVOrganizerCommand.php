<?php

namespace Kata\Commands;

use Kata\Interfaces\Area;
use Kata\EVOrganizer;
use Kata\Navigation\{Coordinates,Location,Area\City};
use Kata\Parser\{CommandParser,OrientationParser};
use Kata\Exceptions\{InvalidCommandException,InvalidPositionException,InvalidOrientationException};
use Kata\ElectricVehicle\EV;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\{Question,ConfirmationQuestion};

final class EVOrganizerCommand extends Command
{
    /**
     * @var Area
     */
    private $area;

    /**
     * @var EVOrganizer
     */
    private $organizer;

    /**
     * Initialization of the command (name, arguments, description)
     * @return void
     */
    protected function configure(): void
    {
        $this
        ->setName('ev-organizer')
        ->setDescription('Deploy & instruct your EVs')
        ->setHelp('');
    }

    /**
     * Execute the command
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try{
            $helper=$this->getHelper('question');
            
            # Get the area size
            $areasize=$this->areaQuestion($helper,$input,$output);
            $areacoordinates=new Coordinates($areasize[0],$areasize[1]);

            $this->area=new City($areacoordinates);
            $this->organizer=new EVOrganizer($this->area);

            # Ask for EV info
            $this->askForEV($helper,$input,$output);
            
            $this->organizer->deploy();
            $locations=$this->organizer->getEVLocations();

            foreach($locations as $l){
                $output->writeln((string) $l);
            }
            return Command::SUCCESS;
        }catch(\Exception $e){
            $output->writeln('The command could not be executed. Reason: <error>'.$e->getMessage().'</error>');
            return Command::FAILURE;
        }
    }

    private function areaQuestion($helper,$input,$output)
    {
        $areasizequestion=new Question('Type in the integer X, Y separated by a space, (e.g. 1 2), to define the city upper limits: ');
        return explode(' ',$helper->ask($input,$output,$areasizequestion));
    }

    /**
     * Ask for EVs
     * @param $helper
     * @param $input
     * @param $output
     * @throws InvalidCommandException
     * @throws InvalidOrientationException
     */
    private function askForEv($helper,$input,$output)
    {
        $anotherone=true;
        while($anotherone){
            $locationinfo=$this->EVInfo($helper,$input,$output);
            
            $evlocation=new Location(new Coordinates($locationinfo[0],$locationinfo[1]),OrientationParser::parseFromString($locationinfo[2]));

            while($evlocation->isTaken($this->organizer->getEVLocations())){
                $output->writeln("<error>Error: The position {$evlocation->getCoordinates()->getX()} {$evlocation->getCoordinates()->getY()} is already taken by another EV. Please try another coordinates pair inside the given area.</error>");
                $locationinfo=$this->EVInfo($helper,$input,$output);
                $evlocation=new Location(new Coordinates($locationinfo[0],$locationinfo[1]),OrientationParser::parseFromString($locationinfo[2]));
            }
            $commands=$this->EVCommands($helper,$input,$output);
            $ev=new EV($this->area,$evlocation,$commands);

            $this->organizer->addEV($ev);

            # Ask if there is another EV to be added
            $question=new ConfirmationQuestion('Do you want to add another EV? (yes|no) ',false);
            $anotherone=$helper->ask($input,$output,$question);
        }
    }

    /**
     * Ask for the EV location info that consists of coordinates & orientation
     * 
     * @param $helper
     * @param $input
     * @param $output
     * @return array
     */
    private function EVInfo($helper,$input,$output)
    {
        $evquestion=new Question('Type in the EV coordinates and orientation, each separated with a space between, (e.g. 1 2 N): ');
        return explode(' ',$helper->ask($input,$output,$evquestion));
    }

    /**
     * Ask for the EV command string
     * 
     * @param $helper
     * @param $input
     * @param $output
     * @return array
     * @throws InvalidCommandException
     */
    private function EVCommands($helper,$input,$output)
    {
        $evquestion=new Question('Type in the EV command string without any space separating them, (e.g. LMLMLMLMM): ');
        $commandstring=$helper->ask($input,$output,$evquestion);
        return CommandParser::parseFromString($commandstring);
    }
}