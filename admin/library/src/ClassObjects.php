<?php

 

namespace Com\Tecnick\Pdf;

use \Com\Tecnick\Pdf\Exception as PdfException;
use \Com\Tecnick\Color\Pdf as ObjColor;
use \Com\Tecnick\Barcode\Barcode as ObjBarcode;
use \Com\Tecnick\File\File as ObjFile;
use \Com\Tecnick\Unicode\Convert as ObjUniConvert;
use \Com\Tecnick\Pdf\Encrypt\Encrypt as ObjEncrypt;
use \Com\Tecnick\Pdf\Page\Page as ObjPage;
use \Com\Tecnick\Pdf\Graph\Draw as ObjGraph;
use \Com\Tecnick\Pdf\Font\Stack as ObjFont;
use \Com\Tecnick\Pdf\Image\Import as ObjImage;


abstract class ClassObjects extends \Com\Tecnick\Pdf\MetaInfo
{
    /**
     * Encrypt object
     *
     * @var \Com\Tecnick\Pdf\Encrypt\Encrypt
     */
    public $encrypt;

    /**
     * Color object
     *
     * @var \Com\Tecnick\Color\Pdf
     */
    public $color;

    /**
     * Barcode object
     *
     * @var \Com\Tecnick\Barcode\Barcode
     */
    public $barcode;

    /**
     * File object
     *
     * @var \Com\Tecnick\File\File
     */
    public $file;

    /**
     * Unicode Convert object
     *
     * @var \Com\Tecnick\Unicode\Convert
     */
    public $uniconv;

    /**
     * Page object
     *
     * @var \Com\Tecnick\Pdf\Page\Page
     */
    public $page;

    /**
     * Graph object
     *
     * @var \Com\Tecnick\Pdf\Graph\Draw
     */
    public $graph;

    /**
     * Font object
     *
     * @var \Com\Tecnick\Pdf\Font\Stack
     */
    public $font;

    /**
     * Image Import object
     *
     * @var \Com\Tecnick\Pdf\Image\Import
     */
    public $image;

    /**
     * Initialize class objects
     */
    protected function initClassObjects()
    {
        $this->color = new ObjColor;
        $this->barcode = new ObjBarcode;
        $this->file = new ObjFile;
        $this->uniconv = new ObjUniConvert;
        
        if ($this->encrypt === null) {
            $this->encrypt = new ObjEncrypt();
        }
        
        $this->page = new ObjPage(
            $this->unit,
            $this->color,
            $this->encrypt,
            $this->pdfa,
            $this->sigapp
        );
        $this->kunit = $this->page->getKUnit();

        $this->graph = new ObjGraph(
            $this->kunit,
            0, // $this->graph->setPageWidth($pagew)
            0, // $this->graph->setPageHeight($pageh)
            $this->color,
            $this->encrypt,
            $this->pdfa
        );

        $this->font = new ObjFont(
            $this->kunit,
            $this->subsetfont,
            $this->isunicode,
            $this->pdfa
        );
        
        $this->image = new ObjImage(
            $this->kunit,
            $this->encrypt,
            $this->pdfa
        );
    }

    /**
     * Enable or disable the the Signature Approval
     *
     * @param boolean $enabled It true enable the Signature Approval
     */
    protected function enableSignatureApproval($enabled = true)
    {
        $this->sigapp = (bool) $enabled;
        $this->page->enableSignatureApproval($this->sigapp);
        return $this;
    }
}
