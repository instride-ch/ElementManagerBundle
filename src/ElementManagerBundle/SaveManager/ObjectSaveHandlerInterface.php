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

use Pimcore\Model\DataObject\Concrete;

interface ObjectSaveHandlerInterface
{
    /**
     * @param Concrete $object
     * @param array    $options
     */
    public function preSave(Concrete $object, array $options): void;

    /**
     * @param Concrete $object
     * @param array    $options
     */
    public function postSave(Concrete $object, array $options): void;

    /**
     * @param Concrete $object
     * @param array    $options
     */
    public function preAdd(Concrete $object, array $options): void;

    /**
     * @param Concrete $object
     * @param array    $options
     */
    public function postAdd(Concrete $object, array $options): void;

    /**
     * @param Concrete $object
     * @param array    $options
     */
    public function preUpdate(Concrete $object, array $options): void;

    /**
     * @param Concrete $object
     * @param array    $options
     */
    public function postUpdate(Concrete $object, array $options): void;

    /**
     * @param Concrete $object
     * @param array    $options
     */
    public function preDelete(Concrete $object, array $options): void;

    /**
     * @param Concrete $object
     * @param array    $options
     */
    public function postDelete(Concrete $object, array $options): void;
}
