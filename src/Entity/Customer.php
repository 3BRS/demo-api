<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Attribute as Serializer;
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
#[UniqueEntity(fields: ['email'], message: 'This email is already used.')]
class Customer extends ResourceEntity
{
    private const array DEFAULT_DETAIL_GROUPS = Group::ALL;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    #[Serializer\Groups([
        ...self::DEFAULT_DETAIL_GROUPS,
        Group::READ_LIST,
    ])]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    #[Serializer\Groups([
        ...self::DEFAULT_DETAIL_GROUPS,
        Group::READ_LIST,
    ])]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, unique: true, nullable: true)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    #[Assert\Email]
    #[Serializer\Groups([
        ...self::DEFAULT_DETAIL_GROUPS,
        Group::READ_LIST,
    ])]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    #[Serializer\Groups([
        ...self::DEFAULT_DETAIL_GROUPS,
        Group::READ_LIST,
    ])]
    private ?string $phone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Serializer\Groups([
        ...self::DEFAULT_DETAIL_GROUPS,
        Group::READ_LIST,
    ])]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\OneToOne(cascade: ['all'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    #[Assert\Valid]
    #[Serializer\Groups([...self::DEFAULT_DETAIL_GROUPS, Group::READ_LIST])]
    #[ApiProperty(readableLink: true, writableLink: true)]
    private ?Address $addressHome = null;

    #[ORM\OneToOne(cascade: ['all'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    #[Assert\Valid]
    #[Serializer\Groups(self::DEFAULT_DETAIL_GROUPS)]
    #[ApiProperty(readableLink: true, writableLink: true)]
    private ?Address $addressPostal = null;

    #[ORM\OneToOne(cascade: ['all'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    #[Assert\Valid]
    #[Serializer\Groups([...self::DEFAULT_DETAIL_GROUPS, Group::READ_LIST])]
    #[ApiProperty(readableLink: true, writableLink: true)]
    private ?Address $addressBilling = null;

    #[Serializer\Groups([Group::READ_LIST, Group::READ_DETAIL])]
    #[ApiProperty(writable: false)]
    public function getFullName(): ?string
    {
        $parts = [$this->getFirstName(), $this->getLastName()];
        $parts = array_filter($parts);
        if ($parts === []) {
            return null;
        }

        return implode(' ', $parts);
    }

    #[Serializer\Ignore]
    public function getAddress(): ?Address
    {
        return $this->getAddressHome()
            ?? $this->getAddressPostal()
            ?? $this->getAddressBilling();
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?\DateTimeInterface $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getAddressHome(): ?Address
    {
        return $this->addressHome;
    }

    public function setAddressHome(?Address $addressHome): void
    {
        $this->addressHome = $addressHome;
    }

    public function getAddressPostal(): ?Address
    {
        return $this->addressPostal;
    }

    public function setAddressPostal(?Address $addressPostal): void
    {
        $this->addressPostal = $addressPostal;
    }

    public function getAddressBilling(): ?Address
    {
        return $this->addressBilling;
    }

    public function setAddressBilling(?Address $addressBilling): void
    {
        $this->addressBilling = $addressBilling;
    }
}
