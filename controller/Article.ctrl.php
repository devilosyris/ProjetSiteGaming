<?php
class CtrlArticle extends Controller {
    public function index() {
        $this->loadDao('Article');
        $this->info('Actualités','C\'est ici que tu retrouveras toute les nouveautées autour du gmaing, sorties jeux, patch notes, etc...');
        $d['articles'] = $this->DaoArticle->readAll();
        $this->set($d);
        $this->render('Article','index');
    }
}
?>