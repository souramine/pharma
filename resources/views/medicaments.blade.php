@extends('layouts.master', ['titre' => 'Médicaments', 
                            'nomPage' => 'Pharmacologie / Médicaments',
                            'titrePage' => 'Médicaments' ])

@section('content')
   <!-- Default box -->
      <div class="card">
        <div class="card-header">
           <h3 class="card-title">List des médicaments&nbsp;&nbsp;<button type="button" class="btn  btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-default">Ajouter</button></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        @if($medicaments->isEmpty())
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
                      <th style="width: 25%">
                          Nom - Famille
                      </th>
                      <th style="width: 10%">
                          Dosage
                      </th>
                      <th style="width: 10%">
                          Forme
                      </th>
                      <th style="width: 10%">
                          Solvant
                      </th>
                      <th style="width: 10%" class="text-center">
                          Volume
                      </th>
                      <th style="width: 10%" class="text-center">
                          Voie
                      </th>
                      <th style="width: 40%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($medicaments as $m)
                  <tr>
                      <td>
                          {{$m->id}}
                      </td>
                      <td>
                          {{$m->nom}}

                          (<small>{{$m->famille}}</small>)
                      </td>
                      <td>
                          {{$m->dosage}}&nbsp;{{$m->unite}}
                      </td>
                      <td>
                          {{$m->forme}}
                      </td>
                      <td>
                         {{$m->solvant}}  
                      </td>
                      <td>
                        {{$m->volume}}&nbsp;{{$m->unite_volume}}
                      </td>
                      <td>
                        {{$m->voie}}
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
                          <span class="btn btn-danger btn-sm" style="cursor: pointer;" onclick="deleteLigne({{$m->id}})">
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
<form action="{{ route('addMedicaments') }}" method="post">
                            {{ csrf_field() }}
           <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ajouter un Médicament</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <div class="row">
              <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Tout les champs sont obligatoire</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                <label for="">Nom du produit</label>
                <input type="text" name="nom" id="" class="form-control">
              </div>
              <div class="form-group" >
                <label for="">Famille</label>
                <select class="form-control custom-select" name="famille">
                  <option selected disabled>Choisir une famille</option>
                  <option value="Antibiotique">Antibiotique</option>
                  <option value="Canceled">Solution</option>
                  <option value="Success">Comprimer</option>
                </select>
              </div>
               <div class="form-group" id="">
                <label for="">Voie</label>
                <select class="form-control custom-select" name="voie">
                  <option selected disabled>Choisir une voie</option>
                  <option value="Orale">Orale</option>
                  <option value="Canceled">Solution</option>
                  <option value="Success">Comprimer</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Forme</label>
                <select class="form-control custom-select" name="forme" id="forme" onchange="changeForme()">
                  <option selected disabled>Choisir une forme</option>
                  <option value="Poudre">Poudre</option>
                  <option value="Canceled">Solution</option>
                  <option value="Success">Comprimer</option>
                </select>
              </div><br>
            
	              <div class="form-group form-inline">
		                <label for="">Dosage&nbsp;</label> 
		                <input type="number" name="dosage" style="text-align: center" id="" class="form-control col-md-4">  
		                <label for="">&nbsp;&nbsp;&nbsp;Unité&nbsp;</label>
		                
		               <select class="form-control custom-select col-md-5" name="unite">
	                  <option selected disabled>Choisir une unité</option>
	                  <option value="MG">MG</option>
	                  <option value="KG">KG</option>
	                  <option value="G">G</option>
	                </select>
	              </div>
	
              
               <div class="form-group form-inline" hidden="true" id="vol">
		                <label for="">Volume</label> 
		                <input type="number" name="volume" style="text-align: center" id="" class="form-control col-md-4">  
		                <label for="">&nbsp;&nbsp;&nbsp;Unité&nbsp;</label>
		                
		               <select class="form-control custom-select col-md-5" name="unite_vol">
	                  <option selected disabled>Choisir une unité</option>
	                  <option value="ML">ML</option>
	                  <option value="KG">KG</option>
	                  <option value="G">G</option>
	                </select>
	              </div>
	              <div class="form-group" hidden="true" id="sol">
                <label for="">Solvant</label>
                <select class="form-control custom-select" name="solvant">
                  <option selected disabled>Choisir un solvant</option>
                  <option value="Nacl 0.9%">Nacl 0.9%</option>
                  <option value="Canceled">Solution</option>
                  <option value="Success">Comprimer</option>
                </select>
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
  	//change forme
  	function changeForme(){
  		var forme = document.getElementById('forme').value ;
  		if (forme == 'Poudre') {
  			document.getElementById('sol').hidden = false;
  			document.getElementById('vol').hidden = false;
  		}else{
  			document.getElementById('sol').hidden = true;
  			document.getElementById('vol').hidden = true;
  		}
  	}

      @if(session('message'))
          toastr.success('Medicament Ajoutée');
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
                    url: "/medicaments/delete/"+id,
                    method : "POST",   
                    data: {
                    "_token": "{{ csrf_token() }}"
                    } ,        
                    success: function(data){            
                      Swal.fire({
                        title:'Supprimé!',
                        text:'Le medicament a été supprimé..',
                        type:'success',
                         onClose :function () {
                            window.location.reload();
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
  </script>
@stop
