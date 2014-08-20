<?php
/**
 * DbAbstractionWrapperYii class file
 *
 * @author: artuom proskunin <artuomv.proskunin@gmail.com>
 */


/**
 * Class DbAbstractionWrapperYii
 */
class DbAbstractionWrapperYii extends CComponent
{
    /**
     * @var null
     */
    protected $connMan = null;

    /**
     * @var null
     */
    protected $queryMan = null;

    /**
     * @var null
     */
    public $connections = null;

    /**
     * @var null
     */
    public $queries = null;

    /**
     * @throws Exception
     */
    public function init()
    {
        if (empty($this->connections) || empty($this->queries)) {
            throw new Exception('Params connections and queries must be set');
        }
        $this->queryMan = new QueryManager($this->queries);

        $this->initConnMan($this->queryMan);
        foreach ($this->connections as $connection) {
            $this->connMan->setConnectionParam(
              $connection['connectionName'],
              $connection['connectionSettings']
            );
        }
    }

    /**
     * @param $queryMan
     */
    private function initConnMan($queryMan)
    {
        $this->connMan = new ConnectionManager($queryMan);
    }

    /**
     * @param $connName
     * @return mixed
     */
    public function getConn($connName)
    {
        return $this->connMan->getConnection($connName);
    }
}
