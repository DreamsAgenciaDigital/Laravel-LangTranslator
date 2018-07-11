<?php

namespace Dreams\LangTranslator;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Translation
 *
 * @author jorge
 */
class Translation extends Model
{
    protected $connection = 'mysql_www3';
    protected $table      = 'ltm_translations';
}
