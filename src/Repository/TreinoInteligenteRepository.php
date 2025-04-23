<?php

namespace App\Repository;

use App\Entity\TreinoInteligente;
use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TreinoInteligente>
 */
class TreinoInteligenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TreinoInteligente::class);
    }

    public function findByIdUsuario(int $idUsuario)
    {
      $result = $this->findBy(['IdUsuario' => $idUsuario]);
      return $result;
    }

    public function findById(int $id, int $idUsuario)
    {
        $result = $this->findOneBy(['id' => $id, 'IdUsuario' => $idUsuario]);
        return $result;
    }

    public function gerarFicha($idUsuario, $objetivo, $prompt, $resultado, $pontos, $nivel): TreinoInteligente
    {
        $usuario = $this->getEntityManager()->getRepository(Usuarios::class)->findOneBy(['id' => $idUsuario]);
        $entityManager = $this->getEntityManager();
        $treino = new TreinoInteligente();
        $treino->setIdUsuario($usuario);
        $treino->setObjetivo($objetivo);
        $treino->setPrompt($prompt);
        $treino->setResultado($resultado);
        $treino->setPontosUsados($pontos);
        $treino->setNivel($nivel);
        $treino->setCreatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
        $entityManager->persist($treino);
        $entityManager->flush();
        return $treino;

    }

    //    /**
    //     * @return TreinoInteligente[] Returns an array of TreinoInteligente objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TreinoInteligente
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
