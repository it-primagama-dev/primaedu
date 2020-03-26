<?php

class SyscmsController extends ControllerBase
{

    public function initialize() {
        $this->tag->setTitle('Admin Beranda');
        parent::initialize();
    }

    public function indexAction()
    {
        if ($this->request->isAjax() && $this->request->isPut()) {
            $this->view->disable();
            $jsonObj = $this->request->getJsonRawBody();
            foreach ($jsonObj->content as $index => $content) {
                $this->updateSyscms($index, $content->value);
                //$content->value = addslashes($content->value);
            }
            $this->response->setContentType('application/json');
            echo json_encode($jsonObj->content);
        }

        $syscms = Syscmshome::findFirst();
        $this->view->headercontent = $syscms->HeaderContent;
        $this->view->paneltitle    = $syscms->PanelTitle;
        $this->view->panelcontent  = $syscms->PanelContent;
        $this->view->panel         = strlen($syscms->PanelContent) > 0 ? TRUE : FALSE;
        
        //$this->view->pick('index/index');
    }

    private function updateSyscms($index, $value) {
        $syscms = Syscmshome::findFirst(1);
        if ($syscms === FALSE) {
            return FALSE;
        }
        if ($index === 'header-content') {
            $syscms->HeaderContent = $value;
        } else if ($index === 'panel-title') {
            $syscms->PanelTitle = $value;
        } else if ($index === 'panel-content') {
            $syscms->PanelContent = $value;
        }
        $syscms->save();
        return TRUE;
    }
}

