<?php
/**
 * IConnection class file
 *
 * @author: artuom proskunin <artuomv.proskunin@gmail.com>
 */

/**
 * Connection interface
 */
interface IConnection
{
    /**
     * Connection Driver Name
     */
    const mysql = 1;
    const oracle = 2;
    const postgre = 3;

    /**
     * Init connection
     * @param array $queryParams
     */
    public function initConnection($queryParams);

    /**
     * Do a query to storage on query alias and params
     *
     * @param string $alias
     * @param array | null $queryParams
     * @param null $fetch
     * @return
     */
    public function query($alias, $queryParams = null, $fetch = null);

    /**
     * Do a query to storage on query sql and params
     *
     * @param string $sqlTpl
     * @param array | null $queryParams
     * @param string $fetch
     * @param int $fetchMode
     * @return

    public function querySql(
        $sqlTpl,
        $queryParams = null,
        $fetch = 'fetchAll',
        $fetchMode = PDO::FETCH_ASSOC
    );
     * */

    /**
     * Begining transaction
     */
    public function beginTransaction();

    /**
     * Commit transaction
     */
    public function commit();

    /**
     * Rollback transaction
     */
    public function rollBack();
}
