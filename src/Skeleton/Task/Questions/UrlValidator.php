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

namespace Ramsey\Skeleton\Task\Questions;

use InvalidArgumentException;

use function filter_var;
use function strlen;
use function trim;

use const FILTER_VALIDATE_URL;

trait UrlValidator
{
    abstract public function isOptional(): bool;

    public function getValidator(): callable
    {
        return function (string $data): string {
            if ($this->isOptional() && strlen(trim((string) $data)) === 0) {
                return $data;
            }

            if (filter_var($data, FILTER_VALIDATE_URL) && strpos($data, 'http') === 0) {
                return $data;
            }

            throw new InvalidArgumentException(
                'You must enter a valid URL, beginning with "http://" or "https://".'
            );
        };
    }
}
