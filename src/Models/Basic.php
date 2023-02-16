<?php

namespace Neon\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Neon\Model\Scopes\ActiveScope;

class Basic extends EloquentModel
{
  /**
   * The "booted" method of the model.
   * 
   * @see https://laravel.com/docs/9.x/eloquent#applying-global-scopes
   *
   * @return void
   */
  protected static function booted()
  {
    // static::addGlobalScope(new ActiveScope);
    
        // 'status'    => self::STATUS_DEFAULT,
  }
}
