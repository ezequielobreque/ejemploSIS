<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mensaje;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
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
                    ->setMaxResults(2);
        $query = $qb->getQuery();

        $mensajes=$query->getResult();

       // $usuario = $em->getRepository(\AppBundle\Entity\User::class)->findOneBy( ['username'=>$id]);
       // $mensaje=$usuario->getMensajes();


        return $this ->render('usuario/usuario.html.twig',['perfil'=>$mensajes]);



    }
    /**
     * @Route("/mimuro", name="miPerfil")
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
            ->where('u.id = ?1')
            ->getQuery()
            ->setParameter(1, $this->getUser()->getId())
            ->execute();

        $qb = $entityManager->createQueryBuilder()
            ->select('m')
            ->from('AppBundle:Mensaje', 'm')
            ->join('m.user', 'u')
            ->where('u.id IN(:ids)')
            ->orderBy('m.fechaHora', 'DESC')
            ->setParameter('ids', $followsId);
        $query = $qb->getQuery(); //->execute();
        $user =$query->getResult();

        //$usuario= $usuario->getResult();
     //   if($usuario !== null){
     //       $user=$usuario[0]    ;

       // }




        return $this ->render('perfil/mimuro.html.twig',['perfil'=>$user]);



    }



    /*public function myMuro(){
        $em= $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(\AppBundle\Entity\User::class)->findOneBy(['username'=>'Ezequiel']);
        $seguidos=$usuario->getLosQueSigo();
        $nuevo= $usuario->getMensajes();
        foreach ($seguidos as $s) {

            $nuevo[]=$s.getMensaje(1);

        }
        function cmp_obj($a, $b)
        {
            $al = strtolower($a->getFechaHora());
            $bl = strtolower($b->getFechaHora());
            if ($al == $bl) {
                return 0;
            }
            return ($al > $bl) ? +1 : -1;
        }
        usort($nuevo,array(Mensaje,"cmp_obj"));





        return $this ->render('2base.html.twig',['mensajes'=>$nuevo]);



    }*/




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
