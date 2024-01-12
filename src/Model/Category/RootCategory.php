<?php
declare(strict_types=1);

namespace App\Model\Category;

class RootCategory extends Category
{
    /**
     * @param int|null $id
     * @param string|null $name
     * @param Subcategory[] $subcategories
     */
    public function __construct(
        int           $id = null,
        string        $name = null,
        private array $subcategories = []
    ) {
        parent::__construct($id, $name);
    }

    /**
     * @return Subcategory[]
     */
    public function getSubcategories(): array
    {
        return $this->subcategories;
    }

    /**
     * @param Subcategory[] $subcategories
     */
    public function setSubcategories(array $subcategories): void
    {
        $this->subcategories = $subcategories;
    }

    /**
     * @param Subcategory $subcategory
     * @return void
     */
    public function addSubCategory(Subcategory $subcategory): void
    {
        $this->subcategories[] = $subcategory;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return [
            ...parent::jsonSerialize(),
            'subcategories' => $this->subcategories
        ];
    }
}