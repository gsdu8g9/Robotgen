<?php
/**
 * FileName.php
 *
 * @author Yu Chao <yuchao86@gmail.com>
 * @package Robotgen/algorithm/genetic/
 * @version v1.0
 * @license  GPL
 *
 * @reference
 *	-Algorithm Reference
 * @see
 *	-web Links
 *	-
 *
 */
/**
 *  Algorithm Description
 *=================================================================
 */
 //namespace Robotgen;

require_once "PHPUnit.php";
require_once "../LearningLibrary.php";


/**
 * Test class for Linear_AnomalyDetection.
 * Generated by PHPUnit on 2011-12-22 at 09:20:30.
 */
class Linear_AnomalyDetectionTest extends PHPUnit_TestCase {

    /**
     * @covers Linear_AnomalyDetection::isAnomaly()
     */
    public function testIsAnomaly() {
        $ad = new Linear_AnomalyDetection();
        $ad->learn(array(array(1, 2), array(2, 1), array(0, 1), array(3, 1), array(-1, 1)));

        $this->assertTrue($ad->isAnomaly(array(100, 40)));
        $this->assertTrue($ad->isAnomaly(array(-3, 2)));

        $this->assertFalse($ad->isAnomaly(array(1, 2)));
        $this->assertFalse($ad->isAnomaly(array(1.1, 2.1)));
        $this->assertFalse($ad->isAnomaly(array(0, 2.1)));
        $this->assertFalse($ad->isAnomaly(array(0, 2)));


        $value = $ad->isAnomaly(array(1, 1), false);
        $this->assertTrue($value > 0 && $value < 0.5);
    }

    public function testIsAnomalyOnline() {

        $ad = new Linear_OnlineAnomalyDetection();
        $ad->learn(array(array(1, 2), array(2, 1), array(0, 1), array(3, 1), array(-1, 1)));
        $this->assertTrue($ad->isAnomaly(array(100, 40)));
        $this->assertTrue($ad->isAnomaly(array(-3, 2)));
        $this->assertFalse($ad->isAnomaly(array(1, 2)));
        $this->assertFalse($ad->isAnomaly(array(1.1, 2.1)));
        $this->assertFalse($ad->isAnomaly(array(0, 2.1)));
        $this->assertFalse($ad->isAnomaly(array(0, 2)));

        $value = $ad->isAnomaly(array(1, 1), false);
        $this->assertTrue($value > 0 && $value < 0.5);

        $this->assertTrue($ad->isAnomaly(array(5, 6)));

        $ad->addObservation(array(5, 5));
        $ad->addObservation(array(6, 6));
        $ad->addObservation(array(5, 6));
        $ad->addObservation(array(6, 5));
        $ad->addObservation(array(4, 5));
        $ad->addObservation(array(4, 4));
        $ad->addObservation(array(8, 4));
        $ad->addObservation(array(8, 8));
        $ad->addObservation(array(4, 8));
        $this->assertFalse($ad->isAnomaly(array(5, 6)));
    }

}

/**
 * 	make the test suite object
 */
$suite = new PHPUnit_TestSuite();
$suite->addTest(new Linear_AnomalyDetectionTest('testIsAnomaly'));

$suite->addTest(new Linear_AnomalyDetectionTest('testIsAnomalyOnline'));

/**
 * 	print the PHPUnit result to HTML
 */
$phpunit = new PHPUnit();
$result = $phpunit->run($suite);
print $result->toHTML();

exit(0);
?>
