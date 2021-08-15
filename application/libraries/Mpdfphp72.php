<?php

include_once APPPATH . 'third_party/mpdf2/vendor/autoload.php';

class Mpdfphp72 {

    //font $mode th:garuda, thai:thsaraban, thaia:angsa, thaik:kanit
    public function load_pdf_sticker($width, $height) {
        return new mPDF($mode = 'th', $format = array($width, $height));
    }

    public function load_pdfA4() {
        return new mPDF($mode = 'thai', $format = 'A4');
    }

    public function load_pdfA5() {
        return new mPDF($mode = 'thai', $format = 'A5-L');
    }

    public function load_pdfcustom($width, $height) {
        return new mPDF($mode = 'thai', $format = array($width, $height));
    }

}
