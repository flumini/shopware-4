<?php
/**
 * Shopware 4
 * Copyright © shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Models\Article\Configurator\Template;
use Shopware\Components\Model\ModelEntity,
    Doctrine\ORM\Mapping AS ORM,
    Symfony\Component\Validator\Constraints as Assert,
    Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="s_article_configurator_templates")
 */
class Template extends ModelEntity
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer $articleId
     *
     * @ORM\Column(name="article_id", type="integer", nullable=false)
     */
    private $articleId;

    /**
     * @var integer $unitId
     *
     * @ORM\Column(name="unit_id", type="integer", nullable=true)
     */
    private $unitId = null;

    /**
     * @var string $number
     * @Assert\NotBlank
     * @Assert\Regex("/^[a-zA-Z0-9-_. ]+$/")
     *
     * @ORM\Column(name="order_number", type="string", nullable=false, unique = true)
     */
    private $number = '';

    /**
     * @var string $supplierNumber
     *
     * @ORM\Column(name="suppliernumber", type="string", nullable=true)
     */
    private $supplierNumber = null;


    /**
     * @var string $additionalText
     *
     * @ORM\Column(name="additionaltext", type="string", nullable=true)
     */
    private $additionalText = null;

    /**
     * @var integer $active
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active = false;

    /**
     * @var integer $inStock
     *
     * @ORM\Column(name="instock", type="integer", nullable=true)
     */
    private $inStock = null;

    /**
     * @var integer $stockMin
     *
     * @ORM\Column(name="stockmin", type="integer", nullable=true)
     */
    private $stockMin = null;

    /**
     * @var float $weight
     *
     * @ORM\Column(name="weight", type="decimal", nullable=true, precision=3)
     */
    private $weight = null;

    /**
     * @var float $weight
     *
     * @ORM\Column(name="width", type="decimal", nullable=true, precision=3)
     */
    private $width = null;

    /**
     * @var float $len
     * @ORM\Column(name="length", type="decimal", nullable=true, precision=3)
     */
    private $len = null;

    /**
     * @var float $height
     * @ORM\Column(name="height", type="decimal", nullable=true, precision=3)
     */
    private $height = null;

    /**
     * @var float ean
     * @ORM\Column(name="ean", type="string", nullable=true)
     */
    private $ean = null;

    /**
     * @var integer $position
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position = 0;

    /**
     * @var integer $minPurchase
     * @ORM\Column(name="minpurchase", type="integer", nullable=true)
     */
    private $minPurchase = null;

    /**
     * @var integer $purchaseSteps
     * @ORM\Column(name="purchasesteps", type="integer", nullable=true)
     */
    private $purchaseSteps = null;

    /**
     * @var integer $maxPurchase
     * @ORM\Column(name="maxpurchase", type="integer", nullable=true)
     */
    private $maxPurchase = null;

    /**
     * @var float $purchaseUnit
     *
     * @ORM\Column(name="purchaseunit", type="decimal", nullable=true)
     */
    private $purchaseUnit = null;

    /**
     * @var float $referenceUnit
     *
     * @ORM\Column(name="referenceunit", type="decimal", nullable=true)
     */
    private $referenceUnit = null;

    /**
     * @var string $packUnit
     *
     * @ORM\Column(name="packunit", type="text", nullable=true)
     */
    private $packUnit = null;

    /**
     * @var integer $shippingFree
     *
     * @ORM\Column(name="shippingfree", type="boolean", nullable=false)
     */
    private $shippingFree = false;

    /**
     * @var \DateTime $releaseDate
     *
     * @ORM\Column(name="releasedate", type="date", nullable=true)
     */
    private $releaseDate = null;

    /**
     * @var string $shippingTime
     *
     * @ORM\Column(name="shippingtime", type="string", length=11, nullable=true)
     */
    private $shippingTime = null;

    /**
     * OWNING SIDE
     * @ORM\OneToOne(targetEntity="Shopware\Models\Article\Article", inversedBy="configuratorTemplate")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    protected $article;

    /**
     * INVERSE SIDE
     * @ORM\OneToMany(targetEntity="Shopware\Models\Article\Configurator\Template\Price", mappedBy="template", orphanRemoval=true, cascade={"persist"})
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $prices;

    /**
     * INVERSE SIDE
     * @ORM\OneToOne(targetEntity="Shopware\Models\Attribute\Template", mappedBy="template", orphanRemoval=true, cascade={"persist"})
     * @var \Shopware\Models\Attribute\Template
     */
    protected $attribute;

    /**
     * OWNING SIDE
     * @var \Shopware\Models\Article\Unit $unit
     *
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Article\Unit", inversedBy="articles", cascade={"persist"})
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
     */
    protected $unit;


    /**
     * Class constructor. Initials the array collections.
     */
    public function __construct()
    {
        $this->prices = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Detail
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set supplierNumber
     *
     * @param $supplierNumber
     *
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setSupplierNumber($supplierNumber)
    {
        $this->supplierNumber = $supplierNumber;
        return $this;
    }

    /**
     * Get supplierNumber
     *
     * @return string
     */
    public function getSupplierNumber()
    {
        return $this->supplierNumber;
    }


    /**
     * @param $additionalText
     *
     * @return Template
     */
    public function setAdditionalText($additionalText)
    {
        $this->additionalText = $additionalText;
        return $this;
    }

    /**
     * Get additionalText
     *
     * @return string
     */
    public function getAdditionalText()
    {
        return $this->additionalText;
    }

    /**
     * Set active
     *
     * @param $active
     *
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Get active
     *
     * @return integer
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set inStock
     *
     * @param integer $inStock
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setInStock($inStock)
    {
        $this->inStock = $inStock;
        return $this;
    }

    /**
     * Get inStock
     *
     * @return integer
     */
    public function getInStock()
    {
        return $this->inStock;
    }

    /**
     * Set stockMin
     *
     * @param integer $stockMin
     * @return Detail
     */
    public function setStockMin($stockMin)
    {
        $this->stockMin = $stockMin;
        return $this;
    }

    /**
     * Get stockMin
     *
     * @return integer
     */
    public function getStockMin()
    {
        return $this->stockMin;
    }

    /**
     * Set weight
     *
     * @param float $weight
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param $article
     *
     * @return Template
     */
    public function setArticle($article)
    {
        $this->article = $article;
        return $this;
    }

    /**
     * @return \Shopware\Models\Attribute\Template
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param \Shopware\Models\Attribute\Template|array|null $attribute
     * @return \Shopware\Models\Attribute\Template
     */
    public function setAttribute($attribute)
    {
        return $this->setOneToOne($attribute, '\Shopware\Models\Attribute\Template', 'attribute', 'template');
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection|array|null $prices
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function setPrices($prices)
    {
        return $this->setOneToMany($prices, '\Shopware\Models\Article\Configurator\Template\Price', 'prices', 'template');
    }

    /**
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param float $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return float
     */
    public function getLen()
    {
        return $this->len;
    }

    /**
     * @param float $length
     */
    public function setLen($length)
    {
        $this->len = $length;
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return float
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @param float $ean
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
    }

    /**
     * Set shipping time
     *
     * @param string $shippingTime
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setShippingTime($shippingTime)
    {
        $this->shippingTime = $shippingTime;
        return $this;
    }

    /**
     * Get shipping time
     *
     * @return string
     */
    public function getShippingTime()
    {
        return $this->shippingTime;
    }

    /**
     * Set shippingFree
     *
     * @param integer $shippingFree
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setShippingFree($shippingFree)
    {
        $this->shippingFree = $shippingFree;
        return $this;
    }

    /**
     * Get shippingFree
     *
     * @return integer
     */
    public function getShippingFree()
    {
        return $this->shippingFree;
    }

    /**
     * Set releaseDate
     *
     * @param \DateTime|string|null $releaseDate
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setReleaseDate($releaseDate = null)
    {
        if ($releaseDate !== null && !($releaseDate instanceof \DateTime)) {
            $this->releaseDate = new \DateTime($releaseDate);
        } else {
            $this->releaseDate = $releaseDate;
        }
        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return \Date
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set minPurchase
     *
     * @param integer $minPurchase
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setMinPurchase($minPurchase)
    {
        $this->minPurchase = $minPurchase;
        return $this;
    }

    /**
     * Get minPurchase
     *
     * @return integer
     */
    public function getMinPurchase()
    {
        return $this->minPurchase;
    }

    /**
     * Set purchaseSteps
     *
     * @param integer $purchaseSteps
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setPurchaseSteps($purchaseSteps)
    {
        $this->purchaseSteps = $purchaseSteps;
        return $this;
    }

    /**
     * Get purchaseSteps
     *
     * @return integer
     */
    public function getPurchaseSteps()
    {
        return $this->purchaseSteps;
    }

    /**
     * Set maxPurchase
     *
     * @param integer $maxPurchase
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setMaxPurchase($maxPurchase)
    {
        $this->maxPurchase = $maxPurchase;
        return $this;
    }

    /**
     * Get maxPurchase
     *
     * @return integer
     */
    public function getMaxPurchase()
    {
        return $this->maxPurchase;
    }

    /**
     * Set purchaseUnit
     *
     * @param float $purchaseUnit
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setPurchaseUnit($purchaseUnit)
    {
        $this->purchaseUnit = $purchaseUnit;
        return $this;
    }

    /**
     * Get purchaseUnit
     *
     * @return float
     */
    public function getPurchaseUnit()
    {
        return $this->purchaseUnit;
    }

    /**
     * Set referenceUnit
     *
     * @param float $referenceUnit
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setReferenceUnit($referenceUnit)
    {
        $this->referenceUnit = $referenceUnit;
        return $this;
    }

    /**
     * Get referenceUnit
     *
     * @return float
     */
    public function getReferenceUnit()
    {
        return $this->referenceUnit;
    }

    /**
     * Set packUnit
     *
     * @param string $packUnit
     *
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setPackUnit($packUnit)
    {
        $this->packUnit = $packUnit;
        return $this;
    }

    /**
     * Get packUnit
     *
     * @return string
     */
    public function getPackUnit()
    {
        return $this->packUnit;
    }

    /**
     * OWNING SIDE
     * of the association between articles and unit
     * @return \Shopware\Models\Article\Unit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param \Shopware\Models\Article\Unit|array|null $unit
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

}
