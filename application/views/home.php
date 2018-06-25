<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript">
        var page = '0';//use in pagination

        $(document).ready(function () {
            list_user();
        });

        var sort_field;
        var sort_type;
        function sort_filter(field)
        {
            if (sort_type == undefined)
            {
                sort_type = 'asc';
            } else if (sort_type == 'asc')
            {
                sort_type = 'desc';
            } else if (sort_type == 'desc')
            {
                sort_type = 'asc';
            }
            sort_field = field;
            list_user();
        }


        var user_ids = '';
        function delete_user(user_id)
        {
            user_ids = user_id;
        }
        function delete_ok()
        {
            var base_url = "<?php echo base_url(); ?>home/delete_user/";
            $.ajax({
                url: base_url,
                type: 'post',
                data: {
                    user_id: user_ids
                },
                success: function () {
                    list_user();
                },
                error: function () {
                    alert('ajax failure');
                }
            });
        }

         function page_click(page_no)
        {
            page = page_no;
            list_user();
        }

        function list_user()
        {
            $("#loading").show();
            var pagee = page;
            if (pagee == '0')
            {
                var pagee = '1';
            }

            var firstname = $('#search_firstname').val();

                $.ajax({
                    type: 'post',
                    data: {
                        pagee: pagee,
                        firstname: firstname,
                        sort_field: sort_field,
                        sort_type: sort_type
                    },
                    url: '<?php echo base_url(); ?>home/list_user/',
                    success: function (data)
                    {
                        var json_obj = $.parseJSON(data);
                        var result_length = json_obj.user_list.length;
                        if (result_length > 0)
                        {
                            var output = "";
                            var i;
                            var default_path = '<?php echo base_url() . 'assets/dist/img/default.png' ?>';
                            var error_src = "this.src='" + default_path + "'";
                            for (i = 0; i < json_obj.user_list.length; i++)
                            {
                                output += '<tr>';
                                output += "<td>" + json_obj.user_list[i].user_firstname + "</td>";
                                output += "<td>" + json_obj.user_list[i].user_lastname + "</td>";
                                output += "<td>" + json_obj.user_list[i].user_id + "</td>";
                                output += "<td><a href ='' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal' onclick='delete_user(" + json_obj.user_list[i].user_id  + ")' style='margin:5px;width:50px;'>Delete</a>";
                                output += "<a href ='' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModa2' style='margin:5px;width:100px;'> ajex Edit</a>";
                                output += "<a href ='<?php echo base_url(); ?>home/edit_user_view/"+json_obj.user_list[i].user_id+"' class='btn btn-warning btn-xs' style='margin:5px;width:50px;'>Edit</a>";
                                output += "<a href ='' class='btn btn-success btn-xs' style='margin:5px;width:50px;'>view</a></td>";
                                output += "</tr>";
                            }
                            $('#page_table').html(output);
                            var paging = "";
                            paging += "<ul class='pagination  pagination-sm no-margin pull-right'>";
                            var no = json_obj.total_pages;
                            if (pagee > 1) {
                                var onclick_li = 'onclick = "return page_click(' + (pagee - 1) + ')"';
                                paging += '<li ' + onclick_li + '"><a style="cursor:pointer">&laquo;</a></li>';
                            }
                            for (i = 1; i <= no; i++) {
                                var onclick_li = 'onclick = "return page_click(' + i + ')"';
                                if (pagee == i)
                                {
                                    paging += '<li ' + onclick_li + ' class="paginate_button active"><a style="cursor:pointer">' + i + '</a></li>';
                                } else {
                                    paging += '<li ' + onclick_li + '><a style="cursor:pointer">' + i + '</a><li>';
                                }
                            }
                            if (pagee < no)
                            {
                                var onclick_li = 'onclick = "return page_click(' + (parseInt(pagee) + 1) + ')"';
                                paging += '<li ' + onclick_li + '><a style="cursor:pointer">&raquo;</a></li>';
                            }
                            paging += "</ul>";
                            $('#paging').html(paging);
                            $("#loading").hide();
                        } else {
                            var output = "";
                            output += '<tr class="odd">';
                            output += '<td colspan="5" class="dataTables_empty"><center><h2>No matching records found</h2></center></td>';
                            output += '</tr>';
                            $('#page_table').html(output);
                            var paging = "";
                            $('#paging').html(paging);
                            $("#loading").hide();
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }

            $("#edit_user").on("submit", function (e) {
                    e.preventDefault();
                    alert('you');
            });

</script>
</head>
<body>
  <div class="jumbotron text-center">
    <p><h3>User Information<h3></p> 
    </div>
    <div class="container">
        <div class="row">
            <a href ='<?php echo base_url() ?>home/add_user_view' class='btn btn-primary' style='float: right;'>Add User</a>
        </div>
    </div>
    <div class="container">
      <h2>User List</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="page_table">
            <tr>
                <td>John</td>
                <td>Doe</td>
                <td>john@example.com</td>
            </tr>
            <tr>
                <td>Mary</td>
                <td>Moe</td>
                <td>mary@example.com</td>
            </tr>
            <tr>
                <td>July</td>
                <td>Dooley</td>
                <td>july@example.com</td>
            </tr>
        </tbody>
</table>
<div class="row" id="paging">
</div>
</ul>
</div>
</body>
</html>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Warnningr</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"  onclick="delete_ok();">Delete</button>
          <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="myModa2" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Profile</h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" id="edit_user">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="firstname">Firstname:</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" id="firstname" placeholder="Please Enter firstname" name="firstname">
                    </div>
                    <label id="error_firstname" class="control-label pull-left"></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="lastname">Lastname:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="lastname" placeholder="Please Enter lastname" name="lastname">
                    </div>
                    <label id="error_lastname" class="control-label pull-left"></label>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="gender">Gender:</label>
                    <div class="col-sm-6">
                        <input type="radio" name="gender" id="gender" value="male" checked> Male<br>
                        <input type="radio" name="gender" id="gender" value="female"> Female<br>
                        <input type="radio" name="gender" id="gender" value="other"> Other
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">        
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>      
        </div>
    </div>
</div>