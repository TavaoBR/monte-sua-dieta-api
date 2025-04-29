<?php

namespace App\Repository;

use App\Entity\GrupoMuscularPrioritario;
use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GrupoMuscularPrioritario>
 */
class GrupoMuscularPrioritarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GrupoMuscularPrioritario::class);
    }

    public function novo(
        $idUsuario, 
        $grupoMuscular, 
        $nivel, 
        $qtdFitCoins, 
        $objetivo
    ): GrupoMuscularPrioritario
    {
        $usuario = $this->getEntityManager()->getRepository(Usuarios::class)->findOneBy(['id' => $idUsuario]);
        $entityManager = $this->getEntityManager();
        $grupo = new GrupoMuscularPrioritario();
        $grupo->setGrupoMuscular($grupoMuscular);
        $grupo->setIdUsuario($usuario);
        $grupo->setNivel($nivel);
        $grupo->setQtdFitCoins($qtdFitCoins);
        $grupo->setObjetivo($objetivo);
        $grupo->setCreatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
        $entityManager->persist($grupo);
        $entityManager->flush();
        return $grupo;
    }

    //    /**
    //     * @return GrupoMuscularPrioritario[] Returns an array of GrupoMuscularPrioritario objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?GrupoMuscularPrioritario
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
