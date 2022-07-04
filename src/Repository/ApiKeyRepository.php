<?php

namespace App\Repository;

use App\Entity\ApiKey;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ApiKey|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApiKey|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApiKey[]    findAll()
 * @method ApiKey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApiKeyRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApiKey::class);
    }
}
