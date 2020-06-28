@extends('home.leyout')

@section('content')
<!-- container section start -->
  <section id="container" class="">
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i>Скенирана документа</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="/home">Почетна</a></li>
              <li>Скенирана документа</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
               Подаци
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
              <table class="table table-striped table-advance table-hover">
                <thead>
                  <tr>
                    <th class="col-lg-2">Име и Презиме</th>
                    <th class="col-lg-2">Скенирана лична карта/пасош</th>
                    <th class="col-lg-2">Скенирана диплома</th>
                    <th class="col-lg-2">Скенирана одлука о избору у звање</th>
                    <th class="col-lg-2">Скенирана одлука о избору у звање</th>
                  </tr>
                </thead>
                <tbody>
                   {{csrf_field()}}
                  @foreach($users as $user)
                  @if($user->type!==null)
                   <tr>
                    <td>{{$user->name}} {{$user->surname}}</td>
                    <td>
                    <img src="{{url($user->skenirana_licna_karta_pasos)}}" style="width: 20%;">
                     <br><a href="{{action('ScanedContoller@download', ['url'=>str_replace('/', '*', substr($user->skenirana_licna_karta_pasos, 1))])}}" class="btn btn-primary" type="button"><i class="fa fa-download"> Преузми</i></a>
                   </td>
                    <td> 
                      @foreach($user->education as $education)
                    <img src="{{url($education->scanned_diploma)}}" style="width: 20%;">
                      <br><a href="{{action('ScanedContoller@download', ['url'=>str_replace('/', '*', substr($education->scanned_diploma, 1))])}}" class="btn btn-primary" type="button"><i class="fa fa-download"> Преузми</i></a>
                      @endforeach
                    </td>
                    <td>
                      @foreach($user->title as $title)
                     <img src="{{url($title->first()->skenirana_odluka)}}" style="width: 20%;">
                      <br><a href="{{action('ScanedContoller@download', ['url'=>str_replace('/', '*', substr($title->first()->skenirana_odluka, 1))])}}" class="btn btn-primary" type="button"><i class="fa fa-download"> Преузми</i></a>
                      @endforeach
                    </td>
                     <td>
                       @foreach($user->externalContract as $extes)
                     <img src="{{url($extes->first()->skenirana_odluka)}}" style="width: 20%;">
                      <br><a href="{{action('ScanedContoller@download', ['url'=>str_replace('/', '*', substr($extes->first()->skenirana_odluka, 1))])}}" class="btn btn-primary" type="button"><i class="fa fa-download"> Преузми</i></a>
                      @endforeach
                    </td>
                    </tr>
                  @endif
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </section>
</section>
 @endsection