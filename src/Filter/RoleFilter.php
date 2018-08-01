<?php

namespace App\Filter;

use App\Annotation\RoleAware;
use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

/**
 * Class AdminFilter
 *
 * @package App\Filter
 */
class RoleFilter extends SQLFilter
{

    /**
     *
     * @var Reader
     */
    public $reader;

    /**
     * Gets the SQL query part to add to a query.
     *
     * @param ClassMetadata $targetEntity
     * @param string        $targetTableAlias
     *
     * @return string The constraint SQL if there is available, empty string otherwise.
     */
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias): string
    {
        if ($this->reader === null) {
            return '';
        }

        $aware = $this->reader->getClassAnnotation(
            $targetEntity->getReflectionClass(),
            RoleAware::class
        );

        if (!$aware) {
            return '';
        }

        return "$targetTableAlias.status = 'publish'";
    }

    /**
     *
     * @param Reader $reader
     *
     * @return void
     */
    public function setAnnotationReader(Reader $reader): void
    {
        $this->reader = $reader;
    }
}
