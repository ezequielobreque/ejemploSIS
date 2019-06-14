<?php
/**
 * Created by PhpStorm.
 * User: ezequiel_o
 * Date: 30/4/2019
 * Time: 6:32 PM
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="mensaje")
 * @Vich\Uploadable
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
    protected $fechaHora;

    /**
     * @ORM\ManyToMany(targetEntity="User",inversedBy="meGustas")
     */
    protected $meGustas;


    /**
     * @Vich\UploadableField(mapping="imagen_mensaje", fileNameProperty="imageName", size="imageSize")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     * @var integer
     */
    private $imageSize;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;




    public function __construct($informacion)
    {
        $this->informacion = $informacion;
        $this->fechaHora= new \DateTime();
        $m=rand(0,9);
        $this->fechaHora->modify("+{$m} minutes");
        $this->meGustas= new ArrayCollection();
    }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setUser(User $user){
        $this->user= $user;

    }

    /**
     * @return mixed
     */
    public function getFechaHora()
    {
        return $this->fechaHora;
    }

    /**
     * @return mixed
     */
    public function getMeGusta()
    {
        return $this->meGusta;
    }

    public function getMeGustas()
    {




        return sizeof($this->meGustas);
    }

    public function addMeGusta(User $user){
        $this->meGustas[]= $user;

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getInformacion()
    {
        return $this->informacion;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $informacion
     */
    public function setInformacion($informacion)
    {
        $this->informacion = $informacion;
    }

    /**
     * @param mixed $fechaHora
     */
    public function setFechaHora($fechaHora)
    {
        $this->fechaHora = $fechaHora;
    }

    /**
     * @param mixed $meGustas
     */
    public function setMeGustas($meGustas)
    {
        $this->meGustas = $meGustas;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }




}