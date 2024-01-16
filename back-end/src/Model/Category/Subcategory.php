<?php
declare(strict_types=1);

namespace App\Model\Category;

class Subcategory extends Category
{
    /**
     * @param int|null $id
     * @param string|null $name
     * @param RootCategory|null $rootCategory
     */
    public function __construct(
        int $id = null,
        string $name = null,
        private ?RootCategory $rootCategory = null
    ) {
        parent::__construct($id, $name);
    }

    /**
     * @return RootCategory|null
     */
    public function getRootCategory(): ?RootCategory
    {
        return $this->rootCategory;
    }

    /**
     * @param RootCategory|null $rootCategory
     */
    public function setRootCategory(?RootCategory $rootCategory): void
    {
        $this->rootCategory = $rootCategory;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return [
            ...parent::jsonSerialize(),
            'root_category' => $this->rootCategory
        ];
    }
}