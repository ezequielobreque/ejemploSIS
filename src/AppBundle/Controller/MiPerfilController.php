<?php
/**
 * Created by PhpStorm.
 * User: ezequiel_o
 * Date: 31/5/2019
 * Time: 5:56 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Mensaje;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MiPerfilController extends controller
{

    /**
     * @Route("/miperfil", name="miPerfil")
     */
    public function getMiPerfil()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $expr = $entityManager->getExpressionBuilder();

        $qb= $entityManager->createQueryBuilder();
        $qb->select('m')
            ->from('AppBundle:Mensaje', 'm')
            ->join('m.user', 'u')
            ->where('u.id = :ids')
            ->orderBy('m.fechaHora', 'DESC')
            ->setParameter('ids', $this->getUser()->getId());



        $qb->setFirstResult(0)
            ->setMaxResults(10);


        $query = $qb->getQuery();
        $mensajes=$query->getResult();

        // $usuario = $em->getRepository(\AppBundle\Entity\User::class)->findOneBy( ['username'=>$id]);
        // $mensaje=$usuario->getMensajes();

        return $this ->render('perfil/miperfil.html.twig',['perfil'=>$mensajes]);



    }
}