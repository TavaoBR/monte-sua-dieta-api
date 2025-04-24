<?php

namespace App\Repository;

use App\Entity\Payments;
use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Payments>
 */
class PaymentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payments::class);
    }

    public function novoPagamentoMP($idUsuario, $prefId, $metaDataJson): Payments
    {
        $usuario = $this->getEntityManager()->getRepository(Usuarios::class)->findOneBy(['id' => $idUsuario]);
        $entityManager = $this->getEntityManager();
        $payments = new Payments;
        $payments->setIdUsuario($usuario);
        $payments->setMPrefId($prefId);
        $payments->setMetadataJson($metaDataJson);
        $payments->setCreatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));

        $entityManager->persist($payments);
        $entityManager->flush();

        return $payments;
    }



    //    /**
    //     * @return Payments[] Returns an array of Payments objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Payments
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
