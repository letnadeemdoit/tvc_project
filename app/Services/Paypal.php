<?php

namespace App\Services;

/*******************************************************************************
 *                      PHP Paypal IPN Integration Class
 *******************************************************************************
 *      Author:     Micah Carrick
 *      Email:      email@micahcarrick.com
 *      Website:    http://www.micahcarrick.com
 *
 *      File:       paypal.class.php
 *      Version:    1.00
 *      Copyright:  (c) 2005 - Micah Carrick
 *                  You are free to use, distribute, and modify this software
 *                  under the terms of the GNU General Public License.  See the
 *                  included license.txt file.
 *
 *******************************************************************************
 *  VERSION HISTORY:
 *
 *      v1.0.0 [04.16.2005] - Initial Version
 *
 *******************************************************************************
 *  DESCRIPTION:
 *
 *      This file provides a neat and simple method to interface with paypal and
 *      The paypal Instant Payment Notification (IPN) interface.  This file is
 *      NOT intended to make the paypal integration "plug 'n' play". It still
 *      requires the developer (that should be you) to understand the paypal
 *      process and know the variables you want/need to pass to paypal to
 *      achieve what you want.
 *
 *      This class handles the submission of an order to paypal aswell as the
 *      processing an Instant Payment Notification.
 *
 *      This code is based on that of the php-toolkit from paypal.  I've taken
 *      the basic principals and put it in to a class so that it is a little
 *      easier--at least for me--to use.  The php-toolkit can be downloaded from
 *      http://sourceforge.net/projects/paypal.
 *
 *      To submit an order to paypal, have your order form POST to a file with:
 *
 *          $p = new paypal_class;
 *          $p->add_field('business', 'somebody@domain.com');
 *          $p->add_field('first_name', $_POST['first_name']);
 *          ... (add all your fields in the same manor)
 *          $p->submit_paypal_post();
 *
 *      To process an IPN, have your IPN processing file contain:
 *
 *          $p = new paypal_class;
 *          if ($p->validate_ipn()) {
 *          ... (IPN is verified.  Details are in the ipn_data() array)
 *          }
 *
 *
 *      In case you are new to paypal, here is some information to help you:
 *
 *      1. Download and read the Merchant User Manual and Integration Guide from
 *         http://www.paypal.com/en_US/pdf/integration_guide.pdf.  This gives
 *         you all the information you need including the fields you can pass to
 *         paypal (using add_field() with this class) aswell as all the fields
 *         that are returned in an IPN post (stored in the ipn_data() array in
 *         this class).  It also diagrams the entire transaction process.
 *
 *      2. Create a "sandbox" account for a buyer and a seller.  This is just
 *         a test account(s) that allow you to test your site from both the
 *         seller and buyer perspective.  The instructions for this is available
 *         at https://developer.paypal.com/ as well as a great forum where you
 *         can ask all your paypal integration questions.  Make sure you follow
 *         all the directions in setting up a sandbox test environment, including
 *         the addition of fake bank accounts and credit cards.
 *
 *******************************************************************************
 */
class Paypal
{
    /**
     * Holds the last error encountered
     * @var
     */
    public $lastError;

    /**
     * bool: log IPN results to text file?
     * @var
     */
    public $ipnLog;
    /**
     * filename of the IPN log
     * @var
     */
    public $ipnLogFile;
    /**
     * holds the IPN response from paypal
     * @var
     */
    public $ipnResponse;
    /**
     * array contains the POST values for IPN
     * @var array
     */
    public $ipnData = [];

    /**
     * array holds the fields to submit to paypal
     * @var array
     */
    public $fields = [];

    /**
     *
     */
    public function __construct()
    {

        $this->paypalUrl = 'https://www.paypal.com/cgi-bin/webscr';

        $this->lastError = '';

        $this->ipnLogFile = 'ipn_log.txt';
        $this->ipnLog = true;
        $this->ipnResponse = '';

        // populate $fields array with a few default values.  See the paypal
        // documentation for a list of fields and their data types. These defaul
        // values can be overwritten by the calling script.

        $this->addField('rm', '2');           // Return method = POST
        $this->addField('cmd', '_xclick');
    }

    /**
     * @param $field
     * @param $value
     * @return void
     */
    public function addField($field, $value)
    {

        // adds a key=>value pair to the fields array, which is what will be
        // sent to paypal as POST variables.  If the value is already in the
        // array, it will be overwritten.

        $this->fields[$field] = $value;
    }

