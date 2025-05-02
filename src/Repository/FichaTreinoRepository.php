<?php

namespace App\Repository;

use App\Entity\FichaTreino;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Usuarios;

/**
 * @extends ServiceEntityRepository<FichaTreino>
 */
class FichaTreinoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FichaTreino::class);
    }

    public function nova($idUsuario, array $data, $token): FichaTreino
    {
        $usuario = $this->getEntityManager()->getRepository(Usuarios::class)->findOneBy(['id' => $idUsuario]);
        $entityManager = $this->getEntityManager();
        $ficha = new FichaTreino;
        $ficha->setIdUsuario($usuario);
        $ficha->setToken($token);
        $ficha->setExperiencia($data['experiencia']);
        $ficha->setDificuldade($data['dificuldade']);
        $ficha->setFocoPrincipal($data['foco']);
        $ficha->setObjetivo($data['obj']);
        $ficha->setCreatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
        $ficha->setNomeFicha($data['nomeFicha']);
        $ficha->setPontosUsados(400);
        $entityManager->persist($ficha);
        $entityManager->flush();

        return $ficha;

    }

    public function findByToken($token)
    {
       $result = $this->findBy(['Token' => $token]);
       return $result;
    }

    public function findByIdUsuario($idUsuario)
    {
        $result = $this->findBy(['IdUsuario' => $idUsuario]);
        return $result;
    }
    

    //    /**
    //     * @return FichaTreino[] Returns an array of FichaTreino objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?FichaTreino
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
