@extends('layouts.master', ['titre' => 'Pharmaciens', 
                            'nomPage' => 'Pharmacologie / Pharmaciens',
                            'titrePage' => 'Pharmaciens' ])

@section('content')
   <!-- Default box -->
      <div class="card">
        <div class="card-header">
           <h3 class="card-title">List des pharmaciens&nbsp;&nbsp;<button type="button" class="btn  btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-lg">Ajouter</button></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        @if($pharmaciens->isEmpty())
          <div class="alert alert-info alert-dismissible" style="text-align: center">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-info"></i> Alert!</h5>
                  Info alert preview. This alert is dismissable.
          </div>
        @else
        <div class="card-body p-2">
          <table class="table table-striped projects" id="example1">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 13%">
                          Nom - Prénom
                      </th>
                      <th style="width: 15%">
                          Email - Tél
                      </th>
                      <th style="width: 25%">
                          Hopital - Service
                      </th>
                      <th style="width: 15%" class="text-center">
                          Grade - Specialité
                      </th>
                      <th style="width: 1%"class="text-center">
                          Admin?
                      </th>
                      <th style="width: 30%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($pharmaciens as $phar)
                  <tr>
                      <td>
                          {{$phar->id}}
                      </td>
                      <td>
                          {{$phar->name}}
                          <br/>
                          <small>
                              {{$phar->naissance}} Tlemcen
                          </small>
                      </td>
                      <td>
                          {{$phar->mail}}
                          <br>
                          <small>
                              {{$phar->numero}}
                          </small>
                      </td>
                      <td>
                         {{$phar->hopital}}<br>
                         <small> {{$phar->service}} </small>
                      </td>
                      <td class="project-state">
                      	{{$phar->grade}}<br>
                         <small> {{$phar->spe}} </small>
                      </td>
                      <td>
                        @if($phar->admin == 0)
                          <span class="badge badge-danger">Non</span>
                        @else
                           <span class="badge badge-success">Oui</span>
                        @endif
                        
                      </td>
                      <td class="project-actions text-right">
                          <span class="btn btn-primary btn-sm" style="cursor: pointer;">
                              <i class="fas fa-folder">
                              </i>
                              Détail
                          </span>
                          <span class="btn btn-info btn-sm" style="cursor: pointer;">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Modi
                          </span>
                          <span class="btn btn-danger btn-sm" onclick="deleteLigne({{$phar->id}})" style="cursor: pointer;">
                              <i class="fas fa-trash">
                              </i>
                              Supp
                          </span>
                      </td>
                  </tr>
                  @endforeach

              </tbody>
          </table>
        </div>
        @endif
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
<form action="{{ route('addPharmacien') }}" method="post">
                            {{ csrf_field() }}
           <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ajouter un Pharmacien</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <div class="row">
        			<div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Information générale</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
            		<div class="form-group">
                <label for="">Nom Prénom</label>
                <input type="text" name="name" id="" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Adresse mail</label>
                <input type="mail" name="mail" id="" class="form-control">
              </div>

              <div class="form-group">
                <label for="">Numéro de téléphone</label>
                <input type="number" name="numero" id="" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Date de naissance</label>
                <input type="date" name="naissance" id="" class="form-control">
              </div>

              <div class="form-">
                <label for="inputDescription">Adresse</label>
                <textarea id="" name="adresse" class="form-control" rows="2"></textarea>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Détail</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="">Hopital</label>
                <input type="text" id="" value="Centre Hospitalier Tlemcen" class="form-control" disabled>
              </div>
              <div class="form-group">
                <label for="">Service</label>
                <input type="text" id="" value="Neurologie" class="form-control" disabled="true">
              </div>
             <div class="form-group">
                <label for="">Grade</label>
                <select class="form-control custom-select" name="grade">
                  <option selected disabled>Choisir un grade</option>
                  <option value="je sais pas">je sais pas</option>
                  <option value="Canceled">Canceled</option>
                  <option value="Success">Success</option>
                </select>
              </div>
               <div class="form-group">
                <label for="">Specialité</label>
                <select class="form-control custom-select" name="spe">
                  <option selected disabled>Choisir une specialité</option>
                  <option value="Neurologie">Neurologie</option>
                  <option value="Canceled">Canceled</option>
                  <option value="Success">Success</option>
                </select>
              </div>
              
              <div class="form-group">
              	
                    <label for="">Admin ?</label>
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input type="checkbox" name="admin" class="custom-control-input" id="customSwitch3" onchange="changeEtat()">
                      <label class="custom-control-label" for="customSwitch3"></label>
                      <span style="color: #9b111e" id="info"> 
                      La personne ajoutée aura lui acces a tout les fonctionnalités de l'application ! </span>
                    </div>
       
              </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        		</div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
              <input type="submit" class="btn btn-primary" value="Sauvegarder">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  </form>
@stop

@section('css')
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('/js/datatables/dataTables.bootstrap4.css') }}">
	<!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('/js/sweetalert2/sweetalert2.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('/js/toastr/toastr.min.css') }}">
@stop

@section('js')
	<!-- DataTables -->
	<script src="{{ asset('js/datatables/jquery.dataTables.js')}}"></script>
	<script src="{{ asset('js/datatables/dataTables.bootstrap4.js')}}"></script>
	<!-- SweetAlert2 -->
	<script src="{{ asset('js/sweetalert2/sweetalert2.min.js')}}"></script>
  <!-- Toastr -->
  <script src="{{ asset('js/toastr/toastr.min.js')}}"></script>

	<!-- page script -->
	<script>

      @if(session('message'))
          toastr.info('Un email est envoiyée');
          toastr.success('Pharmacien Ajoutée');
      @endif
		//data table
	  $(function () {
	    $("#example1").DataTable();
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false,
	    });
	  });
	   function deleteLigne(id){
		Swal.fire({
		    backdrop: `
		    rgba(255,0,0,0.4)
		  `,
		  title: 'Êtes-vous sûr?',
		  text: "Vous ne pourrez pas revenir en arrière!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#d33',
		  cancelButtonColor: '#3085d6',
		  confirmButtonText: 'Oui, supprimez-le!',
		  cancelButtonText:'Annuler'

		}).then((result) => {
		  if (result.value) {
		        $.ajax({
		                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		                url: "/deletePharmacien/"+id,
		                method : "POST",              
		                success: function(data){                  
		                  Swal.fire({
		                    title:'Supprimé!',
		                    text:'Le pharmacien a été supprimé..',
		                    type:'success',
		                     onClose :function () {
		                        //location.href = '';
		                      }
		                  }                   
		                  )           
		                },
		                error: function(data){
		                    Swal.fire({
		                      type: 'error',
		                      title: 'Oops...',
		                      text: 'Quelque chose a mal tourné!'
		                    })
		                  }
		              }); 
		  }
		})
		  }

		function changeEtat(){
			//alert("hah");
			if (document.getElementById("customSwitch3").checked == true) {
				document.getElementById("info").style.color = "#09b300";
			}
			else
				document.getElementById("info").style.color = "#9b111e";
		}


	</script>
@stop
