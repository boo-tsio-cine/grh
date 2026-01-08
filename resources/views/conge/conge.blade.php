<style>

    .d-flex{
        display: flex;
        justify-content: space-between;
    }

    .show{
        width: 100%;
        margin-top: 2rem;
    }

    .item{
        width: 100%;
        padding: 1rem 2rem;
        box-shadow: 0px 0px 1px black;
    }

    .item h1{
        font-weight: bold;
        list-style: circle;
    }

    .item p{
        padding-left: 2rem;
    }

    .button {
        margin-top: 1rem;
        display: flex;
        gap: 2rem;
        justify-content: center;
    }

    .button button{
        width: 8rem;
        height: 3rem;
    }

</style>

<x-app-layout>
    

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="d-flex">
                        <h1>Liste des congé</h1>
                        <button type="button" class="btn btn-dark"  data-bs-toggle="modal" data-bs-target="#congeModal">
                            Insérer
                        </button>
                     
                        <div class="modal fade" id="congeModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Ajouter congée</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    

                                    <!-- FORMULAIRE UNIQUE PAR MODAL -->
                                    <form id="editForm"  action="{{ route('conge.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                    
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label>Nom</label>
                                                <input type="text" class="form-control" id="edit_name" name="name"  value="">
                                            </div>

                                            <div class="mb-3">
                                                <label>Date maximum</label>
                                                <input type="number" class="form-control" id="edit_name" name="max_days"  value="">
                                            </div>

                                            <input type="hidden" name="id_employee">

                                            <div class="mb-3">
                                                <label>Description</label>
                                                <textarea class="form-control" id="edit_descri" name="description"  value=""></textarea>
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
                    <div class="show">
                        @if($conge -> isEmpty())
                            Aucune congé à voire
                        @else
                            <ol type="1">
                                @foreach ($conge as $c)
                                    <li class="item">
                                        
                                        <h1>{{ $c->name }}</h1>
                                        
                                        <p>
                                            Durée maximum : {{ $c->max_days }} jours
                                        </p>
                                        <p>
                                            Desctiption : {{ $c->description }}
                                        </p>
                                        <div class="button">
                                            <button type="button" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#modifModal{{ $c->id }}">
                                                Modifier
                                            </button>
                                            <form 
                                                action="{{ route('congee.destroy', $c->id )}}" 
                                                method="post"
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer?');"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                        <div class="modal fade" id="modifModal{{ $c->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Ajouter congée</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    

                                                    <!-- FORMULAIRE UNIQUE PAR MODAL -->
                                                    <form id="editForm"  action="{{ route('congee.mod', $c->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label>Nom</label>
                                                                <input type="text" class="form-control" id="edit_name" name="name"  value="{{ $c->name }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label>Date maximum</label>
                                                                <input type="text" class="form-control" id="edit_name" name="max_days"  value="{{ $c->max_days }}">
                                                            </div>

                                                            <input type="hidden" name="id_employee">

                                                            <div class="mb-3">
                                                                <label>Description</label>
                                                                <textarea class="form-control" id="edit_descri" name="description"  value="">{{ $c->description }}</textarea>
                                                            </div>

                                                                    

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Ajouter</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </0l>
                            
                        @endif
                    </div>
                    
                </div>
                        
            </div>
        </div>
    </div>
</x-app-layout>