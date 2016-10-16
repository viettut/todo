<?php
/**
 * Created by PhpStorm.
 * User: giangle
 * Date: 8/28/16
 * Time: 12:43 PM
 */

namespace Viettut\Bundles\WebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\Annotations as Rest;
class SearchController extends Controller
{
    /**
     * @Route("/public/search", name="public_search")
     * @param $request
     * @Template()
     */
    public function searchAction(Request $request)
    {
        $keyword = $request->query->get('q');
        $courses = $this->get('viettut.repository.course')->search($keyword);
        $tutorials = $this->get('viettut.repository.tutorial')->search($keyword);
        return $this->render('ViettutWebBundle:Search:search.html.twig', array(
            'courses' => $courses,
            'tutorials' => $tutorials,
            'keyword' => $keyword,
            'totalMatch' => count($courses) + count($tutorials)
        ));
    }
}