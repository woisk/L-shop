<?php
declare(strict_types = 1);

namespace App\DataTransferObjects\Admin;

use App\Models\Category\CategoryInterface;
use App\Models\Product\ProductInterface;

class EditedProduct
{
    private $product;

    private $items;

    private $categories;

    private $category;

    public function __construct(
        ProductInterface $product,
        iterable $items,
        iterable $categories,
        CategoryInterface $category)
    {
        $this->product = $product;
        $this->items = $items;
        $this->categories = $categories;
        $this->category = $category;
    }

    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    public function getItems(): iterable
    {
        return $this->items;
    }

    public function getCategories(): iterable
    {
        return $this->categories;
    }

    public function getCategory(): CategoryInterface
    {
        return $this->category;
    }
}
