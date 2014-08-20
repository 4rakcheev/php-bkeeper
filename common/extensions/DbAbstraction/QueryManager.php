<?php
/**
 * QueryManager class file
 *
 * @author: artuom proskunin <artuomv.proskunin@gmail.com>
 */

/**
 * Manage queries
 */
class QueryManager
{

    /**
     * @var
     */
    public $queries;

    /**
     * @param $queries
     */
    public function __construct($queries)
    {
        $this->queries = $queries;
    }

    /**
     * Основная задача этого метода вернуть запрос по алиасу,
     * дополнительно необходимо проверить $this->queries['ALIAS_NAME']['tpl']
     * наличие условных частей запроса и произвести их подстановку если
     * зависимый параметр не null. Если переданный параметр null условную часть запроса необходимо отбросить.
     *
     *
     * @param $alias
     * @param $queryParams
     * @throws CException
     * @return
     */
    public function getQuery($alias, $queryParams)
    {
        if (isset($this->queries[$alias])) {
            $query = $this->queries[$alias];
            $query['tpl'] = preg_replace_callback(
                 '/\{.*\}/',
                 function($matches) use ($queryParams) {
                     $replacement = explode(':', str_replace(array('{','}'), '', $matches[0]));
                     $condition = array_shift($replacement);
                     if ($condition == 'ifParam') {
                         $paramNames = explode("|", array_shift($replacement));
                         $needReplace = false;
                         foreach ($paramNames as $paramName) {
                             if ($needReplace = (isset($queryParams[$paramName]) && $queryParams[$paramName] !== null)) {
                                 break;
                             }
                         }
                         return $needReplace ? implode(':', $replacement) : '';
                     } else {
                         throw new CException("Unsupported condition type");
                     }
                 },
                 $query['tpl']);
            return $query;
        } else {
            throw new CException('DbAbs unknown query alias');
        }
    }
}
