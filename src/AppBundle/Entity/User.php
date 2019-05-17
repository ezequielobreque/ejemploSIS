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
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="MeGusta", inversedBy="user")
     */
    protected $meGusta;
    /**
     * @ORM\OneToMany(targetEntity="Mensaje",cascade={"persist"},mappedBy="user")
     */
    protected $mensajes;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="losQueSigo")
     */
    protected $misSeguidores;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="misSeguidores")
     */
    protected $losQueSigo;




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
        $this->meGusta =new ArrayCollection();
        $this->losQueSigo = new ArrayCollection();
        $this->misSeguidores = new ArrayCollection();
    }

    public function addMensaje(Mensaje $mensaje){
        $this->mensajes[] = $mensaje;
        $mensaje->setUser($this);
        return $this;


    }
    public function addSeguir(User $usuario){
        $this->LosQueSigo[] = $usuario;
        $usuario->setSeguidor($this);
        return $this;


    }
    public function setSeguidor(User $usuario){
        $this->misSeguidores[]= $usuario;

    }


    /**
     * @return mixed
     */
    public function getMensajes()
    {
        return $this->mensajes;
    }

    public function getMensaje(int $int)
    {
        return $this->mensajes[$int];
    }


    public function  DarMeGusta(Mensaje $mensaje){
        $megusta=$mensaje->getMeGusta();
        $this->meGusta[]=$megusta;
        $megusta->setLike($this);
        return $this;


    }

}
