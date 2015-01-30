<?php

require_once( '/var/www/itconnect/wp-load.php' ); // this is how you can be in WordPress environment
defined( 'ABSPATH' ) || define( 'ABSPATH', '/var/www/itconnect/' ); // sort of unnecessary
require_once( ABSPATH . 'wp-settings.php' );
require_once('../functions.php');

/*
  This file contains unit tests for MyRequest, using PHPUnit
*/

class MyRequestFunctionsTest extends PHPUnit_Framework_TestCase
{

  /*
   * Unit test for functions.php:in_comment_balcklisted_words()
   * Normal case: the bad user just uses <script>
   */
  public function testInCommentBlackListedWordsNormal() {
    $string = '<script>alert("Hi")</script>';
    $blacklist = array('<script>');

    $result = in_comment_blacklisted_words($string, $blacklist);
    $this->assertTrue($result);

    $string = 'alert("Hi")';
    $result = in_comment_blacklisted_words($string, $blacklist);
    $this->assertFalse($result);
  }

  /*
   * Unit test for functions.php:in_comment_balcklisted_words()
   * Special case: the bad user includes script from other sites using <script src=>
   */
  public function testInCommentBlackListWordsScriptWithSrc() {
    $string = '<script src="a-bad-website-script.com/badscript"></script>';
    $blacklist = array('<script>'); // this is how comment is filtered in functions.php:drop_bad_comments()

    $result = in_comment_blacklisted_words($string, $blacklist);
    $this->assertTrue($result);
  }

}

?>