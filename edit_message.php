<?php
include_once "classes/Page.php";
include 'classes/Pdo_.php';

$user= new Pdo_($pdo);

if(isset($_REQUEST['id'])){
$id = $_REQUEST["id"];
$sql = "SELECT * FROM message WHERE id='".$id."'";
$query = $user->getUsers($sql);
}

?>

<p>Edit post</p>
<form method="post" action="messages.php?id=<?php echo $id ?>">
 <table>
 <tr>
 <td>Name</td>
 <td>
 <label for="name"></label>
 <input required type="text" name="name" id="name" style="width: 100%;" value="<?php echo $query[0]["name"] ?>"/>
 </td>
 </tr>
 <tr>
 <td>Type</td>
 <td>
 <label for="type"></label>
 <select name="type" id="type">
     <?php 
      if($query[0]["type"]== 'public'){
          echo ' <option value="public" selected>Public</option>
          <option value="private">Private</option>
          ';
      }else{
          echo ' <option value="public">Public</option>
                 <option value="private" selected>Private</option>
          ';
      }
     ?>
 </select>
 </td>
 </tr>
 <tr>
 <td>Message content</td>
 <td>
 <label for="content"></label>
 <textarea required type="text" name="content" id="content" rows="10" cols="40">
<?php echo $query[0]["message"] ?>
 </textarea>
 </td>
 </tr>
 </table>
 <input type="submit" id= "submit" value="Add message" name="edit_message">
</form>