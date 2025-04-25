<?php

namespace App\Repository;

use App\Entity\PagamentoPacoteFitCoins;
use App\Entity\PacotesFitCoins;
use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PagamentoPacoteFitCoins>
 */
class PagamentoPacoteFitCoinsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PagamentoPacoteFitCoins::class);
    }

    public function gerarPagamentoMercadoPago($idUsuario,  $idPacote, $correlationId, $metaDataJson): PagamentoPacoteFitCoins
    {
        $usuario = $this->getEntityManager()->getRepository(Usuarios::class)->findOneBy(['id' => $idUsuario]);
        $pacote = $this->getEntityManager()->getRepository(PacotesFitCoins::class)->findOneBy(['id' => $idPacote]);
        $entityManager = $this->getEntityManager();
        $pagamento = new PagamentoPacoteFitCoins;
        $pagamento->setIdUsuario($usuario);
        $pagamento->setIdFitCoins($pacote);
        $pagamento->setCorrelationId($correlationId);
        $pagamento->setMetadataJson($metaDataJson);
        $pagamento->setCreatedAt(new \DateTimeImmutable("now", new \DateTimeZone("America/Sao_Paulo")));

        $entityManager->persist($pagamento);
        $entityManager->flush();

        return $pagamento;
    }

    public function findByCorrelationId($correlationId)
    {
        $result = $this->findOneBy(['CorrelationId' => $correlationId]);
        return $result;
    }

    public function updatePagamento(PagamentoPacoteFitCoins $pagamentoPacoteFitCoins): PagamentoPacoteFitCoins
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($pagamentoPacoteFitCoins);
        $entityManager->flush();

        return $pagamentoPacoteFitCoins;

    }


    //    /**
    //     * @return PagamentoPacoteFitCoins[] Returns an array of PagamentoPacoteFitCoins objects
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

    //    public function findOneBySomeField($value): ?PagamentoPacoteFitCoins
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
