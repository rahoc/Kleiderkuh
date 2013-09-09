<?php

/**
* DO NOT DELETE
* Created by JetBrains PhpStorm.
* User: Sebastian Viereck
* www.sebastianviereck.de
* Date: 10.06.13
* Time: 10:56
* To change this template use File | Settings | File Templates.
*/

require_once("Transaction.php");


class DhlRetoure
{
private $username = "webkleiderkuh";
private $password = "22Qmuh22!";
private $portalId = "kleiderkuh";
private $deliveryName = "RetourenWeb02";
private $end_point = "https://amsel.dpwn.net/abholportal/gw/lp/SoapConnector";

public function getRetourePdf($surname, $familyname, $street, $streetNumber, $zip, $city, $id)
{
$xmlRequest = $this->getRequestXml($surname, $familyname, $street, $streetNumber, $zip, $city, $id);
$response = $this->curlSoapRequest($xmlRequest);
if($response){
$pdf = $this->getPdfFromResponse($response);
}
return $pdf;
}
public function displayPdf($pdf){
header("Content-type: application/pdf");
echo $pdf;
}
public function displayBas64($pdf){
//header("Content-type: application/pdf");
echo "data:application/pdf;base64," . base64_encode($pdf);
}


public function getBase64Pdf($pdf){
	$xmlRequest = $this->getRequestXml($surname, $familyname, $street, $streetNumber, $zip, $city, $id);
	$response = $this->curlSoapRequest($xmlRequest);
	if($response){
	$pdf = $this->getBas64FromResponse($response);
	}
	return $pdf;
}

private function getRequestXml($surname, $familyname, $street, $streetNumber, $zip, $city, $id)
{
if ($id == "") {
	$id = "123456";

}

	
$request =
"<?xml version='1.0' encoding='UTF-8' ?>
<soapenv:Envelope xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/' xmlns:var='https://amsel.dpwn.net/abholportal/gw/lp/schema/1.0/var3bl'>
<soapenv:Header>
<wsse:Security soapenv:mustUnderstand='1' xmlns:wsse='http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'>
<wsse:UsernameToken>
<wsse:Username>".$this->username."</wsse:Username>
<wsse:Password Type='http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText'>
".$this->password."
</wsse:Password>
</wsse:UsernameToken>
</wsse:Security>
</soapenv:Header>
<soapenv:Body>
<var:BookLabelRequest
portalId='".$this->portalId."'
deliveryName='".$this->deliveryName."'
shipmentReference='$id'
customerReference='$id'
labelFormat='PDF'
senderName1='$surname $familyname'
senderName2=''
senderCareOfName='CareofName'
senderContactPhone=''
senderStreet='$street'
senderStreetNumber='$streetNumber'
senderBoxNumber=''
senderPostalCode='$zip'
senderCity='$city' />
</soapenv:Body>
</soapenv:Envelope>";
return $request;
}

/**
* @param $soap_request
* @return mixed
*/
private function curlSoapRequest($xmlRequest)
{
$header = array(
"Content-type: text/xml;charset=\"utf-8\"",
"Accept: text/xml",
"Cache-Control: no-cache",
"Pragma: no-cache",
"Content-length: " . strlen($xmlRequest),
);

$soap_do = curl_init();
curl_setopt($soap_do, CURLOPT_URL, $this->end_point);
curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($soap_do, CURLOPT_POST, true);
curl_setopt($soap_do, CURLOPT_POSTFIELDS, $xmlRequest);
curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
$response = curl_exec($soap_do);

if (!$response) {
$err = 'Curl error: ' . curl_error($soap_do);
}
else {
 //var_dump(htmlentities($response));
}
curl_close($soap_do);
return $response;
}

/**
* @param $response
* @return string
*/
private function getPdfFromResponse($response)
{
$xml = simplexml_load_string($response);
$ns = $xml->getNamespaces(true);
$soap = $xml->children($ns['env']);
$pdf = $soap->Body->children($ns['var3bl'])->BookLabelResponse->label;
$pdf = base64_decode($pdf);
return $pdf;
}
private function getBas64FromResponse($response)
{
$xml = simplexml_load_string($response);
$ns = $xml->getNamespaces(true);
$soap = $xml->children($ns['env']);
$pdf = $soap->Body->children($ns['var3bl'])->BookLabelResponse->label;
//$pdf = base64_decode($pdf);
return $pdf;
}
}