<?php

namespace App\Repository;

use App\Entity\PlanoAlimentar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Usuarios;

/**
 * @extends ServiceEntityRepository<PlanoAlimentar>
 */
class PlanoAlimentarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanoAlimentar::class);
    }

    public function addPlanoAlimentar(int $idUsuario, array $data, string $nomePlano, string $token): PlanoAlimentar
    {
        $usuario = $this->getEntityManager()->getRepository(Usuarios::class)->findOneBy(['id' => $idUsuario]);
        $entityManager = $this->getEntityManager();
        $plano = new PlanoAlimentar;
        $plano->setIdUsuario($usuario);
        $plano->setNomePlano($nomePlano);
        $plano->setRefeicoes($data['plano_alimentar']);
        $plano->setTotaisDiarios($data['totais_diarios']);
        $plano->setSugestaoMelhoria($data['sugestao_melhora']);
        $plano->setToken($token);
        $plano->setPontosUsados(400);
        $plano->setCreatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
        $entityManager->persist($plano);
        $entityManager->flush();

        return $plano;
    }

    public function findByIdUsuario(int $idUsuario)
    {
        $result = $this->findBy(['IdUsuario' => $idUsuario], ['id' => 'DESC']);
        return $result;
    }

    public function findByToken(string $token)
    {
        $result = $this->findOneBy(['Token' => $token]);
        return $result;
    }

    //    /**
    //     * @return PlanoAlimentar[] Returns an array of PlanoAlimentar objects
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

    //    public function findOneBySomeField($value): ?PlanoAlimentar
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
