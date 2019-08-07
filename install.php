<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

require __DIR__.'/vendor/autoload.php';

$app = new Application();
$app->setName('Pauls Laravel Package Installer');

$app->add(new class extends Command {
    protected static $defaultName = 'install';

    protected function configure()
    {
        $this
            ->setDescription('Install the boilerplate.')
            ->setHelp('Configures the package boilerplate to personal preference.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new \Symfony\Component\Console\Style\SymfonyStyle($input, $output);


        $io->title('Laravel Package Boilerplate Installer');
        $io->text('You can now change the name of the package and the namespace the package uses.');

        $packageName = $io->ask('Package name', 'hpolthof/laravel-package');
        $namespace = $io->ask('Namespace', 'Hpolthof\\Package');

        $this->replacePackageName($packageName);
        $this->replaceNamespace($namespace);
    }

    protected function replaceNamespace($newNamespace, $oldNamespace = 'Hpolthof\\Package'): void
    {
        foreach ($this->findFiles() as $fileName) {
            $this->replaceAndUpdateFile($newNamespace, $oldNamespace, $fileName);
        }
    }

    protected function findFiles(): array
    {
        return array_merge(
            glob(__DIR__."/src/Providers/*.php"),
            glob(__DIR__."/tests/*.php"),
            glob(__DIR__."/tests/Unit/*.php"),
            glob(__DIR__."/composer.json")
        );
    }

    protected function replaceAndUpdateFile($newNamespace, $oldNamespace, $fileName): void
    {
        $content = file_get_contents($fileName);

        $content = str_replace($oldNamespace, $newNamespace, $content);
        $content = str_replace(addslashes($oldNamespace), addslashes($newNamespace), $content);

        file_put_contents($fileName, $content);
    }

    protected function replacePackageName($packageName): void
    {
        $content = file_get_contents(__DIR__ . '/composer.json');
        $content = str_replace('hpolthof/laravel-package', $packageName, $content);
        file_put_contents(__DIR__ . '/composer.json', $content);
    }
});

$app->run();