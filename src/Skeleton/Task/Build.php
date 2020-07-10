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

namespace Ramsey\Skeleton\Task;

use Ramsey\Skeleton\Task\Builder\Cleanup;
use Ramsey\Skeleton\Task\Builder\InstallDependencies;
use Ramsey\Skeleton\Task\Builder\RenameTemplates;
use Ramsey\Skeleton\Task\Builder\RenameTestCase;
use Ramsey\Skeleton\Task\Builder\RunTests;
use Ramsey\Skeleton\Task\Builder\SetupRepository;
use Ramsey\Skeleton\Task\Builder\UpdateChangelog;
use Ramsey\Skeleton\Task\Builder\UpdateCodeOfConduct;
use Ramsey\Skeleton\Task\Builder\UpdateCommandPrefix;
use Ramsey\Skeleton\Task\Builder\UpdateComposerJson;
use Ramsey\Skeleton\Task\Builder\UpdateContributing;
use Ramsey\Skeleton\Task\Builder\UpdateFunding;
use Ramsey\Skeleton\Task\Builder\UpdateLicense;
use Ramsey\Skeleton\Task\Builder\UpdateNamespace;
use Ramsey\Skeleton\Task\Builder\UpdateReadme;
use Ramsey\Skeleton\Task\Builder\UpdateSourceFileHeaders;
use Twig\Environment as TwigEnvironment;

/**
 * The Build task executes all the builders used to build the library
 */
class Build extends Task
{
    /** @psalm-suppress PropertyNotSetInConstructor */
    private Answers $answers;

    /** @psalm-suppress PropertyNotSetInConstructor */
    private TwigEnvironment $twig;

    /**
     * Sets the Answers instance to use for storing user answers
     */
    public function setAnswers(Answers $answers): self
    {
        $this->answers = $answers;

        return $this;
    }

    /**
     * Returns the user answers
     */
    public function getAnswers(): Answers
    {
        return $this->answers;
    }

    /**
     * Sets the Twig environment instance to use for rendering Twig templates
     */
    public function setTwigEnvironment(TwigEnvironment $twig): self
    {
        $this->twig = $twig;

        return $this;
    }

    /**
     * Returns the Twig environment instance
     */
    public function getTwigEnvironment(): TwigEnvironment
    {
        return $this->twig;
    }

    /**
     * Executes each builder
     */
    public function run(): void
    {
        foreach ($this->getBuilders() as $builder) {
            $builder->build();
        }
    }

    /**
     * Returns a list of builders to use for creating a library
     *
     * @return list<Builder>
     */
    public function getBuilders(): array
    {
        return [
            new RenameTemplates($this),
            new UpdateComposerJson($this),
            new UpdateReadme($this),
            new UpdateLicense($this),
            new UpdateSourceFileHeaders($this),
            new UpdateNamespace($this),
            new RenameTestCase($this),
            new UpdateCodeOfConduct($this),
            new UpdateChangelog($this),
            new UpdateContributing($this),
            new UpdateFunding($this),
            new UpdateCommandPrefix($this),
            new InstallDependencies($this),
            new Cleanup($this),
            new SetupRepository($this),
            new RunTests($this),
        ];
    }
}
