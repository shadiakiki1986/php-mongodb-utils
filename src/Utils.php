<?php

namespace MongodbUtils;

class Utils {

  public static function getMongoCollection($collectionName,$dbname="mfaug") {

    // check that DB and collectionName are available
    $MONGO_ADDR="mongodb://localhost:27017";
    if(array_key_exists("MONGO_ADDR",$_ENV)) $MONGO_ADDR=$_ENV["MONGO_ADDR"];
    if(!!getenv("MONGO_ADDR")) $MONGO_ADDR=getenv("MONGO_ADDR");

    // get augmenting data
    $mcl = new \MongoDB\Client($MONGO_ADDR); // connect

    $mdb=$mcl->listDatabases();
    $mdb=iterator_to_array($mdb);
    $mdb=array_map(function($x) { return $x->getName(); }, $mdb);
    if(!in_array($dbname,$mdb)) throw new \Exception("Database ".$dbname." not created. Aborting.");

    // check that the AugmentedSecurities collectionName exists, otherwise add it
    // actually, no need for this because the Mongo client class automatically does it
    // if(!in_array($collectionName,$db->listCollections())) $db->createCollection($collectionName); //throw new \Exception("Collection ".$collectionName." not created yet.");

    // get augmenting data
    $mdb = $mcl->selectDatabase($dbname);
    $coll = $mdb->selectCollection($collectionName);

    return $coll;
  }

  // for MockCollection
  public static function bson2array($o) {
    if($o instanceof \Mongodb\Model\BSONDocument) {
      return (array) $o->bsonSerialize();
    }
    return $o;
  }

}; // end class
