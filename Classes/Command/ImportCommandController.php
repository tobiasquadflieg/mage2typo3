<?php


namespace Graphodata\Mage2typo3\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Class ImportCommandController
 *
 * @package Graphodata\Mage2typo3\Command
 */
class ImportCommandController extends Command
{
    protected $objectManager;
    protected $configurationManager;

    public function __construct(string $name = null)
    {
        parent::__construct($name);
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->configurationManager = $this->objectManager->get(ConfigurationManager::class);
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setName('Mage2TYPO3 Import');
        $this->setDescription('Runs the productimport form the Magento 2 REST API');
        // TODO Adding some Help!
        $this->setHelp('here could be some help!');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output); // TODO: Change the autogenerated stub
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output); // TODO: Change the autogenerated stub
    }

}