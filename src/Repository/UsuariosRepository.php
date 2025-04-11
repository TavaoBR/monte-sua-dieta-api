<?php

namespace App\Repository;

use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Usuarios>
 */
class UsuariosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuarios::class);
    }

    public function findByEmail(string $email)
    {
        $result = $this->findOneBy(['Email' => $email]);
        return $result;
    }

    public function findByNomeUsuario(string $nomeUsuario)
    {
       $result = $this->findOneBy(['NomeUsuario' => $nomeUsuario]);
       return $result;
    }

    public function findByToken(string $token)
    {
        $result = $this->findOneBy(['Token' => $token]);
        return $result;
    }

    public function novoUsuario($NomeUsuario, $senha, $email, $avatar): Usuarios
    {
        $entityManager = $this->getEntityManager();
        $usuario = new Usuarios;
        $usuario->setNomeUsuario($NomeUsuario);
        $usuario->setSenha($senha);
        $usuario->setEmail($email);
        $usuario->setAvatar($avatar);
        $usuario->setCreatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
        $entityManager->persist($usuario);
        $entityManager->flush();

        return $usuario;

    }

    public function updateUsuario(Usuarios $usuario)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($usuario);
        $entityManager->flush();

        return $usuario;
    }

    //    /**
    //     * @return Usuarios[] Returns an array of Usuarios objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Usuarios
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
