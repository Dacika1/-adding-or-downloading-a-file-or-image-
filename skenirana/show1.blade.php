@extends('home.leyout')

@section('content')
<!-- container section start -->
  <section id="container" class="">
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i>Сви подаци о запосленом</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
               <h3>Подаци о запосленом</h3> 
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
                  <div class="row">
      <div class="col-lg-12">
        <section class="panel">
      <table class="table table-striped table-advance table-hover">
        <tbody>
          {{csrf_field()}}
          @foreach($users as $user)
          <tr>
            <td>Тип запосленог</td>
            <td>{{$user->employee_type}}</td>
          </tr>
          <tr>
            <td>Активан</td>
            <td>{{$user->active =='1' ? 'Да':'Не'}}</td>
          </tr>
          <tr>
            <td>Име </td>
            <td>{{$user->name}}</td>
          </tr>
          <tr>
            <td>Име једног родитеља</td>
            <td>{{$user->parents_name}}</td>
          </tr>
          <tr>
            <td>Презиме</td>
            <td>{{$user->surname}}</td>
          </tr>
          <tr>
            <td>Пол</td>
            <td>{{$user->type}}</td>
          </tr>
          <tr>
            <td>Датум рођења</td>
            <td>{{$user->birth!==null?$user->birth->format('d/m/Y'):''}}</td>
          </tr>
          <tr>
            <td>Место рођења</td>
            <td>{{$user->birth_place}}</td>
          </tr>
          <tr>
            <td>Адреса</td>
            <td>{{$user->address}}</td>
          </tr>
          <tr>
            <td>Држава рођења</td>
            <td>{{$user->birth_country}}</td>
          </tr>
          <tr>
            <td>Држављанство</td>
            <td>{{$user->citizenship}}</td>
          </tr>
          <tr>
            <td>ЈМБГ</td>
            <td>{{$user->jmbg}}</td>
          </tr>
          <tr>
            <td>Број личне карте/пасоша</td>
            <td>{{$user->broj_licne_karte}}</td>
          </tr>
          <tr>
            <td>Издавалац личне карте/пасоша</td>
            <td>{{$user->izdavalac_licne_karte_pasosa}}</td>
          </tr>
          <tr>
            <td>Телефон приватни</td>
            <td>{{$user->phone}}</td>
          </tr>
          <tr>
            <td>Телефон приватни 2</td>
            <td>{{$user->phone2}}</td>
          </tr>
          <tr>
            <td>Телефон службени</td>
            <td>{{$user->work_phone}}</td>
          </tr>
          <tr>
            <td>Е-маил приватни</td>
            <td>{{$user->email}}</td>
          </tr>
          <tr>
            <td>Е-маил приватни 2</td>
            <td>{{$user->email2}}</td>
          </tr>
          <tr>
            <td>Е-маил службени</td>
            <td>{{$user->work_email}}</td>
          </tr>

            {{csrf_field()}}
            @foreach($user->education as $edu)
          <tr>
            <td>Стечени назив:</td>
            <td>{{$edu->title}}</td>
          </tr>
          <tr>
            <td>Датум стицања звања:</td>
            <td>{{$edu->date!==null?$edu->date->format('d/m/Y'):''}}</td>
          </tr>
          <tr>
            <td>Високошколска установа на којој је стечено звање:</td>
            <td>{{$edu->faculty->name}}</td>
          </tr>
          @endforeach
          <tr>
            <td>Језик на коме је стечено основно образовање:</td>
            <td>{{$user->primary_school_language}}</td>
          </tr>
          <tr>
            <td>Језик на коме је стечено средње образовање: </td>
            <td>{{$user->high_school_language}}</td>
          </tr>
          {{csrf_field()}}
            @foreach($user->title as $zva)
            <tr>
              <td>Звање:</td>
              <td>{{$zva->title_list!== null?$zva->title_list->name : '/'}}</td>
            </tr>
            <tr>
              <td>Ужа научна област: </td>
              <td>{{$zva->uza_naucna_oblast}}</td>
            </tr>
            <tr>
              <td>Датум избора у звање:</td>
              <td>{{$zva->datum_izbora_u_zvanje!==null?$zva->datum_izbora_u_zvanje->format('d/m/Y'):''}}</td>
            </tr>
            <tr>
              <td>Установа на којој је стечено звање:</td>
              <td>{{$zva->ustanova}}</td>
            </tr>
            <tr>
              <td>Број одлуке о избору у звање:</td>
              <td>{{$zva->broj_odluke}}</td>
            </tr>
            <tr>
              <td>Датум одлуке о избору у звање:</td>
              <td>{{$zva->datum_odluke!==null?$zva->datum_odluke->format('d/m/Y'):''}}</td>
            </tr>
          @endforeach
          {{csrf_field()}}
            @foreach($user->workContract as $work)
            <tr>
              <td>Проценат радног односа:</td>
              <td>{{$work->work_percentage}}</td>
            </tr>
            <tr>
            @if($user->employee_type == 'Професор')
              <td>Трајање радног односа: </td>
              <td>{{$work->duration== '1' ? 'На одређено':'На неодређено'}}</td>
            </tr>
            @endif
            <tr>
              <td>Број уговора о раду:</td>
              <td>{{$work->contract_number}}</td>
            </tr>
            <tr>
              <td>Датум закључивања уговора о раду:</td>
              <td>{{$work->contract_date!==null?$work->contract_date->format('d/m/Y'):''}}</td>
            </tr>
            <tr>
              <td>Датум ступања на рад:</td>
              <td>{{$work->start_work_date!==null?$work->start_work_date->format('d/m/Y'):''}}</td>
            </tr>
            <tr>
              <td>Радно место:</td>
              <td>{{$work->work_position}}</td>
            </tr>
            <tr>
              @if($user->employee_type !== 'Професор')
              @if($work->contract_date_expiration!==null)
              <td>Датум истека уговора о раду:</td>
              <td>{{$work->contract_date_expiration->format('d/m/Y')}} @endif</td>
            </tr>
            @endif
            <tr>
              <td>Ангажовање на другој вишешколској установи:</td>
              <td>{{$work->comment=='1' ? 'Да':'Не'}}</td>
            </tr>
            <tr>
               {{csrf_field()}}
              @if($work->user->employee_type == 'Ненаставно особље')
              <td>Назив другог послодавца:</td>
              <td>
                @foreach($work->noneducatorExternal as $ne)
                  {{$ne->employer_name}}
                @endforeach
              </td>
              @else
              <td>Назив вишешколске установе:</td>
              <td>
                @foreach($work->noneducatorExternal as $ne)
                  {{$ne->employer_name}}
                @endforeach
              </td>
              @endif
            </tr>
            <tr>
              <td>Врста ангажовања: </td>
              <td>
                @foreach($work->noneducatorExternal as $ne)
                  {{$ne->employment_type}}
                @endforeach
              </td>
              
            </tr>
            <tr>
              <td>Ангажовање од:</td>
              <td>
                @foreach($work->noneducatorExternal as $ne)
                  {{$ne->empoyed_from!==null?$ne->empoyed_from->format('d/m/Y'):''}}
                @endforeach
              </td>
            </tr>
            <tr>
              <td>Ангажовање до:</td>
              <td>
                @foreach($work->noneducatorExternal as $ne)
                  {{$ne->employed_to!==null?$ne->employed_to->format('d/m/Y'):''}}
                @endforeach
              </td>
            </tr>
            <tr>
              <td>Обим ангажовања:</td>
              
              <td>
                @foreach($work->noneducatorExternal as $ne)
                  {{$ne->employed_factor}}
                @endforeach
              </td>
            </tr>
            <tr>
              <td>Сагласност број:</td>
              <td>
                @foreach($work->noneducatorExternal as $ne)
                  {{$ne->saglasnost_broj}}
                @endforeach
              </td>
            </tr>
            <tr>
              <td>Датум сагласности:</td>
              <td>
                @foreach($work->noneducatorExternal as $ne)
                  {{$ne->datum_saglasnosti!==null?$ne->datum_saglasnosti->format('d/m/Y'):''}}
                @endforeach
              </td>
            </tr>
            @endforeach
            {{csrf_field()}}
            @foreach($user->externalContract as $exte)
            <tr>
              <td>Звање:</td>
              <td>{{$exte->title_list->name}}</td>
            </tr>
            <tr>
              <td>Ужа научна област:</td>
              <td>{{$exte->uza_naucna_oblast}}</td>
            </tr>
            <tr>
              <td>Датум избора у звање:</td>
              <td>{{$exte->datum_izbora_u_zvanje!==null?$exte->datum_izbora_u_zvanje->format('d/m/Y'):''}}</td>
            </tr>
            <tr>
              <td>Установа на којој је стечено звање:</td>
              <td>{{$exte->ustanova}}</td>
            </tr>
            <tr>
              <td>Број одлуке о избору у звање:</td>
              <td>{{$exte->broj_odluke}}</td>
            </tr>
            <tr>
              <td>Датум одлуке о избору у звање:</td>
              <td>{{$exte->datum_odluke!==null?$exte->datum_odluke->format('d/m/Y'):''}}</td>
            </tr>
            <tr>
              <td>Врста ангажовања:</td>
              <td>{{$exte->type_of_employment}}</td>
            </tr>
            <tr>
              <td>Број уговора о радном ангажовању:</td>
              <td>{{$exte->contract_number}}</td>
            </tr>
            <tr>
              <td>Датум закључења уговора о радном ангажовању:</td>
              <td>{{$exte->contract_date!==null?$exte->contract_date->format('d/m/Y'):''}}</td>
            </tr>
            <tr>
              <td>Датум ступања на рад:</td>
              <td>{{$exte->start_work_date!==null?$exte->start_work_date->format('d/m/Y'):''}}</td>
            </tr>
            <tr>
              <td>Радно место:</td>
              <td>{{$exte->work_position}}</td>
            </tr>
            <tr>
              <td>Датум истека уговора о радном ангажовању:</td>
              <td>{{$exte->contract_date_expiration!==null?$exte->contract_date_expiration->format('d/m/Y'):''}}</td>
            </tr>
            <tr>
              <td>Назив матичне установе:</td>
              <td>{{$exte->organization_name}}</td>
            </tr>
            <tr>
              <td>Врста матичне установе:</td>
              <td>{{$exte->organization_type}}</td>
            </tr>
            <tr>
              <td>Сагласност за допунски рад</td>
              <td>Сагласност број:</td>
              <td>{{$exte->ExternalContractAprovement->first()->saglasnost_broj}}</td>
            </tr>
            <tr>
              <td>Датум сагласности:</td>
              <td>{{$exte->ExternalContractAprovement->first()->datum_saglasnosti!==null?$exte->ExternalContractAprovement->first()->datum_saglasnosti->format('d/m/Y'):''}}</td>
            </tr>
            <tr>
              <td>Обим ангажовања:</td>
              <td>{{$exte->ExternalContractAprovement->first()->obim_angayovanja}}</td>
            </tr>
          @endforeach
          
          @endforeach
           </tbody>
          </table>
        </section>
      </div>
    </div>
  </div>
</section>
</div>
</div>
</section>
</section>
</section>

   @endsection