@extends('layout.app')
@section('title', 'Author')
@section('header', 'All blog')
{{-- @section('sidebar')
    @parent

@endsection --}}
@section('nav')
    <li class=""><a href="{{route("author.index")}}""><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
		
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Blog <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children " id="sub-item-1">
					<li><a class="active" href="{{route("blog")}}">
						<span class="fa fa-arrow-right">&nbsp;</span> All Blogs
					</a></li>
					<li><a class="" href="{{route("edit_blog")}}">
						<span class="fa fa-arrow-right">&nbsp;</span> Create blog
					</a></li>

				</ul>
			</li>
@endsection
@section('content')
    <table id="myTable" class="display dataTable">
    	<thead>
      <tr>
      	<th>Id</th>
      	<th>Title</th>
      <th>Description</th>
      <th>Accept</th>
      <th>Created_date</th>
      <th>Updated_date</th>
      <th>Action</th></tr>
    	</thead>
	    <tbody>

	    </tbody>
    </table>
<div class="modal fade" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" align="center"><b>Blog</b></h4>
      </div>
      <div class="modal-body">
         <label>Title</label>
         <div id="title">
         </div>
        <label>Description</label>
         <div id="description">
         </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('css')

    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
   $(document).ready( function () {
   var table= $('#myTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "blog/search",
         columnDefs: [ {
        targets: 2,
        render: function ( data, type, row ) {
                            if(data==null)return data;
                              return  data.length > 20 ?
                              data.substr( 0, 20 ) +'…'+"<span class=hidden>"+data+"</span>" :
                              data+"<span class=hidden>"+data+"</span>";
                              }
                              },
        {
        targets: 1,
        render: function ( data, type, row ) {
                              return  "<label>"+data+"</label>";
                              }
                              }  
                      ],
        });

      $( document ).on( "click", "tr td:not(:last-child)", function() {
                    var title=$(this).parent().find("label").text();
                    var description=$(this).parent().find("span").text();
                      view1(title,description);
       });
} );
   function view1(title,description){

     $('#modal').modal(); 
     $('#title').text(title);
     $('#description').text(description);
   }
  function delete1 (id)
   {
   	if (confirm("You want to delete")) { 
   	$.ajax("{{route('delete_blog')}}",
   	 {
   	 	data:'id='+id,
      success: function(data) {
      	if(data['success']=="true")
            $("tr").has("td:contains("+id+")").hide();
      },
      error: function() {
         $('#notification-bar').text('An error occurred');
      }
   });
   }
   };

</script>
@endsection