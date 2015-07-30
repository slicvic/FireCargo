<?php namespace App\Models;

/**
 * AccountType
 *
 * @author Victor Lantigua <vmlantigua@gmail.com>
 */
class AccountType extends Base {

    /**
     * The account types.
     *
     * @var int
     */
    const CLIENT    = 1;
    const SHIPPER   = 2;

    /**
     * The database table name.
     *
     * @var string
     */
    protected $table = 'account_types';
}
