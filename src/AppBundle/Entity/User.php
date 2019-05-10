<?php
/**
 * Created by PhpStorm.
 * User: ezequiel_o
 * Date: 29/4/2019
 * Time: 7:53 PM
 */

namespace AppBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 **/
class User extends BaseUser

{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Mensaje",cascade={"persist"},mappedBy="user")
     */
    protected $mensajes;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }




    /* es posible agregar mas atributos*/
    public function _construct()
    {
        parent::_construct();
        $this->mensajes =new ArrayCollection();
    }

    public function addMensaje(Mensaje $mensaje){
        $this->mensajes[] = $mensaje;
        $mensaje->setUser($this);
        return $this;


    }

    /**
     * @return mixed
     */
    public function getMensajes()
    {
        return $this->mensajes;
    }


}
