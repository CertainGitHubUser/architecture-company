<?php
declare(strict_types=1);

namespace App\Module\Common\Infrastructure\Repository;

use App\Module\Common\Domain\Repository\TransactionManagerInterface;
use Doctrine\ORM\EntityManagerInterface;

final class TransactionManager implements TransactionManagerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function begin(): void
    {
        $this->entityManager->beginTransaction();
    }

    public function commit(): void
    {
        $this->entityManager->commit();
    }

    public function rollback(): void
    {
        $this->entityManager->rollback();
    }

    public function transactional(callable $transaction): void
    {
        $this->entityManager->transactional($transaction);
    }
}