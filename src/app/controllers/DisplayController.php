<?php

use Phalcon\Mvc\Controller;

session_start();
class DisplayController extends Controller
{
    public function indexAction()
    {
        if (isset($_POST['search'])) {
            $search = $_POST;
            $search['search'] = str_replace(' ', '+', $search['search']);
            $_SESSION['post'] = $_POST;
        } else {
            $search = $_SESSION['post'];
        }
        if (isset($search['album'])) {
            $data = $this->getID->api($search['search'], "album");
            $this->view->album = '<h3>Albums</h3>';
            foreach ($data['albums']['items'] as $value) {
                $this->view->album .= ' <div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                      <div class="card w-100 my-2 shadow-2-strong">
                        <img src=' . $value['images']['0']['url'] .
                    ' class="card-img-top" style="aspect-ratio: 1 / 1" />
                        <div class="card-body d-flex  flex-column">
                          <h5 class="card-title">' . $value['name'] . '</h5>
                          <p class="card-title">Artist: ' . $value['artists'][0]['name'] . '</p>
                          <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto ">
                          <a href="add?id=' . $value['id'] .
                    '&type=albums" class="btn btn-primary shadow-0 me-1">Add </a>
                          </div>
                        </div>
                      </div>
                    </div>';
            }
        }
        if (isset($search['artist'])) {
            $data = $this->getID->api($search['search'], "artist");
            $this->view->artist = '<h3>Artists</h3>';
            foreach ($data['artists']['items'] as $value) {
                $this->view->artist .= '<div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                      <div class="card w-100 my-2 shadow-2-strong" >
                        <img src=' . $value['images']['0']['url'] .
                    ' class="card-img-top"  style="aspect-ratio: 1 / 1" />
                        <div class="card-body d-flex flex-column">
                          <h5 class="card-title">' . $value['name'] . '</h5>
                          <p class="card-title">Popularity: ' . $value['popularity'] . '/100</p>
                          <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                          <a href="add?id=' . $value['id'] .
                    '&type=artists" class="btn btn-primary shadow-0 me-1"> Add</a>
                          </div>
                        </div>
                      </div>
                    </div>';
            }
        }
        if (isset($search['playlist'])) {
            $data = $this->getID->api($search['search'], "playlist");
            $this->view->playlist = '<h3>Playlists</h3>';
            foreach ($data['playlists']['items'] as $value) {
                $this->view->playlist .= '<div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                      <div class="card w-100 my-2 shadow-2-strong">
                        <img src=' . $value['images']['0']['url'] .
                    ' class="card-img-top" style="aspect-ratio: 1 / 1" />
                        <div class="card-body d-flex flex-column">
                          <h5 class="card-title">' . $value['name'] . '</h5>
                          <p class="card-title">Total Track: ' . $value['tracks']['total'] . '</p>
                          <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                          <a href="add?id=' . $value['id'] .
                    '&type=playlists" class="btn btn-primary shadow-0 me-1">Add </a>
                          </div>
                        </div>
                      </div>
                    </div>';
            }
        }
        if (isset($search['track'])) {
            $data = $this->getID->api($search['search'], "track");
            $this->view->track = '<h3>Track</h3>';
            foreach ($data['tracks']['items'] as $value) {
                $this->view->track .= '<div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                      <div class="card w-100 my-2 shadow-2-strong">
                        <img src=' . $value['album']['images']['0']['url'] .
                    ' class="card-img-top" style="aspect-ratio: 1 / 1" />
                        <div class="card-body d-flex flex-column">
                          <h5 class="card-title">' . $value['album']['name'] . '</h5>
                          <p class="card-title">Artist: ' . $value['album']['artists']['0']['name'] . '</p>
                          <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                            <a href="add?id=' . $value['id'] .
                    '&type=tracks" class="btn btn-primary shadow-0 me-1">Add</a>
                          </div>
                        </div>
                      </div>
                    </div>';
            }
        }
        if (isset($search['show'])) {
            $data = $this->getID->api($search['search'], "show");
            echo "<pre>";
            print_r($data);
            die;
        }
        if (isset($search['episode'])) {
            $data = $this->getID->api($search['search'], "episode");
            echo "<pre>";
            print_r($data);
            die;
        }
    }
}
