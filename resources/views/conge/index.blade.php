<style>

    .d-flex{
        display: flex;
        justify-content: space-between;
    }

    .profil-card{
        width: 100%;
        background: #ffffff;
        border-radius:14px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        overflow: hidden;
        font-family: "Segoe UI", sans-serif;
    }

    .card-header{
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        padding: 1.2rem;
        color: white;
    }

    .last-name {
        font-size: 1.05rem;
        margin: 0;
        font-weight: 700;
        text-transform: uppercase;  
    }

    .first-name {
        font-size: 0.85rem;
        margin: 0;
        opacity: 0.85;
    }

    /* Body */
    .card-body {
        padding: 1rem;
    }

    .info-group {
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
    }

    .info-label {
        color: #6c757d;
    }

    .info-value {
        font-weight: 600;
    }

    /* Statuts */
    .status-badge {
        padding: 0.25rem 0.6rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Statut : En attente */
    .status-badge.pending {
        background: #fff3cd;
        color: #856404;
    }

    /* Statut : Approuvé */
    .status-badge.approved {
        background: #d4edda;
        color: #155724;
    }

    /* Statut : Refusé */
    .status-badge.rejected {
        background: #f8d7da;
        color: #721c24;
    }

    .status{
        width: 6rem;
        background: rgb(105, 38, 38);
        color:blue;
        height:2rem;
        text-align: center;
        border-radius: 5px;
    }

    .status-refus{
        width: 6rem;
        background: rgb(255, 0, 0);
        color:rgb(255, 255, 255);
        height:2rem;
        text-align: center;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .status-accept{
        width: 6rem;
        background: rgb(50, 241, 2);
        color:rgb(255, 255, 255);
        height:2rem;
        text-align: center;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .conge{
        margin-top: 2rem;
        width: 100%;
        display: grid;
        grid-template-columns: repeat(4,4fr);
        gap: 2rem;
        justify-content: center;
    }

    .histo{
        margin-top: 2rem;
    }

    .dn{
        display : none;
    }
    
    .historique{
        display:none;
    }

    .title{
        font-size: 1.2rem;
    }

</style>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const history = document.getElementById('history');
        const historique = document.getElementById('historique');
        const conge = document.getElementById('conge');
        const title = document.getElementById('title');

        if (history) {
            history.addEventListener('click', () => {
                if(historique.classList.contains('historique')){
                    historique.classList.remove('historique');
                    historique.classList.add('histo');
                    conge.classList.remove('conge');
                    conge.classList.add('dn');
                    history.textContent="Demande";
                    title.textContent="Liste des employés en congées";
                } else {
                    historique.classList.add('historique');
                    conge.classList.remove('dn');
                    conge.classList.add('conge');
                    history.textContent = "Historique";
                    title.textContent="Liste des employés en congées";
                    
                }
            });
        }

    });

</script>

<x-app-layout>
    

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="d-flex">
                        <h1 class="title" id="title">Liste des demandes congé</h1>
                        <div class="button">
                            <button id="history" class="btn btn-info">
                                Historique
                            </button>
                            <button type="button" class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#congeModal">
                                Insérer
                            </button>
                        </div>
                        
                        
                     
                        <div class="modal fade" id="congeModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Demandes congée</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    

                                    <!-- FORMULAIRE UNIQUE PAR MODAL -->
                                    <form id="editForm"  action="{{ route('module.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                    
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Nom</label>
                                                <select name="employee_id" id="" class="form-control">
                                                    <option value=""></option>
                                                    @if ($user->isEmpty())
                                                        <option value="">
                                                            Aucune employée trouvée
                                                        </option>

                                                        
                                                    @else
                                                
                                                        
                                                        @foreach ($user as $u)
                                                            <option value="{{ $u->id }}">{{ $u->last_name }} {{ $u->first_name }}</option>
                                                        @endforeach
                                                   
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label>Type de congé</label>
                                                <select name="type" id="" class="form-control">
                                                    <option value=""></option>
                                                    @if ($type->isEmpty())
                                                        <option value="">
                                                            Aucune type de congée trouvée
                                                        </option>

                                                        
                                                    @else
                                                
                                                        
                                                        @foreach ($type as $t)
                                                            <option value="{{ $t->name }}">{{ $t->name}}</option>
                                                        @endforeach
                                                   
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label>Date début</label>
                                                <input type="date" class="form-control" id="edit_name" name="start_date"  value="">
                                            </div>
                                            <div class="mb-3">
                                                <label>Date fin</label>
                                                <input type="date" class="form-control" id="edit_name" name="end_date"  value="">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label>Pièce justificatif</label>
                                                <input type="file" class="form-control" id="edit_name" name="file"  value="">
                                            </div>     

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Ajouter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>           
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Affichage des erreurs -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                             <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        @if($conge -> isEmpty())
                            Aucune congé insérer à voire
                        @else
                            <div id="conge" class="conge">
                                @foreach ($conge as $c)
                                    <div class="profil-card">
                                        <div class="card-header">
                                            <h1 class="last-name">{{ $c->employee->last_name }}</h1>
                                            <p class="first-name">{{ $c->employee->first_name }}</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="info-group">
                                                <div class="info-item">
                                                    <span class="info-label">
                                                        Type
                                                    </span>
                                                    <span class="info-value">
                                                        {{ $c->type }}
                                                    </span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">
                                                        Début
                                                    </span>
                                                    <span class="info-value">
                                                        {{ $c->start_date }}
                                                    </span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">
                                                        Fin
                                                    </span>
                                                    <span class="info-value">
                                                        {{ $c->end_date }}
                                                    </span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">
                                                        Date de demande
                                                    </span>
                                                    <span class="info-value">
                                                        {{ $c->created_at }}
                                                    </span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Statut</span>
                                                    @if ($c->status === "En attente")
                                                        <button type="button" class="btn btn-dark"  data-bs-toggle="modal" data-bs-target="#valider{{ $c->id }}">
                                                            En attente
                                                        </button>
                                                    @else
                                                        @if ($c->status === "refuse")
                                                            <div class="status-refus">
                                                                Réfusé
                                                            </div>
                                                        @elseif($c->status === "accepte")
                                                            <div class="status-accept">
                                                                Accepté
                                                            </div>
                                                        @endif
                                                        
                                                    @endif
                                                     
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="valider{{ $c->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                
                                                

                                                <!-- FORMULAIRE UNIQUE PAR MODAL -->
                                                <form id="editForm"  action="{{ route('status.valid', $c->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label class="form-label">Décision</label>

                                                        <div class="btn-group w-100" role="group">

                                                            <input type="radio" class="btn-check" name="status" id="accept{{ $c->id }}"
                                                                value="accepte" autocomplete="off" required>

                                                            <label class="btn btn-outline-success" for="accept{{ $c->id }}">
                                                                <i class="fa-solid fa-check"></i> Accepté
                                                            </label>

                                                            <input type="radio" class="btn-check" name="status" id="refuse{{ $c->id }}"
                                                                value="refuse" autocomplete="off">

                                                            <label class="btn btn-outline-danger" for="refuse{{ $c->id }}">
                                                                <i class="fa-solid fa-xmark"></i> Refusé
                                                            </label>

                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary w-100">
                                                        Valider
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                   
                                @endforeach
                                    
                            </div>
                            
                            
                        @endif
                    
                    @if ($valid -> isEmpty())
                        Aucune demande validé
                    @else
                        <div id="historique" class="historique">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-success text-center">
                                    <tr>
                                            {{-- <th>#</th> --}}
                                        <th>Employé</th>
                                        <th>Type de congé</th>
                                        <th>Date début</th>
                                        <th>Date fin</th>
                                        <th>Durée</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($valid as $con)
                                        @if ($con->status === "accepte")

                                            <tr>    

                                                <td>
                                                    {{ $con->employee->last_name }} {{ $con->employee->first_name }}

                                                </td>
                                                <td>
                                                    {{ $con->type }}

                                                </td>
                                                <td>
                                                    {{ $con->start_date }}

                                                </td>
                                                <td>
                                                    {{ $c->end_date }}

                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($con->start_date)
                                                        ->diffInDays(\Carbon\Carbon::parse($con->end_date)) + 1 }} jours

                                                </td>
                                                
                                            </tr>
                                        @endif
                                           
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                            
                            
                    @endif


                </div>
                        
            </div>
        </div>
    </div>
</x-app-layout>