<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Contact
{

	/**
	 * @ORM\Column(type="integer")
	 *
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 */
	private $id;

	/**
	 * @ORM\Column(type="string")
	 *
	 * @Assert\NotBlank()
	 */
	private $name;

	/**
	 * @ORM\Column(type="string")
	 *
	 * @Assert\NotBlank()
	 * @Assert\Email(
	 *     message="The email '{{ value }}' is not valid email address.",
	 *     checkMX=true
	 * )
	 */
	private $email;

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name) //FIXME: potřeba kvůli formuláři
	{
		$this->name = $name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email) //FIXME: potřeba kvůli formuláři
	{
		$this->email = $email;
	}

	public function __clone()
	{
		$this->id = NULL;
	}

}
