<?php namespace Remoblaser\Search;

use App;
use Config;
use Remoblaser\Search\Exception\SearchException;
use Remoblaser\Search\Exception\SearchNotImplementedException;

class Search {

    public function __call($func, $args)
    {
        $searchable = $this->getObjectForFunction($func);

        $fields = $searchable->searchFields();

        return $searchable->where(function($query) use ($fields, $args){
            foreach($fields as $field)
            {

                $query->orWhere($field, "LIKE", '%' . $args[0] . '%');
            }
        })->get();
    }

    private function getObjectForFunction($function)
    {
        $classname = Config::get("search::bindings.$function");
        if(is_null($classname) || $classname == "")
            throw new SearchException("No model for $function has been found in the config.");

        return App::make($classname);
    }
} 