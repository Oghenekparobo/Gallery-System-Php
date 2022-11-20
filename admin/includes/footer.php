  </div>
    <!-- /#wrapper -->
   
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

     <!-- summernote js file -->
     <script src="js/summernote.min.js"></script>
 
     <script>
    $(document).ready(function() {
        $('#summernote').summernote({
          tabsize: 2,
          height: 100
        });
    });
  </script>
  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['views',     <?php echo $session->count; ?>],
          ['comments',    <?php echo Comment::count_all(); ?>],
          ['users',    <?php echo User::count_all(); ?>],
          ['photos',    <?php echo Photo::count_all(); ?>]
         
        ]);

        var options = {
          legend:'none',
          pieSliceText:'label',
          title: 'Admin Dashboard Summary',
          backgroundColor:'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</body>

</html>
