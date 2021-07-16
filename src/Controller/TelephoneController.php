<?php

namespace App\Controller;

use App\Entity\Telephone;
use App\Form\TelephoneType;
use App\Repository\TelephoneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/telephone/show/{id}", name="telephoneShow")
     */
    public function show(Telephone $telephone): Response
    {
        return $this->render('telephone/show.html.twig', [
            'telephone' => $telephone,
        ]);
    }


    /**
     * @Route("/telephone/del/{id}", name="telephoneDel")
     */
    public function del(Telephone $telephone, EntityManagerInterface $manager) : Response
    {

        $manager->remove($telephone);
        $manager->flush();

        return $this->redirectToRoute('telephoneIndex');
    }

    /**
     * @Route("/telephone/create/", name="telephoneCreate")
     * @Route ("/telephone/edit/{id}", name="telephoneEdit")
     */
    public function new(Telephone $telephone = null, Request $laRequete, EntityManagerInterface $manager) : Response
    {
        $modeCreate = false;

        if (!$telephone) {
            $telephone = new Telephone();
            $modeCreate = true;
        }

        $form = $this->createForm(TelephoneType::class, $telephone);

        $form->handleRequest($laRequete);
        if ($form->isSubmitted() && $form->isValid())
        {

            $manager->persist($telephone);
            $manager->flush();

            return $this->redirectToRoute('telephoneShow', [
                "id" => $telephone->getId()
            ]);
        }else {
            return $this->render('telephone/form.html.twig', [
                'formTelephone' => $form->createView(),
                'isCreate' => $modeCreate
            ]);
        }

    }


}
