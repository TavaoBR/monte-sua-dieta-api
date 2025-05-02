<?php

namespace App\Repository;

use App\Entity\ExerciciosFicha;
use App\Entity\FichaTreino;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExerciciosFicha>
 */
class ExerciciosFichaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciciosFicha::class);
    }

    public function novo($idFicha, array $data, $exercicios, $token)
    {
      $ficha = $this->getEntityManager()->getRepository(FichaTreino::class)->findOneBy(['id' => $idFicha]);
      $entityManager = $this->getEntityManager(); 
      $exerciciosFicha = new ExerciciosFicha;
      $exerciciosFicha->setIdFicha($ficha);
      $exerciciosFicha->setToken($token);
      $exerciciosFicha->setDiaSemana($data['dia']);
      $exerciciosFicha->setGrupoMuscular($data['grupoMuscular']);
      $exerciciosFicha->setCardio($data['cardio']);
      $exerciciosFicha->setArrayExcercicios($exercicios);
      $exerciciosFicha->setObservacoes($data['observacoes']);
      $exerciciosFicha->setCreatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
      $entityManager->persist($exerciciosFicha);
      $entityManager->flush();

      return $exerciciosFicha;
    }

    public function findByToken($token)
    {
       $result = $this->findBy(['Token' => $token]);
       return $result;
    }

    //    /**
    //     * @return ExerciciosFicha[] Returns an array of ExerciciosFicha objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ExerciciosFicha
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
