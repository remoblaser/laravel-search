<?php namespace Remoblaser\Search;


use Remoblaser\Search\Exception\SearchException;

trait SearchableTrait {

    /**
     * Returns the Searchable fields
     *
     * @return mixed
     * @throws SearchException
     */
    public function searchFields()
    {
        if(!property_exists($this, 'searchFields'))
            throw new SearchException("Member searchFields on ". get_class($this) ." have not been defined");

        return $this->searchFields;
    }
} 