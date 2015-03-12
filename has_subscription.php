<?php
require_once 'include/common.php';

if (OAuthRequestVerifier::requestIsSigned()) {
    try {
        $req = new OAuthRequestVerifier();
        $id = $req->verify();
        // mit user id losrennen
        // gp holen
        // fuer gp abos auslesen
        // liste von abos zurueckheben oder pruefen, ob ein mitgeschicktes abo vorhanden ist
        if ($id) {
            echo 'Hello ' . $id;
            //ausgabe: darf
        } else {
        	//ausgabe: darf nicht
        }
    }  catch (OAuthException $e)  {
        // The request was signed, but failed verification
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: OAuth realm=""');
        header('Content-Type: text/plain; charset=utf8');
        echo $e->getMessage();
        exit();
    }
}