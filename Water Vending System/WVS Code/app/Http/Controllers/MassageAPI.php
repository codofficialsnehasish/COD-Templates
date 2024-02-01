<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Bill;

class MassageAPI extends Controller
{
    public function bill_send(Request $r){
        $id = $r->customer;
        $obj = Customer::find($id);
        $cphone = "254".$obj->cphone;
        // echo $cphone;
        // echo $r->massage;
        $partnerID = "37";
        $apikey = "0ddc86f287ed8ab3fb890649b43a46a8";
        $shortcode = "QUEEN-PEACE";

        $mobile = $cphone; // Bulk messages can be comma separated
        // $mobile = "254703118287"; // Bulk messages can be comma separated
        $message = $r->massage;

        $finalURL = "https://isms.celcomafrica.com/api/services/sendsms/?apikey=" . urlencode($apikey) . "&partnerID=" . urlencode($partnerID) . "&message=" . urlencode($message) . "&shortcode=$shortcode&mobile=$mobile";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $finalURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        // echo $response;
        $res = json_decode($response);
        // print_r($res);
        if(($res->responses[0]->{'response-description'}) == "Success"){
            $obj->bill_send_status = $res->responses[0]->{'response-description'};
            $obj->bill_send_date = date('d-m-y');
            $obj->messageid = $res->responses[0]->messageid;
            $obj->update();
            $msg = "The Bill has been send to the customer's mobile number : ".$obj->cphone;
            return redirect(url('/send_bill'))->with(["mssg"=>$msg]);
        }else{
            $msg = "The Bill has not send to the customer's mobile number : ".$obj->cphone;
            return redirect(url('/send_bill'))->with(["mssgg"=>$msg]);
        }
        // print_r( $res->responses[0]->{'response-description'});
    }


    public function resend_masage(Request $r){
        $id = $r->id;
        $a = Bill::find($id);
        // $custo = Customer::find($a->customer_id);

        $currentMonth = date('F');
        $lmonth = Date('F', strtotime($currentMonth . " last month"));
        // $obj = Bill::find($id);
        $b = Customer::find($a->customer_id);
        $cphone = "254".$b->cphone;
        // $a = Bill::where("customer_id","=",$id)->get();
        $msg = "Dear customer, ".$b->cname." your ".$lmonth." bill is Kshs ".$a->month_bill.". Current read ".$a->current_unit.", Previous read ".$a->previous_unit.", Used units ".$a->current_unit - $a->previous_unit.", Paybill ".$a->balance;


        $partnerID = "37";
        $apikey = "0ddc86f287ed8ab3fb890649b43a46a8";
        $shortcode = "QUEEN-PEACE";

        $mobile = $cphone; // Bulk messages can be comma separated
        // $mobile = "254703118287"; // Bulk messages can be comma separated
        $message = $msg;

        $finalURL = "https://isms.celcomafrica.com/api/services/sendsms/?apikey=" . urlencode($apikey) . "&partnerID=" . urlencode($partnerID) . "&message=" . urlencode($message) . "&shortcode=$shortcode&mobile=$mobile";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $finalURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        // echo $response;
        $res = json_decode($response);
        // print_r($res);
        if(($res->responses[0]->{'response-description'}) == "Success"){
            $b->bill_send_status = $res->responses[0]->{'response-description'};
            $b->bill_send_date = date('d-m-y');
            $b->messageid = $res->responses[0]->messageid;
            $b->update();
            $msg = "The Bill has been resend to the customer's mobile number : ".$b->cphone;
            return redirect(url('/show_bill'))->with(["mssg"=>$msg]);
        }else{
            $msg = "The Bill has not resend to the customer's mobile number : ".$b->cphone;
            return redirect(url('/show_bill'))->with(["mssgg"=>$msg]);
        }
    }
}
