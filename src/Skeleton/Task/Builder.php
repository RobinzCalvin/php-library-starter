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

/**
 * Represents a builder that uses user responses to build some part of a library
 */
abstract class Builder
{
    private Build $buildTask;

    public function __construct(Build $buildTask)
    {
        $this->buildTask = $buildTask;
    }

    /**
     * Executes the build action for this particular builder
     */
    abstract public function build(): void;

    /**
     * Returns the build task for this builder
     */
    public function getBuildTask(): Build
    {
        return $this->buildTask;
    }
}