    /**
     * @return string
     */
    public function submitPaypal()
    {
        // this function actually generates an entire HTML page consisting of
        // a form with hidden elements which is submitted to paypal via the
        // BODY element's onLoad attribute.  We do this so that you can validate
        // any POST vars from you custom form before submitting to paypal.  So
        // basically, you'll have your own form which is submitted to your script
        // to validate the data, which in turn calls this function to create
        // another hidden form and submit to paypal.

        // The user will briefly see a message on the screen that reads:
        // "Please wait, your order is being processed..." and then immediately
        // is redirected to paypal.

        $html = "<html>\n";
        $html .= "<head><title>Processing Payment...</title></head>\n";
        echo "<body onLoad=\"document.form.submit();\">\n";
        $html .= "<center><h3>Please wait, your order is being processed...</h3></center>\n";
        $html .= "<form method=\"post\" name=\"form\" action=\"" . $this->paypalUrl . "\">\n";

        foreach ($this->fields as $name => $value) {
            $html .= "<input type=\"hidden\" name=\"$name\" value=\"$value\">";
        }

        $html .= "</form>\n";
        $html .= "</body></html>\n";

        return $html;
    }

    /**
     * @return bool
     */
    public function validateIpn()
    {

        // parse the paypal URL
        $url_parsed = parse_url($this->paypalUrl);

        // generate the post string from the _POST vars aswell as load the
        // _POST vars into an arry so we can play with them from the calling
        // script.
        $post_string = '';
        foreach ($_POST as $field => $value) {
            $this->ipnData["$field"] = $value;
            $post_string .= $field . '=' . urlencode($value) . '&';
        }
        $post_string .= "cmd=_notify-validate"; // append ipn command

        // open the connection to paypal
        $fp = fsockopen($url_parsed['host'], "80", $err_num, $err_str, 30);
        if (!$fp) {

            // could not open the connection.  If loggin is on, the error message
            // will be in the log.
            $this->lastError = "fsockopen error no. $errnum: $errstr";
            $this->logIpnResults(false);
            return false;

        } else {

            // Post the data back to paypal
            fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n");
            fputs($fp, "Host: $url_parsed[host]\r\n");
            fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
            fputs($fp, "Content-length: " . strlen($post_string) . "\r\n");
            fputs($fp, "Connection: close\r\n\r\n");
            fputs($fp, $post_string . "\r\n\r\n");

            // loop through the response from the server and append to variable
            while (!feof($fp)) {
                $this->ipn_response .= fgets($fp, 1024);
            }

            fclose($fp); // close connection

        }

        if (preg_match("VERIFIED", $this->ipnResponse)) {

            // Valid IPN transaction.
            $this->logIpnResults(true);
            return true;

        } else {

            // Invalid IPN transaction.  Check the log for details.
            $this->lastError = 'IPN Validation Failed.';
            $this->logIpnResults(false);
            return false;

        }

    }

    /**
     * @param $success
     * @return void
     */
    public function logIpnResults($success)
    {

        if (!$this->ipnLog) return;  // is logging turned off?

        // Timestamp
        $text = '[' . date('m/d/Y g:i A') . '] - ';

        // Success or failure being logged?
        if ($success) $text .= "SUCCESS!\n";
        else $text .= 'FAIL: ' . $this->lastError . "\n";

        // Log the POST variables
        $text .= "IPN POST Vars from Paypal:\n";
        foreach ($this->ipnData as $key => $value) {
            $text .= "$key=$value, ";
        }

        // Log the response from the paypal server
        $text .= "\nIPN Response from Paypal Server:\n " . $this->ipnResponse;

        // Write to log
        $fp = fopen($this->ipnLogFile, 'a');
        fwrite($fp, $text . "\n\n");

        fclose($fp);  // close file
    }

    /**
     * @return void
     */
    public function dumpFields()
    {

        // Used for debugging, this function will output all the field/value pairs
        // that are currently defined in the instance of the class using the
        // add_field() function.

        echo "<h3>paypal_class->dump_fields() Output:</h3>";
        echo "<table width=\"95%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\">
            <tr>
               <td bgcolor=\"black\"><b><font color=\"white\">Field Name</font></b></td>
               <td bgcolor=\"black\"><b><font color=\"white\">Value</font></b></td>
            </tr>";

        ksort($this->fields);
        foreach ($this->fields as $key => $value) {
            echo "<tr><td>$key</td><td>" . urldecode($value) . "&nbsp;</td></tr>";
        }

        echo "</table><br/>";
    }
}
