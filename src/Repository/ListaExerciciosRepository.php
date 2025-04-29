<?php

namespace App\Repository;

use App\Entity\GrupoMuscularPrioritario;
use App\Entity\ListaExercicios;
use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListaExercicios>
 */
class ListaExerciciosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListaExercicios::class);
    }

    public function novo(
        $idUsuario, 
        $idGrupo, 
        $nomeExercicio, 
        $musculoAtivado, 
        $equipamento, 
        $series, 
        $repeticoes,
        $dificuldade,
        $token,
        $comoExecutar
    ): ListaExercicios
    { 
       $usuario = $this->getEntityManager()->getRepository(Usuarios::class)->findOneBy(['id' => $idUsuario]);
       $grupo = $this->getEntityManager()->getRepository(GrupoMuscularPrioritario::class)->findOneBy(['id' => $idGrupo]);
       $entityManager = $this->getEntityManager();
       $exercio = new ListaExercicios;
       $exercio->setIdUsuario($usuario);
       $exercio->setIdGMP($grupo);
       $exercio->setExercicio($nomeExercicio);
       $exercio->setMusculoAtivado($musculoAtivado);
       $exercio->setEquipamento($equipamento);
       $exercio->setSeries((int)$series);
       $exercio->setRepeticoes((int)$repeticoes);
       $exercio->setDificuldade($dificuldade);
       $exercio->setToken($token);
       $exercio->setComoExecutar($comoExecutar);
       $exercio->setCreatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
       $entityManager->persist($exercio);
       $entityManager->flush();

       return $exercio;
    }

    //    /**
    //     * @return ListaExercicios[] Returns an array of ListaExercicios objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ListaExercicios
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
