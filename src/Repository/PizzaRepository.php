<?php

namespace App\Repository;

use App\Entity\Pizza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pizza|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pizza|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pizza[]    findAll()
 * @method Pizza[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PizzaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pizza::class);
    }

    public function getPizzasWhereSlicesSup25()
    {
        return $this->createQueryBuilder('p')
            ->where('p.slices > 25')
            ->getQuery()
            ->getResult();
    }






    // Pizza <=> User <=> X

    public function getPizzasWhereUserNameDiffFlen()
    {
        return $this->createQueryBuilder('p')
            ->join('p.eatenBy', 'e')
            ->join('p.livreur','l')
            ->where("e.username != 'faltenux' ")
            ->andWhere("l.name = 'chaghali'")
            ->andWhere('p.slices > 32')
            ->getQuery()
            ->getResult();
    }










    public function getPizzaByOwnerUsername($username){
        return $this->createQueryBuilder('p')
            ->join('p.eatenBy','e')
            ->where('e.username = :username ')
            ->setParameter('username',$username)
            ->getQuery()
            ->getResult();
    }





    // /**
    //  * @return Pizza[] Returns an array of Pizza objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pizza
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
