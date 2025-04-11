<?php

namespace App\Repository;

use App\Entity\Pessoa;
use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pessoa>
 */
class PessoaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pessoa::class);
    }

    public function findByIdUsuario(int $idUsuario)
    {
       $result = $this->findOneBy(['IdUsuario' => $idUsuario]);
       return $result;
    }

    public function novaPessoa($idUsuario, $nome, $sobrenome, $idade, $sexo, $altura, $peso): Pessoa
    {
        $usuario = $this->getEntityManager()->getRepository(Usuarios::class)->findOneBy(['id' => $idUsuario]);
        $entityManager = $this->getEntityManager();
        $pessoa = new Pessoa();
        $pessoa->setIdUsuario($usuario);
        $pessoa->setNome($nome);
        $pessoa->setSobrenome($sobrenome);
        $pessoa->setIdade($idade);
        $pessoa->setSexo($sexo);
        $pessoa->setAltura($altura);
        $pessoa->setPeso($peso);
        $pessoa->setCreatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));
        $entityManager->persist($pessoa);
        $entityManager->flush();
        return $pessoa;
    }

    public function updatePessoa(Pessoa $pessoa): Pessoa
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($pessoa);
        $entityManager->flush();

        return $pessoa;
    }

//    /**
//     * @return Pessoa[] Returns an array of Pessoa objects
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

//    public function findOneBySomeField($value): ?Pessoa
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
