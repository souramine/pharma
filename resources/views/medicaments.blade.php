@extends('layouts.master', ['titre' => 'Médicaments', 
                            'nomPage' => 'Management / Médicaments',
                            'titrePage' => 'Médicaments' ])

@section('content')
   <!-- Default box -->
      <div class="card">
        <div class="card-header">
           <h3 class="card-title">List des médicaments&nbsp;&nbsp;
            @if(Auth::user()->admin == 1)
            <button type="button" class="btn  btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-default">Ajouter</button>
            @endif
            </h3>

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
                         @if(isset($m->solvant))
                          {{$m->solvant}}
                          @else
                            <strong style="text-align:center; color: red"> X</strong>  
                          @endif
                      </td>
                      <td>
                        @if(isset($m->solvant))
                           {{$m->volume}}&nbsp;{{$m->unite_volume}}
                          @else
                            <strong style="text-align:center; color: red"> X</strong>  
                          @endif
                       
                      </td>
                      <td>
                        {{$m->voie}}
                      </td>
                      <td class="project-actions text-right">
                          <span class="btn btn-primary btn-sm" onclick="afficheDetail({{$m->id}})" style="cursor: pointer;">
                              <i class="fas fa-folder">
                              </i>
                              Détail
                          </span>
                          @if(Auth::user()->admin == 1)
                          <span class="btn btn-info btn-sm" style="cursor: pointer;"onclick="modifMedi({{$m->id}})">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Modi
                          </span>
                          @endif
                          @if(Auth::user()->admin == 1)
                          <span class="btn btn-danger btn-sm" style="cursor: pointer;" onclick="deleteLigne({{$m->id}})">
                              <i class="fas fa-trash">
                              </i>
                              Supp
                          </span>
                          @endif
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
                <input type="text" name="nom" id="" class="form-control" required>
              </div>
              <div class="form-group" >
                <label for="">Famille</label>
                <select class="form-control custom-select" name="famille" required>
                  <option selected disabled>Choisir une famille</option>
                  <option value="Antibiotique">Antibiotique</option>
                  <option value="Canceled">Solution</option>
                  <option value="Success">Comprimer</option>
                </select>
              </div>
               <div class="form-group" id="">
                <label for="">Voie</label>
                <select class="form-control custom-select" name="voie" required>
                  <option selected disabled>Choisir une voie</option>
                  <option value="Orale">Orale</option>
                  <option value="Canceled">Solution</option>
                  <option value="Success">Comprimer</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Forme</label>
                <select class="form-control custom-select" name="forme" id="forme" onchange="changeForme()" required>
                  <option selected disabled>Choisir une forme</option>
                  <option value="Poudre">Poudre</option>
                  <option value="Canceled">Solution</option>
                  <option value="Success">Comprimer</option>
                </select>
              </div>
            
	              <div class="form-group form-inline">
		                <label for="">Dosage&nbsp;</label> 
		                <input type="number" name="dosage" style="text-align: center" id="" class="form-control col-md-4" required>  
		                <label for="">&nbsp;&nbsp;&nbsp;Unité&nbsp;</label>
		                
		               <select class="form-control custom-select col-md-5" name="unite" required="true">
	                  <option selected disabled>Choisir une unité</option>
	                  <option value="MG">MG</option>
	                  <option value="KG">KG</option>
	                  <option value="G">G</option>
	                </select>
	              </div>
	
              
               <div class="form-group form-inline" hidden="true" id="vol">
		                <label for="">Volume</label> 
		                <input type="number" name="volume" style="text-align: center" id="" class="form-control col-md-4" >  
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

  <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Détail Médicament</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <div class="row">
              <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Détail</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                <label for="">Nom du produit</label>
                <input type="text" name="" id="nom"  disabled class="form-control">
              </div>
              <div class="form-group" >
                <label for="">Famille</label>
                <input type="text" name="" id="famille"  disabled class="form-control">
              </div>
               <div class="form-group" id="">
                <label for="">Voie</label>
                <input type="text" name="" id="voie"  disabled class="form-control">
              </div>
              <div class="form-group">
                <label for="">Forme</label>
                 <input type="text" name="" id="forme_detail"  disabled class="form-control">
              </div>
            
                <div class="form-group form-inline">
                    <label for="">Dosage&nbsp;</label> 
                    <input type="text" name="" style="text-align: center" id="dosage" disabled class="form-control col-md-4">  
                    <label for="">&nbsp;&nbsp;&nbsp;Unité&nbsp;</label>
                    
                 <input type="text" name="" style="text-align: center" id="unite" disabled class="form-control col-md-5">  
                </div>
  
              
               <div class="form-group form-inline" id="vol_detail">
                    <label for="">Volume</label> 
                    <input type="text" name="" style="text-align: center" id="volume" disabled class="form-control col-md-4">  
                    <label for="">&nbsp;&nbsp;&nbsp;Unité&nbsp;</label>
                     <input type="text" name="" style="text-align: center" id="unite_volume" disabled class="form-control col-md-5"> 
                   
                </div>
                <div class="form-group" id="sol_detail">
                <label for="">Solvant</label>
                 <input type="text" name="" id="solvant"  disabled class="form-control">
              </div>
              
              

              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary"  data-dismiss="modal">Quitter</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <form action="{{ route('mofiMedicaments') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id">
           <div class="modal fade" id="modal-modi">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Modifier un Médicament</h4>
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
                <input type="text" name="nom_modif" id="nom_modif" class="form-control">
              </div>
              <div class="form-group" >
                <label for="">Famille</label>
                <select class="form-control custom-select" name="famille_modif" id="famille_modif">
                  <option value="Antibiotique">Antibiotique</option>
                  <option value="Canceled">Solution</option>
                  <option value="Success">Comprimer</option>
                </select>
              </div>
               <div class="form-group" id="">
                <label for="">Voie</label>
                <select class="form-control custom-select" name="voie_modif" id="voie_modif">
                  <option value="Orale">Orale</option>
                  <option value="Canceled">Solution</option>
                  <option value="Success">Comprimer</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Forme</label>
                <select class="form-control custom-select" name="forme_modif" id="forme_modif" onchange="changeFormee()">
                  <option value="Poudre">Poudre</option>
                  <option value="Canceled">Solution</option>
                  <option value="Success">Comprimer</option>
                </select>
              </div>
            
                <div class="form-group form-inline">
                    <label for="">Dosage&nbsp;</label> 
                    <input type="number" name="dosage_modif" style="text-align: center" id="dosage_modif" class="form-control col-md-4">  
                    <label for="">&nbsp;&nbsp;&nbsp;Unité&nbsp;</label>
                    
                   <select class="form-control custom-select col-md-5" name="unite_modif" id="unite_modif">
                    <option selected disabled>Choisir une unité</option>
                    <option value="MG">MG</option>
                    <option value="KG">KG</option>
                    <option value="G">G</option>
                  </select>
                </div>
  
              
               <div class="form-group form-inline" hidden="true" id="vol_modif">
                    <label for="">Volume</label> 
                    <input type="number" name="volume_modif" style="text-align: center" id="volume_modif" class="form-control col-md-4">  
                    <label for="">&nbsp;&nbsp;&nbsp;Unité&nbsp;</label>
                    
                   <select class="form-control custom-select col-md-5" name="unite_vol_modif" id="unite_vol_modif">
                    <option selected disabled>Choisir une unité</option>
                    <option value="ML">ML</option>
                    <option value="KG">KG</option>
                    <option value="G">G</option>
                  </select>
                </div>
                <div class="form-group" hidden="true" id="sol_modif">
                <label for="">Solvant</label>
                <select class="form-control custom-select" name="solvant_modif" id="solvant_modif">
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
              <input type="submit" class="btn btn-primary" value="Mettre a jour">
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
    function menuApp(){

      document.getElementById("top").className = "nav-item has-treeview menu-open";

      document.getElementById("dash").className = "nav-link";
      document.getElementById("management").className = "nav-link active";
      document.getElementById("medicaments").className = "nav-link active";
      document.getElementById("fournisseur").className = "nav-link";
      document.getElementById("pharmacien").className = "nav-link";
      document.getElementById("achats").className = "nav-link";
      document.getElementById("ventes").className = "nav-link";
      document.getElementById("profile").className = "nav-link";
      document.getElementById("off").className = "nav-link";
    }
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

    function changeFormee(){
      var forme = document.getElementById('forme_modif').value ;
      if (forme == 'Poudre') {
        document.getElementById('sol_modif').hidden = false;
        document.getElementById('vol_modif').hidden = false;
      }else{
        document.getElementById('sol_modif').hidden = true;
        document.getElementById('vol_modif').hidden = true;
      }
    }

      @if(session('message'))
          toastr.success('Medicament Ajoutée');
      @endif
       @if(session('message2'))
          toastr.success('Medicament Modifier');
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

     function afficheDetail(id){
        $.ajax({
                    url: "/detail/medi/"+id,
                    method : "get",   
                    data: {
                    "_token": "{{ csrf_token() }}"
                    } ,        
                    success: function(data){   
                      var myModal = $('#modal-detail');
                        document.getElementById('nom').value = Object.values(data[0])[1];
                        document.getElementById('famille').value = Object.values(data[0])[8];
                        document.getElementById('voie').value = Object.values(data[0])[9] ;
                        document.getElementById('forme_detail').value = Object.values(data[0])[4] ;
                        document.getElementById('dosage').value = Object.values(data[0])[2] ;
                        document.getElementById('unite').value = Object.values(data[0])[3] ;
                         if (Object.values(data[0])[4] != 'Poudre') {
                           document.getElementById('vol_detail').hidden =true;
                           document.getElementById('sol_detail').hidden =true;
                         } else{
                          document.getElementById('vol_detail').hidden =false;
                           document.getElementById('sol_detail').hidden =false;
                           document.getElementById('volume').value = Object.values(data[0])[6] ;
                        document.getElementById('unite_volume').value = Object.values(data[0])[7] ;
                        document.getElementById('solvant').value = Object.values(data[0])[5] ;
                         }
                        myModal.modal({ show: true });        
                                
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

     function modifMedi(id){
        $.ajax({
                    url: "/getMedicaments/"+id,
                    method : "post",   
                    data: {
                    "_token": "{{ csrf_token() }}"
                    } ,        
                    success: function(data){   

                        var myModal = $('#modal-modi');
                        document.getElementById('id').value = Object.values(data[0])[0];
                        document.getElementById('nom_modif').value = Object.values(data[0])[1];
                        document.getElementById('famille_modif').value = Object.values(data[0])[8];
                        document.getElementById('voie_modif').value = Object.values(data[0])[9];
                        document.getElementById('forme_modif').value = Object.values(data[0])[4];
                        document.getElementById('dosage_modif').value = Object.values(data[0])[2] ;
                        document.getElementById('unite_modif').value = Object.values(data[0])[3];

                        if (Object.values(data[0])[4] != 'Poudre') {
                           document.getElementById('vol_modif').hidden =true;
                           document.getElementById('sol_modif').hidden =true;
                         } else{
                          document.getElementById('vol_modif').hidden =false;
                           document.getElementById('sol_modif').hidden =false;

                           document.getElementById('volume_modif').value = Object.values(data[0])[6] ;
                        document.getElementById('unite_vol_modif').value = Object.values(data[0])[7] ;
                        document.getElementById('solvant_modif').value = Object.values(data[0])[5] ;
                           }
                        myModal.modal({ show: true });        
                                
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
  </script>
@stop
