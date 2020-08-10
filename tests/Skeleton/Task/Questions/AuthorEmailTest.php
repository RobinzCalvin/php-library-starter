<?php

declare(strict_types=1);

namespace Ramsey\Test\Skeleton\Task\Questions;

use Ramsey\Skeleton\Task\Questions\AuthorEmail;

class AuthorEmailTest extends QuestionTestCase
{
    public function getQuestionClass(): string
    {
        return AuthorEmail::class;
    }

    public function testGetQuestion(): void
    {
        $this->assertSame(
            'What is your email address?',
            $this->getQuestion()->getQuestion(),
        );
    }

    public function testGetName(): void
    {
        $this->assertSame(
            'authorEmail',
            $this->getQuestion()->getName(),
        );
    }

    public function testIsOptional(): void
    {
        $this->assertTrue($this->getQuestion()->isOptional());
    }
}
