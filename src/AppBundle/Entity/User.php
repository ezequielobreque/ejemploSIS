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
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @Vich\Uploadable
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
     * @Vich\UploadableField(mapping="imagen_usuario", fileNameProperty="imageName", size="imageSize")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $imageSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;



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
