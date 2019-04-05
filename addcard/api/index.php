<?php

require '../config/db.config.php';

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();


// GET route is used to get the data in table 
$app->get('/getcard', function () use ($app) {

    // $sqlList = "SELECT * FROM card";
    $sqlList = "Call getallcard(@id,@user_id,@ccvnumber,@cccvs,@ccexpyear)";

    // created php associative array to store results and message

    $response = array("msg" => null, "data" => null);

    // this will return array of rows from table agains the query
    $response["data"] = DB::query($sqlList);

    // checking data is loading then adding message text
    if ($response["data"]) {
        $response["msg"] = "Data loaded";
    } else {
        $response["msg"] = "Data not loaded";
    }

    // we will send JSON response to HTTP
    $app->response()->status(200); // HTTP Status Code Set to 200
    $app->response()->header('Content-Type', 'application/json'); // Response Content Type Set to JSON
    $app->response()->write(json_encode($response)); // Response is encoded in json. The array is converted into JSON and sent out in HTTP response stream
});


// POST Create Card insert data in Card Form
$app->post('/card', function () use ($app) {
    // $postdata = $app->request->post("");
    $ccnumber = $app->request->post("ccnumber");
    $cccvs = $app->request->post("cccvs" );
    $ccexpyear = $app->request->post("ccexpyear");
    $ccexpyear = $app->request->post("ccexpyear");
    $user_id = $app->request->post("user_id");
    // split year and month
    // $year = explode("/",$postdata["year"])[0];
    // $month = explode("/",$postdata["year"])[1];


    $saveToDb = array(
        "ccnumber" => $ccnumber,
        "cccvs" => $cccvs,
        "ccexpyear" => $ccexpyear,
        "ccexpyear" => $ccexpyear,
        "user_id" => $user_id
    );
    // simple insert of form data using meekrodb
    $sql="Call insertcard(@user_id,@ccvnumber,@cccvs,@ccexpyear)";
    DB::insert("card",
    $saveToDb,$sql
    );
    // get new inserted id
    // $newId = DB::insertId();
    // echo $newId;
    die(json_encode($saveToDb));
    
}
);

//inser data in user table 
$app->post('/user', function () use ($app) {
    $name = $app->request->post("name");
    $email = $app->request->post("email" );
    $Mobile_number = $app->request->post("Mobile_number");
    $id = $app->request->post("id");
    // split year and month
    // $year = explode("/",$postdata["year"])[0];
    // $month = explode("/",$postdata["year"])[1];

    $saveToDb = array(
        "name" => $name,
        "email" => $email,
        "Mobile_number" => $Mobile_number,
        "id" => $id
    );

    // simple insert of form data using meekrodb
    DB::insert("user",
        $saveToDb,
    );
    // get new inserted id
    // $newId = DB::insertId();
    // echo $newId;
    die(json_encode($saveToDb));
    
}
);


// PUT route is used to edit the data 
$app->put('/put', function () use ($app) {

    // $potData = $app->request->post();
    $number = $app->request->put('ccnumber');
    $cvs = $app->request->put('cccvs');
    $month = $app->request->put('ccexpmonth');
    $year = $app->request->put('ccexpyear');
    $userid = $app->request->put('user_id');
    $id = $app->request->put('id');

    $save = array(
        "ccnumber" => $number,
        "cccvs" => $cvs,
        "ccexpmonth" => $year,
        "ccexpyear" => $month,
        "user_id" => $userid,
        "id" => $id
    );
    try {
        $sql = "CALL updatecard($id)";
        DB::update('card', $save, "id=%i", $id,$sql);
        die(json_encode($save));
        $sql = "CALL updatecard($id)";
    } catch (MeekroDBException $e) {
        die('Error' . $e->getMessage());

    }

}

);

// PATCH route
$app->patch('/patch', function () {
    echo 'This is a PATCH route';
});

// DELETE route is used to delete the record 
$app->post('/delete', function () use ($app) {

    $id = $app->request->post('id');
    // DB::delete('card', "id=%i", $id);

    $sql="CALL deletecard($id)";
    DB::query($sql);
    // echo 'This is a DELETE route';
    die(json_encode(['status' => true]));

}
);

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
