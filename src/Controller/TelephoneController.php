<?php

namespace App\Controller;

use App\Entity\Telephone;
use App\Repository\TelephoneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TelephoneController extends AbstractController
{
    /**
     * @Route("/telephone", name="telephoneIndex")
     */
    public function index(TelephoneRepository $repository): Response
    {

        $tels = $repository->findAll();

        return $this->render('telephone/index.html.twig', [
            'telephones' => $tels,
        ]);
    }

    /**
     * @Route("/telephone/{id}", name="telephoneShow")
     */
    public function show(Telephone $telephone): Response
    {
        return $this->render('telephone/show.html.twig', [
            'telephone' => $telephone,
        ]);
    }


    /**
     * @Route("/telephone/{id}/del", name="telephoneDel")
     */
    public function del(Telephone $telephone, EntityManagerInterface $manager) : Response
    {

        $manager->remove($telephone);
        $manager->flush();

        return $this->redirectToRoute('telephoneIndex');
    }



}
