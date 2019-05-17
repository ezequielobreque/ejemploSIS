<?php
/**
 * Created by PhpStorm.
 * User: ezequiel_o
 * Date: 10/5/2019
 * Time: 2:32 PM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 *
 * @ORM\Entity
 * @ORM\Table(name="meGusta")
 **/

class MeGusta
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="meGusta")
     */
    protected $user;

    /**
     * One MeGusta has One Mensaje.
     * @ORM\OneToOne(targetEntity="Mensaje",inversedBy="meGusta")
     */
    protected $mensaje;



    //protected $count;
    public function _construct(Mensaje $men)
    {
        //parent::_construct();
        $this->user =new ArrayCollection();
        $this->mensaje=$men;
        }


    
    public function setLike(User $usuario)
    {
        $this->user[]= $usuario;

    }

    /**
     * @return mixed
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }


    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}