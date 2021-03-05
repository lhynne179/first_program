<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/toastr.min.css">
    <meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>
<body>
<!-----------------Scripts----------------------------------------------->
    <!-- third parties -->
    <script src="js/jquery.min.js"></script>
    <script src="js/axios.min.js" ></script>
    <script src="js/toastr.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/qs.min.js"></script>
    <!-- local script -->
    <script src="js/app.js"></script>
    
<!-- contents -->
    <div class="container-fluid">
        <div class="row">
            <div class="header">
                <nav class="navbar navbar-expand-lg navbar-dark  bg-light">
                    <a class="navbar-brand" href="#">Products Page</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </nav>
            </div>
        </div>  
        <div class="row">
        
           <!-- Button trigger modal -->

           <div class="col-md">


           <!-- modal form -->
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Add Data
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add/Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form>
        <div class="modal-body">
        <input type="hidden" name="id" value = ""/>
        <div class="form-group col-sm-9">
            <label>Name:
                <input type="text" class="form-control" placeholder="Product name" name="name">
            </label>
        </div>
        <div class="form-group col-sm-9">
            <label>Price:
                <input type="number" class="form-control" placeholder="0.00" name="price">
            </label>
        </div>
        <div class="form-group col-sm-9">
            <label>Stock:
                <input type="number" class="form-control" placeholder="0" name="stock">
            </label>
        </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

           <!-- table -->
                
                <table class="table table-striped">
                   <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock</th>
                            <th scope="col" colspan=2>
                                    <input id="search_product" type="search" class="form-control" placeholder="search"> 
                            </th>
                        </tr>
                   </thead>
                   <tbody>
                   </tbody>
                </table>
           </div>
        </div>
    </div>

    
    
</body>

</html>