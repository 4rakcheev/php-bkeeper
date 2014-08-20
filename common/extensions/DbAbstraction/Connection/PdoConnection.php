<?php
/**
 * PdoConnection class file
 *
 * @author: artuom proskunin <artuomv.proskunin@gmail.com>
 */

/**
 * Class for incapsulating connection options and query
 */
class PdoConnection implements IConnection
{
    /**
     * Connection object
     * @var PDO
     */
    protected $connection = null;

    /**
     * Connection driver name
     * @var int
     */
    protected $connectionDriverName = self::oracle;

    /**
     * @var null
     */
    protected $queryManager = null;

    /**
     * Constructor
     * @param $connectionParams
     * @param $queryManager
     * @internal param array $params
     */
    public function __construct($connectionParams, QueryManager $queryManager)
    {
        $this->initConnection($connectionParams);
        $this->queryManager = $queryManager;
    }

    /**
     * Init for reinit connection object
     * @param array $connectionParams
     * @throws Exception
     * @internal param array $params
     */
    public function initConnection($connectionParams)
    {
        if (!isset($connectionParams['connectionDriverClassName'])
          or !isset($connectionParams['dsn'])
          or !isset($connectionParams['username'])
          or !isset($connectionParams['password'])
          or !isset($connectionParams['connectionDriverName'])
        ) {
            throw new Exception('Params connectionDriverName, connectionDriverClassName, dsn, username, password in File - ' . __FILE__ . ' at Line - ' . __LINE__ . ' must be set');
        }
        $this->connectionDriverName = $connectionParams['connectionDriverName'];
        if (!isset($connectionParams['options'])) {
            $connectionParams['options'] = null;
        }

        if (function_exists('pinba_timer_start')) {
            $t = pinba_timer_start(array('db_abs' => 'CONNECTION_' . $connectionParams['connectionDriverName'], 'host'=>Yii::app()->params->this_node_ip));
        }
        $this->connection = new $connectionParams['connectionDriverClassName']($connectionParams['dsn'], $connectionParams['username'], $connectionParams['password'], $connectionParams['options']);
        if (function_exists('pinba_timer_stop')) {
            pinba_timer_stop($t);
        }
    }

    /**
     * Do a query to storage on query alias and params
     * @param string $alias
     * @param null $queryParams
     * @param null $fetch
     * @throws Exception
     * @return array
     * @internal param array|null $params
     */
    public function query($alias, $queryParams = null, $fetch = null)
    {
        $query = $this->queryManager->getQuery($alias, $queryParams);
        if (isset($query['fixtures'])) {
            $cnt = count($query['fixtures']);
            return array($cnt, $query['fixtures']);
        }
        try{
            if (!isset($query['tpl'])) {
                throw new Exception('Params tpl, fetch in File - ' . __FILE__ . ' at Line - ' . __LINE__ . ' must be set');
            }

            if (function_exists('pinba_timer_start')) {
                $t = pinba_timer_start(array('db_abs' => $alias . '_PREPARE', 'host'=>Yii::app()->params->this_node_ip));
            }
            $stm = $this->connection->prepare($query['tpl']);
            if (function_exists('pinba_timer_stop')) {
                pinba_timer_stop($t);
            }

            /**
             * Если вместе с запросом переданны параметры и значение параметра не null
             * мы их биндим. По умолчанию bind вызывается с типом PDO::PARAM_STR.
             * В dbabstraction-queries можно указать какого типа параметр num или str.
             */
            if (!empty($queryParams)) {
                foreach ($queryParams as $k => $v) {
                    if ($v !== null) {
                        $bindType = PDO::PARAM_STR;
                        if (isset($query['paramsNames']) and isset($query['paramsNames'][$k])) {
                            switch ($query['paramsNames'][$k]) {
                                case 'num':
                                    $bindType = PDO::PARAM_INT;
                                    break;
                                case 'str':
                                    $bindType = PDO::PARAM_STR;
                                    break;
                                default:
                                    throw new CException('Unsupported bind type, check queries param for ' . $alias);
                                    break;
                            }
                        }
                        $stm->bindValue(':' . $k, $v, $bindType);
                    }
                }
            }

            if (function_exists('pinba_timer_start')) {
                $t = pinba_timer_start(array('db_abs'=>$alias . '_EXECUTE', 'host'=>Yii::app()->params->this_node_ip));
            }

            $stm->execute();
            if (function_exists('pinba_timer_stop')) {
                pinba_timer_stop($t);
            }

            $data = null;
            if (isset($query['fetch'])) {
                $fetch = $query['fetch'];
                if ($query['fetch'] == 'fetchRow') {
                    $fetch = 'fetchAll';
                }
                if (isset($query['fetchMode'])) {
                    $data = $stm->$fetch($query['fetchMode']);
                } else {
                    $data = $stm->$fetch();
                }
                if ($query['fetch'] == 'fetchRow') {
                    $data = reset($data);
                }
            } elseif ($fetch) {
                $data = $stm->$fetch();
            }
            $cnt = $stm->rowCount();
            return array($cnt, $data);
        } catch(Exception $e) // -- Exception --
        {
            return array('error' => 1, 'description' => $e);
        }
    }

    /**
     * Do a query to storage on query sql and params
     * @param string $sqlTpl
     * @param array | null $queryParams
     * @param string $fetch
     * @param int $fetchMode
     * @return array

    public function querySql(
        $sqlTpl,
        $queryParams = null,
        $fetch = 'fetchAll',
        $fetchMode = PDO::FETCH_ASSOC
    ){
        try{
            $stm = $this->connection->prepare($sqlTpl);
            if (!empty($queryParams)) {
                foreach ($queryParams as $k => $v) {
                    // default bind param type
                    $bindType = PDO::PARAM_STR;
                    // typed param
                    switch ($query['paramsNames'][$k]) {
                        case 'num':
                            $bindType = PDO::PARAM_INT;
                            break;
                        case 'str':
                        default:
                            $bindType = PDO::PARAM_STR;
                            break;
                    }
                    $stm->bindValue(':' . $k, $v, $bindType);
                }
            }
            $stm->execute();
            $data = null;
            if (isset($fetch)) {
                $fetch1 = $fetch;
                if ($fetch == 'fetchRow') {
                    $fetch1 = 'fetchAll';
                }
                if (isset($fetchMode)) {
                    $data = $stm->$fetch1($fetchMode);
                } else {
                    $data = $stm->$fetch1();
                }
                if ($fetch == 'fetchRow') {
                    $data = reset($data);
                }
            }
            $cnt = $stm->rowCount();
            return array($cnt, $data);
        } catch(Exception $e) // -- Exception --
        {
            return array('error' => 1, 'description' => $e);
        }
    }
     */

    /**
     * Begining transaction
     */
    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    /**
     * Commit transaction
     */
    public function commit()
    {
        $this->connection->commit();
    }

    /**
     * Rollback transaction
     */
    public function rollBack()
    {
        $this->connection->rollBack();
    }

}
