<?php

namespace MongodbUtils;

class UtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMongoCollection()
    {
      $coll = Utils::getMongoCollection("coll","test");
      $entry = $coll->findOne(["field"=>"value"]); // check composer.json script initMongoDb
      $this->assertEquals("value",$entry["field"]);
    }
}
