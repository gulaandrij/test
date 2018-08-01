<?php

namespace App\Repository;

use App\Entity\BlogPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BlogPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPost[]    findAll()
 * @method BlogPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostRepository extends ServiceEntityRepository
{

    /**
     * BlogPostRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BlogPost::class);
    }

    /**
     * @param  int $page
     * @param  int $perPage
     * @return Paginator
     */
    public function getList(int $page, int $perPage): Paginator
    {
        $query = $this->createQueryBuilder('p')
            ->setFirstResult($page)
            ->setMaxResults($perPage)
            ->orderBy('p.publishedAt', Criteria::ASC)
            ->getQuery();

        return new Paginator($query);
    }
}
