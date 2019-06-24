<?php
/**
 * Created by PhpStorm.
 * User: ezequiel_o
 * Date: 24/6/2019
 * Time: 2:59 PM
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Mensaje;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class contraseniaController extends controller
{

    /**
     * @Route("/cambiar_contrasenia", name="CambiarC")
     */
    public function cambiarContraseniaAction(UserPasswordEncoderInterface $encoder,Request $request)
    {


        $entityManager = $this->getDoctrine()->getManager();


        $contra= $request->get('contra');

        $encoded = $encoder->encodePassword($this->getUser(), $contra);
        if($this->getUser()->getPassword()==$encoded){

            $var='hola';


      }else{
            $var=$encoded;
        }
        /*$edit = $this->createFormBuilder($user)

            ->add('plainPassword', PasswordType::class,[])
            ->add('save', SubmitType::class, ['label' => 'editar contrasenia'])
            ->getForm();

        $edit->handleRequest($request);

        if ($edit->isSubmitted() && $edit->isValid()) {



            $entityManager->flush();

            return $this->redirectToRoute('miPerfil');
        }*/
        return $this->render('contraseña/cambiar_contraseña.html.twig', ['var'=>$var]);

    }
}
