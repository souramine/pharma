@extends('layouts.master', ['titre' => 'Vente', 
                            'nomPage' => 'Pharmacologie / Vente',
                            'titrePage' => 'Vente' ])

@section('content')
   <!-- Default box -->
      <div class="card">
        <div class="card-header">
           <h3 class="card-title">List des ventes&nbsp;&nbsp;<button type="button" class="btn  btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-default">Ajouter</button></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        @if($ventes->isEmpty())
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
                      <th style="width: 30%">
                          Nom de Médicament
                      </th>
                      <th style="width: 20%">
                          Id.prescription
                      </th>
                      <th style="width: 6%">
                          Prix
                      </th>
                      <th style="width: 10%">
                          Q.vendu
                      </th>
                      <th style="width: 10%">
                          D.vente
                      </th>
                      <th style="width: 15%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($ventes as $v)
                  <tr>
                      <td>
                          {{$v->id}}
                      </td>
                      <td> <a href="#">
                          {{DB::table('medicaments')
                          ->join('lot','medicaments.id','lot.medicament_id')
                          ->where('lot.id',$v->lot_id)
                          ->pluck('nom')
                          ->first()
                          }}
                          {{DB::table('medicaments')
                          ->join('lot','medicaments.id','lot.medicament_id')
                          ->where('lot.id',$v->lot_id)
                          ->pluck('forme')
                          ->first()
                          }}
                          {{DB::table('medicaments')
                          ->join('lot','medicaments.id','lot.medicament_id')
                          ->where('lot.id',$v->lot_id)
                          ->pluck('dosage')
                          ->first()
                          }}
                          {{DB::table('medicaments')
                          ->join('lot','medicaments.id','lot.medicament_id')
                          ->where('lot.id',$v->lot_id)
                          ->pluck('unite')
                          ->first()
                          }}
                          {{DB::table('medicaments')
                          ->join('lot','medicaments.id','lot.medicament_id')
                          ->where('lot.id',$v->lot_id)
                          ->pluck('volume')
                          ->first()
                          }}
                          {{DB::table('medicaments')
                          ->join('lot','medicaments.id','lot.medicament_id')
                          ->where('lot.id',$v->lot_id)
                          ->pluck('unite_volume')
                          ->first()
                          }}
                          </a>
                      </td>  
                      <td>
                        {{$v->id_prescription}}
                      </td>                
                      <td>
                          {{$v->prix}} DA
                      </td>
                      <td>
                         {{$v->quantite_vendu}}  
                      </td>
                      <td>
                        {{$v->date_vente}}
                      </td>
                       
                      <td class="project-actions text-right">
                          <span class="btn btn-primary btn-sm" onclick="afficheDetail({{$v->id}})" style="cursor: pointer;">
                              <i class="fas fa-eye"></i>
                          </span>
                          <span class="btn btn-info btn-sm" style="cursor: pointer;">
                              <i class="fas fa-pencil-alt"></i>
                          </span>
                          <span class="btn btn-danger btn-sm" style="cursor: pointer;" onclick="deleteLigne({{$v->id}})">
                              <i class="fas fa-trash"></i>
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
<form action="{{ route('addVente') }}" method="post">
                            {{ csrf_field() }}
           <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ajouter une vente</h4>
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
                <label for="">Nom du médicament ou nom du DCI</label>
                <input type="text" required name="medicament" id="medicament_nom" class="form-control">
                <input type="hidden" name="medicament_id" id="medicament_id">
              </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Prix Total de vente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="number"  required step="0.01" name="prix" style="text-align: center" id="" class="form-control col-md-7">    
                </div>

                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Quantité vendu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="number" required name="quantite_vendu" style="text-align: center" id="quantite_vendu" class="form-control col-md-7">    
                </div>
	              <div class="form-group form-inline">
		                <label for="">&nbsp;&nbsp;&nbsp;Date de vente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
		                <input type="date" required name="date_v" style="text-align: center" id="" class="form-control col-md-7">    
	              </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Prescription&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text" required name="id_prescription" style="text-align: center" id="" class="form-control col-md-7">    
                </div>
                <div class="form-">
                <label for="inputDescription">Remarque</label>
                <textarea id="" name="remarque" class="form-control" rows="2"></textarea>
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

  <div class="modal fade" id="modal-view">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Détail de la vente</h4>
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
                <label for="">Nom du médicament ou nom du DCI</label>
                <input type="text" disabled name="" id="medicament_nom_view" class="form-control">
              </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Prix Total de vente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text"  disabled name="" style="text-align: center" id="prix_view" class="form-control col-md-7">    
                </div>

                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Quantité vendu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text" disabled name="" style="text-align: center" id="quantite_vendu_view" class="form-control col-md-7">    
                </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Date de vente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text" disabled name="" style="text-align: center" id="dateV_view" class="form-control col-md-7">    
                </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Prescription&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text" disabled name="id_prescription" style="text-align: center" id="prescription_view" class="form-control col-md-7">    
                </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Vente ajouter par&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <a href="" disabled style="text-align: center;background-color: #b6fcd5" id="pharmacien_view" class="form-control col-md-7"> </a>   
                </div>
                <div class="form-">
                <label for="inputDescription">Remarque</label>
                <textarea id="remarque_view" disabled name="" class="form-control" rows="2"></textarea>
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
@stop

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/js/datatables/dataTables.bootstrap4.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('/js/sweetalert2/sweetalert2.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('/js/toastr/toastr.min.css') }}">
  <!-- jquery-ui.css-->
  <link rel="stylesheet" href="{{ asset('/css/jquery-ui/jquery-ui.css') }}">
@stop

@section('js')
  <!-- DataTables -->
  <script src="{{ asset('js/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{ asset('js/datatables/dataTables.bootstrap4.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{ asset('js/sweetalert2/sweetalert2.min.js')}}"></script>
  <!-- Toastr -->
  <script src="{{ asset('js/toastr/toastr.min.js')}}"></script>

  <script src="{{ asset('/js/jquery/jquery-ui.min.js')}}"></script> 

  <!-- page script -->
  <script>
      @if(session('message'))
          toastr.success('Vente ajoutée');
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
                    url: "/vente/delete/"+id,
                    method : "POST",   
                    data: {
                    "_token": "{{ csrf_token() }}"
                    } ,        
                    success: function(data){            
                      Swal.fire({
                        title:'Supprimé!',
                        text:'Le vente a été supprimé..',
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
        //get médicament name
        $('input[id="medicament_nom"]').keydown(function() { 
        $(this).autocomplete({
          appendTo: $(this).parent(), // selectionner l'element pour ajouter la liste des suggestion
          source: function( request, response ) {
              $.ajax( {
                url: "/medicament",
                method : "POST",
                data: {
                  "_token": "{{ csrf_token() }}",
                  phrase: request.term // value on field input
                },
                success: function( data , status , code ) {
                    response($.map(data.slice(0, 15), function (item) { // slice cut number of element to show
                      return {
                          label : item.nom +" "+ item.dosage+""+ item.unite+ " "+item.forme+" "+item.volume+""+item.unite_volume, // pour afficher dans la liste des suggestions
                          value:  item.nom +" "+ item.dosage+""+ item.unite+ " "+item.forme+" "+item.volume+""+item.unite_volume, // value c la valeur à mettre dans l'input this
                          id:  item.id // récupérer id du médicament
                      };
                  }));
                }
              });
            },// END SOURCE
            select: function( event, ui ) {
              $.ajax({
                    url: "/vente/checkMedicament/"+ui.item.id,
                    method : "POST",   
                    data: {
                    "_token": "{{ csrf_token() }}"
                    } ,        
                    success: function(data){
                    if (data == "rien") {
                      //$("#medicament_nom").empty();
                      document.getElementById('medicament_nom').value = '';
                      Swal.fire({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Médicament non acheter encore!',
                          footer: '<a href="{{(route('achats.index'))}}">Achetez un médicament</a>'
                        })
                    } 
                    else{
                      $("#medicament_id").attr("value",data[1]);
                      document.getElementById("quantite_vendu").placeholder = "quantité restante = "+data[0];
                    }                    
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

          }).data("ui-autocomplete")._renderItem = function (ul, item) {//cette method permet de gérer l'affichage de la liste des suggestions
                 return $("<li style='cursor: pointer;background-color:#d2efee;'></li>")
                     .data("item.autocomplete", item)//récupérer les donnée de l'autocomplete
                     //.attr("data-value", item.id )
                     .append(item.label)//ajouter à la liste de suggestions
                     .appendTo(ul); 
                 };
      });

        //get fournisseur name
        $('input[id="fournisseur_nom"]').keydown(function() { 
        $(this).autocomplete({
          appendTo: $(this).parent(), // selectionner l'element pour ajouter la liste des suggestion
          source: function( request, response ) {
              $.ajax( {
                url: "/fournisseur",
                method : "POST",
                data: {
                  "_token": "{{ csrf_token() }}",
                  phrase: request.term // value on field input
                },
                success: function( data , status , code ) {
                    response($.map(data.slice(0, 15), function (item) { // slice cut number of element to show
                      return {
                          label : item.name +">>>>>"+ item.mail, // pour afficher dans la liste des suggestions
                          value:  item.name +">>>>>"+ item.mail, // value c la valeur à mettre dans l'input this
                          id:  item.id // récupérer id du médicament
                      };
                  }));
                }
              });
            },// END SOURCE
            select: function( event, ui ) {
              $("#fournisseur_id").attr("value",ui.item.id);
            }

          }).data("ui-autocomplete")._renderItem = function (ul, item) {//cette method permet de gérer l'affichage de la liste des suggestions
                 return $("<li style='cursor: pointer;'></li>")
                     .data("item.autocomplete", item)//récupérer les donnée de l'autocomplete
                     //.attr("data-value", item.id )
                     .append(item.label)//ajouter à la liste de suggestions
                     .appendTo(ul); 
                 };
      });


        function afficheDetail(id){
    $.ajax({
                    url: "/detail/vente/"+id,
                    method : "get",   
                    data: {
                    "_token": "{{ csrf_token() }}"
                    } ,        
                    success: function(data){   
                        //alert(Object.keys(data[1])[2]); 
                        var myModal = $('#modal-view');
                        document.getElementById('medicament_nom_view').value = Object.values(data[3])[1] +" "+ Object.values(data[3])[4] +" "+ Object.keys(data[3])[2] +" "+Object.values(data[3])[3] +" "+Object.values(data[3])[6] +" "+Object.values(data[3])[7];
                        document.getElementById('prix_view').value = Object.values(data[0])[3] +" DA" ;
                        document.getElementById('quantite_vendu_view').value = Object.values(data[0])[2] ;
                        document.getElementById('dateV_view').value = Object.values(data[0])[1] ;
                        document.getElementById('prescription_view').value = Object.values(data[0])[4] ;
                        document.getElementById('remarque_view').value = Object.values(data[0])[5] ;
                        document.getElementById('pharmacien_view').innerHTML = Object.values(data[1])[1] ;

                        document.getElementById("pharmacien_view").href = "/detail/pharmacien/"+Object.values(data[1])[0];

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
