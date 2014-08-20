<?php
/**
 * ConnectionManager class file
 *
 * @author: artuom proskunin <artuomv.proskunin@gmail.com>
 */

/**
 * Class for incapsulating getting Connection instance
 */
class ConnectionManager
{
    /**
     * Connection params
     * @var array
     */
    protected $connectionParamArray = array();

    /**
     * Array or connections IConnection
     * each connection have attributes
     * - connectionClassName
     * - connectionDriverClassName (const from IConnection)
     * @var array
     */
    protected $connectionArray = array();

    /**
     * @var null
     */
    protected $queryManager = null;

    /**
     * @param QueryManager $queryManager
     */
    public function __construct(QueryManager $queryManager)
    {
        $this->queryManager = $queryManager;
    }

    /**
     * Set connection
     * @param string | integer $connectionId
     * @param Connection $connectionParams
     */
    public function setConnectionParam($connectionId, $connectionParams)
    {
        $this->connectionParamArray[$connectionId] = $connectionParams;
    }

    /**
     * Gets connected instance of Connection
     * @param $connectionId
     * @throws Exception
     * @internal param int|string $connectorId
     * @return IConnection
     */
    public function getConnection($connectionId)
    {
        if (isset($this->connectionArray[$connectionId])) {
            return $this->connectionArray[$connectionId];
        }
        if (isset($this->connectionParamArray[$connectionId])
          and is_array($this->connectionParamArray[$connectionId])
            and !empty($this->connectionParamArray[$connectionId]['connectionClassName'])
        ) {
            $this->connectionArray[$connectionId] = new $this->connectionParamArray[$connectionId]['connectionClassName']($this->connectionParamArray[$connectionId], $this->queryManager);
			return $this->connectionArray[$connectionId];
		}
        throw new Exception('Wrong connectionId - ' . $connectionId . ' in File - ' . __FILE__ . ' at Line - ' . __LINE__);
    }
}
