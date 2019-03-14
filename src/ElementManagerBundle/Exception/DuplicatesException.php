<?php
/**
 * w-vision
 *
 * LICENSE
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that is distributed with this source code.
 *
 * @copyright  Copyright (c) 2019 w-vision AG (https://www.w-vision.ch)
 */

namespace CommonBundle\ObjectManager\SaveValidator\Exception;

use Pimcore\Model\DataObject\Concrete;
use Pimcore\Model\Element\ValidationException;

class DuplicatesException extends ValidationException
{
    /**
     * @var Concrete[]
     */
    private $duplicates;

    /**
     * @var array
     */
    private $matchedDuplicateFields;

    /**
     * @return Concrete[]
     */
    public function getDuplicates(): array
    {
        return $this->duplicates;
    }

    /**
     * @param Concrete[] $duplicates
     */
    public function setDuplicates($duplicates): void
    {
        $this->duplicates = $duplicates;
    }
}
