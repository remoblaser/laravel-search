<?php namespace Remoblaser\Search;


use Remoblaser\Search\Exception\SearchException;

trait SearchableTrait {

    public function searchFields()
    {
        if(!property_exists($this, 'searchFields'))
            throw new SearchException("searchFields on ". get_class($this) ." have not been defined");

        return $this->searchFields;
    }
} 