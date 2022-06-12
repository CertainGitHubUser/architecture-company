<?php

namespace App\Module\Common\Domain\Repository;

interface TransactionManagerInterface
{
    public function begin(): void;

    public function commit(): void;

    public function rollback(): void;

    public function transactional(callable $transaction): void;
}