<?php
// Controller/ApiController.php
class ApiPostController extends AppController {

    public $components = array('RequestHandler');
    public $uses = array('Place' , 'User' ,'Post');

    //ログインしていないユーザーのアクセスを許可するメソッドを指定
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function index() {
        $PostAllData = $this->Post->find('all');
        $this->set(array(
            'PostAllData' => $PostAllData,
            '_serialize' => array('PostAllData'),
        ));
    }

    //     http://localhost:8888/Classics/ApiPlace/index.json
    //     返り値
    //     {
    //     "AllList":
    //         [
    //             {
    //             "Place":
    //                 {"id":"1",
    //                  "name":"aCafe",
    //                  "comment":"Wifi is goooooooooooooooooooooood",
    //                  "users_id":"36",
    //                  "avatar_file_name":"second.gif",
    //                  "genre":"0","wifi_existence":"1",
    //                  "wifi_average_speed":"5.31",
    //                  "payment_average":"148",
    //                  "open_time":"08:00:00",
    //                  "close_time":"22:00:00",
    //                  "latitude":null,
    //                  "longitude":null,
    //                  "created":"0000-00-00 00:00:00",
    //                  "modified":"2015-01-29 17:28:10"
    //                  }
    //             ,
    //             "User":
    //                 {"id":"36",
    //                 "username":"\u9000\u4f1a\u8005",
    //                 "password":"b5630c6071ef2bab6e267d26185cfe15781f2588",
    //                 "avatar_file_name":"second.gif",
    //                 "wifi_average_speed":"74.82",
    //                 "payment_average":"1149",
    //                 "created":"2015-01-19 21:54:13",
    //                 "modified":"2015-01-30 22:00:58"
    //                 }
    //             },
    //             {
    //             "Place":
    //                 {
    //                 "id":"2",
    //                 "name":"Water Front Hotel!!",
    //                 "comment":"Service is good,but price is a bit high",
    //                 "users_id":"30","avatar_file_name":"box.png",
    //                 "genre":"0",
    //                 "wifi_existence":"0",
    //                 "wifi_average_speed":"28.37",
    //                 "payment_average":"172",
    //                 "open_time":"08:00:00","
    //                 close_time":"23:00:00",
    //                 "latitude":null,
    //                 "longitude":null,
    //                 "created":"0000-00-00 00:00:00",
    //                 "modified":"2015-01-19 19:45:25"
    //                 },
    //             "User":
    //                 {
    //                  "id":"30",
    //                  "username":"mory7",
    //                  "password":"a67793a31c6442bffb937c2a4bed0fdc56bcd547",
    //                  "avatar_file_name":"first.gif",
    //                  "wifi_average_speed":"13.18",
    //                  "payment_average":"161",
    //                  "created":"0000-00-00 00:00:00",
    //                  "modified":"2015-01-28 19:35:13"
    //                  }
    //             },
    //             {
    //             "Place":
    //                 {
    //                 "id":"3",
    //                  "name":"coffee beans",
    //                  "comment":"coffee is good,but wifi speed depends on time.",
    //                  "users_id":"30",
    //                  "avatar_file_name":"box.png",
    //                  "genre":"0",
    //                  "wifi_existence":"0",
    //                  "wifi_average_speed":"0",
    //                  "payment_average":"0",
    //                  "open_time":"00:00:00",
    //                  "close_time":"00:00:00",
    //                  "latitude":null,
    //                  "longitude":null,
    //                  "created":"0000-00-00 00:00:00",
    //                  "modified":"2015-01-17 17:49:58"
    //                  },
    //             "User":
    //                 {
    //                 "id":"30",
    //                 "username":"mory7",
    //                 "password":"a67793a31c6442bffb937c2a4bed0fdc56bcd547",
    //                 "avatar_file_name":"first.gif",
    //                 "wifi_average_speed":"13.18",
    //                 "payment_average":"161",
    //                 "created":"0000-00-00 00:00:00",
    //                 "modified":"2015-01-28 19:35:13"
    //                 }
    //             }
    //         ]
    // }

    public function view($id) {
        $PostSingleData = $this->Post->findById($id);
        $this->set(array(
            'PostSingleData' => $PostSingleData,
            '_serialize' => array('PostSingleData')
        ));
    }

    //Classics/apiPlace/view/2.json
    //返り値
    // {"diary":
    //     {
    //     "Place":
    //         {"id":"2",
    //          "name":"Water Front Hotel!!",
    //          "comment":"Service is good,but price is a bit high","users_id":"30","avatar_file_name":"box.png","genre":"0","wifi_existence":"0",
    //          "wifi_average_speed":"28.37","payment_average":"172",
    //          "open_time":"08:00:00","close_time":"23:00:00",
    //          "latitude":null,"longitude":null,
    //          "created":"0000-00-00 00:00:00",
    //          "modified":"2015-01-19 19:45:25"
    //          },
    //     "User":
    //         {
    //         "id":"30",
    //         "username":"mory7",
    //         "password":"a67793a31c6442bffb937c2a4bed0fdc56bcd547",
    //         "avatar_file_name":"first.gif",
    //         "wifi_average_speed":"13.18",
    //         "payment_average":"161",
    //         "created":"0000-00-00 00:00:00",
    //         "modified":"2015-01-28 19:35:13"
    //         }
    //     }
    // }

    public function add() {
        $this->Post->create();
        if ($this->Post->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    //   <form action="http://localhost:8888/Classics/ApiPost/add.json" method="post">

    public function edit($id) {
        $this->Post->id = $id;
        if ($this->Post->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    //  <form action="http://localhost:8888/Classics/ApiPost/edit/1.json" method="post">

    public function delete($id) {
        if ($this->Post->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    //  <form action="http://localhost:8888/Classics/ApiPost/delete/1.json" method="post">
}