<?php

namespace Dreams\LangTranslator\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Translation
 *
 * @author Jorge Lopez
 */
class Translation extends Model
{
    public function __construct() {
        parent::__construct();

        $this->connection = config('translationDb.connection');
        $this->table      = config('translationDb.table');
    }
}
