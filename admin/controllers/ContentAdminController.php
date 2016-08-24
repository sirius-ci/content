<?php

use Sirius\Admin\Manager;

class ContentAdminController extends Manager
{
    public $moduleTitle = 'İçerikler';
    public $module = 'content';
    public $table = 'contents';
    public $model = 'content';
    public $type = 'public';
    public $menuPattern = array(
        'title' => 'title',
        'hint' => 'title',
        'link' => array('slug', 'id'),
        'language' => true
    );

    // Arama yapılacak kolonlar.
    public $search = array('title');


    // Filtreleme yapılacak querystring/kolonlar.
    // public $filter = array('type');

    public $actions = array(
        'records' => 'list',
        'childs' => 'list',
        'order' => 'list',
        'insert' => 'insert',
        'update' => 'update',
        'delete' => 'delete',
    );


    protected function insertRequest()
    {
        if ($this->uri->segment(3) > 0) {
            $this->viewData['parentId'] = $this->uri->segment(3);

            // Navigasyon eklemeleri yapılır
            $parents = $this->appmodel->parents($this->viewData['parentId']);

            foreach ($parents as $bread){
                $this->breadcrumb($bread['title'], $bread['url']);
            }
        }



        $this->load->vars('public', array('js' => array(
            '../public/admin/plugin/ckeditor/ckeditor.js',
            '../public/admin/plugin/ckfinder/ckfinder.js'
        )));
    }

    protected function insertValidateRules()
    {
        $this->form_validation->set_rules('title', 'Lütfen Başlık yazınız.', 'required');

        if ($this->input->post('autoSlug') !== 'true') {
            $this->form_validation->set_rules('slug', 'Lütfen slug yazınız.', 'required');
        }
    }

    protected function insertAfterValidate()
    {
        $this->utils
            ->uploadInput('imageFile')
            ->minSizes(480, 360)
            ->addProcessSize('normal', 480, 360, 'content', 'thumbnail');


        if ($this->input->post('imageUrl')) {
            $this->modelData['image'] = $this->utils->imageDownload(false, $this->input->post('imageUrl'));
        } else {
            $this->modelData['image'] = $this->utils->imageUpload(false);
        }
    }


    protected function updateRequest($record)
    {
        // Navigasyon eklemeleri yapılır
        $parents = $this->appmodel->parents($record->parentId);

        foreach ($parents as $bread){
            $this->breadcrumb($bread['title'], $bread['url']);
        }

        $this->load->vars('public', array('js' => array(
            '../public/admin/plugin/ckeditor/ckeditor.js',
            '../public/admin/plugin/ckfinder/ckfinder.js'
        )));
    }

    protected function updateValidateRules()
    {
        $this->form_validation->set_rules('title', 'Lütfen Başlık yazınız.', 'required');

        if ($this->input->post('autoSlug') !== 'true') {
            $this->form_validation->set_rules('slug', 'Lütfen slug yazınız.', 'required');
        }
    }

    protected function updateAfterValidate($record)
    {
        $this->utils
            ->uploadInput('imageFile')
            ->minSizes(480, 360)
            ->addProcessSize('normal', 480, 360, 'content', 'thumbnail');


        if ($this->input->post('imageUrl')) {
            $this->modelData['image'] = $this->utils->imageDownload(false, $this->input->post('imageUrl'), $record->image);
        } else {
            $this->modelData['image'] = $this->utils->imageUpload(false, $record->image);
        }
    }


    public function childs()
    {
        if (! $parent = $this->appmodel->id($this->uri->segment(3))) {
            show_404();
        }

        $records = array();
        $pagination = null;
        $recordCount = $this->appmodel->childCount($parent);

        if ($recordCount > 0) {
            $config = array(
                'base_url' => clink(array($this->module, 'childs', $parent->id)),
                'total_rows' => $recordCount,
                'per_page' => 19
            );

            $this->load->library('pagination');
            $this->pagination->initialize($config);


            $records = $this->appmodel->childAll($parent, $this->pagination->per_page +1, $this->pagination->offset);
            $pagination = $this->pagination->create_links();
        }


        // Navigasyon eklemeleri yapılır
        $parents = $this->appmodel->parents($parent->id);

        foreach ($parents as $bread){
            $this->breadcrumb($bread['title'], $bread['url']);
        }
        $this->breadcrumb('Kayıtlar');

        $this->viewData['parent'] = $parent;
        $this->viewData['records'] = $records;
        $this->viewData['pagination'] = $pagination;

        $this->render('records');
    }


} 