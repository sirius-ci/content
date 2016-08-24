<?php


class Content extends  CI_Model
{

    /**
     * Kaydı alt kayıtları ve üst kaydı işe beraber döndürür.
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->db
            ->from('contents')
            ->where('id', $id)
            ->where('language', $this->language)
            ->get()
            ->row();

        if ($result) {
            $result->childs = $this->childs($result);
            $result->parent = $this->parent($result);
        }

        return $result;
    }

    /**
     * Kaydın üst kaydını döndürür.
     *
     * @param $content
     * @return bool
     */
    public function parent($content)
    {
        if ($content->parentId > 0) {
            $result = $this->db
                ->from('contents')
                ->where('id', $content->parentId)
                ->where('language', $this->language)
                ->get()
                ->row();

            if ($result) {
                $result->childs = $this->childs($result);
            }

            return $result;
        }

        return false;
    }

    /**
     * Kaydın alt kayıtlarını döndürür.
     *
     * @param $content
     * @return mixed
     */
    public function childs($content)
    {
        return $this->db
            ->from('contents')
            ->where('parentId', $content->id)
            ->where('language', $this->language)
            ->get()
            ->result();
    }

    /**
     * Rezerve kaydı döndürür.
     *
     * @param $name Rezerve kaydın tekil adı.
     * @param bool|false $childs
     * @return mixed
     */
    public function reserved($name, $childs = false)
    {
        $result = $this->db
            ->from('contents')
            ->where('reserved', $name)
            ->where('language', $this->language)
            ->get()
            ->row();

        if ($childs === true) {
            $result->childs = $this->childs($result);
        }

        return $result;
    }

    /**
     * Rezerve kaydı alt kayıtları ile beraber döndürür.
     *
     * @param $name Rezerve kaydı tekil adı.
     * @return mixed
     */
    public function reservedWithChilds($name)
    {
        return $this->reserved($name, true);
    }

}