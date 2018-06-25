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
                                output += "</tr>";
                            }
                            $('#page_table').html(output);
                            var paging = "";
                            paging += "<ul class='pagination pagination-sm no-margin pull-right'>";
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

</script>
</head>
<body>
  <div class="jumbotron text-center">
    <p><h3>User Information<h3></p> 
    </div>
    <div class="container">
      <h2>User List</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
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
<ul class="pagination" id="paging">
</ul>
</div>
</body>
</html>
