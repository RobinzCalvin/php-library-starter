<?php

/**
 * This file is part of ramsey/php-library-starter-kit
 *
 * ramsey/php-library-starter-kit is open source software: you can
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

namespace Ramsey\Dev\LibraryStarterKit\Console\Question;

use Ramsey\Dev\LibraryStarterKit\Answers;
use Symfony\Component\Console\Question\Question;

/**
 * Asks for a URL that where security researchers may submit reports
 */
class SecurityPolicyContactFormUrl extends Question implements SkippableQuestion, StarterKitQuestion
{
    use AnswersTool;
    use UrlValidatorTool;

    public function getName(): string
    {
        return 'securityPolicyContactFormUrl';
    }

    public function __construct(Answers $answers)
    {
        parent::__construct(
            'At what URL should researchers submit vulnerability reports?',
            $answers->securityPolicyContactFormUrl,
        );

        $this->answers = $answers;
    }

    public function shouldSkip(): bool
    {
        return $this->getAnswers()->securityPolicy === false;
    }
}
