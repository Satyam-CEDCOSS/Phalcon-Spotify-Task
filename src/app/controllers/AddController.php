<?php

use Phalcon\Mvc\Controller;

session_start();
class AddController extends Controller
{
    public function indexAction()
    {
        $value = $_GET;
        $data = $this->getData->api($value['type'], $value['id']);
        if ($value['type'] == 'albums') {
            $arr = [
                'name' => $data['name'],
                'artist' => $data['artists']['0']['name'],
                'image' => $data['images']['0']['url'],
                'type' => $value['type'],
            ];
        }
        if ($value['type'] == 'artists') {
            $arr = [
                'name' => $data['type'],
                'artist' => $data['name'],
                'image' => $data['images']['0']['url'],
                'type' => $value['type'],
            ];
        }
        if ($value['type'] == 'playlists') {
            $arr = [
                'name' => $data['name'],
                'artist' => $data['owner']['display_name'],
                'image' => $data['images']['0']['url'],
                'type' => $value['type'],
            ];
        }
        if ($value['type'] == 'tracks') {
            $arr = [
                'name' => $data['album']['name'],
                'artist' => $data['artists']['0']['name'],
                'image' => $data['album']['images']['0']['url'],
                'type' => $value['type'],
            ];
        }

        $product = new \Datas();
        $product->assign(
            $arr,
            [
                'name',
                'artist',
                'image',
                'type',
            ]
        );
        $done = $product->save();
        if ($done) {
            $this->response->redirect('display');
        }
    }
}
