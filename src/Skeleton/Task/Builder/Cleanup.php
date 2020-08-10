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

use const DIRECTORY_SEPARATOR;

/**
 * Removes files that we don't want to include in the newly-created project
 */
class Cleanup extends Builder
{
    /**
     * The files and directories listed here are relative to the project root.
     */
    private const CLEANUP_FILES = [
        'resources' . DIRECTORY_SEPARATOR . 'templates',
        'src' . DIRECTORY_SEPARATOR . 'Skeleton',
        'tests' . DIRECTORY_SEPARATOR . 'Skeleton',
        '.git',
    ];

    public function build(): void
    {
        $this->getBuildTask()->getIO()->write('<info>Cleaning up...</info>');

        foreach (self::CLEANUP_FILES as $file) {
            $this->getBuildTask()->getFilesystem()->remove($this->getBuildTask()->path($file));

            $this->getBuildTask()->getIO()->write(
                sprintf(
                    '<comment>  - Deleted \'%s\'.</comment>',
                    $this->getBuildTask()->path($file),
                ),
            );
        }
    }
}
