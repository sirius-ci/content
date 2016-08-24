<?php


class ContentController  extends CI_Controller
{
    public $module = 'content';

    public function view($id)
    {
        $this->load->model('content');
        $this->lang->load('modules/content');

        if (! $content = $this->content->find($id)) {
            show_404();
        }

        $this->site->set('metaTitle', !empty($content->metaTitle) ? $content->metaTitle : $content->title);
        $this->site->set('metaDescription', $content->metaDescription);
        $this->site->set('metaKeywords', $content->metaKeywords);

        $this->site->set('ogType', 'article');
        $this->site->set('ogTitle', $content->title);

        if (! empty($content->summary)) {
            $this->site->set('ogDescription', $content->summary);
        }
        if (! empty($content->image)) {
            $this->site->set('ogImage', uploadPath($content->image, 'content'));
        }

        /**
         * Rezerve için view varsa yada alt kayıt varsa
         * ilgili view kontrolleri.
         */
        $activeView = 'content/view';
        if (! empty($content->childs)) {
            $activeView = 'content/list';
        }

        if (! empty($content->reserved) && file_exists(APPPATH . 'views/content/reserved/' . $content->reserved . '.php')) {
            $activeView = 'content/reserved/' . $content->reserved;
        }

        $this->load->view('master', array(
            'view' => $activeView,
            'content' => $content
        ));


    }



} 