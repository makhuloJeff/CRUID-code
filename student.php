<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">A Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id= "saveStudent">
        <div class="modal-body">

          <div class="alert alert-warning d-none"></div>
        <div class="md-3">
            <label for="name">Name</label>
            <input type="text" name= "name" class= "form-control"/>
        </div>
        
        <div class="md-3">
            <label for="name">Email</label>
            <input type="text" name= "email" class= "form-control"/>
        </div>
        <div class="md-3">
            <label for="name">Phone</label>
            <input type="text" name= "phone" class= "form-control"/>
        </div>
        <div class="md-3">
            <label for="name">Course</label>
            <input type="text" name= "course" class= "form-control"/>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="cardheader">
                        <h4 style ="margin-left:18rem;"> STUDENT MANAGEMENT PAGE
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Student
</button>
                        </h4>

                        </div>
                        <div class="cardbody">
                          <table id ="myTable" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>PHONE</th>
                                <th>COURSE</th>
                                <th>ACTION</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php  
                              require "connect.php";
                              $query = "SELECT * FROM data";
                              $query_run = mysqli_query($con, $query);
                              if (mysqli_num_rows($query_run) > 0 ) {
                              foreach($query_run as $data){

                                ?>
                                <tr>
                                <td><?= $data['id']  ?></td>
                                <td><?= $data['name']  ?></td>
                                <td><?= $data['email']  ?></td>
                                <td><?= $data['phone']  ?></td>
                                <td><?= $data['course']  ?></td>
                                <td>
                                  <a href="" class= "btn btn-info">VIEW</a>
                                  <button type ="button" value ="<?= $data['id'] ; ?>" class= "editBtn btn btn-success">EDIT</button>
                                  <a href="" class= "btn btn-danger">Delete</a>

                                </td>
                              </tr>
                              <?php


                              }
                              }
                              ?>
                             
                            </tbody>

                          </table>

                        </div>
                    </div>
                </div>
                
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script>

 $(document).on('submit', '#saveStudent', function (e){
 e.preventDefault();
 var formData = new FormData(this);
 formData.append("save_student", true);


 function isValidEmailAddress(emailAddress) {

 $.ajax({
  type: "POST",
  url: "code.php",
  data: formData,
  processData: false,
  contentType: false,
  success: function(response){
    var res = jQuery.parseJSON(response);
    if (res.status == 422) {
      $('#errormessage').removeClass('d-none');
      $('#errormessage').text(res.message);
      
    }else if(res.status == 200){
      $('#errormessage').addClass('d-none');
      $('#exampleModal').modal('hide');
      $('#saveStudent')[0].reset();
     // $('myTable').load(location.href + " #myTable");
      
    }

  }
 });


 $(document).('onclick', '.editBtn', function() {

var data_id = $(this).val();
windows.alert('data_id');
});
    
  </script>
  
  
  </body>
</html>
