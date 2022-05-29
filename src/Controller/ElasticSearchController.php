<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
use Elastica\Query;
use FOS\ElasticaBundle\Finder\TransformedFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1")
 */
final class ElasticSearchController extends AbstractController
{
    /**
     * @Route("/part1/search", name="main")
     */
    public function search(Request $request, SessionInterface $session, TransformedFinder $articlesFinder): JsonResponse
    {
        $query = new Query\MatchQuery('name', $request->query->get('q', ''));

        /** @var Article[] $results */
        $results = $articlesFinder->find($query);

        return new JsonResponse($results);
    }
}