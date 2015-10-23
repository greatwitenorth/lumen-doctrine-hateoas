<?php namespace App;

use Doctrine\ORM\Mapping AS ORM;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation\Exclude as Exclude;

/**
 * @ORM\Entity
 * @ORM\Table(name="theories")
 * 
 * @Serializer\XmlRoot("theory")
 * @Hateoas\Relation(
 *      "self", 
 *      href = @Hateoas\Route(
 *              "theory",
 *              parameters = {"id": "expr(object.getId())"},
 *              absolute = true
 *            )
 * )
 * 
 *  @Hateoas\Relation(
 *     "scientist",
 *     href = @Hateoas\Route(
 *              "scientist",
 *              parameters = {"id": "expr(object.getScientist().getId())"},
 *              absolute = true
 *            )
 * )
 */
class Theory
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
	protected $title;

	/**
	 * @ORM\ManyToOne(targetEntity="Scientist", inversedBy="theories")
	 * @Exclude
	 * 
	 * @var Scientist
	 */
	protected $scientist;

	/**
	 * @param $title
	 */
	public function __construct($title)
	{
		$this->title = $title;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setScientist(Scientist $scientist)
	{
		$this->scientist = $scientist;
	}

	public function getScientist()
	{
		return $this->scientist;
	}
}