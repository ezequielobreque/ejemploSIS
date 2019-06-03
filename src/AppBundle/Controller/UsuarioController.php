<?php
/**
 * Created by PhpStorm.
 * User: ezequiel_o
 * Date: 31/5/2019
 * Time: 2:36 AM
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
class UsuarioController extends controller
{

    /**
     * @Route("/perfil/{id}", name="userPerfil")
     */
    public function getPerfil(string $id)
    {
        $em= $this->getDoctrine()->getManager();
        $qb= $em->createQueryBuilder();
        $qb->select('m')
            ->from('AppBundle:Mensaje', 'm')
            ->join('m.user', 'u')
            ->where('u.username = :username')
            ->orderBy('m.fechaHora', 'DESC')
            ->setParameter('username', $id);


        $qb->setFirstResult(0)
            ->setMaxResults(10);
        $query = $qb->getQuery();

        $mensajes=$query->getResult();

        // $usuario = $em->getRepository(\AppBundle\Entity\User::class)->findOneBy( ['username'=>$id]);
        // $mensaje=$usuario->getMensajes();


        return $this ->render('usuario/usuario.html.twig',['perfil'=>$mensajes]);



    }
}