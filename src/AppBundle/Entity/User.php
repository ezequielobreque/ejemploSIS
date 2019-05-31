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
     * @ORM\ManyToMany(targetEntity="Mensaje",mappedBy="MeGustas")
     */
    protected $meGustas;
    /**
     * @ORM\OneToMany(targetEntity="Mensaje",cascade={"persist"},mappedBy="user")
     * @ORM\OrderBy({"fechaHora" = "DESC"})
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
        $this->meGustas =new ArrayCollection();
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
    public function getLosQueSigo()
    {
        return $this->losQueSigo;
    }


    /**
     * @return mixed
     */
    public function getMensajes()
    {
        return $this->mensajes;
    }
    /**
     * @return Mensaje
     */
    public function getMensaje(int $int)
    {
        return $this->mensajes[$int];
    }



    public function  DarMeGusta(Mensaje $mensaje){
        $this->meGustas[] = $mensaje;
        $mensaje->addMeGusta($this);
        return $this;


    }

    /**
     * @return mixed
     */
    public function getMisSeguidores()
    {
        return $this->misSeguidores;
    }

    /**
     * @param mixed $meGustas
     */
    public function setMeGustas($meGustas)
    {
        $this->meGustas = $meGustas;
    }

    /**
     * @param mixed $losQueSigo
     */
    public function setLosQueSigo($losQueSigo)
    {
        $this->losQueSigo = $losQueSigo;
    }


}
