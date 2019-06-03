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

class MiMuroController extends controller
{
    /**
     * @Route("/mimuro", name="miMuro")
     */





    public function getAlgo()
    {
        // $em= $this->getDoctrine()->getManager();
        //$usuario = $em->createQuery("SELECT u FROM AppBundle\Entity\User u  WHERE u.seguidos ='Ezequiel'");

        $entityManager = $this->getDoctrine()->getManager();
        $expr = $entityManager->getExpressionBuilder();

        $followsId = $entityManager->createQueryBuilder()
            ->select('seg.id')
            ->from('AppBundle:User', 'u')
            ->join('u.losQueSigo', 'seg')
            ->where('u.id = :id')
            ->getQuery()
            ->setParameter("id", $this->getUser()->getId())
            ->execute();

        $qb = $entityManager->createQueryBuilder()
            ->select('m')
            ->from('AppBundle:Mensaje', 'm')
            ->join('m.user', 'u')
            ->where('u.id IN(:ids)')
            ->orderBy('m.fechaHora','DESC')
            ->setParameter('ids', $followsId);
        $qb->setFirstResult(0)
            ->setMaxResults(5);
        $query = $qb->getQuery(); //->execute();
        $user =$query->getResult();


        //$usuario= $usuario->getResult();
        //   if($usuario !== null){
        //       $user=$usuario[0]    ;

        // }




        return $this ->render('perfil/mimuro.html.twig',['perfil'=>$user]);



    }





    /**
     * @Route("/mimuro", name="CMensaje")
     */
    public function CMensajeAction(Request $request) {


        $forms=$this->createFormBuilder($mensaje);





        /*$form = $this->createForm('', $categorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mensaje);
            $em->flush();

            $this->addFlash(

                'mensaje publicado'
            );

            return $this->redirectToRoute('perfil/miperfil.html.twig');

            //return $this->redirectToRoute('libro_show', array('id' => $libro->getId()));
        }*/




}
}