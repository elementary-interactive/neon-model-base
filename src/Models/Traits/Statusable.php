<?php

namespace Neon\Models\Traits;

use Neon\Models\Scopes\ActiveScope;
use Neon\Models\Statuses\BasicStatus;

/** 
 
 * 
 * @author: Balázs Ercsey <balazs.ercsey@elementary-interactive.com>
 */
trait Statusable
{

  /** Boot the statusable trait for a model.
   * 
   * @return void
   */
  public static function bootStatusable()
  {
    static::addGlobalScope(new ActiveScope);
  }

  /**
   * Activate a statusable model instance.
   *
   * @return bool
   */
  public function activate($time = null): bool
  {
    /** If the publishing event does not return false, we will proceed with this operation.
     */
    if ($this->fireModelEvent('activating') === false) {
      return false;
    }

    $this->{$this->getStatusColumn()} = BasicStatus::Active->value;

    $result = $this->save();

    $this->fireModelEvent('activated', false);

    return $result;
  }

  /**
   * Inactivate a statusable model instance.
   *
   * @return bool
   */
  public function inactivate(): bool
  {
    /** If the publishing event does not return false, we will proceed with this operation.
     */
    if ($this->fireModelEvent('inactivating') === false) {
      return false;
    }

    $this->{$this->getStatusColumn()} = BasicStatus::Inactive->value;

    $result = $this->save();

    $this->fireModelEvent('inactivated', false);

    return $result;
  }

  /** Initialize the statusable trait for an instance.
   * 
   * @return void
   */
  public function initializeStatusable()
  {
    /** Set status field's cast. */
    if (!isset($this->casts[$this->getStatusColumn()])) {
      $this->casts[$this->getStatusColumn()] = BasicStatus;
    }
  }

  /**
   * Register a "inactivating" model event callback with the dispatcher.
   *
   * @param  \Closure|string  $callback
   * @return void
   */
  public static function inactivating($callback)
  {
    static::registerModelEvent('inactivating', $callback);
  }

  /**
   * Register a "inactivated" model event callback with the dispatcher.
   *
   * @param  \Closure|string  $callback
   * @return void
   */
  public static function inactivated($callback)
  {
    static::registerModelEvent('inactivated', $callback);
  }

  /**
   * Register a "activating" model event callback with the dispatcher.
   *
   * @param  \Closure|string  $callback
   * @return void
   */
  public static function activating($callback)
  {
    static::registerModelEvent('activating', $callback);
  }

  /**
   * Register a "activated" model event callback with the dispatcher.
   *
   * @param  \Closure|string  $callback
   * @return void
   */
  public static function activated($callback)
  {
    static::registerModelEvent('activated', $callback);
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
   * Get the fully qualified "status" column.
   *
   * @return string
   */
  public function getQualifiedStatusColumn()
  {
    return $this->qualifyColumn($this->getStatusColumn());
  }
}
