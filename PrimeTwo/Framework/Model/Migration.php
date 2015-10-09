<?php
/**
 * Migration.php
 * Created by: koen
 * Date: 10/9/15
 * Time: 12:42 PM
 */

namespace PrimeTwo\Framework\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Migration extends Eloquent
{
    /**
     * @var string table name for the migrations
     */
    protected $table = 'migrations';

    /**
     * @var array fillable fields for the 'migration' table
     */
    protected $fillable = ['migration','batch'];

    /**
     * @var bool we don't want timestamps for migrations
     */
    public $timestamps = false;
}