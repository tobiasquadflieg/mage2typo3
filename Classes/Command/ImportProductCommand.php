<?php


namespace Graphodata\Mage2typo3\Command;


use Graphodata\Mage2typo3\Domain\Model\Product;
use Graphodata\Mage2typo3\Domain\Repository\ImportConfigurationRepository;
use Graphodata\Mage2typo3\Service\ApiService;
use Graphodata\Mage2typo3\Service\MappingService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Class ImportCommandController
 *
 * @package Graphodata\Mage2typo3\Command
 */
class ImportProductCommand extends Command
{
    /**
     * @var \Graphodata\Mage2typo3\Service\ApiService $apiService
     */
    protected $apiService;

    /**
     * @var \Graphodata\Mage2typo3\Domain\Model\ImportConfiguration $importConfiguration
     */
    protected $importConfiguration;

    /**
     * @var ObjectManager $objectManager
     */
    protected $objectManager;

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Runs the product import form the Magento 2 REST API');
        // TODO Adding some Help!
        $this->setHelp('here could be some help!');
        $this->addArgument('ImportConfigurationUid', InputArgument::REQUIRED,
            'Please Insert the UID of the Configuration you want to use.');
        $this->addArgument('Items', InputArgument::OPTIONAL,
            'Number of items that should be impotert per run',
            100);
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getArgument('ImportConfigurationUid')) {
            $output->writeln('Please insert a Importconfiguration UID!');
            $helper = $this->getHelper('question');
            $question = New Question('Please give me the Uid: ');
            $uid = $helper->ask($input, $output, $question);
            $input->setArgument('ImportConfigurationUid', $uid);
        }
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);

    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("Mage2TYPO3 Import Command!");
        $this->importConfiguration = $this->objectManager->get(ImportConfigurationRepository::class)->findByUid($input->getArgument('ImportConfigurationUid'));
        $this->apiService = GeneralUtility::makeInstance(ApiService::class, $this->importConfiguration);
        $productArr = [];
        $apiService = GeneralUtility::makeInstance(ApiService::class, $this->importConfiguration);
        $io->text('Getting products from Magento 2');
        $io->newLine(2);
        if ($apiService->getAuthToken()) {
            $productcount = $apiService->getProductsCount();
            $pages = ceil($productcount / $input->getArgument('Items'));
            $io->progressStart($pages);
            for ($i = 1; $i <= $pages; $i++) {
                array_push($productArr, $apiService->getProducts($input->getArgument('Items'), $i));
                $io->progressAdvance();
            }
        }
        $io->progressFinish();
        $mapping = GeneralUtility::makeInstance(MappingService::class);
        $io->text('Start writing Data to Database');
        $io->progressStart(count($productArr));
        $io->newLine(2);
        $io->newLine(2);
        foreach ($productArr as $product) {
            $mapping->map(Product::class, $product, $this->importConfiguration->getShop());
            $io->progressAdvance();
        }
        $io->progressFinish();
        $io->text($productcount . " Products are imported, in " . $pages . ' Steps');
        $io->newLine(2);
    }

}