<?php
/**
 * dbabstraction-queries.php
 *
 * @author: artuom proskunin <artuomv.proskunin@gmail.com>
 * Date: 15.03.13
 * Time: 8:18
 *
 * Данный файл содержит все запросы выполняемые через DbAbstraction
 *
 * Формат запроса
 * (вариант без условных частей запроса)
 * <pre>
 * 'QUERY_ALIAS' => array(
 *     'driverName' => 'oracle|mysql',
 *     'fetch' => 'fetchRow|fetchAll',
 *     'fetchMode' => PDO::FETCH_ASSOC,
 *     'tpl' => "SELECT * FROM t WHERE t.f=:foo",
 *     'paramsNames' => array('bar'[ => 'num|str'])
 *  ),
 * </pre>
 *
 * (также возможен вариант условно-составляемого запроса beta)
 * <pre>
 * 'QUERY_ALIAS' => array(
 *     'driverName' => 'oracle|mysql',
 *     'fetch' => 'fetchRow|fetchAll',
 *     'fetchMode' => PDO::FETCH_ASSOC,
 *     'tpl' => "SELECT t.foo {ifParam:bar: , bar}
 *               FROM t
 *               WHERE t.foo=:foo
 *               {ifParam:bar|foo: AND bar LIKE(:bar)}
 *               ",
 *     'paramsNames' => array(
 *                          'bar'[ => 'num|str'],
 *                          'foo'[ => 'num|str']
 *                      )
 *  ),
 * </pre>
 * где условная часть запроса помещается в конструкцию {COMMAND:ARG[|ARG2]:SQL}
 * для COMMAND = ifParam
 *     ARG - это имя параметра, который должен быть установлен (!== null),
 *           можно указывать несколько параметров через |
 *          (например для JOIN, необходимость в котором может зависить от нескольких условий)
 *     SQL - собственно SQL код включаемый в запрос если параметр установлен
 */

return array(
    'getBudgetSummary'=>array(
        'driverName' => 'mysql',
        'fetch' => 'fetchAll',
        'fetchMode' => PDO::FETCH_ASSOC,
        'tpl' => "SELECT
                    a.article_id
                    , a.article_name
                    , bp.budget_plan_id
                    , bp.budget_plan_yan
                    , bp.budget_plan_feb
                    , bp.budget_plan_mar
                    , bp.budget_plan_apr
                    , bp.budget_plan_may
                    , bp.budget_plan_jun
                    , bp.budget_plan_jul
                    , bp.budget_plan_aug
                    , bp.budget_plan_sep
                    , bp.budget_plan_oct
                    , bp.budget_plan_nov
                    , bp.budget_plan_dec
                    , bp.budget_plan_year
                    , SUM(t.transaction_amount) AS amount
                  FROM budget_plan bp
                  JOIN article a ON a.article_id = bp.article_id
                  LEFT JOIN transaction t ON a.article_id = t.article_id
                  LEFT JOIN account acd ON t.account_id_debet = acd.account_id
                  WHERE 1=1
                    AND a.article_type = :article_type
                    AND bp.budget_plan_year = :year
                     GROUP BY a.article_id",
        'paramsNames' => array('year'=>'num', 'article_type'=>'str'),
    ),
    'getAccountBalanceInfo'=>array(
        'driverName' => 'mysql',
        'fetch' => 'fetchRow',
        'fetchMode' => PDO::FETCH_ASSOC,
        'tpl' => "SELECT
                    (
                      SELECT
                        SUM(td.transaction_amount) AS balance_coming
                      FROM transaction td
                      JOIN account a ON td.account_id_debet = a.account_id
                      WHERE 1=1
                        AND a.account_id = :account_id
                        AND (td.transaction_type = 'COMING' OR td.transaction_type = 'TRANSFER')
                        AND td.transaction_date <= :date
                    ) AS coming,
                    (
                      SELECT
                        SUM(tc.transaction_amount) AS balance_expense
                      FROM transaction tc
                      JOIN account a ON tc.account_id_credit = a.account_id
                      WHERE 1=1
                        AND a.account_id = :account_id
                        AND (tc.transaction_type = 'EXPENSE' OR tc.transaction_type = 'TRANSFER')
                        AND tc.transaction_date <= :date
                    ) AS expense,
                    (
                      SELECT a.account_start_balance FROM account a WHERE a.account_id = :account_id
                    ) AS start_balance",
        'paramsNames' => array('account_id'=>'num', 'date'=>'str'),
    ),
);

