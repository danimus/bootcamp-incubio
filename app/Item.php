<? php namespace App;

use Jenssegers\Mongodb\Model as Eloquent;
use bootcamp;

class Item extends Eloquent {

    protected $collection = 'item_collection';
    protected $connected = 'mongodb';

}