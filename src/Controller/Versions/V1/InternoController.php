<?php

namespace App\Controller\Versions\V1;

use App\Helpers\AuthHelpers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class InternoController extends AbstractController
{
    private $authHelpers;
    public function __construct(AuthHelpers $authHelpers)
    {
      $this->authHelpers = $authHelpers;
    }

    #[Route('/interno', name: 'app_interno')]
    public function index(): JsonResponse
    {
        $this->authHelpers->is_autenticado();

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/InternoController.php',
        ]);
    }
}
