<?php
/**
 * Element Manager
 *
 * LICENSE
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2016-2018 w-vision AG (https://www.w-vision.ch)
 * @license    https://github.com/w-vision/ImportDefinitions/blob/master/gpl-3.0.txt GNU General Public License version 3 (GPLv3)
 */

namespace ElementManagerBundle\SaveManager;

use CommonBundle\ObjectManager\SaveValidator\Exception\DuplicatesException;
use ElementManagerBundle\DuplicateChecker\DuplicateServiceInterface;
use Pimcore\Model\DataObject\Concrete;

final class DuplicationSaveHandler extends AbstractObjectSaveHandler
{
    /**
     * @var DuplicateServiceInterface
     */
    private $duplicateService;

    /**
     * @param DuplicateServiceInterface $duplicateService
     */
    public function __construct(DuplicateServiceInterface $duplicateService)
    {
        $this->duplicateService = $duplicateService;
    }

    /**
     * {@inheritdoc}
     */
    public function preSave(Concrete $object, array $options): void
    {
        $result = $this->duplicateService->findDuplicates($object, [$options['group']]);

        if (count($result) > 0) {
            $duplicatesException = new DuplicatesException();
            $duplicatesException->setDuplicates($result);

            throw $duplicatesException;
        }
    }
}
