<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Delete(),
        new Post(),
        new Patch(),
    ],
    normalizationContext: ['skip_null_values' => false],
)]
class Address extends ResourceEntity
{
    private const array DEFAULT_GROUPS = Group::ALL;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    #[Groups(self::DEFAULT_GROUPS)]
    private ?string $building = null;

    #[ORM\Column(nullable: false, enumType: CountryEnum::class)]
    #[Assert\NotBlank]
    #[Groups(self::DEFAULT_GROUPS)]
    private CountryEnum $country;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    #[Groups(self::DEFAULT_GROUPS)]
    private ?string $street = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    #[Groups(self::DEFAULT_GROUPS)]
    private ?string $city = null;

    #[ORM\Column(length: 8, nullable: true)]
    #[Assert\Length(max: 8)]
    #[Groups(self::DEFAULT_GROUPS)]
    private ?string $postcode = null;

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function setBuilding(?string $building): void
    {
        $this->building = $building;
    }

    public function getCountry(): CountryEnum
    {
        return $this->country;
    }

    public function setCountry(CountryEnum $country): void
    {
        $this->country = $country;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): void
    {
        $this->postcode = $postcode;
    }
}
