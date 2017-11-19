<?php

require './staticDatabase.php';

class main {

    function get_accounts_data() {
        $html = '<center><table border="1">';


        $records = accounts::findAll();

        $html .= '<tr>';
        $html .= '<td>' . 'id' . '</td>';
        $html .= '<td>' . 'email' . '</td>';
        $html .= '<td>' . 'fname' . '</td>';
        $html .= '<td>' . 'lname' . '</td>';
        $html .= '<td>' . 'phone' . '</td>';
        $html .= '<td>' . 'birthday' . '</td>';
        $html .= '<td>' . 'gender' . '</td>';
        $html .= '<td>' . 'password' . '</td>';
        $html .= '</tr>';

        for ($i = 0; $i < sizeof($records); $i++) {
            $html .= '<tr>';
            $html .= '<td>' . $records[$i]->id . '</td>';
            $html .= '<td>' . $records[$i]->email . '</td>';
            $html .= '<td>' . $records[$i]->fname . '</td>';
            $html .= '<td>' . $records[$i]->lname . '</td>';
            $html .= '<td>' . $records[$i]->phone . '</td>';
            $html .= '<td>' . $records[$i]->birthday . '</td>';
            $html .= '<td>' . $records[$i]->gender . '</td>';
            $html .= '<td>' . $records[$i]->password . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table></center><br><br>';
        print_r($html);
    }

    function get_todos_data() {

        $html = '<center><table border="1">';

        $records = todos::findAll();

        $html .= '<tr>';
        $html .= '<td>' . 'id' . '</td>';
        $html .= '<td>' . 'owneremail' . '</td>';
        $html .= '<td>' . 'ownerid' . '</td>';
        $html .= '<td>' . 'createddate' . '</td>';
        $html .= '<td>' . 'duedate' . '</td>';
        $html .= '<td>' . 'message' . '</td>';
        $html .= '<td>' . 'isdone' . '</td>';
        $html .= '</tr>';

        for ($i = 0; $i < sizeof($records); $i++) {
            $html .= '<tr>';
            $html .= '<td>' . $records[$i]->id . '</td>';
            $html .= '<td>' . $records[$i]->owneremail . '</td>';
            $html .= '<td>' . $records[$i]->ownerid . '</td>';
            $html .= '<td>' . $records[$i]->createddate . '</td>';
            $html .= '<td>' . $records[$i]->duedate . '</td>';
            $html .= '<td>' . $records[$i]->message . '</td>';
            $html .= '<td>' . $records[$i]->isdone . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table></center>';
        print_r($html);
    }

    function get_single_account($id) {
        $html = '<h2 style="text-align:center">Record with ' . $id . ' from Accounts</h2>';
        $html .= '<center><table border="1">';

        $records = accounts::findOne($id);

        $html .= '<tr>';
        $html .= '<td>' . 'id' . '</td>';
        $html .= '<td>' . 'email' . '</td>';
        $html .= '<td>' . 'fname' . '</td>';
        $html .= '<td>' . 'lname' . '</td>';
        $html .= '<td>' . 'phone' . '</td>';
        $html .= '<td>' . 'birthday' . '</td>';
        $html .= '<td>' . 'gender' . '</td>';
        $html .= '<td>' . 'password' . '</td>';
        $html .= '</tr>';


        $html .= '<tr>';
        $html .= '<td>' . $records->id . '</td>';
        $html .= '<td>' . $records->email . '</td>';
        $html .= '<td>' . $records->fname . '</td>';
        $html .= '<td>' . $records->lname . '</td>';
        $html .= '<td>' . $records->phone . '</td>';
        $html .= '<td>' . $records->birthday . '</td>';
        $html .= '<td>' . $records->gender . '</td>';
        $html .= '<td>' . $records->password . '</td>';
        $html .= '</tr>';
        $html .= '</table></center>';
        print_r($html);
    }

    function get_single_todo($id) {

        $html = '<h2 style="text-align:center">Record with ' . $id . ' from Todos</h2>';
        $html .= '<center><table border="1">';
        $records = todos::findOne($id);

        $html .= '<tr>';
        $html .= '<td>' . 'id' . '</td>';
        $html .= '<td>' . 'owneremail' . '</td>';
        $html .= '<td>' . 'ownerid' . '</td>';
        $html .= '<td>' . 'createddate' . '</td>';
        $html .= '<td>' . 'duedate' . '</td>';
        $html .= '<td>' . 'message' . '</td>';
        $html .= '<td>' . 'isdone' . '</td>';
        $html .= '</tr>';


        $html .= '<tr>';
        $html .= '<td>' . $records->id . '</td>';
        $html .= '<td>' . $records->owneremail . '</td>';
        $html .= '<td>' . $records->ownerid . '</td>';
        $html .= '<td>' . $records->createddate . '</td>';
        $html .= '<td>' . $records->duedate . '</td>';
        $html .= '<td>' . $records->message . '</td>';
        $html .= '<td>' . $records->isdone . '</td>';
        $html .= '</tr>';

        $html .= '</table></center>';

        print_r($html);
    }

    function insert_account() {
        $record = new account();

        //set fields to insert
        $record->id = 30;
        $record->email = 'asdf@gmail.com';
        $record->fname = 'asdffname';
        $record->lname = 'asdflname';
        $record->phone = 911;
        $record->gender = 'male';
        $record->password = 'password';
        $record->birthday = '2000-05-05';


        $vals = '';
        $fields = '';
        $arr = get_object_vars($record);
        foreach ($arr as $k => $v) {

            if ($v == '') {
                $v = null;
            }
            $vals .= '"' . $v . '",';
            $fields .= $k . ',';
        }
        $vals = substr($vals, 0, (strlen($vals) - 1));
        $fields = substr($fields, 0, (strlen($fields) - 1));
        $record->insert($fields, $vals);
    }

    function insert_todo() {
        $record = new todo();

        //set fields to insert
        $record->id = 15;
        $record->owneremail = 'admin@njit.edu';
        $record->ownerid = 2;
        $record->createddate = '0000-00-00 00:00:00';
        $record->duedate = '0000-00-00 00:00:00';
        $record->isdone = 1;



        $vals = '';
        $fields = '';
        $arr = get_object_vars($record);
        foreach ($arr as $k => $v) {

            if ($v == '') {
                $v = null;
            }
            $vals .= '"' . $v . '",';
            $fields .= $k . ',';
        }
        $vals = substr($vals, 0, (strlen($vals) - 1));
        $fields = substr($fields, 0, (strlen($fields) - 1));
        $record->insert($fields, $vals);
    }

    function edit_account($id) {
        $record = new account();
        //set update fields
        $record->email = 'primaryemail@yahoo.com';
        $record->phone='8888888';


        $fields = array();
        $sep = '=';
        $arr = get_object_vars($record);
        foreach ($arr as $k => $v) {
            if ($v != '') {
                $fields[] = $k . $sep . '"' . $v . '"';
            }
        }

        $values = implode(',', $fields);

        $record->update($values, $id);
    }

    function edit_todo($id) {
        $record = new todo();
        //set update fields
        $record->owneremail = 'newtodoaccount@gmail.com';


        $fields = array();
        $sep = '=';
        $arr = get_object_vars($record);
        foreach ($arr as $k => $v) {
            if ($v != '') {
                $fields[] = $k . $sep . '"' . $v . '"';
            }
        }

        $values = implode(',', $fields);

        $record->update($values, $id);
    }

    function delete_account($id) {
        $record = new account();
        $record->delete($id);
    }

    function delete_todo($id) {
        $record = new todo();
        $record->delete($id);
    }

}

$obj = new main();
//Accounts
echo '<h1 style="text-align:center">Accounts</h1>';
echo '<h2 style="text-align:center">All records from Accounts</h2>';
$obj->get_accounts_data();

echo '<h2 style="text-align:center">Get Single Account</h2>';
$obj->get_single_account(2);

echo '<h2 style="text-align:center">After Inserting Id = 30 in Accounts</h2>';
$obj->insert_account();
$obj->get_accounts_data();

echo '<h2 style="text-align:center">After Editing Id = 30 from Accounts</h2>';
$obj->edit_account(30);
$obj->get_accounts_data();

echo '<h2 style="text-align:center">After Deleting Id = 30 from Accounts</h2>';
$obj->delete_account(30);
$obj->get_accounts_data();

//Todos
echo '<h1 style="text-align:center">Todos</h1>';
echo '<h2 style="text-align:center">All records from Todos</h2>';
$obj->get_todos_data();

echo '<h2 style="text-align:center">Get Single Todo</h2>';
$obj->get_single_todo(3);

echo '<h2 style="text-align:center">After Inserting Id = 15 in Todos</h2>';
$obj->insert_todo();
$obj->get_todos_data();

echo '<h2 style="text-align:center">After Editing Id = 15 from Todos</h2>';
$obj->edit_todo(15);
$obj->get_todos_data();

echo '<h2 style="text-align:center">After Deleting Id = 15 from Todos</h2>';
$obj->delete_todo(15);
$obj->get_todos_data();