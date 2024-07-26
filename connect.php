<?php
// localhost (for both online and offline)
// offline(root)
// online(database username)
// password(for online we create password while offline is empty)
// name of file
$conn = mysqli_connect("localhost","root","","firstwork");
if ($conn) {
    echo "";
}else{
    echo "not successful";
};

?>