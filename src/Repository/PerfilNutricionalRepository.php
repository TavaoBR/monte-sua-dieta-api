<?php

namespace App\Repository;

use App\Entity\PerfilNutricional;
use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PerfilNutricional>
 */
class PerfilNutricionalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PerfilNutricional::class);
    }

    public function novoPerfil($idUsuario, array $data): PerfilNutricional
    {
        $usuario = $this->getEntityManager()->getRepository(Usuarios::class)->findOneBy(['id' => $idUsuario]);
        $entityManager = $this->getEntityManager();
        $perfil = new PerfilNutricional;
        $perfil->setIdUsuario($usuario);
        $perfil->setObjetivo($data['obj']);
        $perfil->setNivelAtividade($data['nivelAtividade']);
        $perfil->setPreferenciasAlimentares($data['prefAlimentar']);
        $perfil->setRestricoesAlimentares($data['restricoes']);
        $perfil->setCondicoesMedica($data['condicoes']);
        $perfil->setAlergias($data['alergias']);
        $perfil->setCreatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
        $entityManager->persist($perfil);
        $entityManager->flush();
        return $perfil;
    }

    public function findByIdUsuario($idUsuario)
    {
        $result = $this->findBy(['IdUsuario' => $idUsuario]);
        return $result;
    }

    //    /**
    //     * @return PerfilNutricional[] Returns an array of PerfilNutricional objects
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

    //    public function findOneBySomeField($value): ?PerfilNutricional
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
