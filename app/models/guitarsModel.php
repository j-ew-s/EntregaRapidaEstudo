<?php
class Guitars extends Illuminate\Database\Eloquent\Model
{
  protected $table = 'guitars';

  public function Brand() {
    return $this->hasOne('Brands','id', 'fk_brands');
  }

  public function Serie() {
    return $this->hasOne('Series','id', 'fk_series');
  }
}