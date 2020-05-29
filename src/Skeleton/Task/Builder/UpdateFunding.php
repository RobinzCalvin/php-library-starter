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

/**
 * Replaces this project's FUNDING.yml file with an empty one for the new project
 */
class UpdateFunding extends Builder
{
    public function build(): void
    {
        $this->getBuildTask()->getIO()->write('<info>Updating .github/FUNDING.yml</info>');

        $changelog = $this->getBuildTask()->getTwigEnvironment()->render(
            'FUNDING.yml.twig',
            $this->getBuildTask()->getAnswers()->getArrayCopy()
        );

        $this->getBuildTask()->getFilesystem()->dumpFile(
            $this->getBuildTask()->path('.github/FUNDING.yml'),
            $changelog
        );
    }
}
