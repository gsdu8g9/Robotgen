<?php
/**
 * NaiveBayesTeste.php
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

require_once "PHPUnit.php";

require_once dirname(__FILE__) . '/NaiveBayes.php';

/**
 * Test class for NaiveBayes.
 * Generated by PHPUnit on 2013-01-16 at 10:20:30.
 */
class NaiveBayesTest extends PHPUnit_TestCase {

    /**
     * @covers NaiveBayes ConditionalProbability function()
     */
    public function testConditionalProbability() {

        $naiveBayes = new Gree_Service_Classifier_Bayes_Classifier_NaiveBayes();
        // Test the function

        /**
        * The $SamplePairs dataset uses this coding convention:
        *
        * +cancer - patient has cancer
        * -cancer - patient does not have cancer
        * +test   - patient tested positive on cancer test
        * -test   - patient tested negative on cancer test
        */
        $SamplePairs[0] = array("+cancer", "+test");
        $SamplePairs[1] = array("-cancer", "-test");
        $SamplePairs[2] = array("+cancer", "+test");
        $SamplePairs[3] = array("-cancer", "+test");

        // specify query variable $A and conditioning variable $B
        $A = "+cancer";
        $B = "+test";

        // compute the conditional probability of having cancer given 1)
        // a positive test and 2) the test efficacy dataset $SamplePairs
        $probability = $naiveBayes->getConditionalProbabilty($A, $B, $SamplePairs);

        // Answer: 0.66666666666667
        var_dump($probability);
        $this->assertTrue(strncmp($probability , '0.66666666666667', 16));
    }

    public function testIsConditional() {

    }

}

/**
 * 	make the test suite object
 */
$suite = new PHPUnit_TestSuite();
$suite->addTest(new NaiveBayesTest('testConditionalProbability'));

//$suite->addTest(new NaiveBayesTest('testIsConditional'));

/**
 * 	print the PHPUnit result to HTML
 */
$phpunit = new PHPUnit();
$result = $phpunit->run($suite);
print $result->toHTML();

exit(0);
?>

