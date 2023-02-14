<?php

namespace Neon\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Neon\Model\Scopes\ActiveScope;

class Basic extends EloquentModel
{
  /** Define basic status values.
   */
  const STATUS_ACTIVE     = 'A'; // Active
  const STATUS_DRAFT      = 'D'; // Draft
  const STATUS_INACTIVE   = 'I'; // Inactive
  const STATUS_NEW        = 'N'; // New

  /** Define the default status.
   * @const STATUS_DEFAULT The default status.
   */
  const STATUS_DEFAULT = self::STATUS_NEW;

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

  /**
   * Get the name of the "status" column.
   *
   * @return string
   */
  public function getStatusColumn()
  {
    return defined(static::class . '::STATUS') ? static::STATUS : 'status';
  }

  /**
   * Get the fully qualified "expired at" column.
   *
   * @return string
   */
  public function getQualifiedStatusColumn()
  {
    return $this->qualifyColumn($this->getStatusColumn());
  }
}
