<?php
/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 6/5/2018
 * Time: 6:02 PM
 */

//declare database constants
/**
 * @TODO: check to if the constants exists first before creating/declaring them
*/
(!defined("DB_SERVER"))?define("DB_SERVER", "localhost") : null;
(!defined("DB_USER")) ? define("DB_USER", "root") : null;
(!defined("DB_PASS")) ? define("DB_PASS", "") : null;
(!defined("DB_NAME")) ? define("DB_NAME", "singaar"): null;