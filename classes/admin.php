<?php
    class Admin{
        protected $conn;
        function __construct($conn){
            $this->conn = $conn;
        }


        function checkEmail($email){
            $sql = "SELECT email FROM users WHERE email = '{$email}'";
            $query = mysqli_query($this->conn, $sql);
            if(mysqli_num_rows($query)>0){
                return TRUE;
            }else{
                return FALSE;
            }
        }

        function createUser($first_name,$last_name,$email,$hashed_password){
            $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('{$first_name}','{$last_name}', '{$email}', '{$hashed_password}')";
            $query = mysqli_query($this->conn,$sql);
            if($query){
                return TRUE;
            }else{
                return FALSE;
            }
        }

        function addcategory($category_name){
            $sql = "INSERT INTO category (category_name) VALUES ('{$category_name}')";
            $query = mysqli_query($this->conn,$sql);
            if($query){
                $_SESSION['error']='Category Added';
                header("location: admin.php");
            }else{
                $_SESSION['error']='Category Not Added';
                header("location: admin.php");
            }
        }


        function addSubCategory($sub_category_name, $category){
            $sql = "INSERT INTO sub_category (name,category) VALUES ('{$sub_category_name}', $category)";
            $query = mysqli_query($this->conn,$sql);
            if($query){
                $_SESSION['error']='SubCategory Added';
                header("location: admin.php");
            }else{
                $_SESSION['error']='SubCategory Not Added';
                header("location: admin.php");
            }
        }

        function getCategory(){
            $sql = "SELECT * from category";
            $result  = mysqli_query($this->conn,$sql);
            return $result;
        }

        //get sub category food
        function getSubCategoryFood(){
            $sql = "SELECT * from sub_category where category=15";
            $result  = mysqli_query($this->conn,$sql);
            return $result;
        }

        //get sub category drink
        function getSubCategoryDrink(){
            $sql = "SELECT * from sub_category where category=14";
            $result  = mysqli_query($this->conn,$sql);
            return $result;
        }

        function deleteCategory($category_id){
            $sql = "DELETE FROM category WHERE category_id={$category_id}";
            $query  = mysqli_query($this->conn,$sql);
            if($query){
                $_SESSION['error']='Category Deleted';
                header("location: admin.php");
            }else{
                $_SESSION['error']='Category Not Deleted';
                header("location: admin.php");
            }
        }

        function getSubCategory(){
            $sql = "SELECT * from sub_category";
            $result  = mysqli_query($this->conn,$sql);
            return $result;
        }

        function deleteSubCategory($subCategory_id){
            $sql = "DELETE FROM sub_category WHERE id={$subCategory_id}";
            $query  = mysqli_query($this->conn,$sql);
            if($query){
                $_SESSION['error']='SubCategory Deleted';
                header("location: admin.php");
            }else{
                $_SESSION['error']='SubCategory Not Deleted';
                header("location: admin.php");
            }
        }

        function category_meal_list($id){
            $sql = "SELECT * from meal where category_id={$id}";
            $result  = mysqli_query($this->conn,$sql);
            if(mysqli_num_rows($result)>0){
                return $result;
            }else{
                $_SESSION['error']='No related meal found!!';
                header("location: admin.php");
            }  
        }

        function sub_category_meal_list($id){
            $sql = "SELECT * from meal where sub_category_id={$id}";
            $result  = mysqli_query($this->conn,$sql);
            if(mysqli_num_rows($result)>0){
                return $result;
            }else{
                $_SESSION['error']='No related meal found!!';
            }  
        }


        function getCategoryMealCount($category_id){
            $sql = "SELECT Count(meal_id) as count from meal where category_id={$category_id}";
            $result  = mysqli_query($this->conn,$sql);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                return (int)$row['count'];
            }else{
                return 0;
            } 
        }

        function getSubCategoryMealCount($subCategory_id){
            $sql = "SELECT Count(meal_id) as count from meal where sub_category_id ={$subCategory_id}";
            $result  = mysqli_query($this->conn,$sql);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                return (int)$row['count'];
            }else{
                return 0;
            } 
        }


        function addmeal($name,$image_loc,$price,$category,$subCategory,$desc){
            $sql = "INSERT INTO meal(name,image_url,price,category_id,sub_category_id,description) VALUES ('{$name}','{$image_loc}',{$price},'{$category}','{$subCategory}','{$desc}')";
            $query = mysqli_query($this->conn,$sql);
            if($query){
                $_SESSION['error']='Meal Added';
                header("location: admin.php");
            }else{
                $_SESSION['error']='Meal Not Added';
                header("location: admin.php");
            }
        }

        function removeMeal($meal_id){
            $sql = "DELETE FROM meal where meal_id={$meal_id}";
            $query = mysqli_query($this->conn,$sql);
            if($query){
                $_SESSION['error']='Meal Removed';
                header("location: admin.php");
            }else{
                $_SESSION['error']='Meal Not Removed';
                header("location: admin.php");
            }
        }

        function editmeal($meal_id,$name,$image_loc,$price,$category,$subCategory,$desc){
            $previousData = $this::getMealDetail($meal_id);
            if(empty($name)){
                $name =  $previousData['name'];
            }
            if(empty($image_loc)){
                $image_loc =  $previousData['image_url'];
            }
            if(empty($price)){
                $price =  $previousData['price'];
            }
            if(empty($category)){
                $category =  $previousData['category_id'];
            }
            if(empty($subCategory)){
                $subCategory =  $previousData['sub_category_id'];
            }
            if(empty($desc)){
                $desc =  $previousData['description'];
            }
            $category = (int)$category;
            $subCategory =(int)$subCategory;

            $sql = "UPDATE meal SET name = '$name', image_url='$image_loc', price=$price, category_id=$category, sub_category_id=$subCategory, description='$desc' WHERE meal_id = {$meal_id};";
            echo $sql;
            $query = mysqli_query($this->conn,$sql);
            if($query){
                $_SESSION['error']='Meal Added';
                header("location: admin.php");
            }else{
                $_SESSION['error']='Meal Not Added';
                header("location: admin.php");
            }
        }

        function getMeal(){
            $sql = "SELECT * from meal";
            $result  = mysqli_query($this->conn,$sql);
            return $result;
        }
        function searchMeal($searchKey){
            $sql = "SELECT * from meal WHERE name like '%{$searchKey}%'";
            $result  = mysqli_query($this->conn,$sql);
            return $result;
        }

        function getMealDetail($meal_id){
            $sql = "SELECT * from meal WHERE meal_id={$meal_id}";
            $result  = mysqli_query($this->conn,$sql);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                return $row;
            }else{
                $_SESSION['error'] = "Invalid Meal ID!!";
            } 
        }

        function getRecommended(){
            $sql = "SELECT * from meal WHERE recommended=1";
            $result  = mysqli_query($this->conn,$sql);
            return $result;
        }

        function getMenuFood(){
            $sql = "SELECT * from meal INNER JOIN category ON meal.category_id = category.category_id WHERE category_name='foods'";
            $result  = mysqli_query($this->conn,$sql);
            return $result;
        }

        function getMenuDrink(){
            $sql = "SELECT * from meal INNER JOIN category ON meal.category_id = category.category_id WHERE category_name='drinks'";
            $result  = mysqli_query($this->conn,$sql);
            return $result;
        }

        function recommend($id){
            $sql = "UPDATE meal SET recommended = 1 WHERE meal_id = {$id};";
            $result  = mysqli_query($this->conn,$sql);
        }

        function unrecommend($id){
            $sql = "UPDATE meal SET recommended = 0 WHERE meal_id = {$id};";
            $result  = mysqli_query($this->conn,$sql);
        }


        function prompt($prompt_msg){
            echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");
    
            $answer = "<script type='text/javascript'> document.write(answer); </script>";
            return($answer);
        }

    }
?>