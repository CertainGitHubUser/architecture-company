<?php
declare(strict_types=1);

namespace App\Messanger;

final class SampleMessage
{
    public function __construct(string $content)
    {
    }

    public function getContent(): string
    {
        return 'test';
    }
}