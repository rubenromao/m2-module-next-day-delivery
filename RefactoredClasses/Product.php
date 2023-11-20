<?php
declare(strict_types=1);

namespace Envisage\NextDayDelivery\RefactoredClasses;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Product
{
    /**
     * Product Constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
    ) {
    }

    /**
     * @param $id
     * @return ProductInterface|null
     * @throws NoSuchEntityException
     */
    public function getProduct($id): ?ProductInterface
    {
        return $this->productRepository->getById($id) ?? null;
    }
}
