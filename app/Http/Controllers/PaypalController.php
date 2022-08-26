<?php

namespace App\Http\Controllers;

use App\Services\Paypal;
use Illuminate\Http\Request;

class PaypalController extends Controller
{
    public $paypal;

    public function __construct()
    {
        $this->paypal = new Paypal();

        if (config('services.paypal.sandbox')) {
            $this->paypal->paypalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
        } else {
            $this->paypal->paypalUrl = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
        }
    }

    /**
     * There should be no output at this point.  To process the POST data,
     * the submit_paypal_post() function will output all the HTML tags which
     * contains a FORM which is submited instantaneously using the BODY onload
     * attribute.  In other words, don't echo or printf anything when you're
     * going to be calling the submit_paypal_post() function.
     *
     * This is where you would have your form validation  and all that jazz.
     * You would take your POST vars and load them into the class like below,
     * only using the POST values instead of constant string expressions.
     *
     * For example, after ensureing all the POST variables from your custom
     * order form are valid, you might have:
     *
     * $p->addField('first_name', $_POST['first_name']);
     * $p->addField('last_name', $_POST['last_name']);
     *
     * @return string
     */
    public function process()
    {
        $this->paypal->addField('cmd', '_xclick-subscriptions');
//      $this->paypal->addField('business', 'admin_1223600237_biz@thevacationcalendar.com');
        $this->paypal->addField('business', 'payment@thevacationcalendar.com');
        $this->paypal->addField('return', route('dash.paypal.succeeded'));
        $this->paypal->addField('cancel_return', route('dash.paypal.canceled'));
        $this->paypal->addField('notify_url', route('dash.paypal.ipn'));
        $this->paypal->addField('item_name', 'The Vacation Calendar Annual Subscription');
        $this->paypal->addField('lc', 'US');
        $this->paypal->addField('a1', '0');
        $this->paypal->addField('p1', '1');
        $this->paypal->addField('t1', 'M');
        $this->paypal->addField('a3', '20.00');
        $this->paypal->addField('currency_code', 'USD');
        $this->paypal->addField('src', '1');
        $this->paypal->addField('p3', '1');
        $this->paypal->addField('t3', 'Y');
        $this->paypal->addField('sra', '1');
        $this->paypal->addField('custom', auth()->user()->HouseId);
//      $this->paypal->addField('usr_manage', '1');


        //   $this->paypal->addField('no_shipping', '1');

        return $this->paypal->submitPaypal(); // submit the fields to paypal
        //$p->dump_fields();      // for debugging, output a table of all the fields
//        return '';
    }

    /**
     * @return string
     */
    public function succeeded()
    {
        return '';
    }

    public function canceled()
    {
        return redirect()->route('dash.plans-and-pricing')->with('status', 'You have been cancelled order.');
    }

    /**
     * @return string
     */
    public function ipn()
    {
        return '';
    }
}
