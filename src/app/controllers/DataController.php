<?php

use Phalcon\Mvc\Controller;

session_start();
class DataController extends Controller
{
    public function indexAction()
    {
        $sql = 'SELECT * FROM Datas';
        $query = $this->modelsManager->createQuery($sql);
        $product = $query->execute();
        // echo "<pre>";
        // print_r($value);die;
        foreach ($product as $value) {
            $this->view->data .= '<div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                  <div class="card w-100 my-2 shadow-2-strong" >
                    <img src=' . $value->image .
                ' class="card-img-top"  style="aspect-ratio: 1 / 1" />
                    <div class="card-body d-flex flex-column">
                      <h5 class="card-title">' . $value->name . '</h5>
                      <p class="card-title">Artist: ' . $value->artist . '</p>
                      <p class="card-title">Type: ' . $value->type . '</p>
                      <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                      <a href="data/remove?id=' . $value->id .
                '&type=artists" class="btn btn-primary shadow-0 me-1"> Remove</a>
                      </div>
                    </div>
                  </div>
                </div>';
        }
    }
    public function removeAction()
    {
        $product = new \Datas();
        $product->id = $_GET["id"];
        $done = $product->delete();
        if ($done) {
            $this->response->redirect('data');
        }
    }
}