<?php namespace App;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation\Exclude as Exclude;

/**
 * @ORM\Entity
 * @ORM\Table(name="scientists")
 * 
 * @Serializer\XmlRoot("scientist")
 * 
 * @Hateoas\Relation(
 *      "self", 
 *      href = @Hateoas\Route(
 *              "scientist",
 *              parameters = {"id": "expr(object.getId())"},
 *              absolute = true
 *            )
 * )
 * 
 * @Hateoas\Relation(
 *     "theories",
 *     href = @Hateoas\Route(
 *              "scientist_theories",
 *              parameters = {"id": "expr(object.getId())"},
 *              absolute = true
 *            )
 * )
 */
class Scientist
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $firstname;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $lastname;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $age;

	/**
	 * @ORM\OneToMany(
	 *  targetEntity="Theory", 
	 *  mappedBy="scientist", 
	 *  cascade={"persist"}
	 * )
	 * 
	 * @Exclude
	 * 
	 * @var ArrayCollection|Theory[]
	 */
	private $theories;

	/**
	 * @param $firstname
	 * @param $lastname
	 */
	public function __construct($firstname, $lastname, $age)
	{
		$this->firstname = $firstname;
		$this->lastname  = $lastname;
		$this->age       = $age;

		$this->theories = new ArrayCollection;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getFirstname()
	{
		return $this->firstname;
	}

	public function getLastname()
	{
		return $this->lastname;
	}

	public function getAge()
	{
		return $this->age;
	}

	public function addTheory(Theory $theory)
	{
		if(!$this->theories->contains($theory)) {
			$theory->setScientist($this);
			$this->theories->add($theory);
		}
	}

	public function getTheories()
	{
		return $this->theories;
	}
}