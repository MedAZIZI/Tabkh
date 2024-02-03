<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

use App\Repository\RecettesRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: RecettesRepository::class)]
class Recettes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 3000, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 2000, nullable: true)]
    private ?string $ingredients = null;

    #[ORM\Column(length: 2000, nullable: true)]
    private ?string $Etapes = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $categorie = null;

    #[Vich\UploadableField(mapping: 'Recettes', fileNameProperty: 'imageSrc', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $imageSrc = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(?string $ingredients): static
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getEtapes(): ?string
    {
        return $this->Etapes;
    }

    public function setEtapes(?string $Etapes): static
    {
        $this->Etapes = $Etapes;

        return $this;
    }

    // public function getImageSrc(): ?string
    // {
    //     return $this->image_src;
    // }

    // public function setImageSrc(?string $image_src): static
    // {
    //     $this->image_src = $image_src;

    //     return $this;
    // }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
    public function parseIngredient(?string $IngredientString) {
        if (empty($IngredientString)) {
            return []; 
        }

        $IngredientsArray = explode(',', $IngredientString);
        return $IngredientsArray;
    }
    public function parseEtapes(?string $etapesString) {
        if (empty($etapesString)) {
            return []; 
        }
    
        $etapesArray = explode('-', $etapesString);
        return $etapesArray;
    }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
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

    public function setImageSrc(?string $imageSrc): void
    {
        $this->imageSrc = $imageSrc;
    }

    public function getImageSrc(): ?string
    {
        return $this->imageSrc;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

}
