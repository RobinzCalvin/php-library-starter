<?php

declare(strict_types=1);

namespace Ramsey\Test\Dev\LibraryStarterKit\Task\Builder;

use Composer\IO\ConsoleIO;
use Mockery\MockInterface;
use Ramsey\Dev\LibraryStarterKit\Answers;
use Ramsey\Dev\LibraryStarterKit\Task\Build;
use Ramsey\Dev\LibraryStarterKit\Task\Builder\UpdateFunding;
use Ramsey\Test\Dev\LibraryStarterKit\TestCase;
use Symfony\Component\Filesystem\Filesystem;
use Twig\Environment as TwigEnvironment;

class UpdateFundingTest extends TestCase
{
    public function testBuild(): void
    {
        $io = $this->mockery(ConsoleIO::class);
        $io->expects()->write('<info>Updating .github/FUNDING.yml</info>');

        $filesystem = $this->mockery(Filesystem::class);
        $filesystem
            ->shouldReceive('dumpFile')
            ->once()
            ->withArgs(function (string $path, string $contents) {
                $this->assertSame('/path/to/app/.github/FUNDING.yml', $path);
                $this->assertSame('fundingContents', $contents);

                return true;
            });

        $twig = $this->mockery(TwigEnvironment::class);
        $answers = new Answers();

        $twig
            ->expects()
            ->render('FUNDING.yml.twig', $answers->getArrayCopy())
            ->andReturn('fundingContents');

        /** @var Build & MockInterface $task */
        $task = $this->mockery(Build::class, [
            'getAnswers' => $answers,
            'getAppPath' => '/path/to/app',
            'getFilesystem' => $filesystem,
            'getIO' => $io,
            'getTwigEnvironment' => $twig,
        ]);

        $task
            ->shouldReceive('path')
            ->andReturnUsing(fn (string $path): string => '/path/to/app/' . $path);

        $builder = new UpdateFunding($task);

        $builder->build();
    }
}
