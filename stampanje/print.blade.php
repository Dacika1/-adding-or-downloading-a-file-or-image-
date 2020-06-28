@extends('home.leyout')

@section('content')
<!-- container section start -->
  <section id="container" class="">
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i>Потврде</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
               Потврде
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
                  	<form class="navbar-form" method="get" action='{{url("/search")}}'>
              			{{csrf_field()}}
              			<input class="form-control" placeholder="Име" type="text" name="trazi">
              			<input class="form-control" placeholder="Презиме" type="text" name="trazi">
              			<input class="form-control" placeholder="ЈМБГ" type="text" name="trazi">
              			<button type="submit" class="btn btn-default"><span>Тражи</span></button>
              		<a href="javascript:void(0)" class="btn btn-primary" id="word-export" type="button">
              			<i class="fa fa-file-word-o"> Преузми</i></a>
              		</form>			          
              		<div class="word-content">
              			<div class="googoose">
              			@foreach($user as $users)
              			@if($users->type!==null) 
              		<img src="{{ URL::to('/header.png') }}" style="width: 1150px; height: 170px; text-align: center;">

	      			<p style="font-family: Times New Roman; text-align: justify;">	
		  				<h4>Нa лични зaхтeв зaпoслeнe/ог {{$users->name}} {{$users->surname}}, a нa oснoву пoдaтaкa из службeнe eвидeнциje o зaпoслeнимa нa  Фaкултeту зa примeњeни мeнaџмeнт, eкoнoмиjу и финaнсиje, Бeoгрaд, издaje сe:
	  					<br>
	  					<br><p style="text-align: center;"><b> П O T В Р Д A</b></p>
	  					<br>
	  					<br>Да је {{$users->name}} ({{$users->parents_name}}) {{$users->surname}}, рођен/а дана {{$users->birth!==null?$users->birth->format('d.m.Y'):''}}. године, {{$users->birth_place}}, {{$users->birth_country}}, ЈМБГ {{$users->jmbg}}, са пребивалиштем у {{$users->address}}, запослен/а на @foreach($users->workContract as $works)
	                      @if($works->contract_date_expiration==null) {{'неодређено'}}
	                      @else
	                      {{'одређено'}}
	                      @endif
	                       време на Факултету за примењени менаџмент, економију и финансије од {{$works->start_work_date->format ('m.d.Y')}}. године и даље, на радном месту {{$works->work_position}}.
	                      @endforeach
	  					<br>
	  					<br>У приложенoj  табели унети су подаци о висини зараде запослене/ог, у складу са законом, у последња 3 месеца који претходе месецу у којем се издаје потврда, тј. за период од <font color="red">01.06.2019.-31.08.2019.</font> године.
	  					<br><font color="red">ТАБЕЛА</font>
	  					<br>Просечна зарада именоване/ог у наведеном периоду износи <font color="red">66.291,01</font> динара бруто,<font color="red"> 48.000,00</font> динара нето.
	  					<br>
	  					<br>Ова потврда се издаје на лични захтев именоване/ог, а може се користити ради остваривања права код банке.
	  					<br>
	  					<br>
	  					<p>У Бeoгрaду, <span id="date"></span> гoд.</p><p style="text-align: right;">СEКРETAРИJAT</p>
	  					<p style="text-align: right;"> Oлгицa Mилoшeвић, маст. прaв.</p></h4>
	  				</p>
				        <img src="{{ URL::to('/footer.png') }}" style="width: 1150px; height: 90px; text-align: center;">

	  				@endif
      				@endforeach
      			</div>
      			</div>
              	</div>
              	</div>
              </section>
             </div>
          </div>
      </section>
  </section>
</section>

 <script src="js/FileSaver.js"></script>
 <script src="js/jquery.wordexport.js"></script>
 
 <script src="/path/to/jquery.min.js"></script>
<script src="jquery.googoose.js"></script>


<script type="text/javascript">
	 $('#word-export').click(function(event){
  	$('.word-content').wordExport();
  	 
  });

    n =  new Date();
	y = n.getFullYear();
	m = n.getMonth() + 1;
	d = n.getDate();
	document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
	
$(document).googoose({
  // default selector of html to wrap the Word doc in
  area:'div.googoose',
  // used to manufacture headers and footers
  headerfooterid:'googoose-hdrftrtbl',
  // CSS origins of the Word document
  margins:'1.0in',
  // zoom percentage when the Word document opens
  zoom:'75',
  // the file name to save as
  filename:'Doc1_' + now +'.doc',
  // size of the Word document
  size:'8.5in 11.0in',
  // display mode to open the Word document in
  display:'Print',
  //  the language on the page
  lang:'en-US',
  // determines whether the page should be downloaded as a Word document or displayed as HTML
  download:true,
  // if used by the developer this jQuery selector will translate into a Word table of contents
  toc:'div.googoose.toc',
  // f used by the developer at this jQuery selector will translate into a Microsoft Word page break
  pagebreak:'div.googoose.break',
  // the content in this jQuery selector will be put in the Microsoft Word document header
  headerarea:'div.googoose.header',
  // the content in this jQuery selector will be put in the document footer
  footerarea:'div.googoose.footer',
  // used solely by the googoose internals
  headerid:'googoose-header',
  // used solely by the googoose internals
  footerid:'googoose-footer',
  // CSS margin for the header
  headermargin:'.5in',
  // CSS margin for the footer
  footermargin:'.5in',
  //  generally used in headers and Footers this whole display the current page number
  currentpage:'span.googoose.currentpage',
  // generally displayed in headers and Footers this jQuery selector when put into the HTML content will display the number of total pages.
  totalpage:'span.googoose.totalpage',
  // html boundary
  htmlboundary:'--',
  // called after the HTML has been rendered
  finishaction: GG.finish,
  // the root node
  initobj: document
});
 

 </script>
 @endsection