<?php

namespace App\Repository;

use App\Entity\PadraoAlimentar;
use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PadraoAlimentar>
 */
class PadraoAlimentarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PadraoAlimentar::class);
    }

    public function findByUsuarioId(int $usuarioId)
    {
        $result = $this->findOneBy(['UsuarioId' => $usuarioId]);
        return $result;
    }

    public function addPadraoAlimentar($usuarioId, $dietaEspecifica, $restricaoAlimentar, $preferenciaAlimentar): PadraoAlimentar
    {
       $usuario = $this->getEntityManager()->getRepository(Usuarios::class)->findOneBy(["id" => $usuarioId]);
       $entityManager = $this->getEntityManager();
       $padraoAlimentar = new PadraoAlimentar();
       $padraoAlimentar->setUsuarioId($usuario);
       $padraoAlimentar->setDietaEspecifica($dietaEspecifica);
       $padraoAlimentar->setRestricaoAlimentar($restricaoAlimentar);
       $padraoAlimentar->setPreferenciaAlimentar($preferenciaAlimentar);
       $padraoAlimentar->setCreatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
       $entityManager->persist($padraoAlimentar);
       $entityManager->flush();
       return $padraoAlimentar;
    }

    public function updatePadraoAlimentar(PadraoAlimentar $padraoAlimentar): PadraoAlimentar
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($padraoAlimentar);
        $entityManager->flush();

        return $padraoAlimentar;
    }

    //    /**
    //     * @return PadraoAlimentar[] Returns an array of PadraoAlimentar objects
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

    //    public function findOneBySomeField($value): ?PadraoAlimentar
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
