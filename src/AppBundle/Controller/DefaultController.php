<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mensaje;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/perfil/{id}", name="alguno")
     */
    public function getPerfil(int $id)
    {
        $em= $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(\AppBundle\Entity\User::class)->find($id);
        $mensaje=$usuario->getMensajes();

        return $this ->render('2base.html.twig',['perfil'=>$usuario]);



    }


    /**
     * @Route("/lucky/number", name="luckynumber")
     */
    public function luckyNumberAction(Request $request)
    {
        /*$em= $this->getDoctrine()->getManager();*/

        $number = random_int(0, 100);

        return $this ->render('luckynumber.html.twig',['luckynumber'=>$number]);

        /*$usuario= $this->getDoctrine()
                        ->getRepository(\AppBundle\Entity\User::class)
                        ->find(1);

        $usuario->addMensaje(new Mensaje("mi primer mensaje"))
                ->addMensaje(new Mensaje("mi primer mensaje"))
            ->addMensaje(new Mensaje("mi primer mensaje"));

        $em->persist($usuario);
        $em->flush();*/
    }
}
