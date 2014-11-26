<?php namespace Remoblaser\Search;

use App;
use Config;
use Remoblaser\Search\Exception\SearchException;
use Remoblaser\Search\Exception\SearchNotImplementedException;

class Search {

    /**
     * Handle static calls on the Search Facade
     *
     * @param $function
     * @param $args
     * @return mixed
     * @throws SearchException
     */
    public function __call($function, $args)
    {
        $keyword = $args[0];
        $searchable = $this->getModelForFunction($function);

        $resultSet = $this->search($searchable, $keyword);

        return $resultSet;
    }

    /**
     * Returns the specified Model for the function, determined by the Config file
     *
     * @param $function
     * @return mixed
     * @throws SearchException
     */
    private function getModelForFunction($function)
    {
        $className = Config::get("search::$function");

        if(is_null($className))
            throw new SearchException("No model for $function has been found in the config.");

        return App::make($className);
    }

    /**
     * Searches all available Models for the specified keyword
     *
     * @param $keyword
     * @return array
     */
    public function all($keyword)
    {
        $registeredModels = Config::get("search::config");

        $resultSet = [];
        foreach($registeredModels as $model) {
            $searchable = App::make($model);
            $resultSet[] = $this->search($searchable, $keyword);
        }

        return $resultSet;
    }

    /**
     * Searches the specified Searchable/Model for the specified keyword
     *
     * @param $searchable
     * @param $keyword
     * @return mixed
     */
    private function search($searchable, $keyword)
    {
        $searchFields = $searchable->searchFields();

        return $searchable->where(function($query) use ($searchFields, $keyword){
            foreach($searchFields as $field) {
                $query->orWhere($field, "LIKE", '%' . $keyword . '%');
            }
        })->get();
    }
} 