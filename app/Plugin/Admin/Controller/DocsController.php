<?php

App::uses('AdminAppController', 'Admin.Controller');

class DocsController extends AdminAppController {

    public $components = array('RequestHandler', 'S3');
    public $uses = array('Admin.Doctable');

    public function tables($document_id) {
        $this->layout = false;

        $data = $this->Doctable->getTables($document_id);
        $tables = array();
        foreach($data as $row) {
            $table = new stdClass();
            $table->id = (int) $row['doctables']['id'];
            $table->name = $row['doctables']['name'];
            $table->pageIndex = (int) $row['doctables']['page_index'];
            $table->x = (int) $row['doctables']['x'];
            $table->y = (int) $row['doctables']['y'];
            $table->width = (int) $row['doctables']['width'];
            $table->height = (int) $row['doctables']['height'];

            $table->rows = array_map(function($e) {
                return (int) $e;
            }, explode(';', $row[0]['r']));

            $table->cols = array_map(function($e) {
                return (int) $e;
            }, explode(';', $row[0]['c']));

            $tables[] = $table;
        }

        $this->set('tables', $tables);
        $this->set('tablesData', $this->Doctable->getTablesData($document_id));
        $this->set('document_id', $document_id);
        $this->set('docJSON', $this->getDocJSON($document_id));
    }

    public function saveTables($document_id) {
        $this->setSerialized('response',
            $this->Doctable->saveTables(
                $document_id,
                $this->request->data['tables']
            )
        );
    }

    public function saveTablesData($document_id) {
        $this->setSerialized('response',
            $this->Doctable->saveTablesData(
                $document_id,
                $this->request->data
            )
        );
    }

    public function tableData($doctable_data_id) {
        $this->layout = false;
        $tableData = $this->Doctable->getTableData($doctable_data_id);
        $this->set('tableData', $tableData);
    }

    private function getDocJSON($document_id) {
        $xml = @$this->S3->getObject(
            'docs.sejmometr.pl', 'xml/' . $document_id . '.xml');

        $doc = new stdClass;
        $doc->pages = array();

        $s = simplexml_load_string($xml->body);
        foreach($s->page as $page) {
            $p = new stdClass();
            $p->width = (string) $page->attributes()->width;
            $p->height = (string) $page->attributes()->height;
            $p->texts = array();
            foreach($page->text as $text) {
                $content = (string) $text;
                foreach($text->children() as $child)
                    $content .= ' ' . (string) $child;
                $p->texts[] = array(
                    'top' => (string) $text->attributes()->top,
                    'left' => (string) $text->attributes()->left,
                    'width' => (string) $text->attributes()->width,
                    'height' => (string) $text->attributes()->height,
                    'content' => trim($content)
                );
            }
            $doc->pages[] = $p;
        }

        return json_encode($doc);
    }

}