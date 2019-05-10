<?php
/**
 * Created by PhpStorm.
 * User: ezequiel_o
 * Date: 30/4/2019
 * Time: 6:32 PM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 *
 * @ORM\Entity
 * @ORM\Table(name="mensaje")
 **/

class Mensaje
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="mensaje")
     * @ORM\JoinColumn(name="User_id",referencedColumnName="id",nullable=false)
     */
    protected $user;

    /**
     * @ORM\Column(type="string",length=144)
     */
    protected $informacion;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $FechaHora;

    public function __construct($informacion)
    {
        $this->informacion = $informacion;
        $this->FechaHora= new \DateTime();
    }
    public function setUser(User $user){
        $this->user= $user;

    }

}