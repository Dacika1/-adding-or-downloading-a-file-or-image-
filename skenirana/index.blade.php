@extends('home.leyout')

@section('content')
<!-- container section start -->
  <section id="container" class="">
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i>Сви подаци</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
               Сви подаци
              </header>
              <div class="panel-body">
                 @if ($message = Session::get('success'))
                  <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                  </div>
                  @endif
                  @if (count($errors) > 0)
                    <div class="alert alert-danger">
                     <strong>Упс!</strong> Дошло је до грешке при уносу података.
                      <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                  @endif
            <div class="tab-pane">
               <div class="col-sm-3">
                <input class="form-control" placeholder="Име" name="brisi" type="text" id="ime">
              </div>
              <div class="col-sm-3">
                <input class="form-control" placeholder="Презиме" name="brisi" type="text" id="prezime">
              </div>
              <div class="col-sm-3">
                <input class="form-control" placeholder="Тип запосленог" name="brisi" type="text" id="tip">
              </div>
              <div class="col-sm-3">
                <input class="form-control" placeholder="Датум избора у звање" name="brisi" type="text" id="zvanje">
              </div>
              <div class="col-sm-3">
                <input class="form-control" placeholder="Радно место" name="brisi" type="text" id="mesto">
              </div>
              <div class="col-sm-3">
                <input class="form-control" placeholder="Датум истека од" name="brisi" type="text" id="istekOd">
              </div>
              <div class="col-sm-3">
                <input class="form-control" placeholder="Датум истека до" name="brisi" type="text"  id="istekDo">
              </div>
              <div class="col-sm-3">
                <input class="form-control" placeholder="Радни однос/ допунски рад" name="brisi" type="text" id="do">
              </div>
              <div class="col-sm-10">
                <a href="" type="button" class="btn btn-primary" id="clearFilter">Очисти</a>
              </div>
            </div>
            
            <div class="tab-pane">
              <table class="table table-striped table-advance table-hover" id="myTable">
                <thead>
                  <tr>
                    <th>Име</th>
                    <th>Презиме</th>
                    <th>Тип запосленог</th>
                    <th>Датум избора у звање</th>
                    <th>Радно место</th>
                    <th>Датум истека уговора о раду</th>
                    <th>Радни однос/допунски рад</th>
                    <th>Приказ свих података</th>
                  </tr>
                </thead>
                <tbody>
                   {{csrf_field()}}
                  @foreach($users as $user)
                  <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->surname}}</td>
                    <td>{{$user->employee_type}}</td>
                    <td>
                      @foreach($user->title as $title)
                      {{$title->datum_izbora_u_zvanje->format('m/d/Y')}}
                     @endforeach
                    </td>
                    <td>@foreach($user->workContract as $works)
                      {{$works->work_position}}
                        @endforeach
                    </td>
                    <td>@foreach($user->workContract as $works)
                      @if($works->contract_date_expiration==null) {{'Неодређено'}}
                      @else
                      {{$works->contract_date_expiration->format('m/d/Y')}}
                      @endif
                      @endforeach
                    </td>
                    <td>
                    @foreach($user->workContract as $works)
                     @if($works->angazovanje =='1'){{'Радни однос'}}
                      @endif
                    @endforeach
                     @foreach($user->ExternalContract as $exte)
                      @if($exte->user_id !=='null'){{'Допунски рад'}}
                      @endif</td>
                    @endforeach
                    <td><a href="{{action('ScanedContoller@show',$user->id)}}" class="btn btn-info" type="button"><i class="fa fa-eye"></i> Приказ</a></td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Име</th>
                      <th>Презиме</th>
                      <th>Тип запосленог</th>
                      <th>Датум избора у звање</th>
                      <th>Радно место</th>
                      <th>Датум истека уговора о раду</th>
                      <th>Радни однос/допунски рад</th>
                      <th>Приказ свих података</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
        </section>
      </div>
    </div>
  </section>
</section>
</section>

<script type="text/javascript">
  
$(document).ready(function() {
  var table = $('#myTable').DataTable();
$('#ime').on( 'keyup', function () {
    table
        .column( 0 )
        .search( this.value )
        .draw();
} );

$('#prezime').on( 'keyup', function () {
    table
        .column( 1 )
        .search( this.value )
        .draw();
} );
$('#tip').on( 'keyup', function () {
    table
        .columns( 2 )
        .search( this.value )
        .draw();
} );

$('#mesto').on( 'keyup', function () {
    table
        .column( 4 )
        .search( this.value )
        .draw();
} );
$('#do').on( 'keyup', function () {
    table
        .column( 6 )
        .search( this.value )
        .draw();
} );

        $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#istekOd').datepicker("getDate");
            var max = $('#istekDo').datepicker("getDate");
            var startDate = new Date(data[5]);
            
            if (min == null && max == null) { return true; }
            if (min == null && startDate <= max) { return true;}
            if(max == null && startDate >= min) {return true;}
            if (startDate <= max && startDate >= min) { return true; }
            return false;
        });

        $("#istekOd").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
        $("#istekDo").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
        $("#zvanje").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
        var table = $('#myTable').DataTable();

        // Event listener to the two range filtering inputs to redraw on input
        $('#istekOd, #istekDo, #zvanje').change(function () {
            table.draw();
        });         
  });
        $('#clearFilter').click(function() {
              $('#ime, #prezime, #tip, #zvanje, #mesto, #do, #istekOd, #istekDo').val('');
              var table = $('#myTable').DataTable();
              table.search($(this).val()).fnDraw();

            });



 </script>
 @endsection