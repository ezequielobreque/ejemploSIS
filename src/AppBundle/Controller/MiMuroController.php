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

class miMuroController
{

    /**
     * @Route("/mimuro", name="megusta")
     */
    public function CMensajeAction(Request $request) {

        $mensaje = new mensaje();
        $informacion = $request->request->get('_postear');

        $mensaje->setInformacion();

        $user = $this->getUser()->getId();

        $form = $user->addmensaje( $mensaje);

        /*$form = $this->createForm('', $categorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mensaje);
            $em->flush();

            $this->addFlash(

                'mensaje publicado'
            );

            return $this->redirectToRoute('perfil/miperfil.html.twig');*/

            //return $this->redirectToRoute('libro_show', array('id' => $libro->getId()));
        }

        return $this->render('@Libros/crud/new.html.twig', array(
            'libro' => $libro,
            'form' => $form->createView(),
            'entidadNombre' => 'Libro',
            'listaEntidad' => 'Libros',
            'rutaIndex' => 'libro_index',
        ));
    }


}