<?php

declare(strict_types=1);

namespace GrumPHP\Task\Git;

use GrumPHP\Formatter\ProcessFormatterInterface;
use GrumPHP\IO\IOInterface;
use GrumPHP\Process\ProcessBuilder;
use GrumPHP\Runner\TaskResult;
use GrumPHP\Runner\TaskResultInterface;
use GrumPHP\Task\AbstractExternalTask;
use GrumPHP\Task\Config\ConfigOptionsResolver;
use GrumPHP\Task\Context\ContextInterface;
use GrumPHP\Task\Context\GitPreCommitContext;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @extends AbstractExternalTask<ProcessFormatterInterface>
 */
class Blacklist extends AbstractExternalTask
{
    /**
     * @var IOInterface
     */
    private $IO;

    /**
     * Blacklist constructor.
     */
    public function __construct(
        ProcessBuilder $processBuilder,
        ProcessFormatterInterface $formatter,
        IOInterface $IO
    ) {
        $this->IO = $IO;
        parent::__construct($processBuilder, $formatter);
    }

    public static function getConfigurableOptions(): ConfigOptionsResolver
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'keywords' => [],
            'whitelist_patterns' => [],
            'triggered_by' => ['php'],
            'regexp_type' => 'G',
            'match_word' => false,
            'ignore_patterns' => []
        ]);

        $resolver->addAllowedTypes('keywords', ['array']);
        $resolver->addAllowedTypes('whitelist_patterns', ['array']);
        $resolver->addAllowedTypes('triggered_by', ['array']);
        $resolver->addAllowedTypes('regexp_type', ['string']);

        $resolver->setAllowedValues('regexp_type', ['G', 'E', 'P']);
        $resolver->addAllowedTypes('match_word', ['bool']);
        $resolver->addAllowedTypes('ignore_patterns', ['array']);

        return ConfigOptionsResolver::fromOptionsResolver($resolver);
    }

    public function canRunInContext(ContextInterface $context): bool
    {
        return $context instanceof GitPreCommitContext;
    }

    public function run(ContextInterface $context): TaskResultInterface
    {
        $config = $this->getConfig()->getOptions();

        $whitelistPatterns = $config['whitelist_patterns'];

        $files = $context->getFiles();
        if (0 !== \count($whitelistPatterns)) {
            $files = $files->paths($whitelistPatterns);
        }
        $files = $files->extensions($config['triggered_by'])->notPaths($config['ignore_patterns']);

        if (0 === \count($files) || empty($config['keywords'])) {
            return TaskResult::createSkipped($this, $context);
        }

        $arguments = $this->processBuilder->createArgumentsForCommand('git');
        $arguments->add('grep');
        $arguments->add('--cached');
        $arguments->add('-n');
        $arguments->add('--break');
        $arguments->add('--heading');
        $arguments->addOptionalArgument('--word-regexp', $config['match_word']);
        $arguments->addOptionalArgument('--color', $this->IO->isDecorated());
        $arguments->addOptionalArgument('-%s', $config['regexp_type']);
        $arguments->addArgumentArrayWithSeparatedValue('-e', $config['keywords']);
        $arguments->addFiles($files);

        $process = $this->processBuilder->buildProcess($arguments);
        $process->run();

        if ($process->isSuccessful()) {
            return TaskResult::createFailed($this, $context, sprintf(
                'You have blacklisted keywords in your commit:%s%s',
                PHP_EOL,
                $this->formatter->format($process)
            ));
        }

        if (1 !== $process->getExitCode()) {
            return TaskResult::createFailed($this, $context, sprintf(
                'Something went wrong:%s%s',
                PHP_EOL,
                $process->getErrorOutput()
            ));
        }

        return TaskResult::createPassed($this, $context);
    }
}
