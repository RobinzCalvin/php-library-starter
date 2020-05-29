<?php

/**
 * This file is part of ramsey/php-library-skeleton
 *
 * ramsey/php-library-skeleton is open source software: you can
 * distribute it and/or modify it under the terms of the MIT License
 * (the "License"). You may not use this file except in
 * compliance with the License.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or
 * implied. See the License for the specific language governing
 * permissions and limitations under the License.
 *
 * @copyright Copyright (c) Ben Ramsey <ben@benramsey.com>
 * @license https://opensource.org/licenses/MIT MIT License
 */

declare(strict_types=1);

namespace Ramsey\Skeleton\Task\Builder;

use Ramsey\Skeleton\Task\Builder;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

use const DIRECTORY_SEPARATOR;

class UpdateSourceFileHeaders extends Builder
{
    private const HEADER_PATTERN = '%/\*\*.* \*/%sU';

    public function build(): void
    {
        $this->getBuildTask()->getIO()->write('<info>Updating source file headers</info>');

        $newFileHeader = $this->getBuildTask()->getTwigEnvironment()->render(
            'source-file-header.twig',
            $this->getBuildTask()->getAnswers()->getArrayCopy()
        );

        $headerLines = explode("\n", $newFileHeader);
        $headerLines = array_filter($headerLines);
        $newFileHeader = implode("\n", $headerLines);

        /** @var SplFileInfo $file */
        foreach ($this->getSourceFilesFinder() as $file) {
            $this->replaceSourceFileHeader($file, $newFileHeader);
        }
    }

    private function getSourceFilesFinder(): Finder
    {
        $finder = $this->getBuildTask()->getFinder();

        $finder
            ->exclude(['Skeleton'])
            ->in(
                [
                    $this->getBuildTask()->path('src'),
                    $this->getBuildTask()->path('resources' . DIRECTORY_SEPARATOR . 'console'),
                ]
            )
            ->files()
            ->name('*.php');

        return $finder;
    }

    private function replaceSourceFileHeader(SplFileInfo $file, string $newFileHeader): void
    {
        $path = (string) $file->getRealPath();
        $contents = $file->getContents();

        $updatedContents = (string) preg_replace(
            self::HEADER_PATTERN,
            $newFileHeader,
            $contents,
            1
        );

        $this->getBuildTask()->getFilesystem()->dumpFile($path, $updatedContents);
    }
}
